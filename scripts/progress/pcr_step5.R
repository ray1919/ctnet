# Author: Zhao
# Date: 2015-10-21
# Purpose: automate the process of PCR data analysis
.libPaths(c("/home/zhaorui/R/x86_64-unknown-linux-gnu-library/3.1",.libPaths()))
suppressPackageStartupMessages(library(openxlsx))
suppressPackageStartupMessages(library(reshape))
suppressPackageStartupMessages(library(ggplot2))
suppressPackageStartupMessages(library(scales))
options(stringsAsFactors = FALSE)
# go to work dir

args <- commandArgs(TRUE)

wd <- args[1]
report_id <- args[2]
setwd(wd)

load(".RData")

# save data Table 
wb <- createWorkbook(creator="CT Bioscience")
options("openxlsx.borderColour" = "#4F80BD")
options("openxlsx.borderStyle" = "thin")
modifyBaseFont(wb, fontSize = 10, fontName = "Arial Narrow")


# raw data sheet
addWorksheet(wb, sheetName = "Raw Data and QC", gridLines = FALSE, zoom = 150)
freezePane(wb, sheet = 1, firstRow = TRUE, firstCol = TRUE) ## freeze first row and column
writeDataTable(wb, sheet = 1, x = dataTbl, colNames = TRUE,
               rowNames = FALSE, tableStyle = "TableStyleLight9")


# gene sheet
addWorksheet(wb, sheetName = "Gene Table", gridLines = FALSE, zoom = 150)
freezePane(wb, sheet = "Gene Table", firstRow = TRUE,
           firstCol = F) ## freeze first row and column
setColWidths(wb, sheet = 2, cols = "C", widths = 50)
setColWidths(wb, sheet = 2, cols = "E", widths = 20)
setColWidths(wb, sheet = 2, cols = "F", widths = 13)
headSty <- createStyle(fgFill="#DCE6F1", halign="center", border = "TopBottomLeftRight")
writeData(wb, 2, x = geneTbl, startCol = "A", startRow=1, borders="rows",
          headerStyle = headSty)


# raw sheet
addWorksheet(wb, sheetName = "Data Table", gridLines = FALSE, zoom = 150)
freezePane(wb, sheet = "Data Table", firstRow = TRUE,
           firstCol = F) ## freeze first row and column
writeData(wb, 3, x = rawTbl, startCol = "A", startRow=2, borders="rows",
          headerStyle = headSty)
writeData(wb, 3, x = "CT", startCol = 3, startRow = 1)
writeData(wb, 3, x = "TM", startCol = sum(schema3[,9]) + 3, startRow = 1)
writeData(wb, 3, x = "QC", startCol = 2*sum(schema3[,9]) + 3, startRow = 1)
s1 <- createStyle(fontSize=14, textDecoration=c("bold", "italic"))
addStyle(wb, 3, style = s1, rows=c(1,1,1), cols=(0:2) * sum(schema3[,9]) + 3)

