<?php

namespace framework\classes;


class SystemMessage {

    /**
     * Добавить сообщение в реестр
     *
     * @param string $msg_key
     * @param string $message
     * @param int $type
     * @param bool $append
     * @return void
     */
    public static function setMsg(string $msg_key, string $message, int $type = MSG_DEFAULT, bool $append = false): void
    {
        self::checkIsset();

        $current_value      = Buffer::getInstance()->system_msg;
        $current_value_msg  = $current_value[self::getKeyType($type)][$msg_key] ?? null;

        if ($current_value_msg === null) {
            $current_value[self::getKeyType($type)][$msg_key] = [$message];
        } else {
            $append === true
                ? $current_value[self::getKeyType($type)][$msg_key][] = $message
                : $current_value[self::getKeyType($type)][$msg_key] = [$message];
        }

        Buffer::getInstance()->set('system_msg', $current_value);
    }

    /**
     * Получить сообщение из реестра
     *
     * @param string $msg_key
     * @param int $type
     * @return array
     */
    public static function getMsg(string $msg_key, int $type = MSG_DEFAULT): array
    {
        self::checkIsset();

        return Buffer::getInstance()->system_msg[self::getKeyType($type)][$msg_key] ?? [];
    }

    /**
     * Получить все сообщения одного типа из реестра
     *
     * @param int $type
     * @return array
     */
    public static function getAllMsg(int $type = MSG_DEFAULT): array
    {
        static::checkIsset();

        return Buffer::getInstance()->system_msg[self::getKeyType($type)] ?? [];
    }

    /**
     * Получить все сообщения из реестра
     *
     * @return array
     */
    public static function getAllMessages(): array
    {
        $errors   = self::getAllMsg(MSG_ERROR);
        $warnings = self::getAllMsg(MSG_WARNING);
        $success  = self::getAllMsg(MSG_SUCCESS);
        $default  = self::getAllMsg(MSG_DEFAULT);

        if (count($errors) == 0 && count($warnings) == 0 && count($success) == 0 && count($default) == 0) {
            return [];
        }

        return [

            'error'   => $errors,
            'warning' => $warnings,
            'success' => $success,
            'default' => $default,
        ];
    }

    /**
     * Сохранить сообщения в сессию (перед редиректом)
     *
     * @return void
     */
    public static function saveMessages(): void
    {
        if (($sm = SystemMessage::getAllMessages()) !== null) {
            Session::set($sm, '_system_messages_');
        }
    }

    /**
     * Удалить сообщения из сессии
     *
     * @return void
     */
    public static function clean(): void
    {
        if (SystemMessage::getAllMessages() !== null) {
            Session::remove('_system_messages_');
        }
    }

    /**
     * Восстанавливает сообщения, если таковые были в сессии
     *
     * @return void
     */
    public static function recoveryMessages(): void
    {
        if  ($sm = Session::get('_system_messages_')) {

            foreach (($sm['error'] ?? []) as $key => $msg_data) {

                array_walk($msg_data, function($msg) use ($key) {
                    self::setMsg($key, $msg, MSG_ERROR, true);
                });
            }

            foreach (($sm['warning'] ?? []) as $key => $msg_data) {

                array_walk($msg_data, function($msg) use ($key) {
                    self::setMsg($key, $msg, MSG_WARNING, true);
                });
            }

            foreach (($sm['success'] ?? []) as $key => $msg_data) {

                array_walk($msg_data, function($msg) use ($key) {
                    self::setMsg($key, $msg, MSG_SUCCESS, true);
                });
            }

            foreach (($sm['default'] ?? []) as $key => $msg_data) {

                array_walk($msg_data, function($msg) use ($key) {
                    self::setMsg($key, $msg, MSG_DEFAULT, true);
                });
            }

            Session::remove('_system_messages_');
        }
    }

    /**
     * Получить сообщение и вывести в дизайне
     *
     * @param string $msg_key
     * @param int $type
     * @param bool $rounded
     * @return void
     */
    public static function showMsg(string $msg_key, int $type = MSG_DEFAULT, bool $rounded = false): void
    {
        $msg_data = self::getMsg($msg_key, $type);
        if ($msg_data !== null) {

            ob_start();?>
            <?php foreach ($msg_data as $msg): ?>
                <div class="mt-3 p-2 bg-<?= self::getColorType($type) ?> text-white text-center <?= $rounded ? 'rounded' : '' ?>"><?= $msg ?></div>
            <?php endforeach; ?>
            <?= ob_get_clean();
        }
    }

    /**
     * Системная функция проверки целостности данных
     *
     * @return void
     */
    private static function checkIsset(): void
    {
        if (Buffer::getInstance()->system_msg === NULL) {

            Buffer::getInstance()->set('system_msg', [
                'error'   => [],
                'warning' => [],
                'success' => [],
                'default' => [],
            ]);
        }
    }

    /**
     * Ключ массива по типу сообщения
     *
     * @param int $type
     * @return string
     */
    private static function getKeyType(int $type): string
    {
        switch ($type) {

            case 1  : return 'success';
            case 2  : return 'warning';
            case 3  : return 'error';
            default : return 'default';
        }
    }

    /**
     * Получить цвет по типу сообщения
     *
     * @param $type
     * @return string
     */
    private static function getColorType($type): string
    {
        switch ($type) {

            case 1  : return 'success';
            case 2  : return 'warning';
            case 3  : return 'danger';
            default : return 'secondary';
        }
    }
}
