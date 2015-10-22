<?php
require_once('../config.php');
require_once('loggedin.php');
$titleset="Past Performance";
include('header.php');
?>
<div class="wrapper">
	<div class="grids">
		<h2>Welcome to zBzQuiz Web App Interface</h2>

		<?php 
		if(checkIfStuLoggedIn($_SESSION['LoggedIn'],$_SESSION['stuname'])==1)
		{
		?>
			<div class="grid-10">

		<?php 
		}
		else
		{
			echo "<p><b>You are currently not logged in. You will have to <a href=\"index.php\">login</a> to access this page.</b></p>"; 
		}
		?>
		</div>
	</div>
	<!--end of grids-->
</div>
<!--end of wrapper-->
<hr />

<?php
include('footer.php');
?>
