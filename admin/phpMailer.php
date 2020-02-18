<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'includes/phpMailer/Exception.php';
require 'includes/phpMailer/PHPMailer.php';
require 'includes/phpMailer/SMTP.php';

function sendEmail($emailList ,$subject, $content){
	
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->SMTPDebug = 0;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'mail.aba.ae';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'masusc@masusc.com';                     // SMTP username
			$mail->Password   = 'Masusc20192020';                               // SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			$mail->Port       = 587;                                    // TCP port to connect to
			$mail->SMTPOptions = array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
			);
			//Recipients
			$mail->setFrom('masusc@masusc.com', $subject);
			for($i = 0 ; $i < count($emailList) ; $i++){
				$mail->addAddress($emailList[$i]);     // Add a recipient
			}
			
			$mail->addReplyTo('masusc@masusc.com', 'Material Advantage SUSC');

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $subject;
			
			$mail->Body    = $content;
			/*$mail->AddEmbeddedImage('src' , 'id');*/
			$mail->AltBody = $content;

			$mail->send();
		
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	
}
