<?php 
$banner_468x60[0] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/468x60_a/01_468x60.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$banner_468x60[1] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/468x60_a/02_468x60.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$banner_468x60[2] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/468x60_a/03_468x60.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$banner_468x60[3] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/468x60_a/04_468x60.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$banner_468x60[4] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/468x60_a/05_468x60.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$number = rand(0, sizeof($banner_468x60) - 1); 
echo $banner_468x60[$number]; 
?>