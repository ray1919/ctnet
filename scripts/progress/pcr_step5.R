# Author: Zhao
# Date: 2015-10-21
# Purpose: automate the process of PCR data analysis
.libPaths(c("/home/zhaorui/R/x86_64-pc-linux-gnu-library/3.2",.libPaths()))
suppressPackageStartupMessages(library(openxlsx))
suppressPackageStartupMessages(library(reshape))
suppressPackageStartupMessages(library(ggplot2))
suppressPackageStartupMessages(library(scales))
suppressPackageStartupMessages(library(naturalsort))

options(stringsAsFactors = FALSE)
# go to work dir

args <- commandArgs(TRUE)

wd <- args[1]
report_id <- args[2]
setwd(wd)

load(".RData")

colIndex <- function(df, colId) {
  colname <- colnames(df)
  return(grep(colId,colname))
}

# save data Table 
wb <- createWorkbook(creator="CT Bioscience")
options("openxlsx.borderColour" = "#4F80BD")
options("openxlsx.borderStyle" = "thin")
modifyBaseFont(wb, fontSize = 10, fontName = "Arial Narrow")
headSty <- createStyle(fgFill="#DCE6F1", halign="center",
                       border = "TopBottomLeftRight")


# raw data sheet
addWorksheet(wb, sheetName = "Raw Data and QC", gridLines = FALSE, zoom = 150)
freezePane(wb, sheet = 1, firstRow = TRUE, firstCol = TRUE)
## freeze first row and column
writeDataTable(wb, sheet = 1, x = dataTbl, colNames = TRUE,
               rowNames = FALSE, tableStyle = "TableStyleLight9")

if (array_type == "gene") {
  # gene sheet
  addWorksheet(wb, sheetName = "Gene Table", gridLines = FALSE, zoom = 150)
  freezePane(wb, sheet = "Gene Table", firstRow = TRUE,
             firstCol = F) ## freeze first row and column
  setColWidths(wb, sheet = 2, cols = "D", widths = 50)
  setColWidths(wb, sheet = 2, cols = "F", widths = 20)
  setColWidths(wb, sheet = 2, cols = "G", widths = 13)
  writeData(wb, sheet = "Gene Table", x = geneTbl, startCol = "A", startRow=1,
            borders="rows", headerStyle = headSty)
}

# raw sheet
addWorksheet(wb, sheetName = "Data Table", gridLines = FALSE, zoom = 150)
freezePane(wb, sheet = "Data Table", firstActiveRow = 3,firstActiveCol = 'B')
## freeze first row and column
writeData(wb, "Data Table", x = rawTbl, startCol = "A", startRow=2, borders="rows",
          headerStyle = headSty)
writeData(wb, "Data Table", x = "CT", startCol = 4, startRow = 1)
writeData(wb, "Data Table", x = "TM", startCol = sum(schema3[,10]) + 4, startRow = 1)
writeData(wb, "Data Table", x = "QC", startCol = 2*sum(schema3[,10]) + 4, startRow = 1)
s1 <- createStyle(fontSize=14, textDecoration=c("bold", "italic"))
addStyle(wb, "Data Table", style = s1, rows=c(1,1,1), cols=(0:2) * sum(schema3[,9]) + 4)

addWorksheet(wb, sheetName = "Assay QC", gridLines = FALSE, zoom = 150)
freezePane(wb, sheet = "Assay QC", firstRow = T, firstCol = F)
writeData(wb, sheet = "Assay QC", x = assayQC, startCol = "A", startRow=1,
          borders="rows", headerStyle = headSty)

addWorksheet(wb, sheetName = "Sample QC", gridLines = FALSE, zoom = 150)
freezePane(wb, sheet = "Sample QC", firstRow = T, firstCol = F)
writeData(wb, sheet = "Sample QC", x = sampleQC, startCol = "A", startRow=1,
          borders="rows", headerStyle = headSty)

