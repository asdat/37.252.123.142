<?php
$mysqli = new mysqli('localhost','lushina','siski','lushina');
$results = $mysqli->query("SELECT id, name, image, priority, signature FROM slider");

echo '<table border="1"';
while($row = $results->fetch_array()) {
    echo '<tr>';
    echo '<td>'.$row["id"].'</td>';
    echo '<td>'.$row["name"].'</td>';
    echo '<td>'.$row["image"].'</td>';
    echo '<td>'.$row["priority"].'</td>';
    echo '<td>'.$row["signature"].'</td>';
	echo '<td>'.$row["id"]." - <a href='?del=".$row['id']."'>Удалить</a><br>".'</td>';
	echo '<td>'.$row["id"]." - <a href='?edit=".$row['id']."'>Редактировать</a><br>".'</td>';
    echo '</tr>';
}
echo '</table>';

//Проверяем, Удаляем 
if (isset($_GET['del'])) {
	
	$results = $mysqli->query('DELETE FROM `slider` WHERE `slider`.`id` = "'.$_GET['del'].'"');
    
    }
?>
<table>
<form action=upload.php method=post enctype=multipart/form-data>
    <tr>
        <td>Наименование:</td>
        <td><input type="text" name="name"></td>
    </tr>
	<tr>
        <td>Приоритет:</td>
        <td><input type="text" name="priority"></td>
    </tr>
    <tr>
	
        <td>Описание:</td>
        <td><input type="text" name="signature" ></td>
    </tr>
  
	<tr>
		<td><input type=file name=uploadfile></td>
	</tr>
	<tr>
		<td><input type=submit value=Загрузить></td>

	</tr>
</form>
</table>
<?php
// Каталог, в который мы будем принимать файл:
//@mkdir("photo/slider", 0777); создание каталога (нужно будет сделать кнопку)
//путь
$path = "photo/slider/";
$uploaddir = "../"."$path";
$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
//приняли

// Копируем файл из каталога для временного хранения файлов:
if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile))
{
	//переменная
	$file_input=$uploadfile;
	?><img src="<?php echo $file_input;?>" align="top"/><?php
echo "<h3>оригинальный файл загружен</h3>";
//выводим оригинал изображения

include ('function.php'); // подключаем файл с функцией
    // Запускаем функцию
	
	resize('photo/slider/big.jpg', 'photo/slider/smol.JPG', 50, 50, true); 
//выводим обрезанное изображение
?><img src="<?php echo 'photo/slider/smol.JPG';?>" align="top"/><?php

echo "<h3>Файл успешно загружен на сервер!!!!!</h3>";
}
else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>";exit; }

// Выводим информац о загруженном файле:
/*
echo "<h3>Информация о загруженном на сервер файле: </h3>";
echo "<p><b>Оригинальное имя загруженного файла: ".$_FILES['uploadfile']['name']."</b></p>";
echo "<p><b>Mime-тип загруженного файла: ".$_FILES['uploadfile']['type']."</b></p>";
echo "<p><b>Размер загруженного файла в байтах: ".$_FILES['uploadfile']['size']."</b></p>";
echo "<p><b>Временное имя файла: ".$_FILES['uploadfile']['tmp_name']."</b></p>";
*/
//теперь подключимся к SQL




//запишем в БД имя файла
$results = $mysqli->query("INSERT INTO slider (`name`,`path`,`image`,`priority`,`signature`)
VALUES ('".$_POST['name']."','$path','".$_FILES['uploadfile']['name']."','".$_POST['priority']."','".$_POST['signature']."')");
//путь   


// Frees the memory associated with a result
$results->free();
//close connection
$mysqli->close();

?>

