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
                $programme_id=$_SESSION['login_info']['programme_id'];
                $mysql = new mysql();
                $options = array(
                    'table' => 'ec',
                    'fields' => 'id',
                    'condition' => 'prenom="'.$_POST['prenom'].'" and nom="'.$_POST['nom'].'"', //无条�?
                    'group' => '1',
                    'order' => '1',
                    'limit' => 500
                );
                $result = $mysql->select($options);
                if(empty($result)==1){
                    echo "EC ".$_POST['prenom']." ".$_POST['nom']." n'existe pas";
                }else{
                    $habi=new CHabilitation();
                    $doublon = $habi->Habilitation_ajout($result[0]['ec']['id'], $programme_id);
                    if ($doublon==1){
                        echo "habilitation reussi";
                    }else {
                        echo $_POST['prenom']." ".$_POST['nom']." deja habilite";
                    }
                }
                ?>
                <h3>Redirection en cours...</h3>
            </div>
        </div>
    </body>
</html>