# ΔΔCT compare
for (i in 1:nrow(schema4)) {
  A <- schema4$A[i]
  B <- schema4$B[i]
  deltaTbl <- data.frame(symbol=character(),sample=character(),deltaCt=numeric())
  plotxy <- data.frame()
  if (A %in% all_samples & B %in% all_samples) {
    print("sample compare")
    for (k in c(A,B) ) {
      hks_avg_ct <- mean(rawCt[rawCt$symbol %in% hks_valid,k])
      for (j in geneTbl$Symbol ) {
        # skip HK genes
        if (j %in% schema2$Housekeeping.Gene.Symbol)
          next
        # skip QC failed genes
        if (any(dataTbl[dataTbl$symbol == j,"qual"] >= qc_cutoff) )
          next
        ct_raw <- rawCt[rawCt$symbol == j,k]
        delta_ct <- ct_raw - hks_avg_ct
        deltaTbl <- insertRow(deltaTbl, c(j,k,delta_ct))
      }
    }
    deltaTbl$deltaCt <- as.numeric(deltaTbl$deltaCt)
    ddCt <- cast(deltaTbl, symbol~sample,value = "deltaCt")
    ddCt$delta.delta.Ct <- NA
    for ( t in 1:nrow(ddCt) ) {
      ddCt[t,"delta.delta.Ct"] = ddCt[t, A] - ddCt[t, B]
      ddCt[t, "ratio"] = 2 ^ (-1 * ddCt[t,"delta.delta.Ct"])
      ddCt[t, "log ratio"] = -1 * ddCt[t,"delta.delta.Ct"]
      ddCt[t, "fold change"] = ddCt[t,"ratio"]
      if (ddCt[t,"ratio"] < 1)
        ddCt[t, "fold change"] = -1/ddCt[t,"ratio"]
    }
    # plotxy <- data.frame(A = 2^-ddCt[, A], B = 2^-ddCt[, B], C = log2(2^-ddCt[, A] / 2^-ddCt[, B]))
    plotxy <- data.frame(A = -ddCt[, A], B = -ddCt[, B],
                         C = log2(2^-ddCt[, A] / 2^-ddCt[, B]))
  }
  else if (A %in% all_groups & B %in% all_groups) {
    print("group compare")
    sA <- all_samples[all_groups==A]
    sB <- all_samples[all_groups==B]
    for (k in c(sA,sB) ) {
      hks_avg_ct <- mean(rawCt[rawCt$symbol %in% hks_valid,k])
      for (j in geneTbl$Symbol ) {
        # skip HK genes
        if (j %in% schema2$Housekeeping.Gene.Symbol)
          next
        # skip QC failed genes
        if (any(dataTbl[dataTbl$symbol == j,"qual"] >= qc_cutoff) )
          next
        ct_raw <- rawCt[rawCt$symbol == j,k]
        delta_ct <- ct_raw - hks_avg_ct
        # deltaTbl <- insertRow(deltaTbl, c(j,k,delta_ct))
        deltaTbl <- rbind(deltaTbl,c(j,k,delta_ct))
      }
    }
    colnames(deltaTbl) <- c('symbol','sample','deltaCt')
    deltaTbl$deltaCt <- as.numeric(deltaTbl$deltaCt)
    ddCt <- cast(deltaTbl, symbol~sample,value = "deltaCt")
    for ( t in 1:nrow(ddCt) ) {
      ddCt[t,"delta.delta.Ct"] = mean(unlist(ddCt[t, sA])) - mean(unlist(ddCt[t, sB]))
      ddCt[t, "ratio"] = 2 ^ (-1 * ddCt[t,"delta.delta.Ct"])
      ddCt[t, "log ratio"] = -1 * ddCt[t,"delta.delta.Ct"]
      ddCt[t, "fold change"] = ddCt[t,"ratio"]
      if (ddCt[t,"ratio"] < 1)
        ddCt[t, "fold change"] = -1/ddCt[t,"ratio"]
      tt <- t.test(ddCt[t, sA],ddCt[t, sB])
      ddCt[t, "p value"] <- tt$p.value
    }
    # plotxy <- data.frame(A = 2^-apply(ddCt[, sA], 1,mean), B = 2^-apply(ddCt[, sB], 1,mean),
    plotxy <- data.frame(A = -apply(ddCt[, sA], 1,mean), B = -apply(ddCt[, sB], 1,mean),
                        C = log2(2^-apply(ddCt[, sA], 1,mean) / 2^-apply(ddCt[, sB], 1,mean)))
  }
  else {
    print(paste("Compare",i,"is not supported.",sep=" "))
  }
  sheet_name <- substr(paste(A,"vs",B,sep=" "),1,31)
  addWorksheet(wb, sheetName = sheet_name, gridLines = FALSE, zoom = 150)
  freezePane(wb, sheet = sheet_name, firstRow = TRUE,
             firstCol = F) ## freeze first row and column
  setColWidths(wb, sheet = 3+i, cols = 1:ncol(ddCt), widths = 10)
  writeData(wb, sheet_name, x = ddCt[,1:ncol(ddCt)], startCol = "A", startRow=1, borders="rows",
            headerStyle = headSty)
  d <- qplot(data=plotxy, x = B, y= A, xlab=B,ylab=A,colour= C)
  p <- d + scale_colour_gradient2("log2 ratio",limits=c(-2, 2),low = muted("green"), mid = "white", high = muted("red"))
  pngfile = paste(A,B,".png",sep="")
  png(filename = pngfile,width=5,height=4,units="in",res=300)
  print(p)
  dev.off()
  # insertPlot(wb, sheet = 3+i, startCol = ncol(ddCt) + 2)
  insertImage(wb = wb, sheet = 3+i, file = pngfile, width = 6, 
              height = 5, startRow = 1, startCol = ncol(ddCt) + 1, 
              units = "in", dpi = 300)
}

saveWorkbook(wb, "workbook.xlsx", overwrite = TRUE)
unlink("*.png")

print("Workbook saved as workbook.xlsx.")
print(paste("Start to import experiment data. Estimated miniutes:", sum(schema3[,6] / 96) * 0.75))
