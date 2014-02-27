<?php
/**
 * This updates the enrollment status for a student in the database
 */
require_once('../config.php');
require_once('loggedin.php');

if(checkIfLoggedIn($_SESSION['LoggedIn'],$_SESSION['uname'])==1) {
	if(isset($_POST['test_ID']) && !empty($_POST['test_ID']) && isset($_POST['stu_ID']) && !empty($_POST['stu_ID'])) {
		//Now insert values in student_test_status table
		$enroll_value = 1;
		try {
		$QueryTestStatus = $dbinfo->prepare("UPDATE student_test_status SET is_enabled=? WHERE stuid=? AND testid=?");
		$QueryTestStatus->execute(array($enroll_value,$_POST['stu_ID'],$_POST['test_ID']));
		 //Everything is fine
		}
		catch(PDOException $e) {
			echo "Error updating: ".$e->getMessage(); //Something went wrong
		}
	}
	else {
		echo "Could not get values";
	}
}
else {
	echo "<p><b>You are currently not logged in. You will have to <a href=\"index.php\">login</a> to access this page.</b></p>"; 
}
?>
