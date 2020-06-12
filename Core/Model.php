<?php

namespace Core;

use PDO;
use App\Config;

/**
 * Base model
 *
 * PHP version 7.0
 */
abstract class Model
{
    protected static $tbname;
	protected $db;

    protected $table;
    private $dataResult;

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getDB()
    {
        static $db;

        if ($db === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $db;
    }
	
	

    public function __construct($select = false) {
        // объект бд коннекта
        // global $dbObject;
        $this->db = self::getDB();

        // имя таблицы
        $modelName = get_class($this);
        $arrExp = explode('\\', $modelName);
        $tableName = strtolower($arrExp[2]);

        $this->table = $tableName.'s';

        // обработка запроса, если нужно
        $sql = $this->_getSelect($select);
        if($sql) $this->_getResult("SELECT * FROM $this->table" . $sql);
        //var_dump("SELECT * FROM $this->table" . $sql);
    }

    // получить имя таблицы
    public function getTableName() {
        return $this->table;
    }

    // получить все записи
    function getAllRows(){
        if(!isset($this->dataResult) OR empty($this->dataResult)) return false;
        return $this->dataResult;
    }

    function getCount() {
        return count($this->dataResult);
    }

    // получить одну запись
    function getOneRow(){
        if(!isset($this->dataResult) OR empty($this->dataResult)) return false;
        return $this->dataResult[0];
    }

    // извлечь из базы данных одну запись
    function fetchOne(){
        if(!isset($this->dataResult) OR empty($this->dataResult)) return false;
        foreach($this->dataResult[0] as $key => $val){
            $this->$key = $val;
        }
        return true;
    }

    // получить запись по id
    function getRowById($id){
        try{
            $db = $this->db;
            $stmt = $db->query("SELECT * from $this->table WHERE id = $id");
            $row = $stmt->fetch();
        }catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $row;
    }

    // запись в базу данных
    public function save() {
        $arrayAllFields = array_keys($this->fieldsTable());
        $arraySetFields = array();
        $arrayData = array();
        foreach($arrayAllFields as $field){
            if(!empty($this->$field)){
                $arraySetFields[] = $field;
                $arrayData[] = $this->$field;
            }
        }
        $forQueryFields =  implode(', ', $arraySetFields);
        $rangePlace = array_fill(0, count($arraySetFields), '?');
        $forQueryPlace = implode(', ', $rangePlace);

        try {
            $db = $this->db;
            $stmt = $db->prepare("INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)");
            $result = $stmt->execute($arrayData);
        }catch(PDOException $e){
            echo 'Error : '.$e->getMessage();
            echo '<br/>Error sql : ' . "'INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)'";
            exit();
        }

        return $result;
    }

    // составление запроса к базе данных
    private function _getSelect($select) {
        if(is_array($select)){
            $allQuery = array_keys($select);
            array_walk($allQuery, function(&$val){
                $val = strtoupper($val);
            });

            $querySql = "";
            if(in_array("WHERE", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "WHERE"){
                        $querySql .= " WHERE " . $val;
                    }
                }
            }

            if(in_array("GROUP", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "GROUP"){
                        $querySql .= " GROUP BY " . $val;
                    }
                }
            }

            if(in_array("ORDER", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "ORDER"){
                        $querySql .= " ORDER BY " . $val;
                    }
                }
            }

            if(in_array("LIMIT", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "LIMIT"){
                        $querySql .= " LIMIT " . $val;
                    }
                }
            }

            if(in_array("OFFSET", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "OFFSET"){
                        $querySql .= " OFFSET " . $val;
                    }
                }
            }

            return $querySql;
        }
        return false;
    }

    // выполнение запроса к базе данных
    private function _getResult($sql){
        try{
            $db = $this->db;
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->dataResult = $rows;
        }catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return $rows;
    }

    // уделение записей из базы данных по условию
    public function deleteBySelect($select){
        $sql = $this->_getSelect($select);
        try {
            $db = $this->db;
            $result = $db->exec("DELETE FROM $this->table " . $sql);
        }catch(PDOException $e){
            echo 'Error : '.$e->getMessage();
            echo '<br/>Error sql : ' . "'DELETE FROM $this->table " . $sql . "'";
            exit();
        }
        return $result;
    }

    // уделение строки из базы данных
    public function deleteRow(){
        $arrayAllFields = array_keys($this->fieldsTable());
        array_walk($arrayAllFields, function(&$val){
            $val = strtoupper($val);
        });
        if(in_array('ID', $arrayAllFields)){
            try {
                $db = $this->db;
                $result = $db->exec("DELETE FROM $this->table WHERE `id` = $this->id");
                foreach($arrayAllFields as $one){
                    unset($this->$one);
                }
            }catch(PDOException $e){
                echo 'Error : '.$e->getMessage();
                echo '<br/>Error sql : ' . "'DELETE FROM $this->table WHERE `id` = $this->id'";
                exit();
            }
        }else{
            echo "ID table `$this->table` not found!";
            exit;
        }
        return $result;
    }

    // обновление записи. Происходит по ID
    public function update(){
        $arrayAllFields = array_keys($this->fieldsTable());
        $arrayForSet = array();
        foreach($arrayAllFields as $field){
            if(!empty($this->$field)){
                if(strtoupper($field) != 'ID'){
                    $arrayForSet[] = $field . ' = "' . $this->$field . '"';
                }else{
                    $whereID = $this->$field;
                }
            }
        }
        if(!isset($arrayForSet) OR empty($arrayForSet)){
            echo "Array data table `$this->table` empty!";
            exit;
        }
        if(!isset($whereID) OR empty($whereID)){
            echo "ID table `$this->table` not found!";
            exit;
        }

        $strForSet = implode(', ', $arrayForSet);

        try {
            $db = $this->db;
            $stmt = $db->prepare("UPDATE $this->table SET $strForSet WHERE `id` = $whereID");
            $result = $stmt->execute();
        }catch(PDOException $e){
            echo 'Error : '.$e->getMessage();
            echo '<br/>Error sql : ' . "'UPDATE $this->table SET $strForSet WHERE `id` = $whereID'";
            exit();
        }
        return $result;
    }

    public static function getAll()
    {
        $db = self::getDB();
        $stmt = $db->query('SELECT * FROM '.static::$tbname);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id = 1)
    {
        $db = self::getDB();
        $stmt = $db->query("SELECT * FROM ".static::$tbname." WHERE id=$id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function GetCountRows()
    {
        $db = self::getDB();
        $stmt = $db->query('SELECT COUNT(*) as total FROM '.static::$tbname)->fetchAll(PDO::FETCH_ASSOC);
        return $stmt[0]['total'];
    }
}
