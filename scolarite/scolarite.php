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
                <!--
                <span>
                    <a href="#" title="vider la liste" id="vide"><img src="image/micro-icons-vider.jpg"/></a>
                    <a href="" title="ajouter un EC" id='ajouter'><img src="image/micro-icons-ajouter.jpg"></a>
                    <a href="#" title="suppremer un EC" id='delete'><img src="image/micro-icons-suppression.jpg"></a>
                    <a href="" title="ajouter un liste des EC" id='ajoutliste'><img src="image/micro-icons-ajout-liste.jpg"></a>
                </span>
                -->
                <form id="attribution_form" class='nouvel_etudiant' method="GET" action="scolarite_attribution_nouvel_etudiant.php">
                    <h3>attribution nouvel &#233;tudiant<br /></h3>
                    <div><label>prenom:</label>
                        <input class="text" type="text" name="prenom" required /></div>
                    <div><label>nom:</label>
                        <input class="text" type="text" name="nom" required /></div>
                    <div><label>programme:</label>
                        <select name="programme" required>
                            <option></option>
                            <option>ISI</option>
                            <option>SM</option>
                            <option>MTE</option>
                            <option>SI</option>
                            <option>SRT</option>
                            <option>TC</option>
                        </select></div>
                    <input id='attribution_submit' type="button" value='Attribuer'/>
                    <input type="reset"/></td>
                </form>

                <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
                <script type='text/javascript'>
                    $('#attribution_submit').on('click', function() {
                    var nom = $("input[name='nom']").val();
                    var prenom = $("input[name='prenom']").val();
                    var programme = $("select[name='programme']").val();
                    $.get('../ajax_php/attributionCheck.php', {nom: nom, prenom: prenom, programme: programme}, function(result) {
                    if (result !== 'ok') {
                    alert(result);
                    } else {
                    $('#attribution_form').submit();
                    }
                    });
                    });
                </script>

                <h3><a href="../scolarite/attribution_noveaux_etudiants.php">attribution nouveaux &#233;tudiants</a></h3><br /><br /><br />

                <form id="attribution_form" class='nouvel_etudiant' method="GET" action="transfert_ETU.php">
                    <h3>d&#233;clarer le transfert d'un &#233;tudiant du TC vers un programme<br /></h3>
                    <div><label>num&#233;ro:</label>
                        <input class="text" type="text" name="numero" required /></div>
                    <div><label>prenom:</label>
                        <input class="text" type="text" name="prenom" required /></div>
                    <div><label>nom:</label>
                        <input class="text" type="text" name="nom" required /></div>
                    <div><label>programme &agrave; transformer:</label>
                        <select name="programme" required>
                            <option></option>
                            <option>ISI</option>
                            <option>SM</option>
                            <option>MTE</option>
                            <option>SI</option>
                            <option>SRT</option>
                            <option>TC</option>
                        </select></div>
                    <input id='attribution_submit' type="submit" value='Attribuer'/>
                    <input type="reset"/></td>
                </form>
            </div>
    </body>
</html>

