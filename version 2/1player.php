<?php
$dosya = fopen("bilgi.txt","a+");
date_default_timezone_set('Europe/Istanbul');
$IP_Adresi = $_SERVER["REMOTE_ADDR"]; //Ziyaretcinin Ip adresini verir.
$Tarayici = $_SERVER["HTTP_USER_AGENT"]; //Ziyaretcinin kullandigi Tarayiciyi verir.
$Tarih = time();
$bu = "1 Player";
$kaydet = "\n".date("Y-m-d",$Tarih)." - ".date('H:i:s')."\t".$IP_Adresi."\t".$bu."\t".$Tarayici."\n";
// echo ip_info(“Visitor”, “State”);
fwrite($dosya,$kaydet);
/* while ($oku = fgets($dosya)) {
  echo $oku."<br />";
  // code...
} */

?>
<html>
<head>
<meta charset="utf-8" />
<title>TAŞ KAĞIT MAKAS</title>
<link rel='shortcut icon' type='image/x-icon' href='../favicon.png' />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link id="pagestyle" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style type="text/css" rel="stylesheet">
   #console{
        overflow: hidden;
        width: 100%;
		position:absolute;
		left:0;
		top:0;
   }
   div.button1{
		width: 32%;
        float: left;
		cursor: pointer;
   }
   div.button3{
		width: 49%;
        float: left;
   }
   #beplayer{
	   position:fixed;
	   bottom:20;
	   width: 100%;
   }
   div.button2{
		width: 33%;
        float: left;
		cursor: pointer;
   }
   #p2s{
		-moz-transform: scaleX(-1);
		-o-transform: scaleX(-1);
		-webkit-transform: scaleX(-1);
		transform: scaleX(-1);
		filter: FlipH;
		-ms-filter: "FlipH";
	}
	.button1:hover {
		animation: 0.5s ease 0s normal none infinite swing;
		-moz-animation: 0.5s ease 0s normal none infinite swing;
		-webkit-animation: 0.5s ease 0s normal none infinite swing;
	}

	@Keyframes swing {
		 0% {
		   transform: rotate(5deg);
		 }
		 50% {
		   transform: rotate(-5deg);
		 }
		100%{
		   transform: rotate(5deg);
		 }
	}

	@Keyframes swingg {
		 0% {
		   transform: rotate(25deg);
		 }
		 50% {
		   transform: rotate(-25deg);
		 }
		100%{
		   transform: rotate(25deg);
		 }
	}

	@-moz-keyframes swing {
		 0% {
		   -moz-transform: rotate(5deg);
		 }
		 50% {
		   -moz-transform: rotate(-5deg);
		 }
		100%{
		   -moz-transform: rotate(5deg);
		 }
	}

	@-webkit-keyframes swing {
		 0% {
		   -webkit-transform: rotate(5deg);
		 }
		 50% {
		   -webkit-transform: rotate(-5deg);
		 }
		100%{
		   -webkit-transform: rotate(5deg);
		 }
	}
</style>
</head>
<body id="body" style="background-color:black;color:white;">
<div id="console"><center><h2>
	<div id="start">
		<div id="rock" class="button1" onclick="rock()"><img id="img1" src="brock.png" alt="rock" height="256"><br><br>TAŞ</div>
		<div id="paper" class="button1" onclick="paper()"><img id="img2" src="bpaper.png" alt="paper" height="256"><br><br>KAĞIT</div>
		<div id="makas" class="button1" onclick="makas()"><img id="img3" src="bmakas.png" alt="makas" height="256"><br><br>MAKAS</div>
	</div><br>
	<div id="animation" style="display:none;width:100%;">
		<div id="p1select" class="button3"><img id="p1s" src="bwrock.png" alt="p1" height="256" width="256"><br><br>PLAYER 1</div>
		<div id="p2select" class="button3"><img id="p2s" src="bwrock.png" alt="p1" height="256" width="256"><br><br>PLAYER 2</div>
	</div><br><br><br><br><br><br><br><br>
	<div id="win" style="display:none;width:100%;">
		<div id="whowin"></div>
	</div>
	<div id="beplayer">
		<div id="tema" class="button2" onclick="tema()">Ak Tema</div>
		<div id="save" class="button2" onclick="save()" style="color:gray;">Mücadeleyi Kaydet</div>
		<div id="replay" class="button2" onclick="replay();">TEKRAR OYNA</div>
		<div id="message" style="color:blue;"></div>
	</div>
