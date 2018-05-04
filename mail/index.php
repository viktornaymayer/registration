<?php


// пример использования
require_once "SendMailSmtpClass.php"; // подключаем класс

$mailSMTP = new SendMailSmtpClass('naymayergroup@gmail.com', '8sQU64A0FD00X4VS', 'ssl://smtp.gmail.com', 'Naymayer Group', 465); // создаем экземпляр класса
// $mailSMTP = new SendMailSmtpClass('логин', 'пароль', 'хост', 'имя отправителя');

// заголовок письма
$headers= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
$headers .= "From: Naymayer Group <naymayergroup@gmail.com>\r\n"; // от кого письмо
$result =  $mailSMTP->send('viktornaymayer@gmail.com', 'Подтверждение почты', 'Спасибо за регистрацию!<br><br><a href="https://naymayer.ru">Перейдите по ссылке для завершения регистрации</a>', $headers); // отправляем письмо
// $result =  $mailSMTP->send('Кому письмо', 'Тема письма', 'Текст письма', 'Заголовки письма');
if($result === true){
    echo "Письмо успешно отправлено";
}else{
    echo "Письмо не отправлено. Ошибка: " . $result;
}
