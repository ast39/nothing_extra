<div class="card mt-2 ml-5">
    <div class="card-header" style="border-bottom: none !important;">
        <h5>Работа со временем и датой <code>\framework\classes\Date</code></h5>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td class="text-left"><code>Date::isLeap($year)</code><br />
                Проверка на високосный год</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::ftime(int $time, $from_zone = 0, $to_zone = 0)</code><br />
                Изменить временную зону для строки времени</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::plusDay($timestamp, $days = 1)</code><br />
                Прибавить сутки ко времени</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::plusWeek($timestamp, $weeks = 1)</code><br />
                Прибавить неделю ко времени</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::plusMonth($timestamp, $monthes = 1)</code><br />
                Прибавить месяц ко времени</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::plusYear($timestamp, $years = 1)</code><br />
                Прибавить год ко времени</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::timeToMark($timestamp, $format = 's')</code><br />
                Сколько пройдет времени до метки в заданной единице времени</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::timeAfterMark($timestamp, $format = 's')</code><br />
                Сколько пройдет времени от метки в заданной единице времени</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::tillTime($from, $to, $format = 's')</code><br />
                Сколько пройдет времени между 2мя метками в заданной единице времени</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::dayBegin(int $time)</code><br />
                Получить метку начала суток по времени</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::monthBegin(int $time)</code><br />
                Получить метку начала месяца по времени</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::yearBegin(int $time)</code><br />
                Получить метку начала года по времени</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::daysInMonth(int $time, bool $back = false)</code><br />
                Получить кол-во дней в месяце</td>
        </tr>
        <tr>
            <td class="text-left"><code>Date::formatTime($seconds)</code><br />
                Время в формате 3 знака после точки</td>
        </tr>
        </tbody>
</div>