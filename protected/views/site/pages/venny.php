<!-- saved from url=(0041)http://bioinfogp.cnb.csic.es/tools/venny/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Venny 2.1.0</title>
		
		<meta name="Author" content="Juan Carlos Oliveros Collazos">
		<meta name="keywords" content="Venn,venny,html5">
		<meta name="Description" content="Venn's diagrams drawing tool for comparing up to four lists of elements.">
		<script>
 
		var ti=0;
		
		var CSIZE=1280;
		var COLORS="yes";
		var LSIZE=3;
		var TRANSP="no";
		var GRAY="no";
		var PERC="yes";

		var exampleName=new Array();
		exampleName[0]="Actors";
		exampleName[1]="Singers";
		exampleName[2]="List 3";
		exampleName[3]="List 4";

		var exampleList=new Array();
		exampleList[0]=new Array();
		exampleList[0][0]="Marilyn Monroe";
		exampleList[0][1]="Arnold Schwarzenegger";
		exampleList[0][2]="Jack Nicholson";
		exampleList[0][3]="Barbra Streisand";
		exampleList[0][4]="Robert de Niro";
		exampleList[0][5]="Dean Martin";
		exampleList[0][6]="Harrison Ford";
		exampleList[1]=new Array();
		exampleList[1][0]="Freddy Mercury";
		exampleList[1][1]="Barbra Streisand";
		exampleList[1][2]="Dean Martin";
		exampleList[1][3]="Ricky Martin";
		exampleList[1][4]="Celine Dion";
		exampleList[1][5]="Marilyn Monroe";
		exampleList[2]=new Array();
		exampleList[2][0]="";
		exampleList[3]=new Array();
		exampleList[3][0]="";

		var currentName=new Array();
		currentName[0]="";
		currentName[1]="";
		currentName[2]="";
		currentName[3]="";
		var elements=new Array();
		elements[0]=0;
		elements[1]=0;
		elements[2]=0;
		elements[3]=0;
		var actualList=new Array();
		actualList[0]=new Array();
		actualList[1]=new Array();
		actualList[2]=new Array();
		actualList[3]=new Array();

		var focused;

		var classified=new Array();

		var clabel=new Array();
		clabel[0]="rgb(0,0,255)";
		clabel[1]="rgb(120,120,0)";
		clabel[2]="rgb(0,128,0)";
		clabel[3]="rgb(255,0,0)";

		var xlabel=new Array();
		xlabel[0]=new Array();
		xlabel[1]=new Array();
		xlabel[2]=new Array();
		xlabel[3]=new Array();

		var ylabel=new Array();
		ylabel[0]=new Array();
		ylabel[1]=new Array();
		ylabel[2]=new Array();
		ylabel[3]=new Array();

		var xpos=new Array();
		xpos[0]=new Array();
		xpos[1]=new Array();
		xpos[2]=new Array();
		xpos[3]=new Array();

		var ypos=new Array();
		ypos[0]=new Array();
		ypos[1]=new Array();
		ypos[2]=new Array();
		ypos[3]=new Array();

		xlabel[3][0]=200-130;       ylabel[3][0]=200+120;
		xlabel[3][1]=200-80;        ylabel[3][1]=200-160;
		xlabel[3][2]=200+80;        ylabel[3][2]=200-160;
		xlabel[3][3]=200+130;       ylabel[3][3]=200+120;

		xpos[3]["C1000"]=200-130;   ypos[3]["C1000"]=200-20;
		xpos[3]["C0100"]=200-60;    ypos[3]["C0100"]=200-105;
		xpos[3]["C0010"]=200+60;    ypos[3]["C0010"]=200-105;
		xpos[3]["C0001"]=200+130;   ypos[3]["C0001"]=200-20;
		xpos[3]["C1100"]=200-90;    ypos[3]["C1100"]=200-60;
		xpos[3]["C1010"]=200-75;    ypos[3]["C1010"]=200+45;
		xpos[3]["C1001"]=200;       ypos[3]["C1001"]=200+100;
		xpos[3]["C0110"]=200;       ypos[3]["C0110"]=137;
		xpos[3]["C0101"]=200+75;    ypos[3]["C0101"]=200+45;
		xpos[3]["C0011"]=200+90;    ypos[3]["C0011"]=200-60;
		xpos[3]["C0111"]=200+49;    ypos[3]["C0111"]=200-10;
		xpos[3]["C1011"]=200-30;    ypos[3]["C1011"]=200+71;
		xpos[3]["C1101"]=200+30;    ypos[3]["C1101"]=200+71;
		xpos[3]["C1110"]=200-49;    ypos[3]["C1110"]=200-10;
		xpos[3]["C1111"]=200;       ypos[3]["C1111"]=235;

		xlabel[2][0]=200-60-20;     ylabel[2][0]=200-163-10;
		xlabel[2][1]=200+60+20;     ylabel[2][1]=200-163-10;
		xlabel[2][2]=200;           ylabel[2][2]=200+163+10;
		xlabel[2][3]=315;           ylabel[2][3]=-1850;

		xpos[2]["C1000"]=200-60-20; ypos[2]["C1000"]=200-52-20;
		xpos[2]["C0100"]=200+60+20; ypos[2]["C0100"]=200-52-20;
		xpos[2]["C1100"]=200;       ypos[2]["C1100"]=200-52-20;
		xpos[2]["C0010"]=200;       ypos[2]["C0010"]=200+52+20;
		xpos[2]["C1010"]=200-50;    ypos[2]["C1010"]=200+10;
		xpos[2]["C0110"]=200+50;    ypos[2]["C0110"]=200+10;
		xpos[2]["C1110"]=200;       ypos[2]["C1110"]=200-18;
		xpos[2]["C0001"]=310;       ypos[2]["C0001"]=-1900;
		xpos[2]["C1001"]=180;       ypos[2]["C1001"]=-2950;
		xpos[2]["C0101"]=250;       ypos[2]["C0101"]=-2450;
		xpos[2]["C0011"]=260;       ypos[2]["C0011"]=-1370;
		xpos[2]["C0111"]=220;       ypos[2]["C0111"]=-1830;
		xpos[2]["C1011"]=212;       ypos[2]["C1011"]=-2670;
		xpos[2]["C1101"]=161;       ypos[2]["C1101"]=-2670;
		xpos[2]["C1111"]=180;       ypos[2]["C1111"]=-2450;

		xlabel[1][0]=200-60-20;     ylabel[1][0]=200-117;
		xlabel[1][1]=200+60+20;     ylabel[1][1]=200-117;
		xlabel[1][2]=160;           ylabel[1][2]=-3500;
		xlabel[1][3]=315;           ylabel[1][3]=-1850;

		xpos[1]["C1000"]=200-60-20; ypos[1]["C1000"]=200;
		xpos[1]["C0100"]=200+60+20; ypos[1]["C0100"]=200;
		xpos[1]["C1100"]=200;       ypos[1]["C1100"]=200;
		xpos[1]["C0010"]=185;       ypos[1]["C0010"]=-2700;
		xpos[1]["C1010"]=140;       ypos[1]["C1010"]=-2000;
		xpos[1]["C0110"]=230;       ypos[1]["C0110"]=-2000;
		xpos[1]["C1110"]=185;       ypos[1]["C1110"]=-1750;
		xpos[1]["C0001"]=310;       ypos[1]["C0001"]=-1190;
		xpos[1]["C1001"]=180;       ypos[1]["C1001"]=-2950;
		xpos[1]["C0101"]=250;       ypos[1]["C0101"]=-2450;
		xpos[1]["C0011"]=260;       ypos[1]["C0011"]=-1370;
		xpos[1]["C0111"]=220;       ypos[1]["C0111"]=-1830;
		xpos[1]["C1011"]=212;       ypos[1]["C1011"]=-2670;
		xpos[1]["C1101"]=161;       ypos[1]["C1101"]=-2670;
		xpos[1]["C1111"]=180;       ypos[1]["C1111"]=-2450;

		xlabel[0][0]=200;           ylabel[0][0]=200-117;
		xlabel[0][1]=215;           ylabel[0][1]=-1880;
		xlabel[0][2]=160;           ylabel[0][2]=-3500;
		xlabel[0][3]=315;           ylabel[0][3]=-1850;

		xpos[0]["C1000"]=200;      ypos[0]["C1000"]=200;
		xpos[0]["C0100"]=260;      ypos[0]["C0100"]=-1850;
		xpos[0]["C1100"]=185;      ypos[0]["C1100"]=-1850;
		xpos[0]["C0010"]=185;      ypos[0]["C0010"]=-2700;
		xpos[0]["C1010"]=140;      ypos[0]["C1010"]=-2000;
		xpos[0]["C0110"]=230;      ypos[0]["C0110"]=-2000;
		xpos[0]["C1110"]=185;      ypos[0]["C1110"]=-1750;
		xpos[0]["C0001"]=310;      ypos[0]["C0001"]=-1900;
		xpos[0]["C1001"]=180;      ypos[0]["C1001"]=-2950;
		xpos[0]["C0101"]=250;      ypos[0]["C0101"]=-2450;
		xpos[0]["C0011"]=260;      ypos[0]["C0011"]=-1370;
		xpos[0]["C0111"]=220;      ypos[0]["C0111"]=-1830;
		xpos[0]["C1011"]=212;      ypos[0]["C1011"]=-2670;
		xpos[0]["C1101"]=161;      ypos[0]["C1101"]=-2670;
		xpos[0]["C1111"]=180;      ypos[0]["C1111"]=-2450;

		var groups=1;

		function $(o) { return (document.getElementById(o)); }

		function checkBrowser() {
			// Thanks to my collegue David San León to helping me checking browser compatibility:
			try {
				$("mainCanvas").getContext("2d");
				$("mainCanvas").toDataURL();
			}
			catch(err) {
				if (confirm ("This Browser is not compatible with this version of Venny. Open Venny 1.0 instead? (recommended)")) {
					window.document.location="http://bioinfogp.cnb.csic.es/tools/venny_old/index.html";
				}
			}
		}

		function setExample() {
			$("name1").value=exampleName[0];
			$("name2").value=exampleName[1];
			$("name3").value=exampleName[2];
			$("name4").value=exampleName[3];
			$('names').value="";
			$('area1').value="";
			for (t=0;t<exampleList[0].length;t++) {
				$('area1').value=$('area1').value+exampleList[0][t]+"\n";
			}
			$('area2').value="";
			for (t=0;t<exampleList[1].length;t++) {
				$('area2').value=$('area2').value+exampleList[1][t]+"\n";
			}
			$('area3').value="";
			for (t=0;t<exampleList[2].length;t++) {
				$('area3').value=$('area3').value+exampleList[2][t]+"\n";
			}
			$('area4').value="";
			for (t=0;t<exampleList[3].length;t++) {
				$('area4').value=$('area4').value+exampleList[3][t]+"\n";
			}
			compareLists();
			myBlur();
		}

		function myBlur() {
			var change=0;
			if (currentName[0]!=$("name1").value) { currentName[0]=$("name1").value; change=1; }
			if (currentName[1]!=$("name2").value) { currentName[1]=$("name2").value; change=1; }
			if (currentName[2]!=$("name3").value) { currentName[2]=$("name3").value; change=1; }
			if (currentName[3]!=$("name4").value) { currentName[3]=$("name4").value; change=1; }
			if (change==1) { compareLists(); }
			if (focused.id=="area1") { $("area1").blur(); focused.focus(); }
			if (focused.id=="area2") { $("area2").blur(); focused.focus(); }
			if (focused.id=="area3") { $("area3").blur(); focused.focus(); }
			if (focused.id=="area4") { $("area4").blur(); focused.focus(); }
		}

		function placeObjects(w,h) {
			var factor=640/400;   // NEW
			for (var k in xpos[groups-1]) {
				$("result"+k).style.left=factor*xpos[groups-1][k]-parseInt($("result"+k).offsetWidth)/2;
				$("result"+k).style.top =factor*ypos[groups-1][k]-parseInt($("result"+k).offsetHeight)/2;
			}
		}

		function getGroups() {
			var factor=640/400;   // NEW
			if      (elements[3]>0) { return (4); }
			else if (elements[2]>0) { return (3); }
			else if (elements[1]>0) { return (2); }
			else                    { return (1); }
		}


		function updateElements(l) {
			actualList[l-1]=new Array();
			elements[l-1]=0;
			var list=$("area"+l).value.split("\n");
			for (t=0;t<list.length;t++) {
				list[t]=list[t].replace(/^\s+/,"");
				list[t]=list[t].replace(/\s+$/,"");
				if (list[t].length>0) {
					if (actualList[l-1][list[t]]) { actualList[l-1][list[t]]++; }
					else                          { actualList[l-1][list[t]]=1; elements[l-1]++; }
					classified[list[t]]="C";
				}
			}
			if (elements[l-1]==1) { var textoFinal=" element"; }
			else                  { var textoFinal=" elements"; }
			textoFinal="";
			$("elements"+l).firstChild.nodeValue=elements[l-1]+textoFinal;
//			placeObjects(CSIZE,CSIZE);
		}

		function setSize(n) {
			n=n/Math.floor(CSIZE/640);
			for (var k in xpos[0]) { $("result"+k).style.fontSize=n+"pt"; }
		}

		function setWidth(n) {
			LSIZE=n;
		}

		function setFamily(f) {
			for (var k in xpos[0]) { $("result"+k).style.fontFamily=f; }
		}

		var TOTAL_UNIQUES=0;

		function main() {
			$("names").value="";
			for (var k in xpos[0]) { $("result"+k).firstChild.nodeValue=0; TOTAL_UNIQUES=0; }
			setStyle($("selectStyle").value);
			setFamily($("selectFamily").value);
			drawAll("mainCanvas");
 		}

		function compareLists() {
			main();
			classified=new Array();
			for (m=0;m<4;m++) { updateElements(m+1); }
			for (t=0;t<4;t++) {
				for (tt in actualList[t]) {
					if (classified[tt]) { classified[tt]=classified[tt]+"1"; }
				}
				for (cl in classified) {
					if (classified[cl].length<t+2) { classified[cl]=classified[cl]+"0"; }
				}
			}
			for (cl in classified) { $("result"+classified[cl]).firstChild.nodeValue++; TOTAL_UNIQUES++; }
			groups=getGroups();
			drawAll("mainCanvas");
		}

		function elementsToUpperCase() {
			$("area1").value=$("area1").value.toUpperCase();
			$("area2").value=$("area2").value.toUpperCase();
			$("area3").value=$("area3").value.toUpperCase();
			$("area4").value=$("area4").value.toUpperCase();
			updateElements(1);
			updateElements(2);
			updateElements(3);
			updateElements(4);
			compareLists();
		}
		function elementsToLowerCase() {
			$("area1").value=$("area1").value.toLowerCase();
			$("area2").value=$("area2").value.toLowerCase();
			$("area3").value=$("area3").value.toLowerCase();
			$("area4").value=$("area4").value.toLowerCase();
			updateElements(1);
			updateElements(2);
			updateElements(3);
			updateElements(4);
			compareLists();
		}

		function setLabels(obj,w,h) {
			for (var i=0;i<4;i++) { writeLabel(obj,i,w,h); }
			for (var k in xpos[0]) { if (xpos[groups-1][k]>0 && ypos[groups-1][k]>0) { writeValue(obj,k,w,h); } }
		}

		function writeValue(obj,vv,w,h) {
			var factor=w/400;
			v="result"+vv;
			var canvas=$(obj);
			var ctx=canvas.getContext("2d");
			$(v).style.color="rgba(255,0,0,0)";
			var x=Math.round(xpos[groups-1][vv]*factor);
			var y=Math.round(ypos[groups-1][vv]*factor);
			var count=parseInt($(v).firstChild.nodeValue);
			var actualSize=Math.floor(parseInt($("resultC1100").style.fontSize)*CSIZE/640);
			ctx.font="bold "+actualSize+"pt "+$("resultC1100").style.fontFamily;
			ctx.textBaseline="middle";
			ctx.textAlign="center";

			for (var t=1;t<vv.length;t++) {
				percentage=Math.round(count/TOTAL_UNIQUES*1000)/10;
			}

			if (GRAY=="yes") {
				var gray=componentToHex(255-Math.round(percentage/100*255));
				var color="#"+gray+gray+gray;
				floodFill(x,y,ctx,color,0);
				if (gray<128) {
					ctx.fillStyle="#FFFFFF";
				}
				else {
					ctx.fillStyle="#000000";
				}
			}
			else {
					ctx.fillStyle="#000000";
			}

			if (PERC=="yes") {
				var ysep=Math.round(actualSize/2);
				ctx.fillText(count,x,y-ysep-1);
				perSize=actualSize-8;
				ctx.font="bold "+perSize+"pt "+$("resultC1100").style.fontFamily;
				ctx.fillText("("+percentage+"%)",x,y+ysep+1);
				$(v).innerHTML=count+"<br><small><small>"+"("+percentage+"%)</small></small>";
			}
			else {
				var ysep=0;
				ctx.fillText(count,x,y-ysep-1);
				$(v).innerHTML=count;
			}
		}

		function showNames(k) {
			var resultText="";
			var results=0;
			var s="s";
			for (cl in classified) {
				if (classified[cl]==k) { resultText=resultText+cl+"\n"; results++}
			}
			if (results==1) { s=""; }
			if (k=="C1000") { resultText=results+" element"+s+" included exclusively in \""+currentName[0]+"\":\n"+resultText; }
			else if (k=="C0100") { resultText=results+" element"+s+" included exclusively in \""+currentName[1]+"\":\n"+resultText; }
			else if (k=="C0010") { resultText=results+" element"+s+" included exclusively in \""+currentName[2]+"\":\n"+resultText; }
			else if (k=="C0001") { resultText=results+" element"+s+" included exclusively in \""+currentName[3]+"\":\n"+resultText; }

			else if (k=="C1100") { resultText=results+" common element"+s+" in \""+currentName[0]+"\" and \""+currentName[1]+"\":\n"+resultText; }
			else if (k=="C0110") { resultText=results+" common element"+s+" in \""+currentName[1]+"\" and \""+currentName[2]+"\":\n"+resultText; }
			else if (k=="C0011") { resultText=results+" common element"+s+" in \""+currentName[2]+"\" and \""+currentName[3]+"\":\n"+resultText; }
			else if (k=="C1010") { resultText=results+" common element"+s+" in \""+currentName[0]+"\" and \""+currentName[2]+"\":\n"+resultText; }
			else if (k=="C0101") { resultText=results+" common element"+s+" in \""+currentName[1]+"\" and \""+currentName[3]+"\":\n"+resultText; }
			else if (k=="C1001") { resultText=results+" common element"+s+" in \""+currentName[0]+"\" and \""+currentName[3]+"\":\n"+resultText; }

			else if (k=="C0111") { resultText=results+" common element"+s+" in \""+currentName[1]+"\", \""+currentName[2]+"\" and \""+currentName[3]+"\":\n"+resultText; }
			else if (k=="C1011") { resultText=results+" common element"+s+" in \""+currentName[0]+"\", \""+currentName[2]+"\" and \""+currentName[3]+"\":\n"+resultText; }
			else if (k=="C1101") { resultText=results+" common element"+s+" in \""+currentName[0]+"\", \""+currentName[1]+"\" and \""+currentName[3]+"\":\n"+resultText; }
			else if (k=="C1110") { resultText=results+" common element"+s+" in \""+currentName[0]+"\", \""+currentName[1]+"\" and \""+currentName[2]+"\":\n"+resultText; }

			else if (k=="C1111") { resultText=results+" common element"+s+" in \""+currentName[0]+"\", \""+currentName[1]+"\", \""+currentName[2]+"\" and \""+currentName[3]+"\":\n"+resultText; }

			$("names").value=resultText;
			$("names").scrollTop=0;
		}

		function clear(l) {
			$("area"+l).value="";
			$("name"+l).value="List "+l;
			drawAll("mainCanvas");
		}

		function writeLabel(obj,l,w,h) {
			var factor=w/400;
			var canvas=$(obj);
			var ctx=canvas.getContext("2d");
			var labelCaption=currentName[l];
			var x=xlabel[groups-1][l]*factor;
			var y=ylabel[groups-1][l]*factor;
			if (COLORS=="yes") {
				ctx.fillStyle=clabel[l];
			}
			else { ctx.fillStyle="rgb(0,0,0)"; }
			var actualSize=parseInt($("resultC1100").style.fontSize)+"pt";
			var actualSize=Math.floor(parseInt($("resultC1100").style.fontSize)*CSIZE/640)+"pt";
			ctx.font="bold "+actualSize+" "+$("resultC1100").style.fontFamily;
			ctx.textBaseline="middle";
			ctx.textAlign="center";
			ctx.fillText(labelCaption,x,y);
		}

		function setStyle(style)
		{
			if (style=="colored")
			{
				COLORS="yes";
				TRANSP="no";
				GRAY="no";
				$("frame").style.background="#FFFFFF";
			}
			else if (style=="BW")
			{
				COLORS="no";
				TRANSP="no";
				GRAY="no";
				$("frame").style.background="#FFFFFF";
			}
			else if (style=="gray")
			{
				COLORS="no";
				TRANSP="no";
				GRAY="yes";
				$("frame").style.background="#FFFFFF";
			}
			else if (style=="transparent")
			{
				COLORS="no";
				TRANSP="yes";
				GRAY="no";
				$("frame").style.background="#D4D0C8";
			}
		}

		function setPercentage(bool)
		{
			if (bool==true) { PERC="yes" } else { PERC="no"; }
		}

		function drawAll(obj) {
			switch (groups) {
				case 1: drawVenn1(obj,CSIZE,CSIZE); break;
				case 2: drawVenn2(obj,CSIZE,CSIZE); break;
				case 3: drawVenn3(obj,CSIZE,CSIZE); break;
				case 4: drawVenn4(obj,CSIZE,CSIZE); break;
			}
			setLabels(obj,CSIZE,CSIZE);
			placeObjects(CSIZE,CSIZE);
			$("image").src=$("mainCanvas").toDataURL();
		}

		function drawVenn1(obj,w,h) {
			var factor=w/400; // 400 was the original size.
			var canvas=$(obj);
			var ctx=canvas.getContext("2d");
			canvas.style.width=w;
			canvas.style.height=h;
			canvas.setAttribute("width",w);
			canvas.setAttribute("height",h);
			if (TRANSP=="no") {
				ctx.fillStyle="rgb(255,255,255)";
				ctx.fillRect(0,0,w,h);
			}
    			var rad=92*factor;
    			var start=0;
    			var end=2*Math.PI;
    			var clock=1;
    			var lcolor="rgb(0,0,0)";
    			var lsize=LSIZE;
    			var x=new Array();
    			var y=new Array();
    			var bcolor=new Array();
    			x[0]=canvas.width/2;
    			y[0]=canvas.height/2;
    			bcolor[0]="rgba(0,0,255,0.5)";
    			ctx.beginPath();
    			ctx.arc(x[0],y[0],rad,start,end,clock);
  	  		if (COLORS=="yes") {
 				ctx.fillStyle = bcolor[0];
 				ctx.fill();
 			}
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
  		}

		function drawVenn2(obj,w,h) {
			var factor=w/400; // 400 was the original size.
			var canvas=$(obj);
			var ctx=canvas.getContext("2d");
			canvas.style.width=w;
			canvas.style.height=h;
			canvas.setAttribute("width",w);
			canvas.setAttribute("height",h);
			if (TRANSP=="no") {
				ctx.fillStyle="rgb(255,255,255)";
				ctx.fillRect(0,0,w,h);
			}
    			var rad=92*factor;
    			var start=0;
    			var end=2*Math.PI;
    			var clock=1;
    			var lcolor="rgb(0,0,0)";
    			var lsize=LSIZE;
    			var x=new Array();
    			var y=new Array();
    			var bcolor=new Array();
    			x[0]=canvas.width/2-60*factor;
    			y[0]=canvas.height/2;
    			bcolor[0]="rgba(0,0,255,0.5)";
    			x[1]=canvas.width/2+60*factor;
    			y[1]=canvas.height/2;
    			bcolor[1]="rgba(255,255,0,0.5)";
   			ctx.beginPath();
    			ctx.arc(x[0],y[0],rad,start,end,clock);
    			if (COLORS=="yes") {
 				ctx.fillStyle = bcolor[0];
 				ctx.fill();
 			}
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
    		ctx.beginPath();
    		ctx.arc(x[1],y[1],rad,start,end,clock);
    		if (COLORS=="yes") {
 				ctx.fillStyle = bcolor[1];
 				ctx.fill();
 			}
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
    		ctx.beginPath();
    		ctx.arc(x[0],y[0],rad,start,end,clock);
 			ctx.fillStyle = "rgba(0,0,0,0)";
 			ctx.fill();
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
    		ctx.beginPath();
 	   	ctx.arc(x[1],y[1],rad,start,end,clock);
 			ctx.fillStyle = "rgba(0,0,0,0)";
 			ctx.fill();
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
		}

		function drawVenn3(obj,w,h) {
			var factor=w/400; // 400 was the original size.
			var canvas=$(obj);
			var ctx=canvas.getContext("2d");
			canvas.style.width=w;
			canvas.style.height=h;
			canvas.setAttribute("width",w);
			canvas.setAttribute("height",h);
			if (TRANSP=="no") {
				ctx.fillStyle="rgb(255,255,255)";
				ctx.fillRect(0,0,w,h);
			}
    			var rad=92*factor;
    			var start=0;
    			var end=2*Math.PI;
    			var clock=1;
    			var lcolor="rgb(0,0,0)";
    			var lsize=LSIZE;
    			var x=new Array();
    			var y=new Array();
    			var bcolor=new Array();
    			x[0]=canvas.width/2-60*factor;
    			y[0]=canvas.height/2-52*factor;
    			bcolor[0]="rgba(0,0,255,0.5)";
    			x[1]=canvas.width/2+60*factor;
    			y[1]=canvas.height/2-52*factor;
    			bcolor[1]="rgba(255,255,0,0.5)";
    			x[2]=canvas.width/2;
    			y[2]=canvas.height/2+52*factor;
   	 		bcolor[2]="rgba(0,255,0,0.5)";
    			ctx.beginPath();
    			ctx.arc(x[0],y[0],rad,start,end,clock);
    			if (COLORS=="yes") {
 				ctx.fillStyle = bcolor[0];
 				ctx.fill();
 			}
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
    			ctx.beginPath();
    			ctx.arc(x[1],y[1],rad,start,end,clock);
    			if (COLORS=="yes") {
 					ctx.fillStyle = bcolor[1];
 					ctx.fill();
    			}
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
    			ctx.beginPath();
    			ctx.arc(x[2],y[2],rad,start,end,clock);
    			if (COLORS=="yes") {
				ctx.fillStyle = bcolor[2];
				ctx.fill();
			}
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
    		ctx.beginPath();
   	 	ctx.arc(x[0],y[0],rad,start,end,clock);
 			ctx.fillStyle = "rgba(0,0,0,0)";
 			ctx.fill();
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
    		ctx.beginPath();
 	   	ctx.arc(x[1],y[1],rad,start,end,clock);
 			ctx.fillStyle = "rgba(0,0,0,0)";
 			ctx.fill();
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
    		ctx.beginPath();
 	   	ctx.arc(x[2],y[2],rad,start,end,clock);
 			ctx.fillStyle = "rgba(0,0,0,0)";
 			ctx.fill();
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
		}

		function drawVenn4(obj,w,h) {
			var factor=w/400; // 400 was the original size.
			var canvas=$(obj);
			var ctx=canvas.getContext("2d");
			canvas.style.width=w;
			canvas.style.height=h;
			canvas.setAttribute("width",w);
			canvas.setAttribute("height",h);
			if (TRANSP=="no") {
				ctx.fillStyle="rgb(255,255,255)";
				ctx.fillRect(0,0,w,h);
			}
			//rectangle
			var W=180*factor;
			var H=282*factor;
			var Xmid=new Array();
			var Ymid=new Array();
			var angle=new Array();
			var bcolor=new Array();
			Xmid[0]=canvas.width/2-67*factor;
			Ymid[0]=canvas.height/2+15*factor;
			angle[0]=-45;
			bcolor[0]="rgba(0,0,255,0.33)";
			Xmid[1]=canvas.width/2-7*factor;
			Ymid[1]=canvas.height/2-20*factor;
			angle[1]=-45;
			bcolor[1]="rgba(255,255,0,0.33)";
			Xmid[2]=canvas.width/2+7*factor;
			Ymid[2]=canvas.height/2-20*factor;
			angle[2]=45;
			bcolor[2]="rgba(0,255,0,0.33)";
			Xmid[3]=canvas.width/2+67*factor;
			Ymid[3]=canvas.height/2+15*factor;
			angle[3]=45;
			bcolor[3]="rgba(255,0,0,0.33)";
			drawOval(ctx,Xmid[0],Ymid[0],W,H,angle[0],bcolor[0],"rgb(0,0,0)",0);
			drawOval(ctx,Xmid[1],Ymid[1],W,H,angle[1],bcolor[1],"rgb(0,0,0)",0);
			drawOval(ctx,Xmid[2],Ymid[2],W,H,angle[2],bcolor[2],"rgb(0,0,0)",0);
			drawOval(ctx,Xmid[3],Ymid[3],W,H,angle[3],bcolor[3],"rgb(0,0,0)",0);
			// draw again the lines
			var lsize=LSIZE;
			drawOval(ctx,Xmid[0],Ymid[0],W,H,angle[0],"rgba(0,0,0,0)","rgb(0,0,0)",lsize);
			drawOval(ctx,Xmid[1],Ymid[1],W,H,angle[1],"rgba(0,0,0,0)","rgb(0,0,0)",lsize);
			drawOval(ctx,Xmid[2],Ymid[2],W,H,angle[2],"rgba(0,0,0,0)","rgb(0,0,0)",lsize);
			drawOval(ctx,Xmid[3],Ymid[3],W,H,angle[3],"rgba(0,0,0,0)","rgb(0,0,0)",lsize);
		}

		function drawOval(ctx,Xmid,Ymid,W,H,angle,bcolor,lcolor,lsize) {
    		var pxc1=W/2;
    		var pyc1=-H/2;
    		var pxc2=W/2;
    		var pyc2=H/2;
    		var pxc3=-W/2;
    		var pyc3=H/2;
    		var pxc4=-W/2;
    		var pyc4=-H/2;
    		var pxa1=0;
    		var pya1=-H/2;
    		var pxa2=0;
    		var pya2=H/2;
			angle=angle*2*Math.PI/360;
    		var xc1=pxc1*Math.cos(angle)-pyc1*Math.sin(angle);
    		var yc1=pxc1*Math.sin(angle)+pyc1*Math.cos(angle);
    		var xc2=pxc2*Math.cos(angle)-pyc2*Math.sin(angle);
    		var yc2=pxc2*Math.sin(angle)+pyc2*Math.cos(angle);
    		var xc3=pxc3*Math.cos(angle)-pyc3*Math.sin(angle);
    		var yc3=pxc3*Math.sin(angle)+pyc3*Math.cos(angle);
    		var xc4=pxc4*Math.cos(angle)-pyc4*Math.sin(angle);
    		var yc4=pxc4*Math.sin(angle)+pyc4*Math.cos(angle);
    		var xa1=pxa1*Math.cos(angle)-pya1*Math.sin(angle);
    		var ya1=pxa1*Math.sin(angle)+pya1*Math.cos(angle);
    		var xa2=pxa2*Math.cos(angle)-pya2*Math.sin(angle);
    		var ya2=pxa2*Math.sin(angle)+pya2*Math.cos(angle);
    		xc1=xc1+Xmid;
    		xc2=xc2+Xmid;
    		xc3=xc3+Xmid;
    		xc4=xc4+Xmid;
    		xa1=xa1+Xmid;
    		xa2=xa2+Xmid;
    		yc1=yc1+Ymid;
    		yc2=yc2+Ymid;
    		yc3=yc3+Ymid;
    		yc4=yc4+Ymid;
    		ya1=ya1+Ymid;
    		ya2=ya2+Ymid;
    		ctx.beginPath();
    		ctx.moveTo(xa1, ya1);
    		ctx.bezierCurveTo(xc1, yc1,xc2, yc2,xa2, ya2);
			ctx.bezierCurveTo(xc3, yc3,xc4, yc4,xa1, ya1);
			if (COLORS=="yes") {
 				ctx.fillStyle = bcolor;
 				ctx.fill();
 			}
 			ctx.strokeStyle = lcolor;
 			ctx.lineWidth=lsize;
 			ctx.stroke();
 			ctx.closePath();
		}

		function showInfo() {
			$("info").style.display="block";
		}

		function resize() {
			$("mainTable").style.left=parseInt($("mainDiv").offsetWidth)/2-parseInt($("mainTable").offsetWidth)/2;
		}

		function componentToHex(c)
		{
    		var hex = c.toString(16);
    		return hex.length == 1 ? "0" + hex : hex;
		}




