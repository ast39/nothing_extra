<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 23.07.2019
 * Time: 17:06
 *
 * Время в секундах
 * Память в мегабайтах
 */

namespace framework\classes;

use framework\traits\Singleton;


class Benchmark {

    use Singleton;

    private $marks = [];

    public function addMark($name)
    {
        $this->marks[$name] = [
            'mark'   => microtime(true),
            'memory' => self::memoryUse()
        ];
    }

    public function memoryUse()
    {
        return function_exists('memory_get_usage')
            ? number_format(round(memory_get_usage() / 1024 / 1024, 2), 2)
            : 0;
    }

    public function calcAndGet()
    {
        $data = [];
        $start_mark = $old_mark = $this->marks['_work_start_']['mark'];

        foreach ($this->marks as $name => $markArr) {

            $data[$name] = [

                'mark'       => $markArr['mark'],
                'load_mark'  => number_format($markArr['mark'] - $old_mark, 4),
                'load_total' => number_format($markArr['mark'] - $start_mark, 4) ,
                'memory'     => $markArr['memory']
            ];

            $old_mark = $markArr['mark'];
        }

        return $data;
    }

    public function elapsedTime($point1 = '', $point2 = '', $decimals = 4)
    {
        if ($point1 == '') {
            return $this->elapsedTime('_work_start_', '_work_end_');
        }

        if (!isset($this->marks[$point1])) {
            return null;
        }

        if (!isset($this->marks[$point2])) {

            $this->marks[$point2]['mark']   = microtime(1);
            $this->marks[$point2]['memory'] = self::memoryUse();
        }

        return number_format($this->marks[$point2]['mark'] - $this->marks[$point1]['mark'], $decimals);
    }

    public function __get($name)
    {
        return $this->marks[$name] ?? null;
    }

    protected function __clone() {}
}