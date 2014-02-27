<script type="text/javascript">
$(document).ready(answerspansfunc);
</script>

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


    $(function () {
        $('form.form_delete_ques').on('submit', function(e) {
            $.ajax({
                type: 'post',
                url: 'delete_question.php',
                data: $(this).serialize(),
                success: function (o) {
                    //alert(data); //This was just for testing.
                    $("#fetch_questions_list").load("fetch_questions_list.php?testID=<?php echo $_GET['testID']; ?>");  
                    $(form.txtinput).val("");
                }
            });
            e.preventDefault();
        });
    });        
</script>
<?php 
   require_once('../config.php');
   $questionID=$_GET['quesID']; 
   $testID=$_GET['testID'];
   $fetch_ques=$dbinfo->prepare("SELECT * FROM question_bank where quesid=? AND testid=?");
   $fetch_ques->execute(array($questionID,$testID));
   $result=$fetch_ques->fetchALL();
   if($result)
   {
	foreach($result as $rowQues){
	?>
  <script type="text/javascript">

  </script>
  <p><form class="form_delete_ques" action="" method="post"><input id="testid" name="testID" type="hidden" value="<?php echo $_GET['testID']; ?>" />
    <input id="quesid_form" name="quesID" type="hidden" value="<?php echo $_GET['quesID'];  ?>" />
    <input type="submit" class="button_delete_ques button_delete_ques-1" title="Delete Question" style="background: url(../img/delete_icon_48.png) no-repeat;width:48px;height:48px;cursor:pointer;border: none;" value="" />
  </form></p>
  <br/>
	<form name="update_question" class="questionreg" id="hongkiat-form" method="post" action="update_question.php">
	    
	    <input type="hidden" name="testid" class="txtinput" value="<?php echo $rowQues['testid']; ?>">  
	    
	    <input type="hidden" name="quesid" class="txtinput" value="<?php echo $rowQues['quesid']; ?>">
            <label><h5>Question <?php echo $rowQues['quesid']; ?></h5></label>
            <input type="text" name="questext" class="txtinput" id="questext_input" placeholder="Add Question text" value="<?php echo $rowQues['questext']; ?>" />
            <label>Marks for Correct Answer</label>
            <input type="text" id="ques_positive_marks" value="<?php echo $rowQues['positive_marks']; ?>" placeholder="Enter marks for correct answer" class="txtinput" name="ques_positive" />
            <label>Negative Marks</label>
            <input type="text" id="ques_negative_marks" value="<?php echo $rowQues['negative_marks']; ?>" placeholder="Enter negative marks" class="txtinput" name="ques_negative" />
            <section id="buttons">		
	    <label><h5>Type</h5></label>
      <p><input id="mcq" type="radio" name="type_question" value="mcq" <?php echo ($rowQues['typeid']==1)?'checked':'' ?> ><b> MCQ</b>
         <br>
         <input id="truefalse" type="radio" name="type_question" value="truefalse" <?php echo ($rowQues['typeid']==2)?'checked':'' ?> ><b> True/False</b>
         <br>
         <input id="fillblanks" type="radio" name="type_question" value="fillblanks" <?php echo ($rowQues['typeid']==3)?'checked':'' ?> ><b> Fill in the Blank</b>
         <br>
         </p>
         <span id="attachafter"></span>
        <?php //Fetching answers
        function FetchAnswers($rowtestid,$rowquesid,$dbinfo){
          $fetch_ans=$dbinfo->prepare("SELECT * FROM question_answer_choices where testid=? AND quesid=?");
          $fetch_ans->execute(array($rowtestid,$rowquesid));
          return $fetch_ans->fetchALL();
        }
        if($rowQues['typeid']==1){
          //Load MCQ SPAN
          $result=FetchAnswers($rowQues['testid'],$rowQues['quesid'],$dbinfo);
          if($result){
            foreach ($result as $counter => $ansText ) {
              $counter++;
              echo "<span class='mcqspan'><label><b>".$counter." Mark as correct -> </b></label> <input type='radio' name='correct_ans' title='Mark as correct' value='".$counter."'/> <input type='text' name='anstext[]' class='txtinput' placeholder='Add Answer text here' value='".$ansText['anstext']."' /><br/></span>";
            }
          }
          else
            { echo "Problem fetching answers"; }
        }
        elseif($rowQues['typeid']==2){
          //Load TRUE FALSE SPAN
          $result=FetchAnswers($rowQues['testid'],$rowQues['quesid'],$dbinfo);
          if($result){
            foreach($result as $counter => $ansText){
              $counter++; ?>
              <span class='truefalsespan'><label><b>Select circle for right option </b></label><br/><label>True</label><input type='radio' name='correct_ans' title='Mark as correct' value='1'  <?php echo ($ansText['correct_answer']==1)?'checked':'' ?> /><br /><label>False</label><input type='radio' name='correct_ans' title='Mark as correct' value='2' <?php echo ($ansText['correct_answer']==2)?'checked':'' ?> /><br/></span><br/>
            <?php }
          }
          else {
            echo "Problem Fetching answers";
          }
        }
        elseif($rowQues['typeid']==3){
          //Load Fill BLanks SPAN
          $result=FetchAnswers($rowQues['testid'],$rowQues['quesid'],$dbinfo);
          if($result){
            foreach($result as $ansText){
          echo "<span class='fillblankspan'><label><b> Answer </b></label><input type='text' name='anstext' class='txtinput' placeholder='Add Correct Answer here' value='".$ansText['anstext']."' /><br/></span>";
          }
        }
          else {
            echo "Problem Fetching answers";
          }        
        }
        else {
          //echo "Please select a question type.";
        }
        ?>
        <br>
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
   	echo "<h5>Error: fetch questions module issue.</h5>";
   }
?>