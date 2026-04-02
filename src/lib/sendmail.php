<?PHP

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../composer/vendor/phpmailer/phpmailer/src/Exception.php';
require '../../composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../composer/vendor/phpmailer/phpmailer/src/SMTP.php';

function send_mail($to, $assunto, $msg, $anexo, $from = 'reports@correamte.com.br'){	

	$mail = new PHPMailer;

	#Enable verbose debug output
	//$mail->SMTPDebug = 3;                            

	#Set mailer to use SMTP
	$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
	);
	$mail->isSMTP();                                      
	$mail->Host = 'smtp.gmail.com';  
	$mail->SMTPAuth = true;                              
	$mail->Username = 'mailer.correa@gmail.com';                
	$mail->Password = 'c0rrE@.mat';                          
	$mail->SMTPSecure = 'ssl';                            
	$mail->Port = 465;                                    
	$mail->SMTPDebug  = 0; 		

	$mail->setFrom($from);
	
	$to = explode(';', $to);
    if( is_array($to) ){
		foreach($to as $emailto){
			$mail->AddCC($emailto, 'no-reply');
		}
	}
	else $mail->addAddress($to, $to);   

	if( is_array($anexo) )
	{
		foreach ($anexo as $item)
			$mail->addAttachment($item);     
	}
	else $mail->addAttachment($anexo);
	
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $assunto;
	$mail->Body    = $msg;
	// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {		
		echo 'Erro ao enviar o email ' . $mail->ErrorInfo;
	} else {
		echo 'Email enviado com sucesso.';
	}
}


?>