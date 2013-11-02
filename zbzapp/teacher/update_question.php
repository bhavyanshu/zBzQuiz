<?php 
require_once('../config.php');
require_once('loggedin.php');

if(isset($_POST['questext'])&& isset($_POST['type_question']) && isset($_POST['quesid']) && isset($_POST['testid']))
{
	if($_POST['type_question']=='mcq'){	
	$typeid=1;
	$queryQues=$dbinfo->prepare("UPDATE question_bank SET questext=?,typeid=? WHERE testid=? AND quesid=?");
	$queryQues->execute(array($_POST['questext'],$typeid,$_POST['testid'],$_POST['quesid']));
	}
	elseif($_POST['type_question']=='truefalse'){
	$typeid=2;
	$queryQues=$dbinfo->prepare("UPDATE question_bank SET questext=?,typeid=? WHERE testid=? AND quesid=?");
	$queryQues->execute(array($_POST['questext'],$typeid,$_POST['testid'],$_POST['quesid']));
	}
	else{
	echo "Invallide type_question value!"; 
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
?>
