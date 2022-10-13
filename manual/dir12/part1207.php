<div class="p-3 mb-2 bg-light text-secondary border">Класс работы с логированием <code>\framework\classes\Log</code></div>
<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">\config\sys.php</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Укажем директрию для логов</span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">public static</span> <span class="variable">$log_dir</span> = <span class="data">'tmp\logs'</span>;</span>
        </li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Контроллер / Шаблон</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Добавляем запись в лог</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->log->appendLog(<span class="data">'test_log'</span>, <span class="data">'Some text'</span> . <span class="variable">PHP_EOL</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить записи из лога по имени</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->log->showLog(<span class="data">'test_log'</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Сохраняем изменения в лог-файл</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->log->saveLog(<span class="data">'test_log'</span>, <span class="data">'log_file_name.txt'</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Читаем лог-файл</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->log->readLog(<span class="data">'test_log'</span>, <span class="data">true</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Очищаем файл лога</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->log->cleanLog(<span class="data">'test_log'</span>);</span>
        </li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">В любом файле</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Добавляем запись в лог</span>
        </li>
        <li>
            <span class="line_code"><span class="class">\framework\classes\Log</span>::<span class="method">getInstance()</span>->appendLog(<span class="data">'test_log'</span>, <span class="data">'Some text'</span> . <span class="variable">PHP_EOL</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить записи из лога по имени</span>
        </li>
        <li>
            <span class="line_code"><span class="class">\framework\classes\Log</span>::<span class="method">getInstance()</span>->showLog(<span class="data">'test_log'</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Сохраняем изменения в лог-файл</span>
        </li>
        <li>
            <span class="line_code"><span class="class">\framework\classes\Log::</span>::<span class="method">getInstance()</span>->saveLog(<span class="data">'test_log'</span>, <span class="data">'log_file_name.txt'</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Читаем лог-файл</span>
        </li>
        <li>
            <span class="line_code"><span class="class">\framework\classes\Log::</span>::<span class="method">getInstance()</span>->readLog(<span class="data">'test_log'</span>, <span class="data">true</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Очищаем файл лога</span>
        </li>
        <li>
            <span class="line_code"><span class="class">\framework\classes\Log::</span>::<span class="method">getInstance()</span>->cleanLog(<span class="data">'test_log'</span>);</span>
        </li>
    </ol>
</div>