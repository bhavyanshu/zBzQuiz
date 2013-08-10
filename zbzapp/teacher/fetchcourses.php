 <script src="../js/jquery.shorten.1.0.js" type="text/javascript"></script>
	<script type="text/javascript">
   $(".comment").shorten({
    "showChars" : 30,
    "moreText"  : "More",
    "lessText"  : "Less",
});
</script>

<style>
a.morelink {
    text-decoration:none;
    outline: none;
}
.morecontent span {
    display: none;
}
.comment {
    width: 400px;
    background-color: #f0f0f0;
    margin: 10px;
}
</style>
	<?php 
	require_once('../config.php');
		$teacherID=$_SESSION['teacherid']; //uid in mysql DB.
	$fetch_courses=$dbinfo->prepare("SELECT * FROM teacher_course_status where uid = ?");
	$fetch_courses->execute(array($teacherID));
	$result=$fetch_courses->fetchALL();
	if($result)
	{
		echo "<h5>Courses by you</h5>";
		foreach($result as $rowcourse)
		{
			?>
			<div class="grid-6 grid green" style="width:auto;">
			<p>	
			<?
			echo "<b>Course ID: </b>".$rowcourse['courseid'];
			echo "<br><i><b>Course Name:</b> </i>".$rowcourse['coursename'];
			?>
			<form name="hongkiat" id="hongkiat-form" method="post" action="createtest.php">
			<section id="buttons">
			<input type="submit" style="height: 1.5em;" name="createtest" id="submitbtn" class="submitbtn" tabindex="7" value="Create Mock Test">
			</section>			
			</form>
			<br>
			<br>
			<?
			echo "<div class=\"comment\">Course Description: ".$rowcourse['coursedesc']."</div><hr>";		
			}
			?>
			</p>
			</div>
			<?
		}
		else
		{
			echo "<h5>There are currently no courses registered by you.</h5>";
			}
	?>

