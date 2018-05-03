<?php

    //  убирает все пробелы
    function normalize($str){
        $str = trim(strip_tags($str));
        $str = str_replace(" ","",$str);
        return $str;
    }

    //  вытаскивает информацию о пользователях
    function get_users(){
        global $link;
        $q = 'SELECT `id`, `login`, `passh`, `email` FROM `users`';
        if (!$r = mysqli_query($link,$q)){
            return false;
        }
        $users = mysqli_fetch_all($r, MYSQLI_ASSOC);
        mysqli_free_result($r);
        return $users;
    }

    //  проверяет наличие пользователя
    function user_exists($user){
        $users = get_users();
        foreach($users as $u){
            if($u['login'] == $user){
                return $user;
            }
        }
        return false;
    }

    //  проверяет наличие почты
    function email_exists($email){
        $emails = get_users();
        foreach($emails as $e){
            if($e['email'] == $email){
                return true;
            }
        }
        return false;
    }

    //  создает хэш
    function get_hash($pass){
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        return trim($hash);
    }

    //  регистрация
    function reg_user($login, $passh, $sex, $birthday, $email, $mail_ph){
        global $link;
        $q = "INSERT INTO tmp_users(login, passh, sex, birthday, email, verification) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $q);
        if (!$stmt = mysqli_prepare($link, $q)){
            return false;
        }
        mysqli_stmt_bind_param($stmt, "ssiiss", $login, $passh, $sex, $birthday, $email, $mail_ph);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }

    //  добавление пользователя
    function add_user($users){
        global $link;
        $q = "INSERT INTO users(login, passh, sex, birthday, email) VALUES(?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $q);
        if (!$stmt = mysqli_prepare($link, $q)){return false;}
        mysqli_stmt_bind_param($stmt, "ssiis", $users['login'], $users['passh'], $users['sex'], $users['birthday'], $users['email']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    //  подтверждение email
    function verify($mail_ph){
        global $link;

        //  выбераем
        $q = "SELECT `login`, `passh`, `sex`, `birthday`, `email` FROM `tmp_users` WHERE `verification` ='$mail_ph'";
        if (!$r = mysqli_query($link,$q)){return false;}
        $users = mysqli_fetch_assoc($r);
        if (!$users){return false;}
        mysqli_free_result($r);

        //  удаляем
        $q = "DELETE FROM `tmp_users` WHERE `verification` ='$mail_ph'";
        mysqli_query($link,$q);

        //  добавляем
        add_user($users);

        return true;
    }

    //  авторизация
    function check_user($pass, $login){
        global $link;
        $q = "SELECT `passh` FROM `users` WHERE `login` = '$login'";
        if (!$r = mysqli_query($link,$q)){return false;}
        $passh = mysqli_fetch_assoc($r);
        mysqli_free_result($r);

        $hash = $passh['passh'];

        return password_verify($pass, $hash);
    }

    //  выход
    function logOut(){
        session_destroy();
        header('Location: ../');
        exit;
    }
