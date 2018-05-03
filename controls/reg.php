<?php

    require('../inc/config_inc.php');
    require('../inc/lib_inc.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $login = normalize($_POST["login"]);
        $pass = normalize($_POST["pass"]);
        $sex = normalize($_POST["sex"]);
        $birthday = normalize($_POST["birthday"]);
        $email = normalize($_POST["email"]);

        echo $login."<br>".$pass."<br>".$sex."<br>".$birthday."<br>".$email;

        //  Проверка заполнения всех полей
        if($login and $pass and $birthday and $email){

            /* Проверка существования логина */
            if(user_exists($login)){$mess = 2;}
            else{

                /* Проверка существования email */
                if(email_exists($email)){$mess = 2;}
                else{

                    /* Проверка существования даты */
                    if (($timestamp = strtotime($birthday)) === false) {$mess = 3;}
                    else {
                        $birthday = strtotime($birthday);
                        $passh = get_hash($pass);
                        $mail_ph = get_hash($passh);

                        if (reg_user($login, $passh, $sex, $birthday, $email, $mail_ph)){
                            echo "<br><a href='../verify.php?verf=$mail_ph'>Подтвердить почту</a><br>";
                        }
                    }

                    echo '<br><br>hello';}
            }
        }
        else{$mess = 1;}
        //header("Location: ../?to=reg&mess=$mess");
    }else{header("Location: ../?to=reg");}
