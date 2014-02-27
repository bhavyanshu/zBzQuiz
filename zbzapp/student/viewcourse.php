<?php
require_once('../config.php');
require_once('loggedin.php');
$titleset="Course Information";
include('header.php');
?>
<!-- BEGIN STYLE TAG FOR TABLE -->
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
<!-- ENDING STYLE TAG -->

<script type="text/javascript">
$(document).ready(function (){
	  $(".btn.btn-primary.btn-sm.enroll_button").click(function(event){
	  	
	  	var spinner = $("<img src='../img/ajax-loader-green-small.gif' alt='Loading..' />").insertAfter(this);
	    var form_data = $(this).closest("form").serialize();
	    //var formAction = $(this).attr("formaction");
	    //alert(form_data);
	    $.ajax({
		url: "send_enroll_request.php",
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
	});
</script>

<div class="wrapper">
	<div class="grids">
		<div class="grid-10" style="width:70%;">
		<?php 
		if(checkIfStuLoggedIn($_SESSION['LoggedIn'],$_SESSION['stuname'])==1)
		{	
			$studentID = $_SESSION['stuID'];
			if(isset($_GET['corID']) && !empty($_GET['corID'])){
				$courseProfID = $_GET['corID'];
				//Check if course ID actually exists before performing any further operations
				try{
				$fetch_course_info = $dbinfo->prepare("SELECT * FROM teacher_course_status WHERE courseid=?");
				$fetch_course_info->execute(array($courseProfID));
				$result_fetch_course_info = $fetch_course_info->fetchAll();
				if($result_fetch_course_info){
					foreach ($result_fetch_course_info as $course_value) { //Get complete course information
						$_courseID = $course_value['courseid'];
						$_facultyID = $course_value['uid'];
						$_courseName = $course_value['coursename'];	
						$_courseDescription = $course_value['coursedesc'];
					}
					try{
						$fetch_teacher_info = $dbinfo->prepare("SELECT * FROM teacher_login_zbzxt WHERE uid=?");
						$fetch_teacher_info->execute(array($_facultyID));
						$result_fetch_teacher_info = $fetch_teacher_info->fetchAll();
						if($result_fetch_teacher_info){
							foreach ($result_fetch_teacher_info as $teacher_value) {
								$_facultyName = $teacher_value['uname'];
								$_facultyEmail = $teacher_value['uemail'];
							}
						}
						else {
							echo "Something doesn't look right here. Contact Support";
						}
					}
					catch(PDOException $e){
						echo "Error Exception:".$e;
					}
					//Generate HTML below to display course information
					?>
					<h4><?php echo $_courseName." course by faculty, <a href='mailto:".$_facultyEmail."'>".$_facultyName."</a>"; ?></h4>
					<p class="quote"><?php echo $_courseDescription; ?></p>
					<hr/>
					<h2>List of Available Tests</h2>
					<?php
					//Build a list of published tests and display here
					try{
						$_testIsPublished = 1;
						$fetch_test_list = $dbinfo->prepare("SELECT * FROM course_test_status WHERE courseid=? AND is_published=?");
						$fetch_test_list->execute(array($_courseID,$_testIsPublished));
						$result_fetch_test_list=$fetch_test_list->fetchAll();
						if($result_fetch_test_list){
							?>
							<table>
								<thead>
									<tr>
										<th>Test ID</th>
										<th>Test Name</th>
										<th>Test Description</th>
										<th>Test Duration</th>
										<th>Total Questions</th>
										<th>Actions</th>
									</tr>
								</thead>
							<?php
							foreach ($result_fetch_test_list as $test_value) {
								$_testID = $test_value['testid'];
								$_testName = $test_value['testname'];
								$_testDescription = $test_value['testdescription'];
								$_testDuration = $test_value['test_duration'];
								$_testTotalQues = $test_value['total_questions'];
								$_testIsPublished = $test_value['is_published'];
								?>
									<tbody>
										<tr>
											<td><?php echo $_testID; ?></td>
											<td><?php echo $_testName; ?></td>
											<td><?php echo $_testDescription; ?></td>
											<td><?php echo $_testDuration; ?></td>
											<td><?php echo $_testTotalQues ?></td>
											<td><div class="action_holder">
											<form>
											<input type="hidden" name="test_enroll_ID" value="<?php echo $_testID; ?>" />
											<?php
											//Main logic for enrollment requests.
											try {
												$checkEnrollStatus = $dbinfo->prepare("SELECT COUNT(*) FROM student_test_status WHERE stuid=? AND testid=?");
												$checkEnrollStatus->execute(array($studentID,$_testID));
												$count_rows = $checkEnrollStatus->fetchColumn();
												$checkEnrollStatus->closeCursor();
												if($count_rows>0){ //Already exists. Now display Status(Enabled or not) of enrollment.
													$checkActualStatus = $dbinfo->prepare("SELECT * FROM student_test_status WHERE stuid=? AND testid=?");
													$checkActualStatus->execute(array($studentID,$_testID));
													$result_checkActualStatus = $checkActualStatus->fetchAll();
													if($result_checkActualStatus) {
														foreach($result_checkActualStatus as $CAS_value) { //Now show buttons for "Pending" or "Give Test"
															if($CAS_value['is_submitted']==0) {
																if($CAS_value['is_enabled']==0) {
																	//Generate HTML for button below
																	?>
																	<button type="submit" class="btn btn-warning btn-sm pending_button" disabled="disabled" title="Wait for teacher to accept">Request Sent</button>
																	<?php
																}
																else {
																	//Generate HTML for "Give Test" button below
																	?>
																	<button type="submit" class="btn btn-success btn-sm givetest_button">Give Test</button>
																	<?php
																}
															}
															else {
																// Show "View Report" button
																?>
																<button type="submit" class="btn btn-success btn-sm viewreport_button">View Report</button>
																<?php
															}	
														}
													}
													else {
														echo "There was an error fetching status";
													}
												}
												else { //Does not exists. Show button to generate enrollment request.
													//Generate HTML for "Enroll" button below
													?>
													<button type="submit" class="btn btn-primary btn-sm enroll_button">Enroll</button>
													<?php
												}
											}
											catch(PDOException $e) {
												echo $e->getMessage();
											}
												?>
											</form>	
										</tr>
									</tbody>
							<?php	
							} //End of foreach
							?>
							</table>
							<?php
						} //End of IF
						else {
							echo "<b>There are currently no tests published under this course. Kindly inform <a href='mailto:".$_facultyEmail."'>".$_facultyName."</a> who is the concerned faculty.</b>";
						}
					}
					catch(PDOException $e){
						echo "Error Exception: ".$e;
					}
					?>
				<?php
				} 
				else {
					echo "How did you get here? Something messed up! << <a title='Go back' href='index.php'> Go back </a>";
				}
				}
				catch(PDOException $e){
					echo "Error Exception: ".$e;
				}
			}
			else {
				echo "Invalid Course. How did you get here? Something messed up! << <a title='Go back' href='index.php'> Go back </a>";
			}
		?>
			

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