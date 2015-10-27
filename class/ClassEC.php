<?php

require_once 'Cmysql.php';
require_once 'CHabilitation.php';

class EC {

    public $nom;
    public $prenom;
    public $bureau;
    public $pole;

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getBureau() {
        return $this->bureau;
    }

    public function getPole() {
        return $this->pole;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setBureau($bureau) {
        $this->bureau = $bureau;
    }

    public function setPole($pole) {
        $this->pole = $pole;
    }

    function construct($prenom, $nom, $bureau, $pole) {
        $this->setPrenom($prenom);
        $this->setNom($nom);
        $this->setBureau($bureau);
        $this->setPole($pole);
    }

    function __destruct() {
        
    }

    public function EC_vide() {
        $bd = new mysql();
        $bd->delete('ec', '1');
        echo "La liste EC est vide";
    }

    public function EC_ajout($prenom, $nom, $bureau, $pole_id) {
        $mysql = new mysql();
        $habi = new CHabilitation();
        $options = array(
            'table' => 'ec',
            'fields' => '*',
            'condition' => "prenom='$prenom' and nom='$nom'",
            'group' => '1',
            'order' => '1',
            'limit' => 1
        );
        $result = $mysql->select($options);
        $doublon = empty($result);
        if ($doublon == 1) {
            $array_of_values = array('prenom' => $prenom, 'nom' => $nom, 'bureau' => $bureau, 'pole_id' => $pole_id);
            if ($mysql->insert('ec', $array_of_values)) {
                $result_ec_insert = $mysql->select($options);
                $id = $result_ec_insert[0]['ec']['id'];
                $programme_id = 6;
                $habi->Habilitation_ajout($id, $programme_id);
            }
        }
        return $doublon;
    }

    public function EC_suppression($prenom, $nom) {
        $mysql = new mysql();
        $table = 'ec';
        $conditions = "prenom = '" . $prenom . "' and nom = '" . $nom . "'";
        $mysql->delete($table, $conditions);
    }

    public function EC_ajout_liste($file_name) {
        if (!$file = fopen($file_name, 'r')) {
            return FALSE;
        }
        while ($ligne = fgetcsv($file, 0, ';')) {
            //var_dump(preg_match("/^[0-9]+$/", '12345'));
            if (count($ligne) < 4 || !preg_match("/^[A-Z][0-9]+$/", $ligne[2])) { //expression régulière
                continue;
            }
            $prenom = $ligne[0];
            $nom = $ligne[1];
            $bureau = $ligne[2];
            $pole = $ligne[3];
            //$pole=$ec[3];
            $default = array(
                'table' => 'pole',
                'fields' => 'id',
                'condition' => 'pole="' . $pole . '"',
                'order' => '1',
                'limit' => 500
            );
            $mysql = new mysql();
            $result = $mysql->select($default);
            $pole_id = $result[0]['pole']['id'];
            $i = $this->EC_ajout($prenom, $nom, $bureau, $pole_id);
            //echo($i . "<br />");           
            if ($i == false) {
                echo "Enseignant Chercheur deja existe: (" . $nom . ", " . $prenom . ") <br />";
            } else {
                echo "Enseignant Chercheur est ajoute avec succes: (" . $nom . ", " . $prenom . ") <br />";
            }
        }
        /* $file = fopen($file_name, 'r');
          $mysql = new mysql();
          while ($data = fgetcsv($file,0,';')) {
          $ec = explode(';', $data[0]);
          if (($ec[0] != 'prenom') && ($ec[1] != 'nom')) {
          $pole=$ec[3];
          $default = array(
          'table' => 'pole',
          'fields' => 'id',
          'condition' => 'pole="'.$pole.'"',
          'order' => '1',
          'limit' => 500
          );
          $result = $mysql->select($default);
          $this->EC_ajout($ec[0], $ec[1], $ec[2], $result[0]['pole']['id']);
          }
          } */
    }

    public function EC_visualisation() {
        $mysql = new mysql();
        $default = array(
            'table' => 'ec',
            'fields' => 'id,prenom,nom,bureau,pole_id',
            'condition' => '1', //无条件
            'order' => '1',
            'limit' => 500
        );
        return $result = $mysql->select($default);
    }

    public function EC_visualisation_nombre_etudiants_decroissant() {
        $mysql = new mysql();
        $sql0 = "SELECT ec.id as ec_id FROM ec, pole WHERE ec.pole_id=pole.id and ec.id not in (select distinct ec_id from etudiant_conseiller) group by ec.id order by ec.id ASC";
        $query0 = mysql_query($sql0);
        $result0 = array();
        while ($row = mysql_fetch_array($query0)) {
            $row[1] = 0;
            $result0[] = $row;
        }
        //var_dump($result0);

        $sql = "SELECT ec_id,count(*) FROM etudiant_conseiller GROUP BY ec_id ORDER BY count(*) DESC";
        $query = mysql_query($sql);
        $result = array();
        while ($row = mysql_fetch_array($query)) {
            $result[] = $row;
        }
        //var_dump($result);
        if (is_array($result)) {
            return array_merge($result, $result0);
        } else {
            return false;
        }
    }

}

?>