# ΔΔCT compare
for (i in 1:nrow(schema4)) {
  if (nrow(schema4) == 0) break
  A <- schema4$A[i]
  B <- schema4$B[i]
  
  cmp_name <- paste(A,"vs",B,sep=" ")
  sheet_name <- substr(cmp_name,1,31)
  addWorksheet(wb, sheetName = sheet_name, gridLines = FALSE, zoom = 150)
  freezePane(wb, sheet = sheet_name, firstRow = T, firstCol = F)
  UpStyle <- createStyle(textDecoration = "bold", fontColour = "#9C0006")
  DownStyle <- createStyle(textDecoration = "bold", fontColour = "#006100")
  
  # deltaTbl <- data.frame(symbol=character(),sample=character(),deltaCt=numeric())
  plotxy <- data.frame()
  
  if (A %in% all_samples[sample_analysis] & B %in% all_samples[sample_analysis]) {
    print("sample compare")
    deltaTbl <- deltaCt[deltaCt$sample %in% c(A,B), ]
    ddCt <- cast(deltaTbl, symbol~sample,value = "delta_ct")
    ddCt$delta.delta.Ct <- NA
    for ( t in 1:nrow(ddCt) ) {
      ddCt[t,"delta.delta.Ct"] = ddCt[t, A] - ddCt[t, B]
      ddCt[t, "ratio"] = 2 ^ (-1 * ddCt[t,"delta.delta.Ct"])
      ddCt[t, "log ratio"] = -1 * ddCt[t,"delta.delta.Ct"]
      ddCt[t, "fold change"] = ddCt[t,"ratio"]
      if (!is.na(ddCt[t,"ratio"]))
        if (ddCt[t,"ratio"] < 1)
          ddCt[t, "fold change"] = -1/ddCt[t,"ratio"]
    }
    ddCt <- ddCt[,c("symbol",A,B,"delta.delta.Ct", "ratio","log ratio","fold change")]
    # plotxy <- data.frame(A = 2^-ddCt[, A], B = 2^-ddCt[, B], C = log2(2^-ddCt[, A] / 2^-ddCt[, B]))
    plotxy <- data.frame(A = -ddCt[, A], B = -ddCt[, B],
                         C = log2(2^-ddCt[, A] / 2^-ddCt[, B]))
  }
  else if (A %in% all_groups & B %in% all_groups) {
    print("group compare")
    sA <- all_samples[all_groups==A & sample_analysis]
    sB <- all_samples[all_groups==B & sample_analysis]

    deltaTbl <- deltaCt[deltaCt$sample %in% c(sA,sB), ]
    ddCt <- cast(deltaTbl, symbol~sample,value = "delta_ct")
    # 样本名自然排序
    ddCt <- ddCt[,c("symbol",naturalsort(colnames(ddCt[,-1])))]
    print("calculate delta Ct")
    for ( t in nrow(ddCt):1 ) {
      if ( length(na.omit(as.numeric(ddCt[t, sA]))) < 2 |
           length(na.omit(as.numeric(ddCt[t, sB]))) < 2) {
        ddCt <- ddCt[-t,]
        next
      }
      ddCt[t,"delta.delta.Ct"] =  mean(as.numeric(ddCt[t, sA]), na.rm=T) -
                                  mean(as.numeric(ddCt[t, sB]), na.rm=T)
      ddCt[t, "ratio"] = 2 ^ (-1 * ddCt[t,"delta.delta.Ct"])
      ddCt[t, "log ratio"] = -1 * ddCt[t,"delta.delta.Ct"]
      ddCt[t, "fold change"] = ddCt[t,"ratio"]
      if (ddCt[t,"ratio"] < 1)
        ddCt[t, "fold change"] = -1/ddCt[t,"ratio"]
      if (grepl(x = schema4$IsPaired[i], pattern = "Y", ignore.case = T) ) {
        pdata <- data.frame(g1=as.numeric(ddCt[t, sA]),g2=as.numeric(ddCt[t, sB]) )
        if (nrow(na.omit(pdata)) >= 2)
          pval <- t.test(pdata$g1, pdata$g2, paired = TRUE, var.equal = TRUE)$p.value
        else
          pval <- NA
      } else
        pval <- t.test(as.numeric(ddCt[t, sA]), as.numeric(ddCt[t, sB]), paired = FALSE, var.equal = TRUE)$p.value
      ddCt[t, "p value"] <- pval
    }
    # plotxy <- data.frame(A = 2^-apply(ddCt[, sA], 1,mean), B = 2^-apply(ddCt[, sB], 1,mean),
    plotxy <- data.frame(A = -apply(ddCt[, sA], 1, mean, na.rm=T),
                         B = -apply(ddCt[, sB], 1, mean, na.rm=T),
          C = log2(2^-apply(ddCt[, sA], 1,mean, na.rm=T) / 2^-apply(ddCt[, sB], 1,mean, na.rm=T)))
    pv_col = colIndex(ddCt, "p value")
    conditionalFormatting(wb, sheet_name, cols=pv_col, rows = 2:nrow(ddCt),
                          rule="<0.05", style = UpStyle)
  }
  else {
    print(paste("Compare",i,"is not supported.",sep=" "))
  }

  setColWidths(wb, sheet = sheet_name, cols = 1:ncol(ddCt), widths = 10)
  writeData(wb, sheet_name, x = ddCt[,1:ncol(ddCt)], startCol = "A", startRow=1,
            borders="rows", headerStyle = headSty)
  
  print("make scatter plot.")
  d <- qplot(data=plotxy, x = B, y= A, xlab=B,ylab=A,colour= C,size=0.8)
  p <- ggplot(plotxy, aes(B, A,color = plotxy$C)) +
    geom_point( size = 1) +
    geom_abline(intercept = 1, color="firebrick1") +
    geom_abline(intercept = -1, color="limegreen") +
    xlab(B) + ylab(A) +
    scale_colour_gradient2("log2 ratio", midpoint = 0,#, limits=c(-2, 2)
          low = muted("green"), mid = "snow3", high = muted("red")) +
          theme_bw()
  pngfile = paste(A,B,".png",sep="")
  png(filename = pngfile,width=6,height=5,units="in",res=300)
  print(p)
  dev.off()
  # insertPlot(wb, sheet = 3+i, startCol = ncol(ddCt) + 2)
  insertImage(wb = wb, sheet = sheet_name, file = pngfile, width = 6, 
              height = 5, startRow = 2, startCol = ncol(ddCt) + 1, 
              units = "in", dpi = 300)
  
  if (length(symbolList) >= 384) {
    # make volcano plot
    dat1 <- data.frame(x=as.numeric(ddCt$`log ratio`), y=-log10(ddCt$`p value`), ID=ddCt$symbol)
    dat2 <- na.omit(dat1)
    if (array_type == "miRNA") {
      dat2$ID <- sub(pattern = "^...-", replacement = "", x = dat2$ID,perl = T)
    }
    mask <-  with(dat2, y>-log10(0.05) & abs(x)>1)
    cols <- ifelse(mask, "firebrick1", "grey")
    p2 <- ggplot(dat2, aes(x, y, label= ID)) +
      geom_point(color = cols, size = 0.8) +
      geom_vline(xintercept = 1, color = "dodgerblue", linetype="longdash") + #add vertical line
      geom_vline(xintercept = -1, color = "dodgerblue", linetype="longdash") + #add vertical line
      geom_hline(yintercept = -log10(0.05), color = "deeppink", linetype="longdash") +  #add vertical line
      labs(x="log2(Fold-change)", y="-log10(P.Value)") + 
      scale_x_continuous("log2(Fold-change)") +
      scale_y_continuous("-log10(P.Value)", limits = range(0,max(dat2$y)+0.2)) +
      annotate("text", x=dat2$x[mask], y=dat2$y[mask], 
               label=dat2$ID[mask], size=dat2$y[mask], 
               vjust=-0.1, hjust=-0.1, color="lightsteelblue4") +
      theme_bw()
    pngfile2 = paste(A,B,".vp.png",sep="")
    png(filename = pngfile2,width=5,height=5,units="in",res=300)
    print(p2)
    dev.off()
    # insertPlot(wb, sheet = 3+i, startCol = ncol(ddCt) + 2)
    insertImage(wb = wb, sheet = sheet_name, file = pngfile2, width = 5, 
                height = 5, startRow = 30, startCol = ncol(ddCt) + 1, 
                units = "in", dpi = 300)
  }
  # conditional formatting
  log_col = colIndex(ddCt, "log ratio")
  fc_cf_col = colIndex(ddCt, "fold change")
  conditionalFormatting(wb, sheet_name, cols=log_col, rows = 1:nrow(ddCt)+1,
                        rule=">=1", style = UpStyle)
  conditionalFormatting(wb, sheet_name, cols=log_col, rows = 1:nrow(ddCt)+1,
                        rule="<=-1", style = DownStyle)
  conditionalFormatting(wb, sheet_name, cols=fc_cf_col, rows = 1:nrow(ddCt)+1,
                        rule=">=2", style = UpStyle)
  conditionalFormatting(wb, sheet_name, cols=fc_cf_col, rows = 1:nrow(ddCt)+1,
                        rule="<=-2", style = DownStyle)
  
  # number formatting
  twodigit <- createStyle(numFmt = "0.00",border="Bottom")
  addStyle(wb, sheet_name, style = twodigit, cols = 2:fc_cf_col,
           rows = 1:nrow(ddCt)+1, gridExpand = T)
  
  # fig lengend
  #note <- "上图是对两个样本间每个基因的相对表达比值(2-ΔCT)的LOG2转换值做散点图。每个点以该基因的LOG表达比值LOG2(ratio)用颜色表示其差异倍数。红色越深，图上越靠近左上方为上调倍数越大，绿色越深，图上越靠近右下方为下调倍数越大。颜色越浅， 差异倍数越小。注：未表达或表达异常的基因未包括在图中。"
  #com <- createComment(comment = note, author = "CT Bioscience", style = NULL,
  #              visible = TRUE, width = 7, height = 4)
  #writeComment(wb = wb, sheet = sheet_name, col = ncol(ddCt)+2,row = 29, comment = com)
}

