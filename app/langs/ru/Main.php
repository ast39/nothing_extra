<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 22.07.2019
 * Time: 18:19
 */

namespace app\langs\ru;

use framework\classes\Lang;


class Main extends Lang {

    # Тайтлы
    protected $main_title       = 'NothingExtra :: Фрэймворк';

    # Описания
    protected $main_description = 'NothingExtra :: Фрэймворк для разработки Web-проектов';

    # Берем страницу Home, на которой есть метод Enter

    # PAGE_METHOD_title - это будет искаться в 1ую очередь
    # protected $home_enter_title = '';
    # protected $home_enter_description = '';

    # PAGE_title - это будет искаться во 2ую очередь (если не нашлось то что выше)
    # protected $home_title = '';
    # protected $home_description = '';

    # PAGE_title - это будет искаться в 3ую очередь (если не нашлось то что выше) как дефолтное
    # protected $main_title = '';
    # protected $main_description = '';

    # тим можно перекрыть все настройки и это будет приоритетом #1 сли написать в контроллере:
    # $this->buffer->extra_title = '';
    # $this->buffer->extra_description = '';

}
