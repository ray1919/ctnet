# Author: Zhao
# Date: 2015-10-21
# Purpose: automate the process of PCR data analysis
.libPaths(c("/home/zhaorui/R/x86_64-pc-linux-gnu-library/3.2",.libPaths()))
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

if (is_miR_ary) {
  # geneTbl <- null
} else {
  # retrive gene table list
  geneTbl <- data.frame(Well=character(),Symbol=character(),"Gene ID"=numeric(),
                        "Gene Name"=character(), "Species"=character(),
                        Synonyms=character(),"Type of Gene"=character())
  
  for (i in rownames(schema1[!is.na(schema1$Gene.ID),])) {
    if (is.na(schema1[i,"Gene.ID"])) next
    sth <- dbSendQuery(con, paste("SELECT gene_symbol, gene_id,
                      gene_name,common,synonyms,type_of_gene FROM gene
                      LEFT join species on tax_id = id
                      WHERE gene_id = ",schema1[i,"Gene.ID"],sep=""))
    res <- dbFetch(sth)
    dbClearResult(sth)
    well <- schema1[schema1$Symbol == as.character(res[1]),"Well"]
    geneTbl[i,] <- c(well, unlist(res))
  }
}
print("Gene table sheet created.")

sort_col <- function(df) {
  return(df[,c("symbol",naturalsort(colnames(df[,-1])))])
}

# Assay QC
assayQC <- aggregate(opt.tm ~ symbol, data=dataTbl, sd, na.rm=T)
assayQC <- merge(assayQC, aggregate(ct ~ symbol, data=dataTbl,
                                    function(x){length(x)/length(all_samples)}))
assayQC <- merge(assayQC, aggregate(isdoublepeak ~ symbol, data=dataTbl,
                                    function(x){sum(as.logical(x))}))
assayQC <- merge(assayQC, aggregate(qual ~ symbol, data=dataTbl,sum))
is.outlier <- function(x) {
  iqr <- IQR(x,na.rm = T)
  y <- quantile(x,3/4,na.rm = T) + 1.5*iqr
  x > y
}
assayQC$is.qc.outlier <- is.outlier(assayQC$qual)
if (length(assayQC$symbol[assayQC$is.qc.outlier]) > 0) {
  print(paste(assayQC$symbol[assayQC$is.qc.outlier],"failed the QC test."))
}

# Sample QC
sampleQC <- aggregate(ct ~ sample, data=dataTbl, function(x){length(x[x<35])})
sampleQC <- merge(sampleQC, aggregate(ct ~ sample, data=dataTbl,
                                      function(x){length(x)/length(symbolList)}),by="sample")
sampleQC <- merge(sampleQC, aggregate(isdoublepeak ~ sample, data=dataTbl,
                                      function(x){sum(as.logical(x))}))
sampleQC <- merge(sampleQC, aggregate(qual ~ sample, data=dataTbl,sum))
sampleQC$is.qc.outlier <- is.outlier(sampleQC$qual)
if (length(sampleQC$sample[sampleQC$is.qc.outlier]) > 0) {
  print(paste(sampleQC$sample[sampleQC$is.qc.outlier],"failed the QC test."))
  sample_analysis[match(sampleQC$sample[sampleQC$is.qc.outlier], all_samples)] <- FALSE
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
if (all(grepl(pattern = "-\\d$", x = all_samples))) {
  is_tech_rep <- TRUE
  sreps <- matrix(unlist(strsplit(x = all_samples[sample_analysis], split = "-")),
                  ncol = 2, byrow = T)
  for (r in 1:nrow(sreps)) {
    sreps[r,2] <- paste(sreps[r,], collapse = "-")
  }
  sreps <- cbind(sreps, all_groups[sample_analysis])
  sreps.uniq <- unique(sreps[,c(1,3)])
  all_samples <- c(all_samples, sreps.uniq[,1])
  all_groups <- c(rep("", times = length(all_groups)), sreps.uniq[,2])
  for (s in unique(sreps[,1])) {
    reps <- sreps[sreps[,1]==s,2]
    rawCtQc10[,s] <- apply(rawCtQc10[,reps], MARGIN = 1, FUN = mean,na.rm=T)
  }
  
}

# delta-delta CT result sheet
# check HK
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
  } else 
    if (all(dataTbl[dataTbl$symbol == hks &
          dataTbl$sample %in% all_samples[sample_analysis],"qual"] < qc_cutoff))
      hks_valid <- c(hks_valid,hks)
}
if (length(hks_valid) == 1)
  stop("ERROR 4: All HK genes failed QC checking.")

# calculate delta CT for each sample
deltaCt <- data.frame(symbol=character(),sample=character(),delta_ct=numeric())
for (k in all_samples[sample_analysis] ) {
  hks_avg_ct <- mean(rawCtQc10[rawCtQc10$symbol %in% hks_valid,k],na.rm=T)
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
deltaCtCasted <- sort_col(cast(deltaCt, symbol~sample,value = "delta_ct"))

print("HK gene QC checked.")