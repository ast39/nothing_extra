<div class="p-3 pl-5 mb-2 bg-secondary text-white">Роутинги</div>

<div class="alert alert-warning mb-2">По умолчанию роутинг работает по принципу [ SITE ] / [ CONTROLLER ] / [ METHOD ] / [ DATA ]</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">\config\routing.php</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// страница ( класс ) по умолчанию</span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">public static</span> <span class="variable">$def_page</span> = <span class="data">'home'</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// метод, запускаемый автоматически в каждом классе ( странице )</span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">public static</span> <span class="variable">$def_method</span> = <span class="data">'index'</span>;</span>
        </li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Сам файл</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="line_code"><span class="keywords">return</span> [</span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="variable">routes</span> => [</span>
        </li>
        <li class="tab2">
            <span class="line_code">[</span>
        </li>
        <li class="tab3">
            <span class="comment">Создадим пример конфига для GET запросов</span>
        </li>
        <li class="tab3">
            <span class="comment">Например мы хотим, чтобы [ URL http://site.ru/blog/news/last ] обрабатывал</span>
        </li>
        <li class="tab3">
            <span class="comment">контроллер по умолчанию ( $def_page ) и метод так же по умолчанию ( $def_method )</span>
        </li>
        <li class="tab3">
            <span class="line_code">'method' => <span class="data">'GET'</span>,</span>
        </li>
        <li class="tab3">
            <span class="line_code">'pattern' => <span class="data">'<span class="keywords">{prefix}</span>/news/last'</span>,</span>
        </li>
        <li class="tab3">
            <span class="line_code">'action' => <span class="class">Settings</span>::<span class="variable">$def_page</span> . '@' . <span class="class">Settings</span>::<span class="variable">$def_method</span>,</span>
        </li>
        <li class="tab2">
            <span class="line_code">], [</span>
        </li>
        <li></li>
        <li class="tab3">
            <span class="comment">Создадим пример конфига для POST запросов</span>
        </li>
        <li class="tab3">
            <span class="comment">Например мы хотим, чтобы [ URL http://site.ru/user/status/off ] обрабатывал</span>
        </li>
        <li class="tab3">
            <span class="comment">контроллер по умолчанию ( $def_page ) и метод [ update ], принимая все параметры [ data ]</span>
        </li>
        <li class="tab3">
            <span class="line_code">'method' => <span class="data">'POST'</span>,</span>
        </li>
        <li class="tab3">
            <span class="line_code">'pattern' => <span class="data">'user/status/<span class="keywords">{data}</span>'</span>,</span>
        </li>
        <li class="tab3">
            <span class="line_code">'action' => <span class="class">Settings</span>::<span class="variable">$def_page</span> . '@update',</span>
        </li>
        <li class="tab2">
            <span class="line_code">],</span>
        </li>
        <li class="tab1">
            <span class="line_code">],</span>
        </li>
        <li>
            <span class="line_code">],</span>
        </li>
    </ol>
</div>