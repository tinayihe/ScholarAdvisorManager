<?php
require_once '../class/ClassEC.php';
require_once '../class/Cmysql.php';
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="../css/base.css">
        <link rel="stylesheet" type="text/css" href="../css/modele_ajoute_ec.css">
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="CV">
        <meta name="keywords" content="">
        <meta http-equiv="refresh" content="3; url=DRH.php">
    </head>
    <body >
        <div id="global">
            <div id="entete" >
                <img src="../image/utt_logo.jpg" height="70"/>
                <a href="../login.php"><img src="../image/micro-icons-login.jpg" id='login'/></a>
            </div>
            <div id="navigation">
                <ul>
                    <li><a href="DRH.php">liste des EC</a></li>
                    <li><a href="DRH_etu.php">liste des EC avec etudiants</a></li>
                    <li><a href="DRH_nom_etu.php">liste des EC avec nombre d'etudiants</a></li>
                </ul>
            </div>
            <div id="contenu">
                <?php
                $ec = new EC();
                $doublon=$ec->EC_ajout($_POST['prenom'], $_POST['nom'], $_POST['bureau'], $_POST['pole']);
                if($doublon==1){
                    echo "<h2>reussi a ajouter</h2>";
                }else {
                    echo "<h2>";
                    echo $_POST['prenom']." ". $_POST['nom']. " existe";
                    echo "</h2>";
                }
                ?>
                <h3>Redirection en cours...</h3>
            </div>
        </div>
    </body>
</html>

