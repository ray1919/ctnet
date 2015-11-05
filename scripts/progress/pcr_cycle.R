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

for (pos in unique(unlist(strsplit(poss,"[, ]+")))) {
  sql1 <- paste("SELECT cycle, fluorescence, position, channel FROM `report_experiment` e
              LEFT JOIN report_experiment_channel c on c.report_experiment_id = e.id
             WHERE run_id = '", rid, "' and position = '",pos,
              "' and segment = 2", sep = "")
  res1 <- dbGetQuery(con, sql1)
  for (channel in unique(res1$channel)) {
    res1[res1$channel==channel,"cycle"] <- 1:length(res1[res1$channel==channel,"cycle"])
  }
  if (nrow(res1) == 0)
    next
  if (exists("res0")) {
    res0 <- rbind(res0,res1)
  } else {
    res0 <- res1
  }
}
if (!exists("res0"))
  stop("INPUT IS NOT VALID.")
sql2 <- paste("SELECT avg(fluorescence) fluorescence, cycle FROM `report_experiment` e
              LEFT JOIN report_experiment_channel c on c.report_experiment_id = e.id
             WHERE run_id = '", rid, "' and segment = 2 GROUP BY cycle ORDER BY
              cycle desc", sep = "")
res2 <- dbGetQuery(con, sql2)
x <- dbDisconnect(con)
png(filename="cycle.png", width=900, height=600)
# q <- qplot(data=res0,x=cycle,y=fluorescence,color = factor(position))
q <- qplot(data=res0,x=cycle,y=fluorescence,
           color = factor(paste(res0$position,res0$channel)))

y_lim <- range(range(res0$fluorescence),range(res2$fluorescence))
q + geom_line() + theme_bw(base_size = 14, base_family = "") +
  ylim(y_lim) + theme(legend.title=element_blank()) + 
  scale_x_continuous(minor_breaks = seq(1, res2[1,"cycle"], 1))
dev.off()

