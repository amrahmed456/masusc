<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'includes/phpMailer/Exception.php';
require 'includes/phpMailer/PHPMailer.php';
require 'includes/phpMailer/SMTP.php';

function sendEmail($emailList , $subject , $mssgName , $content){
	if(count($emailList) >= 1 ){
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->SMTPDebug = 1;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'mail.aba.ae';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'support@talebshaqa.com';                     // SMTP username
			$mail->Password   = 'TryB4Die';                               // SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			$mail->Port       = 587;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom('support@talebshaqa.com ', $mssgName);
			for($i = 0 ; $i < count($emailList) ; $i++){
				$mail->addAddress($emailList[$i]);     // Add a recipient
			}
			
			$mail->addReplyTo('support@talebshaqa.com', 'Material Advantage SUSC');

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = '
				<div style="margin:auto;border:1px solid #EEE;padding:15px 7px;border-radius:3px;background-color:#FFF">' . $content . 
				'</div>';
			$mail->AltBody = $content;

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}
