<?php

    require('inc/config_inc.php');
    require('inc/lib_inc.php');

    $mail_ph = $_GET['verf'];

    if($mail_ph){
        if(verify($mail_ph)){
            echo "<div style='text-align:center'>Спасибо за регистрацию!!!<br> С этого момента Вы наш уважаемый пользователь и Вам доступны все наши сервисы!</div>";
        }else{
            echo "<div style='text-align:center'>Эта одноразовая ссылка и по ней уже была произвелена регистрация!</div>";
        }
    }else{
        header("Location: ../");
    }
