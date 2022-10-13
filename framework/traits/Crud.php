<?php

namespace framework\traits;

require_once BASE_DIR . 'cfg/db.php';

use Illuminate\Database\Capsule\Manager as DB;
use framework\classes\DataBuilder;


trait Crud {

    protected $db_connection;
    protected $db_table;
    protected $db_id_key;

    protected $sortable;
    protected $sort_desc;

    protected $data = [];


    public function __construct($connection, $table, $id_key, $sortable = false, bool $sort_desc = false)
    {
        $this->db_connection = $connection;
        $this->db_table = $table;
        $this->db_id_key = $id_key;

        $this->sortable = $sortable ?: $this->db_id_key;
        $this->sort_desc = $sort_desc;

        $this->sync();
    }

    /**
     * CREATE data
     *
     * @param array $add_data
     * @return bool
     */
    public function create(array $add_data): bool
    {
        DB::connection($this->db_connection)
            ->table($this->db_table)
            ->insert($add_data);

        $this->sync();

        return true;
    }

    /**
     * READ data (single)
     *
     * @param int $id
     * @return \stdClass
     */
    public function read(int $id): \stdClass
    {
        $objects = DataBuilder::instance($this->data)
            ->getWhere($this->db_id_key, '=', $id)
            ->toArrayOfObjects();

        if (count($objects) > 0) {
            return reset($objects);
        }

        return new \stdClass();
    }

    /**
     * UPDATE data
     *
     * @param int $id
     * @param array $edit_data
     * @return bool
     */
    public function update(int $id, array $edit_data): bool
    {
        if (!property_exists($this->read($id), $this->db_id_key)) {
            return false;
        }

        DB::connection($this->db_connection)
            ->table($this->db_table)
            ->where($this->db_id_key, $id)
            ->update($edit_data);

        $this->sync();

        return true;
    }

    /**
     * DELETE data
     *
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        if (!property_exists($this->read($id), $this->db_id_key)) {
            return false;
        }

        DB::connection($this->db_connection)
            ->table($this->db_table)
            ->where($this->db_id_key, $id)
            ->delete();

        $this->sync();

        return true;
    }

    /**
     * READ data (all)
     *
     * @return array
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * CHECK to DOUBLE data
     *
     * @param array $where_data
     * @return bool
     */
    public function isDouble(array $where_data): bool
    {
        $user = DB::connection($this->db_connection)
            ->table($this->db_table);

        foreach ($where_data as $key => $value) {
            $user = $user->where($key, $value);
        }

        $user = $user->first() ?: NULL;

        if ($user !== NULL) {
            return true;
        }

        return false;
    }

    /**
     * @return void
     */
    protected function sync(): void
    {
        $this->data = DB::connection($this->db_connection)
            ->table($this->db_table)
            ->select('*')
            ->orderBy($this->sortable, $this->sort_desc ? 'desc' : 'asc')
            ->get()
            ->toArray() ?: [];
    }
}
