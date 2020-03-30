<?php
$txt = "";
$txt = file_get_contents("p1.json"); //show
?>
<html>
<head>
<meta charset="utf-8" />
<title>TAŞ KAĞIT MAKAS - Demo</title>
<style type="text/css" rel="stylesheet">
   #console{
		border: 0px solid #000000;
        overflow: hidden;
        width: 100%;
		position:absolute;
		left:0;
		top:0;
   }
   div.button1{
		width: 33%;
        float: left;
		cursor: pointer;
		color:white;
   }
   div.button2{
		width: 50%;
        float: left;
		cursor: pointer;
		color:white;
   }
</style>
</head>
<body style="padding: 0; margin: 0;height: 100%;width: 100%;overflow: hidden;" onload="start()" onresize="resize()" onorientationchange="resize()">
<div><canvas id="starfield" ></canvas></div>
<div id="console"><center><h2>
	<div id="start">
		<div id="stone" class="button1" onclick="stone()"><img src="wstone.png" alt="stone" height="256"><br><br>TAŞ</div>
		<div id="paper" class="button1" onclick="paper()"><img src="wpaper.png" alt="paper" height="256"><br><br>KAĞIT</div>
		<div id="makas" class="button1" onclick="makas()"><img src="wmakas.png" alt="makas" height="256"><br><br>MAKAS</div>
	</div>
	<div id="animation" style="display:none;">
		
	</div><br>
	<div id="win" style="display:none;">
		<div id="whowin"></div>
		<div class="button2" onclick="window.location.reload();">REPLAY</div>
	</div>
<div id="Player1" class="button2" onclick="beplayer1()" style="color:red;">Player 1 OL</div>
<div id="Player2" class="button2" onclick="beplayer2()">Player 2 OL</div>
<br><br></h2></center></div>
<div id="div1" style="display:none;">x</div>
<div id="div2" style="display:none;">y</div>
<div id="div3" style="display:none;"></div>
<div id="div4" style="display:none;"></div>
<script type="text/javascript">
var player1 = true;
var p1 = "";
var p2 = "";
var winner = "";
var s = 0;
var timer;
function show(link,div){
	  $(document).ready(function(){
      $.ajax({url: link, success: function(result){
      $(div).html(result);
			}});
		});
}
function stone(){
	if(player1 == true){
		show("stone1.php","#div3");
	}else{
		show("stone2.php","#div3");
	}
	window.document.getElementById("stone").style.color = "blue";
	window.document.getElementById("paper").style.color = "black";
	window.document.getElementById("makas").style.color = "black";
}
function paper(){
	if(player1 == true){
		show("paper1.php","#div3");
	}else{
		show("paper2.php","#div3");
	}
	window.document.getElementById("stone").style.color = "black";
	window.document.getElementById("paper").style.color = "blue";
	window.document.getElementById("makas").style.color = "black";
}
function makas(){
	if(player1 == true){
		show("makas1.php","#div3");
	}else{
		show("makas2.php","#div3");
	}
	window.document.getElementById("stone").style.color = "black";
	window.document.getElementById("paper").style.color = "black";
	window.document.getElementById("makas").style.color = "blue";
}
function beplayer2(){
	player1 = false;
	window.document.getElementById("Player1").style.color = "black";
	window.document.getElementById("Player2").style.color = "red";
}
function beplayer1(){
	player1 = true;
	window.document.getElementById("Player2").style.color = "black";
	window.document.getElementById("Player1").style.color = "red";
}
function game(){
	show("show1.php","#div1");
	show("show2.php","#div2");
	p1 = window.document.getElementById("div1").innerHTML;
	p2 = window.document.getElementById("div2").innerHTML;
	s=s+1;
	console.log(s);
	if(s>=5){
		if(p1 != "x" && p2 != "y"){
			win();
		}
		s=0;
	}
	window.setTimeout(game, 1000);
}
function timer(){
	timer = setInterval(game(), 10000);
}
function win(){
	clearInterval(timer);
	if(p1=="stone" && p2=="makas"){
		winner = "Player 1";
	}else if(p1=="makas" && p2=="paper"){
		winner = "Player 1";
	}else if(p1=="paper" && p2=="stone"){
		winner = "Player 1";
	}else if(p1=="makas" && p2=="stone"){
		winner = "Player 2";
	}else if(p1=="paper" && p2=="makas"){
		winner = "Player 2";
	}else if(p1=="stone" && p2=="paper"){
		winner = "Player 2";
	}
	// EÅit OlduÄu Durumlar iÃ§in Replay
	window.document.getElementById('win').style.display="block";
	if(player1 == true){
		window.document.getElementById('whowin').innerHTML = "<hr>Kazanan : " + winner + "<hr>Player 1 :" + p1 + "<br>Player 2 : " + p2;
	}else{
		window.document.getElementById('whowin').innerHTML = "<hr>Kazanan : " + winner + "<hr>Player 1 :" + p1 + "<br>Player 2 : " + p2;
	}
}
function reset(){
	document.getElementById('win').style.display="none";
	show("reset.php","#div4");
	game();
}
window.onload = reset();
</script>
  </body>
