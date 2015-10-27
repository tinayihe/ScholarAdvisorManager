<?php

class mysql {

    private $con;

    public function getCon() {
        return $this->con;
    }

    public function setCon($con) {
        $this->con = $con;
    }

 
    function __construct($db = array()) {
        //连接服务器
        $default = array(
            'host' => 'localhost', //服务器
            'user' => 'wangyihe',//用户名
            'pass' => 'WLbY4P5m',//口令
            'db' => 'wangyihe'//数据库名
        );
        $db = array_merge($default, $db);
        $this->con = mysql_connect($db['host'], $db['user'], $db['pass'], true) or die('Error connecting to MySQL');

        //选择数据库      
        mysql_select_db($db['db'], $this->con) or die('Database ' . $db['db'] . ' does not exist!');
    }

    
    function __destruct() {
        //关闭服务器
        mysql_close($this->con);
    }

    
    function query($s = '', $limit = 0, $organize = true) { //0为全取
        //$s是任意sql语句，$limit是限制取得条数，$organize选择取出后数组的类型
        if (!$q = mysql_query($s, $this->con)) {
            return false;
        }
        if ($limit !== false) {
            $limit = intval($limit);
        }
        $rez = array();
        $count = 0;
        $type = $organize ? MYSQL_NUM : MYSQL_ASSOC;
        while (($limit === 0 || $count < $limit) && $line = mysql_fetch_array($q, $type)) {
            if ($organize) {
                foreach ($line as $field_id => $value) {
                    $table = mysql_field_table($q, $field_id); //取得指定字段所在的表名
                    if ($table == '') {
                        $table = 0;
                    }
                    $field = mysql_field_name($q, $field_id); //取得结果中指定字段的字段名 
                    $rez[$count][$table][$field] = $value;
                }
            }
            else {
                $rez[$count] = $line;
            }
            ++$count;
        }
        if (!mysql_free_result($q)) {//释放结果内存
            return false; //SB
        }
        return $rez;
    }

    
    function execute($s = '') {
        //echo $s;
        //在其他function里有用到，咱们可以用来验证数据是否存在
        $result = mysql_query($s, $this->con);
        if (mysql_query($s, $this->con) && mysql_num_rows($result) > 0){
            return true;
        }
        return false;
    }

    
    function select($options) {
        //有可能返回多条数据
        $default = array(
            'table' => '',
            'fields' => '*',
            'condition' => '1',//无条件
            'group'=> '1',
            'order' => '1',
            'limit' => 30
        );
        $options = array_merge($default, $options);
        $sql = "SELECT 
        {$options['fields']}
               FROM
        {$options['table']}
               WHERE  
        {$options['condition']}
               GROUP BY 
        {$options['group']}
               ORDER BY
        {$options['order']}
               LIMIT
        {$options['limit']}";
        //echo $sql;
        return $this->query($sql);
    }


    function update($table = null, $array_of_values = array(), $conditions = 'FALSE') {
        //更新数组，$array_of_values为table associative(field=>value)
        if ($table === null || empty($array_of_values)){
            return false;
        }
        $what_to_set = array();
        foreach ($array_of_values as $field => $value) {
            if (is_array($value) && !empty($value[0])){
            $what_to_set[] = "`$field`='{$value[0]}'";            
            }
            else{
                $what_to_set [] = "`$field`='" . mysql_real_escape_string($value, $this->con) . "'";
            }
        }
        $what_to_set_string = implode(',', $what_to_set);
        return $this->execute("UPDATE $table SET $what_to_set_string WHERE $conditions");
    }

    
    function insert($table = null, $array_of_values = array()) {
        //在表中插入一组数据,并返回其id
        if ($table === null || empty($array_of_values) || !is_array($array_of_values)){
            return false;
        }
        $fields = array();
        $values = array();
        foreach ($array_of_values as $id => $value) {
            $fields[] = $id;
            if (is_array($value) && !empty($value[0])){
                $values[] = $value[0];
            }
            else{
                $values[] = "'" . mysql_real_escape_string($value, $this->con) . "'";//转义 SQL 语句中使用的字符串中的特殊字符，并考虑到连接的当前字符集 
            }
        }
        $s = "INSERT INTO $table (" . implode(',', $fields) . ') VALUES (' . implode(',', $values) . ')';
        //echo "<br />" . $s . "<br />";
        if (mysql_query($s, $this->con)){
            return true;//mysql_insert_id($this->con);
        }
        else {
            return false;
        }      
    }

    
    function delete($table = null, $conditions = 'FALSE') {
        //删除数据
        if ($table === null){
            return false;
        }
        //var_dump("DELETE FROM $table WHERE $conditions");
        return $this->execute("DELETE FROM $table WHERE $conditions");
    }

}
