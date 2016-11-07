<?php
require_once("../model/config.php");
$config = new Config();

if(isset($_COOKIE['login']) && $_COOKIE['login']){
    header('Location: home.php');
}else{
    include_once("header.php");
    ?>

<?php
}

