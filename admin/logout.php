<?php
require_once("../model/config.php");
$config = new Config();

setcookie('login', 0, -1, '/');
unset($_COOKIE['login']);
header('Location: '.URL.'admin/home.php');
die;