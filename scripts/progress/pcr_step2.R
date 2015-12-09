# Author: Zhao
# Date: 2015-10-21
# Purpose: automate the process of PCR data analysis
.libPaths(c("/home/zhaorui/R/x86_64-unknown-linux-gnu-library/3.1",.libPaths()))
suppressPackageStartupMessages(library(hash))
options(stringsAsFactors = FALSE)
# go to work dir

args <- commandArgs(TRUE)

wd <- args[1]
report_id <- args[2]
setwd(wd)

load(".RData")

# check TM outlier
dataTbl <- data.frame(symbol=character(),sample=character(),geneid=numeric(),primerid=numeric(),
                      pos=character(),ct=numeric(),tm1=numeric(),tm2=numeric(),opt.tm=character(),
                      istmoutlier1=logical(),istmoutlier2=logical(),
                      ishousekeeping=logical(),isdoublepeak=logical(),
                      tmlowerlimit=numeric(),tmupperlimit=numeric(),
                      qual=numeric())

# 1  double peak
# 2  non GDC CT > 35 or GDC CT < 35
# 4	TM outlier compare to archive data
# 8	TM outlier among same batch data
# 16	Detector Call uncertain
# 32	No CT
qc_cutoff <- 10

insertRow <- function(existingDF, newrow) {
  r=nrow(existingDF) + 1
  # existingDF[seq(r+1,nrow(existingDF)+1),] <- existingDF[seq(r,nrow(existingDF)),]
  existingDF[r,] <- newrow
  existingDF
}

# read sample CT file
for (j in 1: nrow(schema3)) {
  # make pos => gene primer row index hash table
  pos2idx <- hash()
  pos2smp <- hash()
  rowNum <- 2*sqrt(schema3[j,6]/6)
  colNum <- 3*sqrt(schema3[j,6]/6)
  spr <- schema3[j,8]               # sample per row
  spc <- schema3[j,7] / schema3[j,8]  # sample per col
  for ( s in 1:rowNum ) {   # row, A .. H
    for ( t in 1:colNum ) { # col, 1 .. 12
      .set(pos2idx,keys = paste(LETTERS[s],t,sep=""),
           values = (s-1) %% (rowNum/spc) * (colNum/spr) +
             (t-1) %% (colNum/spr) + 1)
      .set(pos2smp,keys = paste(LETTERS[s],t,sep=""),
           values = (s-1) %/% (rowNum/spc) * spr + (t-1) %/% (colNum/spr) + 1)
    }
  }
  
  geneNum = schema3[j,6] / schema3[j,7]
  ct_raw <- read.table(schema3[j,2],sep="\t",skip = 1,header=T,
                       stringsAsFactors=F)
  tm_raw <- read.table(schema3[j,3],sep="\t",skip = 1,header=T,
                       stringsAsFactors=F)
  
  for (i in 1: (length(unlist(samples_per_array[j])) * geneNum)) {
    pos <- ct_raw[i,'Pos']
    geneIdx <- values(pos2idx,keys=pos)
    symbol <- schema1$Symbol[geneIdx]
    geneid <- schema1$Gene.ID[geneIdx]
    primerid <- schema1$Primer.ID[geneIdx]
    sample_name <- unlist(samples_per_array[j])[values(pos2smp,keys=pos)]
    ct <- ct_raw[i, 'Cp']
    tm1 <- tm_raw[i, 'Tm1']
    tm2 <- tm_raw[i, 'Tm2']
    status <- ct_raw$Status[i]
    qual <- 0
    if ( !is.na(status) & status == "? - Detector Call uncertain" ) qual <- 16
    opt.tm <- NA
    if ( !is.na(tm_raw[i,'Tm2'])) {
      isdoublepeak <- TRUE
    } else {
      isdoublepeak <- FALSE
    }
    if ( symbol %in% schema2$Housekeeping.Gene.Symbol) {
      ishousekeeping <- TRUE
    } else {
      ishousekeeping <- FALSE
    }
    dataTbl <-  insertRow(dataTbl, c(symbol,sample_name,geneid,primerid,pos,ct,tm1,tm2,
                                     opt.tm,NA,NA,ishousekeeping,isdoublepeak,NA,NA,qual))
  }
}
dataTbl$qual <- as.numeric(dataTbl$qual)
dataTbl$tm1 <- as.numeric(dataTbl$tm1)
dataTbl$tm2 <- as.numeric(dataTbl$tm2)

print("CT, TM data imported.")
