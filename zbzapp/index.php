<?php
$titleset="home";
include('header.php');
?>
<!--========================================================================== Content Part 1 =====================================================================================-->

	<div class="wrapper">

						<div class="grids">
						<h2>Welcome to zBzQuiz Web App Interface</h2>
																<div class="grid-6 grid grey">
																	<h5>Teacher's Login</h5>
																		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
																					<section id="aligned">
																						<input type="text" name="username" id="username" placeholder="Your username" autocomplete="off" tabindex="1" class="txtinput">
																						<input type="email" name="userpass" id="userpass" placeholder="Your password" autocomplete="off" tabindex="2" class="txtinput">
																			<section>
																			<section id="buttons">
																						<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
																						<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Login!">
																						
																						<br style="clear:both;">
																					</section>
																		</form>
																		<br>
																		<a class="button" href="zbzapp/index.php">Sign Up!</a>
																</div>
																<div class="grid-4 grid">
																<p>&nbsp;</p>
																</div>


																<div class="grid-6 grid green">
																	<h5>Student's Login</h5>
																	<form name="hongkiat" id="hongkiat-form" method="post" action="#">
																					<section id="aligned">
																							<input type="text" name="username" id="username" placeholder="Your username" autocomplete="off" tabindex="1" class="txtinput">
																						<input type="email" name="userpass" id="userpass" placeholder="Your password" autocomplete="off" tabindex="2" class="txtinput">
																			<section>
																			<section id="buttons">
																						<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
																						<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Login!">
																						
																						<br style="clear:both;">
																					</section>
																		</form>
																		<br>
																		<a class="button" href="zbzapp/index.php">Sign Up!</a>
																</div>


			</div><!--end of grids-->

		</div><!--end of wrapper-->
<hr />


<?php
include('footer.php');
?>