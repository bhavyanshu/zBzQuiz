<?php
require_once('../config.php');
$term = trim(strip_tags($_GET['term'])); //Searched term
$searchlike= str_replace(array('+', '%', '_'), array('++', '+%', '+_'), $term);
try{
	$fetch_courses=$dbinfo->prepare("SELECT * FROM teacher_course_status WHERE coursename LIKE ?");
	$fetch_courses->execute(array('%'.$searchlike.'%'));
	$result=$fetch_courses->fetchALL(PDO::FETCH_ASSOC);
//print_r($result); Uncomment to debug
	$array_s_results = array();
	if($result){
		foreach ($result as $qresult) {
			$array_s_results['aid'] = $qresult['courseid'];	
			$array_s_results['value']=$qresult['coursename'];
			$row_set[]=$array_s_results;
		}
	}
	else {
		echo "Error fetching courses!";
	}
	echo json_encode($row_set);
}
catch(PDOException $e){
	echo $e;
}
?>