<?php

namespace framework\classes;


class Cloud {

    protected $cloud_root = '';

    protected $user_folder = '';

    protected $notAllowed = [

        '.',
        '..',
        '.git',
        '.idea',
        '.htaccess',
        'robots.txt',
        'sitemap.xml',
        'cfg.csv',
        'composer.json',
        'favicon.ico',
        'tmp',
        'admin_panel',
        'autoloader.php',
    ];

    protected $imageTypes = [

        'jpeg',
        'jpg',
        'png',
        'gif'
    ];


    public function __construct($cloud_root = '', $user_folder = '')
    {
        $this->cloud_root = $cloud_root;
        if (!empty($this->cloud_root) && substr($this->cloud_root, -1) != '/') {
            $this->cloud_root = $this->cloud_root . '/';
        }

        $this->user_folder = $user_folder;
        if (!empty($this->user_folder) && substr($this->user_folder, -1) != '/') {
            $this->user_folder = $this->user_folder . '/';
        }
    }

    /**
     * Сканирование директории
     *
     * @param $url
     * @return array|array[]
     */
    public function scan($url): array
    {
        $data = [

            'dirs'  => [],
            'files' => []
        ];

        $url = str_replace(['//', '\\\\'], DIRECTORY_SEPARATOR, ($this->userCloudRoot() . $this->decodeUrl($url)));

        $dir = scandir($url);

        foreach ($dir as $k) {

            if ($this->inAllowedList($k)) {

                if (is_dir($url . $k)) {
                    $data['dirs'][] = $k;
                } else if (is_file($url . $k)) {
                    $v_parts = explode('.', $k);
                    if (in_array(strtolower(end($v_parts)), $this->imageTypes)) {
                        $data['files'][] = [
                            'name' => $k,
                            'type' => 'img'
                        ];
                    } else {
                        $data['files'][] = [
                            'name' => $k,
                            'type' => 'text'
                        ];
                    }
                }
            }
        }

        Session::set($this->encodeUrl(str_ireplace($this->userCloudRoot(), '', $url)), 'conductor_url');

        if (Session::get('good_log') != false) {

            Buffer::getInstance()->set('good_log', Session::get('good_log'));
            Session::remove('good_log');
        } elseif (Session::get('bad_log') != false) {

            Buffer::getInstance()->set('bad_log', Session::get('bad_log'));
            Session::remove('bad_log');
        }

        return $data;
    }

    /**
     * Шаг назад
     *
     * @param $url
     * @param int $early
     * @return string
     */
    public function backSteps($url, $early = 0): string
    {
        $newUrl = ':';
        $parts = explode(':', $url);
        $parts = array_values(
            array_filter($parts, function($element) {
                return !empty($element);
            })
        );

        for ($i = 0; $i < count($parts) - $early; $i++) {
            $newUrl .= $parts[$i] . ':';
        }

        return $newUrl;
    }

    /**
     * Блоки для облака тегов в URL
     *
     * @param string $url
     * @return string
     */
    public function currentUrl(string $url, bool $nocss = false): string
    {
        return $nocss == true
            ? $this->decodeUrl($url)
            : $this->urlPartsInCode($this->decodeUrl($url));
    }

    /**
     * Корень облака для пользователя
     *
     * @return array|string|string[]
     */
    public function userCloudRoot()
    {
        return NE::separator(ROOT . $this->cloud_root . $this->user_folder, DIRECTORY_SEPARATOR);
    }

    /**
     * Проверка, чтобы не юзер не вышел выше своей папки
     *
     * @param $url
     * @return bool
     */
    public function checkAccess($url): bool
    {
        if (strpos($url, ':') === false) {
            return true;
        }

        $parts = explode(':', $url);
        $parts = array_values(
            array_filter($parts, function($element) {
                return !empty($element);
            })
        );

        if (empty($parts)) {
            return true;
        }

        return $this->inAllowedList($parts[0]);
    }

    /**
     * Кодировка URL-а для системы облака
     *
     * @param string $url
     * @return string
     */
    public function encodeUrl(string $url)
    {
        return ':' . str_ireplace(DIRECTORY_SEPARATOR, ':', $url);
    }

    /**
     * Раскодирование URL-а из системы облака
     *
     * @param string $url
     * @return array|string|string[]
     */
    public function decodeUrl(string $url)
    {
        if (substr($url, 0, 1) == ':') {
            $url = substr($url, 1);
        }

        return str_ireplace(':', DIRECTORY_SEPARATOR, $url);
    }

    /**
     * Проверяет тип файла на изображение
     *
     * @param array $file
     * @return bool
     */
    public function isImage(array $file): bool
    {
        $_type = explode('/', $file['type'] ?? '');

        return ($_type[0] ?? '') == 'image';
    }

    /**
     * Возвращает расширение файла
     *
     * @param array $file
     * @return string
     */
    public function getDotType(array $file): string
    {
        $_name = explode('.', $file['name'] ?? '');
        $_type = explode('/', $file['type'] ?? '');

        return $this->isImage($file)
            ? end($_type)
            : end($_name);
    }


    /**
     * Не состоит ли файл в исключениях для учета
     *
     * @param string $name
     * @return bool
     */
    private function inAllowedList(string $name)
    {
        return !in_array($name, $this->notAllowed);
    }

    /**
     * Облако пути в дизайне
     *
     * @param string $url
     * @return string
     */
    private function urlPartsInCode(string $url)
    {
        $result = '<code class="bg-light pt-1 pb-1 pl-2 pr-2 ml-2 mb-1 rounded">' . DIRECTORY_SEPARATOR . '</code>';

        if (stripos($url, DIRECTORY_SEPARATOR) !== false) {

            $parts = explode(DIRECTORY_SEPARATOR, $url);
            $parts = array_values(
                array_filter($parts, function($element) {
                    return !empty($element);
                })
            );

            foreach ($parts as $part) {
                $result .= '<code class="bg-light pt-1 pb-1 pl-2 pr-2 ml-2 mb-1 rounded">' . $part . '</code>';
            }
        }

        return $result;
    }
}
