<?php

//////////////////////////////////
// validate email address
////////
function validateEmail($email){

	if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$",trim($email))){
	
		return TRUE;
	
	} else {
	
		return FALSE;
	
	}

}


//function checkAdmin(){
	//if(empty($_SESSION['user']['email'])){
		//header("Location: index.php");
		//exit;
	//}
//}

	function checkAdmin()
	{
		global $s;
		
	//echo "before";
		if(empty($s->userId) || $s->type != 1)
		{	
		//echo "inside if";
		
			$user = '';
		$_SESSION['user'] = '';
		unset($_SESSION);
			header("Location: ".SITEURL);
			exit;
		}
		
	}
//////////////////////////////////
// $_GET
//////////////////////////////////
function get($var){
	return mysql_real_escape_string($_GET[$var]);
}

//////////////////////////////////
// $_POST
//////////////////////////////////
function post($var){
	return mysql_real_escape_string($_POST[$var]);
}

//////////////////////////////////
// $_REQUEST
//////////////////////////////////
function request($var){
	return mysql_real_escape_string($_REQUEST[$var]);
}

//////////////////////////////////
// REDIRECT
//////////////////////////////////
function rd($view){
	header("Location: ".SITEURL.'index.php?view='.$view);
	exit;
}

//////////////////////////////////
// Encoding / Decoding
//////////////////////////////////
function md($val){
	return md5($val);
}


//////////////////////////////////
// SESSION ERROR / MESSAGES
//////////////////////////////////
function showMessages() {
	@session_start();
	if (isset($_SESSION['messages'])) {
		$messages = $_SESSION['messages'];
		echo '<div class="messages">';
		if (is_array($messages)) {
			echo "<ul>";
			foreach ($messages as $message) {
				echo sprintf('<li>%s</li>', $message);
			}
			echo "</ul>";
		}else{
			echo "<p>$messages</p>";
		}
		echo '</div>';
		unset($_SESSION['messages']);
	}
	if (isset($_SESSION['errors'])) {
		$errors = $_SESSION['errors'];
		echo '<div class="messages errors">';
		if (is_array($errors)) {
			echo '<ul>';
			foreach($errors as $error) {
				echo sprintf('<li>%s</li>', $error);
			}
			echo '</ul>';
		} else {
			echo "<p>$errors</p>";
		}
		echo '</div>';
		unset($_SESSION['errors']);
	}
	session_write_close();
}


function showAdminMessages() {
	@session_start();
	if (isset($_SESSION['messages'])) {
		$messages = $_SESSION['messages'];
		echo '<div class="notification success png_bg">';
		if (is_array($messages)) {
			echo "<ul>";
			foreach ($messages as $message) {
				echo sprintf('<li>%s</li>', $message);
			}
			echo "</ul>";
		}else{
			echo "<p>$messages</p>";
		}
		echo '</div>';
		unset($_SESSION['messages']);
	}
	if (isset($_SESSION['errors'])) {
		$errors = $_SESSION['errors'];
		echo '<div class="notification error png_bg">
		<div>';
		if (is_array($errors)) {
			echo '<ul>';
			foreach($errors as $error) {
				echo sprintf('<li>%s</li>', $error);
			}
			echo '</ul>';
		} else {
			echo "<p>$errors</p>";
		}
		echo '</div></div>';
		unset($_SESSION['errors']);
	}
	session_write_close();
}

//////////////////////////////////
// DEBUG
//////////////////////////////////
function debug($val = array())
{
	echo "<pre>";
	print_r($val);
	echo "</pre>";
}




function captcha(){
	
	echo "<img src='captcha.jpg' alt='captcha' />";
}


