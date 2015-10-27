<?php

if (!isset($_GET['filename'])) {
    echo "Veuillez sélectionner un fichier à télécharger!";
    return;
}

$fileNameParts = explode('\\', $_GET['filename']);
$fileNameParts = explode('.', $fileNameParts[count($fileNameParts)-1]);
$valideExtensions = array(
  'dat',
  'csv',
  'txt',
);
if (count($fileNameParts) < 2 || !in_array($fileNameParts[1], $valideExtensions)) {
    echo "Invalide extension du fichier!";
} else {
    echo "ok";
}
