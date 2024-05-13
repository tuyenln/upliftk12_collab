<?php
$token = 'e7821da93cbd6a29cba1b8a4f937af1e';
$domainname = "https://upliftk12.com/assessments";
$functionname = 'core_course_get_categories';
require_once('cur-moodlel.php');
$curl = new curl;
$restformat = 'json'; 

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';

$resp = $curl->post($serverurl . $restformat, '');

$array = json_decode($resp,true);


$options = get_options($array);
echo '<option value="0">--None--</option>';
foreach($options as $key => $val) {
    echo "<option value='".substr($key,1)."'>".$val."</option>";
  }

 function get_options($array, $parent=0, $indent="") {
    $return = array();
    foreach($array as $key => $val) {
      if($val["parent"] == $parent) {
        $return["x".$val["id"]] = $indent.$val["name"];
        $return = array_merge($return, get_options($array, $val["id"], $indent."&nbsp;&nbsp;&nbsp;"));
      }
    }
    return $return;
  }
?>