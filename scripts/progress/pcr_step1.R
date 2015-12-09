# Author: Zhao
# Date: 2015-10-20
# Purpose: automate the process of PCR data analysis
.libPaths(c("/home/zhaorui/R/x86_64-unknown-linux-gnu-library/3.1",.libPaths()))
suppressPackageStartupMessages(library(openxlsx))

options(stringsAsFactors = FALSE)
# go to work dir

args <- commandArgs(TRUE)

wd <- args[1]
report_id <- args[2]
setwd(wd)

# read array layout

if (!file.exists("PCR_Layout_Template.xlsx" )) {
  stop(paste("ERROR 1:","PCR_Layout_Template.xlsx not exists.",sep = " "))
}
# gene and primer info
schema1 <- read.xlsx("PCR_Layout_Template.xlsx",sheet=1,colNames=T,
                     cols=1:3)
# HK genes
schema2 <- read.xlsx("PCR_Layout_Template.xlsx",sheet=2,colNames=T,
                     cols=1:2)
# CT,TM files
schema3 <- read.xlsx("PCR_Layout_Template.xlsx",sheet=3,colNames=T,
                     cols=1:10)
# compare
schema4 <- read.xlsx("PCR_Layout_Template.xlsx",sheet=4,colNames=T,
                     cols=2:3)

print("Experiment schema read.")

# read sample file
for (i in 1:nrow(schema3)) {
  for ( filename in schema3[i,c(2:3,5)] )
    if (!file.exists( filename )) {
      stop(paste("ERROR 2:",filename,"not exists.",sep = " "))
    }
}

# check compare name

samples_per_array <- sapply(schema3[,1], strsplit,split=',')
if (is.na(schema3[,4])) {
  groups_per_array  <- list()
} else {
  groups_per_array  <- sapply(schema3[,4], strsplit,split=',')
}
all_samples <- unlist(samples_per_array)
all_groups <- unlist(groups_per_array)

for (i in unique(unlist(schema4)) ) {
  if ( ! i %in% all_samples && ! i %in% all_groups) {
    stop(paste("ERROR 3:",i,"not declared.",sep = " "))
  }
}

print("File check finish.")
print("Start to import CT, TM data...")