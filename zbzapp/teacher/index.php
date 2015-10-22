<?php
   require_once('../config.php');
   $titleset="Teacher's login";
   include('header.php');
   ?>

<script>
   // Keep all submit buttons from working
   $('.more_button').live('click', function () {
      return false;
   });

   // After everything loads, remove the restriction
   $(window).load(function(){
       $('.more_button').die();
   });
</script>

   <script type="text/javascript">
  $(document).ready(function (){

   $(".btn.btn-primary.acceptbtn").click(function(event){
      
      var spinner = $("<img src='../img/ajax-loader-green-small.gif' alt='Loading..' />").insertAfter(this);
       var form_data = $(this).closest("form").serialize();
       //var formAction = $(this).attr("formaction");
       //alert(form_data);
       $.ajax({
      url: "enroll_student.php",
      type: "POST",
      data: form_data,
      success: function() 
             {
            $(document)
               .ajaxStart(function() {
                  //$loading.show();
                  })
                .ajaxStop(function() {
                spinner.remove();
                location.reload();
                });
             }
          });
         event.preventDefault(); //STOP default action
         event.unbind(); //unbind. to stop multiple form submit.
          return false;
        });

     /*$('.more_button').click(function(event)
      {
         var spinner = $("<img src='../img/ajax-loader-green-small.gif' alt='Loading..' />").insertAfter(this);
         var getId = $(this).attr("id");
         if(getId)
         {
            $("#load_more_"+getId).html('<img src="../img/ajax-loader.gif" style="padding:10px 0 0 100px;"/>'); 
            $.ajax({
               type: "POST",
               url: "fetch_enrollment_requests.php",
               data: "getLastContentId="+ getId,
               cache: false,
               success: function(html){
                  $(document)
                  .ajaxStart(function() {
                  //$loading.show();
                  })
                .ajaxStop(function() {
                  spinner.remove();
                  });
                  $("ul#load_more_ctnt").append(html);
                  $("#load_more_"+getId).remove();
               }
            });
         }
         else
         {
            $(".more_tab").html('End');
         }
         event.preventDefault(); //STOP default action
         return false;
      });*/
   });
   </script>

<!--========================================================================== Content Part 1 =====================================================================================-->
<div class="wrapper">
   <div class="grids">
      <h2>Welcome to zBzQuiz Web App Interface</h2>
      <div class="grid-6 grid grey">
         <h5>Teacher's Login</h5>
         <br>
         <?php 
            if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['uname']))
            {
            	echo "<h3>Account Status</h3>";
            	  if($_SESSION['ulastlogintime']==NULL)
            	{
                echo "<p>Username: <i><strong>".$_SESSION['uname']."</strong></i><br> User Email: <i><strong>".$_SESSION['uemail']."</strong></i><br></p>";  
               }
               else
               {
               	echo "<p>Username: <i><strong>".$_SESSION['uname']."</strong></i><br> User Email: <i><strong>".$_SESSION['uemail']."</strong></i><br> Last Session Time: <i><strong>".$_SESSION['ulastlogintime']."</strong></i></p>";
               }    
            ?>
         <p><a class="btn btn-danger" href="chklogout.php">Log out!</a></p>
         <h3>What would you like to do?</h3>
         <p><a href="coursemgr.php"> <button class="btn-full btn btn-primary">Manage Courses</button></a></p>
         <p><a href="coursemgr.php"> <button class="btn-full btn btn-primary">Analyze Test</button></a></p>
      </div>
      <div class="grid-10">
         <h3>Enrollment Requests</h3>
         <div class='main_div' style="height: 600px; overflow-y: scroll;">
         <ul class="load_content" id="load_more_ctnt">
         
        <?php 
        //$i=0;
         $generate_testid = $dbinfo->prepare("SELECT teacher_course_status.uid, course_test_status.testid FROM teacher_course_status LEFT JOIN course_test_status ON teacher_course_status.courseid = course_test_status.courseid WHERE teacher_course_status.uid=? ORDER BY testid DESC");
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
            <?php echo ucfirst($row_getData['stuname']);?> has requested enrollment for <?php echo ucfirst($row_getData['testname']);?> test
            <form style="margin-top:10px;">
               <input type="hidden" name="test_ID" value="<?php echo $_testid; ?>" />
               <input type="hidden" name="stu_ID" value="<?php echo $_stuid; ?>" />
               <button class="btn btn-primary acceptbtn" type="submit">Accept</button>
            </form>
            </div>
  <?php }
    }
    //echo "End of the list";
    ?>
    </ul>
   <!--<div class="more_div">
        <div id="load_more_<?php echo $id; ?>" class="more_tab">
        <button class="btn btn-primary btn-sm"><div class="more_button" id="<?php echo $id; ?>">Fetch New Requests</div></button>
      </div> 
    </div> -->
      </div>
      <?php   
         }
         else
          	{
         	echo "<p><b>You are currently not logged in!</b></p>"; ?>
      <h5>Teacher's Login</h5>
      <form name="hongkiat" id="hongkiat-form" method="post" action="chklogin.php">
         <section id="aligned">
         <p>		<input type="text" name="username" id="username" placeholder="Your username" autocomplete="off" tabindex="1" class="txtinput">
            <input type="password" name="password" id="userpass" placeholder="Your password" autocomplete="off" tabindex="2" class="txtinput">
         </p>
         <section>
         <section id="buttons">
            <p>				<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
               <input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Log In">
               <br style="clear:both;">
            </p>
         </section>
      </form>
      <p>	<a class="button" href="tearegister.php">Sign Up!</a></p>
      <?php
         }
         ?>
   </div>
   <!--end of grids-->
</div>
<!--end of wrapper-->
<hr />
<?php
   include('footer.php');
?>