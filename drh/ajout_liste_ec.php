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
                <h2>Ajouter une liste de EC</h2>
                <form id="form_ajout_liste_ec" action="ajout_liste_ec_action.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="liste_ec"/>
                    <p/>
                    <input id="button_ajout_liste_ec" type="button" value="T&eacute;l&eacute;charger"/>
                    <input type="reset"/>
                </form>

                <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
                <script type="text/javascript">
                    $('#button_ajout_liste_ec').on('click', function() {
                        var filename = $('input[name="liste_ec"]').val();
                        $.get('../ajax_php/checkUpload.php', {filename: filename}, function(msg) {
                            if (msg !== 'ok') {
                                alert(msg);
                            } else {
                                $('#form_ajout_liste_ec').submit();
                            }
                        })
                    });
                </script>
            </div>
        </div>
    </body>
</html>
