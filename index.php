<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('ROOT', dirname(__FILE__));

if($_SERVER['REQUEST_METHOD']=='POST'){
    include_once(ROOT . '/class/contact.php');
    $router = new Contact();
    echo $router->contactData();
    exit();
}
require_once ROOT . '/view/form.html';