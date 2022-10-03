<?php


namespace framework\classes;


class DataBuilder {

    private $work_data;

    private $def_condition = '=';
    private $conditions    = ['=', '!=', '>', '>=', '<', '<='];
    private $exceptions    = [true, false, null, 1, 0];


    private function __construct($data)
    {
        $this->work_data = $data;
        $this->work_data = $this->toArray();
    }


    /**
     * Статический вызов класса
     *
     * @param $data
     * @return DataBuilder
     */
    public static function instance($data): DataBuilder
    {
        if (!is_array($data) && !is_object($data)) {

            if (self::isJson($data)) {
                $data = json_decode($data, TRUE);
            }

            $data = [$data];
        }

        return new self($data);
    }

    /**
     * Сортировка
     *
     * @param $key
     * @param false $reverse
     * @return $this
     */
    public function orderBy($key, $reverse = false): self
    {
        $data_keys   = array_keys($this->work_data);
        $data_values = array_values($this->work_data);

        $arr_sort_keys = [];
        foreach ($data_values as $k => $v) {

            if (!key_exists($key, $v)) {
                return $this;
            }

            $arr_sort_keys[] = $v[$key];
        }

        $reverse ? arsort($arr_sort_keys) : asort($arr_sort_keys);
        $keys = array_keys($arr_sort_keys);

        $response = [];
        for ($key = 0; $key < count($keys); $key++) {
            $response[$data_keys[$keys[$key]]] = $data_values[$keys[$key]];
        }

        $this->work_data = $response;

        return $this;
    }

    /**
     * Двойная сортировка
     *
     * @param $key1
     * @param $key2
     * @param false $reverse1
     * @param false $reverse2
     * @return $this
     */
    public function doubleOrderBy($key1, $key2, $reverse1 = false, $reverse2 = false): self
    {
        $response = [];
        $data_values = array_values($this->work_data);

        $arr_sort_keys = [];
        foreach ($data_values as $v) {

            if (!key_exists($key1, $v)) {
                return $this;
            }

            $arr_sort_keys[] = $v[$key1];
        }

        $reverse1 ? arsort($arr_sort_keys) : asort($arr_sort_keys);
        $keys = array_keys($arr_sort_keys);

        $i = 0;
        $preResult = [];
        $currentIndex1 = $arr_sort_keys[$keys[0]];

        for ($key = 0; $key < count($keys); $key++) {

            if ($currentIndex1 != $arr_sort_keys[$keys[$key]]) {
                $currentIndex1 = $arr_sort_keys[$keys[$key]];
                $i++;
            }

            $preResult[$i][] = $data_values[$keys[$key]];
        }

        foreach ($preResult as $array) {

            $array = self::instance($array)->orderBy($key2, $reverse2)->toArray();

            foreach ($array as $arr) {
                $response[] = $arr;
            }
        }

        $this->work_data = $response;

        return $this;
    }

    /**
     * Выборка по условию [WHERE]
     *
     * @param $key
     * @param $condition
     * @param null $value
     * @return $this
     */
    public function getWhere($key, $condition, $value = null): self
    {
        if (is_null($value)) {

            if (in_array($condition, $this->exceptions, true) && !in_array($condition, $this->conditions, true)) {

                $value     = $condition;
                $condition = $this->def_condition;
            } else if (!in_array($condition, $this->conditions)) {

                $value     = $condition;
                $condition = $this->def_condition;
            }
        }

        $this->work_data = array_filter($this->work_data, function($e) use ($key, $value, $condition) {

            $e_key = is_object($e) ? $e->$key : $e[$key];

            switch ($condition) {

                case '>'  : return $e_key >  $value;
                case '>=' : return $e_key >= $value;
                case '<'  : return $e_key <  $value;
                case '<=' : return $e_key <= $value;
                case '!=' : return in_array($value, $this->exceptions)
                    ? $e_key !== $value
                    : $e_key != $value;
                default   : return in_array($value, $this->exceptions)
                    ? $e_key === $value
                    : $e_key == $value;
            }
        });

        return $this;
    }

