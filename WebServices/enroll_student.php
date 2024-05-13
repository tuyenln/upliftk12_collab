	<?php
					/*
					require_once('con.php');*/

					extract($_REQUEST);

					$ar=(explode('C',$courseID));
					require_once('cur-moodlel.php');
					$curl = new curl;
					$restformat = 'json'; 
					$domainname = 'https://upliftk12.com/assessments';
					$tokenenrol_users="388eb23ecf831b5a120afea2eccda465";
					$functionnametokenenrol_users = 'enrol_manual_enrol_users';

					$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $tokenenrol_users . '&wsfunction='.$functionnametokenenrol_users;
					$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';

					for($i=0; $i <count($ar); $i++)
					{

							$cid=$ar[$i];
							$enrolment = new stdClass();
							/* Enrol student*/
							$enrolment->roleid = 5; //estudante(student) -> 5; moderador(teacher) -> 4; professor(editingteacher) -> 3;
							$enrolment->userid = $stID; //$userID;
							$enrolment->courseid = $cid; 
							$enrolments = array( $enrolment);
							$params = array('enrolments' => $enrolments);
							$respEn = $curl->post($serverurl . $restformat, $params);
							var_dump($respEn);
						}
?>