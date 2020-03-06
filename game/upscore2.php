<?php 
$txt = file_get_contents("p2score.json");
++$txt;
file_put_contents("p2score.json", $txt); 
?>