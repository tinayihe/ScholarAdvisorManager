<?php

require_once 'Cmysql.php';
require_once '../Utils.php';

class Etudiant {

    private $numero;
    private $prenom;
    private $nom;
    private $programme;
    private $semestre;
    private $dbHelper;

    public function __construct($numero = -1, $nom = '', $prenom = '', $programme = '', $semestre = '') {
        $programme = Utils::getProgrammeIdByLabel($programme);
        $this->dbHelper = new mysql();
        $this->setNumero($numero);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setProgramme($programme);
        $this->setSemestre($semestre);
    }

    public function ETU_vide() {
        $this->dbHelper->delete('etudiant', 1);
    }
   
    public function ETU_ajout() {
        if ($this->dbHelper->execute("SELECT numero FROM etudiant WHERE nom='" . $this->nom . "' AND prenom='" . $this->prenom . "' AND numero=" . $this->numero)) {
            return false;
        } 
        else {
            $array_of_values = array(
                'numero' => $this->numero,
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'programme_id' => $this->programme,
                'semestre' => $this->semestre,
            );
            return $this->dbHelper->insert('etudiant', $array_of_values);
        }
    }
 
    public function ETU_suppression($prenom, $nom){
        $this->dbHelper->delete('etudiant', 'prenom="'.$prenom .'" and nom="'.$nom.'"');
    }
    
    public function ETU_ajout_liste($filename){
        if(!$file = fopen($filename, 'r')){
            return FALSE;
        }
        while ($ligne = fgetcsv($file, 0, ';')) {
            //var_dump(preg_match("/^[0-9]+$/", '12345'));
            if (count($ligne) < 5 || !preg_match("/^[0-9]+$/", $ligne[0])) { //expression régulière
                continue;
            }
            
            $this->numero=$ligne[0];
            $this->prenom=$ligne[1];
            $this->nom=$ligne[2];
            $this->programme=Utils::getProgrammeIdByLabel($ligne[3]);
            $this->semestre=$ligne[4];
            
            $i = $this->ETU_ajout();
            //echo($i . "<br />");
            
            if ($i == false) {
                echo "Etudiant deja existe: (" . $this->numero . ", " . $this->nom . ", " . $this->prenom . ") <br />";
            } else {
                echo "Etudiant est ajoute avec succes: (" . $this->numero . ", " . $this->nom . ", " . $this->prenom . ") <br />";
            }
        }
    }
    
    public function ETU_visualisation() {
        $mysql = new mysql();
        $default = array(
            'table' => 'etudiant',
            'fields' => 'numero, prenom, nom',
            'condition' => '1', //无条件
            'order' => '1',
            'limit' => 500
        );
        return $result = $mysql->select($default);
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getProgramme() {
        return $this->programme;
    }

    public function getSemestre() {
        return $this->semestre;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setProgramme($programme) {
        $this->programme = $programme;
    }

    public function setSemestre($semestre) {
        $this->semestre = $semestre;
    }

    public function getDbHelper() {
        return $this->dbHelper;
    }

    public function setDbHelper($dbHelper) {
        $this->dbHelper = $dbHelper;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
