<?php
require_once('../config.php');
$titleset="Course Manager for Teachers";
include('header.php');
?>
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
	<h3>Create New Test</h3>
	
		
	<form name="courses1" class="coursereg" id="hongkiat-form" method="post" action="createcourse.php">
	<label>Test Name</label>
	<input type="text" id="testname" class="txtinput" name="testname" />
	<label>Test Description</label>
	<textarea row="2" columns="2" id="testdesc" class="txtinput" name="testdesc"></textarea>
	<section id="buttons">		
	<label>Total Number of Questions</label>
	<input type="text" id="testques" class="txtinput" name="testques" />
	<label>Test Duration</label>
	<input type="text" id="testduration" class="txtinput" name="testduration" />
	<input type="submit" id="submitbtn" class="submitbtn" name="createtest" value="Create" />
</section>	
</form>	
<br/>	
	
	<br/>
	<?php

	?>
	<br/>

		
	</div>												
	

			</div><!--end of grids-->

		</div><!--end of wrapper-->
<hr />
<?php
include('footer.php');
?>