function DocUpload($file='file'){

	$folder = date("m-Y");
	if(!is_dir(ROOTPATH.FOLDERS.$folder)){
		mkdir(ROOTPATH.FOLDERS.$folder, 0777);
		chmod(ROOTPATH.FOLDERS.$folder, 0777);
	}
	$folder = date("m-Y")."/";

	
	$ext = getExtension($_FILES[$file]['name']);
	$filename = str_replace('.', '', microtime(true)).'.'.$ext;
	
			
	$upload = new Upload();
	$upload->SetFileName($filename);
	$upload->SetTempName($_FILES[$file]['tmp_name']);
	$upload->SetUploadDirectory(ROOTPATH.FOLDERS.$folder); //Upload directory, this should be writable
	$upload->SetValidExtensions(array('pdf','doc','docx','ppt','dwg','jpg','png','gif')); //Extensions that are allowed if none are set all extensions will be allowed.
	$upload->SetMaximumFileSize(10485760); //Maximum file size in bytes, if this is not set, the value in your php.ini file will be the maximum value
	$upload->UploadFile();
	
	if (file_exists(ROOTPATH.FOLDERS.$folder.$filename)) {
		return $folder.$filename;	
		exit;					
	} else {
		$_SESSION['errors'] = "There was an error. Please try again";
	}
			
	
	return 0;

}



function sendmail($to,$subject,$message,$from='noreply@emexgr.ae',$name='Emirates Express')
{
	$headers  = "MIME-Version: 1.0 \n" ;
	$headers .= "From: " .
		   "".mb_encode_mimeheader (mb_convert_encoding($name,"UTF-8","AUTO")) ."" .
		   "<".$from."> \n";
	$headers .= "Reply-To: " .
		   "".mb_encode_mimeheader (mb_convert_encoding($name,"UTF-8","AUTO")) ."" .
		   "<".$from."> \n";
	 
		
	$headers .= "Content-Type: text/plain;charset=UTF-8 \n";
	
		
	/* Convert body to same encoding as stated 
	in Content-Type header above */
		
	$body = mb_convert_encoding($message, "UTF-8","AUTO");
		
	/* Mail, optional paramiters. */
	$sendmail_params  = "-f$from";
		
	mb_language("uni");
	$subject = mb_convert_encoding($subject, "UTF-8","AUTO");
	//$subject = mb_encode_mimeheader($subject);
	
	$result = mail($to, $subject, $body, $headers);
		   
	return $result;
	
	//mail($to,$subject,$message,"From: $name<$from>");
}

function get_ext($file){
	$info = @getimagesize($file);
	switch ($info[2] ) {
		case IMAGETYPE_GIF:
			return ".gif";
			break;
		case IMAGETYPE_JPEG:
			return ".jpg";
			break;
		case IMAGETYPE_PNG:
			return ".png";
			break;
		default:
			return false;
	}
}


function resizeImage( $file, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, 
$use_linux_commands = false ){
ini_set("display_errors",0);
	if ( $height <= 0 && $width <= 0 ) {
		return false;
	}
	$info = @getimagesize($file);
	$image = '';
	
	$final_width = 0;
	$final_height = 0;
	list($width_old, $height_old) = $info;

	if ($proportional) {
		if ($width == 0) $factor = @$height/$height_old;
		elseif ($height == 0) $factor = $width/$width_old;
		else $factor = min ( $width / $width_old, $height / $height_old);

		$final_width = round ($width_old * $factor);
		$final_height = round ($height_old * $factor);
	} else {
		$final_width = ( $width <= 0 ) ? $width_old : $width;
		$final_height = ( $height <= 0 ) ? $height_old : $height;
	}
	switch ($info[2]) {
		case IMAGETYPE_GIF:
			$image = imagecreatefromgif($file);
			break;
		case IMAGETYPE_JPEG:
			$image = imagecreatefromjpeg($file);
			break;
		case IMAGETYPE_PNG:
			$image = imagecreatefrompng($file);
			break;
		default:
			return false;
	}
	$image_resized = imagecreatetruecolor( $final_width, $final_height );

	if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
		$trnprt_indx = imagecolortransparent($image);
		// If we have a specific transparent color
		if ($trnprt_indx >= 0) {
			// Get the original image's transparent color's RGB values
			$trnprt_color    = imagecolorsforindex($image, $trnprt_indx);

			// Allocate the same color in the new image resource
			$trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

			// Completely fill the background of the new image with allocated color.
			imagefill($image_resized, 0, 0, $trnprt_indx);
  
			// Set the background color for new image to transparent
			imagecolortransparent($image_resized, $trnprt_indx);

			// Always make a transparent background color for PNGs that don't have one allocated already
			} elseif ($info[2] == IMAGETYPE_PNG) {
  
			// Turn off transparency blending (temporarily)
			imagealphablending($image_resized, false);
	  
			// Create a new transparent color for image
			$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
	  
			// Completely fill the background of the new image with allocated color.
			imagefill($image_resized, 0, 0, $color);
		  
			// Restore transparency blending
			imagesavealpha($image_resized, true);
		}
	}

	imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
	if ( $delete_original ) {
		if ( $use_linux_commands )
			exec('rm '.$file);
		else
			@unlink($file);
	}

	switch ( strtolower($output) ) {
		case 'browser':
			$mime = image_type_to_mime_type($info[2]);
			header("Content-type: $mime");
			$output = NULL;
			break;
		case 'file':
			$output = $file;
			break;
		case 'return':
			return $image_resized;
			break;
		default:
			break;
	}

	switch ($info[2] ) {
		case IMAGETYPE_GIF:
			imagegif($image_resized, $output . ".gif");
			break;
		case IMAGETYPE_JPEG:
			imagejpeg($image_resized, $output . ".jpg");
			break;
		case IMAGETYPE_PNG:
			imagepng($image_resized, $output . ".png");
			break;
		default:
			return false;
	}

	return true;
}


