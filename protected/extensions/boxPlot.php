<?PHP
  class boxPlot {
    var $arr_dados = array();
/*
    // label in portuguese
    var $arr_label = array(
       "amount"=>"Quantidade de Valores",
       "minimum"=>"Menor Valor",
       "maximum"=>"Maior Valor",
       "mean"=>"M&eacute;dia",
       "median"=>"Mediana",
       "std.deviation"=>"Desvio Padr&atilde;o",
       "variance"=>"Varian&ccedil;a");
*/
    // lable in English
    var $arr_label = array(
       "amount"=>"Amount",
       "minimum"=>"Minimum",
       "maximum"=>"Maximum",
       "mean"=>"Mean",
       "median"=>"Median",
       "std.deviation"=>"Std. Deviation",
       "variance"=>"Variance");
    
    var $arr_ordem = array();
    var $arr_quartil_indice = array();
    var $arr_quartil = array();
    var $iqr = 0; // interquartile range
    var $iqr_inf = 0; // interquartile range inferior
    var $iqr_sup = 0; // interquartile range superior
    var $iqr_inf_value = 0; // interquartile range inferior value
    var $iqr_sup_value = 0; // interquartile range superior value
    
    var $tam = 0;
    var $mediana = 0;
    var $media = 0;
    var $maior = 0;
    var $menor = 0;
    var $freq = 0;
    var $escreveTexto = true;
    var $arr_outlier_inf = array();
    var $arr_outlier_sup = array();
    var $tamX = 200;
    var $tamY = 550;
    var $offset = 0;
    var $series_name = "";

    function boxPlot($dadosIn =  array()) {
        $dados = array();
        while (list($key,$value)=each($dadosIn)) {
            if (is_numeric($key))
               array_push($dados,$value);
            elseif (strcmp($key,'series_name')==0)
               $this->series_name = $value;            
        }
        $this->arr_dados = $dados;
        $this->tam = sizeof($this->arr_dados);
        //if ($this->tam<4)
        //  return;
        $this->arr_ordem = $this->arr_dados;
        $soma = 0;
        reset($this->arr_dados);
        while (list($key,$value)=each($this->arr_dados))
           $soma += $value;
        $this->media = $soma/$this->tam;
        sort($this->arr_ordem);
        $this->mediana = $this->getMediana();
        $this->menor = $this->arr_ordem[0];
        $aux = $this->tam -1;
        $this->maior = $this->arr_ordem[$aux];
        $this->quartil();
        $freq =  @array_count_values($this->arr_ordem);
//    print "=>".$this->series_name."<BR>";
    } // boxPlot


    function getDescription() {
       $this->getDescricao();
    }//    function getDescricao()

    function getDescricao()
    {
      if ($this->tam<4)
          return "";
      $txtHtml = "<table align=left>\n";
      if (strlen($this->series_name)>0){
          $txtHtml .= "<caption>\n";
          $txtHtml .= $this->series_name;
          $txtHtml .= "</caption>\n";
      }
      $txtHtml .= "<tr>\n";
      $txtHtml .= "<td>".$this->arr_label['amount']."</td>\n";
      $txtHtml .= "<td align='right'>".number_format($this->tam,0,",",".")."</td>\n";
      $txtHtml .= "</tr>\n";
 
      $txtHtml .= "<tr>\n";
      $txtHtml .= "<td>".$this->arr_label['minimum']."</td>\n";
      $txtHtml .= "<td align='right'>".number_format($this->menor,2,",",".")."</td>\n";
      $txtHtml .= "</tr>\n";
  
      $txtHtml .= "<tr>\n";
      $txtHtml .= "<td>".$this->arr_label['maximum']."</td>\n";
      $txtHtml .= "<td align='right'>".number_format($this->maior,2,",",".")."</td>\n";
      $txtHtml .= "</tr>\n";

    
      $txtHtml .= "<tr>\n";
      $txtHtml .= "<td>".$this->arr_label['median']."</td>\n";
      $txtHtml .= "<td align='right'>".number_format($this->mediana,2,",",".")."</td>\n";
      $txtHtml .= "</tr>\n";

      $txtHtml .= "<tr>\n";
      $txtHtml .= "<td>".$this->arr_label['mean']."</td>\n";
      $txtHtml .= "<td align='right'>".number_format($this->media,2,",",".")."</td>\n";
      $txtHtml .= "</tr>\n";

      // Transformando array de valores para string
      $arr_str = array();
      $somaDesvio =0.0;
      for ($i=0; $i<$this->tam; $i++) {
        //$somaDesvio = $somaDesvio+($this->arr_ordem[$i]-$this->media)*($this->arr_ordem[$i]-$this->media);
        $aux = $this->arr_dados[$i]-$this->media;
        $somaDesvio = $somaDesvio+$aux*$aux;
        $arr_str[$i]=$this->arr_ordem[$i]." ";
      }

      $txtHtml .= "<tr>\n";
      $txtHtml .= "<td>".$this->arr_label['variance']." </td>\n";
      $txtHtml .= "<td align='right'>".number_format($somaDesvio/($this->tam-1),2,",",".")."</td>\n";
      $txtHtml .= "</tr>\n";

      $txtHtml .= "<tr>\n";
      $txtHtml .= "<td>".$this->arr_label['std.deviation']."</td>\n";
      $txtHtml .= "<td align='right'>".number_format(sqrt($somaDesvio/($this->tam-1)),2,",",".")."</td>\n";
      $txtHtml .= "</tr>\n";



      $auxTam = sizeof($this->arr_quartil);
      if ($auxTam >0) {
        $txtHtml .= "<tr>\n";
        $txtHtml .= "<td colspan=2>Quartiles</td>\n";
        $txtHtml .= "</tr>\n";
      }
      $arr_label=array('0.00','0.25','0.50','0.75','1.00');
      for ($i=0+1; $i < $auxTam-1; $i++) {
        $txtHtml .= "<tr>\n";
        $txtHtml .= "<td>".$arr_label[$i]."</td>\n";
        $txtHtml .= "<td align='right'>".number_format($this->arr_quartil[$i],2,",",".")."</td>\n";
        $txtHtml .= "</tr>\n";
      }

    	$txtHtml .= "</table>\n";
    	return $txtHtml;
    } //     function getDescricao()


    function getMax () {
       return $this->maior; // return the greatest value of list
    } //function getMax ()
 
    function getMin () {
       return $this->menor; // return the lowest value of list
    } // function getMin ()


    function setEscreveTexto( $valor){
        $this->escreveTexto = $valor;
    } //function setEscreveTexto( $valor){

    function setWrite( $valor){
        $this->escreveTexto = $valor;
    } // function setWrite( $valor){
    
    function setDrawSize( $X=200, $Y=550, $p_offset=0){
        if ($this->tam<4)
          return;
        $this->tamX = $X;
        $this->tamY = $Y;
        $this->offset = $p_offset;
        /*
        print "<BR>tamX:".$this->tamX;
        print "<BR>tamY:".$this->tamY;
        print "<BR>offset:".$this->offset;
        */
    } // function setDrawSize( $X=200, $Y=550, $p_offset=0){

    function getMediana() {
        if ($this->tam % 2 == 0) {
          $aux1 = ($this->tam)/2;
          $aux2 = ($this->tam)/2-1;
          $aux = ($this->arr_ordem[$aux2]+$this->arr_ordem[$aux1])/2;
          return $aux;
        }
        else {
          $aux = ($this->tam-1)/2;
          return ($this->arr_ordem[$aux]);
        }
    } // getMediana

    function lista() {
       $tam = sizeof($this->arr_dados);
       return $this->arr_dados;
       for ($i=0; $i<$tam; $i++) {
           print $this->arr_dados[$i];
       }
    } // lista

    function box_para() {
      return array(
        //'iqr_inf' => $this->iqr_inf,
        //'iqr_inf_value' => $this->iqr_inf_value,
        //'iqr_sup' => $this->iqr_sup,
        //'iqr_sup_value' => $this->iqr_sup_value,
        //'q1' => $this->arr_ordem[$this->arr_quartil_indice[1]],
        //'q3' => $this->arr_ordem[$this->arr_quartil_indice[3]],
        //'median' => $this->mediana,
        //'arr_outlier_inf' => $this->arr_outlier_inf,
        //'arr_outlier_sup' => $this->arr_outlier_sup,
        //'boxplot' => array(
          round($this->iqr_inf_value,2),
          $this->arr_ordem[$this->arr_quartil_indice[1]],
          $this->mediana,
          $this->arr_ordem[$this->arr_quartil_indice[3]],
          round($this->iqr_sup_value,2),
        //),
      );
    }
    function quartil() {
       $inicio = 0;
       $final  = $this->tam -1;
       $passo = $this->tam/4;
       $this->arr_quartil_indice[0] = $inicio;
       $this->arr_quartil[0] = $this->menor;
       for ($i=1; $i<4; $i++) {
          $this->arr_quartil_indice[$i] = floor($inicio+$passo*$i);
          $aux = $this->arr_quartil_indice[$i];
          if (floor($aux)==$aux)
            $this->arr_quartil[$i] = $this->arr_ordem[$aux];
          else
          {
            $peso = $aux-floor($aux);
            $this->arr_quartil[$i] = $this->arr_ordem[$aux]+($this->arr_ordem[$aux+1]-$this->arr_ordem[$aux])*$peso;
          }
       }
       
       $fatorLimite = 1.5;
       
       $this->arr_quartil_indice[4] = $final;
       $this->arr_quartil[4] = $this->maior;
       $inferior = $this->arr_quartil_indice[1];
       $superior = $this->arr_quartil_indice[3];

       $this->iqr = $this->arr_ordem[$superior]-$this->arr_ordem[$inferior];
       $this->iqr_inf = $this->arr_ordem[$inferior]-$this->iqr*$fatorLimite;
       $this->iqr_sup = $this->arr_ordem[$superior]+$this->iqr*$fatorLimite;


       $this->iqr_inf_value = $minimo = $this->menor;
 
       // Limite Inferior
       if ($minimo < $this->iqr_inf) {
          $i = 1;
          while ($minimo < $this->iqr_inf and $i <= $this->arr_quartil_indice[1]) {
             array_push($this->arr_outlier_inf,$minimo);
             $minino=$this->arr_ordem[$i];
             $i++;
          }
          $i--;
          $this->iqr_inf_value = $this->arr_ordem[$i];
       }
       // verificando se o valor inferior eh igual ao IQR_Inferior
       // caso positivo este valor serah o valor dado IQR_Calculado
       if (abs($this->iqr_inf_value-$this->arr_ordem[$this->arr_quartil_indice[1]])<0.001) {
          $this->iqr_inf_value = $this->iqr_inf;
       }


       // Limite Superior
       $this->iqr_sup_value=$maximo = $this->maior;

       if ($maximo > $this->iqr_sup) {
          $i = $this->tam-2;
          while ($maximo > $this->iqr_sup and $i >= $this->arr_quartil_indice[3]) {
             array_push($this->arr_outlier_sup,$maximo);
             $maximo=$this->arr_ordem[$i];
             $i--;
          }
          $i++;
          $this->iqr_sup_value = $this->arr_ordem[$i];
       }
       // verificando se o valor inferior eh igual ao IQR_Inferior
       // caso positivo este valor serah o valor dado IQR_Calculado
       if (abs($this->iqr_sup_value-$this->arr_ordem[$this->arr_quartil_indice[3]])<0.001) {
          $this->iqr_sup_value = $this->iqr_sup;
       }
/*
print "<BR>Outlier Sup:";       
print_r($this->arr_outlier_sup);
print_r($this->arr_quartil_indice);
print_r($this->arr_ordem);
//*/
    }  // quartil



    function draw($graphfilename = null) {
    	$tamx = $this->tamX;
    	$tamy = $this->tamY;

        $normatamanho = $this->maior - $this->menor;

      //*
        $yinicio = $tamx-0;
        $yfinal  = $tamy-0;
        
        $yinicio = 20;
        $yfinal  = $tamy-20;
      //*/
      /*
        $yinicio = 50;
        $yfinal  = $tamy-50;
      //*/  
        if ($yfinal < $yinicio) $yfinal=$yinicio;
        
//print "<br>Inicio:$yinicio Final:$yfinal";        

        $x = floor($this->tamX/2);
        $larguracaixa = 5;
        $larguramarca = 8;
        $descolatexto = 10;

        $tampadrao = $yfinal - $yinicio;
        if ($normatamanho <>0)
          $constante = $tampadrao/$normatamanho;
        
     	$pic=imagecreate($tamx,$tamy); //(width, height)
      	//$coltxt=imagecolorallocate($pic,255,0,0);
       	$col1=imagecolorallocate($pic,250,250,250);
        $col2=imagecolorallocate($pic,255,0,255);//colour1

        $corfundo  = imagecolorallocate($pic,24,255,5);     // background color
        $corfundo  = imagecolorallocate($pic,0,255,255);     // background color
        $corbox    = imagecolorallocate($pic,170,150,235);  // box color
        $cor       = imagecolorallocate($pic,0,0,245);      // color
        $corred    = imagecolorallocate($pic,245,245,0);     

/*print "<br>$tampadrao/$normatamanho+$xinicio";
print "<br>$constante";
*/
/*
print"<pre>";
print_r($this->arr_quartil_indice);
print_r($this->arr_ordem);
print"</pre>";
//*/
          
          
        // desenhado linha de base
        imageline  ($pic  , $x, $yinicio  , $x  , $yfinal  ,  $corfundo  );

        // desenhado linha inicio
        $q4 = $this->arr_quartil_indice[4];
        $q3 = $this->arr_quartil_indice[3];
        $q2 = $this->arr_quartil_indice[2];
        $q1 = $this->arr_quartil_indice[1];
        $q0 = $this->arr_quartil_indice[0];

        //linha de referencia  - reference line
        /*
        $y = 0;
        $xfinal = 0;
        $xinicio = 0;        
        imageline  ($pic  , $xinicio  , $y  , $xfinal  , $y  , $corred  );
        */


        // lower boundary
        // determinating the lower boudary
        if ($this->iqr_inf < $this->arr_ordem[$q0]) {
//           $ylinhainicio = $yfinal-round(($this->arr_ordem[$q0])*$constante);
           $ylinhainicio = $yfinal-round(($this->arr_ordem[$q0]-$this->arr_ordem[$q0])*$constante);
           $txtinferior = $this->arr_ordem[$q0];
        } else {
           $ylinhainicio = $yfinal-round(($this->iqr_inf_value-$this->arr_ordem[$q0])*$constante);
//           $ylinhainicio = $yfinal-round(($this->iqr_inf_value)*$constante);
           $txtinferior = $this->iqr_inf_value;
        }   
        // drawing lower boundary
        if ($this->escreveTexto)
          imagestring($pic, 1, $x+$descolatexto, $ylinhainicio-2 , $txtinferior, $cor);
        imageline  ($pic  , $x-$larguramarca , $ylinhainicio ,  $x+$larguramarca, $ylinhainicio  ,  $cor  );

//*//
        // upper boundary 
        // determinating the upper boudary
//print $this->iqr_sup ." ".$this->iqr_sup_value ." ".$this->arr_ordem[$q4];
        if ($this->iqr_sup >$this->arr_ordem[$q4]) {
           $ylinhafinal  = $yfinal-round(($this->arr_ordem[$q4]-$this->arr_ordem[$q0])*$constante);
//           $ylinhafinal  = $yfinal-round(($this->arr_ordem[$q4])*$constante);
           $txtsuperior = $this->arr_ordem[$q4];
        } else {
           $ylinhafinal  = $yfinal-round(($this->iqr_sup_value-$this->arr_ordem[$q0])*$constante);
//           $ylinhafinal  = $yfinal-round(($this->iqr_sup_value)*$constante);
           $txtsuperior = $this->iqr_sup_value;
        }   
        // drawing upper boundary
        if ($this->escreveTexto)
           imagestring($pic, 1, $x+$descolatexto, $ylinhafinal-2 , $txtsuperior, $cor);
        imageline  ($pic  , $x-$larguramarca , $ylinhafinal  ,  $x+$larguramarca,  $ylinhafinal  ,  $cor  );
//*/
//*
        // drawing the data line
        imageline  ($pic  , $x, $ylinhainicio  , $x  , $ylinhafinal    , $cor  );
/*
print "<br> this->iqr_sup_value:".$this->iqr_sup_value;
print "<br> this->iqr_inf_value:".$this->iqr_inf_value;
print "<br> this->iqr_inf:".$this->iqr_inf;
print "<br> ylinhafinal:".$ylinhafinal;
print "<br> 4:".$this->arr_ordem[$q4];
print "<br> 3:".$this->arr_ordem[$q3];
print "<br> 2:".$this->arr_ordem[$q2];
print "<br> 1:".$this->arr_ordem[$q1];
print "<br> 0:".$this->arr_ordem[$q0];
print "<br> ".$constante;
print "<br> 1-0: ".($this->arr_ordem[$q1]-$this->arr_ordem[$q0])*$constante;
print "<br> 3-0: ".($this->arr_ordem[$q3]-$this->arr_ordem[$q0])*$constante;
print "<br> 0: ".($this->arr_ordem[$q0])*$constante;
print "<br> ";
*/
	// desenhando a caixa - drawing the box
        $yauxinicio = $yfinal-round(($this->arr_ordem[$q3]-$this->arr_ordem[$q0])*$constante);
//        $yauxinicio = $yfinal-round(($this->arr_ordem[$q3])*$constante);
        if ($this->escreveTexto)
           imagestring($pic, 1, $x+$descolatexto, $yauxinicio-2 , $this->arr_ordem[$q3], $cor);
        $yauxfinal =  $yfinal-round(($this->arr_ordem[$q1]-$this->arr_ordem[$q0])*$constante);
//        $yauxfinal =  $yfinal-round(($this->arr_ordem[$q1])*$constante);
        if ($this->escreveTexto)
           imagestring($pic, 1, $x+$descolatexto, $yauxfinal-2 , $this->arr_ordem[$q1], $cor);
        imagefilledrectangle  ( $pic  , $x-$larguracaixa, $yauxinicio,   $x+$larguracaixa, $yauxfinal ,   $corbox );
//        imagerectangle  ( $pic  , $x-$larguracaixa, $yauxinicio,   $x+$larguracaixa, $yauxfinal, $cor  );
//*
        // mediana
        $aux = $yfinal-round(($this->mediana-$this->arr_ordem[$q0])*$constante);
//        $aux = $yfinal-round(($this->mediana)*$constante);
        imageline  ($pic  , $x-$larguramarca, $aux  , $x+$larguramarca  , $aux    , $cor  );
        if ($this->escreveTexto)
           imagestring($pic, 1, $x+$descolatexto, $aux , $this->mediana, $cor);

        // media
        $aux = $yfinal-round(($this->media-$this->arr_ordem[$q0])*$constante);
//        $aux = $yfinal-round(($this->media)*$constante);
        imageline  ($pic  , $x+2, $aux-2  , $x-2, $aux+2 ,  $corred  );
        imageline  ($pic  , $x-2, $aux-2  , $x+2, $aux+2 ,  $corred  );

        // desenhando outliers
        while (list($key, $value) = each($this->arr_outlier_inf)){
           $aux = $yfinal-round(($value-$this->arr_ordem[$q0])*$constante);
//           $aux = $yfinal-round(($value)*$constante);
           imageline  ($pic  , $x+2, $aux-2  , $x-2, $aux+2 ,  $cor  );
           imageline  ($pic  , $x-2, $aux-2  , $x+2, $aux+2 ,  $cor  );
           if ($this->escreveTexto)
              imagestring($pic, 1, $x+$descolatexto, $aux-2 , $value, $cor);
        }
        while (list($key, $value) = each($this->arr_outlier_sup)){
           $aux = $yfinal-round(($value-$this->arr_ordem[$q0])*$constante);
//           $aux = $yfinal-round(($value)*$constante);
           imageline  ($pic  , $x+2, $aux-2  , $x-2, $aux+2 ,  $cor  );
           imageline  ($pic  , $x-2, $aux-2  , $x+2, $aux+2 ,  $cor  );
           if ($this->escreveTexto)
              imagestring($pic, 1, $x+$descolatexto, $aux-2 , $value, $cor);
        }


        // Writting the series name
        if ($this->escreveTexto)
           imagestring($pic, 3, $x, 5 , $this->series_name, $cor);
//*/
//print "<br>$this->offset * $constante + 0.5 =>";     
//print $offsetY;     

        if (strlen(trim($graphfilename)) >0) {
           imagejpeg($pic,'./'.$graphfilename);
           print "<img src='./".$graphfilename."'>";
           imagedestroy($pic);
        }else {
            header("expires: mon, 26 jul 1997 05:00:00 gmt");
            header("content-type: image/jpeg");
            imagejpeg($pic);
            imagedestroy($pic);
        }
    } // draw


  } // end class boxPlot

?>
