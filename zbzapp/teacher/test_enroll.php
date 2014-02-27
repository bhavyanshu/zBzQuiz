<?php
//This is just for testing the current enrollment request fetching system
require_once('../config.php');
require_once('loggedin.php');

if(checkIfLoggedIn($_SESSION['LoggedIn'],$_SESSION['uname'])==1) {
	$i=0;
    $generate_testid = $dbinfo->prepare("SELECT teacher_course_status.uid, course_test_status.testid FROM teacher_course_status LEFT JOIN course_test_status ON teacher_course_status.courseid = course_test_status.courseid WHERE teacher_course_status.uid=?");
    $generate_testid->execute(array($_SESSION['teacherid']));
    $result_testid=$generate_testid->fetchAll();
    foreach($result_testid as $row_result) {
    	//Okay, now we have all the required testIDs corresponding to the Teacher ID. We now fetch stuname,testname,test_attemptid for the corresponding testid
    	$getData = $dbinfo->prepare("SELECT stuname,testname,s.test_attemptid,s.stuid,s.testid FROM student_test_status s JOIN course_test_status c ON c.testid = s.testid JOIN student_login_zbzxs l ON l.stuid = s.stuid WHERE s.testid=? AND s.is_enabled=?");
    	$getData->execute(array($row_result['testid'],0));
    	$result_getData = $getData->fetchAll();
    	foreach($result_getData as $row_getData) { 
    		$_testid = $row_getData['testid'];
    		$_stuid = $row_getData['stuid']; 
    		$id = $row_getData['test_attemptid'];
    		?>
    		<div id="enrollment" class="bg-info">         
            <?php $i++; echo $i.") ".ucfirst($row_getData['stuname']);?> has requested enrollment for <?php echo ucfirst($row_getData['testname']);?> test
            <form style="margin-top:10px;">
            	<input type="hidden" name="test_ID" value="<?php echo $_testid; ?>" />
            	<input type="hidden" name="stu_ID" value="<?php echo $_stuid; ?>" />
            	<button class="btn btn-primary acceptbtn" type="submit">Accept</button>
            </form>
            </div>
  <?php }
    }
    echo "End of the list";
    ?>
    <div class="more_div">
        <div id="load_more_<?php echo $id; ?>" class="more_tab">
        <button class="btn btn-primary btn-sm"><div class="more_button" id="<?php echo $id; ?>">Fetch New Requests</div></button>
    	</div>
    </div> 
    <?php
}
else {
	echo "You are currently not logged in!";
}
?>