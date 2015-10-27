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
                <h2>Ajouter un Enseigangt-Chercheur</h2>
                <form action="ajout_ec_action.php" method="post">
                    <table>
                        <tr>
                            <td><label>prenom</label></td>
                            <td><input class="text" type="text" name="prenom"/></td>
                        </tr>
                        <tr>
                            <td><label>nom</label></td>
                            <td><input class="text" type="text" name="nom"/></td>
                        </tr>
                        <tr>
                            <td><label>bureau</label></td>
                            <td><input class="text" type="text" name="bureau"/></td>
                        </tr>
                        <tr>
                            <td><label>pole</label></td>
                            <td><select name="pole">
                                    <?php
                                    $mysql = new mysql();
                                    $options = array(
                                        'table' => 'pole',
                                        'fields' => 'id,pole',
                                        'condition' => '1', //无条�
                                        'group' => '1',
                                        'order' => '1'
                                    );
                                    $result = $mysql->select($options);
                                    foreach ($result as $value) {
                                        foreach ($value as $tab_pole) {
                                            $pole=$tab_pole['pole'];
                                            $id=$tab_pole['id'];
                                            echo "<option value=$id>";
                                            echo $pole;
                                            echo "</option>";
                                        }
                                    }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit"/>
                                <input type="reset"/></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