<script type="text/javascript">
	function $i(id) { return document.getElementById(id); }
function $r(parent,child) { (document.getElementById(parent)).removeChild(document.getElementById(child)); }
function $t(name) { return document.getElementsByTagName(name); }
function $c(code) { return String.fromCharCode(code); }

function get_screen_size()
	{
		var w=document.documentElement.clientWidth;
		var h=document.documentElement.clientHeight;
		return Array(w,h);
	}

var url=document.location.href;

var flag=true;
var test=true;
var n=parseInt((url.indexOf('n=')!=-1)?url.substring(url.indexOf('n=')+2,((url.substring(url.indexOf('n=')+2,url.length)).indexOf('&')!=-1)?url.indexOf('n=')+2+(url.substring(url.indexOf('n=')+2,url.length)).indexOf('&'):url.length):2512);
var star_color_ratio=0;
var star_ratio=256;
var star_speed=0.7;
var star=new Array(n);
var color;

var timeout;
var fps=0;

function init() {
	var a=0;
	for(var i=0;i<n;i++) {
		star[i]=new Array(5);
		star[i][0]=Math.random()*w*2-x*2;
		star[i][1]=Math.random()*h*2-y*2;
		star[i][2]=Math.round(Math.random()*z);
		star[i][3]=0;
		star[i][4]=0;
	}
	var starfield=$i('starfield');
	starfield.style.position='absolute';
	starfield.width=w;
	starfield.height=h;
	context=starfield.getContext('2d');
	context.lineCap='round';
	context.fillStyle='rgb(0,0,0)';
	context.strokeStyle='rgb(255,255,255)';
}

function anim() {
	mouse_x=cursor_x-x;
	mouse_y=cursor_y-y;
	context.fillRect(0,0,w,h);
	for(var i=0;i<n;i++) {
		test=true;
		star_x_save=star[i][3];
		star_y_save=star[i][4];
		star[i][0]+=mouse_x>>4; if(star[i][0]>x<<1) { star[i][0]-=w<<1; test=false; } if(star[i][0]<-x<<1) { star[i][0]+=w<<1; test=false; }
		star[i][1]+=mouse_y>>4; if(star[i][1]>y<<1) { star[i][1]-=h<<1; test=false; } if(star[i][1]<-y<<1) { star[i][1]+=h<<1; test=false; }
		star[i][2]-=star_speed; if(star[i][2]>z) { star[i][2]-=z; test=false; } if(star[i][2]<0) { star[i][2]+=z; test=false; }
		star[i][3]=x+(star[i][0]/star[i][2])*star_ratio;
		star[i][4]=y+(star[i][1]/star[i][2])*star_ratio;
		if(star_x_save>0&&star_x_save<w&&star_y_save>0&&star_y_save<h&&test) {
			context.lineWidth=(1-star_color_ratio*star[i][2])*2;
			context.beginPath();
			context.moveTo(star_x_save,star_y_save);
			context.lineTo(star[i][3],star[i][4]);
			context.stroke();
			context.closePath();
			}
		}
	timeout=setTimeout('anim()',fps);
}

function start() {
	resize();
	anim();
}

function resize() {
	w=parseInt((url.indexOf('w=')!=-1)?url.substring(url.indexOf('w=')+2,((url.substring(url.indexOf('w=')+2,url.length)).indexOf('&')!=-1)?url.indexOf('w=')+2+(url.substring(url.indexOf('w=')+2,url.length)).indexOf('&'):url.length):get_screen_size()[0]);
	h=parseInt((url.indexOf('h=')!=-1)?url.substring(url.indexOf('h=')+2,((url.substring(url.indexOf('h=')+2,url.length)).indexOf('&')!=-1)?url.indexOf('h=')+2+(url.substring(url.indexOf('h=')+2,url.length)).indexOf('&'):url.length):get_screen_size()[1]);
	x=Math.round(w/2);
	y=Math.round(h/2);
	z=(w+h)/2;
	star_color_ratio=1/z;
	cursor_x=x;
	cursor_y=y;
	init();
}
  </script>
</html>