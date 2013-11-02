<?php
   require_once('../config.php');
   require_once('loggedin.php');
   $titleset="Test Editor";
   include('header.php');
   ?>
<script type="text/javascript">
$(document).ready(function (){
	  $(".button_create_ques").click(function(){
	    var form_data = $(this).closest("form").serialize();
	    //alert(form_data);
	    $.ajax({
		url: "create_ques.php?testID=<?php echo $_GET['testID']; ?>",
		type: 'GET',
		data: form_data,
		success: function() 
			    {
			    //alert("Question Initialized"); This is where we load the new question editing div
				$('#displayProgress').hide()  // hide it initially
    				.ajaxStart(function() {
        				$(this).html("<img src='../img/ajax-loader.gif' title='Loading..' alt='Loading..' />").show();
    					})
				    .ajaxStop(function() {
					$(this).hide();
				    });
				$("#displayQuestionDiv").load("fetch_question.php?"+form_data)	
			    }
		    });
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
      <div class="grid-6 grid grey">
         <h5>Questions List</h5>
	 <?php
	if(isset($_GET['testID']))
	{
		$fetchQInfo = $dbinfo->prepare("SELECT total_questions from course_test_status where testid=?");
		$fetchQInfo -> execute(array($_GET['testID']));
		$resultQInfo = $fetchQInfo->fetchALL();
		if($resultQInfo){
			foreach($resultQInfo as $Qinfo)
			echo "<p><b>Total Questions:</b> ".$Qinfo['total_questions']."</p>";
			$divCreator=1;
			while($divCreator!=$Qinfo['total_questions']+1){
			?>
			<form id="form_create_ques" action="" method="get"><div class="grid-6 grid grey"><input id="quesid_form" name="quesID" type="hidden" value="<?php echo $divCreator;  ?>" /><input type="submit" class="button_create_ques" value="<?php echo $divCreator; ?>" /></div></form>
			<?php
			$divCreator+=1;
			}
		}
		else{
			echo "<p>There was an error fetching questions from database.Please contact administrator.</p>";
		}	
	}
	else
	{
	echo "Invalide Test ID. Please contact administrator.";
	}
	?>
	</div>
      <div class="grid-10">
         <h2>Test Manager</h3>
         <br/>	
	<div id="displayProgress"></div>
	<div id="displayQuestionDiv"></div>
	<br/>
         <br/>
	<h3>Test Information</h3>
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
			?>
			<form name="test_edit" class="test_edit" id="hongkiat-form" method="post" action="test_edit.php?testID=<?php echo $rowTestInfo['testid']; ?>">
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
