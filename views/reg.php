<style>
    *{
        text-align: center}
    input {
        width: 200px;
        height: 30px;
        display: block;
        margin: 10px auto}
    .radio, label{cursor: pointer;display: inline-block;margin: 0 7px;width: auto;height: auto;}
    .button{
        background: #802c2c;
        border: 0;
    }
</style>

<p><b>Регистрация на сайте !</b></p>

<?php
    $mess = $_GET['mess'];

    switch ($mess){
        case 1: echo '<p><b>Извините, но Вы не заполнели все необходимые поля!<br>Повторите регистрацию!</b></p>';
            break;
        case 2: echo '<p><b>Извините, но возникли проблемы с Вашей связкой логин/пароль!<br>Повторите регистрацию!</b></p>';
            break;
        case 3: echo '<p><b>Извините, но возникли проблемы с датой Вашего рождения!<br>Повторите регистрацию!</b></p>';
            break;
        case 100: echo '<p><b>Спасибо Вам за регистрацию!<br>Мы выслали письмо на Ваш почтовый ящик для подтверждения!</b></p>';
            exit;
    }
?>

<form action="../controls/reg.php" method="post">
    <p class="login"></p>
    <input type="text" name="login" placeholder="Введите логин" required>
    <p class="pass"></p>
    <input type="password" name="pass" placeholder="Введите пароль" required>
    <input type="password" name="re-pass" placeholder="Подтвердите пароль" required>
    <p class="birthday"></p>
    <input type="date" name="birthday" placeholder="День рождения: 00.00.0000" required>
    <p class="email"></p>
    <input type="email" name="email" placeholder="Введите email" required>
    <p class="email-support"></p>
    <p>Выберите пол:</p>
    <p><input name="sex" type="radio" value="1" id="1" class='radio'><label for="1">Мужской</label>
    <input name="sex" type="radio" value="0" id="0" class='radio'><label for="0">Женский</label></p>
    <input type="submit" value='Поехали!' class='button' disabled>
</form>

<script src="../inc/jquery-3.3.1.min.js"></script>
<script src="../controls/reg.js"></script>
