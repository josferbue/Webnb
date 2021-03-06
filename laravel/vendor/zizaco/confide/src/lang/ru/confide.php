<?php

return array(

    'username' => 'Имя пользователя',
    'password' => 'Пароль',
    'password_confirmation' => 'Повторите пароль',
    'e_mail' => 'Email',
    'username_e_mail' => 'Имя пользователя или email',

    'signup' => array(
        'title' => 'Регистрация',
        'desc' => 'Регистрация нового пользователя',
        'confirmation_required' => 'Требуется подтверждение адреса email',
        'submit' => 'Создать новую учётную запись',
    ),

    'login' => array(
        'title' => 'Вход',
        'desc' => 'Введите данные своего аккаунта',
        'forgot_password' => '(я забыл пароль)',
        'remember' => 'Запомнить меня',
        'submit' => 'Войти',
    ),

    'forgot' => array(
        'title' => 'Я забыл пароль',
        'submit' => 'Продолжить',
    ),

    'alerts' => array(
        'account_created' => 'Ваш аккаунт успешно зарегистрирован. Проверьте ваш почтовый ящик и следуйте дальнейшим инструкциям, чтобы подтвердить свой ​​адрес электронной почты.',
        'too_many_attempts' => 'Слишком много попыток входа в систему. Повторите попытку через несколько минут.',
        'wrong_credentials' => 'Неверное имя пользователя, email или пароль.',
        'not_confirmed' => 'Ваш аккаунт не подтвержден. Проверьте свой почтовый ящик и нажмите на ссылку для подтверждения.',
        'confirmation' => 'Ваш аккаунт подтверждён! Теперь вы можете войти в систему.',
        'wrong_confirmation' => 'Неверный код подтверждения.',
        'password_forgot' => 'Информация об изменении пароля была отправлена на ваш email.',
        'wrong_password_forgot' => 'Пользователь не найден.',
        'password_reset' => 'Ваш пароль успешно изменён.',
        'wrong_password_reset' => 'Неверный пароль. Попробуйте ещё раз.',
        'wrong_token' => 'Неверный ключ для восстановления пароля.',
        'duplicated_credentials' => 'Такое имя пользователя или адрес электронной почты уже используются. Попробуйте ввести другие данные.',
    ),

    'email' => array(
        'account_confirmation' => array(
            'subject' => 'Подтверждение регистрации',
            'greetings' => 'Здравствуйте, :name',
            'body' => 'Пожалуйста, перейдите по указанной ниже ссылке для подтверждения регистрации.',
            'farewell' => 'С уважением,',
        ),

        'password_reset' => array(
            'subject' => 'Восстановление пароля',
            'greetings' => 'Здравствуйте, :name',
            'body' => 'Перейдите по указанной ниже ссылке для изменения пароля.',
            'farewell' => 'С уважением,',
        ),
    ),

);
