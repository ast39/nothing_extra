<div class="p-3 mb-2 bg-light text-secondary border">Работа с уведомлениями <code>\framework\classes\SystemMessage</code></div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Добавить сообщение в реестр</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">setMsg(
                <span class="keywords">strin</span> <span class="variable">$msg_key</span>,
                <span class="keywords">string</span> <span class="variable">$message</span>,
                <span class="keywords">int</span> <span class="variable">$type</span> = <span class="data">MSG_DEFAULT</span>,
                <span class="keywords">bool</span> <span class="variable">$append</span> = <span class="data">false</span>):
                    <span class="keywords">void</span></span></span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить сообщение из реестра</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">getMsg(
                <span class="keywords">string</span> <span class="variable">$msg_key</span>,
                <span class="keywords">int</span> <span class="variable">$type</span> = <span class="data">MSG_DEFAULT</span>):
                    <span class="keywords">array</span></span></span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить все сообщения одного типа из реестра</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">getAllMsg(
                <span class="keywords">int</span> <span class="variable">$type</span> = <span class="data">MSG_DEFAULT</span>):
                    <span class="keywords">array</span></span></span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить все сообщения из реестра</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">getAllMessages():
                <span class="keywords">array</span></span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Сохранить сообщения в сессию (перед редиректом)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">saveMessages():
                <span class="keywords">void</span></span></span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Очистить реестр сообщений</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">clean():
                <span class="keywords">void</span></span></span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Восстанавливает сообщения, если таковые были в сессии</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">recoveryMessages():
                <span class="keywords">void</span></span></span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить сообщение и вывести в дизайне</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">showMsg(
                <span class="keywords">string</span> <span class="variable">$msg_key</span>,
                <span class="keywords">int</span> <span class="variable">$type</span> = <span class="data">MSG_DEFAULT</span>,
                <span class="keywords">bool</span> <span class="variable">$rounded</span> = <span class="data">false</span>):
                    <span class="keywords">void</span></span></span>
        </li>
    </ol>
</div>

<div class="text-secondary bg-light border font-weight-normal p-1 pl-5 mb-2">Пример использования</div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Записать в ключ [send_message] уведомление типа [WARNING] с флагом [APPEND]</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">setMsg(<span class="data">'send_message'</span>, <span class="data">'Вы не заполнили имя'</span>, <span class="data">MSG_ERROR</span>, <span class="data">true</span>)</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Сохранить уведомления в память до редиректа (при использовании Route::redirect вшито в ядро)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">saveMessage()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Восстановить уведомления в памяти после редиректа (не надо вызывать, вшито в ядро)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">recoveryMessages()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить уведомление c ключом [send_message] из блока типа [WARNING]</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">getMsg(<span class="data">'send_message'</span>, <span class="data">MSG_ERROR</span>)</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить все уведомления из блока типа [WARNING]</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">getAllMsg(<span class="data">MSG_ERROR</span>)</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить все уведомления</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">getAllMessages()</span>;</span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Получить и вывести в дизайне уведомление c ключом [send_message] из блока типа [WARNING] с флагом [ROUND]</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SystemMessage</span>::<span class="method">showMsg(<span class="data">'send_message'</span>, <span class="data">MSG_ERROR</span>, <span class="data">true</span>)</span>;</span>
        </li>
    </ol>
</div>