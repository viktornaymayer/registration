<?php

    require('../inc/config_inc.php');
    require('../inc/lib_inc.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $login = normalize($_POST["login"]);
        $pass = normalize($_POST["pass"]);
        $sex = normalize($_POST["sex"]);
        $birthday = normalize($_POST["birthday"]);
        $email = normalize($_POST["email"]);

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
                            header("refresh: 5; url=http://registration/");
                            echo    "<div style='text-align:center;padding:20px 50px;'>
                                        Спасибо за регистрацию, $login!<br><br>
                                        Мы направили Вам на почту письмо для подтверждения!
                                    </div>";
                        }
                    }
                }
            }
        }
        else{$mess = 1;}
        //header("Location: ../?to=reg&mess=$mess");
    }else{header("Location: ../?to=reg");}
