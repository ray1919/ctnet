# Author: Zhao
# Date: 2015-10-24
# Purpose: plot pcr curve from imported data
.libPaths(c("/home/zhaorui/R/x86_64-unknown-linux-gnu-library/3.1",.libPaths()))
suppressPackageStartupMessages(library(DBI))
suppressPackageStartupMessages(library(ggplot2))
options(stringsAsFactors = FALSE)
# go to work dir

args <- commandArgs(TRUE)

rid <- args[2]
poss <- args[3]
wd  <- args[1]
setwd(wd)
# connect db
con <- dbConnect(RMySQL::MySQL(), user = 'ctnet',
                 password='ctnet', host='localhost',db='ctnet')
if (exists("res0"))
  rm(res0)

for (pos in unique(unlist(strsplit(poss,"[, ]+")))) {
  sql1 <- paste("SELECT temperature, fluorescence, position, channel FROM `report_experiment` e
                LEFT JOIN report_experiment_channel c on c.report_experiment_id = e.id
                WHERE run_id = '", rid, "' and position = '",pos,
                "' and segment = 3", sep = "")
  res1 <- dbGetQuery(con, sql1)
  if (nrow(res1) == 0)
    next
  if (exists("res0")) {
    res0 <- rbind(res0,res1)
  } else {
    res0 <- res1
  }
}
x <- dbDisconnect(con)
if (!exists("res0"))
  stop("INPUT IS NOT VALID.")
png(filename="temp.png", width=900, height=600)
q <- qplot(data=res0,x=temperature,y=fluorescence,
           color = factor(paste(res0$position,res0$channel)))

q + geom_line() + theme_bw(base_size = 14, base_family = "") +
  theme(legend.title=element_blank())
dev.off()

