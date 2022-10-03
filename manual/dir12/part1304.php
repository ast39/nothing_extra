<div class="card mt-2 ml-5">
    <div class="card-header" style="border-bottom: none !important;">
        <h5>Работа с CSV файлами <code>\framework\classes\CSV</code></h5>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td class="text-left"><code>CSV::keys($file)</code><br />
                Получить ключи виртуальной таблицы файла</td>
        </tr>
        <tr>
            <td class="text-left"><code>CSV::read($file)</code><br />
                Прочитать файл в виде массива</td>
        </tr>
        <tr>
            <td class="text-left"><code>CSV::save($file, array $data)</code><br />
                Создать файл и заполнить строками</td>
        </tr>
        <tr>
            <td class="text-left"><code>CSV::append($file, array $data)</code><br />
                Добавить строки в файл</td>
        </tr>
        <tr>
            <td class="text-left"><code>CSV::delete($file, $key, $value)</code><br />
                Удалить строку из файла по ключу и значению</td>
        </tr>
        </tbody>
</div>