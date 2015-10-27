<?php
require_once '../class/ClassEC.php';
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
                    <li><a href="../drh/DRH.php">liste des EC</a></li>
                    <li><a href="../drh/DRH_etu.php">liste des EC avec etudiants</a></li>
                    <li><a href="../drh/DRH_nom_etu.php">liste des EC avec nombre d'etudiants</a></li>
                </ul>
            </div>
            <div id="contenu">
                <span>
                    <a href="#" title="vider la liste" id="vide"><img src="../image/micro-icons-vider.jpg"/></a>
                    <a href="../drh/ajout_un_ec.php" title="ajouter un EC" id="ajouter"><img src="../image/micro-icons-ajouter.jpg"></a>
                    <a href="ajout_liste_ec.php" title="ajouter un liste des EC"><img src="../image/micro-icons-ajout-liste.jpg"></a>
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
                    $ec = new EC();
                    $mysql=new mysql();
                    $result = $ec->EC_visualisation();
                    foreach ($result as $value) {
                        echo "<tr id='ec_" . $value['ec']['id'] . "'>";
                        echo "<td class='id'>";
                        echo $value['ec']['id'];
                        echo "</td>";
                        echo "<td class='prenom'>";
                        echo $value['ec']['prenom'];
                        echo "</td>";
                        echo "<td class='nom'>";
                        echo $value['ec']['nom'];
                        echo "</td>";
                        echo "<td class='bureau'>";
                        echo $value['ec']['bureau'];
                        echo "</td>";
                        $pole_id=$value['ec']['pole_id'];
                        $default1 = array(
                            'table' => 'pole',
                            'fields' => 'pole',
                            'condition' => "pole.id='$pole_id'",
                            'order' => '1',
                            'limit' => 500
                        );
                        $result1 = $mysql->select($default1);
                        echo "<td class='" . $result1[0]['pole']['pole'] . "'>";
                        echo $result1[0]['pole']['pole'];
                        echo "</td>";
                        echo "<td>";
                    echo "<img class='button_delete' title='delete ec " . $value['ec']['id'] . "' alt='ec_" . $value['ec']['id'] . "' src='../image/micro-icons-suppression.jpg'>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript">
            $("#vide").on("click", function() {
                var r = confirm("Vous voulez vider la liste?");
                if (r == true)
                {
                    $.get("../ajax_php/videECList.php", {}, function(data) {
                        window.location.reload()
                    });
                }
            });

            $(".button_delete").on("click", function() {
                var ec_id = $(this).attr('alt');
                var nom = $("#" + ec_id + " td.nom").html();
                var prenom = $("#" + ec_id + " td.prenom").html();

                var r = confirm("Vous voulez supprimer '" + nom + " " + prenom + "'?");
                if (r === true) {
                    $.get("../ajax_php/deleteEC.php", {nom: nom, prenom: prenom}, function() {
                        window.location.reload();
                    });
                }
            });
        </script>
    </body>
</html>