/**
 * Floodfill - Linear Floodfill with tolerance in plain Javascript.
 *
 * Autor: Markus Ritberger
 * Version: 1.0.1 (2012-04-16)
 *
 * Examples at: http://demos.ritberger.at/floodfill
 *
 * licensed under MIT license:
 *
 * Copyright (c) 2012 Markus Ritberger
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/

function floodfill_hexToR(h) {
    return parseInt((floodfill_cutHex(h)).substring(0,2),16)
}
function floodfill_hexToG(h) {
    return parseInt((floodfill_cutHex(h)).substring(2,4),16)
}
function floodfill_hexToB(h) {
    return parseInt((floodfill_cutHex(h)).substring(4,6),16)
}
function floodfill_cutHex(h) {
    return (h.charAt(0)=="#") ? h.substring(1,7):h
}

function floodfill_matchTolerance(pixelPos,color,tolerance){
    var rMax = startR + (startR * (tolerance / 100));
    var gMax = startG + (startG * (tolerance / 100));
    var bMax = startB + (startB * (tolerance / 100));

    var rMin = startR - (startR * (tolerance / 100));
    var gMin = startG - (startG * (tolerance / 100));
    var bMin = startB - (startB * (tolerance / 100));

    var r = imageData.data[pixelPos];
    var g = imageData.data[pixelPos+1];
    var b = imageData.data[pixelPos+2];

    return ((
        (r >= rMin && r <= rMax)
        && (g >= gMin && g <= gMax)
        && (b >= bMin && b <= bMax)
        )
        && !(r == floodfill_hexToR(color)
        && g == floodfill_hexToG(color)
        && b == floodfill_hexToB(color))
        );
}

function floodfill_colorPixel(pixelPos,color){
  imageData.data[pixelPos] = floodfill_hexToR(color);
  imageData.data[pixelPos+1] = floodfill_hexToG(color);
  imageData.data[pixelPos+2] = floodfill_hexToB(color);
  imageData.data[pixelPos+3] = 255;
}

function floodFill(x,y,context,color,tolerance){
   pixelStack = [[x,y]];
   width = context.canvas.width;
   height = context.canvas.height;
   pixelPos = (y*width + x) * 4;
   imageData =  context.getImageData(0, 0, width, height);
   startR = imageData.data[pixelPos];
   startG = imageData.data[pixelPos+1];
   startB = imageData.data[pixelPos+2];
   while(pixelStack.length){
      newPos = pixelStack.pop();
      x = newPos[0];
      y = newPos[1];
      pixelPos = (y*width + x) * 4;
      while(y-- >= 0 && floodfill_matchTolerance(pixelPos,color,tolerance)){
        pixelPos -= width * 4;
      }
      pixelPos += width * 4;
      ++y;
      reachLeft = false;
      reachRight = false;
      while(y++ < height-1 && floodfill_matchTolerance(pixelPos,color,tolerance)){
        floodfill_colorPixel(pixelPos,color);
        if(x > 0){
          if(floodfill_matchTolerance(pixelPos - 4,color,tolerance)) {
            if(!reachLeft){
              pixelStack.push([x - 1, y]);
              reachLeft = true;
            }
          }
          else if(reachLeft){
            reachLeft = false;
          }
        }
        if(x < width-1){
          if(floodfill_matchTolerance(pixelPos + 4,color,tolerance)){
            if(!reachRight){
              pixelStack.push([x + 1, y]);
              reachRight = true;
            }
          }
          else if(floodfill_matchTolerance(pixelPos + 4 -(width *4),color,tolerance)) {
            if(!reachLeft){
              pixelStack.push([x + 1, y - 1]);
              reachLeft = true;
            }
          }
          else if(reachRight){
            reachRight = false;
          }
        }
        pixelPos += width * 4;
      }
    }
    context.putImageData(imageData, 0, 0);
}





















		</script>

		<style>
		.number {
			color:#FF0000;
			font-weight:bold;
			cursor:pointer;
			text-decoration:none;
		}
		.numberW {
			color:#FF0000;
			font-weight:bold;
			cursor:pointer;
			text-decoration:none;
		}
		.number2 {
			font-weight:bold;
			cursor:pointer;
			border:2px solid #000000;
			border-right:2px solid #000000;
			margin-top:-2px;
			margin-left:-2px;
		}

		.buttonA1 {
			white-space:nowrap;
			background-color:#D4D0C8;
			text-align:center;
			font-size:14px;
			border-top: 1px #D4D0C8 solid;
			border-left: 1px #D4D0C8 solid;
			border-right: 1px #D4D0C8 solid;
			border-bottom: 1px #D4D0C8 solid;
			cursor:default;
			padding-left:4px;
			padding-right:4px;
			padding-top:1px;
			padding-bottom:1px;
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		.buttonA1C {
			white-space:nowrap;
			background-color:#D4D0C8;
			text-align:center;
			font-size:14px;
			border-top: 1px #000000 solid;
			border-left: 1px #000000 solid;
			border-right: 1px #FFFFFF solid;
			border-bottom: 1px #FFFFFF solid;
			cursor:default;
			padding-left:5px;
			padding-right:3px;
			padding-top:2px;
			padding-bottom:0px;
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		.buttonA1B {
			white-space:nowrap;
			background-color:#D4D0C8;
			text-align:center;
			font-size:14px;
			border-top: 1px #FFFFFF solid;
			border-left: 1px #FFFFFF solid;
			border-right: 1px #000000 solid;
			border-bottom: 1px #000000 solid;
			cursor:default;
			padding-left:4px;
			padding-right:4px;
			padding-top:1px;
			padding-bottom:1px;
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		td,p,input[type="text"] {
			font-size:14px;
			font-family: sans-serif;
		}

		#name1,#name2, #name3, #name4 {
			font-size:14px;
			font-family: sans-serif;
		}

		</style>

	</head>

	<body onload="checkBrowser();main();focused=$('name1');setSize($('sizeBox').value);resize();" onresize="resize();" style="margin:0px;background:#b0bec5;">
	<div id="mainDiv" style="padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;background:#b0bec5;">
		<table id="mainTable" border="0" cellpadding="0" cellspacing="0" style="position: relative; box-shadow: rgb(136, 136, 136) 2px 5px 10px; border: 1px solid rgb(212, 208, 200); vertical-align: middle; height: 100%; left: 0px; background: rgb(255, 255, 255);">
			<tr>
				<td bgcolor="#FFFFFF" style="vertical-align:top;">
					<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
						<tr>
							<td colspan="2" style="width:100%;">
								<table border="0" cellpadding="4" cellspacing="0" style="background:#0C090A;width:100%;">
									<tr>
										<td style="font-variant:small-caps;color:#E5E4E2;font-size:32px;padding-left:16px;font-weight:bold;vertical-align:middle;">
											Venny
										</td>
										<td style="font-weight:bold;font-size:14px;text-align:left;color:#E5E4E2;vertical-align:middle;padding-right:8px;white-space:nowrap;">
											2.1
										</td>
										<td style="font-size:11px;width:100%;text-align:right;color:#E5E4E2;vertical-align:middle;padding-right:8px;white-space:nowrap;">
											By Juan Carlos Oliveros<br>
											<a style="color:#E5E4E2;" href="http://bioinfogp.cnb.csic.es/" target="_new">BioinfoGP</a>,
											<a style="color:#E5E4E2;" href="http://www.cnb.csic.es/" target="_new">CNB-CSIC</a>
										</td>
									</tr>
									<tr>
										<td colspan=3 style="font-size:11px;color:#EFEFEF;">
											&nbsp;&nbsp;&nbsp;Try <a style="color:#FFFF00;" target="bcas" href="http://bioinfogp.cnb.csic.es/tools/breakingcas/">Breaking-Cas</a><sup><small><span style="color:#FF8800;">BETA</span></small></sup> for off-targets-free CRISPR/Cas gRNAs design!
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:8px;padding-top:12px;">
								1. Paste up to four lists. One element per row (<a href="javascript:setExample();">example</a>),<br>
								2. Click the numbers to see the results,<br>
								3. Right-click the figure to view and save it<br>
								<span style="color:#FFFFFF;">4. </span><small>(actual size in pixels: 1280x1280)</small>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="width:100%;padding-top:4px;">
								<table cellpadding="0" cellspacing="1" style="width:100%;">
									<tr>
										<td class="buttonA1" onmouseover="this.className='buttonA1B';" onmousedown="this.className='buttonA1C';" onmouseout="this.className='buttonA1';" onmouseup="this.className='buttonA1B';elementsToUpperCase();" style="font-family:sans-serif;">UPPERCASE</td>
										<td class="buttonA1" onmouseover="this.className='buttonA1B';" onmousedown="this.className='buttonA1C';" onmouseout="this.className='buttonA1';" onmouseup="this.className='buttonA1B';elementsToLowerCase();" style="font-family:sans-serif;">lowercase</td>
										<td class="buttonA1" style="width:100%;text-align:left;color:#336699;">←<small>cannot be undone!</small></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="padding:4px;padding-top:8px;">
								<input size="10" id="name1" maxlength="16" value="List 1" style="color:rgb(0,0,200);font-weight:bold;" onfocus="focused=$('names');ti=setInterval(myBlur,500);" onblur="clearInterval(ti);" type="textbox">
								<div style="display:inline;font-size:12px;" id="elements1">0</div>
								<br>
								<textarea id="area1" cols="24" rows="5" onchange="compareLists();" wrap="off" onfocus="focused=this;ti=setInterval(myBlur,500);" onblur="clearInterval(ti);"></textarea>
								<dt style="width: 100%; text-align: right;"><a style="color:#0000FF;" href="javascript:clear(1);myBlur();compareLists();">clear</a>&nbsp;&nbsp;</dt><dt>
							</dt></td>
							<td style="padding:4px;padding-top:8px;">
								<input size="10" id="name2" maxlength="16" value="List 2" style="color:rgb(128,128,0);font-weight:bold;" onfocus="focused=$('names');ti=setInterval(myBlur,500);" onblur="clearInterval(ti);" type="textbox">
								<div style="display:inline;font-size:12px;" id="elements2">0</div>
								<br>
								<textarea id="area2" cols="24" rows="5" onchange="compareLists();" wrap="off" onfocus="focused=this;ti=setInterval(myBlur,500);" onblur="clearInterval(ti);"></textarea>
								<dt style="width: 100%; text-align: right;"><a style="color:#888800;" href="javascript:clear(2);myBlur();compareLists();">clear</a>&nbsp;&nbsp;</dt><dt>
							</dt></td>
						</tr>
						<tr>
							<td style="padding:4px;">
								<input size="10" id="name3" maxlength="16" value="List 3" style="color:rgb(0,128,0);font-weight:bold;" onfocus="focused=$('names');ti=setInterval(myBlur,500);" onblur="clearInterval(ti);" type="textbox">
								<div style="display:inline;font-size:12px;" id="elements3">0</div>
								<br>
								<textarea id="area3" cols="24" rows="5" onchange="compareLists();" wrap="off" onfocus="focused=this;ti=setInterval(myBlur,500);" onblur="clearInterval(ti);"></textarea>
								<dt style="width: 100%; text-align: right;"><a style="color:#00BB00;" href="javascript:clear(3);myBlur();compareLists();">clear</a>&nbsp;&nbsp;</dt><dt>
							</dt></td>
							<td style="padding:4px;">
								<input size="10" id="name4" maxlength="16" value="List 4" style="color:rgb(200,0,0);font-weight:bold;" onfocus="focused=$('names');ti=setInterval(myBlur,500);" onblur="clearInterval(ti);" type="textbox">
								<div style="display:inline;font-size:12px;" id="elements4">0</div>
								<br>
								<textarea id="area4" cols="24" rows="5" onchange="compareLists();" wrap="off" onfocus="focused=this;ti=setInterval(myBlur,500);" onblur="clearInterval(ti);"></textarea>
								<dt style="width: 100%; text-align: right;"><a style="color:#FF0000;" href="javascript:clear(4);myBlur();compareLists();">clear</a>&nbsp;&nbsp;</dt>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:4px;vertical-align:top;padding-top:0px;">
								Results:
								<br>
								<textarea rows="7" id="names" style="width:100%;" wrap="off" onfocus="focused=this;"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center;padding-bottom:12px;font-size:14px;">
								Thank you for using Venny!&nbsp;&nbsp;(please <a href="javascript:showInfo();">cite</a>)
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center;padding-left:8px;padding-right:8px;padding-bottom:4px;font-size:12px;vertical-align:bottom;">
								<i>Venny was first inspired by <a target="seidel" href="http://www.pangloss.com/seidel/Protocols/venn.cgi">this visionary tool</a> by Chris Seidel
							</i></td>
						</tr>
					</table>
				</td>
				<td style="background:#D4D0C8;padding:4px;vertical-align:top;height:100%;">
					<table cellpadding="0" cellspacing="0" border="0" style="background:#D4D0C8;width:100%;height:100%;">
						<tr>
							<td style="width:100px;padding-bottom:0px;vertical-align:top;background:#FFFFFF;">
								<table cellpadding="2" cellspacing="1" border="0" style="width:100%;background:#FFFFFF;" "="">
									<tr>
										<td style="white-space:nowrap;background:#D4D0C8;padding-left:4px;padding-right:4px;">
											Style:
											<select id="selectStyle" onchange="setStyle(this.value);drawAll('mainCanvas');">
												<option value="colored">Colors</option>
												<option value="BW" selected>Solid White</option>
												<option value="gray">By % (slow)</option>
												<option value="transparent">Transparent</option>
											</select>
										</td>
										<td style="white-space:nowrap;background:#D4D0C8;padding-left:4px;padding-right:4px;">
										<input type="checkbox" onchange="setPercentage(this.checked);drawAll('mainCanvas');" checked>Show %
										</td>


										<td style="text-align:left;background:#D4D0C8;vertical-align:top;">
											<table cellpadding="0" cellspacing="0" border="0" style="background:#D4D0C8;">
												<tr>
													<td class="buttonA1" style="text-align:right;color:#336699;padding-left:16px;">Line:</td>
													<td class="buttonA1" onmouseover="this.className='buttonA1B';" onmousedown="this.className='buttonA1C';" onmouseout="this.className='buttonA1';" onmouseup="$('widthBox').value=Math.max(1,parseInt($('widthBox').value)-1);this.className='buttonA1B';setWidth($('widthBox').value);drawAll('mainCanvas');">-</td>
													<td><input style="font-size:10px;text-align:center;" type="textbox" id="widthBox" size="3" maxlength="3" value="3" onchange="setWidth($('widthBox').value);drawAll('mainCanvas');"></td>
													<td class="buttonA1" onmouseover="this.className='buttonA1B';" onmousedown="this.className='buttonA1C';" onmouseout="this.className='buttonA1';" onmouseup="$('widthBox').value++;this.className='buttonA1B';setWidth($('widthBox').value);drawAll('mainCanvas');">+</td>
												</tr>
											</table>
										</td>
										<td style="text-align:left;background:#D4D0C8;">
											<table cellpadding="0" cellspacing="0" border="0" style="background:#D4D0C8;">
												<tr>
													<td class="buttonA1" style="text-align:right;color:#336699;padding-left:16px;">Font:</td>
													<td class="buttonA1" onmouseover="this.className='buttonA1B';" onmousedown="this.className='buttonA1C';" onmouseout="this.className='buttonA1';" onmouseup="$('sizeBox').value=Math.max(2,parseInt($('sizeBox').value)-2);this.className='buttonA1B';setSize($('sizeBox').value);drawAll('mainCanvas');">-</td>
													<td><input style="font-size:10px;text-align:center;" type="textbox" id="sizeBox" size="3" maxlength="3" value="28" onchange="setSize($('sizeBox').value);drawAll('mainCanvas');"></td>
													<td class="buttonA1" onmouseover="this.className='buttonA1B';" onmousedown="this.className='buttonA1C';" onmouseout="this.className='buttonA1';" onmouseup="$('sizeBox').value=parseInt($('sizeBox').value)+2;this.className='buttonA1B';setSize($('sizeBox').value);drawAll('mainCanvas');">+</td>
												</tr>
											</table>
										</td>
										<td style="white-space:nowrap;background:#D4D0C8;padding-left:4px;padding-right:4px;">
											Family:
											<select id="selectFamily" onchange="setFamily(this.value);drawAll('mainCanvas');">
												<option style="font-family:serif" value="Serif" selected>Serif</option>
												<option style="font-family:sans-serif" value="Sans-Serif">Sans Serif</option>
												<option style="font-family:monospace" value="monospace">Monospace</option>
											</select>
										</td>
									</tr>
								</tbody></table>
							</td>
						</tr>
						<tr>
							<td style="background:#FFFFFF;vertical-align:top;text-align:center;height:100%;">
								<div style="background:#FFFFFF;overflow:hidden;position:relative;left:0px;top:0px;height:100%;vertical-align:top;" id="frame">
									<img id="image" width="640px" height="640px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABQAAAAUACAYAAAAY5P/3AAAgAElEQVR4XuzdMVRT2boH8J1KOmKlHbEaO2KlHaEaO0I10xGqa0eo7u2A7t7K0PkqQjdWhM6pCJ1Whs6pDJ1Wxk6rvLWPEwYQBRRIzj6/s9YsdUzO2d/v2++O7+/eZ5eGw+EwuAgQIECAAAECBAgQIECAAAECBAgQSFKgJABMsq+KIkCAAAECBAgQIECAAAECBAgQIJAJCABNBAIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAASPpuFAAACAASURBVAIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIAAAQIECBAgQIAAAQIJCwgAE26u0ggQIECAAAECBAgQIECAAAECBAgIAM0BAgQIECBAgAABAgQIECBAgAABAgkLCAATbq7SCBAgQIAAAQIECBAgQIAAAQIECAgAzQECBAgQIECAAAECBAgQIECAAAECCQsIABNurtIIECBAgAABAgQIECBAgAABAgQICADNAQIECBAgQIDAhAr0+/1weHh4NLrBYBB6vd6J0cbPxH/Ou876brVaDeVy+byvhkqlkv1z/Dr93ZmZma8+c+6NfYAAAQIECBAgQOBGBASAN8LsIQQIECBAgACBLwIxiDs4OMh+3u12j/7dKNi7aKA3yZ7HA8PjQWGtVsuGPTs7e6HgcZJrNDYCBAgQIECAQJ4EBIB56paxEiBAgAABAhMvMAr4RkFeDPbiv0sh2Ltq/FFQePpHAeFVS7sfAQIECBAgUHQBAWDRZ4D6CRAgQIAAgR8S2N/fPwr14kq+s7bY/tCNj33p1q3pcPdu9ejfTE2VT/w6/sbUVHl4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BAgQIECAAAECBAgQIECAQDECAsBi3LVKgAABAgQIECBAgAABAgQIECBAIBcBAWAuzBohQIAAAQIECBAgQIAAAQIECBAgUIyAALAYd60SIECAAAECBAgQIECAAAECBAgQyEVAAJgLs0YIECBAgAABAgQIECBAgAABAgQIFCMgACzGXasECBAgQIAAAQIECBAgQIAAAQIEchEQAObCrBECBAgQIECAAAECBAgQIECAAAECxQgIAItx1yoBAgQIECBAgAABAgQIECBAgACBXAQEgLkwa4QAAQIECBAgQIAAAQIECBAgQIBAMQICwGLctUqAAAECBAgQIECAAAECBAgQIEAgFwEBYC7MGiFAgAABAgQIECBAgAABAgQIECBQjIAAsBh3rRIgQIAAAQIECBAgQIAAAQIECBDIRUAAmAuzRggQIECAAAECBAgQIECAAAECBAgUIyAALMZdqwQIECBAgAABAgQIECBAgAABAgRyERAA5sKsEQIECBAgQIAAAQIECBAgQIAAAQLFCAgAi3HXKgECBAgQIECAAAECBAgQIECAAIFcBASAuTBrhAABAgQIECBAgAABAgQIECBAgEAxAgLAYty1SoAAAQIECBAgQIAAAQIECBAgQCAXAQFgLswaIUCAAAECBAgQIECAAAECBAgQIFCMgACwGHetEiBAgAABAgQIECBAgAABAgQIEMhFQACYC7NGCBAgQIAAAQIECBAgQIAAAQIECBQjIAAsxl2rBAgQIECAAAECBAgQIECAAAECBHIREADmwqwRAgQIECBAgAABAgQIECBAgAABAsUICACLcdcqAQIECBAgQIAAAQIECBAgQIAAgVwEBIC5MGuEAAECBAgQIECAAAECBAgQIECAQDECAsBi3LVKgAABAgQIECBAgAABAgQIECBAIBcBAWAuzBohQIAAAQIECBAgQIAAAQIECBAgUIyAALAYd60SIECAAAECBAgQIECAAAECBAgQyEVAAJgLs0YIECBAgAABAgQIECBAgAABAgQIFCMgACzGXasECBAgQIAAAQIECBAgQIAAAQIEchEQAObCrBECBAgQIECAAAECBAgQIECAAAECxQgIAItx1yoBAgQIECBAgAABAgQIECBAgACBXAQEgLkwa4QAAQIECBAgQIAAAQIECBAgQIBAMQICwGLctUqAAAECBAgQIECAAAECBAgQIEAgFwEBYC7MGiFAgAABAgQIECBAgAABAgQIECBQjIAAsBh3rRIgQIAAAQIECBAgQIAAAQIECBDIRUAAmAuzRggQIECAAAECBAgQIECAAAECBAgUIyAALMZdqwQIECBAgAABAgQIECBAgAABAgRyERAA5sKsEQIECBAgQIAAAQIECBAgQIAAAQLFCAgAi3HXKgECBAgQIECAAAECBAgQIECAAIFcBASAuTBrhAABAgQIECBAgAABAgQIECBAgEAxAgLAYty1SoAAAQIECBAgQIAAAQIECBAgQCAXAQFgLswaIUCAAAECBAgQIECAAAECBAgQIFCMgACwGHetEiBAgAABAgQIECBAgAABAgQIEMhFQACYC7NGCBAgQIAAAQIECBAgQIAAAQIECBQjIAAsxl2rBAgQIECAAAECBAgQIECAAAECBHIREADmwqwRAgQIECBAgAABAgQIECBAgAABAsUICACLcdcqAQIECBAgQIAAAQIECBAgQIAAgVwEBIC5MGuEAAECBAgQIECAAAECBAgQIECAQDECAsBi3LVKgAABAgQIECBAgAABAgQIECBAIBcBAWAuzBohQIAAAQIECBAgQIAAAQIECBAgUIyAALAYd60SIECAAAECBAgQIECAAAECBAgQyEVAAJgLs0YIECBAgAABAgQIECBAgAABAgQIFCMgACzGXasECBAgQIAAAQIECBAgQIAAAQIEchEQAObCrBECBAgQIECAAAECBAgQIECAAAECxQgIAItx1yoBAgQIECBAgAABAgQIECBAgACBXAQEgLkwa4QAAQIECBAgQIAAAQIECBAgQIBAMQICwGLctUqAAAECBAgQIECAAAECBAgQIEAgFwEBYC7MGiFAgAABAgQIECBAgAABAgQIECBQjIAAsBh3rRIgQIAAAQIECBAgQIAAAQIECBDIRUAAmAuzRggQIECAAAECBAgQIECAAAECBAgUIyAALMZdqwQIECBAgAABAgQIECBAgAABAgRyERAA5sKsEQIECBAgQIAAAQIECBAgQIAAAQLFCAgAi3HXKgECBAgQIECAAAECBAgQIECAAIFcBASAuTBrhAABAgQIECBAgAABAgQIECBAgEAxAgLAYty1SoAAAQIECBAgQIAAAQIECBAgQCAXAQFgLswaIUCAAAECBAgQIECAAAECBAgQIFCMgACwGHetEiBAgAABAgQIECBAgAABAgQIEMhFQACYC7NGCBAgQIAAAQIECBAgQIAAAQIECBQjIAAsxl2rBAgQIECAAAECBAgQIECAAAECBHIREADmwqwRAgQIECBAgAABAgQIECBAgAABAsUICACLcdcqAQIECBAgQIAAAQIECBAgQIAAgVwEBIC5MGuEAAECBAgQIECAAAECBAgQIECAQDECAsBi3LVKgAABAgQIECBAgAABAgQIECBAIBcBAWAuzBohQIAAAQIECBAgQIAAAQIECBAgUIyAALAYd60SIECAAAECBAgQIECAAAECBAgQyEVAAJgLs0YIECBAgAABAgQIECBAgAABAgQIFCMgACzGXasECBAgQIAAAQIECBAgQIAAAQIEchEQAObCrBECBAgQIECAAAECBAgQIECAAAECxQgIAItx1yoBAgQIECBAgAABAgQIECBAgACBXAQEgLkwa4QAAQIECBAgQIAAAQIECBAgQIBAMQICwGLctUqAAAECBAgQIECAAAECBAgQIEAgFwEBYC7MGiFAgAABAgQIECBAgAABAgQIECBQjIAAsBh3rRIgQIAAAQIECBAgQIAAAQIECBDIRUAAmAuzRggQIECAAAECBAgQIECAAAECBAgUIyAALMZdqwQIECBAgAABAgQIECBAgAABAgRyERAA5sKsEQIECBAgQIAAAQIECBAgQIAAAQLFCAgAi3HXKgECBAgQIECAAAECBAgQIECAAIFcBASAuTBrhAABAgQIECBAgAABAgQIECBAgEAxAgLAYty1SoAAAQIECBAgQIAAAQIE/v927JgGAACAQZh/13PBniog6QkBAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBDSj+joAAANL0lEQVQgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjYAB+3FUJECBAgAABAgQIECBAgAABAgQIJAIGYMIsQoAAAQIECBAgQIAAAQIECBAgQOAjMINkrFhfX3+aAAAAAElFTkSuQmCC">
									<div class="number" style="padding: 4px; position: absolute; left: 311px; top: 305px; font-size: 14pt; font-family: sans-serif;" id="resultC1000" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C1000');">0</div>
									<div class="numberW" style="padding: 4px; position: absolute; left: 407px; top: -2975px; font-size: 14pt; font-family: sans-serif;" id="resultC0100" onmouseover="this.className='number2';" onmouseout="this.className='numberW';" onclick="showNames('C0100');">0</div>
									<div class="numberW" style="padding: 4px; position: absolute; left: 287px; top: -4335px; font-size: 14pt; font-family: sans-serif;" id="resultC0010" onmouseover="this.className='number2';" onmouseout="this.className='numberW';" onclick="showNames('C0010');">0</div>
									<div class="number" style="padding: 4px; position: absolute; left: 487px; top: -3055px; font-size: 14pt; font-family: sans-serif;" id="resultC0001" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C0001');">0</div>
									<div class="number" style="padding: 4px; position: absolute; left: 287px; top: -2975px; font-size: 14pt; font-family: sans-serif;" id="resultC1100" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C1100');">0</div>
									<div class="number" style="padding: 4px; position: absolute; left: 215px; top: -3215px; font-size: 14pt; font-family: sans-serif;" id="resultC1010" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C1010');">0</div>
									<div class="number" style="padding: 4px; position: absolute; left: 279px; top: -4735px; font-size: 14pt; font-family: sans-serif;" id="resultC1001" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C1001');">0</div>
									<div class="numberW" style="padding: 4px; position: absolute; left: 359px; top: -3215px; font-size: 14pt; font-family: sans-serif;" id="resultC0110" onmouseover="this.className='number2';" onmouseout="this.className='numberW';" onclick="showNames('C0110');">0</div>
									<div class="number" style="padding: 4px; position: absolute; left: 391px; top: -3935px; font-size: 14pt; font-family: sans-serif;" id="resultC0101" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C0101');">0</div>
									<div class="number" style="padding: 4px; position: absolute; left: 407px; top: -2207px; font-size: 14pt; font-family: sans-serif;" id="resultC0011" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C0011');">0</div>
									<div class="number" style="padding: 4px; position: absolute; left: 287px; top: -2815px; font-size: 14pt; font-family: sans-serif;" id="resultC1110" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C1110');">0</div>
									<div class="number" style="padding: 4px; position: absolute; left: 248.6px; top: -4287px; font-size: 14pt; font-family: sans-serif;" id="resultC1101" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C1101');">0</div>
									<div class="number" style="padding: 4px; position: absolute; left: 330.2px; top: -4287px; font-size: 14pt; font-family: sans-serif;" id="resultC1011" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C1011');">0</div>
									<div class="number" style="padding: 4px; position: absolute; left: 343px; top: -2943px; font-size: 14pt; font-family: sans-serif;" id="resultC0111" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C0111');">0</div>
									<div class="number" style="padding: 4px; position: absolute; left: 279px; top: -3935px; font-size: 14pt; font-family: sans-serif;" id="resultC1111" onmouseover="this.className='number2';" onmouseout="this.className='number';" onclick="showNames('C1111');">0</div>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</tbody></table>
	</div>
	<div id="info" style="position:absolute;top:0px;left:0px;width:100%;height:100%;display:none;background:rgba(255,255,255,0.75);">
		<center>
		<table cellpadding="0" cellspacing="4" style="margin-top:16px;background:#E5E4E2;text-align:justify;box-shadow: 2px 5px 10px #888888;border:1px solid #D4D0C8;border-radius:10px;border:2px solid #000000;width:640px;">
			<tr>
				<td style="text-align:right;">
					<input type="button" value="Close" onclick="$('info').style.display='none';" style="border-radius:8px;">
				</td>
			</tr>
			<tr>
				<td style="padding:24px;padding-top:0px;color:#0C090A">
					<p><big><b>Venny's on-line reference</b></big></p>
					<p>
					<i>Oliveros, J.C. (2007-2015) Venny. An interactive tool for comparing lists with Venn's diagrams.</i>
					http://bioinfogp.cnb.csic.es/tools/venny/index.html
					</p>
					<p>
					(If you prefer it, you can still access <a target="old_venny" href="http://bioinfogp.cnb.csic.es/tools/venny_old/index.html">Venny 1.0</a>).
					<br>&nbsp;
					</p>
					<p><big><b>How to use Venny off-line</b></big></p>
					<p>
					Venny consists on a single standard html file.
					Feel free to save it to your hard disk,
					open it with your favorite browser, and start drawing nice Venn's diagrams in seconds, even without internet connection.
					</p>
					<p>
					If you want to set up a public Venny's mirror site, please do not modify this message.
					<br>&nbsp;
					</p>
					<p><big><b>About Venn's diagrams</b></big></p>
					<p>
					There is a great <a target="wiki_venn" href="http://en.wikipedia.org/wiki/Venn_diagram">Wikipedia page</a>
					about the history of Venn's diagrams, their variations and their applications.
					<br>&nbsp;
					</p><p><big><b>Contact</b></big></p>
					<p>
					Juan Carlos Oliveros (oliveros@cnb.csic.es)
					<br>BioinfoGP Service<br>Centro Nacional de Biotecnología, (CNB-CSIC)
					</p>
				</td>
			</tr>
		</table>
	</center></div>
	<canvas id="mainCanvas" style="display: none; position: absolute; top: 0px; width: 1280px; height: 1280px;" width="1280" height="1280"></canvas>
	


</body>
</html>
