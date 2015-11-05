# Author: Zhao
# Date: 2015-09-14
# Purpose: automate the process of PCR data analysis
.libPaths("/home/zhaorui/R/x86_64-unknown-linux-gnu-library/3.1")
library(xlsx)
library(DBI)
library(hash)
library(qpcR)
library(ReadqPCR)

args <- commandArgs(TRUE)

wd <- args[1]

options(stringsAsFactors = FALSE)
# go to work dir
setwd(wd)

# read array layout
# array size, sample per array, sample per row, totle sample
schema1 <- unlist(read.xlsx("PCR_Layout_Template.xlsx",sheetIndex = 1,
                     header=F,colIndex = 2,rowIndex = 1:4))
geneNum = schema1[1] / schema1[2]
# gene and primer info
schema2 <- read.xlsx("PCR_Layout_Template.xlsx",sheetIndex = 2,
                     header=T,colIndex = 1:3,endRow=geneNum+1,stringsAsFactors=F)
# HK genes
schema3 <- na.omit(read.xlsx("PCR_Layout_Template.xlsx",sheetIndex = 3,
                     header=T,colIndex = 1:2,stringsAsFactors=F))
# CT,TM files
schema4 <- na.omit(read.xlsx("PCR_Layout_Template.xlsx",sheetIndex = 4,
                     header=T,colIndex = 1:5,stringsAsFactors=F))
# compare
schema5 <- na.omit(read.xlsx("PCR_Layout_Template.xlsx",sheetIndex = 5,
                     header=T,colIndex = 2:3,stringsAsFactors=F))

# make pos => gene primer row index hash table
pos2idx <- hash()
rowNum <- 2*sqrt(schema1[1]/6)
colNum <- 3*sqrt(schema1[1]/6)
spr <- schema1[3]               # sample per row
spc <- schema1[2] / schema1[3]  # sample per col
for ( i in 1:rowNum ) {   # row, A .. H
  for ( j in 1:colNum ) { # col, 1 .. 12
    .set(pos2idx,keys = paste(LETTERS[i],j,sep=""),
          values = (i-1) %% (rowNum/spc) * (colNum/spr) +
          (j-1) %% (colNum/spr) + 1)
  }
}

# read sample file
for (i in 1:nrow(schema4)) {
  for ( filename in schema4[i,c(2:3,5)] )
  if (!file.exists( filename )) {
    print(paste(filename,"not exist.",sep = " "))
    quit(save = "no", status = 1)
  }
}

# check compare name
for (i in unique(unlist(schema5)) ) {
  if ( ! i %in% schema4[,1] && ! i %in% schema4[,4]) {
    print(paste(i,"not mentioned.",sep = " "))
    quit(save = "no", status = 2)
  }
}

print("File check done")

# extract experiment file, plot curve
for (efile in unique(schema4[,5])) {
  subdir <- sub(".txt","",efile)
  if (!file.exists(subdir)) dir.create(subdir)
  cycData <- read.LC480(efile)
  cycMod <- cbind(fData(cycData)[,1],exprs(cycData))
  for ( i in 2:ncol(cycMod)) {
    pf <- pcrfit(cycMod,1,i,l4)
    pos <- colnames(cycMod)[i]
    png(filename = paste(subdir,"/",pos,".png", sep=""),width = 800, height = 600)
    pdff <- efficiency(pf)
    dev.off()
  }
}

# check TM outlier
# connect db
con <- dbConnect(RMySQL::MySQL(), user = 'ctnet',
                 password='ctnet', host='localhost',db='ctnet')

dataTbl <- data.frame(symbol=character(),geneid=numeric(),primerid=numeric(),
                  pos=character(),ct=numeric(),tm1=numeric(),tm2=numeric(),opt.tm=character(),
                  istmoutlier1=logical(),istmoutlier2=logical(),
                  ishousekeeping=logical(),isdoublepeak=logical(),
                  tmlowerlimit=numeric(),tmupperlimit=numeric(),
                  qual=numeric())

insertRow <- function(existingDF, newrow) {
  r=nrow(existingDF) + 1
  # existingDF[seq(r+1,nrow(existingDF)+1),] <- existingDF[seq(r,nrow(existingDF)),]
  existingDF[r,] <- newrow
  existingDF
}

