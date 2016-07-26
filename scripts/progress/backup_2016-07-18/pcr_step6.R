# Author: Zhao
# Date: 2015-10-21
# Purpose: automate the process of PCR data analysis
.libPaths(c("/home/zhaorui/R/x86_64-unknown-linux-gnu-library/3.1",.libPaths()))
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

for (r in 1:nrow(schema3)) {
  efile <- schema3[r,5]
  if (is.na(efile)) {
    print("Experiment file not provided. Skip step 6.")
    next
  }
  memo <- schema3[r,10]
  fh <- file(efile)
  first_line <- readLines(fh,n=1)
  run_name <- sub("Raw Data \t\tExperiment - ","",first_line)
  run_name <- sub(" *\\(.*\\)","",run_name)
  # run_id <- sub(".txt","",efile)
  allData <- read.table(file = efile, header = T, sep = "\t", 
                        fill = T, comment.char = "", skip = 1)
  allData <- allData[,colSums(is.na(allData)) != nrow(allData)]
  # check duplication
  sql1 <- paste("SELECT COUNT(*) FROM `report_run` WHERE name = '", run_name,
          "'", sep = "")
  res1 <- dbGetQuery(con, sql1)
  if (res1 > 0) {
    print(paste("Database records of run:", run_name,
                "allready exists. Import skiped."))
    next
  }
  x <- dbBegin(con)
  sql2 <- paste("INSERT INTO `report_run` (report_id, name, memo) VALUES ( ", report_id, ", '", run_name,"',
                '", memo, "');",sep="")
  res2 <- dbGetQuery(con, sql2)
  run_id <- dbGetQuery(con, "select LAST_INSERT_ID()")
  for (i in 1 : nrow(allData) ) {
    insert_values1 <- paste(unlist(c(run_id, allData[i,1])),
                            collapse = "', '")
    insert_values2 <- paste(allData[i,3:7], sep = "', '", collapse = ", ")
    sql3 <- paste("insert into `report_experiment`(`run_id`,
          `position`, `program`, `segment`,
          `cycle`, `time`, `temperature`) values ('",
          insert_values1, "', ", insert_values2, ")", sep="")
    res3 <- dbGetQuery(con, sql3)
    resid <- dbGetQuery(con, "select LAST_INSERT_ID()")
    for (j in 8:ncol(allData)) {      
      insert_values3 <- paste(resid,colnames(allData)[j],allData[i,j],sep="', '")
      sql4 <- paste("INSERT INTO `report_experiment_channel` (`report_experiment_id`,
            `channel`, `fluorescence`) VALUES ('",insert_values3, "')",sep="")
      res4 <- dbGetQuery(con, sql4)
    }
  }
  x <- dbCommit(con)
}

x <- dbDisconnect(con)

print("All PCR experiment data have been imported into online database.")
print("All job done.")