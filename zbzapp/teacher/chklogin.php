<?php
require_once('../config.php');
include('password.php'); //including password.php for bcrypt hash generation.

if(!empty($_POST['username']) && !empty($_POST['password']))
{
$username = $_POST['username'];
$password=$_POST['password'];
$sqlsethash= $dbinfo->prepare("SELECT * FROM teacher_login_zbzxt WHERE uname =?");
		$sqlsethash->execute(array($username));
		$resultsethash = $sqlsethash->fetchALL();
			if ($resultsethash)
			{
				foreach($resultsethash as $rowsethash)
				{
					$hash = $rowsethash['upass'];
		}
	}
	else{
				echo "<p>User account does not exist.</p>";
				die();		
		}
		if (password_verify($password, $hash)) {
  		//Valid    
		$sql= $dbinfo->prepare("SELECT * FROM teacher_login_zbzxt WHERE uname =? AND upass =?");
		$sql->execute(array($username,$hash));
		$result = $sql->fetchALL();
			if ($result)
			{
				foreach($result as $row)
				{
		   		$email = $row['uemail']; 
		   		$uid = $row['uid'];
				$lastlogin = $row['ulogintime'];
				$ustatus=1;
				$ulogintime=date("d-m-Y H:i:s");   
				$sql = $dbinfo-> prepare("UPDATE teacher_login_zbzxt SET ulogintime=?,ustatus=?");
		 		$sql->execute(array($ulogintime,$ustatus));
				}
			$_SESSION['uname'] = $username;
			$_SESSION['uemail'] = $email;
			$_SESSION['ulastlogintime']=$lastlogin;
			$_SESSION['teacherid']=$uid;
			$_SESSION['LoggedIn'] = 1;
			echo "<h1>Success</h1>";
			echo "<p>Redirecting...please wait!</p>";
			header("location:index.php");
			} 
			else
			{
			echo "Incorrect login or password";
			}
	}
	else
	{
	echo "Oops, invalid password";
	}
}
else
{
	echo "Could not catch values";
}
?>
