<?php
session_start();
require_once '../class/Cmysql.php';
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
                <span>
                    
                </span>
                <table>
                    <tr>
                        <th colspan="3">Etudiants</th>
                        <th colspan="2">Enseigants Chercheurs</th>
                    </tr>
                    <tr>
                        <th>numero</th>
                        <th>prenom</th>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>nom</th>
                    </tr>

                    <?php
                    $programme_id = $_SESSION['login_info']['programme_id'];
                    $mysql = new mysql();
                    $options = array(
                        'table' => 'etudiant,etudiant_conseiller,ec',
                        'fields' => 'etudiant.numero,etudiant.prenom,etudiant.nom,ec.prenom,ec.nom',
                        'condition' => "etudiant.programme_id='$programme_id' AND etudiant_conseiller.etudiant_numero=etudiant.numero AND ec.id=etudiant_conseiller.ec_id",
                        'group' => '1',
                        'order' => '1',
                        'limit' => 500
                    );
                    $result = $mysql->select($options);
                    foreach ($result as $value) {
                        echo "<tr>";
                        foreach ($value['etudiant'] as $etu) {
                            echo "<td>";
                            echo $etu;
                            echo "</td>";
                        }
                        foreach ($value['ec'] as $ec) {
                            echo "<td>";
                            echo $ec;
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
