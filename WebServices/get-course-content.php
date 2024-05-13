<?php
	extract($_REQUEST);
	$ar=(explode('C',$courseID));
	$res=[];


	require_once'conn.php';
	$sql = "SELECT username,password FROM `mdl_UserDetails` WHERE `student_id`=".$stID;
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);



	/*API*/
	$token = '38ab2831e0f19bc018a3a8a645ce4389';
	$domainname = 'https://upliftk12.com/assessments';
	$functionname = 'core_course_get_contents';
	require_once('cur-moodlel.php');

	$curl = new curl;
	$restformat = 'json'; 
	$params = array('courseid' =>$courseID);
	$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
	$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';



if($action=='quiz')
{

		for($i=0; $i <count($ar); $i++)
		{

			$cid=$ar[$i];
			$params = array('courseid'=>$cid);
			$resp = $curl->post($serverurl . $restformat, $params);
			$respons = json_decode($resp,true);
			$res['course_'.$cid]=$respons;

		}
			/*display list*/
		foreach ($res as  $parent) 
		{
			foreach ($parent as  $sub) 
			{
				foreach ($sub['modules'] as $value)
				{
					?>
					 <div class="col-sm-6">
                        <ul id="progress">

						<li><div class="node"><i class="fa fa-calculator"></i></div><p>Math - <?php echo $value['name']?><span class="badge orange">Start</span></p></li>
						<li><div class="divider grey"></div></li>
						<li><div class="node orange"></div><p><a data-id="<?php echo $value['id'];?>" href="https://upliftk12.com/assessments/moodleLogin.php?id=<?php echo base64_encode($value['id'])?>&u=<?php echo base64_encode($row['username'])?>&p=<?php echo $row['password']?>">Take a Placement Test</a></p></li>
						<li><div class="divider grey"></div></li>
						<li><div class="node orange"></div><p>Progress Motitor</p></li>
						<li><div class="divider grey"></div></li>
						<li><div class="node orange"></div><p>Grown Test</p></li>
						</ul>
                      </div>
				<?php
				}
			}

		}

}
else
{

	$resp = $curl->post($serverurl . $restformat, $params);
	$respons = json_decode($resp,true);
	foreach ($respons as  $subaaray)
	{
		foreach ($subaaray['modules'] as $value)
		{?>

			<li> 
			<h5 class="sectionname"><?php echo $value['name']?></h5>
			<div class="mod-indent-outer">
			<div class="activityinstance">
			<a class="heading" href="#">
			<span>
			<img src="<?php echo $value['modicon']?>" alt="" role="presentation" aria-hidden="true"></span>
			<span class="instancename"><?php echo $value['name']?><span class="accesshide "> <?php echo $value['modname']?></span></span></a>
			</div>
			</div>
			</li>
<?php
		}


	}  
}
?>