<?php


namespace framework\modules\storage;


class Storage {

    public static function disk(string $name)
    {
        $settings = include __DIR__ . '/cfg.php';

        return new Disk($settings[$name] ?? 'public');
    }
}
