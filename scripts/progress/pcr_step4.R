# Author: Zhao
# Date: 2015-10-21
# Purpose: automate the process of PCR data analysis
.libPaths(c("/home/zhaorui/R/x86_64-pc-linux-gnu-library/3.3",.libPaths()))
suppressPackageStartupMessages(library(DBI))
suppressPackageStartupMessages(library(reshape))
suppressPackageStartupMessages(library(plyr))
suppressPackageStartupMessages(library(naturalsort))
options(stringsAsFactors = FALSE)
# go to work dir

args <- commandArgs(TRUE)

wd <- args[1]
report_id <- args[2]
setwd(wd)

load(".RData")
# connect db
con <- dbConnect(RMySQL::MySQL(), user = 'ctnet',
                 password='ctnet', host='localhost',db='ctnet')

if (array_type == "gene") {
  # retrive gene table list
  geneTbl <- data.frame(Well=character(),Symbol=character(),"Gene ID"=numeric(),
                        "Gene Name"=character(), "Species"=character(),
                        Synonyms=character(),"Type of Gene"=character())
  
  for (i in rownames(schema1[!is.na(schema1$Gene.ID),])) {
    if (!schema1[i,"Symbol"] %in% symbolList) next
    if (is.na(schema1[i,"Gene.ID"])) next
    sth <- dbSendQuery(con, paste("SELECT gene_symbol, gene_id,
                      gene_name,common,synonyms,type_of_gene FROM gene
                      LEFT join species on tax_id = id
                      WHERE gene_id = ",schema1[i,"Gene.ID"],sep=""))
    res <- dbFetch(sth)
    dbClearResult(sth)
    well <- schema1[schema1$Symbol == res[[1]],"Well"]
    geneTbl[i,] <- c(well, unlist(res))
  }
  print("Gene table sheet created.")
}

sort_col <- function(df) {
  return(df[,c("symbol",naturalsort(colnames(df[,-1])))])
}

is.outlier <- function(x) {
  iqr <- IQR(x,na.rm = T)
  y <- quantile(x,3/4,na.rm = T) + 1.5*iqr # 理论是1.5倍
  ## meam gene qc >= 2* qc_cutoff
  # y2 <- 2 * qc_cutoff * length(symbolList)
  # x > min(c(y, y2))
  x > y
}

# Assay QC
assayQC <- aggregate(opt.tm ~ symbol, data=dataTbl, sd, na.rm=T)
assayQC <- merge(x = assayQC, by="symbol", all=T,
                 y = aggregate(ct ~ symbol, data=dataTbl,
                               function(x){length(x[x<35])}))
assayQC <- merge(x = assayQC, by="symbol", all=T,
                 y = aggregate(ct ~ symbol, data=dataTbl,
                               function(x){length(x[x>=35])}))
assayQC <- merge(x = assayQC, by="symbol", all=T,
                 y = aggregate(ct ~ symbol, data=dataTbl,
                               function(x){length(all_samples) - length(x)}))
assayQC <- merge(assayQC, aggregate(isdoublepeak ~ symbol, data=dataTbl,
                          function(x){sum(as.logical(x))}), all=T)
assayQC <- merge(assayQC, aggregate(qual ~ symbol, data=dataTbl,sum), all=T)
assayQC$is.qc.outlier <- is.outlier(assayQC$qual)
colnames(assayQC) <- c("SYMBOL", "TM SD", "CT<35","CT>=35","CT NULL","DOUBLE PEAKS","QUAL","IS_OUTLIER")
assayQC$`CT NULL`[is.na(assayQC$`CT NULL`)] <- length(all_samples)
if (length(assayQC$SYMBOL[assayQC$IS_OUTLIER]) > 0) {
  print(paste(
    paste(assayQC$SYMBOL[assayQC$IS_OUTLIER], collapse = ", "),
    "failed the QC test.", collapse = " "))
}

# Sample QC
sampleQC <- aggregate(ct ~ sample, data=dataTbl, function(x){length(x[x<35])})
sampleQC <- merge(x = sampleQC, by="sample", all=T,
                  y = aggregate(ct ~ sample, data=dataTbl,
                                function(x){length(x[x>=35])}))
sampleQC <- merge(x = sampleQC, by="sample", all=T,
                  y = aggregate(ct ~ sample, data=dataTbl,
                                function(x){length(symbolList) - length(x)}))
sampleQC <- merge(sampleQC, aggregate(isdoublepeak ~ sample, data=dataTbl,
                            function(x){sum(as.logical(x))}), all=T)
sampleQC <- merge(sampleQC, aggregate(qual ~ sample, data=dataTbl,sum), all=T)
colnames(sampleQC) <- c("sample", "CT<35","CT>=35","CT NULL","DOUBLE PEAKS","QUAL_SUM")
sampleQC <- merge(sampleQC, aggregate(qual ~ sample, data=dataTbl,min), all=T)
sampleQC$is.qc.outlier <- is.outlier(sampleQC$QUAL_SUM)
colnames(sampleQC) <- c("SAMPLE", "CT<35","CT>=35","CT NULL","DOUBLE PEAKS","QUAL_SUM","QUAL_MIN", "IS_OUTLIER")
## sample min qc >= qc_cutoff is set to be a outlier 2016-11-18
sampleQC$IS_OUTLIER[sampleQC$QUAL_MIN >= qc_cutoff] <- TRUE
if (length(sampleQC$SAMPLE[sampleQC$IS_OUTLIER]) > 0) {
  print(paste(
    paste(sampleQC$SAMPLE[sampleQC$IS_OUTLIER], collapse = ", "),
    "failed the QC test.", collapse = " "))
  sample_analysis[match(sampleQC$SAMPLE[sampleQC$IS_OUTLIER], all_samples)] <- FALSE
}

# Data Table & QC
rawCt <- sort_col(cast(dataTbl, symbol~sample,value = "ct"))
rawTm <- sort_col(cast(dataTbl, symbol~sample,value = "opt.tm"))
rawQc <- sort_col(cast(dataTbl, symbol~sample,value = "qual"))
rawPos <- ddply(dataTbl, .(symbol), summarise,
                Pos=paste(unique(pos), collapse = ",") )
rawTbl <- cbind(rawPos,rawCt[,-1],rawTm[,-1],rawQc[,-1])
wellTbl <- schema1[,c("Symbol","Well")]
rawTbl <- merge(wellTbl,rawTbl,by.x = "Symbol",by.y= "symbol")

print("Data & QC table sheet created.")

# dataTblQc10 <- dataTbl[dataTbl$qual < qc_cutoff,]
dataTblQc10 <- dataTbl[dataTbl$qual < qc_cutoff & # QC 小于阈值
            !(dataTbl$sample %in% sampleQC$sample[sampleQC$is.qc.outlier]) &
            !(dataTbl$symbol %in% assayQC$symbol[assayQC$is.qc.outlier]),]

rawCtQc10 <- cast(dataTblQc10, symbol~sample,value = "ct")
# 找到类似-1 -2 -3标志的技术重复，先合并。去掉QC不合格的结果。
# Update: 2016-03-14
is_tech_rep <- FALSE
if (all(grepl(pattern = "-\\d$", x = all_samples[sample_analysis]))) {
  is_tech_rep <- TRUE
  sreps <- matrix(unlist(strsplit(x = all_samples[sample_analysis], split = "-")),
                  ncol = 2, byrow = T)
  for (r in 1:nrow(sreps)) {
    sreps[r,2] <- paste(sreps[r,], collapse = "-")
  }
  sreps <- cbind(sreps, all_groups[sample_analysis])
  sreps.uniq <- unique(sreps[,c(1,3)])
  all_samples.ori <- all_samples
  all_groups.ori <- all_groups
  all_samples <- c(all_samples, sreps.uniq[,1])
  sample_analysis <- c(sample_analysis,
                    setNames(rep(TRUE, length(sreps.uniq[,1])), sreps.uniq[,1]))
  all_groups <- c(rep("", times = length(all_groups)), sreps.uniq[,2])
  for (s in unique(sreps[,1])) {
    reps <- sreps[sreps[,1]==s,2]
    if (length(reps) == 1) {
      rawCtQc10[,s] <- rawCtQc10[,reps]
    } else {
      rawCtQc10[,s] <- apply(rawCtQc10[, colnames(rawCtQc10) %in% reps], MARGIN = 1, FUN = mean,na.rm=T)
    }
  }
  
}

# delta-delta CT result sheet
# check HK
if (normalization.method == "HK") {
  hks_valid <- array()
  for (hks in schema2$Housekeeping.Gene.Symbol) {
    if (is_tech_rep) {
      is_valid <- TRUE
      for (s in unique(sreps[,1])) {
        reps <- sreps[sreps[,1]==s,2]
        z <- dataTbl[dataTbl$symbol == hks & dataTbl$sample %in% reps,"qual"] < qc_cutoff
        if (is.na(table(z)["TRUE"])) {
          is_valid <- FALSE
          break
        }
      }
      if (is_valid)
        hks_valid <- c(hks_valid,hks)
    } else {
      if (all(dataTbl[dataTbl$symbol == hks &
            dataTbl$sample %in% all_samples[sample_analysis],"qual"] < qc_cutoff))
        hks_valid <- c(hks_valid,hks)
    }
  }
  if (length(hks_valid) == 1)
    stop("ERROR 4: All HK genes failed QC checking.")
} else if (normalization.method == "median") {
  # use median normalization when no HK gene provided
  valid_symbol <- intersect(na.omit(rawCt)$symbol, na.omit(rawTm)$symbol)
  median_ct <- apply(rawCt[rawCt$symbol %in% valid_symbol,-1],MARGIN = 2,median)
  names(median_ct) <- colnames(rawCt[,-1])
}

# calculate delta CT for each sample
deltaCt <- data.frame(symbol=character(),sample=character(),delta_ct=numeric())
for (k in all_samples[sample_analysis] ) {
  if (normalization.method == "HK") {
    hks_avg_ct <- mean(rawCtQc10[rawCtQc10$symbol %in% hks_valid,k],na.rm=T)
  } else if (normalization.method == "median") {
    hks_avg_ct <- median_ct[k]
  }
  for (j in schema1$Symbol ) {
    # skip HK genes
    if (j %in% schema2$Housekeeping.Gene.Symbol)
      next
    if (j %in% c("GDC","PPC","RTC","PPC1","RTC1","PPC2","RTC2","PPC3","RTC3",
                 "NEG1","NEG2","NEG3","NEG4") )
      next
    ct_raw <- rawCtQc10[rawCtQc10$symbol == j, k]
    if (length(ct_raw) == 0)
      next
    delta_ct <- ct_raw - hks_avg_ct
    deltaCt <- rbind(deltaCt, data.frame(symbol=j,sample=k,delta_ct))
  }
}
rownames(deltaCt) <- NULL
deltaCtCasted <- sort_col(cast(deltaCt, symbol~sample,value = "delta_ct"))

print("HK gene QC checked.")
