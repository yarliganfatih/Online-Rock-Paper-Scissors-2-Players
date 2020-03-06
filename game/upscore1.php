<?php 
$txt = file_get_contents("p1score.json");
++$txt;
file_put_contents("p1score.json", $txt); 
?>