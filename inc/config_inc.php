<?php
    const DB_HOST = "localhost";    // Хост
    const DB_LOGIN = "root";        // Логин
    const DB_PASSWORD = "";         // Пароль
    const DB_NAME = "users";        // Имя базы данных

    /* Подключаемся к базе */
    $link = mysqli_connect(DB_HOST,DB_LOGIN,DB_PASSWORD,DB_NAME) or die('WRONG CONNECT WITH DATA BASE !!!');

    $smtp_username = 'naymayergroup@gmail.com';   // Адрес почтового ящика с которого отправлять.
    $smtp_password = '8sQU64A0FD00X4VS';          // Пароль
    $smtp_from = 'Naymayer Group';                // Поле "От кого"
    $smtp_host =  'ssl://smtp.gmail.com';         // Сервер для отправки почты
    $smtp_port = '465';                           // Порт работы.
    $smtp_charset = 'utf-8';	                  // Кодировка сообщений
    $smtp_debug = true;                           // Сообщения ошибок
