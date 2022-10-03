<div class="p-3 mb-2 bg-light text-secondary border">Работа с кэшем <code>\framework\classes\Cacher</code></div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Список возможностей</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Укажем, с чем будем работать</span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">use</span> \framework\classes\Cacher;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Объявим объект класса</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$cache</span> = <span class="keywords">new</span> <span class="class">Cacher()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Сохранить данные в кэш, указав ключ, тэги и экспирацию</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$cache</span>-><span class="method">addItem(<span class="data">'user_list'</span>, <span class="data">'Some data'</span>, <span class="data">['users', 'data']</span>, <span class="data">86400</span>)</span>;</span>
        </li>
        <li></li>

        <li>
            <span class="comment">// Получить данные с кэша по ключу, указав что вернуть, если ключа не существует</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$cache</span>-><span class="method">getItem(<span class="data">'user_list'</span>, <span class="data">'some data'</span>)</span>;</span>
        </li>
        <li></li>

        <li>
            <span class="comment">Проверить, есть ли в кэше такой ключ</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$cache</span>-><span class="method">issetItem(<span class="data">'user_list'</span>)</span>;</span>
        </li>
        <li></li>

        <li>
            <span class="comment">// Удалить данные из кэша по ключу</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$cache</span>-><span class="method">deleteItemByKey(<span class="data">'user_list'</span>)</span>;</span>
        </li>
        <li></li>

        <li>
            <span class="comment">// Удалить данные из кэша по ключам</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$cache</span>-><span class="method">deleteItemsByKeys(<span class="data">['user_list', 'user_adverts']</span>)</span>;</span>
        </li>
        <li></li>

        <li>
            <span class="comment">// Удалить данные из кэша по тэгу</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$cache</span>-><span class="method">deleteItemByTag(<span class="data">'users'</span>)</span>;</span>
        </li>
        <li></li>

        <li>
            <span class="comment">// Удалить данные из кэша по тэгам</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$cache</span>-><span class="method">deleteItemsByTags(<span class="data">['users', 'items']</span>)</span>;</span>
        </li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Пример использования</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Попробуем организовать получение данных по клиенту из БД, кэшируя их на сутки</span>
        </li>
        <li></li>
        <li>
            <span class="line_code"><span class="keywords">use</span> \framework\classes\Cacher;</span>
        </li>
        <li></li>
        <li>
            <span class="line_code"><span class="keywords">function</span> <span class="method">userInfo(<span class="variable">$user_id</span>)</span></span>
        </li>
        <li>
            <span class="line_code">{</span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="variable">$cache</span> = <span class="keywords">new</span> <span class="class">Cacher()</span>;</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">if</span> (<span class="variable">$cache</span>-><span class="method">issetItem(<span class="data">'data_user_'</span> <span class="keywords">.</span> <span class="variable">$user_id</span>)</span>) {</span>
        </li>
        <li class="tab2">
            <span class="line_code"><span class="variable">$user_info</span> = <span class="variable">$cache</span>-><span class="method">getItem(<span class="data">'data_user_'</span> <span class="keywords">.</span> <span class="variable">$user_id</span>)</span>;</span>
        </li>
        <li class="tab1">
            <span class="line_code">} <span class="keywords">else</span> {</span>
        </li>
        <li class="tab2">
            <span class="line_code"><span class="variable">$user_info</span> = <span class="class">DB</span>::<span class="method">connection(<span class="data">'test'</span>)</span></span>
        </li>
        <li class="tab3">
            <span class="line_code">-><span class="method">table(<span class="data">'users'</span>)</span></span>
        </li>
        <li class="tab3">
            <span class="line_code">-><span class="method">where(<span class="data">'id'</span>, <span class="variable">$user_id</span>)</span></span>
        </li>
        <li class="tab3">
            <span class="line_code">-><span class="method">get()</span></span>
        </li>
        <li class="tab3">
            <span class="line_code">-><span class="method">toArray()</span> <span class="keywords">?:</span> <span class="data">[]</span>;</span>
        </li>
        <li></li>
        <li class="tab2">
            <span class="line_code"><span class="variable">$cache</span>-><span class="method">addItem(<span class="data">'data_user_'</span> <span class="keywords">.</span> <span class="variable">$user_id</span>, <span class="variable">$user_info</span>, <span class="data">['user_data']</span>, <span class="data">86400</span>)</span>;</span>
        </li>
        <li class="tab1">
            <span class="line_code">}</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">return</span> <span class="variable">$user_info</span>;</span>
        </li>
        <li>
            <span class="line_code">}</span>
        </li>
    </ol>
</div>