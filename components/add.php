<?php

include "./config.php";
include "./functions.php";

if(isset($_POST['link']) || !empty($_POST['link']) && isset($_POST['user_id']) || !empty($_POST['user_id'])){
    if(add_link($_POST['link'], $_POST['user_id'])){
        $_SESSION['success'] = "Ссылка успешно добавлена";
    } else {
        $_SESSION['error'] = "При добавлении ссылки произошла ошибка";
    }
}


header("Location: ../profile.php");
die;
