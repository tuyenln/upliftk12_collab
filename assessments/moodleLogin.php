<?php 
//session_start();
require('config.php');
extract($_REQUEST);
$username=base64_decode($u);;
$password=base64_decode($p);

if($username)
{
	$dashboard 	= $CFG->wwwroot;
	$name 		= $username;
	$password	= $password;
	$id = $_REQUEST['id'];
	$user = authenticate_user_login($name ,$password);
	if ($user) {

			$ret= complete_user_login($user);
			$idnumber= base64_encode($ret->idnumber);
			$urltogo = $CFG->wwwroot . '/';
			$name=$ret->firstname;
			$urltogo="https://upliftk12.com/test/test.php?id=".$id."&n=".base64_encode($name);
			redirect($urltogo);

         }

  } 


  ?>