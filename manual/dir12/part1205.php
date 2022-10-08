<div class="p-3 mb-2 bg-light text-secondary border">Основной класс, запускающий выполнение страницы <code>\framework\classes\Controller</code></div>
<div class="code-text border mb-2 p-2 pl-3 text-secondary">
    Сорсник компонента распологается в <code>app\controllers</code>
    <br />
    Шаблон компонента распологается в <code>app\templates</code>
</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Подгрузить шаблон страницы</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->loadTemplate();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Подгрузить произвольный шаблон</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->loadTemplate(<span class="data">'test_tpl'</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Сгенерировать CSRF-токен в сессии (автоматически гененрируется в движке)</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->csrfGen();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Сгенерировать CSRF-токен в сессии, принудительно заменив старый (автоматически гененрируется в движке)</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->csrfGen(<span class="data">true</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить CSRF-токен из сессии</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->csrfGet();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Добавить на страницу скрытый input с CSRF-токеном (добавлять внутри формы в шаблоне)</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->csrfHtml();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Проверка CSRF-токена (вызывать в контроллере в начале проверки $_POST-а)</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->csrfCheck();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Авторизован ли пользователь на сайте</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->isUserAuth();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Авторизован ли пользователь в админке</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->isAdminAuth();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Авторизован ли пользователь в админке под рутом</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->isRootAuth();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Авторизовать пользователя на сайте</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->authUser();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Авторизовать пользователя в админке</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->authAdmin();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Авторизовать пользователя в админке под рутом</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->authRoot();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Подгрузить компонент (можно передать массив данных, они придут в index метод компонента)</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->loadComponent(<span class="data">'footer'</span>, <span class="data">['Company name', 'Copyright']</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить тайтл страницы</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->pageTitle();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить описание страницы</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->pageDescription();</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить языковую переменнную из Main</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->langLine(<span class="data">'table_cell_1'</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить языковую переменнную из файла forms</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->langLine(<span class="data">'table_cell_1'</span>, <span class="variable">'forms'</span>);</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Проверка сессии</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$this</span>->checkSession();</span>
        </li>
    </ol>
</div>