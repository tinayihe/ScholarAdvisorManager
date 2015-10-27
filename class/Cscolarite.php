<?php

require_once 'Cmysql.php';
require_once '../Utils.php';

class Scolarite {

    private $etudiant_numero;
    private $ec_id;
    private $dbHelper;

    public function __construct($etudiant_numero = -1) {
        $this->etudiant_numero = $etudiant_numero;
        $this->dbHelper = new mysql();
    }

    public function attribution_nouvel_etudiant($nom, $prenom, $programme) {
        $etu_check = $this->dbHelper->execute("SELECT numero FROM etudiant WHERE nom='" . $nom . "' AND prenom='" . $prenom . "' AND numero in (select etudiant_numero from etudiant_conseiller)");
        if ($etu_check) {
            return false;
        } 
        
        $programmeId = Utils::getProgrammeIdByLabel($programme);

        $options = array('table' => 'ec_programme_habilitation AS h, etudiant_conseiller AS c',
            'fields' => 'h.ec_id, count(c.id) AS nb_etudiant',
            'condition' => 'h.ec_id = c.ec_id AND h.programme_id=' . $programmeId,
            'group' => 'h.ec_id',
            'order' => 'nb_etudiant ASC',
            'limit' => 1); //???

        $option0 = array('table' => 'ec_programme_habilitation AS h',
            'fields' => 'h.ec_id',
            'condition' => 'h.programme_id=' . $programmeId . ' AND ' . ' h.ec_id NOT IN (SELECT DISTINCT ec_id FROM etudiant_conseiller)',
            'group' => '1',
            'order' => '1',
            'limit' => 1);

        $result = $this->dbHelper->select($option0);
        if ($result == false) {
            $result = $this->dbHelper->select($options);
            if ($result == false || empty($result)) {
                $this->ec_id = null;
                return false;
            }
        }
        $this->ec_id = $result[0]['h']['ec_id'];

        $optionEtudiantNumero = array('table' => 'etudiant',
            'fields' => 'numero',
            'condition' => 'nom="' . $nom . '" AND ' . 'prenom="' . $prenom . '"',
            'group' => '1',
            'order' => '1',
            'limit' => 1);
        $resultat = $this->dbHelper->select($optionEtudiantNumero);
        $this->etudiant_numero = $resultat[0]['etudiant']['numero'];
        $array_of_values = array('etudiant_numero' => $this->etudiant_numero, 'ec_id' => $this->ec_id);
        $this->dbHelper->insert('etudiant_conseiller', $array_of_values);
        return $array_of_values; //[eutudiant_numero][]+[ec_id][]
    }

    public function attribution_noveaux_etudiants() {
        $result = $this->ETU_sans_conseiller();
        $attribution = array();
        //var_dump($result);die;
        foreach ($result as $etudiant) {
            $numero = $etudiant['e']['numero'];
            $nom = $etudiant['e']['nom'];
            $prenom = $etudiant['e']['prenom'];
            $programme = $etudiant['p']['label'];
            $this->attribution_nouvel_etudiant($nom, $prenom, $programme);
            $attribution[$numero] = $this->ec_id;
        }
        return $attribution;
    }

    public function attribution_etudiant_transfert($nom, $prenom, $etudiant_numero, $programme) {
        $programmeId = Utils::getProgrammeIdByLabel($programme);
        $base = new PDO('mysql::host=localhost;dbname=wangyihe', 'wangyihe', "WLbY4P5m");
        $requete = 'select h.programme_id FROM ec_programme_habilitation AS h, etudiant_conseiller AS c WHERE c.etudiant_numero = '.$etudiant_numero.' AND c.ec_id=h.ec_id AND h.programme_id=' . $programmeId;
        $statement=$base->query($requete);
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        //modifier programme id
        $requete = 'UPDATE etudiant SET programme_id='.$programmeId.' where numero='.$etudiant_numero;
        $statement=$base->exec($requete);
        if (empty($result)) {
            // supprimer + attribuer
            $requete='DELETE FROM etudiant_conseiller WHERE etudiant_numero='.$etudiant_numero;
            $statement=$base->exec($requete);
            return $this->attribution_nouvel_etudiant($nom, $prenom, $programme);
        }else{
            return false;
        }
    }

    public function ETU_list($programme) {
        $programmeId = Utils::getProgrammeIdByLabel($programme);
        $optionEtudiant = array('table' => 'etudiant as e, programme as p',
            'fields' => 'e.numero, e.prenom, e.nom, p.label',
            'condition' => 'e.programme_id=' . $programmeId . ' AND p.id=e.programme_id',
            'order' => 'p.id ASC',
            'limit' => 500);
        $result = $this->dbHelper->select($optionEtudiant);
        return $result; //注意格式!!!
    }

    public function ETU_sans_conseiller($programme = '-1') {
        if ($programme != '-1') {
            $programmeId = Utils::getProgrammeIdByLabel($programme);
            $optionEtudiant = array('table' => 'etudiant as e, programme as p',
                'fields' => 'e.numero, e.prenom, e.nom, p.label',
                'condition' => 'e.programme_id=' . $programmeId . ' AND e.programme_id=p.id and e.numero NOT IN (SELECT etudiant_numero FROM etudiant_conseiller)',
                'order' => 1,
                'limit' => 500);
            $result = $this->dbHelper->select($optionEtudiant);
            return $result; //注意格式!!!!!$result[][etudiant][numero]/[nom]/[prenom]
        } else {
            $optionEtudiant = array('table' => 'etudiant as e, programme as p',
                'fields' => 'e.numero, e.prenom, e.nom, p.label',
                'condition' => 'e.programme_id=p.id and e.numero NOT IN (SELECT etudiant_numero FROM etudiant_conseiller)',
                'order' => 1,
                'limit' => 500);
            $result = $this->dbHelper->select($optionEtudiant);
            return $result;
        }
    }

    public function ETU_avec_conseillet_list($programme) {
        $programmeId = Utils::getProgrammeIdByLabel($programme);
        $option = array('table' => 'etudiant as e, etudiant_conseiller as c, programme as p ,ec',
            'fields' => 'e.numero, e.prenom, e.nom, ec.prenom, ec.nom, p.label',
            'condition' => 'e.programme_id=' . $programmeId . ' AND e.numero=c.etudiant_numero and e.programme_id=p.id and c.ec_id=ec.id',
            'order' => 'p.id ASC',
            'limit' => 500);
        $result = $this->dbHelper->select($option);
        return $result;
    }

    public function liste_conseillers_ordonnes_desc() {
        $option_0 = array('table' => 'ec, pole',
            'fields' => 'ec.prenom, ec.nom, pole.pole',
            'condition' => 'ec.pole_id=pole.id and ec.id not in (select distinct ec_id from etudiant_conseiller)',
            'group'=>'ec.id',
            'order' => 'ec.id ASC',
            'limit' => 500);
        $result_0 = $this->dbHelper->select($option_0);
        foreach ($result_0 as $key => $value) {
            $result_0[$key][0]['nb_etu'] = 0;
        }
        $option = array('table' => 'ec, etudiant_conseiller AS c, pole',
            'fields' => 'ec.prenom, ec.nom, pole.pole, COUNT( c.id ) AS nb_etu',
            'condition' => 'ec.id = c.ec_id AND ec.pole_id=pole.id',
            'group' => 'ec.id',
            'order' => 'nb_etu DESC',
            'limit' => 500);
        $result = $this->dbHelper->select($option);
        return array_merge($result, $result_0);
    }

}
