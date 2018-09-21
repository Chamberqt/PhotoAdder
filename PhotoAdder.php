<?php
/*
Plugin Name: Photo-Adder
Description: Плагин добавляет фото на страницу "Ищу Маму"
Version: 1.0
Author: Владислав Нащекин
Author URI: https://vk.com/chamberlolx
*/

add_action('admin_menu', 'PhotoAdder_menu');

function PhotoAdder_menu (){
	add_menu_page('Добавить фото', 'PhotoAdder', 1, 89, 'render_PhotoAdder_page', 'dashicons-format-image', 11);
}

function render_PhotoAdder_page() {
	include 'PhotoAdder_page.php';
}

register_activation_hook(__FILE__, 'create_plugin_table');

function create_plugin_table(){ //функция создает таблицу
	global $wpdb; //prefix of wp table
	$table_name = $wpdb->prefix . 'child';
	$sql = "CREATE TABLE $table_name (
		ID int(11) NOT NULL AUTO_INCREMENT,
		name varchar(20),
		age varchar(20),
		info varchar(100),
		forms varchar(500),
		photo varchar(300),
		UNIQUE KEY id (id)
	);";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql); //создает таблицу и проверят существует ли такая же
}

?>