 <script type="text/javascript">
$(document).ready(function (){
	  $(".button_create_ques").click(function(){
	    var form_data = $(this).closest("form").serialize();
	    //alert(form_data);
	    $.ajax({
		url: "create_ques.php",
		type: 'GET',
		data: form_data,
		success: function() 
			    {
			    //alert("Question Initialized"); This is where we load the new question editing div
			    $('html, body').animate({
        		scrollTop: $("#displayProgress").offset().top}, 1600);
				$('#displayProgress').hide()  // hide it initially
    				.ajaxStart(function() {
        				$(this).html("<img src='../img/ajax-loader.gif' title='Loading..' alt='Loading..' />").show();
    					})
				    .ajaxStop(function() {
					$(this).hide();
				    });
				//alert(form_data);    
				$("#displayQuestionDiv").load("fetch_question.php?"+form_data)	
				//$("#questext_input").focus();
			    }
		    });
		    return false;
		  });
});
	  
 </script>
 <?php
    require_once('../config.php');
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
			<form class="form_create_ques" action="" method="get"><div class="grid-6 grid grey"><input id="testid" name="testID" type="hidden" value="<?php echo $_GET['testID']; ?>" /><input id="quesid_form" name="quesID" type="hidden" value="<?php echo $divCreator;  ?>" /><input type="submit" class="button_create_ques button_create_ques-1" value="<?php echo "Q ".$divCreator; ?>" /></div></form>
			<!-- <img class="delete_q" src="../img/delete_icon.png" width="50px" title="Delete Question" alt="Delete" /> -->
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