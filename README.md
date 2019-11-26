<p align="center">
    <a href="https://github.com/Satorlous/todolist" target="_blank">
        <img src="https://raw.githubusercontent.com/Satorlous/todolist/master/web/img/icon.png" height="100px">
    </a>
    <h1 align="center">ToDoList Web Application</h1>
    <br>
</p>

ПЕРВОНАЧАЛЬНАЯ НАСТРОЙКА
-------------------

**После клонирования:**
1. Выполнить команду
```
php composer.phar install
```

2. Создать пустую базу данных с именем `todoapp`;

3. Настроить конфигурацию файла `/config/db.php` в соответствии с настройками вашей СУБД;

4. Выполнить команду
```
yii migrate
```

>После миграции структуры БД в таблицах уже будут некоторые тестовые данные.

Уже имеются пользователи `user1`, `user2`, `user3`, `user4` с паролем `123123`.
У этих пользователей уже имеются некоторые задачи.
