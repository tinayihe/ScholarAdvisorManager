<?php  require_once '../class/ClassEC.php';
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
                <a href="../login.php"><img src="../image/micro-icons-login.jpg"id='login'/></a>
            </div>
            <div id="navigation">
                <ul>
                    <li><a href="DRH.php">liste des EC</a></li>
                    <li><a href="DRH_etu.php">liste des EC avec etudiants</a></li>
                    <li><a href="DRH_nom_etu.php">liste des EC avec nombre d'etudiants</a></li>
                </ul>
            </div>
            <div id="contenu">
                

                <table>
                    <tr> 
                        <th>prenom</th>
                        <th>nom</th>
                        <th>bureau</th>
                        <th>pole</th>
                        <th>nombre de conseilles</th>
                    </tr>
                    <?php
                    $mysql = new mysql();
                    $ec = new EC();
                    $result = $ec->EC_visualisation_nombre_etudiants_decroissant();
                    foreach ($result as $value) {
                        $ec_id = $value['ec_id'];
                        $default1 = array(
                            'table' => 'ec',
                            'fields' => 'ec.prenom,ec.nom,ec.bureau,ec.pole_id',
                            'condition' => "ec.id='$ec_id'",
                            'order' => '1',
                            'limit' => 500
                        );
                        $result1 = $mysql->select($default1);
                        $pole_id=$result1[0]['ec']['pole_id'];
                        $default2 = array(
                            'table' => 'pole',
                            'fields' => 'pole',
                            'condition' => "pole.id='$pole_id'",
                            'order' => '1',
                            'limit' => 500
                        );
                        $result2 = $mysql->select($default2);
                        echo "<tr>";
                        echo "<td>";
                        echo $result1[0]['ec']['prenom'];
                        echo "</td>";
                        echo "<td>";
                        echo $result1[0]['ec']['nom'];
                        echo "</td>";
                        echo "<td>";
                        echo $result1[0]['ec']['bureau'];
                        echo "</td>";
                        echo "<td>";
                        echo $result2[0]['pole']['pole'];
                        echo "</td>";
                        echo "<td>";
                        echo $value[1];
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        
    </body>
</html>
