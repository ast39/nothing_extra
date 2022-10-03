- ### Модуль, который разворачивает базу данных в файлах и работает с ней базовыми методами
---
- #### Сэмулируем данные ####
      $names    = ['Александр', 'Петр', 'Михаил', 'Алексей', 'Григорий', 'Антон'];
      $surnames = ['Иванов', 'Петров', 'Сидоров', 'Козлов', 'Медведев', 'Васильев'];

      $data = [];
      for ($i = 1; $i <= 10; $i++) {
          $data[] = [
              'name'    => $names[rand(0, 5)],
              'surname' => $surnames[rand(0, 5)],
              'age'     => rand(25, 45)
          ];
      }
---
- #### По желанию настройте конфиг расположения данных в проекте
      Файл jsonDb\Config.php
      $db_path[NAME] - пути к каталогам, где будут храниться таблицы
      $db_index[NAME] - индексы таблиц
---
- #### Чтобы работать с таблицей, нужно получить ее объект
      Adapter::connect('users');
---
- #### Если не уверены что таблица создана, то используйте connectOrCreate вместо connect
      Adapter::connectOrCreate('users');
---
- #### Чтобы работать с объектом таблицы, передайте его в билдэр Manager
      Manager::build(Adapter::connect('users'));
---
- #### Далее можно работать стрелочными функциями
      Manager::build(Adapter::connect('users'))->read();
---
### Пример алгоритма:
- #### Создадим таблицу
      Adapter::create('users');
- #### Заполним таблицу данными
      Manager::build(Adapter::connect('users'))->create($data);
- #### Получить имя таблицыи
      Adapter::connect('users')->name();
- #### Выведем все данные
      xmp(Manager::build(Adapter::connect('users')->read());
- #### Отредактируем данные с ID 4
      Manager::build(Adapter::connect('users'))->update(4, ['age' => 32]);
- #### Выведем данные с ID 4
      xmp(Manager::build(Adapter::connect('users')->read(4));
- #### Удалим данные с ID 4
      Manager::build(Adapter::connect('users'))->delete(4);
- #### Очистим таблицу
      Adapter::clear('users');
- #### Удалим таблицу
      Adapter::delete('users');
---