<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 22.07.2019
 * Time: 14:05
 */


return [
    
    'options' => [

        # кодировка сайта
        'charset' => 'utf-8',
    
        # сайт в каталоге
        'site_dir' => '',
    
        # экстренно остановить сайт
        'site_stop' => false,
    
        # вкл / выкл вывод ошибок
        'production' => false,
    
        # вкл / выкл дебаг информации
        'debug' => true,
    
        # логирование посещений сайта
        'log_visits' => true,
    
        # логирование ошибок сайта
        'log_errors' => true,
    
        # страница авторизации
        'login_page' => 'login',
    
        # url для доступа в админку
        'admin_partition' => 'site_admin',
    
        # страница ( класс ) по умолчанию
        'def_page' => 'home',
    
        # метод, запускаемый автоматически в каждом классе ( странице )
        'def_method' => 'index',
    
        # имя массива сессии с данными
        'session_array' => 'ne',
    
        # время жизни сессионной куки
        'session_set_cookie_params' => 7200,
    
        # максимальный размер загружаемых файлов (в МБ)
        'max_upload_size' => 8,
    
        # рутовый доступ к админке сайта
        'root_login'    => 'root',
        'root_password' => '',
    
        # авторизационные данные клиента к админке сайта
        'admin_login'    => 'admin',
        'admin_password' => '',
    
        # права доступа к создаваемым каталогам
        'dir_access' => 0777,
        
        # метка авторизации на сайте
        'user_auth_mark' => '_auth_user_',
        
        # метка авторизации в админке
        'admin_auth_mark' => '_auth_admin_',
        
        # метка авторизации под рутом
        'root_auth_mark' => '_auth_root_',
    
        # почта для отправки писем о падении сайта, запросов к БД и т.д.
        'admin_mail' => 'admin.sc@gmail.com',
    
        # почта для отправки писем от пользователей сайта.
        'public_mail' => 'support.sc@gmail.com',
        
        # время кэширования
        'cache_time' => 3600,

        # язык сайта по умолчанию
        'def_lang' => 'ru',

        # массив языковых версий сайта
        'site_langs' => [

            'ru',
        ],

    ],

]

?>
