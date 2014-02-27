<?php
require_once('../config.php');
$titleset="Student Login";
include('header.php');
?>
<!--========================================================================== Content Part 1 =====================================================================================-->
<style>
.ui-autocomplete-loading {
	background: red url('../img/loading_28.gif') right center no-repeat;
}
.ui-helper-hidden-accessible {

}
#ui-id-1 {

	background-color: #eaf678;
	border-width: 1px;
	border-style: solid;
	border-right: 1px solid rgb(204, 204, 204);
	border-color: rgb(217, 217, 217) rgb(204, 204, 204) rgb(204, 204, 204);
	-moz-border-top-colors: none;
	-moz-border-right-colors: none;
	-moz-border-bottom-colors: none;
	-moz-border-left-colors: none;
	border-image: none;
	box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
	cursor: default;
} 
.search_btn {
	display:none;
}
</style>
<script type="text/javascript">
$(function() {
        /*function log( message ) {
            $( "<div>" ).text( message ).prependTo( "#search_course_student" );
            $( "#search_course_student" ).scrollTop( 0 );
            */

            $( "#search_course_student" ).autocomplete({
            	autoFocus: true,
            	source: "../search_func/search_course.php",
            	minLength: 2,
            	response: function(event, ui) {
            // ui.content is the array that's about to be sent to the response callback.
            if (ui.content.length === 0) {
            	$("#empty-message").text("No results found. Try again!");
            } else {
            	$("#empty-message").empty();
            }
        },
        select: function( event, ui ) {

        	$( "#search_course_student" ).val( ui.item.value );

        	$('a').attr('href',"viewcourse.php?corID=" + ui.item.aid );         
        	$('#courseID_set').attr('value',ui.item.aid );
        	return false;
        }
    })
            .data( "autocomplete" )._renderItem = function( ul, item ) {
            	return $( "<li>" )
            	.data( "item.autocomplete", item )
                //.append( "<a>" + "<img width=50px height=50px src='" + item.icon + "' />" +"  "+ item.value+ "</a>" )
                .append("<a>"+item.value+"</a>")
                .appendTo( ul );
            };
        });
</script>


<div class="wrapper">
	<div class="grids">
		<h2>Welcome to zBzQuiz Web App Interface</h2>
		<div class="grid-6 grid grey">
			<br>
<?php 
 if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['stuname'])) //stuname for student!
 {
 	echo "<h3>Account Status</h3>";
 	if($_SESSION['stulastlogintime']==NULL)
 	{
 		echo "<p>Username: <i><strong>".$_SESSION['stuname']."</strong></i><br> User Email: <i><strong>".$_SESSION['stuemail']."</strong></i><br></p>";  
 	}
 	else
 	{
 		echo "<p>Username: <i><strong>".$_SESSION['stuname']."</strong></i><br> User Email: <i><strong>".$_SESSION['stuemail']."</strong></i><br> Last Session Time: <i><strong>".$_SESSION['stulastlogintime']."</strong></i></p>";
 	}    
 	?>
 	<p><a class="button" href="chklogout.php">Log out!</a></p>
 	<p><a href=""><button class="button green medium">Overall Performance</button></a></p>
 	<p><a href=""><button class="button green medium">Submitted Tests  </button></a></p>
 </div>
 <div class="grid-10">
 	<h3>Search Course</h3>
 	<form name="hongkiat" id="hongkiat-form" method="get" action="viewcourse.php">
 		<input type="hidden" id="courseID_set" name="corID" value="" />
 		<input style="margin:auto;" type="text" id="search_course_student" name="search_course" placeholder="Enter your search keyword here!" value='' tabindex="1" class="txtinput"/>
 		<button type="submit" class="search_btn"><img src="../img/icon_search_32.png" title="Search" /></button>
 		<p id="empty-message"></p>
 	</form>
 	<br>
 	<h4>List of Enrolled Tests</h4>

 	<?php
 	$studentID = $_SESSION['stuID'];
 	$fetch_enabled_tests = $dbinfo->prepare("SELECT * FROM student_test_status WHERE stuid=? AND is_enabled=? AND is_submitted=?");
 	try {
 		$fetch_enabled_tests->execute(array($studentID,1,0));
 		$fetch_results_tests = $fetch_enabled_tests->fetchAll();
 		if($fetch_results_tests) {
 			foreach($fetch_results_tests as $value_tests_results) {
 				$test_ID=$value_tests_results['testid'];
 				$test_name_query = $dbinfo->prepare("SELECT testname FROM course_test_status WHERE testid=?");
 				$test_name_query->execute(array($value_tests_results['testid']));
 				$result_name = $test_name_query->fetchAll();
 				foreach($result_name as $row_name) {
 				?>
 			<div id="enrollment" class="bg-info">
 				You have been enrolled for <?php echo $row_name['testname']; ?> test<br/>
 				<form style="margin-top:10px;" action="quiz/index.php" method="post">
            		<input type="hidden" name="test_ID" value="<?php echo $test_ID; ?>" />
            		<input type="hidden" name="stu_ID" value="<?php echo $studentID; ?>" />
            		<button class="btn btn-success acceptbtn" type="submit">Give Test</button>
            	</form>
            </div>
 				<?php
 				}
 			}
 		}
 		else {
 			echo "<p>You have not been enrolled for any test yet.</p>";
 		}
 	}
 	catch(PDOException $e){
 		echo $e->getMessage();
 	}
 	?>
 	<hr><br>
 </div>
 <?php   
}
else
{
	echo "<p><b>You are currently not logged in!</b></p>"; ?>
	<form name="hongkiat" id="hongkiat-form" method="post" action="chklogin.php">
		<section id="aligned">
			<p>	<input type="text" name="username" id="username" placeholder="Your username" autocomplete="off" tabindex="1" class="txtinput">
				<input type="password" name="password" id="userpass" placeholder="Your password" autocomplete="off" tabindex="2" class="txtinput"></p>
				<section>
					<section id="buttons">
						<p>	<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
							<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Log In">
							<br style="clear:both;"></p>
						</section>
					</form>
					<p>	<a class="button" href="sturegister.php">Sign Up!</a></p>
					<?php
				}
				?>
			</div>
		</div><!--end of grids-->
	</div><!--end of wrapper-->
	<hr />
<?php
include('footer.php');
?>