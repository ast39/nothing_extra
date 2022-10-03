<div class="p-3 mb-2 bg-light text-secondary border">Работа с буффером <code>\framework\classes\Buffer</code></div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">В контроллере</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Записать параметр в буффер</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->buffer->key_1 = <span class="data">'some data'</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить параметр из буффера</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->buffer-><span class="data">key_1</span></span>
        </li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">В любом файле</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Укажем, с чем будем работать</span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">use</span> \framework\classes\Buffer;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Записать параметр в буффер</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Buffer</span>::<span class="method">getInstance()</span>->key_1 = <span class="data">'some data'</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить параметр из буффера</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Buffer</span>::<span class="method">getInstance()</span>-><span class="data">key_1</span></span>
        </li>
    </ol>
</div>