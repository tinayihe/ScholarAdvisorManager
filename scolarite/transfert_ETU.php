<?php
require_once '../class/Cscolarite.php';
$transfert = new Scolarite;
$result= $transfert->attribution_etudiant_transfert($_GET['nom'], $_GET['prenom'],$_GET['numero'], $_GET['programme']);
if ($result != false) {
    $base = new PDO('mysql::host=localhost;dbname=wangyihe', 'wangyihe', "WLbY4P5m");
    $requete = 'select nom, prenom FROM ec WHERE id = '.$result['ec_id'];
    $statement=$base->query($requete);
    $ec=$statement->fetchAll(PDO::FETCH_ASSOC);
}
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="../css/base.css">
        <link rel="stylesheet" type="text/css" href="../css/modele.css">
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="">
        <meta name="keywords" content="">
    </head>
    <body >
        <div id="global">
            <div id="entete" >
                <img src="../image/utt_logo.jpg" height="70"/> 
                <a href="../login.php"><img src="../image/micro-icons-login.jpg" id='login'/></a>
            </div>
            <div id="navigation">
                <ul>
                    <li><a href="scolarite.php">Acceuil</a></li>
                    <li><a href="scolarite_etudiants_prog.php">liste des &#233;tudiants</a></li>
                    <li><a href="scolarite_sans_conseillers.php">&#233;tudiants sans conseillers</a></li>
                    <li><a href="scolarite_avec_conseiller.php">&#233;tudiants avec conseillers</a></li>
                    <li><a href="scolarite_conseillers.php">liste des conseillers</a></li>
                </ul>
            </div>
            <div id="contenu">
                <?php
                    if ($result == false) {
                        echo "Le conseiller de ".$_GET['prenom']. " ".$_GET['nom']." ne change pas.";
                    } else {
                        echo $_GET['prenom']. " ".$_GET['nom']." est transfert au conseiller ". $ec['0']['prenom']." ".$ec['0']['nom'].".";
                    }
                ?>
                <br /><br /><br /><br />
                <a href="scolarite.php">Retour</a>
            </div>
    </body>
</html>