 <script src="../js/jquery.shorten.1.0.js" type="text/javascript"></script>
	<script type="text/javascript">
   $(".comment").shorten({
    "showChars" : 40,
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
	$fetch_courses=$dbinfo->prepare("SELECT * FROM teacher_course_status where uid = ? ORDER BY courseid DESC");
	$fetch_courses->execute(array($teacherID));
	$result=$fetch_courses->fetchALL();
	if($result)
	{
		echo "<h5>Courses by you</h5>";
		foreach($result as $rowcourse)
		{
			?>
			<p>	
			<?
			echo "<b>Course ID: </b>".$rowcourse['courseid'];
			echo "<br><b>Course Name: </b>".$rowcourse['coursename'];	
			echo "<form name=\"hongkiat".$rowcourse['courseid']."\" id=\"hongkiat-form\" method=\"post\" action=\"createtest.php\">";
			echo "<input type=\"hidden\" name=\"courseid\" value=\"".$rowcourse['courseid']."\" />";
			echo "<section id=\"buttons\"><input type=\"submit\" name=\"createtest\" id=\"resetbtn\" style=\"height:1.5em;\" value=\"Manage Tests\"></section></form><br><br>";		
			echo "<div class=\"comment\"><b>Course Description: </b>".$rowcourse['coursedesc']."</div><hr>";		
			}
			?>
			</p>
		
			<?
		}
		else
		{
			echo "<h5>There are currently no courses registered by you.</h5>";
			}
	?>

