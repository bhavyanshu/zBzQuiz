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
   width: 100%;
   }
   #navlist li
   {
   display: inline-block;
   list-style-type: none;
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
<div class="entity-element-single">
   <b>Course ID: </b> <?php echo $rowcourse['courseid']; ?>
   <br><b>Course Name: </b> <?php echo $rowcourse['coursename']; ?>
   <div class="comment"><b>Course Description: </b><?php echo $rowcourse['coursedesc']; ?></div>
   <ul style="margin:0px;" id="navlist">
      <li>
         <form name="hongkiat" id="hongkiat-form" method="post" action="createtest.php?corID=<?php echo $rowcourse['courseid']; ?>">
            <button class="btn btn-default">Create Test</button>
         </form>
      </li>
      <li><a href="testmgr.php?corID=<?php echo $rowcourse['courseid']; ?>"> <button class="btn btn-default">Manage Tests</button></a></li>
      <li>
         <form action="deletecourse.php" method="post" class="delete-course"><input type="hidden" name="courseid" value="<?php echo $rowcourse['courseid'] ?>" /><button class="btn btn-danger" type="submit">Delete Course</button></form>
      </li>
      <li>
        <form action="entrollstudents.php" method="post" class="enroll-students"><input type="hidden" name="courseid" value="<?php echo $rowcourse['courseid'] ?>" /><button class="btn btn-default" type="submit">Enroll Students</button></form>
      </li>  
   </ul>
   <hr>
</div>
<?
   }
   }
   else
   {
   	echo "<h5>There are currently no courses registered by you.</h5>";
   	}
   ?>