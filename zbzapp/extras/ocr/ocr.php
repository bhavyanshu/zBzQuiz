<?
/*
Author : Bhavyanshu Parasher
Email : bhavyanshu@codershangout.org
This will be an interface for the OCR functions.
*/
//exec("python tesseract.py 2.png",$output);
//var_dump($output);
ini_set('display_errors', true);
error_reporting(E_ALL);
?>
<?php
$scandocpath = "2.png";
$output = shell_exec('./tesseract.py 2.png');
//print_r($output); For Command Line testing

$descriptorspec = array(
0 => array("pipe","r"),
1 => array("pipe","w"),
2 => array("file","./tmp/error.log","a")
) ;
// define current working directory where files would be stored
$cwd = './' ;
// open process reprint.pl and pass it an argument
$process = proc_open('./tesseract.py 2.png', $descriptorspec, $pipes, $cwd) ;
echo exec('whoami');

//$argv1 doing nothing here its just for the example
if (is_resource($process)) {// print pipe output
echo stream_get_contents($pipes[1]) ;// close pipe
fclose($pipes[1]) ;
// close process

proc_close($process) ;}
?>