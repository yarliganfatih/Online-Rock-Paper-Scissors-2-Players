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
			window.document.getElementById("message").innerHTML = "DiÄer Oyuncu Sana Meydan Okuyor";
			var colorr = window.document.getElementById("replay").style.color;
			if(colorr=="white"){
				window.document.getElementById("replay").style.color="blue";
			}else{
				window.document.getElementById("replay").style.color="white";
			}
		}
	} else if(wanted=="wait"){
		if(stopped==false && waiter==""){
			window.document.getElementById("message").innerHTML = "DiÄer Oyuncu Seni Bekliyor";
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
	// window.document.getElementById('p2s').style.transform="scaleX(-1)"; TERS P2S DÃZE DÃNÃÅÃYOR [BUG]
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
	// EÅit OlduÄu Durumlar iÃ§in Replay
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
		window.document.getElementById('whowin').innerHTML = "<h1><br>BERABERLÄ°K</h1><hr>Player 1 : " + p1score.toString() + "  -  " + p2score.toString() + " : Player 2"; //Player 1 :" + p1 + "<br>Player 2 : " + p2
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