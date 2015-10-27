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
                <form method="post" action="habi_ec_action.php">
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
