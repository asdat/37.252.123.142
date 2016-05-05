<?php
$mysqli = new mysqli('localhost', 'stud10_lushina', 'siski', 'stud10_lushina');
//Получаем массив нашего меню из БД в виде массива
mysqli_set_charset($mysqli, "utf8");

function getMenu($mysqli){
	$sql = 'SELECT * FROM `menu`';
	$res = $mysqli->query($sql);
//Создаем масив где ключ массива является ID меню
	$cat = array();
	while($row = $res->fetch_assoc()){
		$cat[$row['id']] = $row;
	}
	return $cat;
}
//Функция построения дерева из массива от Tommy Lacroix
function getTree($dataset) {
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
}

//Получаем подготовленный массив с данными
$cat  = getMenu($mysqli); 

//Создаем древовидное меню
$tree = getTree($cat);

//Шаблон для вывода меню в виде дерева
function tplMenu($category){

			$menu = ' <li><a href="'. $category['link'] .'" title="'. $category['title'] .'">'. 
		$category['title'].'</a>';
		
		if(isset($category['childs'])){
			$menu .= '<ul>'. showCat($category['childs']) .'</ul>';
		}
	$menu .= '</li>';
	
	return $menu;
}

/**
* Рекурсивно считываем наш шаблон
**/
function showCat($data){
	$string = '';
	foreach($data as $item){
		$string .= tplMenu($item);
	}
	return $string;
}

//Получаем HTML разметку
$cat_menu = showCat($tree);

//Выводим на экран
echo '<ul>'. $cat_menu .'</ul>';

?>