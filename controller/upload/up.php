<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
 
if (sizeof($_FILES)!=0){
    $uploaddir = 'img/';
    $uploadfile = $uploaddir . basename($_FILES['filename']['name']);
    if (move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile)) {
       echo"Загружено изображение-  ".basename($_FILES['filename']['name'])."<br/><img src='".$uploadfile."'/>";
    }
    else {
        echo "Файл загрузить не удалось";
    }
}
?>