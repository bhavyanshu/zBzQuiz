<?php 
require_once('../config.php');
require_once('loggedin.php');

if(checkIfLoggedIn($_SESSION['LoggedIn'],$_SESSION['uname'])==1)
	{
	if($_POST['testname'] && $_POST['testdesc'] && $_POST['testduration'] && $_GET['courseid'])
	{
	$createcourseSQL=$dbinfo->prepare("INSERT INTO course_test_status (testname,testdescription,test_duration,courseid) VALUES (?,?,?,?)");
	$createcourseSQL->execute(array($_POST['testname'],$_POST['testdesc'],$_POST['testduration'],$_GET['courseid']));		
		if($createcourseSQL)
		{
		echo "<p>Created Course. Please go to <a href=\"testmgr.php?corID=".$_GET['courseid']."\">test manager</a></p>";
		}
		else
		{
		echo "There was an error creating test.";
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
