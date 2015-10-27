<?php
require_once 'Cscolarite.php';
$etudiant = new Scolarite();

$result = $etudiant->ETU_list('TC');
print_r($result);
