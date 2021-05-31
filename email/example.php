<?php
	include "email.php"; //Incluindo esse arquivo "email.php", já é possível utilizar a função abaixo, sendEmail()
	try
	{
		$recipient = "thiagocaldas12345@gmail.com";
		$name = "Thiago Caldas";
		$subject = "Teste 1 2 3";
		$msg = "<h1>EcoRings</h1>";
        
		sendEmail($recipient, $name, $subject, $msg);
		
		echo "Email enviado com sucesso para $recipient!";
	} catch(Exception $e){
		echo "\nAlgo deu errado!".$e.getMessage();
	}
?>