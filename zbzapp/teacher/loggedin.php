<?php
require_once('../config.php');



function checkIfLoggedIn($x,$y)
{
            if(!empty($x) && !empty($y))
            {
		return 1; //Logged In
            //return "<p><a class=\"button\" href=\"chklogout.php\">Log out!</a></p>";
            }
            else
             	{
		return 0; //Not logged In
            }
}
?>
