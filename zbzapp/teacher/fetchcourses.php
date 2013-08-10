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
			echo "Course Name: ".$rowcourse['coursename'];
			echo "<div class=\"comment\">Course Description: ".$rowcourse['coursedesc']."</div>";		
			}
		}
		else
		{
			echo "<h5>There are currently no courses registered by you.</h5>";
			}
	?>

