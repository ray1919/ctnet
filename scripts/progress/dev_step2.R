# Author: Zhao
# Date: 2015-10-21
# Purpose: import pcr data into db and reformat PCR result
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
for (txtFile in dir(pattern=".txt")) {
  tbl <- read.table(txtFile,sep="\t",skip = 1,header=T,
                    fill = T, comment.char = "")
  
  if (colnames(tbl)[5] == "Cycle.") {
    tbl <- tbl[,colSums(is.na(tbl)) != nrow(tbl)]
  } else {
    next
  }
  
  fh <- file(txtFile)
  first_line <- readLines(fh,n=1)
  close(fh)
  run_name <- sub("Raw Data \t\tExperiment - ","",first_line)
  run_name <- sub(" \\(.*?\\)$","",run_name)
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
  sql2 <- paste("INSERT INTO `report_run` (report_id, name) VALUES ( ",
                report_id, ', "', run_name,'");',sep="")
  res2 <- dbGetQuery(con, sql2)
  run_id <- dbGetQuery(con, "select LAST_INSERT_ID()")
  for (i in 1 : nrow(tbl) ) {
    insert_values1 <- paste(unlist(c(run_id, tbl[i,1])),
                            collapse = "', '")
    insert_values2 <- paste(tbl[i,3:7], sep = "', '", collapse = ", ")
    sql3 <- paste("insert into `report_experiment`(`run_id`,
          `position`, `program`, `segment`,
          `cycle`, `time`, `temperature`) values ('",
                  insert_values1, "', ", insert_values2, ")", sep="")
    res3 <- dbGetQuery(con, sql3)
    resid <- dbGetQuery(con, "select LAST_INSERT_ID()")
    for (j in 8:ncol(tbl)) {      
      insert_values3 <- paste(resid,colnames(tbl)[j],tbl[i,j],sep="', '")
      sql4 <- paste("INSERT INTO `report_experiment_channel` (`report_experiment_id`,
            `channel`, `fluorescence`) VALUES ('",insert_values3, "')",sep="")
      res4 <- dbGetQuery(con, sql4)
    }
  }
  x <- dbCommit(con)
  print(run_name)
}

x <- dbDisconnect(con)

print("All experiment data have been imported into online database.")
print("All job done.")
