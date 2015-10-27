<?php
require_once '../class/CHabilitation.php';
$habi=new CHabilitation();
$habi->Habilitation_suppression($_GET['ec_id']);
?>