<div class="p-3 mb-2 bg-secondary text-white">Системные библиотеки <code><a class="text-warning" href="/manual/index.php?part=<?= $_GET['part'] ?>">\framework\classes</a></code></div>
<?php if (isset($_GET['add'])): ?>
    <?php include_once __DIR__ . "/../dir12/part" . $_GET['add'] . ".php"; ?>
<?php else: ?>
    <table class="table">
        <tbody>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1201">\framework\classes\Benchmark</a></code></td>
            <td class="text-left">Класс для профилирования времени загрузки разных частей приложения</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1202">\framework\classes\Buffer</a></code></td>
            <td class="text-left">Класс для хранения и переноса информации</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1203">\framework\classes\Cacher</a></code></td>
            <td class="text-left">Класс для кэширования информации</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1204">\framework\classes\Component</a></code></td>
            <td class="text-left">Класс, запускающий компонент</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1205">\framework\classes\Controller</a></code></td>
            <td class="text-left">Основной класс, запускающий выполнение страницы</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1206">\framework\classes\Lang</a></code></td>
            <td class="text-left">Класс вывода нужной языковой переменной</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1207">\framework\classes\Log</a></code></td>
            <td class="text-left">Класс работы с логированием</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1208">\framework\classes\Route</a></code></td>
            <td class="text-left">Класс работы с URL</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1210">\framework\classes\SiteIndexing</a></code></td>
            <td class="text-left">Класс определения юера, браузера, устройства и т.д.</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1214">\framework\classes\SystemMessage</a></code></td>
            <td class="text-left">Класс работы с уведомлениями</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1211">\framework\classes\SoapNative</code></td>
            <td class="text-left">Класс для расширения работы с Soap Client</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1301">\framework\classes\DataBuilder</a></code></td>
            <td class="text-left">Класс работы с данными</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1302">\framework\classes\Censure</a></code></td>
            <td class="text-left">Класс цензуры текста</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1303">\framework\classes\Crypt</a></code></td>
            <td class="text-left">Класс шифрования / дешифрования</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1304">\framework\classes\CSV</a></code></td>
            <td class="text-left">Класс получения / записи данных в CSV файлы</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1305">\framework\classes\Date</a></code></td>
            <td class="text-left">Класс работы с датой и временем</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1307">\framework\classes\RegExp</a></code></td>
            <td class="text-left">Класс для валидации по <code>RegExp</code></td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1308">\framework\classes\Request</a></code></td>
            <td class="text-left">Класс для безопасного получения <code>Request</code> данных</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1309">\framework\classes\Session</a></code></td>
            <td class="text-left">Класс для простой работы с сессией</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1310">\framework\classes\Text</a></code></td>
            <td class="text-left">Класс для работы с текстом</td>
        </tr>
        <tr>
            <td class="text-left"><code><a class="text-primary" href="/manual/index.php?part=<?= $_GET['part'] ?>&add=1311">\framework\classes\Validator</a></code></td>
            <td class="text-left">Класс валидации по <code>filter_var()</code></td>
        </tr>
        </tbody>
    </table>
<?php endif; ?>