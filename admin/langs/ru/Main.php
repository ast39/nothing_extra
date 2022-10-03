<?php

/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 23.09.2019
 * Time: 13:31
 */

namespace admin\langs\ru;

use framework\classes\Lang;


class Main extends Lang {

    protected $main_title = 'Панель администратора';

    protected $menu_lic             = 'Лицензия';
    protected $menu_logs            = 'Логи';
    protected $menu_logs_errors     = 'Логи ошибок';
    protected $menu_logs_visits     = 'Логи визитов';
    protected $menu_manage          = 'Управление';
    protected $menu_manage_robots   = 'Правила ПС';
    protected $menu_manage_sitemap  = 'Карта сайта';
    protected $menu_manage_htaccess = 'Web-сервер';
    protected $menu_manage_status   = 'Статус сайта';
    protected $menu_redactor        = 'Редактор';
    protected $menu_image           = 'Изображения';
    protected $menu_project         = 'Проект';
    protected $menu_competition     = 'Соревнования';
    protected $menu_manual          = 'Руководство';
    protected $menu_logout          = 'Выход';

    protected $login_name           = 'Имя пользователя';
    protected $login_pass           = 'Пароль';
    protected $login_auth           = 'Авторизация';
    protected $login_default_data   = 'Вы используете дефолтный логин и/или небезопасный пароль. Пожалуйсат, измените 
                                       параметры "admin_login" и "admin_password" в файле "Settings.php" и попрбуйте авторизоваться снова';
    protected $login_wrong_data     = 'Неверные данные';

    protected $lic_head_1           = 'Лицензионное соглашение';
    protected $lic_head_2           = '# NothingExtra Лицензионное соглашение';

    protected $errorlog_head        = 'Логи ошибок за неделю';
    protected $errorlog_err_1       = 'Логи отсутствуют';
    protected $errorlog_t1          = 'Время';
    protected $errorlog_t2          = 'IP';
    protected $errorlog_t3          = 'Ошибка';
    protected $errorlog_t4          = 'Адрес';

    protected $visitlog_head        = 'Логи визитов за неделю';
    protected $visitlog_err_1       = 'Логи отсутствуют';
    protected $visitlog_t1          = 'Время';
    protected $visitlog_t2          = 'Посетитель';
    protected $visitlog_t3          = 'Браузер';
    protected $visitlog_t4          = 'ОС';
    protected $visitlog_t5          = 'IP';
    protected $visitlog_t6          = 'Адрес';

    protected $redactor_head        = 'Файловый менеджер';
    protected $redactor_path        = 'Текущий путь: ';
    protected $redactor_stepback    = 'На уровень вверх';
    protected $redactor_ask_dir     = 'Вы хотите удалить директорию безвовратно?';
    protected $redactor_ask_file    = 'Вы хотите удалить файл безвовратно?';
    protected $redactor_new_file    = 'Создать файл в текущей директории';
    protected $redactor_new_dir     = 'Создать каталог в текущей директории';
    protected $redactor_err_1       = 'Доступ запрещен к выбранной директории';
    protected $redactor_err_2       = 'Запрещено создавать файл в данной директории';
    protected $redactor_err_3       = 'Запрещено создавать каталоги в данной директории';
    protected $redactor_err_4       = 'Вы не указали имя новой директории';
    protected $redactor_err_5       = 'Ошибка! Удаление не прошло; Код 404';
    protected $redactor_err_6       = 'Ошибка! В каталоге имеются фалы';
    protected $redactor_err_7       = 'Ошибка! Удаление не прошло; Код 500';
    protected $redactor_err_8       = 'Ошибка! Запрещено редактировать данный файл';
    protected $redactor_err_9       = 'Ошибка! Редактирование не прошло; Код 404';
    protected $redactor_err_10      = 'Ошибка! Редактирование не прошло; Код 500';
    protected $redactor_scs_1       = 'Файл успешно создан: ';
    protected $redactor_scs_2       = 'Директория успешно создана: ';
    protected $redactor_scs_3       = 'Файл успешно удален';
    protected $redactor_scs_4       = 'Каталог успешно удален';
    protected $redactor_scs_5       = 'Файл успешно отредактирован';
    protected $redactor_add_dir     = 'Добавить новую директорию';
    protected $redactor_add_file    = 'Добавить новый файл';
    protected $redactor_edit_file   = 'Редактор кода файла';
    protected $redactor_edit_form   = 'Окно редактирования кода';
    protected $redactor_file_name   = 'Имя файла';
    protected $redactor_dir_name    = 'Имя каталога';
    protected $redactor_add         = 'Добавить';
    protected $redactor_save        = 'Сохранить';
    protected $redactor_cancel      = 'Отмена';

    protected $images_head          = 'Загрузка избражений';
    protected $images_path          = 'Каталог для сохранения';
    protected $images_d_general     = 'Общий';
    protected $images_d_project     = 'Проект';
    protected $images_d_ico         = 'Иконки';
    protected $images_d_gallery     = 'Галлерея';
    protected $images_filename      = 'Имя файла на сервере';
    protected $images_uploadfile    = 'Файл для загрузки';
    protected $images_upload        = 'Загрузить';
    protected $images_err_1         = 'Ошибка загрузки файла';
    protected $images_err_2         = 'Файл не должен превышать размер в ';
    protected $images_err_3         = 'Загружать можно ТОЛЬКО файлы типов ( jpg / jpeg / png / gif )';
    protected $images_err_4         = 'К сожалению, файл не удалось загрузить на сервер';
    protected $images_scs           = 'Файл загружен. Ссылка для вставки: ( img src="[IMG]';

    protected $manage_robots_head   = 'Редактор натроек индексирования';
    protected $manage_sitemap_head  = 'Редактор карты сайта';
    protected $manage_htaccess_head = 'Редактор настроек web-сервера';
    protected $manage_status_head   = 'Вкл / Выкл доступ к сайту';
    protected $manage_scs_1         = 'Файл успешно обновлен';
    protected $manage_scs_2         = 'Статус сайта был успешно изменен';
    protected $manage_err_1         = 'Ошибка сохранения файла';
    protected $manage_err_2         = 'Вы выбрали текущий статус';
    protected $manage_err_3         = 'Шаблон не найден ';
    protected $manage_edit          = 'Редактирование';
    protected $manage_save          = 'Сохранить';
    protected $manage_clean         = 'Очистить';
    protected $manage_for_all       = 'Сайт доступен для пользователей';
    protected $manage_for_admin     = 'Сайт доступен только для администраторов';

}