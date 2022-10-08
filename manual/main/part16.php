<div class="p-3 pl-5 mb-2 bg-secondary text-white">Роутинги</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">\routes\web.php</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="line_code"><span class="comment"># Будем использовать системную библиотеку</span></span>
        </li>
        <li>
            <span class="line_code"><span class="keywords">use</span> \framework\classes\Routing;</span>
        </li>
        <li></li>
        <li>
            <span class="line_code"><span class="comment"># Объединение роутов в группу по префиксу</span></span>
        </li>
        <li>
            <span class="line_code"><span class="class">Routing</span>::<span class="method">getInstance()</span>-><span class="method">group</span>([
                <span class="variable">prefix</span>' => '<span class="data">foo</span>', '<span class="variable">middleware</span>' => ['<span class="data">Bar</span>']], <span class="keywords">function</span>(<span class="variable">$mv</span>) {</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="comment"># GET роут в группе с наследованием миддлвэра</span></span>
        </li>
        <li class="tab1">
            <span class="line_code"><span class="line_code">
                <span class="class">Routing</span>::<span class="method">getInstance()</span>-><span class="method">get</span>([
                <span class="comment">pattern</span> '<span class="data">Foo</span><span class="keywords">/</span><span class="data">Bar</span>',
                <span class="comment">action</span> ['<span class="variable">middleware</span>' => <span class="data">$mv</span>,
                '<span class="variable">uses</span>' => '<span class="data">Controller<span class="keywords">@</span>method</span>']);
            </span></span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="comment"># POST роут в группе сo своим миддлвэром</span></span>
        </li>
        <li class="tab1">
            <span class="line_code">
                <span class="class">Routing</span>::<span class="method">getInstance()</span>-><span class="method">post</span>([
                <span class="comment">pattern</span> '<span class="data">Foo</span><span class="keywords">/</span><span class="data">Bar</span>',
                <span class="comment">action</span> ['<span class="variable">middleware</span>' => ['<span class="data">Foo</span>'],
                '<span class="variable">uses</span>' => '<span class="data">Controller<span class="keywords">@</span>method</span>']);
            </span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="comment"># DELETE роут в группе с добавлением миддлвэра к наследуемым</span></span>
        </li>
        <li class="tab1">
            <span class="line_code">
                <span class="class">Routing</span>::<span class="method">getInstance()</span>-><span class="method">delete</span>([
                <span class="comment">pattern</span> '<span class="data">Foo</span><span class="keywords">/</span><span class="data">Bar</span>',
                <span class="comment">action</span> ['<span class="variable">middleware</span>' => <span class="method">array_merge(<span class="variable">$mv</span>,
                ['<span class="data">Foo</span>'])</span>, '<span class="variable">uses</span>' => '<span class="data">Controller<span class="keywords">@</span>method</span>']);
            </span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="comment"># PUT|PATCH роуты в группе без миддлвэра</span></span>
        </li>
        <li class="tab1">
            <span class="line_code">
                <span class="class">Routing</span>::<span class="method">getInstance()</span>-><span class="method">request</span>(
                <span class="comment">methods</span> '<span class="data">GET</span><span class="keywords">|</span><span class="data">POST</span>',
                <span class="comment">pattern</span> '<span class="data">Foo</span>',
                <span class="comment">action</span> ['<span class="variable">uses</span>' => '<span class="data">Controller<span class="keywords">@</span>method</span>']);
            </span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="comment"># Самый простой GET роут</span></span>
        </li>
        <li class="tab1">
            <span class="line_code">
                <span class="class">Routing</span>::<span class="method">getInstance()</span>-><span class="method">get</span>(
                <span class="comment">pattern</span> '<span class="data">Foo</span><span class="keywords">/</span><span class="data">Bar</span>',
                <span class="comment">action</span> '<span class="data">Controller<span class="keywords">@</span>method</span>');
            </span>
        </li>
        <li>
            <span class="line_code">});</span>
        </li>
        <li></li>
    </ol>
</div>
