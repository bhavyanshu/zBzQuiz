<?php 
require_once('../config.php');
$username=$_SESSION['uname'];
$ustatus=0;
$lastlogouttime=date("d-m-Y H:i:s");
$sql = $dbinfo-> prepare("UPDATE teacher_login_zbzxt SET ustatus=?, ulastlogouttime=? where uname=?");
try{
$sql->execute(array($ustatus,$lastlogouttime,$username));
$_SESSION = array(); 
session_destroy(); 
}
catch(PDOException $ex)
	{
		echo "Error logging out!";
	}

?>
<h1>Please wait!</h1>
<meta http-equiv="refresh" content="2;index.php">
