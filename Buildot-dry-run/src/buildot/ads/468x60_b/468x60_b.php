<?php 
$banner_468x60[0] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/468x60_b/06_468x60.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$banner_468x60[1] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/468x60_b/07_468x60.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$banner_468x60[2] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/468x60_b/08_468x60.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$banner_468x60[3] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/468x60_b/09_468x60.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$banner_468x60[4] = "<a target= _blank href='http://kunoozdubai.com'><img src='ads/468x60_b/10_468x60.png' alt='ALTERNATIVE_TEXT' /></a>"; 
$number = rand(0, sizeof($banner_468x60) - 1); 
echo $banner_468x60[$number]; 
?>