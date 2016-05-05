<?php
// Открываем новое соединение с  MySQL сервером
$mysqli = new mysqli("localhost", "lushina", "siski", "lushina");

//Выводим любую ошибку соединения
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
$results = $mysqli->query("SELECT id, path, name, image FROM slider");

while($row = $results->fetch_assoc()) {
        
		 ?>
<center>
		  <img src="<?php echo $row['path'].$row ['image'];?>" align="top"/>
		</center>
		 <?php
  }

// Frees the memory associated with a result
$results->free();

// close connection
$mysqli->close();

?>



	 