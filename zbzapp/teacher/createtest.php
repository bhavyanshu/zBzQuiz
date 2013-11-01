<?php
   require_once('../config.php');
   require_once('loggedin.php');
   $titleset="Create New Test";
   include('header.php');
   ?>

<div class="wrapper">
   <div class="grids">
      <h2>Welcome to zBzQuiz Web App Interface</h2>
      <div class="grid-6 grid grey">
          <?php 
           if(checkIfLoggedIn($_SESSION['LoggedIn'],$_SESSION['uname'])=="1")
	{
?>
      </div>
      <div class="grid-10">
	<?php $fetchCourseID=$_GET['corID']; ?>
         <h3>You are creating new test for <?php echo "Course ID : ".$fetchCourseID; ?></h3>
         <form name="test" class="testreg" id="hongkiat-form" method="post" action="test_create_func.php?courseid=<?php echo $fetchCourseID; ?>">
            <label>Test Name</label>
            <input type="text" id="testname" class="txtinput" placeholder="eg, java_test_1" name="testname" />
            <label>Test Description</label>
            <textarea row="2" columns="2" id="testdesc" placeholder="What is it about?" class="txtinput" name="testdesc"></textarea>
            <label>Test Duration</label>
            <input type="text" id="testduration" placeholder="The Time should only be in minutes." class="txtinput" name="testduration" />
            <section id="buttons">	
               <input type="submit" id="submitbtn" class="submitbtn" name="createtest" value="Create" />
            </section>
         </form>
         <br/>	
         <br/>
         <?php
            ?>
         <br/>
<?php 
}
else
{
echo "<p><b>You are currently not logged in. You will have to <a href=\"index.php\">login</a> to access this page.</b></p>"; 
}

?>
      </div>
   </div>
   <!--end of grids-->
</div>
<!--end of wrapper-->
<hr />
<?php
   include('footer.php');
   ?>
