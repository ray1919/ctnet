<!doctype html>
<html>
<head>
  <title>NGS Software List 2</title>
</head>
<body>
<h1 style="margin: 6px 0px 3px; font-size: 22.4px; font-weight: normal; color: rgb(51, 51, 51); font-family: arial, sans-serif;">Software</h1>

<ul style="margin: 0px 0px 0px 12px; padding-left: 16px; font-stretch: normal; font-size: 14px; font-family: arial, sans-serif; line-height: 18.2px; list-style: square outside none; color: rgb(51, 51, 51);">
  <li style="margin: 0px;"><a href="http://ccb.jhu.edu/software.shtml#nextgen" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">Next-Generation Sequence Alignment Software</a></li>
  <li style="margin: 0px;"><a href="http://ccb.jhu.edu/software.shtml#genefinding" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">Computational Gene Finding</a></li>
  <li style="margin: 0px;"><a href="http://ccb.jhu.edu/software.shtml#assembly" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">Genome Assembly and Large-Scale Genome alignment</a></li>
  <li style="margin: 0px;"><a href="http://ccb.jhu.edu/software.shtml#seqanalysis" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">Sequence Analysis Tools</a></li>
  <li style="margin: 0px;"><a href="http://ccb.jhu.edu/software.shtml#varanalysis" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">Variant Analysis Tools</a></li>
  <li style="margin: 0px;"><a href="http://ccb.jhu.edu/software.shtml#webservers" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">Webservers and Databases</a></li>
</ul>

