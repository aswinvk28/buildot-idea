<?php

class Session
{
	var $userId;
	var $username;
	var $email;
	var $type;
	var $status;
	var $ip;
	var $user=array();
	
	function __construct()
	{	
                $this->user = $_SESSION['user'];
		$this->userId = $this->user['user_id'];
		$this->username = isset($this->user['username']) ? $this->user['username'] : null;
		$this->email = $this->user['email'];
		$this->type = $this->user['usertype'];
		$this->ip = $_SERVER['REMOTE_ADDR'];
	}
	
	function set($var, $val)
	{
		$_SESSION[$var] = $val;
		$this->user = $_SESSION['user'];
		$this->userId = $this->user['user_id'];
		$this->username = $this->user['username'];
		$this->email = $this->user['email'];
		$this->type = $this->user['usertype'];
	}
	
	function get($var)
	{
		return $_SESSION[$var];
	}
	
	function login($email, $password)
	{
		global $db, $dbcountry;
		

		$sql ="SELECT u.* from users as u
					where u.email = '$email' AND u.password = '$password' and u.usertype = 2 AND u.status = 1";
		$user = $db->fetch($sql);
		if($db->rows != 0)
		{
			if($user['status'] == 1)
			{
				
				$this->set('user', $user);
				
					header("Location:index.php?view=home");
					exit;
			}
			else
			{
				$_SESSION['errors'] = "Your Account is pending for approval or has been Disabled";
				header("Location: index.php?view=login");
			}
		}
		else
		{
			$_SESSION['errors'] = "Invalid Email/Password";
			header("Location: login.php");
		}
	}
	
	function memberlogin($email, $password)
	{

			global $db;

			$sql ="SELECT u.email,u.usertype,m.*,c.* FROM users AS u 
					LEFT JOIN  members AS m ON u.user_id = m.user_id 
					LEFT JOIN company AS c ON c.company_id = m.company_id 
					where u.email = '$email' AND u.password = '$password' and u.usertype = 1";
			$user = $db->fetch($sql);
			if($db->rows != 0)
			{
				if($user['status'] == 1 )
				{
				
					$this->set('user', $user);
					//print_r($_SESSION);
					header("Location: index.php?view=member_home"); // Member Home
					exit;
			}else{
				
				$_SESSION['errors'] = "Your Account is pending for approval or has been Disabled";
				header("Location: index.php?view=login");
				exit;
				}
			}
			else
			{
				$_SESSION['errors'] = "Invalid Username or Password";
				rd("login");
			
		}
	}
	
	function logOut()
	{
		$_SESSION['user'] = '';
		$this->userId = '';
		$this->email = '';
		$this->user = '';
		unset($_SESSION);
		unset($this);
		$_SESSION['messages'] = "You have sucessfully logout";
		header("Location: ".SITEURL);
		exit;
	}
	
	
	function checkAdminCP()
	{
		global $db;
		//debug($this);
		//echo (int)empty($this->userId) ;
		//echo  (int)$this->type;

		if(empty($this->userId) || $this->type != 2)
		{	
			$_SESSION['user'] = '';
			header("Location: login.php");
			exit;
		}
	}
/*function checkAdmin()
	{
		global $db;
		
	echo "before";
		if(empty($this->userId) || $this->type != 1)
		{	
		echo "inside if";
		
			$user = '';
		$_SESSION['user'] = '';
		unset($_SESSION);
			header("Location: ".SITEURL."login.php");
			exit;
		}
		exit;
	}*/
	
	
	function  captcha()
	{
		if(($_SESSION['security_code'] == $_POST['security_code']) && (!empty($_SESSION['security_code'])) ) {
		 	unset($_SESSION['security_code']);
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function  captcha1()
	{
		
		if(($_SESSION['security_code1'] == $_POST['security_code1']) && (!empty($_SESSION['security_code1'])) ) {
		 	unset($_SESSION['security_code1']);
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
}


$s = new Session();
?>