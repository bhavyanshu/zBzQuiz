<?php 
require_once('../config.php');
$teacherID=$_SESSION['teacherid']; //uid in mysql DB.
 if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['uname']))
 {
	if(isset($_POST['courseid']) && !empty($_POST['courseid']))
	{
		try{
	$deletecourseSQL=$dbinfo->prepare("DELETE FROM teacher_course_status WHERE courseid=? AND uid=?");
	$deletecourseSQL->execute(array($_POST['courseid'],$teacherID));		
		if($deletecourseSQL)
		{
			sleep(5); //Helping processor to recover from too many requests.
		echo "Successfully Deleted course.";
		}
		else
		{
		echo "There was an error Deleting course.";
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