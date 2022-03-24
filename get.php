<?php 
$url = $_GET["a"];
$html = file_get_contents($url);
echo $html;
?>