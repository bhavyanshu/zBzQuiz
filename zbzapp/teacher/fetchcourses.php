 <script src="../js/jquery.shorten.1.0.js" type="text/javascript"></script>
	<script type="text/javascript">
   $(".comment").shorten({
    "showChars" : 40,
    "moreText"  : "More",
    "lessText"  : "Less",
});
</script>


<script type="text/javascript">
$('document').ready(function()
{
$('.delete-course').ajaxForm( {
					beforeSend: function() {
             $('#del-message').html("<img src='../img/ajax-loader.gif' title='Loading..' alt='Loading..' />");
            },
        success: function(data) {
                $('#del-message').html(data);
                $("#displaycourseStats").load("fetchcourses.php");
        }
});
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
		echo "<div id=\"del-message\"></div>";
		foreach($result as $rowcourse)
		{
			?>
			<p>	
			<?
			echo "<b>Course ID: </b>".$rowcourse['courseid'];
			echo "<br><b>Course Name: </b>".$rowcourse['coursename'];	
			echo "<form name=\"hongkiat".$rowcourse['courseid']."\" id=\"hongkiat-form\" method=\"post\" action=\"createtest.php\">";
			echo "<input type=\"hidden\" name=\"courseid\" value=\"".$rowcourse['courseid']."\" />";
			echo "<button class=\"pure-button pure-button-green\">Create Test</button></form><br>";		
			echo "<a href=\"#\"> <button class=\"pure-button pure-button-pink\">Manage Tests</button></a>";
			echo "<form action=\"deletecourse.php\" method=\"post\" class=\"delete-course\"><input type=\"hidden\" name=\"courseid\" value=\"".$rowcourse['courseid']."\" /><button class=\"pure-button pure-button-blue\" type=\"submit\">Delete Course</button></form>";
			echo "<a href=\"#\"> <button class=\"pure-button pure-button-orange\">Enroll Students</button></a>";
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