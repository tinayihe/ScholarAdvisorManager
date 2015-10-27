<?php 
session_start();
session_destroy();
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>
		Bienvenu
	</title>
	<!-- La feuille de styles "base.css" doit être appelée en premier. -->
	<link rel="stylesheet" type="text/css" href="css/modele04.css" media="screen" />
</head>

<body>
	<div id="entete" >
                    <img alt="" src="image/utt_logo.jpg" height="70px"/>
		<p class="sous-titre">
                    <br/>Bienvenu sur le syst&#232;me d'attribution de conseillers
                    <br/>
                    <br/>
		</p>
	</div><!-- #entete -->
        <div id="erreur_login">
                    Les informations transmises n'ont pas permis de vous authentifier                 
        </div>
        <div id="identification">
            <form id="identification-form" method="post" action="login_action.php">
                <div class="form-element" id="form-title">
                    <strong>Connectez-vous &#224; votre compte</strong>
                </div>
                <div class="form-element">
                    <label>Identification</label>
                    <input type="text" id="login" name="login"/>
                </div>
                <div class="form-element">
                    <label>Mot de passe</label>
                    <input type="password" id="key" name="key"/>
                </div>
                <div id="form-actions" class="form-element">
                    <button id="button-submit" type="button">Se connecter</button>
                    <button id="button-reset" type="reset">R&eacute;initialiser</button>
                </div>
            </form>
        </div>
        
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript">
            $("#erreur_login").hide();
            $("#button-submit").on("click", function() {
                var login = $("#login").val();
                var key = $('#key').val();
                $.get("ajax_php/authenticate.php", {login: login, key: key}, function(data) {
                    if (data === "true") {
                        $("#identification-form").submit();
                    } else {
                        $("#erreur_login").show();
                    }
                });
            });
        </script>
</body>
</html>