<?php 
$rotate[0] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/200x600/01_200x600.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[1] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/200x600/02_200x600.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[2] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/200x600/03_200x600.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[3] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/200x600/04_200x600.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[4] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/200x600/05_200x600.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$number = rand(0, sizeof($rotate) - 1); 
echo $rotate[$number]; 
?>