print("Add note sheet.")

addWorksheet(wb, sheetName = "QC Plot", gridLines = FALSE, zoom = 150)
writeData(wb, sheet = "QC Plot", x = c("QC quality (sum of following conditions):",
                                "1  TM outlier compare to archive data",
                                "2  none GDC CT > 35 or GDC CT < 35",
                                "4  Double Peak",
                                "8  TM outlier among same batch data",
                                "16 Detector Call uncertain/Late Cp call",
                                "32 No Detect"))

# check bad gene & bad sample
qc.matrix <- as.matrix(rawQc[,-1])
gene.qc <- apply(X = qc.matrix, MARGIN = 1, FUN = sum, na.rm=T)

dataTbl$symbol <- factor(dataTbl$symbol, levels = rawQc$symbol[order(gene.qc)], ordered = T)

# class(dataTbl$sample)
dataTbl$sample <- factor(dataTbl$sample, levels = naturalsort(unique(dataTbl$sample)))
p2 <- ggplot(dataTbl[order(dataTbl$symbol),], aes(sample, symbol, fill = qual)) +
  geom_tile( colour = "white") +
  labs(x = "Sample", y = "Gene") +
  theme(axis.text.x = element_text(angle = 90)) + 
  scale_fill_gradient(low = "white", high = "steelblue")
