# Author: Zhao
# Date: 2015-10-21
# Purpose: automate the process of PCR data analysis
.libPaths(c("/home/zhaorui/R/x86_64-pc-linux-gnu-library/3.2",.libPaths()))
suppressPackageStartupMessages(library(DBI))
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

# pb <- txtProgressBar(max = nrow(dataTbl), style = 3)
for (i in 1:nrow(dataTbl)) {
  istmoutlier1 <- NA
  istmoutlier2 <- NA
  opt.tm <- NA
  outlimit2 <- c(NA,NA)
  if( !is.na(dataTbl$tm1[i]) ) {
    # determin is TM outlier in this experiment
    opt.tm <- dataTbl$tm1[i]
    tms <- as.numeric(unlist(dataTbl[dataTbl$symbol == dataTbl$symbol[i],
                                     c('tm1','tm2')]))
    iqr <- IQR(tms,na.rm=T)
    outlimit2 <- c(quantile(tms,1/4,na.rm=T) - 1.5*iqr, quantile(tms,3/4,na.rm=T) + 1.5*iqr)
    
    if (outlimit2[2] - outlimit2[1] < min_CI) {
      mean_limit2 = mean(outlimit2)
      outlimit2[1] = mean_limit2 - 0.5*min_CI
      outlimit2[2] = mean_limit2 + 0.5*min_CI
    }
    
    istmoutlier2 <- TRUE
    for ( tmv in dataTbl[i,c('tm1','tm2')] ) {
      if (all(c(tmv >= outlimit2[1], tmv <= outlimit2[2], !is.na(tmv)) ) ) {
        opt.tm <- tmv
        istmoutlier2 <- FALSE
      }
    }
    
    # determine is TM a outlier compared to previous records
    if ( !is.na(dataTbl$primerid[i]) ) {
      res <- dbSendQuery(con, paste("SELECT tm1,tm2 FROM PCR_experiment
                                    WHERE primer_id = '",dataTbl$primerid[i],"'",sep=""))
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
  if ( dataTbl$isdoublepeak[i] ) qual <- qual + 4
  if ( !is.na(istmoutlier1) & istmoutlier1 ) qual <- qual + 1
  if ( !is.na(istmoutlier2) & istmoutlier2 ) qual <- qual + 8
  dataTbl$opt.tm[i] <- opt.tm
  dataTbl$istmoutlier1[i] <- istmoutlier1
  dataTbl$istmoutlier2[i] <- istmoutlier2
  dataTbl$tmlowerlimit[i] <- outlimit2[1]
  dataTbl$tmupperlimit[i] <- outlimit2[2]
  dataTbl$qual[i] <- dataTbl$qual[i] + qual
  # setTxtProgressBar(pb, i)
}
dataTbl$sample <- as.character(dataTbl$sample)
dataTbl$ct <- as.numeric(dataTbl$ct)
dataTbl$tm1 <- as.numeric(dataTbl$tm1)
dataTbl$tm2 <- as.numeric(dataTbl$tm2)
dataTbl$opt.tm <- as.numeric(dataTbl$opt.tm)
dataTbl$tmlowerlimit <- as.numeric(dataTbl$tmlowerlimit)
dataTbl$tmupperlimit <- as.numeric(dataTbl$tmupperlimit)

print("Raw data QC checked.")
