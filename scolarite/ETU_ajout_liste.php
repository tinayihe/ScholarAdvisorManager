<?php
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
    </head>
    <body >
        <div id="global">
            <div id="entete" >
                <img src="../image/utt_logo.jpg" height="70"/>
                <a href="../login.php"><img src="../image/micro-icons-login.jpg"/></a>
            </div>
            <div id="navigation">
                <ul>
                    <li><a href="../scolarite/scolarite.php">Acceuil</a></li>
                    <li><a href="../scolarite/scolarite_etudiants_prog.php">liste des &#233;tudiants</a></li>
                    <li><a href="../scolarite/scolarite_sans_conseillers.php">&#233;tudiants sans conseillers</a></li>
                    <li><a href="../scolarite/scolarite_avec_conseiller.php">&#233;tudiants avec conseillers</a></li>
                    <li><a href="../scolarite/scolarite_conseillers.php">liste des conseillers</a></li>
                </ul>
            </div>
            <div id="contenu">
                <h2>Ajouter une liste d'&#233;tudiants</h2>
                <form id="form_ajout_liste_etu" action="ETU_ ajout_liste_action.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="liste_etu"/><br />
                    <input id="button_ajout_liste_etu" type="button" value="T&eacute;l&eacute;charger"/>
                    <input type="reset"/>
                </form>
                
                <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
                <script type="text/javascript">
                    $('#button_ajout_liste_etu').on('click', function() {
                        var filename = $('input[name="liste_etu"]').val();
                        $.get('../ajax_php/checkUpload.php', {filename: filename}, function(msg) {
                            if (msg !== 'ok') {
                                alert(msg);
                            } else {
                                $('#form_ajout_liste_etu').submit();
                            }
                        })
                    });
                </script>
            </div>
        </div>
    </body>
</html>
