<?php

require_once '../class/Cetudiant.php';

$delete=new Etudiant();
echo $delete->ETU_suppression($_GET['prenom'], $_GET['nom']);

