<?php
    
	function sendEmail ($email, $nome, $subject, $message){ //isso é uma fncao
		require_once("class.phpmailer.php");
		require_once("class.smtp.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0; 
		$mail->SMTPAuth = true;	
		$mail->SMTPSecure = 'ssl';
		$mail->Host = 'smtp.gmail.com'; 
		$mail->Port = 465;
		$mail->SMTPAuth = true; 
		$mail->Username = 'ecoringscti@gmail.com';//Configurar pelo link https://support.google.com/accounts/answer/6010255?hl=pt-BR 
		$mail->Password = 'ecoringsanual'; //senha smtp
		$mail->SetFrom('ecorings@gmail.com','EcoRings'); 
		$mail->AddAddress("$email","$nome"); //Muda Aqui para as variaveis que vem do SELECT
		$mail->IsHTML(true); 
		$mail->CharSet = 'utf-8'; 
		$mail->Subject  = $subject; // Assunto da mensagem
		$mail->Body .= $message;
		$enviado = $mail->Send();
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();
		if (!$enviado) 
		{
			throw new Exception("Erro no envio do email de confirmação!");
       		exit;
		} 
	}
?>