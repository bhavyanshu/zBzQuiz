<script type="text/javascript">
$(document).ready(function (){
/* This javascript code lets user select/unselect radio buttons. We are overriding the default behavior of radio buttons here! */
$('input[type="radio"]').click(function (e) {

    // find out whether it was already checked
    var wasChecked = $(this).data('checked') || false;

    // ensure all buttons think they're unchecked 
    $('input[type="radio"]').data('checked', false);

    if (wasChecked) {
        // leave them all unchecked
        this.checked = false;
    } else {
        // just check this one
        this.checked = true;
        $(this).data('checked', true);
    }
});

});
</script>
<?php
require_once('../../config.php');
require_once('loggedin.php');

function FetchQuestion($POST_testid,$POST_quesid,$dbinfo){
  $fetch_ques=$dbinfo->prepare("SELECT * FROM question_bank WHERE testid=? AND quesid=?");
  $fetch_ques->execute(array($POST_testid,$POST_quesid));
  return $fetch_ques->fetch(PDO::FETCH_ASSOC);
}

function FetchAnswers($POST_testid,$POST_quesid,$dbinfo) {
    $fetch_ans=$dbinfo->prepare("SELECT * FROM question_answer_choices WHERE testid=? AND quesid=?");
    $fetch_ans->execute(array($POST_testid,$POST_quesid));
    return $fetch_ans->fetchAll();

}

if(checkIfStuLoggedIn($_SESSION['LoggedIn'],$_SESSION['stuname'])==1) { //Check if logged in or not

  if(isset($_GET['test_ID']) && !empty($_GET['test_ID']) && isset($_GET['ques_ID']) && !empty($_GET['ques_ID'])) {
    $POST_testid = $_GET['test_ID'];
    $POST_quesid = $_GET['ques_ID'];
    $result_ques=FetchQuestion($POST_testid,$POST_quesid,$dbinfo);
    if($result_ques) {
      //Fetch question text
          echo "<h2>".$result_ques['questext']."</h2>";
          $type_id = $result_ques['typeid'];
          $result_ans = FetchAnswers($POST_testid,$result_ques['quesid'],$dbinfo);
          if($result_ans) {
              if($type_id==1){     //Load MCQ content
                ?>
              <form class="form-horizontal">
                <?php
                foreach($result_ans as $result_set_ans) { 
                  $j=1;
                  ?>
                  <p><input type="radio" name="ans_mcq" value="<?php echo $j; ?>"><?php echo $result_set_ans['anstext']; ?></p>
                  <?php
                  $j++;
                }
                ?>
              </form>
                <?php
              }

              elseif($type_id==2) { //Load True/False radio buttons
                foreach($result_ans as $result_set_ans) { 
                  echo $result_set_ans['anstext'];
                }
              }

              elseif($type_id==3) { //Load fill in the blank content
                foreach($result_ans as $result_set_ans) { 
                  echo $result_set_ans['anstext'];
                }
              }
          }
          else {
            echo "There was an error fetching answers.";
          }

      
    }
    else {
      echo "Could not fetch question. Contact administrator!";
    }
?>



<?php
  }
  else {
    echo "Could not catch values.";
  }
}
else {
  echo "Not authorized to view this page.";
}
?>