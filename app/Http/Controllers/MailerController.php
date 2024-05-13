<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use View;

class MailerController extends Controller
{

    public function composeEmail($to,$subject,$view, Array $data) {
        //dd($data); exit;
        require base_path("vendor/autoload.php");
        require 'vendor/autoload.php';
        // $mail = new PHPMailer(true);
        $mail = new \PHPMailer\PHPMailer\PHPMailer();
       try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'teach@upliftk12.com';
            $mail->Password = 'Qetuo13579!@#$%';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('teach@upliftk12.com', 'Uplift K12');
            $mail->addAddress($to);
            //$mail->addCC($request->emailCc);
            //$mail->addBCC($request->emailBcc);

            //$mail->addReplyTo('sender-reply-email', 'sender-reply-name');

            if(isset($_FILES['emailAttachments'])) {
                for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                }
            }


            $mail->isHTML(true);

            $mail->Subject = $subject;//$request->emailSubject;
            $mail->Body    = View::make($view)->with('data',$data);//$request->emailBody;

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                return  false;
            }

            else {
                return true;
            }

        } catch (Exception $e) {
            return false;
        }
    }
}
