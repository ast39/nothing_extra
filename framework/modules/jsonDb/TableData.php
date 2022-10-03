<?php

namespace modules\jsonDb;


/**
 * Table object
 */
class TableData {

    /**
     * Default index for tables
     */
    const INDEX_KEY = 'id';

    /**
     * Table name
     *
     * @var
     */
    private $table_name;

    /**
     * Image of table data
     *
     * @var mixed
     */
    private $image;

    /**
     * Path to table file
     *
     * @return void
     */
    private $path;

    /**
     * Table index
     *
     * @var string
     */
    private $index = 'id';


    /**
     * Read data from table file
     *
     * @param string $path
     * @param string $data
     */
    public function __construct(string $table, string $path, string $data)
    {
        $this->table_name = $table;
        $this->index      = Config::$db_index[$this->table_name] ?? self::INDEX_KEY;

        $this->path = $path;
        $image      = json_decode($data, true);

        if (is_array($image)) {
            foreach ($image as $item) {
                $this->image[$item[$this->index]] = $item;
            }
        }
    }

    /**
     * Get table keys
     *
     * @return array
     */
    public function keys(): array
    {
        return array_keys(current($this->image ?: []) ?: []);
    }

    /**
     * Get count of data rows
     *
     * @return int
     */
    public function count(): int
    {
        return count(is_array($this->image) ? $this->image : []);
    }

    /**
     * Get table data
     *
     * @return array|null
     */
    public function data():? array
    {
        return $this->image ?: null;
    }

    /**
     * Add row data to table
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        if (!$this->integrityKeys($data)) {
            return false;
        }

        $this->image[] = $data;

        return true;
    }

    /**
     * Read one row data from table
     *
     * @param string $uid
     * @return array|null
     */
    public function read(string $uid):? array
    {
        return $this->image[$uid] ?? null;
    }

    /**
     * Update row data
     *
     * @param string $uid
     * @param array $data
     * @return bool
     */
    public function update(string $uid, array $data): bool
    {
        if (!key_exists($uid, $this->image)) {
            return false;
        }

        $counter = 0;
        foreach ($data as $key => $value) {
            if (in_array($key, $this->keys())) {
                $this->image[$uid][$key] = $value;
                $counter++;
            }
        }

        return $counter > 0;
    }

    /**
     * Remove row data from table
     *
     * @param string $uid
     * @return void
     */
    public function delete(string $uid): void
    {
        if ($this->image[$uid] ?? false) {
            unset($this->image[$uid]);
        }
    }

    /**
     * Получить имя таблицы
     *
     * @return string
     */
    public function name(): string
    {
        return $this->table_name;
    }

    /**
     * Check keys to in new data to integrity
     *
     * @param $data
     * @return bool
     */
    private function integrityKeys($data): bool
    {
        $table_keys = $this->keys();
        $data_keys  = array_keys($data);

        if (count($table_keys) < 1) {
            return true;
        }

        if (count($table_keys) != count($data_keys)) {
            return false;
        }

        foreach ($data_keys as $key) {
            if (!in_array($key, $table_keys)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Save data to table file
     */
    public function __destruct()
    {
        if ($this->image !== null) {
            file_put_contents($this->path, json_encode(array_values($this->image), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));
        }
    }

}
