<?php
require_once('../config.php');
$titleset="Student Login";
include('header.php');
?>
<!--========================================================================== Content Part 1 =====================================================================================-->

	<div class="wrapper">

						<div class="grids">
						<h2>Welcome to zBzQuiz Web App Interface</h2>
																<div class="grid-6 grid grey">
																	
																	
																	<br>

<?php 

   
 if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['stuname']))
	{
		echo "<h3>Account Status</h3>";
		  if($_SESSION['stulastlogintime']==NULL)
		{
     echo "<p>Username: <i><strong>".$_SESSION['stuname']."</strong></i><br> User Email: <i><strong>".$_SESSION['stuemail']."</strong></i><br></p>";  
    }
    else
    {
    	echo "<p>Username: <i><strong>".$_SESSION['stuname']."</strong></i><br> User Email: <i><strong>".$_SESSION['stuemail']."</strong></i><br> Last Session Time: <i><strong>".$_SESSION['stulastlogintime']."</strong></i></p>";
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
																		
																	<p>	<a class="button" href="sturegister.php">Sign Up!</a></p>
<?php
	}
?>
																
																</div>
														

			</div><!--end of grids-->

		</div><!--end of wrapper-->
<hr />


<?php
include('footer.php');
?>