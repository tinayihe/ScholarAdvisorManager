<?php
session_start();
require_once '../class/Cmysql.php';
require_once '../class/CHabilitation.php';
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="../css/base.css">
        <link rel="stylesheet" type="text/css" href="../css/modele.css">
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="CV">
        <meta name="keywords" content="">
        <meta http-equiv="refresh" content="3; url=res_pro.php">

    </head>
    <body >
        <div id="global">
            <div id="entete" >
                <img src="../image/utt_logo.jpg" height="70"/> 
                <a href="../login.php"><img src="../image/micro-icons-login.jpg" id='login'/></a>
            </div>
            <div id="navigation">
                <ul>
                    <li><a href="res_pro.php">liste des EC</a></li>
                    <li><a href="res_pro_etu.php">liste des etudiants</a></li>
                </ul>
            </div>
            <div id="contenu">
                <?php
                $programme_id = $_SESSION['login_info']['programme_id'];
                $mysql = new mysql();
                $habi = new CHabilitation();
                $pole_id = $_POST['pole_id'];
                $options = array(
                    'table' => 'ec',
                    'fields' => 'id',
                    'condition' => "pole_id=$pole_id",
                    'group' => '1',
                    'order' => '1'
                );
                $result = $mysql->select($options);
                foreach ($result as $value) {
                    $ec_id = $value['ec']['id'];
                    $habi->Habilitation_ajout($ec_id, $programme_id);
                }
                ?>
                <h3>reussi a habiliter</h3>
                <h3>Redirection en cours...</h3>
            </div>
        </div>
    </body>
</html>
