<?php
require_once('../config.php');
include('password.php');
?>
<div class="grids">
<div class="grid-6 grid grey">

<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['stuname']))
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
     $fetch = $dbinfo->prepare("SELECT * from student_login_zbzxs WHERE stuname=?");
     $fetch->execute(array($_SESSION['stuname']));
     $result=$fetch->fetchALL();
     ?><p><a class="button" href="chklogout.php">Log out!</a></p><?php
}
else 
{
	
	if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']))
						{
						$username = $_POST['username'];
						$options = array('cost' => 11);
    				$password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
    				$email =$_POST['email'];
    				$checkusername = $dbinfo->prepare("SELECT * FROM student_login_zbzxs WHERE stuname = ?");
	 					$checkusername->execute(array($username));
	 					$checkemail = $dbinfo->prepare("SELECT * FROM student_login_zbzxs WHERE stuemail = ?");
	 					$checkemail->execute(array($email));
     					if($checkusername->fetchColumn() > 0)
     					{
     					echo "<h1>Error</h1>";
        			echo "<p>Sorry, that username is taken. Please go back and try again.</p>";
     					}
     					elseif($checkemail->fetchColumn() > 0)
	     				{
	     					echo "<h1>Error</h1>";
        				echo "<p>Sorry, that email address is already in use. Please go back and try again.</p>";
     					}
     					else
     					{
     					$registerquery = $dbinfo->prepare("INSERT INTO student_login_zbzxs (stuname, stupass, stuemail) VALUES(?, ?, ?)");
     					$registerquery->execute(array($username,$password,$email));
        					if($registerquery)
        					{
        					echo "<h1>Success</h1>";
        					echo "<p>Your account was successfully created. Please <a href=\"index.php\">click here to login</a>.</p>";
        					}
        					else
        					{
     							echo "<h1>Error</h1>";
        					echo "<p>Sorry, your registration failed. Please go back and try again.</p>";    
        					}    	
     					}
     				} ?>
     				  <h2>Registration for Students</h2>
    
   <p>Please enter your details below to register.</p>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  name="hongkiat" id="hongkiat-form">
		<p><label for="username"><p>Username:</p></label><input type="text" class="txtinput" name="username" id="username" /><br />
		<label for="password"><p>Password:</p></label><input type="password" class="txtinput" name="password" id="password" /><br />
        <label for="email"><p>Email Address:</p></label><input type="text" class="txtinput" name="email" id="email" /></p>
		<section id="buttons">		
		<p><input type="submit" name="register" id="submitbtn" class="submitbtn" tabindex="7" value="Register" /></p> 
		</section>
	</form>
	
	
<?php  
}
?>	
</div>
</div>      