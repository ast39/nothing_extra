<?php


namespace framework\classes;


class Text {

    const ENCODING = 'utf-8';

    /**
     * Есть ли кириллица в тексте
     *
     * @param string $string
     * @return bool
     *
     * @example cyrillicInText('Привет');
     */
    public static function cyrillicInText(string $string): bool
    {
        return preg_match("/[а-я]/i", $string);
    }

    /**
     * Обрезать длинный текст
     *
     * @param string $string
     * @param int $length
     * @return string
     *
     * @example cutTextTo('Привет, мир, это моя первая статья', 16);
     */
    public static function cutTextTo(string $string, int $length):  string
    {
        $arr_string = explode(' ', $string);
        $cut_string = '';

        foreach ($arr_string as $word) {

            if (mb_strlen($cut_string . $word, self::ENCODING) >= $length) {
                return $cut_string . '...';
            }

            $cut_string .= $word . ' ';
        }

        return $string;
    }

    /**
     * Подставить верное окончание для существительного, определяемого кол-вом
     *
     * @param int $count
     * @param array $endings (for 1, 2-4, 5+)
     * @return string
     *
     * @example wordEndingCorrection(24, ['яйцо', 'яйца', 'яиц']);
     */
    public static function wordEndingCorrection(int $count, array $endings): string
    {
        $cases = [2, 0, 1, 1, 1, 2];

        return $endings[
            ($count % 100 > 4 && $count % 100 < 20)
                ? 2
                : $cases[min($count % 10, 5)]
            ];
    }

    /**
     * Транслит в обе стороны
     *
     * @param string $text
     * @param string $langs
     * @param int $case
     * @param array $additions
     * @return string
     *
     * @example translit('Моя статья 11', 'ru_en', -1, [' ' => '_']);
     */
    public static function translit(string $text, string $langs, int $case = 0, array $additions = []): string
    {
        $chars = [
            'ru' => [
                'ё', 'ж', 'ц', 'ч', 'ш', 'щ', 'ю', 'я', 'а', 'б', 'в',
                'г', 'д', 'е',  'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о',
                'п', 'р', 'с', 'т', 'у', 'ф', 'х',  'ъ', 'ы', 'ь', 'э',
                'Ё', 'Ж', 'Ц', 'Ч', 'Ш', 'Щ', 'Ю', 'Я', 'А', 'Б', 'В',
                'Г', 'Д', 'Е',  'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О',
                'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ъ', 'Ы', 'Ь', 'Э',
            ],
            'en' => [
                'yo', 'zh', 'ts', 'ch', 'sh', 'sch', 'yu', 'ya', 'a', 'b', 'v',
                'g', 'd', 'e',  'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o',
                'p', 'r', 's', 't', 'u', 'f', 'h',  '', 'y', '', 'e',
                'YO', 'ZH', 'TS', 'CH', 'SH', 'SCH', 'YU', 'YA', 'A', 'B', 'V',
                'G', 'D', 'E',  'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
                'P', 'R', 'S', 'T', 'U', 'F', 'H', '', 'Y', '', 'E',
            ],
        ];

        $langs = explode('_', $langs);
        if (count($langs) != 2) {
            return $text;
        }

        $from = strtolower($langs[0]);
        $to   = strtolower($langs[1]);
        if (!isset($chars[$from]) || !isset($chars[$to])) {
            return $text;
        }

        if (count($additions) > 0) {

            $chars[$from] = array_merge($chars[$from], array_keys($additions));
            $chars[$to]   = array_merge($chars[$to], array_values($additions));
        }

        $text = str_replace($chars[$from], $chars[$to], $text);

        if ($case > 0) {
            $text = mb_strtoupper($text, self::ENCODING);
        } elseif ($case < 0) {
            $text = mb_strtolower($text, self::ENCODING);
        }

        return $text;
    }
}
