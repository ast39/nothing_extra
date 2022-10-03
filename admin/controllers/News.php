<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 18.09.2019
 * Time: 15:09
 */

namespace admin_panel\controllers;

use system\core\{Controller, Route, SC, SystemMessage};
use system\helper\{Request, Validator};
use modules\jsonDb\{Adapter, Manager};


class News extends Controller {

    protected $mime_upload = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif'
    ];

    public function __construct()
    {
        parent::__construct();

        if (!$this->isAdminAuth() && !$this->isRootAuth()) {
            $this->url::redirect(SITE . 'login');
        }

        Adapter::connect('test');
    }

    /**
     * Читает все статьи
     *
     * @return void
     */
    public function index()
    {
        # Получить все статьи
        $this->buffer->news = Manager::build(Adapter::connect('news'))->read();

        $this->loadTemplate();
    }

    /**
     * Читает одну статью
     *
     * @param string $id
     * @return void
     */
    public function read(string $id)
    {
        # Получить одну статью
        $this->buffer->news = Manager::build(Adapter::connect('news'))->read($id);

        $this->loadTemplate();
    }

    /**
     * Добавление статьи
     *
     * @return void
     */
    public function add()
    {
        # Если есть POST с данными
        if (Request::issetPost('add')) {

            # Проверка на заполненность обязательных полей формы
            if (($check_post = Validator::inPost('title', 'slug', 'content', 'title_seo', 'desc_seo')) !== null) {
                SystemMessage::setMsg('news_action', 'Все поля обязательны для заполнения (' . implode(', ', $check_post) . ')', MSG_ERROR, true);

                Route::redirect(SITE . 'news/add');
            }

            # Получим папку для сохранения файла и имя файла
            $path_img  = Request::post('path_img') ?? 'project';
            $img_file  = Request::file('img');

            # Проверка на ошибки загрузки файла
            if ($img_file['error'] > 0) {
                SystemMessage::setMsg('news_action', 'Не удалось загрузить изображение', MSG_ERROR, true);

                Route::redirect(SITE . 'news/add');
            }

            # Проверка на правильный тип файла (он должен быть картинкой)
            $info = getimagesize($img_file['tmp_name']);
            if (!in_array($info['mime'], $this->mime_upload)) {
                SystemMessage::setMsg('news_action', 'Неверный mime-тип изображения. Выберите jpg/png файл', MSG_ERROR, true);

                Route::redirect(SITE . 'news/add');
            }

            # Соберем полный путь для сохранения файла
            $file_name = time() . '_' . $img_file['name'];
            $path = SC::separator($this->getImgUrl($path_img, $file_name));

            # Если файл так и не загрузился
            if (!is_uploaded_file($img_file['tmp_name'])) {
                SystemMessage::setMsg('news_action', 'Не удалось загрузить изображение', MSG_ERROR, true);

                Route::redirect(SITE . 'news/add');
            }

            # Перемещаем файл в выбранный каталог
            move_uploaded_file($img_file['tmp_name'], $path);

            # Сохраняем новость в БД
            Manager::build(Adapter::connect('news'))->create([
                'id'        => SC::createUuid(),
                'title'     => Request::post('title'),
                'slug'      => Request::post('slug'),
                'status'    => Request::issetPost('status') ? 1 : 0,
                'content'   => Request::post('content'),
                'img_path'  => Request::post('path_img') ?? 'project',
                'img_name'  => $file_name,
                'title_seo' => Request::post('title_seo'),
                'desc_seo'  => Request::post('desc_seo'),
                'add_time'  => time()
            ]);

            SystemMessage::setMsg('news_action', 'Статья успешно добавлена', MSG_SUCCESS, true);
        }

        $this->loadTemplate();
    }

    public function edit($id)
    {
        # Если есть POST с данными
        if (Request::issetPost('edit')) {

            # Проверка на заполненность обязательных полей формы
            if (($check_post = Validator::inPost('title', 'slug', 'content', 'title_seo', 'desc_seo')) !== null) {
                SystemMessage::setMsg('news_action', 'Все поля обязательны для заполнения (' . implode(', ', $check_post) . ')', MSG_ERROR, true);

                Route::redirect(SITE . 'news/add');
            }

            $new_data = [
                'title'     => Request::post('title'),
                'slug'      => Request::post('slug'),
                'status'    => Request::issetPost('status') ? 1 : 0,
                'content'   => Request::post('content'),
                'title_seo' => Request::post('title_seo'),
                'desc_seo'  => Request::post('desc_seo')
            ];

            # Если стоит галочка, что изображение так же требуется обновить
            if (Request::issetPost('change_img')) {

                # Получим папку для сохранения файла и имя файла
                $path_img  = Request::post('path_img') ?? 'project';
                $img_file  = Request::file('img');

                # Проверка на ошибки загрузки файла
                if ($img_file['error'] > 0) {
                    SystemMessage::setMsg('news_action', 'Не удалось загрузить изображение', MSG_ERROR, true);

                    Route::redirect(SITE . 'news/edit/' . $id);
                }

                # Проверка на правильный тип файла (он должен быть картинкой)
                $info = getimagesize($img_file['tmp_name']);
                if (!in_array($info['mime'], $this->mime_upload)) {
                    SystemMessage::setMsg('news_action', 'Неверный mime-тип изображения. Выберите jpg/png файл', MSG_ERROR, true);

                    Route::redirect(SITE . 'news/edit/' . $id);
                }

                # Соберем полный путь для сохранения файла
                $file_name = time() . '_' . $img_file['name'];
                $path = SC::separator($this->getImgUrl($path_img, $file_name));

                # Если файл так и не загрузился
                if (!is_uploaded_file($img_file['tmp_name'])) {
                    SystemMessage::setMsg('news_action', 'Не удалось загрузить изображение', MSG_ERROR, true);

                    Route::redirect(SITE . 'news/edit/' . $id);
                }

                # Перемещаем файл в выбранный каталог
                move_uploaded_file($img_file['tmp_name'], $path);

                $new_data['img_path'] = Request::post('path_img') ?? 'project';
                $new_data['img_name'] = $file_name;

                # Удаление старого файла
                $item = Manager::build(Adapter::connect('news'))->read($id);
                unlink(SC::separator(ROOT . 'i/img/' . ($item['img_path'] == 'img' ? '' : $item['img_path'] . '/') . $item['img_name']));
            }

            Manager::build(Adapter::connect('news'))->update($id, $new_data);

            SystemMessage::setMsg('news_action', 'Статья успешно отредактирована', MSG_SUCCESS, true);
        }

        $this->buffer->news = Manager::build(Adapter::connect('news'))->read($id);

        $this->loadTemplate();
    }

    /**
     * Удаляет одну указанную статью
     *
     * @param string $id
     * @return void
     */
    public function delete(string $id)
    {
        # Удалить статью из БД
        Manager::build(Adapter::connect('news'))->delete($id);

        SystemMessage::setMsg('news_action', 'Статья успешно удалена', MSG_SUCCESS, true);

        Route::redirect(SITE . 'news');
    }

    /**
     * Вспомогательная функция, возвращающая полный путь куда сохранять файл
     *
     * @param string $path
     * @param string $file_name
     * @return string
     */
    private function getImgUrl(string $path, string $file_name): string
    {
        $save_to = ROOT . 'i/img/';

        switch ($path) {

            case 'news':
                return $save_to . 'news/' . $file_name;
            case 'ico':
                return $save_to . 'ico/' . $file_name;
            case 'gallery':
                return $save_to . 'gallery/' . $file_name;
            default:
                return $save_to . 'project/' . $file_name;
        }
    }

}
