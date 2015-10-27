<?php
require_once '../class/Cscolarite.php';
require_once '../class/Cmysql.php';

$attributions = new Scolarite();
$result = $attributions->attribution_noveaux_etudiants();
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
                <a href="../login.php"><img src="../image/micro-icons-login.jpg" id='login'/></a>
            </div>
            <div id="navigation">
                <ul>
                    <li><a href="scolarite.php">Acceuil</a></li>
                    <li><a href="scolarite_etudiants_prog.php">liste des &#233;tudiants</a></li>
                    <li><a href="scolarite_sans_conseillers.php">&#233;tudiants sans conseillers</a></li>
                    <li><a href="scolarite_avec_conseiller.php">&#233;tudiants avec conseillers</a></li>
                    <li><a href="scolarite_conseillers.php">liste des conseillers</a></li>
                </ul>
            </div>
            <div id="contenu">
                <table id='ec_list'>
                    <thead>
                        <tr>
                            <th class='table-title' colspan='4'>R&#233;sultat d'attribution</th>
                        </tr>
                        <tr>
                            <th>num&#233;ro d'&#233;tudiant</th>
                            <th>&#233;tudiant</th>
                            <th>conseiller</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $base = new mysql();
                        $results = array();
                        foreach ($result as $key => $ec) {
                            if ($ec != null) {
                                $option = array('table' => 'etudiant AS e, ec',
                                    'fields' => 'e.numero, e.prenom, e.nom, ec.prenom, ec.nom',
                                    'condition' => 'e.numero="' . $key . '" AND ec.id="' . $ec . '"',
                                    'group' => '1',
                                    'order' => '1',
                                    'limit' => 30);
                                $results[$key] = $base->select($option);
                            }
                        }
                        if (is_array($results)) {
                            //var_dump($results);
                            foreach ($results as $cle => $value) {
                                echo "<tr>";
                                echo "<td>" . $value[0]["e"]["numero"] . "</td>";
                                echo "<td>" . $value[0]["e"]["prenom"] . " " . $value[0]["e"]["nom"] . "</td>";
                                echo "<td>" . $value[0]["ec"]["prenom"] . " " . $value[0]["ec"]["nom"] . "</td>";
                                echo"</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <br /><br /><br /><br />
                <a href="scolarite.php">Retour</a>
            </div>
    </body>
</html>
