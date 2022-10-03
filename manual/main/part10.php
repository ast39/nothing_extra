<div class="p-3 pl-5 mb-2 bg-secondary text-white">Работа с Soap Client</div>
<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Создаем расширяющий класс, например <code>\app\models\TestSoapClass</code></div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="line_code"><span class="keywords">namespace</span> app\models;</span>
        </li>
        <li></li>
        <li>
            <span class="line_code"><span class="keywords">class</span> TestSoapClass <span class="keywords">extends</span> <span class="class">\framework\classes\SoapNative</span> {</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">const</span> <span class="variable">SERVICE</span> = <span class="data">'http://128.0.0.1:81/TestService.svc?wsdl'</span>;</span>
        </li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">public function</span> <span class="method">__construct()</span></span>
        </li>
        <li class="tab1">
            <span class="line_code">{</span></li>
        <li class="tab2">
            <span class="line_code"><span class="variable">$this</span>->service_link = <span class="class">self</span>::<span class="variable">SERVICE</span>;</span>
        </li>
        <li class="tab1">
            <span class="line_code">}</span></li>
        <li></li>
        <li class="tab1">
            <span class="line_code"><span class="keywords">public function</span> testCall(<span class="variable">$data</span>)</span>
        </li>
        <li class="tab1">
            <span class="line_code">{</span></li>
        <li class="tab2">
            <span class="line_code"><span class="variable">$params</span> = [<span class="data">'name'</span> => <span class="variable">$data</span>];</span>
        </li>
        <li class="tab2">
            <span class="line_code"><span class="variable">$result</span> = <span class="variable">$this</span>->callService(<span class="variable">$params</span>, <span class="data">'test_method'</span>);</span>
        </li>
        <li></li>
        <li class="tab2">
            <span class="line_code"><span class="keywords">return</span> <span class="method">isset</span>(<span class="variable">$result</span>->test_method_result)</span>
        </li>
        <li class="tab3">
            <span class="line_code"><span class="keywords">?</span> <span class="variable">$result</span>->test_method_result</span>
        </li>
        <li class="tab3">
            <span class="line_code"><span class="keywords">:</span> <span class="variable">false</span>;</span>
        </li>
        <li class="tab1">
            <span class="line_code">}</span>
        </li>
        <li>
            <span class="line_code">}</span>
        </li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Вызов в Вашем контроллере</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Объявляем объект класса</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$testSoap</span> = <span class="keywords">new</span> <span class="class">\app\models\TestSoapClass()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Вызываем метод класса с параметрами</span>
        </li>
        <li>
            <span class="line_code"><span class="variable">$info</span> = <span class="variable">$testSoap</span>->testCall(<span class="data">'some_data'</span>);</span>
        </li>
    </ol>
</div>