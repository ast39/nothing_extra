<div class="p-3 pl-5 mb-2 bg-secondary text-white">Работа с хранилищем</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Контроллер / Шаблон</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Укажем, с чем будем работать</span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">use</span> framework\modules\Storage;</span>
        </li>
        <li></li>
        <li><span class="comment">// Получить инстанс хранилища</span></li>
        <li><span class="line_code"><span class="class">Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>);</span></li>
        <li></li>
        <li><span class="comment">// Проверить наличие ресурса в хранилище</span></li>
        <li><span class="line_code"><span class="class">Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">exists</span>(<span class="data">'test'</span>);</span></li>
        <li></li>
        <li><span class="comment">// Добавить информацию в хранилище</span></li>
        <li><span class="line_code"><span class="class">Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">put</span>(<span class="data">'test'</span>, <span class="method">json_encode</span>(<span class="variable">$array</span>));</span></li>
        <li></li>
        <li><span class="comment">// Обновить информацию в хранилище</span></li>
        <li><span class="line_code"><span class="class">Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">append</span>(<span class="data">'test'</span>, <span class="method">json_encode</span>(<span class="variable">$array</span>));</span></li>
        <li></li>
        <li><span class="comment">// Получить информацию из хранилища как строку</span></li>
        <li><span class="line_code"><span class="class">Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">get</span>(<span class="data">'test'</span>)-><span class="method">toText()</span>;</span></li>
        <li></li>
        <li><span class="comment">// Получить информацию из хранилища как масиив</span></li>
        <li><span class="line_code"><span class="class">Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">get</span>(<span class="data">'test'</span>)-><span class="method">toArray()</span>;</span></li>
        <li></li>
        <li><span class="comment">// Получить информацию из хранилища как массив объектов</span></li>
        <li><span class="line_code"><span class="class">Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">get</span>(<span class="data">'test'</span>)-><span class="method">toArrayOfObjects()</span>;</span></li>
        <li></li>
        <li><span class="comment">// Получить информацию как jSon объект</span></li>
        <li><span class="line_code"><span class="class">Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">get</span>(<span class="data">'test'</span>)-><span class="method">toJson()</span>;</span></li>
        <li></li>
        <li><span class="comment">// Удалить информацию из хранилища</span></li>
        <li><span class="line_code"><span class="class">Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">delete</span>(<span class="data">'test'</span>);</span></li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">В любом файле</div>
<div class="code_block mb-2">
    <ol>
        <li></li>
        <li><span class="comment">// Получить инстанс хранилища</span></li>
        <li><span class="line_code"><span class="class">\framework\modules\Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>);</span></li>
        <li></li>
        <li><span class="comment">// Проверить наличие ресурса в хранилище</span></li>
        <li><span class="line_code"><span class="class">\framework\modules\Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">exists</span>(<span class="data">'test'</span>);</span></li>
        <li></li>
        <li><span class="comment">// Добавить информацию в хранилище</span></li>
        <li><span class="line_code"><span class="class">\framework\modules\Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">put</span>(<span class="data">'test'</span>, <span class="method">json_encode</span>(<span class="variable">$array</span>));</span></li>
        <li></li>
        <li><span class="comment">// Обновить информацию в хранилище</span></li>
        <li><span class="line_code"><span class="class">\framework\modules\Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">append</span>(<span class="data">'test'</span>, <span class="method">json_encode</span>(<span class="variable">$array</span>));</span></li>
        <li></li>
        <li><span class="comment">// Получить информацию из хранилища как строку</span></li>
        <li><span class="line_code"><span class="class">\framework\modules\Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">get</span>(<span class="data">'test'</span>)-><span class="method">toText()</span>;</span></li>
        <li></li>
        <li><span class="comment">// Получить информацию из хранилища как масиив</span></li>
        <li><span class="line_code"><span class="class">\framework\modules\Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">get</span>(<span class="data">'test'</span>)-><span class="method">toArray()</span>;</span></li>
        <li></li>
        <li><span class="comment">// Получить информацию из хранилища как массив объектов</span></li>
        <li><span class="line_code"><span class="class">\framework\modules\Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">get</span>(<span class="data">'test'</span>)-><span class="method">toArrayOfObjects()</span>;</span></li>
        <li></li>
        <li><span class="comment">// Получить информацию из хранилища как jSon</span></li>
        <li><span class="line_code"><span class="class">\framework\modules\Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">get</span>(<span class="data">'test'</span>)-><span class="method">toJson()</span>;</span></li>
        <li></li>
        <li><span class="comment">// Удалить информацию из хранилища</span></li>
        <li><span class="line_code"><span class="class">\framework\modules\Storage</span>::<span class="method">disk</span>(<span class="data">'public'</span>)-><span class="method">delete</span>(<span class="data">'test'</span>);</span></li>
    </ol>
</div>