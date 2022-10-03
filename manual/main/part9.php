<div class="p-3 pl-5 mb-2 bg-secondary text-white">Работа с буффером</div>
<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Контроллер / Шаблон</div>
<div class="code_block mb-2">
    <ol>
        <li><span class="comment">// Записать данные в буффер</span></li>
        <li><span class="line_code"><span class="variable">$this</span>->buffer->test_1 = <span class="data">'Test data 1'</span>;</span></li>
        <li><span class="line_code"><span class="variable">$this</span>->buffer->test_2 = <span class="data">'Test data 2'</span>;</span></li>
        <li></li>
        <li><span class="comment">// Вывести данные из буффера</span></li>
        <li><span class="line_code"><span class="method">echo</span> <span class="variable">$this</span>->buffer->test_1;</span></li>
        <li><span class="line_code"><span class="method">echo</span> <span class="variable">$this</span>->buffer->test_2;</span></li>
    </ol>
</div>


<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">В любом файле</div>
<div class="code_block mb-2">
    <ol>
        <li><span class="comment">// Записать данные в буффер</span></li>
        <li><span class="line_code"><span class="class">\framework\classes\Buffer</span>::<span class="method">getInstance()</span>->test_1 = <span class="data">'Test data 1'</span>;</span></li>
        <li><span class="line_code"><span class="class">\framework\classes\Buffer</span>::<span class="method">getInstance()</span>->test_2 = <span class="data">'Test data 2'</span>;</span></li>
        <li></li>
        <li><span class="comment">// Вывести данные из буффера</span></li>
        <li><span class="line_code"><span class="method">echo</span> <span class="class">\framework\classes\Buffer</span>::<span class="method">getInstance()</span>->test_1;</span></li>
        <li><span class="line_code"><span class="method">echo</span> <span class="class">\framework\classes\Buffer</span>::<span class="method">getInstance()</span>->test_2;</span></li>
    </ol>
</div>