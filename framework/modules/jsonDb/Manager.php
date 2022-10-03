<?php

namespace modules\jsonDb;


class Manager {

    /**
     * Instance of manager
     *
     * @var null
     */
    private static $instance = null;

    /**
     * Temp copy of image
     *
     * @var TableData
     */
    private $image;

    /**
     * Copy image to manager
     *
     * @param TableData $image
     */
    private function __construct (TableData $image)
    {
        $this->image = $image;
    }

    /**
     * Create image in memory
     *
     * @param TableData $image
     * @return static
     */
    public static function build(TableData $image): self
    {
        if(is_null(self::$instance))
        {
            self::$instance = new self($image);
        }

        return self::$instance;
    }

    /**
     * Add new data rows to table
     *
     * @param array $data
     * @return $this
     */
    public function create(array $data): Manager
    {
        if (is_array($data[0] ?? null)) {

            array_walk($data, function($e) {
                $this->image->create($e);
            });
        } else {
            $this->image->create($data);
        }

        return $this;
    }

    /**
     * Get one data row from table
     *
     * @param string|null $uid
     * @return array|null
     */
    public function read(?string $uid = null):? array
    {
        return
            $uid === null
                ? $this->image->data()
                : $this->image->read($uid);
    }

    /**
     * Update one data roe in table
     *
     * @param string $uid
     * @param array $data
     * @return $this
     */
    public function update(string $uid, array $data): Manager
    {
        $this->image->update($uid, $data);

        return $this;
    }

    /**
     * Delete one data row from table
     *
     * @param string $uid
     * @return $this
     */
    public function delete(string $uid): Manager
    {
        $this->image->delete($uid);

        return $this;
    }

    public function __call(string $name, array $params)
    {
        return call_user_func_array([$this->image, $name], $params);
    }
}
