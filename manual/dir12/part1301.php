<div class="card mt-2 ml-5">
    <div class="card-header" style="border-bottom: none !important;">
        <h5>Работа с данными <code>\framework\classes\DataBuilder</code></h5>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td class="text-left"><code>DataBuilder::instance($data)->...</code><br />
                Статический вызов экземпляра класса с передачей данных. Далее идут цепочные функции.</td>
        </tr><tr>
            <td class="text-left"><code>...->orderBy($key, $reverse = false): self</code><br />
                Сортировка многомерного массива / обьекта по 1 ключу</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->doubleOrderBy($key1, $key2, $reverse1 = false, $reverse2 = false): self</code><br />
                Сортировка многомерного массива / обьекта по 2 ключам</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->getWhere($key, $condition, $value = null): self</code><br />
                Выборка по условию [WHERE] ( можно вторым параметром передавать value, тогда condition будет по умолчанию "=" )</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->getWhereIn($key, array $values): self</code><br />
                Выборка по сравнению с массивом значений [WHERE IN]</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->getWhereBetween($key, $from, $to): self</code><br />
                Выборка по условию диапазона [WHERE BETWEEN]</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->deleteWhere($key, $condition, $value = null): self</code><br />
                Удаление по условию [WHERE] ( можно вторым параметром передавать value, тогда condition будет по умолчанию "=" )</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->deleteWhereIn($key, array $values): self</code><br />
                Удаление по сравнению с массивом значений [WHERE IN]</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->deleteWhereBetween($key, $from, $to): self</code><br />
                Удаление по сравнению с массивом значений [WHERE BETWEEN]</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->reBuildByKey($key): self</code><br />
                Перестроить простой массив по новому ключу</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->takeOutOneKey($key): self</code><br />
                Вынести из многомерного массива только значения 1 ключа, собрав новый простой массив</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->resetKeys(): self</code><br />
                Сбросить ключи от 0 и далее</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->myFilter(callable $user_function): self</code><br />
                Пользовательская функция фильтрации</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->offset(int $offset): self</code><br />
                Игнорировать первые ХХХ элементов</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->limit(int $limit): self</code><br />
                Ограничить данные ХХХ кол-вом элементов</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->take($offset, $limit): self</code><br />
                Игнорировать первые ХХХ элементов, ограничившись YYY кол-вом элементов</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->toJson(): string</code><br />
                Привести к JSON формату</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->toArray(): array</code><br />
                Привести к формату массиву</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->toObject($arr = NULL): object</code><br />
                Привести к формату обьекта</td>
        </tr>
        <tr>
            <td class="text-left"><code>...->toArrayOfObjects(): array</code><br />
                Привести к формату массива обьектов</td>
        </tr>
    </tbody>
</div>