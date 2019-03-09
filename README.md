Проект работает на Yii2, php7.2, MySQL

Для запуска проекта необходимо перейти в папку docker и запустить команду
<br>
`docker-compose -f server.yml up -d`
<br><br>
Название хоста и различные другие настройки конфига вебсервера расположены в<br> 
`docker/webconfig.conf`
<br><br>
Базовый sql скрипт для создания базы данных и пользователя расположен в<br>
`docker/init.sql`, 
в случае если база не создалась автоматически необходимо войти в docker контейнер и произвести импорт sql скрипта вручную
<br>
```
docker exec -it docker_mysql_1 bash

cd docker-entrypoint-initdb.d/

mysql -uroot -p < interview.sql
``` 
Стандартный пароль к базе данных `root`

Для запуска тестов необходимо выполнить в корне проекта следующую команду<br>
`vendor/bin/codecept run`
<br><br>
Базовые логин и пароль администратора<br>
```
login: admin
password: password
``` 
