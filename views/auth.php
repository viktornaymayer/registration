<style>
    *{text-align: center}
</style>
<?php
    require('inc/config_inc.php');
    require('inc/lib_inc.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $login = trim(strip_tags($_POST["login"]));
        $pw = trim(strip_tags($_POST["pw"]));

        if($login and $pw){
            if(user_exists($login)){
                if(check_user($pw, $login)){
                    echo 'Ok, this is you!<br><br>';
                    return;
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
    echo $title."<br><br>";
?>

	<form action="<?= $_SERVER['REQUEST_URI']?>" method="post">
		<div>
			<label for="txtUser">Логин</label>
			<input id="txtUser" type="text" name="login" value="<?= $login?>" />
		</div>
		<div>
			<label for="txtString">Пароль</label>
			<input id="txtString" type="password" name="pw" />
		</div>
		<div>
			<button type="submit">Войти</button>
		</div>
	</form>


<br><br>
<a href="?to=reg">Зарегистрироваться</a>
<br><br>
