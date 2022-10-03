<?php


namespace framework\modules\storage;


class DataType {

    /**
     * Data for convert to target type
     *
     * @var array
     */
    protected $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * As string
     *
     * @return string
     */
    public function toText(): string
    {
        return implode(PHP_EOL, $this->data);
    }

    /**
     * As array by lines
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function($e) {

            return
                isJson($e)
                    ? json_decode($e, true)
                    : $e;
        }, $this->data);
    }

    /**
     * As array of objects
     *
     * @return array
     */
    public function toArrayOfObjects(): array
    {
        return array_map(function($e) {

            $data = isJson($e)
                ? json_decode($e, true)
                : $e;

            $class = new \stdClass();
            foreach ($data as $var => $value) {
                $class->$var = $value;
            }

            return $class;
        }, $this->data);
    }

    /**
     * As JSON from array by lines
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
