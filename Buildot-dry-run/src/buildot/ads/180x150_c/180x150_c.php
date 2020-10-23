<?php 
$rotate[0] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/180x150_c/11_180x150.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[1] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/180x150_c/12_180x150.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[2] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/180x150_c/13_180x150.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[3] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/180x150_c/14_180x150.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$rotate[4] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/180x150_c/15_180x150.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$number = rand(0, sizeof($rotate) - 1); 
echo $rotate[$number]; 
?>