<?php 
$rotate[0] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/180x300/01_180x300.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[1] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/180x300/02_180x300.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[2] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/180x300/03_180x300.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[3] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/180x300/04_180x300.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[4] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/180x300/05_180x300.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$number = rand(0, sizeof($rotate) - 1); 
echo $rotate[$number]; 
?>