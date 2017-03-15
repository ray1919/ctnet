<article id="post-36" class="post-36 post type-post status-publish format-standard hentry category-computational-biology category-statistics-2">
    <header>
      
              <time datetime="2014-05-08T18:55:06+00:00">May 8, 2014</time>
      
              <h1>What the FPKM? A review of RNA-Seq expression&nbsp;units</h1>
          </header>

    <div class="content">
      <p>This post covers the units used in RNA-Seq that are, unfortunately, often misused and misunderstood. I’ll try to clear up a bit of the confusion here.</p>
<p>The first thing one should remember is that without between sample normalization (a topic for a later post), <strong>NONE of these units are comparable across experiments. This is a result of RNA-Seq being a relative measurement, not an absolute one.</strong></p>
<h2>Preliminaries</h2>
<p>Throughout this post “read” refers to both single-end or paired-end reads. The concept of counting is the same with either type of read, as each read represents a fragment that was sequenced.</p>
<p>When saying “feature”, I’m referring to an expression feature, by which I mean a genomic region containing a sequence that can normally appear in an RNA-Seq experiment (e.g. gene, isoform, exon).</p>
<p>Finally, I use the random variable <img src="https://s0.wp.com/latex.php?latex=X_i&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="X_i" title="X_i" class="latex"> to denote the counts you observe from a feature of interest <img src="https://s0.wp.com/latex.php?latex=i&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="i" title="i" class="latex">. Unfortunately, with alternative splicing you do not directly observe <img src="https://s0.wp.com/latex.php?latex=X_i&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="X_i" title="X_i" class="latex">, so often <img src="https://s0.wp.com/latex.php?latex=%5Cmathbb+E%5BX_i%5D&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="\mathbb E[X_i]" title="\mathbb E[X_i]" class="latex"> is used, which is estimated using the EM algorithm by a method like <a href="http://bio.math.berkeley.edu/express/">eXpress</a>, <a href="http://deweylab.biostat.wisc.edu/rsem/">RSEM</a>, <a href="http://www.cs.cmu.edu/~ckingsf/software/sailfish/">Sailfish</a>, <a href="http://cufflinks.cbcb.umd.edu/">Cufflinks</a>, or one of many other tools. </p>
<hr>
<h2>Counts</h2>
<p>“Counts” usually refers to the number of reads that align to a particular feature. I’ll refer to counts by the random variable <img src="https://s0.wp.com/latex.php?latex=X_i&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="X_i" title="X_i" class="latex">. These numbers are heavily dependent on two things: (1) the amount of fragments you sequenced (this is related to relative abundances) and (2) the length of the feature, or more appropriately, the effective length. Effective length refers to the number of possible start sites a feature could have generated a fragment of that particular length. In practice, the effective length is usually computed as:</p>
<p align="center">
<img src="https://s0.wp.com/latex.php?latex=%5Cwidetilde%7Bl%7D_i+%3D+l_i+-+%5Cmu_%7BFLD%7D+%2B+1&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="\widetilde{l}_i = l_i - \mu_{FLD} + 1" title="\widetilde{l}_i = l_i - \mu_{FLD} + 1" class="latex">,
</p>
<p>where <img src="https://s0.wp.com/latex.php?latex=%5Cmu_%7BFLD%7D&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="\mu_{FLD}" title="\mu_{FLD}" class="latex"> is the mean of the fragment length distribution which was learned from the aligned read. If the abundance estimation method you’re using incorporates sequence bias modeling (such as eXpress or Cufflinks), the bias is often incorporated into the effective length by making the feature shorter or longer depending on the effect of the bias.</p>
<p><strong>Since counts are NOT scaled by the length of the feature, all units in this category are not comparable within a sample without adjusting for the feature length.</strong> This means you can’t sum the counts over a set of features to get the expression of that set (e.g. you can’t sum isoform counts to get gene counts).</p>
<p>Counts are often used by differential expression methods since they are naturally represented by a counting model, such as a negative binomial (NB2).</p>
<h3>Effective counts</h3>
<p>When eXpress came out, they began reporting “effective counts.” This is basically the same thing as standard counts, with the difference being that they are adjusted for the amount of bias in the experiment. To compute effective counts:</p>
<p align="center">
<img src="https://s0.wp.com/latex.php?latex=%5Ctext%7BeffCounts%7D_i+%3D+X_i+%5Ccdot+%5Cdfrac%7Bl_i%7D%7B%5Cwidetilde%7Bl%7D_i%7D&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="\text{effCounts}_i = X_i \cdot \dfrac{l_i}{\widetilde{l}_i}" title="\text{effCounts}_i = X_i \cdot \dfrac{l_i}{\widetilde{l}_i}" class="latex">.
</p>
<p>The intuition here is that if the effective length is much shorter than the actual length, then in an experiment with no bias you would expect to see more counts. Thus, the effective counts are scaling the observed counts up.</p>
<h3>Counts per million</h3>
<p>Counts per million (CPM) mapped reads are counts scaled by the number of fragments you sequenced (<img src="https://s0.wp.com/latex.php?latex=N&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="N" title="N" class="latex">) times one million. This unit is related to the FPKM without length normalization and a factor of <img src="https://s0.wp.com/latex.php?latex=10%5E3&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="10^3" title="10^3" class="latex">:</p>
<p align="center">
<img src="https://s0.wp.com/latex.php?latex=%5Ctext%7BCPM%7D_i+%3D+%5Cdfrac%7BX_i%7D%7B%5Cdfrac%7BN%7D%7B10%5E6%7D%7D+%3D+%5Cdfrac%7BX_i%7D%7BN%7D%5Ccdot+10%5E6+&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="\text{CPM}_i = \dfrac{X_i}{\dfrac{N}{10^6}} = \dfrac{X_i}{N}\cdot 10^6 " title="\text{CPM}_i = \dfrac{X_i}{\dfrac{N}{10^6}} = \dfrac{X_i}{N}\cdot 10^6 " class="latex">
</p>
<p>I’m not sure where this unit first appeared, but I’ve seen it used with <a href="http://www.bioconductor.org/packages/release/bioc/html/edgeR.html">edgeR</a> and talked about briefly in the <a href="http://genomebiology.com/2014/15/2/R29">limma voom paper</a>. </p>
<hr>
<h2>Within sample normalization</h2>
<p>As noted in the counts section, the number of fragments you see from a feature depends on its length. Therefore, in order to compare features of different length you should normalize counts by the length of the feature. Doing so allows the summation of expression across features to get the expression of a group of features (think a set of transcripts which make up a gene).</p>
<p>Again, the methods in this section allow for comparison of features with different length WITHIN a sample but not BETWEEN samples. </p>
<h3>TPM</h3>
<p>Transcripts per million (TPM) is a measurement of the proportion of transcripts in your pool of RNA. </p>
<p>Since we are interested in taking the length into consideration, a natural measurement is the rate, counts per base (<img src="https://s0.wp.com/latex.php?latex=X_i+%2F+%5Cwidetilde%7Bl%7D_i&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="X_i / \widetilde{l}_i" title="X_i / \widetilde{l}_i" class="latex">). As you might immediately notice, this number is also dependent on the total number of fragments sequenced. To adjust for this, simply divide by the sum of all rates and this gives the proportion of transcripts <img src="https://s0.wp.com/latex.php?latex=i&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="i" title="i" class="latex"> in your sample. After you compute that, you simply scale by one million because the proportion is often very small and a pain to deal with. In math:</p>
<p align="center">
<img src="https://s0.wp.com/latex.php?latex=%5Ctext%7BTPM%7D_i+%3D+%5Cdfrac%7BX_i%7D%7B%5Cwidetilde%7Bl%7D_i%7D+%5Ccdot+%5Cleft%28+%5Cdfrac%7B1%7D%7B%5Csum_j+%5Cdfrac%7BX_j%7D%7B%5Cwidetilde%7Bl%7D_j%7D%7D+%5Cright%29+%5Ccdot+10%5E6&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="\text{TPM}_i = \dfrac{X_i}{\widetilde{l}_i} \cdot \left( \dfrac{1}{\sum_j \dfrac{X_j}{\widetilde{l}_j}} \right) \cdot 10^6" title="\text{TPM}_i = \dfrac{X_i}{\widetilde{l}_i} \cdot \left( \dfrac{1}{\sum_j \dfrac{X_j}{\widetilde{l}_j}} \right) \cdot 10^6" class="latex">.
</p>
<p>TPM has a very nice interpretation when you’re looking at transcript abundances. As the name suggests, the interpretation is that if you were to sequence one million full length transcripts, TPM is the number of transcripts you would have seen of type <img src="https://s0.wp.com/latex.php?latex=i&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="i" title="i" class="latex">, given the abundances of the other transcripts in your sample. The last “given” part is important. The denominator is going to be different between experiments, and thus is also sample dependent which is why you cannot directly compare TPM between samples. While this is true, TPM is probably the most stable unit across experiments, though you still shouldn’t compare it across experiments.</p>
<p>I’m fairly certain TPM is attributed to Bo Li <em>et. al.</em> in the <a href="http://bioinformatics.oxfordjournals.org/content/26/4/493.long">original RSEM paper</a>.</p>
<h3>RPKM/FPKM</h3>
<p>Reads per kilobase of exon per million reads mapped (RPKM), or the more generic FPKM (substitute reads with fragments) are essentially the same thing. Contrary to some misconceptions, FPKM is not 2 * RPKM if you have paired-end reads. FPKM == RPKM if you have single-end reads, and saying RPKM when you have paired-end reads is just weird, so don’t do it<img draggable="false" class="emoji" width=10 alt="🙂" src="https://s0.wp.com/wp-content/mu-plugins/wpcom-smileys/twemoji/2/svg/1f642.svg">.</p>
<p>A few years ago when the <a href="http://www.nature.com/nmeth/journal/v5/n7/abs/nmeth.1226.html">Mortazavi <em>et. al.</em> paper</a> came out and introduced RPKM, I remember many people referring to the method which they used to compute expression (termed the “rescue method”) as RPKM. This also happened with the Cufflinks method. People would say things like, “We used the RPKM method to compute expression” when they meant to say they used the rescue method or Cufflinks method. I’m happy to report that I haven’t heard this as much recently, but I still hear it every now and then. Therefore, let’s clear one thing up: FPKM is NOT a method, it is simply a unit of expression.</p>
<p>FPKM takes the same rate we discussed in the TPM section and instead of dividing it by the sum of rates, divides it by the total number of reads sequenced (<img src="https://s0.wp.com/latex.php?latex=N&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="N" title="N" class="latex">) and multiplies by a big number (<img src="https://s0.wp.com/latex.php?latex=10%5E9&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="10^9" title="10^9" class="latex">). In math:</p>
<p align="center">
<img src="https://s0.wp.com/latex.php?latex=%5Ctext%7BFPKM%7D_i+%3D+%5Cdfrac%7BX_i%7D%7B+%5Cleft%28%5Cdfrac%7B%5Cwidetilde%7Bl%7D_i%7D%7B10%5E3%7D%5Cright%29+%5Cleft%28+%5Cdfrac%7BN%7D%7B10%5E6%7D+%5Cright%29%7D+%3D+%5Cdfrac%7BX_i%7D%7B%5Cwidetilde%7Bl%7D_i+N%7D+%5Ccdot+10%5E9++&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="\text{FPKM}_i = \dfrac{X_i}{ \left(\dfrac{\widetilde{l}_i}{10^3}\right) \left( \dfrac{N}{10^6} \right)} = \dfrac{X_i}{\widetilde{l}_i N} \cdot 10^9  " title="\text{FPKM}_i = \dfrac{X_i}{ \left(\dfrac{\widetilde{l}_i}{10^3}\right) \left( \dfrac{N}{10^6} \right)} = \dfrac{X_i}{\widetilde{l}_i N} \cdot 10^9  " class="latex">.
</p>
<p>The interpretation of FPKM is as follows: if you were to sequence this pool of RNA again, you expect to see <img src="https://s0.wp.com/latex.php?latex=%5Ctext%7BFPKM%7D_i&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="\text{FPKM}_i" title="\text{FPKM}_i" class="latex"> fragments for each thousand bases in the feature for every  <img src="https://s0.wp.com/latex.php?latex=N%2F10%5E6&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="N/10^6" title="N/10^6" class="latex"> fragments you’ve sequenced. It’s basically just the rate of fragments per base multiplied by a big number (proportional to the number of fragments you sequenced) to make it more convenient.</p>
<h3>Relationship between TPM and FPKM</h3>
<p>The relationship between TPM and FPKM is derived by Lior Pachter in a <a href="http://arxiv.org/abs/1104.3889">review of transcript quantification methods</a> (<img src="https://s0.wp.com/latex.php?latex=%5Ctext%7BTPM%7D_i+%3D+%5Chat%7B%5Crho%7D_i+%5Ccdot+10%5E6&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="\text{TPM}_i = \hat{\rho}_i \cdot 10^6" title="\text{TPM}_i = \hat{\rho}_i \cdot 10^6" class="latex">) in equations 10 – 13. I’ll recite it here:</p>
<p align="center">
<img src="https://s0.wp.com/latex.php?latex=%5Cbegin%7Baligned%7D++%5Ctext%7BTPM%7D_i+%26%3D+%5Cdfrac%7BX_i%7D%7B%5Cwidetilde%7Bl%7D_i%7D+%5Ccdot+%5Cleft%28+%5Cdfrac%7B1%7D%7B%5Csum_j+%5Cdfrac%7BX_j%7D%7B%5Cwidetilde%7Bl%7D_j%7D%7D+%5Cright%29+%5Ccdot+10%5E6+%5C%5C++%26%5Cpropto+%5Cdfrac%7BX_i%7D%7B%5Cwidetilde%7Bl%7D_i+%5Ccdot+N%7D+%5Ccdot+%5Cleft%28+%5Cdfrac%7B1%7D%7B%5Csum_j+%5Cdfrac%7BX_j%7D%7B%5Cwidetilde%7Bl%7D_j+%5Ccdot+N%7D+%7D+%5Cright%29+%5C%5C++%26%5Cpropto+%5Cdfrac%7BX_i%7D%7B%5Cwidetilde%7Bl%7D_i+%5Ccdot+N%7D+%5Ccdot+10%5E9+++%5Cend%7Baligned%7D++&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="\begin{aligned}  \text{TPM}_i &amp;= \dfrac{X_i}{\widetilde{l}_i} \cdot \left( \dfrac{1}{\sum_j \dfrac{X_j}{\widetilde{l}_j}} \right) \cdot 10^6 \\  &amp;\propto \dfrac{X_i}{\widetilde{l}_i \cdot N} \cdot \left( \dfrac{1}{\sum_j \dfrac{X_j}{\widetilde{l}_j \cdot N} } \right) \\  &amp;\propto \dfrac{X_i}{\widetilde{l}_i \cdot N} \cdot 10^9   \end{aligned}  " title="\begin{aligned}  \text{TPM}_i &amp;= \dfrac{X_i}{\widetilde{l}_i} \cdot \left( \dfrac{1}{\sum_j \dfrac{X_j}{\widetilde{l}_j}} \right) \cdot 10^6 \\  &amp;\propto \dfrac{X_i}{\widetilde{l}_i \cdot N} \cdot \left( \dfrac{1}{\sum_j \dfrac{X_j}{\widetilde{l}_j \cdot N} } \right) \\  &amp;\propto \dfrac{X_i}{\widetilde{l}_i \cdot N} \cdot 10^9   \end{aligned}  " class="latex">.
</p>
<p>If you have FPKM, you can easily compute TPM:</p>
<p align="center">
<img src="https://s0.wp.com/latex.php?latex=%5Cbegin%7Baligned%7D++%5Ctext%7BTPM%7D_i+%26%3D+%5Cleft%28+%5Cdfrac%7B%5Ctext%7BFPKM%7D_i%7D%7B%5Csum_j+%5Ctext%7BFPKM%7D_j+%7D+%5Cright%29+%5Ccdot+10%5E6++%5Cend%7Baligned%7D++&amp;bg=ffffff&amp;fg=000000&amp;s=0" alt="\begin{aligned}  \text{TPM}_i &amp;= \left( \dfrac{\text{FPKM}_i}{\sum_j \text{FPKM}_j } \right) \cdot 10^6  \end{aligned}  " title="\begin{aligned}  \text{TPM}_i &amp;= \left( \dfrac{\text{FPKM}_i}{\sum_j \text{FPKM}_j } \right) \cdot 10^6  \end{aligned}  " class="latex">.
</p>
<p>Wagner et. al. discuss some of the benefits of TPM over FPKM <a href="http://lynchlab.uchicago.edu/publications/Wagner,%20Kin,%20and%20Lynch%20(2012).pdf">here</a> and advocate the use of TPM.</p>
<hr>
<p>I hope this clears up some confusion or helps you see the relationship between these units. In the near future I plan to write about how to use sequencing depth normalization with these different units so you can compare several samples to each other.</p>
<hr>
<h2>R code</h2>
<p>I’ve included some R code below for computing effective counts, TPM, and FPKM. I’m sure a few of those logs aren’t necessary, but I don’t think they’ll hurt<img draggable="false" class="emoji" alt="🙂" width=10 src="https://s0.wp.com/wp-content/mu-plugins/wpcom-smileys/twemoji/2/svg/1f642.svg">.</p>
<div><div id="highlighter_131207" class="syntaxhighlighter  r"><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td class="gutter"><div class="line number1 index0 alt2">1</div><div class="line number2 index1 alt1">2</div><div class="line number3 index2 alt2">3</div><div class="line number4 index3 alt1">4</div><div class="line number5 index4 alt2">5</div><div class="line number6 index5 alt1">6</div><div class="line number7 index6 alt2">7</div><div class="line number8 index7 alt1">8</div><div class="line number9 index8 alt2">9</div><div class="line number10 index9 alt1">10</div><div class="line number11 index10 alt2">11</div><div class="line number12 index11 alt1">12</div><div class="line number13 index12 alt2">13</div><div class="line number14 index13 alt1">14</div><div class="line number15 index14 alt2">15</div><div class="line number16 index15 alt1">16</div><div class="line number17 index16 alt2">17</div><div class="line number18 index17 alt1">18</div><div class="line number19 index18 alt2">19</div><div class="line number20 index19 alt1">20</div><div class="line number21 index20 alt2">21</div><div class="line number22 index21 alt1">22</div><div class="line number23 index22 alt2">23</div><div class="line number24 index23 alt1">24</div><div class="line number25 index24 alt2">25</div><div class="line number26 index25 alt1">26</div><div class="line number27 index26 alt2">27</div><div class="line number28 index27 alt1">28</div><div class="line number29 index28 alt2">29</div><div class="line number30 index29 alt1">30</div><div class="line number31 index30 alt2">31</div><div class="line number32 index31 alt1">32</div><div class="line number33 index32 alt2">33</div><div class="line number34 index33 alt1">34</div><div class="line number35 index34 alt2">35</div><div class="line number36 index35 alt1">36</div></td><td class="code"><div class="container"><div class="line number1 index0 alt2"><code class="r plain">countToTpm &lt;- </code><code class="r keyword">function</code><code class="r plain">(counts, effLen)</code></div><div class="line number2 index1 alt1"><code class="r plain">{</code></div><div class="line number3 index2 alt2"><code class="r spaces">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="r plain">rate &lt;- </code><code class="r functions">log</code><code class="r plain">(counts) - </code><code class="r functions">log</code><code class="r plain">(effLen)</code></div><div class="line number4 index3 alt1"><code class="r spaces">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="r plain">denom &lt;- </code><code class="r functions">log</code><code class="r plain">(</code><code class="r functions">sum</code><code class="r plain">(</code><code class="r functions">exp</code><code class="r plain">(rate)))</code></div><div class="line number5 index4 alt2"><code class="r spaces">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="r functions">exp</code><code class="r plain">(rate - denom + </code><code class="r functions">log</code><code class="r plain">(1e6))</code></div><div class="line number6 index5 alt1"><code class="r plain">}</code></div><div class="line number7 index6 alt2">&nbsp;</div><div class="line number8 index7 alt1"><code class="r plain">countToFpkm &lt;- </code><code class="r keyword">function</code><code class="r plain">(counts, effLen)</code></div><div class="line number9 index8 alt2"><code class="r plain">{</code></div><div class="line number10 index9 alt1"><code class="r spaces">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="r plain">N &lt;- </code><code class="r functions">sum</code><code class="r plain">(counts)</code></div><div class="line number11 index10 alt2"><code class="r spaces">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="r functions">exp</code><code class="r plain">( </code><code class="r functions">log</code><code class="r plain">(counts) + </code><code class="r functions">log</code><code class="r plain">(1e9) - </code><code class="r functions">log</code><code class="r plain">(effLen) - </code><code class="r functions">log</code><code class="r plain">(N) )</code></div><div class="line number12 index11 alt1"><code class="r plain">}</code></div><div class="line number13 index12 alt2">&nbsp;</div><div class="line number14 index13 alt1"><code class="r plain">fpkmToTpm &lt;- </code><code class="r keyword">function</code><code class="r plain">(fpkm)</code></div><div class="line number15 index14 alt2"><code class="r plain">{</code></div><div class="line number16 index15 alt1"><code class="r spaces">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="r functions">exp</code><code class="r plain">(</code><code class="r functions">log</code><code class="r plain">(fpkm) - </code><code class="r functions">log</code><code class="r plain">(</code><code class="r functions">sum</code><code class="r plain">(fpkm)) + </code><code class="r functions">log</code><code class="r plain">(1e6))</code></div><div class="line number17 index16 alt2"><code class="r plain">}</code></div><div class="line number18 index17 alt1">&nbsp;</div><div class="line number19 index18 alt2"><code class="r plain">countToEffCounts &lt;- </code><code class="r functions">function</code><code class="r plain">(counts, len, effLen)</code></div><div class="line number20 index19 alt1"><code class="r plain">{</code></div><div class="line number21 index20 alt2"><code class="r spaces">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="r plain">counts * (len / effLen)</code></div><div class="line number22 index21 alt1"><code class="r plain">}</code></div><div class="line number23 index22 alt2">&nbsp;</div><div class="line number24 index23 alt1"><code class="r comments">################################################################################</code></div><div class="line number25 index24 alt2"><code class="r comments"># An example</code></div><div class="line number26 index25 alt1"><code class="r comments">################################################################################</code></div><div class="line number27 index26 alt2"><code class="r plain">cnts &lt;- </code><code class="r functions">c</code><code class="r plain">(4250, 3300, 200, 1750, 50, 0)</code></div><div class="line number28 index27 alt1"><code class="r plain">lens &lt;- </code><code class="r functions">c</code><code class="r plain">(900, 1020, 2000, 770, 3000, 1777)</code></div><div class="line number29 index28 alt2"><code class="r plain">countDf &lt;- </code><code class="r functions">data.frame</code><code class="r plain">(count = cnts, length = lens)</code></div><div class="line number30 index29 alt1">&nbsp;</div><div class="line number31 index30 alt2"><code class="r comments"># assume a mean(FLD) = 203.7</code></div><div class="line number32 index31 alt1"><code class="r plain">countDf$effLength &lt;- countDf$length - 203.7 + 1</code></div><div class="line number33 index32 alt2"><code class="r plain">countDf$tpm &lt;- </code><code class="r functions">with</code><code class="r plain">(countDf, </code><code class="r functions">countToTpm</code><code class="r plain">(count, effLength))</code></div><div class="line number34 index33 alt1"><code class="r plain">countDf$fpkm &lt;- </code><code class="r functions">with</code><code class="r plain">(countDf, </code><code class="r functions">countToFpkm</code><code class="r plain">(count, effLength))</code></div><div class="line number35 index34 alt2"><code class="r functions">with</code><code class="r plain">(countDf, </code><code class="r functions">all.equal</code><code class="r plain">(tpm, </code><code class="r functions">fpkmToTpm</code><code class="r plain">(fpkm)))</code></div><div class="line number36 index35 alt1"><code class="r plain">countDf$effCounts &lt;- </code><code class="r functions">with</code><code class="r plain">(countDf, </code><code class="r functions">countToEffCounts</code><code class="r plain">(count, length, effLength))</code></div></div></td></tr></tbody></table></div></div>
          </div>
    <!-- / .content -->

    <footer>
              <span class="author"><span class="author-label">Written by</span> <a href="https://haroldpimentel.wordpress.com/author/haroldpimentel/" title="Posts by haroldpimentel" rel="author">haroldpimentel</a></span>
                          <span class="categories">
          <span class="categories-label">Posted in</span> <a href="https://haroldpimentel.wordpress.com/category/computational-biology/" rel="category tag">Computational biology</a>, <a href="https://haroldpimentel.wordpress.com/category/statistics-2/" rel="category tag">Statistics</a>, <a href="https://haroldpimentel.wordpress.com/2014/05/08/what-the-fpkm-a-review-rna-seq-expression-units/">LINK</a>        </span>
            
          </footer>
  </article>
