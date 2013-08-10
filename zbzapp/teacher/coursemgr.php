<?php
require_once('../config.php');
$titleset="Teacher's login";
include('header.php');
?>
<script> 
   $(document).ready(function() { 
   $("#displaycourseStats").load("fetchcourses.php"); // call as soon as page load
   $('.coursereg').ajaxForm(function() { 
     $('#coursename1').val(''); 
				$('#coursedesc1').val('');      
     alert("Created course. Please scroll down to view."); 
     $("#displaycourseStats").load("fetchcourses.php")
  }); 
});  
</script> 

<!--========================================================================== Content Part 1 =====================================================================================-->

	<div class="wrapper">

						<div class="grids">
						<h2>Welcome to zBzQuiz Web App Interface</h2>
																<div class="grid-6 grid grey">
																	<h5>Teacher's Login</h5>
																	
																	<br>

<?php 

   
 if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['uname']))
	{
		echo "<h3>Account Status</h3>";
		  if($_SESSION['ulastlogintime']==NULL)
		{
     echo "<p>Username: <i><strong>".$_SESSION['uname']."</strong></i><br> User Email: <i><strong>".$_SESSION['uemail']."</strong></i><br></p>";  
    }
    else
    {
    	echo "<p>Username: <i><strong>".$_SESSION['uname']."</strong></i><br> User Email: <i><strong>".$_SESSION['uemail']."</strong></i><br> Last Session Time: <i><strong>".$_SESSION['ulastlogintime']."</strong></i></p>";
    	}    
?>
<p><a class="button" href="chklogout.php">Log out!</a></p>

<?php   
	}
 else
  	{
		echo "<p><b>You are currently not logged in!</b></p>"; ?>
			<form name="hongkiat" id="hongkiat-form" method="post" action="chklogin.php">
																					<section id="aligned">
																				<p>		<input type="text" name="username" id="username" placeholder="Your username" autocomplete="off" tabindex="1" class="txtinput">
																						<input type="password" name="password" id="userpass" placeholder="Your password" autocomplete="off" tabindex="2" class="txtinput"></p>
																			<section>
																			<section id="buttons">
																		<p>				<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
																						<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Log In">
																						
																						<br style="clear:both;"></p>
																					</section>
																		</form>
																		
																	<p>	<a class="button" href="tearegister.php">Sign Up!</a></p>
<?php
	}
?>
																
																</div>
	<div class="grid-10">	
	<h3>Course Manager</h3>
	
			<b>Create New Course</b>	
	<form name="courses1" class="coursereg" id="hongkiat-form" method="post" action="createcourse.php">
	<label>Course Name</label>
	<input type="text" id="coursename1" class="txtinput" name="coursename" />
	<label>Course Description</label>
	<textarea row="2" columns="2" id="coursedesc1" class="txtinput" name="coursedesc"></textarea>
	<section id="buttons">		
	<input type="submit" id="submitbtn" class="submitbtn" name="createcourse" value="Create" />
</section>	
</form>	
<br/>	
	
	<br/>
	<?php

	?>
	<br/>
	<div id="displaycourseStats">
	
	</div>
		
	</div>												
	

			</div><!--end of grids-->

		</div><!--end of wrapper-->
<hr />


<?php
include('footer.php');
?>