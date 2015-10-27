<?php

require_once '../class/ClassEC.php';

$delete=new EC;
$delete->EC_suppression($_GET['prenom'], $_GET['nom']);

