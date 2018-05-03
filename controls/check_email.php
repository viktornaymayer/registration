<?php

    require_once ('../inc/config_inc.php');
    require_once ('../inc/lib_inc.php');

    if(isset($_POST["email"])){
        $email = trim(strip_tags($_POST["email"]));
        if($email){
            if($res = email_exists($email)){
                echo $res;
            }
        }
        exit;
    }
