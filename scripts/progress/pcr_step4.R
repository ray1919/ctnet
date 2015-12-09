# Author: Zhao
# Date: 2015-10-21
# Purpose: automate the process of PCR data analysis
.libPaths(c("/home/zhaorui/R/x86_64-unknown-linux-gnu-library/3.1",.libPaths()))
suppressPackageStartupMessages(library(DBI))
suppressPackageStartupMessages(library(reshape))
suppressPackageStartupMessages(library(plyr))
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

# retrive gene table list
geneTbl <- data.frame(Symbol=character(),"Gene ID"=numeric(),"Gene Name"=character(),
                      "Species"=character(),Synonyms=character(),"Type of Gene"=
                        character())

for (i in rownames(schema1[!is.na(schema1$Gene.ID),])) {
  if (is.na(schema1[i,"Gene.ID"])) next
  sth <- dbSendQuery(con, paste("SELECT gene_symbol, gene_id, gene_name,common,synonyms,type_of_gene FROM gene
                    LEFT join species on tax_id = id
                    WHERE gene_id = ",schema1[i,"Gene.ID"],sep=""))
  res <- dbFetch(sth)
  dbClearResult(sth)
  geneTbl[i,] <- res
}

print("Gene table sheet created.")

# Data Table & QC
rawCt <- cast(dataTbl, symbol~sample,value = "ct")
rawTm <- cast(dataTbl, symbol~sample,value = "opt.tm")
rawQc <- cast(dataTbl, symbol~sample,value = "qual")
rawPos <- ddply(dataTbl,.(symbol),summarise,Pos=paste(pos,collapse = ","))
rawTbl <- cbind(rawPos,rawCt[,-1],rawTm[,-1],rawQc[,-1])

print("Data & QC table sheet created.")

# delta-delta CT result sheet
# check HK
hks_valid <- array()
for (hks in schema2$Housekeeping.Gene.Symbol) {
  if (all(dataTbl[dataTbl$symbol == hks,"qual"] < qc_cutoff)) {
    hks_valid <- rbind(hks_valid,hks)
  }
}
if (length(hks_valid) == 1)
  stop("ERROR 4: All HK genes failed QC checking.")

print("HK gene QC checked.")