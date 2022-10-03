<div class="card mt-2 ml-5">
    <div class="card-header" style="border-bottom: none !important;">
        <h5>Валидация данных <code>\framework\classes\Validator</code></h5>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td class="text-left"><code>Validator::isInt($data, $min = false, $max = false): bool</code><br />
                Проверка на целое число ОТ и ДО</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::isFloat($data): float</code><br />
                Проверка на число с точкой</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::isBool($data): float</code><br />
                Проверка на true / false</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::isIP($data): float</code><br />
                Проверка на IP адрес</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::isMac($data): float</code><br />
                Проверка на МАК адрес</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::isEmail($data): float</code><br />
                Проверка на email адрес</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::isUrl($data): float</code><br />
                Проверка на URL</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::isLikePattern($data, $pattern): float</code><br />
                Проверка на соответствие шаблону</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::cleanInt($data)</code><br />
                Принудительная типизация к целому числу</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::cleanFloat($data)</code><br />
                Принудительная типизация к числу с плавающей точкой</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::cleanString($data, $notQuores = false)</code><br />
                Принудительная типизация к строке с учетом кавычек или без</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::getInt($data)</code><br />
                Получить целое число из данных</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::getFloat($data)</code><br />
                Получить число с точкой из данных</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::getBool($data)</code><br />
                Получить true / false из данных</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::screeningString($data)</code><br />
                Получить очищенную строку</td>
        </tr>
        <tr>
            <td class="text-left"><code>Validator::encodeUrl($data)</code><br />
                Закодировать URL</td>
        </tr>
        </tbody>
</div>