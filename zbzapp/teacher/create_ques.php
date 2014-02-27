<?php
require_once('../config.php');
require_once('loggedin.php');


if(isset($_GET['quesID']) && isset($_GET['testID']))
{
$questionID=$_GET['quesID'];
$testID=$_GET['testID'];
	if(checkifQexists($questionID,$testID,$dbinfo)===0) {
		$createQuesSQL=$dbinfo->prepare("INSERT INTO question_bank (quesid,testid) VALUES (?,?)");
		$createQuesSQL->execute(array($questionID,$testID));
		if($createQuesSQL===1){
		return 1; //If successful
		}
		else
		{
		return 0; //Not Successful
		}
	}
	else {
		return 1; //Do nothing and return, if testID and QuesID exist.
	}
}
else
{
echo "Error capturing question ID";
}

/**
 * Check if question already exists for the respective test ID
 */
function checkifQexists($questionID,$testID,$dbinfo) {
	$checkQues = $dbinfo->prepare("SELECT COUNT(*) FROM question_bank WHERE quesid=? AND testid=?");
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

