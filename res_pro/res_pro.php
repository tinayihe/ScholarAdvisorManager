<?php
if (!isset($_SESSION)) {
    session_start();
}

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
                    <li><a href="../res_pro/res_pro.php">liste des EC</a></li>
                    <li><a href="../res_pro/res_pro_etu.php">liste des etudiants</a></li>
                </ul>
            </div>
            <div id="contenu">
                <span>
                    <a href="../res_pro/habi_ec.php" title="habiliter un EC" id="ajouter"><img src="../image/micro-icons-ajouter.jpg"></a>
                    <a href="../res_pro/habi_pole.php" title="habiliter par pole" id="habi_auto"><img src="../image/micro-icons-ajout_auto.jpg"></a>
                </span>
                <table>
                    <tr> 
                        <th>id</th>
                        <th>prenom</th>
                        <th>nom</th>
                        <th>bureau</th>
                        <th>pole</th>
                        <th>action</th>
                    </tr>
                    <?php
                    $programme_id = $_SESSION['login_info']['programme_id'];
                    $mysql = new mysql();
                    $default1 = array(
                        'table' => 'ec,ec_programme_habilitation',
                        'fields' => 'ec.id,ec.prenom,ec.nom,ec.bureau,ec.pole_id',
                        'condition' => "ec_programme_habilitation.programme_id=$programme_id and ec.id=ec_programme_habilitation.ec_id",
                        'order' => '1',
                        'limit' => 500
                    );
                    $result1 = $mysql->select($default1);
                    foreach ($result1 as $value) {
                        foreach ($value as $tab_ec) {
                            echo "<tr id='ec_" . $tab_ec['id'] . "'>";
                            $pole_id = $tab_ec['pole_id'];
                            $default2 = array(
                                'table' => 'pole',
                                'fields' => 'pole',
                                'condition' => "id='" . $pole_id . "' ",
                                'order' => '1',
                                'limit' => 500
                            );
                            $result2 = $mysql->select($default2);
                            echo "<td class='id'>";
                            echo $tab_ec['id'];
                            echo "</td>";
                            echo "<td class='prenom'>";
                            echo $tab_ec['prenom'];
                            echo "</td>";
                            echo "<td class='nom'>";
                            echo $tab_ec['nom'];
                            echo "</td>";
                            echo "<td class='bureau'>";
                            echo $tab_ec['bureau'];
                            echo "</td>";
                            echo "<td class='pole'>";
                            echo $result2[0]['pole']['pole'];
                            echo "</td>";
                            echo "<td>";
                            echo "<img class='button_delete' title='delete ec " . $tab_ec['id'] . "' alt='" . $tab_ec['id'] . "' src='../image/micro-icons-suppression.jpg'>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>

            </div>
        </div>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript">

            
            $(".button_delete").on("click", function() {
                var ec_id = $(this).attr('alt');
                var nom = $("#ec_" + ec_id + " td.nom").html();
                var prenom = $("#ec_" + ec_id + " td.prenom").html();

                var r = confirm("Vous voulez supprimer '" + nom + " " + prenom + "'?");
                if (r === true) {
                    $.get("../res_pro/sup_habi.php", {ec_id: ec_id}, function() {
                        window.location.reload();
                    });
                }
            });
        </script>
    </body>
</html>