<table cellspacing="5px" style="margin: 0px auto; color: rgb(51, 51, 51); font-family: arial, sans-serif; font-size: 14px;" width="98%">
  <tbody style="margin: 0px;">
    <tr style="margin: 0px;">
      <td colspan="3" style="margin: 0px;"><a name="nextgen" style="margin: 0px; color: rgb(17, 51, 153);"></a>

      <h4 style="margin: 12px 0px; font-size: 17.5px; padding: 2px 4px; background-image: url(&quot;img/h4bg.png&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0% 50%; background-repeat: no-repeat;">Next-generation sequence alignment software</h4>
      </td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://bowtie-bio.sf.net/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Bowtie</strong></a></td>
      <td style="margin: 0px;">An ultrafast, memory-efficient short read aligner that aligns short DNA sequences to the human genome at a rate of about 25 million reads per hour on a typical desktop computer. Bowtie indexes the genome with a Burrows-Wheeler index to keep its memory footprint small: 2.3 GB for the human genome. Bowtie and Bowtie2 were developed by Ben Langmead and are actively supported by his lab.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/tophat" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">TopHat</strong></a></td>
      <td style="margin: 0px;">A spliced alignment system for RNA-seq experiments. TopHat finds known and novel exon-exon splice junctions and is extremely fast due to its use of the Bowtie2 aligner. The latest release, TopHat2, runs with either Bowtie1 or Bowtie2 and includes new algorithms that significant enhance TopHat&#39;s sensitivity, particularly in the presence of pseudogenes. TopHat2 includes TopHat-Fusion as an option.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://tophat-fusion.sourceforge.net/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">TopHat-Fusion</strong></a></td>
      <td style="margin: 0px;">TopHat-Fusion is an enhanced version of TopHat with the ability to align reads across fusion points, which results from the breakage and re-joining of two different chromosomes, or from rearrangements within a chromosome.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/hisat" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">HISAT</strong></a></td>
      <td style="margin: 0px;">HISAT is a new, highly efficient system for aligning RNA-seq reads. HISAT uses a new indexing scheme, hierarchical indexing, which is inherently well-suited for aligning across introns. It employs two types of indexes for alignment: (1) a whole-genome FM index to anchor each alignment, and (2) numerous local FM indexes for very rapid extensions of these alignments. HISAT supports genomes of any size, including those larger than 4 billion bases.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/hisat2" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">HISAT2</strong></a></td>
      <td style="margin: 0px;">HISAT2 is a new, rapid and accurate system for aligning NGS reads (both DNA and RNA) against a population of genomes. HISAT2 is a successor to both HISAT and TopHat2. In this program, we extended the Burrows-Wheeler transform (BWT) and the Ferragina-Manzini (FM) index to incorporate genomic differences among individuals into the reference genome.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://cole-trapnell-lab.github.io/cufflinks/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Cufflinks</strong></a></td>
      <td style="margin: 0px;">A transcript assembler and abundance estimator for RNA-seq data. Cufflinks assembles transcripts from the alignments produced by TopHat, including novel isoforms, and quantitates those transcripts. Cufflinks was originally developed by Cole Trapnell and is supported by his lab at the University of Washington.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/stringtie" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">StringTie</strong></a></td>
      <td style="margin: 0px;">A new and fast transcript assembler and abundance estimator for RNA-seq data. Similar to Cufflinks, StringTie assembles transcripts from the alignments produced by TopHat, including novel isoforms, and quantitates those transcripts.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="https://github.com/alyssafrazee/ballgown" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Ballgown</strong></a></td>
      <td style="margin: 0px;">A program for computing differentially expressed genes in two or more RNA-seq experiments, using the output of StringTie or Cufflinks. The Ballgown package provides functions to organize, visualize, and analyze expression measurements. Ballgown is written in R and is part of Bioconductor.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://cloudburst-bio.sf.net/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">CloudBurst</strong></a></td>
      <td style="margin: 0px;">A program for highly sensitive short read mapping using MapReduce. CloudBurst, developed by Michael Schatz (now a faculty member at JHU Computer Science) uses&nbsp;<a href="http://hadoop.apache.org/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">Hadoop</a>&nbsp;to efficiently parallelize the short read mapping problem to dozens or hundreds of computers. This enables CloudBurst to execute highly sensitive read mappings with any number of mutations or indels.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://bowtie-bio.sf.net/crossbow" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Crossbow</strong></a></td>
      <td style="margin: 0px;">Crossbow is a scalable software pipeline for whole genome resequencing analysis. It combines&nbsp;<a href="http://bowtie-bio.sf.net/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">Bowtie</a>, an ultrafast and memory efficient short read aligner, and&nbsp;<a href="http://soap.genomics.org.cn/soapsnp.html" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">SoapSNP</a>, an accurate genotyper, within&nbsp;<a href="http://hadoop.apache.org/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">Hadoop</a>&nbsp;to distribute and accelerate the computation with many nodes. In&nbsp;<a href="http://genomebiology.com/2009/10/11/R134" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">the CrossBow paper</a>, we used it to analyze 35x coverage of a human genome in 3 hours for about $100 using a 40-node, 320-core cluster rented from<a href="http://aws.amazon.com/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">Amazon&#39;s EC2</a>&nbsp;utility computing service.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/diamund/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Diamund</strong></a></td>
      <td style="margin: 0px;">Diamund is a new, efficient algorithm for variant detection that compares DNA sequences directly to one another, without aligning them to the reference genome.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/EDGE-pro/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">EDGE-pro</strong></a></td>
      <td style="margin: 0px;">EDGE-pro is a program for estimating gene expression from prokaryotic RNA-seq. EDGE-pro uses Bowtie2 for alignment but, unlike TopHat and Cufflinks, does not allow spliced alignments. It also handles overlapping genes, a common phenomenon in bacteria that is largely absent in eukaryotes.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/kraken/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Kraken</strong></a></td>
      <td style="margin: 0px;">Kraken is a very fast system for taxonomic classification of short or long DNA sequences from a microbiome or metagenomic sample.&nbsp;<a href="http://genomebiology.com/2014/15/3/R46/abstract" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">See the 2014 Genome Biology paper here</a>.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td colspan="3" style="margin: 0px;"><a name="genefinding" style="margin: 0px; color: rgb(17, 51, 153);"></a>
      <h4 style="margin: 12px 0px; font-size: 17.5px; padding: 2px 4px; background: url(&quot;img/h4bg.png&quot;) 0% 50% no-repeat transparent;">Computational Gene Finding</h4>
      </td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;"><a href="http://ccb.jhu.edu/software/glimmer/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Glimmer</strong></a></div>
      </td>
      <td style="margin: 0px;">A system that uses interpolated Markov models to find genes in microbial DNA. Used to annotate hundreds (possibly thousands) of bacterial, archaeal, and viral genomes. Current version is 3.02.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/glimmerhmm/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">GlimmerHMM</strong></a></td>
      <td style="margin: 0px;">A Generalized Hidden Markov Model gene-finder which makes use of the techniques implemented previously by GlimmerM.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/genesplicer/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">GeneSplicer</strong></a></td>
      <td style="margin: 0px;">A fast system for detecting splice sites in genomic DNA of various eukaryotes.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/sim4cc/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">SIM4CC</strong></a></td>
      <td style="margin: 0px;">An accurate and efficient program to align cDNA sequences (mRNAs, ESTs) to genomic sequences, specifically designed for cross-species alignment.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://sourceforge.net/projects/kmer/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">sim4db / leaff</strong></a></td>
      <td style="margin: 0px;">Fast high-throughput&nbsp;<a href="http://bioinformatics.oxfordjournals.org/content/27/13/1869" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">spliced alignment</a>&nbsp;(sim4, sim4cc) and sequence indexing.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;"><a href="http://ccb.jhu.edu/software/ASprofile/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">ASprofile</strong></a></div>
      </td>
      <td style="margin: 0px;">A suite of programs for extracting, quantifying and comparing alternative splicing (AS) events from RNA-seq data.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;"><a href="http://ccb.jhu.edu/software/jigsaw/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">JIGSAW</strong></a></div>
      </td>
      <td style="margin: 0px;">A program that predicts gene models using the output from multiple sources of evidence, including other gene finders, Blast searches, and other alignment data.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td colspan="3" style="margin: 0px;"><a name="assembly" style="margin: 0px; color: rgb(17, 51, 153);"></a>
      <h4 style="margin: 12px 0px; font-size: 17.5px; padding: 2px 4px; background: url(&quot;img/h4bg.png&quot;) 0% 50% no-repeat transparent;">Genome assembly and large-scale genome alignment</h4>
      </td>
    </tr>
    <tr style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://gage.cbcb.umd.edu/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">GAGE</strong></a></td>
      <td style="margin: 0px;">A realistic assessment of genome assembly software in a rapidly changing field of next-generation sequencing.</td>
    </tr>
    <tr style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/gage_b/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">GAGE-B</strong></a></td>
      <td style="margin: 0px;">An evaluation of contiguity and accuracy of assemblies of bacterial organisms that are generated by some of most commonly used genome assemblers. GAGE-B follows the standards set by GAGE.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;"><a href="http://mummer.sourceforge.net/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">MUMmer</strong></a>&nbsp;</div>
      </td>
      <td style="margin: 0px;">A system for aligning whole genomes, chromosomes, and other very long DNA sequences. MUMmer is also widely used for comparing genome assemblies.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;"><a href="http://mummergpu.sourceforge.net/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">MUMmerGPU</strong></a></div>
      </td>
      <td style="margin: 0px;">High throughput sequence alignment using Graphics Processing Units (GPUs). Uses a technique called general-purpose GPU programming (GPGPU programming) to harness the extreme parallelism of GPUs for non-graphics tasks. In this application, hundreds of query sequences are simultaneously aligned to a reference sequence, creating an order of magnitude speed up over the same alignment on the CPU.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://amos.sourceforge.net/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">AMOS Assembler project</strong></a></td>
      <td style="margin: 0px;">This is a set of tools, libraries, and freestanding genome assemblers, all open source. AMOS is an open consortium started at The Institute for Genomic Research (TIGR) that now includes the University of Maryland, Johns Hopkins University, The Karolinska Institutet, the Marine Biological Laboratory, and others</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://amos.sourceforge.net/docs/pipeline/abba.html" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">ABBA</strong></a></td>
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;"><b style="margin: 0px;">A</b>ssembly&nbsp;<b style="margin: 0px;">B</b>oosted&nbsp;<b style="margin: 0px;">B</b>y&nbsp;<b style="margin: 0px;">A</b>mino acid sequence is a comparative gene assembler, which uses amino acid sequences from predicted proteins to help build a better assembly.&nbsp; See the<a href="http://www.ploscompbiol.org/article/info%3Adoi%2F10.1371%2Fjournal.pcbi.1000186" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">&nbsp;journal paper.</a><a href="http://amos.sourceforge.net/docs/pipeline/abba.html" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">&nbsp;Link for installation and more information.</a>.</div>
      </td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://amos.sourceforge.net/docs/pipeline/AMOScmp.html" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">AMOScmp</strong></a></td>
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;">is a comparative genome assembler, which uses one genome as a reference on which to assemble another, closely related species.&nbsp; See the<a href="http://ccb.jhu.edu/people/salzberg/docs/AMOScmp-reprint.pdf" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">&nbsp;journal paper here</a>.</div>
      </td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://amos.sourceforge.net/docs/pipeline/minimus.html" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">MINIMUS</strong></a>&nbsp;</td>
      <td style="margin: 0px;">A small, lightweight assembler for small jobs such as assembling a viral genome, assembling a set of reads that match a single gene, or other tasks that don&#39;t require the complex infrastructure of a large-genome assembler.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://amos.sourceforge.net/hawkeye/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Hawkeye</strong></a></td>
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;">A visual analytics tool for genome assembly analysis and validation, designed to aid in identifying and correcting assembly errors. All levels of the assembly data hierarchy are made accessible to users, along with summary statistics and common assembly metrics. A ranking component guides investigation towards likely mis-assemblies or interesting features to support the task at hand. Can be used to interactively analyze assemblies from many popular assemblers on your desktop computer.&nbsp;<a href="http://genomebiology.com/2007/8/3/R34" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">See the journal paper here.</a></div>
      </td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://sourceforge.net/apps/mediawiki/amos/index.php?title=AutoEditor" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">AutoEditor</strong></a></td>
      <td style="margin: 0px;">A tool for correcting sequencing and basecaller errors using sequence assembly and chromatogram data. On average AutoEditor corrects 80% of erroneous base calls, with an accuracy of 99.99%.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://wgs-assembler.sourceforge.net/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Celera Assembler</strong></a></td>
      <td style="margin: 0px;">A whole genome assembler originally developed at Celera Genomics for the assembly of the human genome.&nbsp; CeleraAssembler is now an open-source project at SourceForge.&nbsp; The code is actively maintained by researchers at&nbsp;<a href="http://www.cbcb.umd.edu/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">CBCB</a>&nbsp;and the&nbsp;<a href="http://www.venterscience.org/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">Venter Institute</a>&nbsp;(formerly known as TIGR, The Institute for Genomic Research).</td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/quake/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Quake</strong></a></td>
      <td style="margin: 0px;">A software package to detect and correct substitution sequencing errors in WGS data sets with deep coverage.</td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/FLASH/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">FLASH</strong></a></td>
      <td style="margin: 0px;">A fast accurate software to increase the length of reads by overlapping and merging mate pairs from fragments shorter than twice the length of reads.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td colspan="3" style="margin: 0px;"><a name="seqanalysis" style="margin: 0px; color: rgb(17, 51, 153);"></a>
      <h4 style="margin: 12px 0px; font-size: 17.5px; padding: 2px 4px; background: url(&quot;img/h4bg.png&quot;) 0% 50% no-repeat transparent;">Other sequence analysis tools</h4>
      </td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/BRCA-diagnostic/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">BRCA gene testing</strong></a></td>
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;">a computational screening test that takes the raw DNA sequence data from a whole-genome sequence of an individual human and tests for each of 68 known mutations in the BRCA1 and BRCA2 genes.</div>
      </td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/dive/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">DivE</strong></a></td>
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;">a software to find regions that evolve at a slower or faster rate than the neutral evolution rate in any clade of a phylogeny of a set of very closely related species.</div>
      </td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/duplocut/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">DupLoCut</strong></a></td>
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;">A software which computes ancestral gene orders under the duplication-loss evolutionary model.</div>
      </td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/ELPH/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">ELPH</strong></a></td>
      <td style="margin: 0px;">A motif finder based on Gibbs sampling that can find ribosome binding sites, exon splicing enhancers, or regulatory sites.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/fqtrim/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">fqtrim</strong></a></td>
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;">a software utility for filtering and trimming high-throughput next-gen reads.</div>
      </td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/stringtie/gff.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><b style="margin: 0px;">GFF utilities</b></a></td>
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;"><a href="http://ccb.jhu.edu/software/stringtie/gff.shtml#gffread" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">gffread</a>: a program for filtering, converting and manipulating GFF files</div>

      <div align="left" style="margin: 0px;"><a href="http://ccb.jhu.edu/software/stringtie/gff.shtml#gffcompare" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">gffcompare</a>: a program for comparing, annotating, merging and tracking transcripts in GFF files</div>
      </td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://insignia.cbcb.umd.edu/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Insignia</strong></a></td>
      <td style="margin: 0px;">A comprehensive system for finding unique DNA sequences that can be used to identify any bacterial or virus species or strain. Currently has over 13,000 species and strains in its database..</td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/kraken/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Kraken</strong></a></td>
      <td style="margin: 0px;">A fast system for taxonomic classification of short or long metagenomic DNA sequences.</td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/phymmbl/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">PhymmBL</strong></a></td>
      <td style="margin: 0px;">A one-stop system for taxonomically classifying metagenomic short reads.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;"><strong style="margin: 0px;"><a href="http://operondb.ccb.jhu.edu/cgi-bin/operons.cgi" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none; font-weight: 400;"><strong style="margin: 0px;">OperonDB</strong></a></strong></div>
      </td>
      <td style="margin: 0px;">Software and a database of operons covering a large number of prokaryotic genomes.&nbsp; Described in&nbsp;<a href="http://nar.oxfordjournals.org/cgi/content/full/37/suppl_1/D479" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">M. Pertea<span style="margin: 0px; font-style: italic;">et al</span>.,&nbsp;<span style="margin: 0px; font-style: italic;">Nucl. Acids Res</span>&nbsp;37 (2009), D479-D482</a>.</td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/rddChecker/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">rddChecker</strong></a></td>
      <td style="margin: 0px;">A program for determining sites of RNA-DNA differences (RDDs) and candidate RNA editing sites from RNA-seq data.</td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://www.cbcb.umd.edu/software/RepeatFinder/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">RepeatFinder</strong></a></td>
      <td style="margin: 0px;">an older system for finding and characterizing repetitive sequences in complete and partial genomes.</td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://www.cbcb.umd.edu/software/scimm" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">Scimm</strong></a></td>
      <td style="margin: 0px;">A tool for unsupervised clustering of metagenomic sequences using interpolated Markov models.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;"><a href="http://ccb.jhu.edu/software/SeeEse/index.shtml" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">SEE ESE</strong></a></td>
      <td style="margin: 0px;">an online tool for identifying exon splicing enhancers (ESEs) in Arabidopsis and Drosophila.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;"><a href="http://transterm.ccb.jhu.edu/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">TransTermHP</strong></a></div>
      </td>
      <td style="margin: 0px;">A highly accurate program that finds rho-independent transcription terminators in bacterial genomes. The site includes a database with pre-computed predictions for hundreds of species.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td colspan="3" style="margin: 0px;"><a name="varanalysis" style="margin: 0px; color: rgb(17, 51, 153);"></a>
      <h4 style="margin: 12px 0px; font-size: 17.5px; padding: 2px 4px; background: url(&quot;img/h4bg.png&quot;) 0% 50% no-repeat transparent;">Variant Analysis Tools</h4>
      </td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://wiki.chasmsoftware.org/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">CHASM and SNVBox</strong></a></td>
      <td style="margin: 0px;">Software to predict the functional sigificance of somatic missense mutations observed in the genomes of cancer cells, and a database of pre-computed features of all possible amino acid substitutions at every position of the annotated human exome.</td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://www.cravat.us/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">CRAVAT</strong></a></td>
      <td style="margin: 0px;">Cancer-related analysis of variants toolkit. Web tool for functional predictions and annotations of both somatic and germline variants.</td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="https://bitbucket.org/baderlab/fast/wiki/Home" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">FAST</strong></a></td>
      <td style="margin: 0px;">An application for genome-wide studies by efficiently running several gene based analysis methods simultaneously on the same data set.</td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://ls-snp.icm.jhu.edu/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">LS-SNP/PDB</strong></a></td>
      <td style="margin: 0px;">Web tool for structural annotations and visualizations of missense variants in dbSNP.</td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://mupit.icm.jhu.edu/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">muPIT</strong></a></td>
      <td style="margin: 0px;">Web tool for interactive structural annotations and visualizations of non-synonymous variation/mutation on proeins.</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td colspan="3" style="margin: 0px;"><a name="webservers" style="margin: 0px; color: rgb(17, 51, 153);"></a>
      <h4 style="margin: 12px 0px; font-size: 17.5px; padding: 2px 4px; background: url(&quot;img/h4bg.png&quot;) 0% 50% no-repeat transparent;">Other web servers and databases</h4>
      </td>
    </tr>
    <tr style="margin: 0px;">
      <td style="margin: 0px;"><a href="http://ardb.cbcb.umd.edu/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;"><strong style="margin: 0px;">ARDB</strong></a></td>
      <td style="margin: 0px;"><strong style="margin: 0px;">New in early 2009</strong>&nbsp;Antibiotic Resistance Genes Database</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td style="margin: 0px;">
      <div align="left" style="margin: 0px;"><strong style="margin: 0px;"><a href="http://enterix.cbcb.umd.edu/" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none; font-weight: 400;"><strong style="margin: 0px;">EnteriX</strong></a></strong></div>
      </td>
      <td style="margin: 0px;">Web servers for displaying alignments and annotations of bacterial genomes.&nbsp;</td>
    </tr>
    <tr bgcolor="#ffffff" style="margin: 0px;" valign="top">
      <td colspan="3" style="margin: 0px;"><a href="http://cbcb.umd.edu/~salzberg/appendixa.html" style="margin: 0px; color: rgb(17, 51, 153); text-decoration: none;">A collection of links (now very old) to external sequence analysis programs.</a></td>
    </tr>
  </tbody>
</table>
</body>
</html>

