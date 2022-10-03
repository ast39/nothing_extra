<div class="p-3 mb-2 bg-light text-secondary border">Класс работы с URL <code>\framework\classes\Route</code></div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Укажем, с чем работаем</span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">use</span> \framework\classes\Route;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Каталог сайта, описанный в конфиге cfg\Settings::$site_dir</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">sitePath()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Текущий язык сайта (часть URL)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">pageLang()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Контроллер страницы (часть URL)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">pageController()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Метод ткущего контроллера (часть URL)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">pageMethod()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Параметры, переданные методв контроллера (часть URL)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">pageParameters()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Схема http / https</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">scheme()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Основной дамен сайта</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">host()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Каталог сайта, если спйт в каталоге (часть URL)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">path()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Корень сайта без учета языка</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">fullUrl()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Корень сайта (для дальнейшего подключения статических файлов)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">siteRootForStatic()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Корень сайта с учетом языка</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">siteRoot()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Редирект на страницу с отправкой заголовка и статуса</span>
        </li>
        <li>
            <span class="line_code"><span class="class">Route</span>::<span class="method">redirect($url, $code = 302)</span>;</span>
        </li>
    </ol>
</div>
