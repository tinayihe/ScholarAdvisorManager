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
                <form action="habi_pole_action.php" method="post">
                    <label>Selectez un pole</label>
                    <p/>
                    <select name="pole_id">
                        <?php
                        $programme_id=$_SESSION['login_info']['programme_id'];
                        $mysql = new mysql();
                        $options = array(
                            'table' => 'pole, pole_programme',
                            'fields' => 'pole.id,pole.pole',
                            'condition' => "pole_programme.programme_id=$programme_id and pole_programme.pole_id=pole.id", //无条�
                            'group' => '1',
                            'order' => '1'
                        );
                        $result = $mysql->select($options);
                        foreach ($result as $value) {
                            foreach ($value as $tab_pole) {
                                $pole = $tab_pole['pole'];
                                $id = $tab_pole['id'];
                                echo "<option value=$id>";
                                echo $pole;
                                echo "</option>";
                            }
                        }
                        ?>
                    </select>

                    <p/>
                    <input type="submit"/>
                    <input type="reset"/>
                </form>
            </div>
        </div>
    </body>
</html>
