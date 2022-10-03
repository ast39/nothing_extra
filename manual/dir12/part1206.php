<div class="p-3 mb-2 bg-light text-secondary border">Класс вывода нужной языковой переменной <code>\framework\classes\Lang</code></div>
<div class="code-text border mb-2 p-2 pl-3 text-secondary">
    В <code>app\langs</code> создаете каталог для языка <code>xxx</code>
    <br />
    В <code>app\langs\xxx</code> создаете файл <code>Main.php</code> (можете создать файл с произвольным именем)
    <br />
    Он должен наследоваться от основного языка <code>class Main extends Lang</code>
    <br />
    Убедитесь, что ваш язык добавлен в конфиге <code>config\options</code> в массив <code>$site_langs</code>
    <br />
    Заполняйте файл <code>app\langs\xxx\Main.php</code> языковыми переменными
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">cfg\Settings.php</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment"># язык сайта по умолчанию</span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">public static</span> <span class="variable">$def_lang</span> = <span class="data">'ru'</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment"># массив языковых версий сайта</span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">public static</span> <span class="variable">$site_langs</span> = <span class="data">[</span>;</span>
        </li>
        <li class="tab1"><span class="line_code"><span class="data">'ru'</span></span></li>
        <li class="tab1"><span class="line_code"><span class="data">'en'</span></span></li>
        <li>
            <span class="line_code"><span class="data">]</span>;</span>
        </li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">projects\langs\xxx\Main.php</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment"><span class="line_code"><span class="keywords">use</span> \framework\classes\Lang;</span></span>
        </li>
        <li></li>
        <li>
            <span class="line_code"><span class="keywords">class</span> Main <span class="keywords">extends</span> <span class="class">Lang</span> {</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">protected</span> <span class="variable">$form_cell_1</span> = <span class="data">'Some text 1'</span>;</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">protected</span> <span class="variable">$form_cell_2</span> = <span class="data">'Some text 2'</span>;</span>
        </li>
        <li></li>
        <li><span class="line_code">}</span></li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Контроллер / шаблон</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Вывести на странице текст из языковой переменной</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->langLine(<span class="data">'test'</span>);</span>
        </li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Любой файл</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Вывести на странице текст из языковой переменной</span>
        </li>
        <li>
            <span class="line_code"><span class="class">\framework\classes\NE</span>::<span class="method">langLine(<span class="data">'test'</span>)</span>;</span>
        </li>
    </ol>
</div>