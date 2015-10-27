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
                <h2>Ajouter un &#233;tudiant</h2>
                <form action="ajout_etudiant_action.php" method="post">
                    <table>
                        <tr>
                            <td><label>numero</label></td>
                            <td><input class="text" type="text" name="numero"/></td>
                        </tr>
                        <tr>
                            <td><label>prenom</label></td>
                            <td><input class="text" type="text" name="prenom"/></td>
                        </tr>
                        <tr>
                            <td><label>nom</label></td>
                            <td><input class="text" type="text" name="nom"/></td>
                        </tr>
                        <tr>
                            <td><label>programme</label></td>
                            <td><select name="programme">
                                    <option value='-1'>Selectionner programme</option>
                        <?php
                        $base = new PDO('mysql::host=localhost;dbname=wangyihe', 'wangyihe', "WLbY4P5m");
                        $requete = "select label from programme";
                        $result = $base->query($requete);
                        while ($row = $result->fetch()) {
                            echo '<option value="' . $row['label'] . '">' . $row['label'] . '</option>';
                        }
                        ?>
                    </select></td>
                        </tr>
                        <tr>
                            <td><label>semestre</label></td>
                                <td><select name="semestre">
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="valider"/>
                                <input type="reset" value="r&#233;initialiser"/></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
