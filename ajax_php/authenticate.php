<?php
require_once '../class/Cuser.php';

$login = isset($_GET["login"]) ? $_GET["login"] : "";
$password = isset($_GET["key"]) ? $_GET["key"] : "";
$user = new Cuser();
echo json_encode($user->USER_login($login, $password));