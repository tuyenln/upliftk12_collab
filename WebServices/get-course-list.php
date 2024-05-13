<?php
extract($_REQUEST);
$slect='';
///Get category course list
$token = 'c65c8943e45b6579f601f3ebdf698083';
$domainname = "https://upliftk12.com/assessments";
$functionname = 'core_course_get_courses_by_field';
require_once('cur-moodlel.php');
$curl = new curl;
$restformat = 'json'; 

$params = array('field'=>'category','value'=>$category);

//print_r($params);
$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';

$resp = $curl->post($serverurl . $restformat, $params);

$responsCourse = json_decode($resp,true);
//print_r($responsCourse);

if($lvl > 0 ){

?>

<?php
foreach ($responsCourse['courses'] as  $row) {
	if($row['id']==$lvl){

		$slect="selected";
	}
	else{

		$slect=" ";
	}
	?>
<option value="<?php echo $row['id'];?>" <?= $slect?>> <?php echo $row['fullname'];?></option>

<?php
}
}
else{

foreach ($responsCourse['courses'] as  $row) {?>
<option value="<?php echo $row['id'];?>"> <?php echo $row['fullname'];?></option>

<?php
}


}
?>