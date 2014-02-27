<?php
require_once('../config.php');
require_once('loggedin.php');
/*
Contains all processing related to publishing and unpublishing a test.
*/
if(checkIfLoggedIn($_SESSION['LoggedIn'],$_SESSION['uname'])==1)
{
$queryPublish=$dbinfo->prepare("UPDATE course_test_status SET is_published=? WHERE testid=? AND courseid=?");

if(isset($_POST['publish_value']) && isset($_POST['testID']) && !empty($_POST['testID']) && isset($_POST['corID']) && !empty($_POST['corID'])) {
	try {
		$is_published = 1;
		$queryPublish->execute(array($is_published,$_POST['testID'],$_POST['corID']));
		echo "Published";

	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
elseif(isset($_POST['unpublish_value']) && isset($_POST['testID']) && !empty($_POST['testID']) && isset($_POST['corID']) && !empty($_POST['corID'])) {
	try {
		$is_published = 0;
		$queryPublish->execute(array($is_published,$_POST['testID'],$_POST['corID']));
		echo "Unpublished";
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}	
}
else {
	echo "Some field is missing. Contact Administrator.";
}
}
else {
	echo "You are not authorized to view this page!";
}
?>