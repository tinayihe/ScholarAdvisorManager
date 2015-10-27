<?php
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
                    <li><a href="DRH.php">liste des EC</a></li>
                    <li><a href="DRH_etu.php">liste des EC avec etudiants</a></li>
                    <li><a href="DRH_nom_etu.php">liste des EC avec nombre d'etudiants</a></li>
                </ul>
            </div>
            <div id="contenu">
                

                <table>
                    <tr>
                        <th colspan="4">Enseigants Chercheurs</th>
                        <th colspan="3">Etudiants</th>
                    </tr>
                    <tr>
                        <th>prenom</th>
                        <th>nom</th>
                        <th>bureau</th>
                        <th>pole</th>
                        <th>numero</th>
                        <th>prenom</th>
                        <th>nom</th>
                    </tr>
                    <?php
                    $mysql = new mysql();
                    $options1 = array(
                        'table' => 'ec',
                        'fields' => 'id,prenom,nom,bureau,pole_id',
                        'condition' => '1',
                        'order' => '1',
                        'limit' => 500
                    );
                    $result1 = $mysql->select($options1);
                    foreach ($result1 as $tab_ec) {
                        $ec_id = $tab_ec['ec']['id'];
                        $options2 = array(
                            'table' => 'etudiant,etudiant_conseiller',
                            'fields' => 'etudiant.numero,etudiant.prenom,etudiant.nom',
                            'condition' => "etudiant_conseiller.ec_id='$ec_id' and etudiant.numero=etudiant_conseiller.etudiant_numero",
                            'order' => '1',
                            'limit' => 500
                        );
                        $result2 = $mysql->select($options2);
                        $pole_id = $tab_ec['ec']['pole_id'];
                        $options3 = array(
                            'table' => 'pole',
                            'fields' => 'pole',
                            'condition' => "id='$pole_id'",
                            'order' => '1',
                            'limit' => 500
                        );
                        $result3 = $mysql->select($options3);
                        $num=  count($result2);
                        if ($num>1){
                            echo "<tr>";
                            echo "<td rowspan=$num>";
                            echo $tab_ec['ec']['prenom'];
                            echo "</td>";
                            echo "<td rowspan=$num>";
                            echo $tab_ec['ec']['nom'];
                            echo "</td>";
                            echo "<td rowspan=$num>";
                            echo $tab_ec['ec']['bureau'];
                            echo "</td>";
                            echo "<td rowspan=$num>";
                            echo $result3[0]['pole']['pole'];
                            echo "</td>";
                            foreach ($result2[0]['etudiant'] as $etu1) {
                                echo "<td>";
                                echo $etu1;
                                echo "</td>";
                            }
                            echo "</tr>";
                            for($i=1;$i<$num;$i++){
                                foreach ($result2[$i]['etudiant'] as $etu2) {
                                echo "<td>";
                                echo $etu2;
                                echo "</td>";
                            }
                            }
                            echo "</tr>";
                        }  else if($num!=0){
                            echo "<tr>";
                            echo "<td>";
                            echo $tab_ec['ec']['prenom'];
                            echo "</td>";
                            echo "<td>";
                            echo $tab_ec['ec']['nom'];
                            echo "</td>";
                            echo "<td>";
                            echo $tab_ec['ec']['bureau'];
                            echo "</td>";
                            echo "<td>";
                            echo $result3[0]['pole']['pole'];
                            echo "</td>";
                            foreach ($result2[0]['etudiant'] as $etu3) {
                                echo "<td>";
                                echo $etu3;
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
       
    </body>
</html>
