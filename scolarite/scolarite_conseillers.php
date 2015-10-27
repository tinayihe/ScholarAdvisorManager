<?php
require_once '../class/Cetudiant.php';
require_once '../Utils.php';
require_once '../class/Cscolarite.php';
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
                <a href="../login.php"><img src="../image/micro-icons-login.jpg" id="login"/></a>                
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

                <table id='ec_list'>
                    <thead>
                        <tr>
                            <th class='table-title' colspan='4'>liste des conseillers</th>
                        </tr>
                        <tr>
                            <th>pr&#233;nom</th>
                            <th>nom</th>
                            <th>pole</th>
                            <th>nombre de conseill&#233;s</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $etudiant = new Scolarite();
                        $result = $etudiant->liste_conseillers_ordonnes_desc();
                        foreach ($result as $cle => $value) {
                            echo "<tr>";
                            echo "<td>";
                            echo $value['ec']['prenom'];
                            echo "</td>";
                            echo "<td>";
                            echo $value['ec']['nom'];
                            echo "</td>";
                            echo "<td>";
                            echo $value['pole']['pole'];
                            echo "</td>";
                            echo "<td>";
                            echo $value[0]['nb_etu'];
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--
            <div id="pied">
                <p id="copyright">utt</p>
            </div>
            -->
        </div>
    </body>
</html>


