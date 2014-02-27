<?php
   require_once('../config.php');
   require_once('loggedin.php');
   $titleset="Test Editor";
   include('header.php');
   ?>
<script type="text/javascript">

$(function(){
$("#fetch_questions_list").load("fetch_questions_list.php?testID=<?php echo $_POST['testID']; ?>");	
 //callback handler for form submit
$(".test_edit").submit(function(event)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR)
        {
            //alert("Server response:"+data);//data: return data from server
            $("#fetch_questions_list").load("fetch_questions_list.php?testID=<?php echo $_POST['testID']; ?>");	
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            alert("There was an issue. Try again later.");    
        }
    });
    event.preventDefault(); //STOP default action
    event.unbind(); //unbind. to stop multiple form submit.
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
      <div class="grid-6 grid grey">
         <h5>Questions List</h5>
	<!-- Questions list DIV dynamic loading-->
	<div id="fetch_questions_list"></div>
	</div>
	<br/>
     <div class="grid-10">
     <br/>
         <h2>Test Manager</h3>
         <br/>	
	<div id="displayProgress"></div>
	<div id="displayQuestionDiv"></div>
	<br/>
         <br/>
	<h3>Test Information</h3>
         <?php
	if(isset($_POST['testID']))
	{
    /*Check $_SESSION['teacherid'] is the owner of this test or not. If it is then pass, else show not authorized to edit this test.
    SQL Query for it -> SELECT teacher_course_status.uid,course_test_status.testid
    FROM teacher_course_status
    LEFT JOIN course_test_status ON teacher_course_status.courseid = course_test_status.courseid
    */
    $checkAuthorized = $dbinfo->prepare("SELECT teacher_course_status.uid, teacher_course_status.coursename, course_test_status.testid FROM teacher_course_status LEFT JOIN course_test_status ON teacher_course_status.courseid = course_test_status.courseid WHERE course_test_status.testid=?");
    $checkAuthorized->execute(array($_POST['testID']));
    $resultcheckAuth = $checkAuthorized->fetchALL();
    foreach ($resultcheckAuth as $checkAuthvalue) {
      $teacher_check_ID=$checkAuthvalue['uid'];
    }
    if($teacher_check_ID==$_SESSION['teacherid']){
    		$fetchTestInfo = $dbinfo->prepare("SELECT * from course_test_status where testid=?");
    		$fetchTestInfo -> execute(array($_POST['testID']));
    		$resultTestInfo = $fetchTestInfo->fetchALL();
    		if($resultTestInfo) {
    			foreach($resultTestInfo as $rowTestInfo)
    			{
    				//Output test related information
    			?>
    			<form name="test_edit" class="test_edit" id="hongkiat-form" method="post" action="test_edit_func.php">
    				<input id="testid" name="testID" type="hidden" value="<?php echo $_POST['testID']; ?>" />
                		<label>Test Name</label>
                		<input type="text" id="testname" class="txtinput" placeholder="eg, java_test_1" name="testname" value="<?php echo $rowTestInfo['testname']; ?>" />
    	    		<label>Test Description</label>
                		<textarea row="2" columns="2" id="testdesc" placeholder="What is it about?" class="txtinput" name="testdesc"><?php echo $rowTestInfo['testdescription']; ?></textarea>
                		<label>Test Duration</label>
                		<input type="text" id="testduration" value="<?php echo $rowTestInfo['test_duration']; ?>" placeholder="The Time should only be in minutes." class="txtinput" name="testduration" />
    	    		<label>Total Questions (Can be changed later)</label>
    	    		<input type="text" id="totalQuestions" value="<?php echo $rowTestInfo['total_questions']; ?>" placeholder="How many questions will you add?" class="txtinput" name="totalQuestions" />
                		<section id="buttons">	
                   		<input type="submit" id="submitbtn" class="submitbtn" name="createtest" value="Update" />
                		</section>
             		</form>
    			<?php
    			}
    		}
    	}
      else {
        echo "You do not have the permission to edit this test.";
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
