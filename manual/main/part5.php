<div class="p-3 pl-5 mb-2 bg-secondary text-white">Новая страница</div>
<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Контроллер</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="line_code"><span class="keywords">namespace</span> app\controllers;</span>
        </li>
        <li></li>
        <li>
            <span class="line_code"><span class="keywords">use</span> framework\classes\Controller;</span>
        </li>
        <li></li>
        <li>
            <span class="line_code"><span class="keywords">class</span> Name* <span class="keywords">extends</span> <span class="class">Controller</span> {</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">public function</span> <span class="method">__construct()</span></span>
        </li>
        <li class="tab1"><span class="line_code">{</span></li>
        <li class="tab2">
            <span class="line_code"><span class="comment">// Если страница доступна после авторизации</span></span>
        </li>
        <li class="tab2">
            <span class="line_code"><span class="variable">$this</span>->auth = <span class="data">true</span>;</span>
        </li>
        <li></li>
        <li class="tab2">
            <span class="line_code"><span class="class">parent</span>::<span class="method">__construct()</span>;</span>
        </li>
        <li class="tab1"><span class="line_code">}</span></li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">public function</span> <span class="method">index()</span>**</span>
        </li>
        <li class="tab1"><span class="line_code">{</span></li>
        <li class="tab2">
            <span class="comment">// здесь пишем код, так же создаем дополнительные методы</span>
        </li>
        <li></li>
        <li class="tab2">
            <span class="comment">// загружаем шаблон</span>
        </li>
        <li class="tab2">
            <span class="line_code"><span class="variable">$this</span>->loadTemplate();</span>
        </li>
        <li class="tab1"><span class="line_code">}</span></li>
        <li><span class="line_code">}</span></li>
    </ol>
</div>

<div class="pl-5 mb-3">
    <small class="text-muted"><code>*</code> - имя файла должно быть таким же</small>
    <br />
    <small class="text-muted"><code>**</code> - дефолтный метод, указанный в конфиге</small>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Шаблон</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="line_code">&lt;head&gt;</span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="comment">// здесь идут все стили и яваскрипт, необъодимые для данной страницы</span></span>
        </li>
        <li>
            <span class="line_code">&lt;/head&gt;</span>
        </li>
        <li>
            <span class="line_code">&lt;body&gt;</span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="comment">// вызов шаблона текущей страницы</span></span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="variable">$this</span>->loadTemplate(<span class="variable">PAGE</span>);</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="comment">// вызов любого шаблона</span></span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="variable">$this</span>->loadTemplate(<span class="data">'modules/test'</span>);</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="comment">// вызов компонента</span></span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="variable">$this</span>->loadComponent(<span class="data">'test'</span>);</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="comment">// вывод языковой переменной</span></span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="variable">$this</span>->langLine(<span class="data">'test'</span>);</span>
        </li>
        <li></li>
        <li class="tab1">
                <span class="line_code"><span class="comment">// далее идет любой код разметки</span></span>
        </li>
        <li>
            <span class="line_code">&lt;/body&gt;</span>
        </li>
</div>

<div class="pl-5 mb-3">
    <small class="text-muted">Здесь так же можно использовать <code>$this->anyone</code></small>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Языковой файл с текстом</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="line_code"><span class="keywords">namespace</span> app\langs\en;</span>
        </li>
        <li>
            <span class="line_code"></span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">use</span> framework\classes\Lang;</span>
        </li>
        <li>
            <span class="line_code"></span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">class</span> EnLang <span class="keywords">extends</span> <span class="class">Lang</span> {</span>
        </li>
        <li>
            <span class="line_code"></span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">protected</span> <span class="variable">$test_1</span> = <span class="data">'Test message 5'</span>;</span>
        </li>
        <li class="tab1">
            <span class="line_code">...</span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">protected</span> <span class="variable">$test_5</span> = <span class="data">'Test message 5'</span>;</span>
        </li>
        <li>
            <span class="line_code">}</span>
        </li>
    </ol>
</div>

<div class="pl-5 mb-3">
    <small class="text-muted">В отдельных файлах языковую переменную получить через <code>$this->langLine('test')</code> не удастся.</small>
    <br />
    <small class="text-muted">Используйте <code>\framework\classes\NE::langLine('test')</code></small>
</div>