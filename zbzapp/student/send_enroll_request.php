<?php
/**
 * This updates the enrollment status for a student in the database
 */
require_once('../config.php');
require_once('loggedin.php');

if(checkIfStuLoggedIn($_SESSION['LoggedIn'],$_SESSION['stuname'])==1) {
	$studentID = $_SESSION['stuID'];
	if(isset($_POST['test_enroll_ID']) && !empty($_POST['test_enroll_ID'])) {
		//Now insert values in student_test_status table
		try {
		$QueryTestStatus = $dbinfo->prepare("INSERT INTO student_test_status (stuid,testid) VALUES(?,?)");
		$QueryTestStatus->execute(array($studentID,$_POST['test_enroll_ID']));
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
