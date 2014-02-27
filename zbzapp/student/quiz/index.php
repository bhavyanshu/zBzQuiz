<?php
require_once('../../config.php');
require_once('loggedin.php');
include('header.php');

/* Define all custom functions below
*/
function CheckTestAuthorization($temp_testID,$temp_stuID,$temp_dbinfo) {
	/*Write SQL query. Check student_test_status where testid=?,stuid=?,is_enabled=1 and is_submitted=0
	* If row returned, then authorize access -> return 1, else return 0
	*/
	$CheckAccess = $temp_dbinfo->prepare("SELECT * FROM student_test_status WHERE testid=? AND stuid=? AND is_enabled=? AND is_submitted=?");
	$CheckAccess->execute(array($temp_testID,$temp_stuID,1,0));
	$Result_CheckAccess=$CheckAccess->fetch(PDO::FETCH_ASSOC);
	if($Result_CheckAccess) {
	 return 1;
	}
	else {
	 return 0;
	}
}
?>
<style type="text/css">
.btn-sm {width:100%;}
</style>


<script type="text/javascript">
$(document).ready(function (){
  $(".btn.btn-default.btn-sm.fetch_question").click(function(event){
    
    var spinner = $("<img src='../../img/ajax-loader-green-small.gif' alt='Loading..' />").insertAfter(this);
    var form_data = $(this).closest("form").serialize();
    //var formAction = $(this).attr("formaction");
    //alert(form_data);
    $.ajax({
  url: "fetch_question.php",
  type: "GET",
  data: form_data,
  success: function(data) 
        {
      $(document)
          .ajaxStart(function() {
              //$loading.show();
            })
          .ajaxStop(function() {
         spinner.remove();
         //console.log(data);
          });
          $("#main_question_div").load("fetch_question.php?"+form_data);
        }  
      });
      event.preventDefault(); //STOP default action
      event.unbind(); //unbind. to stop multiple form submit.
      return false;
    });
});
</script>

    <div class="container">
    	<?php 
		if(checkIfStuLoggedIn($_SESSION['LoggedIn'],$_SESSION['stuname'])==1) //Check if logged in or not
		{ 
			if(isset($_POST['test_ID']) && !empty($_POST['test_ID']) && isset($_POST['stu_ID']) && !empty($_POST['stu_ID'])) { //Now check for values in test ID
				$POST_testID = $_POST['test_ID'];
				$POST_stuID = $_SESSION['stuID'];
				if((CheckTestAuthorization($POST_testID,$POST_stuID,$dbinfo))===1) { //Can give test now! Authorized access to the test.
          //Now fetch questions list
          $fetch_questions_list = $dbinfo->prepare("SELECT * from question_bank WHERE testid=? ORDER BY RAND()");
          $fetch_questions_list->execute(array($POST_testID));
          $fetch_result_list = $fetch_questions_list->fetchAll();
          if($fetch_result_list) {
		      ?>
      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Open Questions List</button>
          </p>
          <div class="jumbotron">
            <div id="main_question_div">
            <p>Select question from right panel -></p>
            </div>
          </div>
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group" style="overflow-y:scroll;height:500px;">
            <?php
            $i=0;
            foreach($fetch_result_list as $question_list) { 
            $i++; ?>
          	<form><input type="hidden" name="ques_ID" value="<?php echo $question_list['quesid']; ?>"><input name="test_ID" type="hidden" value="<?php echo $POST_testID; ?>"><button type="submit" class="btn btn-default btn-sm fetch_question"><?php echo "Q.) ".$i; ?></button></form>
            <?php }?>
          </div>
        </div><!--/span-->
      </div><!--/row-->
      <?php 
          }
          else {
            echo "Something is wrong. Unable to fetch questions list. Contact Administrator.";
          }
				}
				else {
					echo "<p class=\"jumbotron\" style=\"text-align:center;\">You are not authorized to give this test yet! Please make sure you have enrolled for it and the concerned faculty has accepted enrollment request.</p>";
				}
      		}
      		else {
      			echo "<p>Test not found. Something went wrong. << <a href=\"../index.php\">Go back</a>.</p>";
      		}
		}
		else
		{
			echo "<p><b>You are currently not logged in. You will have to <a href=\"index.php\">login</a> to access this page.</b></p>"; 
		}
		?>
      <hr>
<?php
include('footer.php');
?>