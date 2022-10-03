<div class="p-3 mb-2 bg-light text-secondary border">Контроль ресурсов и таймингов <code>\framework\classes\Benchmark</code></div>

<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Укажем, с чем будем работать</span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">use</span> \framework\classes\Benchmark;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Добавить метку времени</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Benchmark</span>::<span class="method">getInstance()</span>->addMark(<span class="data">'point_1'</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Узнать кол-во используемой ОЗУ</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Benchmark</span>::<span class="method">getInstance()</span>->memoryUse();</span></li>
        <li></li>
        <li>
            <span class="comment">// Показать таблицу таймингов загрузки проекта</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Benchmark</span>::<span class="method">getInstance()</span>->calcAndGet();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Показать тайминг между 2мя сохраненными метками, указав кол-во знаков после запятой для времени</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Benchmark</span>::<span class="method">getInstance()</span>->elapsedTime(<span class="data">'point_1'</span>, <span class="data">'point_2'</span>, <span class="data">4</span>);</span></li>
        <li></li>
        <li>
            <span class="comment">// Получить любую сохраненную метку</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Benchmark</span>::<span class="method">getInstance()</span>->point_1</span>
        </li>
    </ol>
</div>