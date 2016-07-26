# Author: Zhao
# Date: 2015-10-20
# Purpose: automate the process of PCR data analysis
.libPaths(c("/home/zhaorui/R/x86_64-pc-linux-gnu-library/3.2",.libPaths()))
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
                     cols=1:4)
# HK genes
schema2 <- read.xlsx("PCR_Layout_Template.xlsx",sheet=2,colNames=T,
                     cols=1:2)
# CT,TM files
schema3 <- read.xlsx("PCR_Layout_Template.xlsx",sheet=3,colNames=T,
                     cols=1:10)
# compare
schema4 <- read.xlsx("PCR_Layout_Template.xlsx",sheet=4,colNames=T,
                     cols=2:4)

# ID 2 sample
# schema5 <- read.xlsx("PCR_Layout_Template.xlsx",sheet=5,colNames=T,
#                     cols=1:3)

symbolList <- schema1$Symbol[schema1$Symbol!="[SKIP]"]

print("Experiment schema read.")

# read sample file
for (i in 1:nrow(schema3)) {
  for ( filename in schema3[i,c(2:3,5)] ) {
    if (is.na(filename)) next
    if (!file.exists( filename )) {
      stop(paste("ERROR 2:",filename,"not exists.",sep = " "))
    }
  }
}

# check compare name

samples_per_array <- sapply(schema3[,1], strsplit,split=',')
if (is.na(schema3[1,4])) {
  groups_per_array  <- list()
} else {
  groups_per_array  <- sapply(schema3[,4], strsplit,split=',')
  # 组内不满指定命名个数的，用最后一命名代替空白命名
  # Update: 2016-03-14
  for (i in 1:length(groups_per_array) ) {
    if (length(groups_per_array[[i]]) < schema3[i,9] ) {
      groups_per_array[[i]] <- c(groups_per_array[[i]],
        rep(groups_per_array[[i]][length(groups_per_array[[i]])],
            times = schema3[i,9] - length(groups_per_array[[i]])) )
    }
  }
}
all_samples <- unlist(samples_per_array)
all_groups <- unlist(groups_per_array)
names(all_samples) <- NULL
names(all_groups) <- all_samples

# 确定需要进行数据分析的样本。不进行数据分析的样本，在进行看家基因选择时不考虑
sample_analysis <- rep(F,length(all_samples))

for (i in unique(unlist(schema4[,1:2])) ) {
  if (i %in% all_samples) {
    sample_analysis[all_samples == i] <- TRUE
  }
  if ( i %in% all_groups ) {
    sample_analysis[all_samples %in% names(all_groups[all_groups==i])] <- TRUE
  }
  if ( ! i %in% all_samples && ! i %in% all_groups) {
      stop(paste("ERROR 3:",i,"not declared.",sep = " "))
  }
}

# 判断是否是miRNA芯片
is_miR_ary <- any(grepl("\\w\\w\\w-\\w\\w\\w-\\d",schema1$Symbol,perl=T))

print("File check finish.")
print("Start to import CT, TM data...")