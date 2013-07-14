<?php
require_once('../config.php');
include('password.php');

if(!empty($_POST['username']) && !empty($_POST['password']))
{
$username = $_POST['username'];
$password=$_POST['password'];
$sqlsethash= $dbinfo->prepare("SELECT * FROM student_login_zbzxs WHERE stuname =?");
		$sqlsethash->execute(array($username));
		$resultsethash = $sqlsethash->fetchALL();
			if ($resultsethash)
			{
				foreach($resultsethash as $rowsethash)
				{
					$hash = $rowsethash['stupass'];
		}
	}
	else{
				echo "<p>User account does not exist.</p>";
				die();		
		}
		if (password_verify($password, $hash)) {
  		//Valid    
		$sql= $dbinfo->prepare("SELECT * FROM student_login_zbzxs WHERE stuname =? AND stupass =?");
		$sql->execute(array($username,$hash));
		$result = $sql->fetchALL();
			if ($result)
			{
				foreach($result as $row)
				{
		   $email = $row['stuemail']; 
				$lastlogin = $row['stulogintime'];
				$ustatus=1;
				$ulogintime=date("d-m-Y H:i:s");   
				$sql = $dbinfo-> prepare("UPDATE student_login_zbzxs SET stulogintime=?,stustatus=?");
		 		$sql->execute(array($ulogintime,$ustatus));
				}
			$_SESSION['stuname'] = $username;
			$_SESSION['stuemail'] = $email;
			$_SESSION['stulastlogintime']=$lastlogin;
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