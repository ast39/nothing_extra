<div class="p-3 pl-5 mb-2 bg-secondary text-white">Работа с базой данных</div>

<div class="alert alert-warning mb-2">Не забудьте перед началом работы выполнить команду <code>composer install</code> в консоли</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">\config\database.php</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="line_code"><span class="keywords">return</span> [</span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="variable">'connections'</span> => [</span>
        </li>
        <li class="tab2">
            <span class="line_code"><span class="data">'test'</span> => [</span>
        </li>
        <li class="tab3">
            <span class="line_code">'driver'    => <span class="data">'mysql'</span>,</span>
        </li>
        <li class="tab3">
            <span class="line_code">'host'      => <span class="data">'128.0.0.1:3306'</span>,</span>
        </li>
        <li class="tab3">
            <span class="line_code">'database'  => <span class="data">'data'</span></span>
        </li>
        <li class="tab3">
            <span class="line_code">'username'  => <span class="data">'root'</span>,</span>
        </li>
        <li class="tab3">
            <span class="line_code">'password'  => <span class="data">''</span>,</span>
        </li>
        <li class="tab3">
            <span class="line_code">'charset'   => <span class="data">'utf8'</span>,</span>
        </li>
        <li class="tab3">
            <span class="line_code">'collation' => <span class="data">'utf8_unicode_ci'</span>,</span>
        </li>
        <li class="tab3">
            <span class="line_code">'prefix' => <span class="data">''</span></span>
        </li>
        <li class="tab2">
            <span class="line_code">],</span>
        </li>
        <li class="tab1">
            <span class="line_code">],</span>
        </li>
        <li>
            <span class="line_code">];</span>
        </li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Контроллер</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="line_code"><span class="keywords">use</span> Illuminate\Database\Capsule\Manager <span class="keywords">as</span> <span class="class">DB</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="line_code"><span class="keywords">class</span> Name <span class="keywords">extends</span> <span class="class">Controller</span> {</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">public function</span> <span class="method">__construct()</span></span>
        </li>
        <li class="tab1">
            <span class="line_code">{</span>
        </li>
        <li class="tab2">
            <span class="line_code"><span class="class">parent</span>::<span class="method">__construct()</span>;</span>
        </li>
        <li class="tab1">
            <span class="line_code">}</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">public function</span> <span class="method">index()</span></span>
        </li>
        <li class="tab1">
            <span class="line_code">{</span>
        </li>
        <li class="tab2">
            <span class="line_code"><span class="variable">$data</span> = <span class="class">DB</span>::<span class="method">connection(<span class="data">'test'</span>)</span></span>
        </li>
        <li class="tab3">
            <span class="line_code">-><span class="method">table(<span class="data">'test_table'</span>)</span></span>
        </li>
        <li class="tab3">
            <span class="line_code">-><span class="method">where(<span class="data">'name'</span>, <span class="data">'value'</span>)</span></span>
        </li>
        <li class="tab3">
            <span class="line_code">-><span class="method">get()</span>;</span>
        </li>
        <li class="tab1">
            <span class="line_code">}</span>
        </li>
        <li>
            <span class="line_code">}</span>
        </li>
    </ol>
</div>

<div class="alert alert-warning mb-2">Подробная инструкция о работе с модулем <a href="https://laravel.com/docs/8.x/queries#select-statements" target="_blank">тут</a></div>