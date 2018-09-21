<?php
	$connection = mysql_connect("server", "login", "pass"); //Подключение к БД ("сервер, имя_пользователя, пароль")
	$db = mysql_select_db("u492820731_opeka"); //Выбор БД ("название БД")
	mysql_query(" SET NAMES 'utf8' "); //Выбор кодировки БД

	if(!$connection || !$db) { //Проверка подключения
		exit(mysql_error());
		echo "Подключение не удалось";
	} else {
		
	}
?>