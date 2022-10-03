<div class="card mt-2 ml-5">
    <div class="card-header" style="border-bottom: none !important;">
        <h5>Работа с текстом <code>\framework\classes\Text</code></h5>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td class="text-left"><code>Text::cyrillicInText(string $string): bool</code><br />
                Проверить, есть ли кириллица в тексте</td>
        </tr>
        <tr>
            <td class="text-left"><code>Text::cutTextTo(string $string, int $length):  string</code><br />
                Обрезать длинный текст до указанного кол-ва символов</td>
        </tr>
        <tr>
            <td class="text-left"><code>Text::wordEndingCorrection(int $count, array $endings): string</code><br />
                Подставить верное окончание для существительного, определяемого кол-вом</td>
        </tr>
        <tr>
            <td class="text-left"><code>Text::translit(string $text, string $langs, int $case = 0, array $additions = []): string</code><br />
                Транслит в обе стороны с указанием прямых замен в additions</td>
        </tr>
        </tbody>
</div>