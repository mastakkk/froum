<?
require_once "../libs/rb.php";

session_start();

R::setup('mysql:host=127.0.0.1;dbname=froum',
        'root', '');

if (!R::testConnection()) {
	exit('Нет подключине');
}


// Получение самой статьи 
function getSingles_all() {
	$singles = R::find('singles');
	return $singles;
}


function getSingle_by_id($id) {
	$single = R::findOne('singles', "WHERE id = $id");
	return $single;
}

// Получение всех популярных статей
function getSingles_by_pop_all() {
	$singles = R::find('singles', "ORDER BY views DESC");
	return $singles;
}

// Вывод всех пользователей
function getUsers_all() {
	$users = R::find('users');
	return $users;
}


// Получение статьи по id
function getSingles_by_id($x) {
	$singles = R::find('singles', "id = $x");
	foreach ($singles as $single) {
		return $single;
	}
}


// Получение статьи по популярности
function getSingles_by_pop() {
	$singles = R::find('singles', "ORDER BY views DESC");
	return $singles;
}





// Получение юзера из другой таблицы 
function getUser_by_id($id) {
	$users = R::find('users', "WHERE id = $id");
	foreach ($users as $user) {
		return $user;
	}
}


// Рандомная статья 
function getSingle_by_rand() {
	$single = R::findOne('singles', "WHERE id ORDER BY RAND()");
	return $single;
}

// Самая популярная статья 
function getSingle_by_pop() {
	$single = R::findOne('singles', "ORDER BY views DESC LIMIT 1");
	return $single;
}

// Последняя статья
function getSingle_by_lastdate() {
	$single = R::findOne('singles', "WHERE id ORDER BY date DESC LIMIT 1");
	return $single;
}

// Получение всех комментариев
function getComments_all($id) {
	$comments = R::find('comments', "id_single = $id");
	return $comments;
}

// Полсчитываем кол-во стр 
function getCount_by_singles() {
	$pages = R::count('singles');
	return $pages;
}

// Считаем сколько всего статей в одной категгории
function getCount_for_Category($id_category) {
	$count_categories = R::count('singles', "WHERE id_category = $id_category");
	return $count_categories;
}



// Находим лайк
function getLike_by_id($y, $x) {
	$like = R::findOne('likes', "WHERE id_single = $y AND id_user_id = $x");
	return $like;
}

// Считает лайки
function getCount_like($id) {
	$like_count = R::count('likes', "WHERE id_single = $id");
	$new_like_count = R::exec("UPDATE `singles` SET likes = $like_count WHERE id = $id");
	return $like_count;
}

// Считает комменты
function getCount_comments($id) {
	$comments_count = R::count('comments', "WHERE id_single = $id");
	$new_comments_count = R::exec("UPDATE `singles` SET comments = $comments_count WHERE id = $id");
	return $comments_count;
}

// Счетчик просмотров
function views_update($id) {
	$views = R::exec("UPDATE `singles` 	SET views = views + 1 WHERE id = $id");
	return $views;
}

// Определяет чья эта статья 
function getYour_state($id_single, $id_user) {
	$your_state = R::find('singles', "WHERE id = $id_single, id_user = $id_user");
	return $your_state;
}

// Определяет твоя ли это статья
function getYour_ownState($id_user) {
	$your_own_state = R::findOne('singles', "WHERE id_user = $id_user");
	return $your_own_state;
}
// Найти одного пользователя
function getUser($id) {
	$user = R::findOne('users', "WHERE id = $id");
	return $user;
}


// Определяет привилегию
function getPrivilege_for_user($user) {
	$user_privilege = "";
	if ($user->privilege == 1) {
		$user_privilege = "Пользователь";
	} elseif ($user->privilege == 2) {
		$user_privilege = "Соруководитель";
	} elseif ($user->privilege == 3) {
		$user_privilege = "Админ";
	}
	return $user_privilege;
}

// Достает все категории
function getCategory_all() {
	$categories = R::find('categories');
	return $categories;
}



function getCategory_reduct($single) {
	if ($single->category == 1) {
		echo "selected";
	} elseif ($single->category == 2) {
		echo "selected";
	} 
}

// Получение категории
function getCategory_by_name($id) {
	$category = R::findOne('categories', "WHERE id = $id");
	return $category;
}

function getSingles_by_category($id) {
	$singles = R::find('singles', "WHERE id_category = $id");
	return $singles;
}


// Провереям на наличие лайков у пользователя
function getLike($single, $user) {
	$getLike = R::exec("SELECT * FROM `likes` WHERE `id_single` = $single AND `id_user_id` = $user");
	return $getLike;
}

?>