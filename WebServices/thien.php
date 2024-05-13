<?php
extract($_REQUEST);
$slect='';
///Get category course list
$token = '38ab2831e0f19bc018a3a8a645ce4389';
$domainname = "https://upliftk12.com/assessments";
$functionname = 'mod_quiz_get_quizzes_by_courses';
require_once('cur-moodlel.php');
$curl = new curl;
$restformat = 'json'; 

$params = array('courseids'=> [3]);

//print_r($params);
$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';

$resp = $curl->post($serverurl . $restformat, $params);

$responsCourse = json_decode($resp,true);
// print_r($responsCourse);
echo json_encode($resp);

?>