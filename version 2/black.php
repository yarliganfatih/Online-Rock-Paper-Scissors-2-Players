<?php
$txt="";
$dosya = fopen("bilgi.txt","a+");

$IP_Adresi = $_SERVER["REMOTE_ADDR"]; //Ziyaretcinin Ip adresini verir.
$Tarayici = $_SERVER["HTTP_USER_AGENT"]; //Ziyaretcinin kullandigi Tarayiciyi verir.
$Tarih = time();
// echo ip_info(“Visitor”, “State”);
$kaydet = $IP_Adresi."\t".$Tarayici."\t".$Tarih."\n";

fwrite($dosya,$kaydet);
while ($oku = fgets($dosya)) {
  echo $oku."<br />";
  // code...
}

?>
<html>
<head>
<meta charset="utf-8" />
<title>TAŞ KAĞIT MAKAS - Demo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link id="pagestyle" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style type="text/css" rel="stylesheet">
   #console{
		border: 0px solid #FFFFFF;
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
		color: white;
   }
   div.button3{
		width: 49%;
        float: left;
		color: white;
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
		color: white;
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
<body style="background-color:black;color:white;">
<div id="console"><center><h2>
	<div id="start">
		<div id="rock" class="button1" onclick="rock()"><img src="wrock.png" alt="rock" height="256"><br><br>TAŞ</div>
		<div id="paper" class="button1" onclick="paper()"><img src="wpaper.png" alt="paper" height="256"><br><br>KAĞIT</div>
		<div id="makas" class="button1" onclick="makas()"><img src="wmakas.png" alt="makas" height="256"><br><br>MAKAS</div>
	</div><br>
	<div id="animation" style="display:none;width:100%;">
		<div id="p1select" class="button3"><img id="p1s" src="bwrock.png" alt="p1" height="256" width="256"><br><br>PLAYER 1</div>
		<div id="p2select" class="button3"><img id="p2s" src="bwrock.png" alt="p1" height="256" width="256"><br><br>PLAYER 2</div>
	</div><br><br><br><br><br><br><br><br>
	<div id="win" style="display:none;width:100%;">
		<div id="whowin"></div>
	</div>
	<div id="beplayer">
		<div id="Player1" class="button2" onclick="beplayer1()" style="color:red;">Player 1 OL</div>
		<div id="Player2" class="button2" onclick="beplayer2()">Player 2 OL</div>
		<div id="replay" class="button2" onclick="replay();" style="color:white;">TEKRAR OYNA</div>
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
var player1 = true;
var p1 = "";
var p2 = "";
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
function rock(){
	waiter = "rock";
	if(player1 == true){
		show("rock1.php","#div3");
	}else{
		show("rock2.php","#div3");
	}
	window.document.getElementById("rock").style.border = "10px dashed #FFFFFF";
	window.document.getElementById("paper").style.border = "0px dashed #FFFFFF";
	window.document.getElementById("makas").style.border = "0px dashed #FFFFFF";
	s=2;
	if(wanted=="wait"){
		show("wantgo.php","#div6");
	}else{
		show("wantwait.php","#div6");
	}
}
function paper(){
	waiter = "paper";
	if(player1 == true){
		show("paper1.php","#div3");
	}else{
		show("paper2.php","#div3");
	}
	window.document.getElementById("rock").style.border = "0px dashed #FFFFFF";
	window.document.getElementById("paper").style.border = "10px dashed #FFFFFF";
	window.document.getElementById("makas").style.border = "0px dashed #FFFFFF";
	s=2;
	if(wanted=="wait"){
		show("wantgo.php","#div6");
	}else{
		show("wantwait.php","#div6");
	}
}
function makas(){
	waiter = "makas";
	if(player1 == true){
		show("makas1.php","#div3");
	}else{
		show("makas2.php","#div3");
	}
	window.document.getElementById("rock").style.border = "0px dashed #FFFFFF";
	window.document.getElementById("paper").style.border = "0px dashed #FFFFFF";
	window.document.getElementById("makas").style.border = "10px dashed #FFFFFF";
	s=2;
	if(wanted=="wait"){
		show("wantgo.php","#div6");
	}else{
		show("wantwait.php","#div6");
	}
}
function beplayer2(){
	player1 = false;
	window.document.getElementById("Player1").style.color = "white";
	window.document.getElementById("Player2").style.color = "red";
}
function beplayer1(){
	player1 = true;
	window.document.getElementById("Player2").style.color = "white";
	window.document.getElementById("Player1").style.color = "red";
}
function game(){
	show("p1.php","#div1");
	show("p2.php","#div2");
	show("showwant.php","#div5");
	p1 = window.document.getElementById("div1").innerHTML;
	p2 = window.document.getElementById("div2").innerHTML;
	wanted = window.document.getElementById("div5").innerHTML;
		if(p1 != "x" && p2 != "y" && stopped == false && wanted != "replay"){
			window.setTimeout(winx, 1000);
			s=0;
		}
	s++;
	window.document.getElementById("message").innerHTML = "";
	window.document.getElementById("replay").style.color="white";
	if(wanted=="go"){
		//animation();
	} else if(wanted=="replay"){
		if(stopped==true){
			window.document.getElementById("message").innerHTML = "Diğer Oyuncu Sana Meydan Okuyor";
			var colorr = window.document.getElementById("replay").style.color;
			if(colorr=="white"){
				window.document.getElementById("replay").style.color="blue";
			}else{
				window.document.getElementById("replay").style.color="white";
			}
		}
	} else if(wanted=="wait"){
		if(stopped==false && waiter==""){
			window.document.getElementById("message").innerHTML = "Diğer Oyuncu Seni Bekliyor";
		}
	}
	console.log(s);
	console.log(wanted+p1+p2+stopped);
	timer = window.setTimeout(game, 1000);
}
function winx(){
	if(wanted == "go"){
	animation();
	window.setTimeout(win, 2000);
	stopped=true;
	console.log('win');
	}
}
function animation(){
	if(wanted!="replay"){
	window.document.getElementById('start').style.display="none";
	window.document.getElementById('animation').style.display="block";
	window.document.getElementById('p1s').style.animation="0.65s ease 0s normal none infinite swingg";
	window.document.getElementById('p2s').style.animation="0.65s ease 0s normal none infinite swingg";
	// window.document.getElementById('p2s').style.transform="scaleX(-1)"; TERS P2S DÜZE DÖNÜŞÜYOR [BUG]
	}else{
		reset();
	}
}
function win(){
	if(wanted!="replay"){
	var winn = true;
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
	window.document.getElementById('p1s').src="bw" + p1 + ".png";
	window.document.getElementById('p2s').src="bw" + p2 + ".png";
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
		window.document.getElementById(a).style.border = "10px dashed #FFFFFF";
	}else{
		window.document.getElementById('whowin').innerHTML = "<h1><br>BERABERLİK</h1><hr>Player 1 : " + p1score.toString() + "  -  " + p2score.toString() + " : Player 2"; //Player 1 :" + p1 + "<br>Player 2 : " + p2
	}
	}else{
		reset();
	}
}
function replay(){
	if(wanted=="replay"){
		show("wantbos.php","#div6");
	}else{
		show("wantreplay.php","#div6");
		wanted="replay";
	}
	//window.location.reload();
	window.setTimeout(reset, 1000);
	
}
function reset(){
	var xx = window.document.getElementById('start').style.height;
	window.document.getElementById('start').style.height= xx + 100;
	window.document.getElementById('animation').style.height= xx + 30;
	window.document.getElementById('start').style.display="block";
	document.getElementById('win').style.display="none";
	document.getElementById('animation').style.display="none";
	show("reset.php","#div4");
	stopped=false;
	waiter = "";
	window.document.getElementById('p1s').src="bwrock.png";
	window.document.getElementById('p2s').src="bwrock.png";
	window.document.getElementById("p1s").style.border = "0px dashed #FFFFFF";
	window.document.getElementById("p2s").style.border = "0px dashed #FFFFFF";
	window.document.getElementById("rock").style.border = "0px dashed #FFFFFF";
	window.document.getElementById("paper").style.border = "0px dashed #FFFFFF";
	window.document.getElementById("makas").style.border = "0px dashed #FFFFFF";
}
function start(){
	reset();
	window.setTimeout(game, 1000);
}
window.onload = start();
</script>
</body>
</html>