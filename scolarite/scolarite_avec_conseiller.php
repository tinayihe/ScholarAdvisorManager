<?php
require_once '../class/Cetudiant.php';
require_once '../Utils.php';
require_once '../class/Cscolarite.php';
$programme = isset($_GET['programme']) ? $_GET['programme'] : '-1';
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
           <!--     <span>
                    <a href="#" title="vider la liste" id="vide"><img src="image/micro-icons-vider.jpg"/></a>
                    <a href="" title="ajouter un EC" id='ajouter'><img src="image/micro-icons-ajouter.jpg"></a>
                    <a href="#" title="suppremer un EC" id='delete'><img src="image/micro-icons-suppression.jpg"></a>
                    <a href="" title="ajouter un liste des EC" id='ajoutliste'><img src="image/micro-icons-ajout-liste.jpg"></a>
                </span>
                -->
                <form id="form_filtre_programme" method="get" action="">
                    <select name="programme" id="filtre_programme" value="<?php echo $programme ?>">
                        <option value='-1'>Selectionner programme</option>
                        <?php
                        $base = new PDO('mysql::host=localhost;dbname=wangyihe', 'wangyihe', "WLbY4P5m");
                        $requete = "select label from programme";
                        $result = $base->query($requete);
                        while ($row = $result->fetch()) {
                            echo '<option value="' . $row['label'] . '">' . $row['label'] . '</option>';
                        }
                        ?>
                    </select>
                </form>

                <table id='ec_list'>
                    <thead>
                        <tr>
                            <th class='table-title' colspan='4'>&#233;tudiants avec conseillers</th>
                        </tr>
                        <tr>
                            <th>num&#233;ro d'&#233;tudiant</th>
                            <th>&#233;tudiant</th>
                            <th>conseiller</th>
                            <th>programme</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $etudiant = new Scolarite();
                        if ($programme != '-1') {
                            $result = $etudiant->ETU_avec_conseillet_list($programme);
                            foreach ($result as $cle => $value) {
                                echo "<tr>";
                                echo "<td>";
                                echo $value['e']['numero'];
                                echo "</td>";
                                echo "<td>";
                                echo $value['e']['prenom'] . " " . $value['e']['nom'];
                                echo "</td>";
                                echo "<td>";
                                echo $value['ec']['prenom'] . " " . $value['ec']['nom'];
                                echo "</td>";
                                echo "<td>";
                                echo $value['p']['label'];
                                echo "</td>";
                                echo "</tr>";
                            }
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


        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
            if ($('#filtre_programme').attr('value') !== undefined && $('#filtre_programme').attr('value') !== '') {
            $('option[value="' + $('#filtre_programme').attr('value') + '"]', $('#filtre_programme')).prop('selected', 'selected');
            }
            });

            $('#filtre_programme').on("change", function() {
            $('#form_filtre_programme').submit();
            });
        </script>

    </body>
</html>


