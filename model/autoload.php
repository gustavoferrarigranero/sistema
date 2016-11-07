<?php
//Define autoloader
function __autoload($className) {

    if (file_exists(strtolower(getcwd() . '\\model\\' . $className) . '.php')) {
        require_once strtolower(getcwd() . '\\model\\' . $className) . '.php';
        return true;
    }
    if (file_exists(strtolower(getcwd() . '\\controller\\' . $className) . '.php')) {
        require_once strtolower(getcwd() . '\\controller\\' . $className) . '.php';
        return true;
    }
    if (file_exists(strtolower(getcwd() . '\\..\\model\\' . $className) . '.php')) {
        require_once strtolower(getcwd() . '\\..\\model\\' . $className) . '.php';
        return true;
    }
    if (file_exists(strtolower(getcwd() . '\\..\\controller\\' . $className) . '.php')) {
        require_once strtolower(getcwd() . '\\..\\controller\\' . $className) . '.php';
        return true;
    }
    return false;
}

function canClassBeAutloaded($className) {
    return class_exists($className);
}
?>