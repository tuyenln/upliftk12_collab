<?php
/*this data base details.*/
$servername   = 'localhost';
$dbname      = "assessmentdb";
$username    = "phpmyadmin";
$password    = "@Upliftk%success96#$$#";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
<?php
$question_id=$_GET['id'];
$sql = "SELECT dstractors_id FROM `dstractors_answer` WHERE   `question_id`='".$question_id."'";

  $result = $db->query($sql);

  $row = $result->fetch_assoc();
  $ar = explode(',', $row['dstractors_id']);

  for($i=0; $i<count($ar); $i++){?>

selectList(<?php echo $i?>,<?php echo $ar[$i];?>);

<?php } ?>

function selectList(cls,value){

var IDval=value;

$('#id_distrcator_'+cls).find('option').each(function(i,e){

if ($(e).val()==IDval) {

var id=$(e).val();

$('#id_distrcator_'+cls).find('option[value='+id+']').attr('selected','selected');
    console.log(id);
} 
});

}

});
</script>