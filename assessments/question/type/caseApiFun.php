<?php

/*this data base details.*/
$servername   = 'localhost';
$dbname    	 = "assessmentdb";
$username    = "phpmyadmin";
$password    = "@Upliftk%success96#$$#";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


$arr=[];

function _insertCase($arr){
	global $db;
	$sql = "INSERT INTO `mdl_case_tbl` SET `question_id`='".$arr['question_id']."',`case_data`='".$arr['case_data']."',`case_level`='".$arr['case_level']."'";
	$result = $db->query($sql);

}


function _updateCase($arr){
	global $db;
	$sql = "UPDATE `mdl_case_tbl` SET `case_data`='".$arr['case_data']."',`case_level`='".$arr['case_level']."' WHERE `question_id`='".$arr['question_id']."'";
	$result = $db->query($sql);

}


function _selectCase($question_id){
	
	global $db,$mform;
	$sql = "SELECT case_data FROM `mdl_case_tbl` WHERE   `question_id`='".$question_id."'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	return $row['case_data'];
}

function _selectLevel($question_id){
	
	global $db,$mform;
	$sql = "SELECT case_level FROM `mdl_case_tbl` WHERE   `question_id`='".$question_id."'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	return $row['case_level'];
}


function _insertDistractor($arr,$qid){

	global $db;

	$arr=implode(',',$arr);
	$sql = "INSERT INTO `dstractors_answer` SET `question_id`='".$qid."',`dstractors_id`='".$arr."'";
	$result = $db->query($sql);

}

function _updateDistractor($arr,$qid){

	global $db;
	$arr=implode(',',$arr);
	$sql = "UPDATE `dstractors_answer` SET `dstractors_id`='".$arr."' WHERE `question_id`='".$qid."'";
	$result = $db->query($sql);

}
?>