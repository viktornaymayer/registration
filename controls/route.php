<?php

    if (isset($_GET['to'])){
        $to = $_GET['to'];
    }else{
        $to = 'welcome';
    }

    if(!isset($_SESSION['us_id']) and $to!='auth' and $to!='reg' and $to!='good_reg'){
        header("Location: index.php?to=auth");
        exit;
    }

    switch ($to){
        case 'auth':
            break;

        case 'reg':
            break;

        case 'good_reg':
            break;

        default:
    }

    require ('views/header.php');
    require ("views/$to.php");
    require ('views/footer.php');
