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
		td:nth-of-type(6):before { content: "Total Questions"; }
		td:nth-of-type(7):before { content: "Actions"; }
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

<script type="text/javascript">
$(document).ready(function (){
	  $(".btn.btn-danger.btn-sm.delete_button").click(function(event){
	  	var spinner = $("<img src='../img/ajax-loader-green-small.gif' alt='Loading..' />").insertAfter(this);
	    var form_data = $(this).closest("form").serialize();
	    //var formAction = $(this).attr("formaction");
	    //alert(form_data);
	    $.ajax({
		url: "delete_test.php",
		type: "POST",
		data: form_data,
		success: function() 
			    {
				$(document)
    				.ajaxStart(function() {
        				//$loading.show();
    					})
				    .ajaxStop(function() {
					 spinner.remove();
					 location.reload();
				    });
			    }
		    });
	    	event.preventDefault(); //STOP default action
    		event.unbind(); //unbind. to stop multiple form submit.
		    return false;
		  });


	   $(".btn.btn-danger.btn-sm.publish_button").click(function(event){
	   	//alert("Event Triggered");
	  	var publishspinner = $("<img src='../img/ajax-loader-green-small.gif' alt='Loading..' />").insertAfter(this);
	    var form_data_publish = $(this).closest("form").serialize();
	    //var formAction = $(this).attr("formaction");
	    //alert(form_data_publish);
	    $.ajax({
		url: "publish_test.php",
		type: "POST",
		data: form_data_publish,
		success: function() 
			    {
				$(document)
    				.ajaxStart(function() {
        				//$loading.show();
    					})
				    .ajaxStop(function() {
					 publishspinner.remove();
					 location.reload();
				    });
			    }
		    });
	    	event.preventDefault(); //STOP default action
    		event.unbind(); //unbind. to stop multiple form submit.
		    return false;
		  });
});
</script>

<div class="wrapper">
	<div class="grids">
		<h2>Welcome to zBzQuiz Web App Interface</h2>

		<?php 
		if(checkIfLoggedIn($_SESSION['LoggedIn'],$_SESSION['uname'])==1)
		{
			?>
			<div class="grid-10" style="width:80%;">
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
								<th>Total Questions</th>
								<th>Actions</th>
							</tr>
						</thead>
						<?php
						echo "<h5>Test under course</h5>";
						?> 
						<?php
						foreach($result as $rowtest)
						{
							?>
							<tbody><tr>
								<td><?php echo $rowtest['testid']; ?></td>
								<td><?php echo $rowtest['courseid']; ?></td>
								<td><?php echo $rowtest['testname']; ?></td>
								<td><?php echo $rowtest['testdescription']; ?></td>
								<td><?php echo $rowtest['test_duration']; ?></td>
								<td><?php echo $rowtest['total_questions']; ?></td>
								<td>
									<p><form><input type="hidden" name="testID" value="<?php echo $rowtest['testid']; ?>" /><button type="submit" formmethod="post" formaction="edit_test.php" class="btn btn-primary btn-sm">Edit Test</button></form></p>
									<p><form><input type="hidden" name="testID" value="<?php echo $rowtest['testid']; ?>" /><input type="hidden" name="corID" value="<?php echo $rowtest['courseid']; ?>" /><button type="submit" class="btn btn-danger btn-sm delete_button">Delete Test</button></form></p>
								<?php if($rowtest['is_published']==0){ 
								?>	<form><input type="hidden" name="testID" value="<?php echo $rowtest['testid']; ?>" /><input type="hidden" name="corID" value="<?php echo $rowtest['courseid']; ?>" /><input type="hidden" value="1" name="publish_value"/><button type="submit" name="publish" class="btn btn-danger btn-sm publish_button">Publish</button></form>
								<?php } 
								else { ?> <form><input type="hidden" name="testID" value="<?php echo $rowtest['testid']; ?>" /><input type="hidden" name="corID" value="<?php echo $rowtest['courseid']; ?>" /><input type="hidden" value="2" name="unpublish_value"/><button type="submit" name="unpublish" class="btn btn-danger btn-sm publish_button">Unpublish</button></form>
							<?php } ?></td>
							</tr>
						</tbodY>
							<?php
						} //End of foreach
						?>
						</table>
						<?php
					}
					else {
						echo "There are currently no tests under this course.";
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