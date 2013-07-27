<?php
/*File containing database server connection info. 
$db_connect is the variable created. So use it directly.*/
define('HOSTNAME','localhost'); //Change DB server hostname
define('DBNAME','my_db'); //Change DB NAME
define('USERNAME','test_code'); //Change Username
define('PASSWORD','test_code'); //Change Password
try {
$db_connect = new PDO('mysql:host=HOSTNAME;dbname=DBNAME;charset=utf8','USERNAME','PASSWORD');
}
catch(PDOException $ex){
		echo "Error in connection configuration";	
	}
?>