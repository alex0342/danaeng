<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';


// Содержание полей формы которую отправил посетитель сайта

    
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$textarea = $_POST['textarea'];

// Формирование самого письма
$title = "Новая заявка";
$body = "
<h2>Новое письмо</h2>
<b>Имя:</b> $name<br>
<b>Имя:</b> $phone<br>
<b>Почта:</b> $email<br><br>
<b>Сообщение:</b><br>$textarea
";
   

// Вложенные в форму файлы будут обработаны ниже

  //  $mail = new PHPMailer;  // Создаем экземпляр мейлера почты

	
    $mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'karavaev.1993@mail.ru'; // Логин на почте
    $mail->Password   = 'h8b1m1rU'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('karavaev.1993@mail.ru', 'Имя отправителя'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('karavaev.1993@mail.ru');  
   

   

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);
   
 