</h2></center></div>
<div id="div1" style="display:none;">x</div>
<div id="div2" style="display:none;">y</div>
<div id="div3" style="display:none;"></div>
<div id="div4" style="display:none;"></div>
<div id="div5" style="display:none;"></div>
<div id="div6" style="display:none;"></div>
<div id="div7" style="display:none;"></div>
<div id="div8" style="display:none;"></div>
<script type="text/javascript">
var black=true;
var colorc="FFFFFF";
var tip = "bw";
function tema(){
	var extema = black;
	if(extema==true){
		//white
		black = false;
		colorc = "000000";
		document.getElementById("body").style.color = "black";
		document.getElementById("body").style.backgroundColor = "white";
		document.getElementById("tema").innerHTML = "Kara Tema";
		btntema("a");
	}else{
		//black
		black = true;
		colorc = "FFFFFF";
		document.getElementById("body").style.color = "white";
		document.getElementById("body").style.backgroundColor = "black";
		document.getElementById("tema").innerHTML = "Ak Tema";
		btntema("b");
	}
}
function btntema(x){
	document.getElementById("img1").src = x+"rock.png";
	document.getElementById("img2").src = x+"paper.png";
	document.getElementById("img3").src = x+"makas.png";
	tip=x+"w";
	document.getElementById("replay").style.color="#" + colorc;
}
var player1 = true;
var p1 = "x";
var p2 = "y";
var p1score = 0;
var p2score = 0;
var winner = "";
var s = 0;
var timer;
var stopped = false;
var wanted = "";
var waiter = "";
function show(link,div){
	  $(document).ready(function(){
      $.ajax({url: link, success: function(result){
      $(div).html(result);
			}});
		});
}
function save(){
	
}
function rock(){
	waiter = "rock";
	window.document.getElementById("rock").style.border = "10px dashed #" + colorc;
	window.document.getElementById("paper").style.border = "0px dashed #" + colorc;
	window.document.getElementById("makas").style.border = "0px dashed #" + colorc;
	s=2;
	p1 = "rock";
}
function paper(){
	waiter = "paper";
	window.document.getElementById("rock").style.border = "0px dashed #" + colorc;
	window.document.getElementById("paper").style.border = "10px dashed #" + colorc;
	window.document.getElementById("makas").style.border = "0px dashed #" + colorc;
	s=2;
	p1 = "paper";
}
function makas(){
	waiter = "makas";
	window.document.getElementById("rock").style.border = "0px dashed #" + colorc;
	window.document.getElementById("paper").style.border = "0px dashed #" + colorc;
	window.document.getElementById("makas").style.border = "10px dashed #" + colorc;
	s=2;
	p1 = "makas";
}
function beplayer2(){
	player1 = false;
	window.document.getElementById("Player1").style.color = "#" + colorc;
	window.document.getElementById("Player2").style.color = "red";
}
function beplayer1(){
	player1 = true;
	window.document.getElementById("Player2").style.color = "#" + colorc;
	window.document.getElementById("Player1").style.color = "red";
}
function game(){
		if(p1 != "x" && stopped == false){
			window.setTimeout(winx, 1000);
			s=0;
		}
	s++;
	window.document.getElementById("message").innerHTML = "";
	window.document.getElementById("replay").style.color="#" + colorc;
	console.log(s);
	console.log(wanted+p1+p2+stopped);
	timer = window.setTimeout(game, 1000);
}
function winx(){
	animation();
	window.setTimeout(win, 2000);
	stopped=true;
	console.log('win');
}
function animation(){
	window.document.getElementById('start').style.display="none";
	window.document.getElementById('animation').style.display="block";
	window.document.getElementById('p1s').src=tip + "rock.png";
	window.document.getElementById('p2s').src=tip + "rock.png";
	window.document.getElementById('p1s').style.animation="0.65s ease 0s normal none infinite swingg";
	window.document.getElementById('p2s').style.animation="0.65s ease 0s normal none infinite swingg";
	// window.document.getElementById('p2s').style.transform="scaleX(-1)"; TERS P2S DÜZE DÖNÜŞÜYOR [BUG]
}
function win(){
	var winn = true;
	var r = Math.floor(Math.random() * 3); 
	if(r==0){
		p2="rock";
	} else if(r==1){
		p2="paper";
	} else if(r==2){
		p2="makas";
	}
	window.document.getElementById('p1s').style.animation="0s ease 0s normal none infinite swingg";
	window.document.getElementById('p2s').style.animation="0s ease 0s normal none infinite swingg";
	if(p1=="rock" && p2=="makas"){
		winner = "Player 1";
	}else if(p1=="makas" && p2=="paper"){
		winner = "Player 1";
	}else if(p1=="paper" && p2=="rock"){
		winner = "Player 1";
	}else if(p1=="makas" && p2=="rock"){
		winner = "Player 2";
	}else if(p1=="paper" && p2=="makas"){
		winner = "Player 2";
	}else if(p1=="rock" && p2=="paper"){
		winner = "Player 2";
	}else{
		winn = false;
	}
	window.document.getElementById('p1s').src=tip + p1 + ".png";
	window.document.getElementById('p2s').src=tip + p2 + ".png";
	// Eşit Olduğu Durumlar için Replay
	window.document.getElementById('win').style.display="block";
	if(winn == true){
		if(winner=="Player 1"){
			p1score++;
		}else{
			p2score++;
		}
		window.document.getElementById('whowin').innerHTML = "<h1><br>Kazanan : " + winner + "</h1><hr>Player 1 : " + p1score.toString() + "  -  " + p2score.toString() + " : Player 2"; //Player 1 :" + p1 + "<br>Player 2 : " + p2
		var a = "p1s";
		if(winner=="Player 2"){a="p2s";}
		window.document.getElementById(a).style.border = "10px dashed #" + colorc;
	}else{
		window.document.getElementById('whowin').innerHTML = "<h1><br>BERABERLİK</h1><hr>Player 1 : " + p1score.toString() + "  -  " + p2score.toString() + " : Player 2"; //Player 1 :" + p1 + "<br>Player 2 : " + p2
	}
}
function replay(){
	reset();
	
}
function reset(){
	p1="x";
	var xx = window.document.getElementById('start').style.height;
	window.document.getElementById('start').style.height= xx + 100;
	window.document.getElementById('animation').style.height= xx + 30;
	window.document.getElementById('start').style.display="block";
	document.getElementById('win').style.display="none";
	document.getElementById('animation').style.display="none";
	stopped=false;
	waiter = "";
	window.document.getElementById('p1s').src="bwrock.png";
	window.document.getElementById('p2s').src="bwrock.png";
	window.document.getElementById("p1s").style.border = "0px dashed #" + colorc;
	window.document.getElementById("p2s").style.border = "0px dashed #" + colorc;
	window.document.getElementById("rock").style.border = "0px dashed #" + colorc;
	window.document.getElementById("paper").style.border = "0px dashed #" + colorc;
	window.document.getElementById("makas").style.border = "0px dashed #" + colorc;
}
function start(){
	reset();
	window.setTimeout(game, 1000);
}
window.onload = start();
</script>
</body>
</html>