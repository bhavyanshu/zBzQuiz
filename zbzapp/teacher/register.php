<?php
require_once('../config.php');
include('password.php');
?>
<div class="grids">
<div class="grid-6 grid grey">

<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['uname']))
	{
		echo "<h5>Account Status</h5>";
     if($_SESSION['ulastlogintime']==NULL)
		{
     echo "<p>Username: <i><strong>".$_SESSION['uname']."</strong></i><br> User Email: <i><strong>".$_SESSION['uemail']."</strong></i><br></p>";  
    }
    else
    {
    	echo "<p>Username: <i><strong>".$_SESSION['uname']."</strong></i><br> User Email: <i><strong>".$_SESSION['uemail']."</strong></i><br> Last Session Time: <i><strong>".$_SESSION['ulastlogintime']."</strong></i></p>";
    	}    
     $fetch = $dbinfo->prepare("SELECT * from teacher_login WHERE uname=?");
     $fetch->execute(array($_SESSION['uname']));
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
    				$checkusername = $dbinfo->prepare("SELECT * FROM teacher_login_zbzxt WHERE uname = ?");
	 					$checkusername->execute(array($username));
	 					$checkemail = $dbinfo->prepare("SELECT * FROM teacher_login_zbzxt WHERE uemail = ?");
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
     					$registerquery = $dbinfo->prepare("INSERT INTO teacher_login_zbzxt (uname, upass, uemail) VALUES(?, ?, ?)");
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
     				  <h2>Registration for teachers</h2>
    
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