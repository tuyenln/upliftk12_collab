<?php
   
    require_once('conn.php');
    require_once('cur-moodlel.php');
    $curl = new curl;
    $restformat = 'json'; 
    $domainname = 'https://upliftk12.com/assessments';
    $tokenUserCreate = 'e326f6ab8011bc62e04176a1a9b7c0ff';
    $functionnameUserCreate = 'core_user_create_users';
    //categoryid
    $userDetails = new stdClass();
    $ppas   =    'studentUP@12';
    
            $userDetails->username              =       $username;
            $userDetails->password              =       $ppas;
            $userDetails->firstname             =       $name;
            $userDetails->lastname              =       $mname.''.$lname;
            $userDetails->email                 =       $email;
            $userDetails->auth                  =       'manual';
            $userDetails->idnumber              =       $student_id;
            $users = array($userDetails);
            $params = array('users' => $users);
            /* create Account In Moodle*/
            $serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $tokenUserCreate . '&wsfunction='.$functionnameUserCreate;
            $restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
            $resp = $curl->post($serverurl . $restformat, $params);
            $respons        = json_decode($resp,true); 

          //  print_r($respons);

            $userID         =    $respons[0]['id'];
            $username       =    $respons[0]['username'];
            $PassWord       =   $ppas;
            if($userID > 0 )
            {


                    //$username =base64_encode($username);
                    $pass  =   base64_encode($PassWord);
                    $str= "INSERT INTO `mdl_UserDetails` SET
                    `username`='".$username."',
                    `mdl_UserID`='".$userID."',
                    `student_id`='".$student_id."',
                    `password`='".$pass."'";

                    mysqli_query($con, $str);
                    $up="UPDATE `users` SET `mdl_UserID`='".$userID."' WHERE `id`=".$student_id;
                    mysqli_query($con, $up);
            /*
            $TeluserName =base64_encode($username);
            $TelPas  =   base64_encode($PassWord);

            $url= "https://ellpractice.com/intervene/moodle/LoneetelpasLoginByStu.php?username=".$TeluserName."&password=".$TelPas."&uiId=".$_SESSION['student_id'];

                header("location:".$url);
                */
        }


        
?>