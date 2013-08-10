<?php 
require_once('../config.php');
$teacherID=$_SESSION['teacherid']; //uid in mysql DB.
if($_POST['coursename'] && $_POST['coursedesc'])
{

$createcourseSQL=$dbinfo->prepare("INSERT INTO teacher_course_status (coursename,coursedesc,uid) VALUES (?,?,?)");
$createcourseSQL->execute(array($_POST['coursename'],$_POST['coursedesc'],$teacherID));		
if($createcourseSQL)
{
	echo "Successfully created course.";
	}
	else
	{
		echo "There was an error creating course.";
		}
}
else
{
}