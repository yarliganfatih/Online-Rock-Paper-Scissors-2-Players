<?php
$txt = "";
$txt = file_get_contents("p1.json"); //show
?>
<html>
<head>
<meta charset="utf-8" />
<title>TAŞ KAĞIT MAKAS - Demo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link id="pagestyle" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<div id="Player1" class="button" onclick="beplayer1()" style="color:red;">Player 1 OL</div>
<div id="Player2" class="button" onclick="beplayer2()" style="color:black;">Player 2 OL</div>
<div id="stone" class="button" onclick="stone()" style="color:black;">TAŞ</div>
<div id="paper" class="button" onclick="paper()" style="color:black;">KAĞIT</div>
<div id="makas" class="button" onclick="makas()" style="color:black;">MAKAS</div>
<div id="win" style="display:none;">
	<div id="whowin"></div>
	<div class="button" onclick="window.location.reload();">REPLAY</div>
</div>
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
	// Eşit Olduğu Durumlar için Replay
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
</html>