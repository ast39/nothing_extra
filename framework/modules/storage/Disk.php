<?php


namespace framework\modules\storage;


class Disk {

    /**
     * Массив пути к файлу хранилища
     *
     * @var array
     */
    protected $parts = [];

    public function __construct(string $settings)
    {
        $this->parts = explode('.', $settings);
    }

    /**
     * If file exist in the storage
     *
     * @param string $file_name
     * @return bool
     */
    public function exists(string $file_name): bool
    {
        $file_name = $this->parseFileName($file_name);

        return file_exists($this->getFullPath($file_name));
    }


    public function get(string $file_name)
    {
        $file_name = $this->parseFileName($file_name);

        if (!$this->exists($file_name)) {
            return false;
        }

        return new DataType(file($this->getFullPath($file_name)));
    }

    /**
     * Save data into the storage
     *
     * @param string $file_name
     * @param string $data
     * @return bool
     */
    public function put(string $file_name, $data): bool
    {
        $file_name = $this->parseFileName($file_name);

        if ($this->exists($file_name)) {
            return false;
        }

        $this->tryCreatePath($file_name);

        if (is_array($data)) {
            $data = json_encode($data);
        }

        file_put_contents($this->getFullPath($file_name), $data . PHP_EOL);

        return true;
    }

    /**
     * Append file in the storage with data
     *
     * @param string $file_name
     * @param string $data
     * @return bool
     */
    public function append(string $file_name, $data): bool
    {
        $file_name = $this->parseFileName($file_name);

        if (!$this->exists($file_name)) {
            return false;
        }

        if (is_array($data)) {
            $data = json_encode($data);
        }

        file_put_contents($this->getFullPath($file_name), $data . PHP_EOL, FILE_APPEND);

        return true;
    }

    /**
     * Delete file in the storage
     *
     * @param string $file_name
     * @return bool
     */
    public function delete(string $file_name): bool
    {
        $file_name = $this->parseFileName($file_name);

        if (!$this->exists($file_name)) {
            return false;
        }

        $tmp_link = $this->getFullPath($file_name);
        $parts    = explode('/', $file_name);
        $parts    = array_reverse($parts);

        foreach ($parts as $part) {

            if (file_exists($tmp_link) && is_writable($tmp_link)) {
                is_dir($tmp_link)
                    ? rmdir($tmp_link)
                    : unlink($tmp_link);

                $tmp_link = dirname($tmp_link);
            } else {

                return false;
            }
        }

        return true;
    }

    /**
     * Get full path to file from ROOT DIR
     *
     * @param string $file_name
     * @return string
     */
    private function getFullPath(string $file_name): string
    {
        return ROOT . 'storage/'. implode('/', $this->parts) . '/' . $file_name . '.st';
    }

    /**
     * Dot to slash in path
     *
     * @param string $file_name
     * @return string
     */
    private function parseFileName(string $file_name): string
    {
        return str_replace('.', '/', $file_name);
    }

    /**
     * Try to create dirs to path
     *
     * @param string $file_name
     * @return void
     */
    private function tryCreatePath($file_name): void
    {
        $parts    = explode('/', $file_name);
        $tmp_link = ROOT . 'storage/'. implode('/', $this->parts);

        foreach ($parts as $k => $part) {
            $tmp_link .= '/' . $part;

            if (!file_exists($tmp_link)) {

                if (($k + 1) < count($parts) && is_writable(dirname($tmp_link))) {
                    mkdir($tmp_link);
                }
            }
        }
    }
}
