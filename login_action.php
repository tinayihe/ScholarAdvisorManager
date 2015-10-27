<?php
require_once 'class/Cuser.php';
session_start();

if (isset($_POST["login"]) && isset($_POST["key"])) {
    $user = new Cuser();
    if (!$user->USER_login($_POST["login"], $_POST["key"], $_SESSION)) {
        echo "ko";
    }
}

$page = 'login.php';
if ($_SESSION['login_info']['is_drh']==1){
    $page = 'drh/DRH.php';
    //include 'drh/DRH.php';
}

else if ($_SESSION['login_info']['is_scolarite']==1) {
    $page = 'scolarite/scolarite.php';
    //include 'scolarite/scolarite.php';
}

else if (isset ($_SESSION['login_info']['programme_id'])){
    $page = 'res_pro/res_pro.php';
    //include 'res_pro/res_pro.php';
}

echo "<script type='text/javascript'>window.location.assign('./" . $page . "')</script>";