<?php

require_once 'Cmysql.php';

class CHabilitation {

    public function Habilitation_ajout($ec_id, $programme_id) {
        $mysql = new mysql();
        $array_of_values = array('ec_id' => $ec_id, 'programme_id' => $programme_id);
        $options = array(
            'table' => 'ec_programme_habilitation',
            'fields' => '*',
            'condition' => "ec_id=$ec_id and programme_id=$programme_id", 
            'group' => '1',
            'order' => '1',
            'limit' => 0
        );
        $result = $mysql->select($options);
        $doublon=  empty($result);
        if ($doublon==1){
            $mysql->insert('ec_programme_habilitation', $array_of_values);
        }
        return $doublon;
    }

    public function Habilitation_suppression($ec_id) {
        $mysql = new mysql();
        $conditions = "ec_id='$ec_id'";
        $mysql->delete('ec_programme_habilitation', $conditions);
    }

    public function Habilitation_par_pole($programme_id) {
        $mysql = new mysql();
        $option1 = array(
            'table' => 'ec,pole_programme',
            'fields' => 'ec.id',
            'condition' => "pole_programme.programme_id=$programme_id and ec.pole_id=pole_programme.pole_id", //无条�
            'group' => '1',
            'order' => '1',
            'limit' => 500
        );
        $tab_ec = $mysql->select($option1);
        //echo 'tab_ec<br>';
        //var_dump($tab_ec);
        foreach ($tab_ec as $ec) {
            foreach ($ec as $ec_id) {
                $id = $ec_id['id'];
                $option2 = array(
                    'table' => 'ec_programme_habilitation',
                    'fields' => 'ec_id',
                    'condition' => "ec_id=$id and programme_id=$programme_id", //无条�
                    'group' => '1',
                    'order' => '1',
                    'limit' => 500
                );
                $result1 = $mysql->select($option2);
                //echo 'result1<br>';
                //var_dump($result1);
                $doublon1 = empty($result1);
                if ($doublon1 == 1) {
                    $array_of_values1 = array('ec_id' => $id, 'programme_id' => $programme_id);
                    $mysql->insert('ec_programme_habilitation', $array_of_values1);
                }
                $option3 = array(
                    'table' => 'ec_programme_habilitation',
                    'fields' => 'ec_id',
                    'condition' => "ec_id=$id and programme_id=6", //无条�
                    'group' => '1',
                    'order' => '1',
                    'limit' => 500
                );
                $result2 = $mysql->select($option3);
                //echo 'result2<br>';
                //var_dump($result2);
                $doublon2 = empty($result2);
                if ($doublon2 == 1) {
                    $array_of_values2 = array('ec_id' => $id, 'programme_id' => 6);
                    $mysql->insert('ec_programme_habilitation', $array_of_values2);
                }
            }
        }
    }

    public function Habilitation_visualisation_etu_ec($programme_id) {
        $mysql = new mysql();
        $options = array(
            'table' => 'etudiant,ec,etudiant_conseiller',
            'fields' => 'etudiant.numero, etudiant.prenom, etudiant.nom, ec.prenom, ec.nom',
            'condition' => "etudiant.programme_id=$programme_id and etudiant_conseiller.etudiant_numero=etudiant.numero and ec.id=etudiant_conseiller.ec_id",
            'group' => '1',
            'order' => '1',
            'limit' => 0
        );
        $result = $mysql->select($options);
        return $result;
    }

}
