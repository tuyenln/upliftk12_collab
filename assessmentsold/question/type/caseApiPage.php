<style type="text/css">#id_md_case{ width: 228px;}</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
             $("#id_md_case").children('option:gt(0)').hide();

             $("#id_md_level").change(function() {
                 $("#id_md_case").children('option').hide();
                 $("#id_md_case").children("option[value^=" + $(this).val() + "]").show();
             });

            $("#id_md_case").children("option[value^=" + $('#id_md_level').val() + "]").show();

         });
</script>

<?php
/*this is custom file get list of case*/
ini_set('max_execution_time', 600); //300 seconds = 5 minutes
$caseArray=[];
$levelArray['-m']= 'Please Select Level';
$caseArray['-m']= 'Please Select Case';
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://teks-api.texasgateway.org/ims/case/v1p0/CFPackages/bc997e24-7f3b-5df0-a0cd-3a8ac9cf0e2e",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer dXBsaWZ0azEyLmNvbTpSbS1pcj9LV2FBd2xT",
    "Content-Type: text/plain"
  ),
));


$response = curl_exec($curl);
curl_close($curl);
$row=json_decode($response,true);

foreach ($row['CFItems'] as $key => $value) {

  if($value['CFItemType'] =="Student Expectation")
  {

    $level=str_replace(",","",$value['educationLevel']);
    $levelStr= substr($level,0,2);
    $caseArray[$levelStr.'|'.$value['identifier']]= $value['humanCodingScheme'];
    $levelArray[$levelStr]= $value['educationLevel'];


  }
}
?>