    /**
     * Выборка по сравнению с массивом значений [WHERE IN]
     *
     * @param $key
     * @param array $values
     * @return $this
     */
    public function getWhereIn($key, array $values): self
    {
        $this->work_data = array_filter($this->work_data, function($e) use ($key, $values) {

            if (is_object($e)) {
                return in_array($e->$key, $values, true);
            } else {
                return in_array($e[$key], $values, true);
            }
        });

        return $this;
    }

    /**
     * Выборка по условию диапазона [WHERE BETWEEN]
     *
     * @param $key
     * @param float $from
     * @param float $to
     * @return $this
     */
    public function getWhereBetween($key, float $from, float $to): self
    {
        $this->work_data = array_filter($this->work_data, function($e) use ($key, $from) {
            $e_key = is_object($e) ? $e->$key : $e[$key];

            return $e_key >= $from;
        });

        $this->work_data = array_filter($this->work_data, function($e) use ($key, $to) {
            $e_key = is_object($e) ? $e->$key : $e[$key];

            return $e_key <= $to;
        });

        return $this;
    }


    /**
     * Удаление по условию [WHERE]
     *
     * @param $key
     * @param $condition
     * @param null $value
     * @return $this
     */
    public function deleteWhere($key, $condition, $value = null): self
    {
        if (is_null($value)) {

            if (in_array($condition, $this->exceptions, true) && !in_array($condition, $this->conditions, true)) {

                $value     = $condition;
                $condition = $this->def_condition;
            } else if (!in_array($condition, $this->conditions)) {

                $value     = $condition;
                $condition = $this->def_condition;
            }
        }

        $this->work_data = array_filter($this->work_data, function($e) use ($key, $value, $condition) {

            $e_key = is_object($e) ? $e->$key : $e[$key];

            switch ($condition) {

                case '>'  : return $e_key <= $value;
                case '>=' : return $e_key <  $value;
                case '<'  : return $e_key >= $value;
                case '<=' : return $e_key >  $value;
                case '!=' : return in_array($value, $this->exceptions)
                    ? $e_key === $value
                    : $e_key == $value;
                default   : return in_array($value, $this->exceptions)
                    ? $e_key !== $value
                    : $e_key != $value;
            }
        });

        return $this;
    }

    /**
     * Удаление по сравнению с массивом значений [WHERE IN]
     *
     * @param $key
     * @param array $values
     * @return $this
     */
    public function deleteWhereIn($key, array $values): self
    {
        $this->work_data = array_filter($this->work_data, function($e) use ($key, $values) {

            if (is_object($e)) {
                return !in_array($e->$key, $values, true);
            } else {
                return !in_array($e[$key], $values, true);
            }
        });

        return $this;
    }

    /**
     * Удаление по сравнению с массивом значений [WHERE BETWEEN]
     *
     * @param $key
     * @param array $values
     * @return $this
     */
    public function deleteWhereBetween($key, float $from, float $to): self
    {
        $arr_1 = array_filter($this->work_data, function($e) use ($key, $from) {
            $e_key = is_object($e) ? $e->$key : $e[$key];

            return $e_key < $from;
        });

        $arr_2 = array_filter($this->work_data, function($e) use ($key, $to) {
            $e_key = is_object($e) ? $e->$key : $e[$key];

            return $e_key > $to;
        });

        $this->work_data = array_merge($arr_1, $arr_2);

        return $this;
    }


    /**
     * Сбросить ключи от 0 и далее
     *
     * @return $this
     */
    public function resetKeys(): self
    {
        if (is_array($this->work_data)) {
            $this->work_data = array_values($this->work_data);
        }

        return $this;
    }

    /**
     * Пользовательская функция фильтрации
     *
     * @param callable $user_function
     * @return $this
     */
    public function myFilter(callable $user_function): self
    {
        $this->work_data = array_filter($this->work_data, $user_function, ARRAY_FILTER_USE_BOTH);

        return $this;
    }

    /**
     * Перестроить многомерный массив по новому ключу
     *
     * @param array $data
     * @param $key
     * @return $this
     */
    public function reBuildByKey($key): self
    {
        if (is_array(current($this->work_data))) {
            $this->work_data = array_column($this->work_data, NULL, $key);
        }

        return $this;
    }

