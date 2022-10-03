<div class="p-3 pl-5 mb-2 bg-secondary text-white">Работа с бэнчмарком</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Контроллер / Шаблон</div>
<div class="code_block mb-2">
    <ol>
        <li><span class="comment">// Добавить метку времени с ключом</span></li>
        <li><span class="line_code"><span class="variable">$this</span>->benchmark->addMark(<span class="data">'test_1'</span>);</span></li>
        <li><span class="line_code"><span class="variable">$this</span>->benchmark->addMark(<span class="data">'test_2'</span>);</span></li>
        <li></li>
        <li><span class="comment">// Прошло времени в секундах</span></li>
        <li><span class="line_code"><span class="method">echo</span> <span class="variable">$this</span>->benchmark->elapsedTime(<span class="data">'test_1'</span>, <span class="data">'test_2'</span>);</span></li>
        <li></li>
        <li><span class="comment">// Получить все метки</span></li>
        <li><span class="line_code"><span class="variable">$this</span>->benchmark->calcAndGet();</span></li>
        <li></li>
        <li><span class="comment">// Затрачено памяти на данный момент в МБ</span></li>
        <li><span class="line_code"><span class="variable">$this</span>->benchmark->memoryUse();</span></li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">В любом файле</div>
<div class="code_block mb-2">
    <ol>
        <li><span class="comment">// Добавить метку времени с ключом</span></li>
        <li><span class="line_code"><span class="class">\framework\classes\Benchmark</span>::<span class="method">getInstance()</span>->addMark(<span class="data">'test_1'</span>);</span></li>
        <li><span class="line_code"><span class="class">\framework\classes\Benchmark</span>::<span class="method">getInstance()</span>->addMark(<span class="data">'test_2'</span>);</span></li>
        <li></li>
        <li><span class="comment">// Прошло времени в секундах</span></li>
        <li><span class="line_code"><span class="class">\framework\classes\Benchmark</span>::<span class="method">getInstance()</span>->elapsedTime(<span class="data">'test_1'</span>, <span class="data">'test_2'</span>);</span></li>
        <li></li>
        <li><span class="comment">// Получить все метки</span></li>
        <li><span class="line_code"><span class="class">\framework\classes\Benchmark</span>::<span class="method">getInstance()</span>->calcAndGet();</span></li>
        <li></li>
        <li><span class="comment">// Затрачено памяти на данный момент в МБ</span></li>
        <li><span class="line_code"><span class="class">\framework\classes\Benchmark</span>::<span class="method">getInstance()</span>->memoryUse();</span></li>
    </ol>
</div>