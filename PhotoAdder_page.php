<h1>Добавить информацию:</h1>

<form action="" method="POST" id="add-form" enctype="multipart/form-data">
	<table id="add-table">
		<tr>
			<th>Имя:</th>
			<td><input type="text" name="name" required></td>
		</tr>
		<tr>
			<th>Возраст (год, лет):</th>
			<td><input type="text" name="age" required></td>
		</tr>
		<tr>
			<th>Информация:</th>
			<td><textarea name="info" cols="40" rows="10" required></textarea></td>
		</tr>
		<tr>
			<th>Формы опеки:</th>
			<td><textarea name="forms" cols="40" rows="10" required></textarea></td>
		</tr>
		<tr>
			<th>Фото:</th>
			<td><input type="file" name="photo" required></td>
		</tr>
	</table>
	<input type="submit" name="submit-btn">
</form>

<!-- Добавление -->
<?php

	if(isset($_POST['submit-btn'])){

		include "connection.php";

		copy($_FILES['photo']['tmp_name'],"../wp-content/themes/THEME_NAME/".basename($_FILES['photo']['name']));

		//Получаем все данные из формы
		$name = strip_tags(trim($_POST['name']));
		$age = strip_tags(trim($_POST['age']));
		$info = strip_tags(trim($_POST['info']));
		$forms = strip_tags(trim($_POST['forms']));
		$photo = "../wp-content/themes/THEME_NAME/".basename($_FILES['photo']['name']);
		
		global $wpdb;
		$table_name = $wpdb->prefix . 'child';
		$add_query = "INSERT INTO $table_name(name, age, info, forms, photo) VALUES ('$name', '$age', '$info', '$forms', '$photo')";
		$wpdb->query($add_query);

	} 
?>

<table border="1px" id="select-table">
	<tr>
		<th>Номер</th>
		<th>Имя</th>
		<th>Возраст</th>
	</tr>
	<tr>

<?php
	global $wpdb;
	$table_name = $wpdb->prefix . 'child';
	$query = $wpdb->get_results("SELECT ID, name, age FROM $table_name ", ARRAY_A); 
	foreach($query as $row)
{ ?>
    <td><?php echo $row['ID']?></td>
		<td><?php echo $row['name']?></td>
		<td><?php echo $row['age']?></td>
	</tr>
<?php }; ?>
</table>

<form action="" method="POST" id="delete-form">
	<table>
		<tr>
			<th>Номер человека:</th>
			<td><input type="text" name="deleteID">
			<input type="submit" value="Удалить" class="button-primary" name="delete-btn">
			</td>
		</tr>	
	</table>
</form>


<!-- Удаление -->
<?php

if(isset($_POST['delete-btn'])){

	$deleteID = strip_tags(trim($_POST['deleteID']));

	global $wpdb;
	$table_name = $wpdb->prefix . 'child';

	$del_photo = "SELECT photo FROM $table_name WHERE ID = $deleteID";
	$query_result = $wpdb->get_var($del_photo);
	unlink($query_result);

	$add_query = "DELETE  FROM $table_name WHERE ID = $deleteID";
	$wpdb->query($add_query);


} ?>



<style>
	#add-form {
		float: left;
	}

	#delete-form {
		padding-left: 20px;
	}

	#add-table th {
		float: left;
	}

	#select-table {
		font-size: 20px;
		float: left;
		margin-left: 50px;
	}
</style>
