<?php
/*
Base file for database connection information
You only need to modify this file for your personal set up. Refer to README for more instructions.
*/

try
	{
		$dbinfo= new PDO('mysql:host=localhost;dbname=zbzapp_main','test_code','test_code');		
		session_start(); //Started session. No need to call this on other pages.
		date_default_timezone_set('Asia/Calcutta'); //Set for IST. You may modify according to your needs.
	}

catch(PDOException $ex)
	{
		echo "<p>Error in connection configuration. Please check your database configuration file. If you are a usual visitor, please check back later as admin might be fixing the issue.</p>";
	}

?>
