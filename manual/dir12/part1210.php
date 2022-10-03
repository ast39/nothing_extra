<div class="p-3 mb-2 bg-light text-secondary border">Класс определения юзера, браузера, устройства и т.д. <code>\framework\classes\SiteIndexing</code></div>
<div class="code_block mb-2">
    <ol>
        <li>
            <span class="comment">// Кто зашел на сайт? Ответы: human / bot</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SiteIndexing</span>-><span class="method">detectGuest():
                    <span class="keywords">string</span></span></span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Определить поискового бота (desc - user agent, если не удалось определить)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SiteIndexing</span>-><span class="method">detectSearchBot(
                <span class="keywords">bool</span> <span class="variable">$desc</span> = <span class="data">false</span>):
                    <span class="keywords">string</span></span></span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Определить аналитического бота (desc - user agent, если не удалось определить)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SiteIndexing</span>-><span class="method">detectAnalyzer(
                <span class="keywords">bool</span> <span class="variable">$desc</span> = <span class="data">false</span>):
                    <span class="keywords">string</span></span></span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Определить браузер гостя (desc - user agent, если не удалось определить)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SiteIndexing</span>-><span class="method">detectBrowser(
                <span class="keywords">bool</span> <span class="variable">$desc</span> = <span class="data">false</span>):
                    <span class="keywords">string</span></span></span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Определить девайс / устройство гостя (desc - user agent, если не удалось определить)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SiteIndexing</span>-><span class="method">detectDevice(
                <span class="keywords">bool</span> <span class="variable">$desc</span> = <span class="data">false</span>):
                    <span class="keywords">string</span></span></span>
        </li>
        <li></li>
        <li>
            <span class="comment">// Определить операционку гостя (desc - user agent, если не удалось определить)</span>
        </li>
        <li>
            <span class="line_code"><span class="class">SiteIndexing</span>-><span class="method">detectOS(
                <span class="keywords">bool</span> <span class="variable">$desc</span> = <span class="data">false</span>):
                    <span class="keywords">string</span></span></span>
        </li>
    </ol>
</div>