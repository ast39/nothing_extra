<div class="card mt-2 ml-5">
    <div class="card-header" style="border-bottom: none !important;">
        <h5>Данные Request и их очистка <code>\framework\classes\Request</code></h5>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td class="text-left"><code>Request::issetAnyWhere($index)</code><br />
                Есть ли ключ в Request</td>
        </tr>
        <tr>
            <td class="text-left"><code>Request::issetPost($index)</code><br />
                Есть ли ключ в POST</td>
        </tr>
        <tr>
            <td class="text-left"><code>Request::issetGet($index)</code><br />
                Есть ли ключ в GET</td>
        </tr>
        <tr>
            <td class="text-left"><code>Request::issetFile($index)</code><br />
                Существует ли файл</td>
        </tr>
        <tr>
            <td class="text-left"><code>Request::request($index, $type = 's', $default = false)</code><br />
                Получить данные по ключу из REQUEST, указав тип и дефолтное значение</td>
        </tr>
        <tr>
            <td class="text-left"><code>Request::post($index, $type = 's', $default = false)</code><br />
                Получить данные по ключу из POST, указав тип и дефолтное значение</td>
        </tr>
        <tr>
            <td class="text-left"><code>Request::get($index, $type = 's', $default = false)</code><br />
                Получить данные по ключу из GET, указав тип и дефолтное значение</td>
        </tr>
        <tr>
            <td class="text-left"><code>Request::file($index)</code><br />
                Получить данные из файла по ключу</td>
        </tr>
        <tr>
            <td class="text-left"><code>Request::q($part = false)</code><br />
                Получить данные QUERY из URL (переданные параметры)</td>
        </tr>
        <tr>
            <td class="text-left"><code>Request::clean($str, $type = 's', $xss = false)</code><br />
                Очитска данных от инъекций  с указанием типа данных, с возможностью очистки от XSS</td>
        </tr>
        </tbody>
</div>