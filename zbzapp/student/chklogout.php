<?php
require_once('../config.php');
$titleset="Logging out student..please wait";
include('header.php');
?>
<?
$username=$_SESSION['stuname'];
$ustatus=0;
$lastlogouttime=date("d-m-Y H:i:s");
$sql = $dbinfo-> prepare("UPDATE student_login_zbzxs SET stustatus=?, stulastlogouttime=? where stuname=?");
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
<h1>Logging out student..please wait</h1>
<meta http-equiv="refresh" content="2;index.php">


<?php
include('footer.php');
?>