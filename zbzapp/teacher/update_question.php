<?php 
require_once('../config.php');
require_once('loggedin.php');

if(isset($_POST['questext']) && isset($_POST['ques_positive']) && isset($_POST['ques_negative']) && isset($_POST['type_question']) && isset($_POST['quesid']) && isset($_POST['testid']))
{
	if($_POST['type_question']=='mcq'){	
	/*
	* First update question bank table and inform it that question type is mcq.
	*/	
	$typeid=1;
	$queryQues=$dbinfo->prepare("UPDATE question_bank SET questext=?,typeid=?,negative_marks=?,postive_marks=? WHERE testid=? AND quesid=?");
	$queryQues->execute(array($_POST['questext'],$typeid,$_POST['ques_negative'],$_POST['ques_positive'],$_POST['testid'],$_POST['quesid']));	
		if(isset($_POST['anstext']) && isset($_POST['correct_ans'])){ //Check for values in arrays
			if(checkifQTexists($_POST['quesid'],$_POST['testid'],$dbinfo)===1) { //exists, go with delete then insert
				$DeleteQues=$dbinfo->prepare("DELETE FROM question_answer_choices WHERE testid=? AND quesid=?");
				$DeleteQues->execute(array($_POST['testid'],$_POST['quesid']));	
			foreach($_POST['anstext'] as $value_anstext) {
			    $queryOptions=$dbinfo->prepare("INSERT INTO question_answer_choices(testid,quesid,anstext,correct_answer) VALUES (?,?,?,?)");
				$queryOptions->execute(array($_POST['testid'],$_POST['quesid'],$value_anstext,$_POST['correct_ans']));
				if($queryOptions){
					echo "Updated";
				}
				else
				{
					echo "Error updating values";
				}
				}
			}
			else { //Does not Exists, go with INSERT
				foreach($_POST['anstext'] as $value_anstext) {
				//foreach($_POST['correct_ans'] as $value_radio){
			    $queryOptions=$dbinfo->prepare("INSERT INTO question_answer_choices(testid,quesid,anstext,correct_answer) VALUES (?,?,?,?)");
				$queryOptions->execute(array($_POST['testid'],$_POST['quesid'],$value_anstext,$_POST['correct_ans']));
				if($queryOptions){
					echo "Updated";
				}
				else
				{
					echo "Error updating values";
				}
				//}
				}

			}
		}
		else {
			echo "Some field was left empty.";
		}
	}
	elseif($_POST['type_question']=='truefalse'){
	$typeid=2;
	$queryQues=$dbinfo->prepare("UPDATE question_bank SET questext=?,typeid=?,negative_marks=?,positive_marks=? WHERE testid=? AND quesid=?");
	$queryQues->execute(array($_POST['questext'],$typeid,$_POST['ques_negative'],$_POST['ques_positive'],$_POST['testid'],$_POST['quesid']));
	if(isset($_POST['correct_ans'])){ //Check for values in arrays
		if($_POST['correct_ans']==1){
			$ans_truefalse="True";
		}
		else {
			$ans_truefalse="False";
		}
		if(checkifQTexists($_POST['quesid'],$_POST['testid'],$dbinfo)===1) { //exists, go with delete then insert
				$DeleteQues=$dbinfo->prepare("DELETE FROM question_answer_choices WHERE testid=? AND quesid=?");
				$DeleteQues->execute(array($_POST['testid'],$_POST['quesid']));	
				$queryOptions=$dbinfo->prepare("INSERT INTO question_answer_choices(testid,quesid,anstext,correct_answer) VALUES (?,?,?,?)");
				$queryOptions->execute(array($_POST['testid'],$_POST['quesid'],$ans_truefalse,$_POST['correct_ans']));
				if($queryOptions){
					echo "Updated";
				}
				else
				{
					echo "Error updating values";
				}
			}
		else { //Does not exist. Go with insert
			    $queryOptions=$dbinfo->prepare("INSERT INTO question_answer_choices(testid,quesid,anstext,correct_answer) VALUES (?,?,?,?)");
				$queryOptions->execute(array($_POST['testid'],$_POST['quesid'],$ans_truefalse,$_POST['correct_ans']));
				if($queryOptions){
					echo "Updated";
				}
				else
				{
					echo "Error updating values";
				}
			}
		}		
	}
	elseif($_POST['type_question']=='fillblanks') {
	$typeid=3;
	$queryQues=$dbinfo->prepare("UPDATE question_bank SET questext=?,typeid=?,negative_marks=?,postive_marks=? WHERE testid=? AND quesid=?");
	$queryQues->execute(array($_POST['questext'],$typeid,$_POST['ques_negative'],$_POST['ques_positive'],$_POST['testid'],$_POST['quesid']));
	if(checkifQTexists($_POST['quesid'],$_POST['testid'],$dbinfo)===1) { //exists, go with delete then insert
				$DeleteQues=$dbinfo->prepare("DELETE FROM question_answer_choices WHERE testid=? AND quesid=?");
				$DeleteQues->execute(array($_POST['testid'],$_POST['quesid']));	
				$queryOptions=$dbinfo->prepare("INSERT INTO question_answer_choices(testid,quesid,anstext) VALUES (?,?,?)");
				$queryOptions->execute(array($_POST['testid'],$_POST['quesid'],$_POST['anstext']));
				if($queryOptions){
					echo "Updated";
				}
				else
				{
					echo "Error updating values";
				}
			}
		else { //Does not exist. Go with insert
			    $queryOptions=$dbinfo->prepare("INSERT INTO question_answer_choices(testid,quesid,anstext) VALUES (?,?,?)");
				$queryOptions->execute(array($_POST['testid'],$_POST['quesid'],$_POST['anstext']));
				if($queryOptions){
					echo "Updated";
				}
				else
				{
					echo "Error updating values";
				}
			}

	}
	else{
	echo "Invalide type_question value!"; 
	}
		if($queryQues)
		echo "Value updated";
		else
		echo "Error updating values";
}
else
{
echo "Error fetching  values!";
}

/**
* This function would check if testid and quesid already exist in the table or not.
*/
function checkifQTexists($questionID,$testID,$dbinfo) {
	$checkQues = $dbinfo->prepare("SELECT COUNT(*) FROM question_answer_choices WHERE quesid=? AND testid=?");
	$checkQues->execute(array($questionID,$testID));
	$count = $checkQues->fetchColumn();
	$checkQues->closeCursor();
	if($count>0) { //Check if number of entries in database is greater than 0
		return 1; //Exists
	}
	else {
		return 0; //Does not exist
	}
}

?>
