<?php

    require_once ('../inc/config_inc.php');
    require_once ('../inc/lib_inc.php');

    if(isset($_POST["login"]) and isset($_POST["pass"])==false){
        $login = trim(strip_tags($_POST["login"]));
        if($login){
            if($res = user_exists($login)){
                echo $res;
            }
        }
        exit;
    }





/*
    if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST["pass"])){
        $login = trim(strip_tags($_POST["login"]));
        $pass = trim(strip_tags($_POST["pass"]));
        if($login and $pass){
            if($result = userExists($login)){
                list($_, $hash) = explode(':', $result);
                if(checkHash($pw, $hash)){
                    $_SESSION['admin'] = true;
                    header("Location: $ref");
                    exit;
                }else{
                    $title = 'Неправильное имя пользователя или пароль!';
                }
            }else{
                $title = 'Неправильное имя пользователя или пароль!';
            }
        }else{
        $title = 'Заполните все поля формы!';
        }
    }
*/
