<?php

include_once "functions.php";
include_once 'config.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    delete_link($_GET['id']);
    $_SESSION['success'] = "Ссылка была успешно удалена!";
}

header("Location: ../profile.php");
die;