<?php
require_once '../config.php';
$questionID=$_POST['quesID'];
$testID=$_POST['testID'];
$fetch_ques=$dbinfo->prepare( "DELETE FROM question_bank where quesid=? AND testid=?" );
$result=$fetch_ques->execute( array( $questionID, $testID ) );
if ( $result === true ) {
  update_course_test_status($questionID, $testID, $dbinfo);
  return 1;
}
else {
  return 0;
}

function update_course_test_status($questionID_new, $testID_new, $dbinfo_new){
  $tempvalue_questions = getQuestionCount($testID_new,$dbinfo_new);
  $final_count = $tempvalue_questions - 1;
  $createcourseSQL=$dbinfo_new->prepare("UPDATE course_test_status SET total_questions=? WHERE testID=?");
  $createcourseSQL->execute(array($final_count,$testID_new));   
    if($createcourseSQL)
    {
    return 1;
    }
    else
    {
    return 0;
    }
}

function getQuestionCount($testID_new,$dbinfo_new) {
  $fetchQInfo = $dbinfo_new ->prepare("SELECT total_questions from course_test_status where testid=?");
    $fetchQInfo -> execute(array($testID_new));
    $resultQInfo = $fetchQInfo->fetchALL();
    if($resultQInfo){
      foreach($resultQInfo as $Qinfo)
      return $Qinfo['total_questions'];
    }
    else {
      return 0;
    }
}
?>