# read sample CT file
for (j in 1: nrow(schema4)) {
  ct_raw <- read.table(schema4[j,2],sep="\t",skip = 1,header=T,
                       stringsAsFactors=F)
  tm_raw <- read.table(schema4[j,3],sep="\t",skip = 1,header=T,
                       stringsAsFactors=F)

  for (i in 1:geneNum) {
    pos <- ct_raw[i,'Pos']
    geneIdx <- values(pos2idx,keys=pos)
    symbol <- schema2$Symbol[geneIdx]
    geneid <- schema2$Gene.ID[geneIdx]
    primerid <- schema2$Primer.ID[geneIdx]
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
    if ( symbol %in% schema3$Housekeeping.Gene.Symbol) {
      ishousekeeping <- TRUE
    } else {
      ishousekeeping <- FALSE
    }
    dataTbl <-  insertRow(dataTbl, c(symbol,geneid,primerid,pos,ct,tm1,tm2,
                opt.tm,NA,NA,ishousekeeping,isdoublepeak,NA,NA,qual))
  }
}
dataTbl$qual <- as.numeric(dataTbl$qual)
for (i in 1:nrow(dataTbl)) {
  istmoutlier1 <- NA
  istmoutlier2 <- NA
  opt.tm <- NA
  if( !is.na(dataTbl$tm1[i]) ) {
    # determin is TM outlier in this experiment
    opt.tm <- dataTbl$tm1[i]
    tms <- as.numeric(unlist(dataTbl[dataTbl$symbol == dataTbl$symbol[i],
            c('tm1','tm2')]))
    iqr <- IQR(tms,na.rm=T)
    outlimit2 <- c(quantile(tms,1/4,na.rm=T) - 1.5*iqr, quantile(tms,3/4,na.rm=T) + 1.5*iqr)
    istmoutlier2 <- TRUE
    for ( tmv in dataTbl[i,c('tm1','tm2')] ) {
      if (all(c(tmv > outlimit2[1], tmv < outlimit2[2], !is.na(tmv)) ) ) {
        opt.tm <- tmv
        istmoutlier2 <- FALSE
      }
    }

    # determine is TM a outlier compared to previous records
    if ( !is.na(dataTbl$primerid[i]) ) {
      res <- dbSendQuery(con, paste("SELECT tm1,tm2 FROM PCR_experiment
                                    WHERE primer_id = ",dataTbl$primerid[i],sep=""))
      tms <- as.numeric(na.omit(unlist(dbFetch(res))))
      dbClearResult(res)
      if (length(tms) > 0) {
        iqr <- IQR(tms)
        outlimit1 <- c(quantile(tms,1/4) - 1.5*iqr, quantile(tms,3/4) + 1.5*iqr)
        istmoutlier1 <- FALSE
        if ( opt.tm < outlimit1[1] || opt.tm > outlimit1[2] ) {
          istmoutlier1 <- TRUE
        }
      }
    }
  }
  
  qual <- 0
  ct <- dataTbl$ct[i]
  if ( dataTbl$symbol[i] == 'GDC' ) {
    if ( !is.na(ct) && ct < 35 ) qual <- qual + 2
  } else {
    if ( is.na(ct) ) {
      qual <- qual + 32
    } else if ( ct > 35 ) {
      qual <- qual + 2
    }
  }
  # c('TMOUT','CT35','DP')
  if ( dataTbl$isdoublepeak[i] ) qual <- qual + 1
  if ( is.na(ct) | ct > 35 ) qual <- qual + 2
  if ( !is.na(istmoutlier1) & istmoutlier1 ) qual <- qual + 4
  if ( is.na(istmoutlier2) | istmoutlier2 ) qual <- qual + 8
  dataTbl$opt.tm[i] <- opt.tm
  dataTbl$istmoutlier1[i] <- istmoutlier1
  dataTbl$istmoutlier2[i] <- istmoutlier2
  dataTbl$tmlowerlimit[i] <- outlimit2[1]
  dataTbl$tmupperlimit[i] <- outlimit2[2]
  dataTbl$qual[i] <- dataTbl$qual[i] + qual
}
write.xlsx(dataTbl,file="dataTbl.xlsx")
print("Data table saved.")



