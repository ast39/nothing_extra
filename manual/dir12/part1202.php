<div class="p-3 mb-2 bg-light text-secondary border">Работа с буффером <code>\framework\classes\Buffer</code></div>

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
            <span class="line_code">
                <span class="class">Buffer</span>::<span class="method">getInstance()</span>-><span class="method">set</span>(<span class="comment">key</span> '<span class="variable">foo</span>',
                <span class="comment">value</span> '<span class="data">bar</span>');
            </span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить параметр из буффера (вариан 1)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Buffer</span>::<span class="method">getInstance()</span>-><span class="method">get</span>(<span class="comment">key</span> '<span class="variable">foo</span>');</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить параметр из буффера (вариант 2)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Buffer</span>::<span class="method">getInstance()</span>-><span class="variable">key_1</span>;</span>
        </li>
    </ol>
</div>