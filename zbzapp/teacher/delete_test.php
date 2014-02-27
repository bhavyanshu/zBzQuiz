<?php 
require_once('../config.php');
$teacherID=$_SESSION['teacherid']; //uid in mysql DB.
 if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['uname']))
 {
	if(isset($_POST['testID']) && !empty($_POST['testID']) && isset($_POST['corID']) && !empty($_POST['corID']))
	{
		try{
	$deletetestSQL=$dbinfo->prepare("DELETE FROM course_test_status WHERE testid=? AND courseid=?");
	$deletetestSQL->execute(array($_POST['testID'],$_POST['corID']));		
		if($deletetestSQL)
		{
		echo "Successfully Deleted Test.";
		}
		else
		{
		echo "There was an error Deleting Test.";
		}
		}
		catch(PDOException $e) {
  			echo $e->getMessage();
		}
	}
	else
	{
	echo "Error catching values. Please contact Administrator.";
	}
}
else
{
	echo "Direct access not allowed.";
}