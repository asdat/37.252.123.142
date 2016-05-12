news
<?php
$mysqli = new mysqli('localhost', 'stud10_lushina', 'siski', 'stud10_lushina');
mysqli_set_charset($mysqli, "utf8");
$results = $mysqli->query("SELECT id, name FROM news");

echo '<table border="1"';
while($row = $results->fetch_array()) {
    echo '<tr>';
    echo '<td>'.$row["id"].'</td>';
    echo '<td>'.$row["name"].'</td>';
  
	echo '<td>'.$row["id"]." - <a href='?del=".$row['id']."'>Удалить</a><br>".'</td>';
	echo '<td>'.$row["id"]." - <a href='?edit=".$row['id']."'>Редактировать</a><br>".'</td>';
    echo '</tr>';
}
echo '</table>';
//Проверяем, Удаляем 
if (isset($_GET['del'])) {
	
	$results = $mysqli->query('DELETE FROM `news` WHERE `news`.`id` = "'.$_GET['del'].'"');
    
    }
	?>
	
menu
<?php
$mysqli = new mysqli('localhost', 'stud10_lushina', 'siski', 'stud10_lushina');
mysqli_set_charset($mysqli, "utf8");
$results = $mysqli->query("SELECT id, title FROM menu");

echo '<table border="1"';
while($row = $results->fetch_array()) {
    echo '<tr>';
    echo '<td>'.$row["id"].'</td>';
    echo '<td>'.$row["title"].'</td>';
  
	echo '<td>'.$row["id"]." - <a href='?del=".$row['id']."'>Удалить</a><br>".'</td>';
	echo '<td>'.$row["id"]." - <a href='?edit=".$row['id']."'>Редактировать</a><br>".'</td>';
    echo '</tr>';
}
echo '</table>';
//Проверяем, Удаляем 
if (isset($_GET['del'])) {
	
	$results = $mysqli->query('DELETE FROM `menu` WHERE `menu`.`id` = "'.$_GET['del'].'"');
    
    }
	?>