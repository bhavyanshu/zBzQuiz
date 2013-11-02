<script>
    $(function () {
        $('form.questionreg').on('submit', function(e) {
            $.ajax({
                type: 'post',
                url: 'update_question.php',
                data: $(this).serialize(),
                success: function (o) {
                    //alert('Done!'); This was just for testing.
		
                }
            });
            e.preventDefault();
        });
    });     
</script>
<?php 
   require_once('../config.php');
   $questionID=$_GET['quesID']; 
   $fetch_ques=$dbinfo->prepare("SELECT * FROM question_bank where quesid=?");
   $fetch_ques->execute(array($questionID));
   $result=$fetch_ques->fetchALL();
   if($result)
   {
	foreach($result as $rowQues){
	?>
	<form name="update_question" class="questionreg" id="hongkiat-form" method="post" action="update_question.php">
	    
	    <input type="hidden" name="testid" class="txtinput" value="<?php echo $rowQues['testid']; ?>">  
	    
	    <input type="hidden" name="quesid" class="txtinput" value="<?php echo $rowQues['quesid']; ?>">
            <label><b>Question Text</b></label>
            <input type="text" name="questext" class="txtinput" placeholder="Add Question text" value="<?php echo $rowQues['questext']; ?>" />
            <section id="buttons">		
	    <label><b>Type</b></label>
		<p><input type="radio" name="type_question" value="mcq">MCQ<br>
		<input type="radio" name="type_question" value="truefalse">True/False<br></p>
            <input type="submit" id="submitbtn" class="submitbtn" name="updatequestion" value="Update" />
            </section>
         </form>
<br>
<hr/>
<?php
	}
   }
   else
   {
   	echo "<h5>There are currently no courses registered by you.</h5>";
   }
?>
