<?php
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\PHPMailer;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('uk', 'phpmailer/language/');
	$mail->IsHTML(true);

	$mail->isSMTP();                                   //Send using SMTP
	$mail->Host       = 'hosting33.ukrnames.com';      //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                          //Enable SMTP authentication
	$mail->Username   = 'armad23';                     //SMTP username
	$mail->Password   = '9I8sr4V3dQrE';                //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   //Enable implicit TLS encryption
	$mail->Port       = 465;                 

	//Від кого лист
	$mail->setFrom('armad23@arma-doors.com.ua', 'Лист від потенційного замовника'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('armad23@arma-doors.com.ua'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'Вітаю! Хочу двері!';

	//Тіло листа

	$body = '<h1>Це тестове повідомлення!Хочу дізнатись як виглядає лист на вашій пошті.Відправте будь-ласка скрін Андрію.Дякую!</h1>';

	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Замовник:</strong> '.$_POST['name'].'</p>';
	}

	if(trim(!empty($_POST['tel']))){
		$body.='<p><strong>Телефон:</strong> '.$_POST['tel'].'</p>';
	}

	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>Електронна пошта:</strong> '.$_POST['email'].'</p>';
	}
	
	/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Помилка2';
	} else {
		$message = 'Дані надіслані!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>