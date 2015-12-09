# Author: Zhao
# Date: 2015-10-21
# Purpose: import pcr data into db and reformat PCR result
.libPaths(c("/home/zhaorui/R/x86_64-unknown-linux-gnu-library/3.1",.libPaths()))
suppressPackageStartupMessages(library(openxlsx))
suppressPackageStartupMessages(library(reshape))
library(methods)
options(stringsAsFactors = FALSE)
# go to work dir

args <- commandArgs(TRUE)

wd <- args[1]
report_id <- args[2]
setwd(wd)
if (exists("df0"))
  rm(df0)
dList <- list()
for (txtFile in dir(pattern="*.txt")) {
  tbl <- read.table(txtFile,sep="\t",skip = 1,header=T,
                    fill = T, comment.char = "")
  
  if (colnames(tbl)[5] == "Cp") {
    colnames(tbl)[8] <- "CpStatus"
    df <- tbl[,c("Pos","Cp","CpStatus")]
  } else if (colnames(tbl)[5] == "Tm1") {
    colnames(tbl)[7] <- "TmStatus"
    df <- tbl[,c("Pos","Tm1","Tm2" ,"TmStatus")]
  } else if (colnames(tbl)[5] == "Cycle.") {
    next
  } else {
    # Unknown format
    next
  }
  
  fh <- file(txtFile)
  first_line <- readLines(fh,n=1)
  close(fh)
  run_name <- sub("Experiment: ","",first_line)
  run_name <- sub("  Selected Filter:.*","",run_name)
  channel <- sub(".*\\(([0-9]+)-([0-9]+)\\)","X\\1.\\2",first_line,perl=T)
  df$Run <- run_name
  df$Channel <- channel
  df$Row <- sub("([A-Z]).*","\\1",df$Pos)
  df$Col <- as.numeric(sub("[A-Z]([0-9]+).*","\\1",df$Pos))
  
  if (run_name %in% names(dList)) {
    # df0 <- merge(df0, df, all.x = T, all.y = T)
    # df0 <- merge(df0, df, by = intersect(colnames(df),colnames(df0)))
    # df0 <- merge(df0, df, by = c("Pos","Run","Channel","Col","Row"))
    dList[[run_name]] <- merge(dList[[run_name]], df, all.x = T, all.y = T)
    print(run_name)
  } else {
    dList[[run_name]] <- df
  }
}
df0 <- do.call("rbind",dList)

if (!exists("df0")) {
  print("NO Data FOUND.")
  exit
}

wb <- createWorkbook(creator="CT Bioscience")
options("openxlsx.borderColour" = "#4F80BD")
options("openxlsx.borderStyle" = "thin")
modifyBaseFont(wb, fontSize = 10, fontName = "Arial")

color <- rgb(runif(1),runif(1),runif(1))
addWorksheet(wb, sheetName = "Cp TM Data", tabColour = color, gridLines = TRUE)
writeDataTable(wb, sheet = 1, x = df0, colNames = TRUE,tableStyle="TableStyleLight9")

substrRight <- function(x, n){
  substr(x, nchar(x)-n+1, nchar(x))
}

if ("Cp" %in% colnames(df0)) {
  for (run in unique(df0$Run)) {
    for (channel in unique(df0$Channel)) {
      cp <- cast(df0[df0$Run == run & df0$Channel == channel,], Row~Col,value = "Cp")
      # sheetname <- paste(substr(run,1,19),channel,"Cp")
      sheetname <- paste(substrRight(run,19),channel,"Cp")
      color <- rgb(runif(1),runif(1),runif(1))
      addWorksheet(wb, sheetName = sheetname, tabColour = color, gridLines = TRUE)
      cp2 <- as.data.frame(cp)
      writeDataTable(wb, sheet = sheetname, x = cp2, colNames = TRUE,tableStyle="TableStyleLight2")
    }
  }
}
paste3 <- function(...,sep=", ") {
  L <- list(...)
  L <- lapply(L,function(x) {x[is.na(x)] <- ""; x})
  ret <-gsub(paste0("(^",sep,"|",sep,"$)"),"",
             gsub(paste0(sep,sep),sep,
                  do.call(paste,c(L,list(sep=sep)))))
  is.na(ret) <- ret==""
  ret
}
if ("Tm1" %in% colnames(df0) ) {
  df0$Tm <- paste3(df0$Tm1,df0$Tm2)
  for (run in unique(df0$Run)) {
    for (channel in unique(df0$Channel)) {
      cp <- cast(df0[df0$Run == run & df0$Channel == channel,], Row~Col,value = "Tm")
      # sheetname <- paste(substr(run,1,19),channel,"Tm")
      sheetname <- paste(substrRight(run,19),channel,"Tm")
      color <- rgb(runif(1),runif(1),runif(1))
      addWorksheet(wb, sheetName = sheetname, tabColour = color, gridLines = TRUE)
      cp2 <- as.data.frame(cp)
      writeDataTable(wb, sheet = sheetname, x = cp2, colNames = TRUE,tableStyle="TableStyleLight2")
    }
  }
}
saveWorkbook(wb, "PCRDATA.xlsx", overwrite = TRUE)
print("Workbook saved as PCRDATA.xlsx.")
print("Start to import experiment data.")
