<?php
$mysqli = new mysqli('localhost', 'stud10_lushina', 'siski', 'stud10_lushina');

mysqli_set_charset($mysqli, "utf8");

function getNews($mysqli){
	$sql = 'SELECT * FROM `news`';
	$res = $mysqli->query($sql);
//Создаем масив где ключ массива является ID меню
	$cat = array();
	while($row = $res->fetch_assoc()){
		$cat[$row['id']] = $row;
	}
	return $cat;
}
//Функция построения дерева из массива от Tommy Lacroix
function getTreeNews($dataset) {
	$tree = array();

	foreach ($dataset as $id => &$node) {    
		//Если нет вложений
		if (!$node['parent']){
			$tree[$id] = &$node;
		}else{ 
			//Если есть потомки то перебераем массив
            $dataset[$node['parent']]['childs'][$id] = &$node;
		}
	}
	return $tree;
};

//Получаем подготовленный массив с данными
$cat  = getNews($mysqli); 

//Создаем древовидное меню
$tree = getTreeNews($cat);

//Шаблон для вывода меню в виде дерева
function tplMenuNews($category){

			$news = ' <li><a href="'. $category['text'] .'" name="'. $category['name'] .'">'. 
		$category['name'].'</a>';
		
		if(isset($category['childs'])){
			$news .= '<ul>'. showCat($category['childs']) .'</ul>';
		}
	$news .= '</li>';
	
	return $news;
}

/**
* Рекурсивно считываем наш шаблон
**/
function showCatNews($data){
	$string = '';
	foreach($data as $item){
		$string .= tplMenuNews($item);
	}
	return $string;
}

//Получаем HTML разметку
$cat_menu = showCatNews($tree);

//Выводим на экран
echo '<ul>'. $cat_menu .'</ul>';

?>