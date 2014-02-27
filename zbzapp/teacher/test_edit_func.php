<?php 
require_once('../config.php');
require_once('loggedin.php');

if(checkIfLoggedIn($_SESSION['LoggedIn'],$_SESSION['uname'])==1)
	{
	if($_POST['testname'] && $_POST['testdesc'] && $_POST['testduration'] && $_POST['testID'] && $_POST['totalQuestions'])
	{
	$createcourseSQL=$dbinfo->prepare("UPDATE course_test_status SET testname=?,testdescription=?,test_duration=?,total_questions=? WHERE testID=?");
	$createcourseSQL->execute(array($_POST['testname'],$_POST['testdesc'],$_POST['testduration'],$_POST['totalQuestions'],$_POST['testID']));		
		if($createcourseSQL)
		{
		echo "Updated test details.";
		}
		else
		{
		echo "There was an error Updating test.";
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
