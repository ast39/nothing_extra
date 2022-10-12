<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 22.07.2019
 * Time: 14:01
 */

namespace framework\classes;


class Component extends Controller {

    public function __construct()
    {
        $this->component = true;

        parent::__construct();
    }

    /**
     * Загрузить шаблон
     *
     * @param string|bool $name
     */
    protected function loadTemplate($name = false)
    {
        $class_arr = explode('\\', get_class($this));
        foreach ($class_arr as $index => $part) {
            $class_arr[$index] = ($index + 1) == count($class_arr)
                ? lcfirst($part)
                : ($index == 0
                    ? 'templates'
                    : $part);
        }
        $component = implode('/', $class_arr);

        $name = $name == false
            ? $component
            : 'templates/components/' .  $name;

        Benchmark::instance()->addMark('_template_load_start_');

        $general_folder = defined('ADMIN') ? 'admin_panel' : 'project';

        if (file_exists(ROOT . $general_folder . DIRECTORY_SEPARATOR . $name . '.php')) {
            include ROOT . $general_folder . DIRECTORY_SEPARATOR . $name . '.php';
        }
    }
}
