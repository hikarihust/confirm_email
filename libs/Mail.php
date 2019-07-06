<?php 
include PATH_LIBS . "PHPMailer/PHPMailer.php";
include PATH_LIBS . "PHPMailer/Exception.php";
include PATH_LIBS . "PHPMailer/OAuth.php";
include PATH_LIBS . "PHPMailer/POP3.php";
include PATH_LIBS . "PHPMailer/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {
    public static function sendMail($email, $name, $link){
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'quangtestvn@gmail.com';                 // SMTP username
            $mail->Password = 'Vudinhquang2202';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            // fix bug PHPMailer: SMTP Error: Could not connect to SMTP host
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            //Recipients
            $mail->setFrom('quangtestvn@gmail.com', 'Email Confirm');
        
            $mail->addAddress($email, $name);     // Add a recipient

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Confirm Login';
            $mail->Body    = 'Link login: <a href="'. $link.'">click me!!</a>';

            $mail->send();
           
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}