qcpngfile = "qcheatmap.png"
png(filename = qcpngfile,width = length(sample_analysis)/5 + 4, height = 11,units="in",res=300)
print(p2)
dev.off()
insertImage(wb = wb, sheet = "QC Plot", file = qcpngfile,
            width = length(sample_analysis)/5 + 4, height = 11,
            startRow = 1, startCol = 3,  units = "in", dpi = 300)

# Boxplot
addWorksheet(wb, sheetName = "CT BOXPLOT", gridLines = FALSE, zoom = 150)
p4 <- ggplot(dataTbl[order(dataTbl$symbol),], aes(x=sample, y=ct, fill=sample)) +
  geom_boxplot(color="darkgray", alpha=0.1,outlier.shape = NA) +
  geom_jitter(width = 0.5, color="lightcoral", alpha=0.7) +
  labs(x = "Sample", y = "CT Value") +
  theme_bw() + 
  theme(axis.text.x = element_text(angle = 90)) +
  guides(fill=FALSE)
boxpngfile = "boxplot.png"
png(filename = boxpngfile,width = length(sample_analysis)/5 + 4, height = 5,units="in",res=300)
print(p4)
dev.off()
insertImage(wb = wb, sheet = "CT BOXPLOT", file = boxpngfile,
            width = length(sample_analysis)/5 + 4, height = 5,
            startRow = 1, startCol = 1,  units = "in", dpi = 300)

# Heatmap
addWorksheet(wb, sheetName = "HEATMAP PLOT", gridLines = FALSE, zoom = 150)
if (normalization.method == "HK") {
  writeData(wb, sheet = "HEATMAP PLOT", c("Valid house-keeping gene:",na.omit(hks_valid)))
}
deltaCt$sample <- factor(deltaCt$sample, levels = naturalsort(unique(deltaCt$sample)))
p3 <- ggplot(deltaCt[order(deltaCt$symbol),], aes(sample, symbol, fill = delta_ct)) +
  geom_tile( colour = "white") +
  labs(x = "Sample", y = "Gene") +
  theme(axis.text.x = element_text(angle = 90)) + 
  guides(fill=guide_legend(title="Delta CT")) +
  scale_fill_gradient2(low = "brown1", mid="white", high = "lightgreen",
                       midpoint = median(deltaCt$delta_ct, na.rm = T))
dctpngfile = "dctheatmap.png"
png(filename = dctpngfile, width = length(sample_analysis)/5 + 4, height = 11,
    units="in", res=300)
print(p3)
dev.off()
insertImage(wb = wb, sheet = "HEATMAP PLOT", file = dctpngfile,
            width = length(sample_analysis)/5 + 4, height = 11,
            startRow = 1, startCol = 3,  units = "in", dpi = 300)

saveWorkbook(wb, "workbook.xlsx", overwrite = TRUE)
unlink("*.png")

print("Workbook saved as workbook.xlsx.")
# print(paste("Start to import experiment data. Estimated miniutes:", sum(schema3[,6] / 96) * 0.75))
