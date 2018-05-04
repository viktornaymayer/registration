/* ================================= */
//  VARIABLES
/* ================================= */


// COLORS

var color = [];
    color[0] = '#802c2c';
    color[1] = '#1ad38c';
    color['tip'] = '#b4b4b4';


// IDENTIFICATORS OF READY

var ready = [];
    ready['login']  = false;
    ready['pass']   = false;
    ready['birthday']  = false;
    ready['email']  = false;


var year = new Date();
    year = year.getFullYear();


/* ================================= */
//  FUNCTIONS
/* ================================= */


/* Функция удаления пробелов */
function delSpaces(str){
    str = str.replace(/\s/g, '');
    return str;
}

/* Функция проверки формы */
function formReady(){
    if(ready['login'] && ready['pass'] && ready['birthday'] && ready['email']){
        $('.button').prop("disabled", false).css({
            'background':color[1],
            'cursor':'pointer'});
    }else{
        $('.button').attr('disable','disable').css({
            'background':color[0],
            'cursor':'default'});
    }
}

/* Функция действия ответа поля */
function fieldAnswer(who, how, text, mail){
    /* Задаем цвет обводки поля */
    $('input[name="'+who+'"]').css('border-color',color[how]);
    $('input[name="re-'+who+'"]').css('border-color',color[how]);

    /* Выволим сообщение в отведенном параграфе */
    $('.'+who).css('color',color[how]).text(text);
    if(mail){$('.'+who+'-support').css('color',color['tip']).html(mail);}

    ready[who]=how;     // сбрасываем готовность отправки логина
    formReady();        // обновляем доступность кнопки отправки
}

/* Функция для сравнения введённых паролей */
function comparePass(){
    pass =  $('input[name="pass"]').val();
    pass = delSpaces(pass);
    rePass =  $('input[name="re-pass"]').val();
    rePass = delSpaces(rePass);
    if(pass && rePass){
        if(pass == rePass){
            fieldAnswer('pass',1,'Пароли совпадают');
        }else{
            fieldAnswer('pass',0,'Пароли не совпадают');
        }
    }else{
        fieldAnswer('pass',0,'Заполните оба пароля');
    }
}



/* ================================= */
//  ACTIONS
/* ================================= */


/* При изменении поля логина отправляем запрос на существование логина в базе */
$('input[name="login"]').change(function() {
    login = $('input[name="login"]').val();
    login = delSpaces(login);
    if(login){
        $.ajax({
            type: 'POST',
            url: '../controls/check_user.php',
            data: {
                'login': login
            },
            success: function(response){
                if(response){
                    fieldAnswer('login',0,'Логин уже занят');
                }else{
                    fieldAnswer('login',1,'Логин доступен');
                }
            }
        });
    }else{
        fieldAnswer('login',0,'Введите логин');
    }
});

/* Вызов функции сравнения введённых паролей при изменении в полях паролей */
$('input[name="pass"]').change(function() {comparePass()});
$('input[name="re-pass"]').change(function() {comparePass()});

/* Проверка правильности ввода даты рождения */
$('input[name="birthday"]').change(function() {

    dateBirth = $('input[name="birthday"]').val();
    dateBirth = delSpaces(dateBirth);

    // разбиваем дату и меняем местами число с годом
    x = dateBirth.indexOf('-');
    if(x > 0){
        dateArr = dateBirth.split('-');
        x = dateArr[2];
        dateArr[2] = dateArr[0];
        dateArr[0] = x;
    }else{
        // если браузер firefox, то просто разбиваем дату по точкам
        dateArr = dateBirth.split('.');
    }

    if((dateArr[0].length != 2) || (dateArr[1].length != 2) || (dateArr[2].length != 4)){
        fieldAnswer('birthday',0,'Пожалуйста, введите дату в указаном формате: 31.12.'+year);
    }else{
        if((dateArr[0] <= 31) && (dateArr[1] <= 12) && (dateArr[2] <= year)){
            fieldAnswer('birthday',1,'');
        }else{
            fieldAnswer('birthday',0,'Пожалуйста, введите дату в указаном формате: 31.12.'+year);
        }
    }

});

/* Проверка правильности ввода почты */
$('input[name="email"]').change(function() {

    email = $('input[name="email"]').val();
    email = delSpaces(email);

    // Проверяем наличие собачки
    x = email.indexOf('@');
    if(x>0){
        // Проверяем наличие точки
        x = email.indexOf('.');
        if(x>0){
            //Проверяем наличие в базе email`а
            $.ajax({
                type: 'POST',
                url: '../controls/check_email.php',
                data: {
                    'email': email
                },
                success: function(response){
                    if(!response){
                        fieldAnswer('email',1,'',' ');
                    }else{
                        fieldAnswer('email',0,'Этот email уже зарегистрирован','<a href="#'+ email +' ">Это Ваш email?</a>');
                    }
                }
            });
        }else{
            fieldAnswer('email',0,'Пожалуйста, введите корректный email');
        }
    }else{
        fieldAnswer('email',0,'Пожалуйста, введите корректный email');
    }
});
