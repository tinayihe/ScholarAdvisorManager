<?php

require_once '../class/Cmysql.php';

$dbHelper = new mysql();

$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$programme = $_GET['programme'];
if (empty($nom) || empty($prenom) || empty($programme)) {
    echo "Tous les champs sont requis! Veuillez vérifier.";
    return;
}

// vérifier que nom/prénom saisis par utilisateur correspondent à un étudiant dans la base de données
if (!$dbHelper->execute("SELECT e.numero FROM etudiant as e, programme as p WHERE e.nom='" . $nom . "' AND e.prenom='" . $prenom . "' AND e.programme_id=p.id AND p.label='" . $programme . "'")) {
    echo "Les informations entrées ne correspondent à aucun étudiant!";
} else {
    // vérifier que l'étudiant n'est pas encore attribué à un conseiller
    if ($dbHelper->execute("SELECT numero FROM etudiant WHERE nom='" . $nom . "' AND prenom='" . $prenom . "' AND numero in (select etudiant_numero from etudiant_conseiller)")) {
        echo $prenom . " " . $nom . " a déjà un conseiller! Veuillez retourner et entrer un autre étudiant pour attribuer.";
    } else {
        echo "ok";
    }
}