    /**
     * Вынести из многомерного массива только значения 1 ключа, собрав новый простой массив
     *
     * @param array $data
     * @param $key
     * @return $this
     */
    public function takeOutOneKey($key): self
    {
        $response = [];
        foreach ($this->work_data as $v) {

            if (!is_object($v) && !is_array($v)) {
                return $this;
            }

            if (key_exists($key, $v)) {
                $response[] = $v[$key];
            }
        }

        $this->work_data = $response;

        return $this;
    }

    /**
     * Выборка [SELECT]
     *
     * @param ...$keys
     * @return $this
     */
    public function select(...$keys): self
    {
        $keys = array_map('trim', $keys);
        if (count($keys) < 1 || in_array('*', $keys)) {
            return $this;
        }

        $this->work_data = array_map(function($block) use ($keys) {

            return array_filter($block, function($value, $key) use ($keys) {

                return in_array($key, $keys);
            }, ARRAY_FILTER_USE_BOTH);
        }, $this->work_data);

        return $this;
    }

    /**
     * Обновление данных [UPDATE]
     *
     * @param array $new_data
     * @param $key
     * @param $condition
     * @param $value
     * @return $this
     */
    public function updateWhere(array $new_data, $key, $condition, $value = null): self
    {
        if (is_null($value) && !in_array($condition, $this->conditions)) {

            $value     = $condition;
            $condition = $this->def_condition;
        }

        $target_data = self::instance($this->work_data)
            ->getWhere($key, $condition, $value)
            ->toArray();

        array_walk($target_data, function ($v, $id) use ($new_data) {

            array_walk($new_data, function ($new_value, $key) use ($id, $v) {

                if (key_exists($key, $v)) {
                    $this->work_data[$id][$key] = $new_value;
                }
            });
        });

        return $this;
    }

    /**
     * Вернуть данные, игнорируя первые ХХХ элементов
     *
     * @param int $offset
     * @return $this
     */
    public function offset(int $offset)
    {
        $this->work_data = array_slice($this->work_data, $offset);

        return $this;
    }

    /**
     * Вернуть данные, ограничившись ХХХ кол-вом элементов
     *
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit)
    {
        $this->work_data = array_slice($this->work_data, 0, $limit);

        return $this;
    }

    /**
     * Вернуть данные, игнорируя первые ХХХ элементов, ограничившись YYY кол-вом элементов
     *
     * @param $offset
     * @param $limit
     * @return $this
     */
    public function take($offset, $limit)
    {
        $this->work_data = array_slice($this->work_data, $offset, $limit);

        return $this;
    }

    /**
     * Получить 1ый элемент найденного результата
     *
     * @return $this
     */
    public function first()
    {
        $this->work_data = current(array_slice($this->work_data, 0, 1));

        return $this;
    }

    /**
     * Привести к JSON формату
     *
     * @return false|string
     */
    public function toJson(): string
    {
        return json_encode($this->work_data) ?: '';
    }

    /**
     * Привести к формату массиву
     *
     * @return array
     */
    public function toArray(): array
    {
        if (is_array($this->work_data) || is_object($this->work_data)) {

            return json_decode(json_encode($this->work_data), true) ?: [];
        }

        return [$this->work_data];
    }

    /**
     * Привести к формату обьекту
     *
     * @return object
     */
    public function toObject($arr = NULL): \stdClass
    {
        $data = $arr ?: $this->work_data;
        $data_obj = new \stdClass();

        if (is_array($data) && is_array(current($data))) {

            $new_data = array_map(__METHOD__, $data);
            array_walk($new_data, function($v, $k) use ($data_obj) {
                $data_obj->$k = $v;
            });
        } else {

            is_array($data)
                ? array_walk($data, function ($v, $k) use ($data_obj) {
                $data_obj->$k = $v;
            }) : $data_obj->data = $data;
        }

        return $data_obj;
    }

    /**
     * Привести к массиву обьектов
     *
     * @return array
     */
    public function toArrayOfObjects(): array
    {
        $data = $this->toArray();

        $result = [];
        foreach ($data as $k => $v) {
            $result[$k] = self::instance($v)->toObject();
        }

        return $result;
    }

    /**
     * Проверка на json
     *
     * @param $string
     * @return bool
     */
    private static function isJson($string): bool
    {
        return is_string($string) && is_object(json_decode($string)) || is_array(json_decode($string));
    }
}
