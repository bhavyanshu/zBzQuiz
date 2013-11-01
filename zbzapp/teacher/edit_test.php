<?php
   require_once('../config.php');
   require_once('loggedin.php');
   $titleset="Test Editor";
   include('header.php');
   ?>
<div class="wrapper">
   <div class="grids">
      <h2>Welcome to zBzQuiz Web App Interface</h2>
      <div class="grid-6 grid grey">
         <h5>Teacher's Login</h5>
         <br>
           <?php 
           if(checkIfLoggedIn($_SESSION['LoggedIn'],$_SESSION['uname'])==1)
	{
            ?>
      </div>
      <div class="grid-10">
         <h3>Test Manager</h3>
         <br/>	
         <br/>
         <?php
	if(isset($_GET['testID']))
	{
		$fetchTestInfo = $dbinfo->prepare("SELECT * from course_test_status where testid=?");
		$fetchTestInfo -> execute(array($_GET['testID']));
		$resultTestInfo = $fetchTestInfo->fetchALL();
		if($resultTestInfo){
		echo "Test Information</br>";
			foreach($resultTestInfo as $rowTestInfo)
			{
				//Output test related information
			}
		}
	}	
	else
	{
	echo "Invalide Test ID. Please contact administrator.";
	}
        ?>
         <br/>
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