function captchaValidate()
	{
		if(($_SESSION['security_code'] == $_POST['security_code']) && (!empty($_SESSION['security_code'])) ) {
		 	unset($_SESSION['security_code']);
			return TRUE;
		} else {
			return FALSE;
		}
	}

function getExtension($str) {
    	$i = strrpos($str,".");
      if (!$i) { return ""; } 
      	$l = strlen($str) - $i;
      $ext = substr($str,$i+1,$l);
 	    return $ext;
 	}     
	
function displayBanner($category){
	
	global $db;
	
	$sql =" SELECT  * FROM (SELECT b.*,bc.banner_category,bc.height,bc.width  FROM banners AS b
	LEFT JOIN banner_category AS bc ON (bc.banner_cat_id = b.banner_cat_id)
	WHERE b.banner_cat_id = '$category' ORDER BY b.created DESC LIMIT 5) AS single_banner ORDER BY RAND() LIMIT 1 ";
	$banners = $db->fetch($sql);
	
	$html = "<a href = 'http://$banners[link]' target='_blank'><img src='ads/banners/$banners[file]' width = '$banners[width]' height='$banners[height]' /></a>";
	return $html;
	}
	
function compare_dates($date1, $date2) 
{ 
    $blocks = array( 
        array('name'=>'year','amount'    =>    60*60*24*365    ), 
        array('name'=>'month','amount'    =>    60*60*24*31    ), 
        array('name'=>'week','amount'    =>    60*60*24*7    ), 
        array('name'=>'day','amount'    =>    60*60*24    ), 
        array('name'=>'hour','amount'    =>    60*60        ), 
        array('name'=>'minute','amount'    =>    60        ), 
        array('name'=>'second','amount'    =>    1        ) 
        ); 
    
    $diff = abs($date1-$date2); 
    $diff = $diff + 1 ;
    $levels = 2; 
    $current_level = 1; 
    $result = array(); 
    foreach($blocks as $block) 
        { 
        if ($current_level > $levels) {break;} 
        if ($diff/$block['amount'] >= 1) 
            { 
            $amount = floor($diff/$block['amount']); 
            if ($amount>1) {$plural='s';} else {$plural='';} 
            $result[] = $amount.' '.$block['name'].$plural; 
            $diff -= $amount*$block['amount']; 
            $current_level++; 
            } 
        } 
    return implode(' ',$result).' ago'; 
    } 
	
	function rememberMe(){
		global $s;
		if (!empty($_COOKIE['username']) && !empty($_COOKIE['password']) ) {
			$email = $_COOKIE['username'];
			 $password = $_COOKIE['password'];
	
			$s->memberlogin($email,$password);
   
}
		
		}
?>