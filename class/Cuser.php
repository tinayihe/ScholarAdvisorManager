<?php
require_once 'Cmysql.php';

class Cuser {
    private $id;
    private $login;
    private $password;
    private $is_scolarite;
    private $is_dhr;
    private $dbHelper;
    
    function __construct($login = "", $password = "", $is_scolarite = false, $is_dhr = false) {
        $this->login = $login;
        $this->password = $password;
        $this->is_scolarite = $is_scolarite;
        $this->is_dhr = $is_dhr;
        $this->dbHelper = new mysql();
    }

    public static function USER_ajout($nom, $prenom, $is_scolarite, $is_dhr) {
        $this->login=$nom.$prenom;
        $this->password=$prenom.nom;
        $this->is_scolarite=$is_scolarite;
        $this->is_dhr=$is_dhr;
         if ($this->dbHelper->execute("SELECT login FROM 'user' WHERE login=" . $this->login )) {
            return false;
        } 
        else {
            $array_of_values = array(
                'login' => $this->login,
                'password' => $this->password,
                'is_scolarite' => $this->is_scolarite,
                'is_dhr' => $this->is_dhr,
            );
            $this->dbHelper->insert('user', $array_of_values);
        }
    }
    
    public static function USER_suppression($nom, $prenom) {
        $this->login=$nom.$prenom;
        $this->dbHelper->delete('user', 'login='.$this->login);
    }
    
    public function USER_login($login, $password, &$session = null) {
        $options=  array(
                    'table' => 'user, ec, pole_programme AS p',
                    'fields' => 'is_scolarite, is_dhr, password, p.programme_id',
                    'condition' => 'login= "'. $login .'" AND ec.pole_id = p.pole_id',
                    'group'=> '1',
                    'order' => '1');
                $result=  $this->dbHelper->select($options);
        if($result){
            if($password==$result[0]['user']['password']){
                $session['login_info'] = array(
                    'is_login' => true,
                    'login' => $login,
                    'is_scolarite' => $result[0]['user']['is_scolarite'],
                    'is_drh' => $result[0]['user']['is_dhr'],
                    'programme_id'=>$result[0]['p']['programme_id'],
                );
                return true;
            }
            else{
                return false;
            }
        }
        else {
            return FALSE;
        }
    }
    
    public function USER_logout(&$session) {
        if(isset($session['login_info']) && isset($session['login_info']['is_login']) && $session['login_info']['is_login']==true){
            unset($session['login_info']);            
        }
    }
    
    
    public function getId() {
        return $this->id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getIs_scolarite() {
        return $this->is_scolarite;
    }

    public function getIs_dhr() {
        return $this->is_dhr;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setIs_scolarite($is_scolarite) {
        $this->is_scolarite = $is_scolarite;
    }

    public function setIs_dhr($is_dhr) {
        $this->is_dhr = $is_dhr;
    }


}
