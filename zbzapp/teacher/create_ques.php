<?php
require_once('../config.php');
require_once('loggedin.php');


if(isset($_GET['quesID'])&& isset($_GET['testID']))
{
$questionID=$_GET['quesID'];
$testID=$_GET['testID'];
$createQuesSQL=$dbinfo->prepare("INSERT INTO question_bank (quesid,testid) VALUES (?,?)");
$createQuesSQL->execute(array($questionID,$testID));
	if($createQuesSQL){
	return 1; //If successful
	}
	else
	{
	return 0; //Not Successful
	}

}
else
{
echo "Error capturing question ID";
}
?>

