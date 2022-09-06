<?php
include_once './components/config.php';

function get_url($pageName = ''){
    return SITE_URL . "/$pageName";
}

function get_db(){
    return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}

function selectFunc($macros = ''){
    if(empty($macros)) return;
    return get_db()->query($macros);
}



function get_sum_link(){
    return selectFunc("SELECT SUM(`views`) AS `sumViews` FROM `links`")->fetch_assoc();
}
function get_count_links(){
    return selectFunc("SELECT COUNT(`full_link`) AS `allLinks` FROM `links`")->fetch_assoc();
}
function get_count_user(){
    return selectFunc("SELECT COUNT(`login`) AS `allUsers` FROM `users`")->fetch_assoc();
}

function get_user_register($user_login){
	if(empty($user_login)) return [];
	return selectFunc("SELECT * FROM `users` WHERE `login` = '$user_login';")->fetch_assoc();
}


function get_view_link(){
    if(isset($_GET['url']) && !empty($_GET['url'])){
		$url = strtolower(trim($_GET['url']));
		$checkLink = selectFunc("SELECT * FROM `links` WHERE `short_link` = '$url'")->fetch_assoc();
		if($checkLink == null){
			header('Location: 404.php');
		} else{
			selectFunc("UPDATE `links` SET `views` = `views` + 1 WHERE `short_link` = '$url'");
			header('Location: ' . $checkLink['full_link']);
			die;
		}
	} 
}

function add_user($login, $password){
	$password = password_hash($password, PASSWORD_DEFAULT);
	return selectFunc("INSERT INTO `users` (`login`,`password`) VALUES ('$login','$password');");
}

function register_user($data){
	if(
		empty($data) || 
		!isset($data['login']) || 
		empty($data['login']) || 
		!isset($data['password']) ||
		!isset($data['again_password'])
	){
		return false;
	} 

	$user = get_user_register($data['login']);

	if(!empty($user)){
		$_SESSION['error'] = "Пользователь с таким логином уже существует";
		header("Location: register.php");
		die;
	}

	if($data['password'] !== $data['again_password']){
		$_SESSION['error'] = "Введеные пароли не совпадают";
		header("Location: register.php");
		die;
	}

	add_user($data['login'], $data['password']);

	$_SESSION['success'] = "Успешная регистрация";
	header("Location: register.php");

	return true;
}

function autorize_user($data){
	if(
		empty($data) || 
		!isset($data['login']) || 
		empty($data['login']) || 
		!isset($data['password']) ||
		empty($data['password'])
	){
		$_SESSION['error'] = "Логин и/или пароль не может быть пустым";
		header("Location: login.php");
		die;
	} 

	$user = get_user_register($data['login']);

	if(empty($user)){
		$_SESSION['error'] = "Логин и/или пароль неверны(-й)";
		header("Location: login.php");
		die;
	}

	if(password_verify($data['password'], $user['password'] )){
		$_SESSION['user'] = $user;
		header("Location: profile.php");
		die;
	} else {
		$_SESSION['error'] = "Логин и/или пароль неверны(-й)";
		header("Location: login.php");
		die;
	}
}


function get_user_links($user_id){
	if(empty($user_id)) return [];
	return selectFunc("SELECT * FROM `links` WHERE `user_id` = '$user_id'")->fetch_all();
}


function delete_link($link_id){
	if(empty($link_id)) return false;
	return selectFunc("DELETE FROM `links` WHERE `id` = '$link_id'");
}


function add_link($link, $user_id){
	if(empty($link) || empty($link)) return false;
	$short_link = generate_short_link();
	return selectFunc("INSERT INTO `links` (`full_link`, `user_id`, `short_link`) VALUES ('$link','$user_id','$short_link')");
}

function generate_short_link($size = 6){
	$rand_str = str_shuffle(URL_CHARS);
	return substr($rand_str, 0, $size);
}