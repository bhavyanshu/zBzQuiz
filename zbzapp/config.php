<?php
/*
Base file for database connection information
Refer to README for more instructions.
*/

/*Change application version number here*/
$_Appversion = "Version 1.0"; //Only to be changed for stable releases.

/* Load configuration file */
$config_file_path = "conf.ini";
$config=checkConfExists($config_file_path);

// get database information and store in variables
$db_hostname = $config['db']['host'];
$db_portnumber = $config['db']['port'];
$db_DBname = $config['db']['dbname'];
$db_username = $config['db']['username'];
$db_password = $config['db']['password'];
$db_build_param = "mysql:host=".$db_hostname.";dbname=".$db_DBname;

//get timezone information
$_timezone = $config['timezone']['continent']."/".$config['timezone']['region'];

try
	{

		//$dbinfo= new PDO('mysql:host=localhost;dbname=zbzapp_main','test_code','test_code');		
		$dbinfo = new PDO($db_build_param,$db_username,$db_password);
		session_start(); //Started session. No need to call this on other pages.
		date_default_timezone_set($_timezone);
	}

catch(PDOException $ex)
	{
		echo $ex->getMessage();
		echo "<p>Error in connection configuration. Please check your database configuration file. If you are a usual visitor, please check back later as admin might be fixing the issue.</p>";
	}


function checkConfExists($file_path) {
	try {
		if(($config_setting = @parse_ini_file($file_path)) === FALSE ) {
			throw new ErrorException('conf.ini file was not found or is placed with different name! Please check the application root folder.', '0003');
		}
		else {
			$config_setting = parse_ini_file($file_path,TRUE);
			return $config_setting;
		}
	}
	catch( ErrorException $e ) {
	echo 'Error found: '.$e->getMessage().' ('.$e->getCode().')';
	die();
	}

}
?>
