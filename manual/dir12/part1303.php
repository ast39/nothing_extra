<div class="p-3 mb-2 bg-light text-secondary border">Работа с шифрованием <code>\framework\classes\Crypt</code></div>

<div class="code_block">
    <div class="code_line">
        <span class="line_num">1.</span>
        <span class="line_code"><span class="comment">// Укажем с чем будем работать</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">2.</span>
        <span class="line_code"><span class="keywords">use</span> \framework\classes\Crypt;</span>
    </div>
</div>

<div class="code_block">
    <div class="code_line">
        <span class="line_num">1.</span>
        <span class="line_code"><span class="comment">// Сгенерировать простой ключ в 32 символа</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">2.</span>
        <span class="line_code"><span class="variable">$key</span> = <span class="class">Crypt</span>::<span class="method">generateKey()</span>;</span>
    </div>
    <div class="code_line">
        <span class="line_num">3.</span>
        <span class="line_code"></span>
    </div>
    <div class="code_line">
        <span class="line_num">4.</span>
        <span class="line_code"><span class="comment">// Сгенерировать простой ключ в 64 символа</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">5.</span>
        <span class="line_code"><span class="variable">$key</span> = <span class="class">Crypt</span>::<span class="method">generateKey(<span class="data">true</span>)</span>;</span>
    </div>
</div>

<div class="code_block">
    <div class="code_line">
        <span class="line_num">1.</span>
        <span class="line_code"><span class="comment">// Зашифровать строку</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">2.</span>
        <span class="line_code"><span class="variable">$key</span> = </span><span class="data">'54e@gt%rdf'</span>;
    </div>
    <div class="code_line">
        <span class="line_num">3.</span>
        <span class="line_code"><span class="variable">$data</span> = </span><span class="data">'some data'</span>;
    </div>
    <div class="code_line">
        <span class="line_num">4.</span>
        <span class="line_code"><span class="variable">$crypt_data</span> = <span class="class">Crypt</span>::<span class="method">encrypt(<span class="variable">$data</span>, <span class="variable">$key</span>)</span>;</span>
    </div>
</div>

<div class="code_block">
    <div class="code_line">
        <span class="line_num">1.</span>
        <span class="line_code"><span class="comment">// Расшифровать строку</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">2.</span>
        <span class="line_code"><span class="variable">$key</span> = </span><span class="data">'54e@gt%rdf'</span>;
    </div>
    <div class="code_line">
        <span class="line_num">3.</span>
        <span class="line_code"><span class="variable">$crypt_data</span> = </span><span class="data">'4!d@rT#rf7D5#8'</span>;
    </div>
    <div class="code_line">
        <span class="line_num">4.</span>
        <span class="line_code"><span class="variable">$data</span> = <span class="class">Crypt</span>::<span class="method">decrypt(<span class="variable">$crypt_data</span>, <span class="variable">$key</span>)</span>;</span>
    </div>
</div>

<div class="code_block">
    <div class="code_line">
        <span class="line_num">1.</span>
        <span class="line_code"><span class="comment">// Генерация пароля</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">2.</span>
        <span class="line_code"></span>
    </div>
    <div class="code_line">
        <span class="line_num">3.</span>
        <span class="line_code"><span class="comment">// Зададим длину пароля</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">4.</span>
        <span class="line_code"><span class="variable">$length</span> = </span><span class="data">12</span>;
    </div>
    <div class="code_line">
        <span class="line_num">5.</span>
        <span class="line_code"></span>
    </div>
    <div class="code_line">
        <span class="line_num">6.</span>
        <span class="line_code"><span class="comment">// Будем ли использовать заглавные буквы</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">7.</span>
        <span class="line_code"><span class="variable">$uppercase</span> = </span><span class="data">true</span>;
    </div>
    <div class="code_line">
        <span class="line_num">8.</span>
        <span class="line_code"></span>
    </div>
    <div class="code_line">
        <span class="line_num">9.</span>
        <span class="line_code"><span class="comment">// Будем ли использовать прописные буквы</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">10.</span>
        <span class="line_code"><span class="variable">$lowercase</span> = </span><span class="data">true</span>;
    </div>
    <div class="code_line">
        <span class="line_num">11.</span>
        <span class="line_code"></span>
    </div>
    <div class="code_line">
        <span class="line_num">12.</span>
        <span class="line_code"><span class="comment">// Будем ли использовать цифры</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">13.</span>
        <span class="line_code"><span class="variable">$digits</span> = </span><span class="data">true</span>;
    </div>
    <div class="code_line">
        <span class="line_num">14.</span>
        <span class="line_code"></span>
    </div>
    <div class="code_line">
        <span class="line_num">15.</span>
        <span class="line_code"><span class="comment">// Будем ли использовать символы</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">16.</span>
        <span class="line_code"><span class="variable">$symbols</span> = </span><span class="data">false</span>;
    </div>
    <div class="code_line">
        <span class="line_num">17.</span>
        <span class="line_code"></span>
    </div>
    <div class="code_line">
        <span class="line_num">18.</span>
        <span class="line_code"><span class="comment">// Генерируем пароль</span></span>
    </div>
    <div class="code_line">
        <span class="line_num">19.</span>
        <span class="line_code"><span class="variable">$password</span> = <span class="class">Crypt</span>::<span class="method">generatePassword(
                <span class="variable">$length</span>, <span class="variable">$uppercase</span>, <span class="variable">$lowercase</span>,
                <span class="variable">$digits</span>, <span class="variable">$symbols</span>)</span>;</span>;
    </div>
</div>
