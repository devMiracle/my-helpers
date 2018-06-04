<?php
include_once "helper/php/autoload_helper.php";
use chuks\php\helpers\URL;

// print_r(URL);

$urlArray = [
    "home" => "index.php",
    "dashboard" => "dashboard.php",
    "login" => "login.php",
    "register" => "register.php"
];

URL::addUrlPath($urlArray);
?>
<a href="<?= URL::base_url("dashboard") ?>">Hello</a></li>