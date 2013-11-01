<?php
   require_once('../config.php');
   require_once('loggedin.php');
   $titleset="Manage Test";
   include('header.php');
   ?>
	<!--[if !IE]><!-->
	<!-- Making the table responsive -->
	<style>
	
	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 760px
	and also iPads specifically.
	*/
	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {
	
		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		tr { border: 1px solid #ccc; }
		
		td { 
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee; 
			position: relative;
			padding-left: 50%; 
		}
		
		td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
		
		/*
		Label the data
		*/
		td:nth-of-type(1):before { content: "Test ID"; }
		td:nth-of-type(2):before { content: "Course ID"; }
		td:nth-of-type(3):before { content: "Test Name"; }
		td:nth-of-type(4):before { content: "Test Description"; }
		td:nth-of-type(5):before { content: "Test Duration"; }
		td:nth-of-type(6):before { content: "Actions"; }
	}
	
	/* Smartphones (portrait and landscape) ----------- */
	@media only screen
	and (min-device-width : 320px)
	and (max-device-width : 480px) {
		body { 
			padding: 0; 
			margin: 0; 
			width: 320px; }
		}
	
	/* iPads (portrait and landscape) ----------- */
	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
		body { 
			width: 495px; 
		}
	}
	
	</style>
	<!--<![endif]-->
<div class="wrapper">
   <div class="grids">
      <h2>Welcome to zBzQuiz Web App Interface</h2>

         <?php 
           if(checkIfLoggedIn($_SESSION['LoggedIn'],$_SESSION['uname'])==1)
	{
            ?>
      <div class="grid-10">
         <h3>Test Manager</h3>
         <br/>	
         <br/>
         <?php
	$getTests=$dbinfo->prepare("SELECT * from course_test_status where courseid=?");
		$getTests->execute(array($_GET['corID']));
	$result=$getTests->fetchALL();
   if($result)
   {
?>
<table>
		<thead>
		<tr>
			<th>Test ID</th>
			<th>Course ID</th>
			<th>Test Name</th>
			<th>Test Description</th>
			<th>Test Duration</th>
			<th>Actions</th>
		</tr>
		</thead>
<?php
   	echo "<h5>Test under course</h5>";
   	foreach($result as $rowtest)
   	{
	?>
	<tbody><tr>
	<td><?php echo $rowtest['testid']; ?></td>
	<td><?php echo $rowtest['courseid']; ?></td>
	<td><?php echo $rowtest['testname']; ?></td>
	<td><?php echo $rowtest['testdescription']; ?></td>
	<td><?php echo $rowtest['test_duration']; ?></td>
	<td><div class="action_holder"><a href="edit_test.php?testID=<?php echo $rowtest['testid']; ?>" title="Edit test"><div class="edit_action_button"></div></a><a title="Enroll Students" href="enrollAccept.php?testID=<?php echo $rowtest['testid']; ?>"><div class="enroll_action_button"></div></a><a title="Delete test" href="delete_test.php?testID=<?php echo $rowtest['testid']; ?>"><div class="delete_action_button"></div></a></div></td>
	</tr>
	<?php
	}
   }
   else {
	echo "Error fetching tests.";
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
