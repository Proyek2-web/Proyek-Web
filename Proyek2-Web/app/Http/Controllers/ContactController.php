<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    function showContactForm(){
        return view('layouts.contact');
    }

    function sendMail(Request $request){
        
        $subject = "Contact dari " . $request->input('name');
        $name = $request->input('name');
        $emailAddress = $request->input('email');
        $message = $request->input('message');

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            // Pengaturan Server
                                                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;
            $mail->Username = 'irfandevelop81@gmail.com';                 // SMTP username
            $mail->Password = 'developer81';                              // SMTP password
            $mail->SMTPSecure ='tsl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                  // TCP port to connect to

            // Siapa yang mengirim email
            $mail->setFrom( 'irfanharfiansyah84@gmail.com');

            // Siapa yang akan menerima email
            $mail->addAddress('irfanharfiansyah84@gmail.com', 'Irfan Harfiansyah');     // Add a recipient

            // ke siapa akan kita balas emailnya
            $mail->addReplyTo($emailAddress, $name);
            

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();

            $request->session()->flash('status', 'Terima kasih, kami sudah menerima email anda.');
            return view('layouts.contact');

        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

    }
}
