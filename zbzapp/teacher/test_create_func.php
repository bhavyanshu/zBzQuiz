<?php 
require_once('../config.php');
 if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['uname']))
 {
	if($_POST['testname'] && $_POST['testdesc'] && $_POST['testduration'] && $_GET['courseid'])
	{
	$createcourseSQL=$dbinfo->prepare("INSERT INTO course_test_status (testname,testdescription,test_duration,courseid) VALUES (?,?,?,?)");
	$createcourseSQL->execute(array($_POST['testname'],$_POST['testdesc'],$_GET['testduration'],$_GET['courseid']));		
		if($createcourseSQL)
		{
		echo "Successfully created test.";
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
