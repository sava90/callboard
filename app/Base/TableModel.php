<?php

namespace Base;

use PDO;

abstract class TableModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    protected function getFields()
    {
        $table_columns = self::$conn->query("SHOW COLUMNS FROM " . $this->table);
        foreach ($table_columns as $column) {
            $this->fields[$column['Field']]['primary'] = $column['Key'] == 'PRI' && !empty($column['Extra']) ? 1 : 0;

            if (!empty($column['Default'])) {
                $this->fields[$column['Field']]['value'] = $column['Default'];
            } else if (!preg_match("/^(tinyint|smallint|mediumint|bigint|int|float|double|real|decimal|numeric|year)/", $column['Type'])) {
                $this->fields[$column['Field']]['value'] = "";
            } else {
                $this->fields[$column['Field']]['value'] = 0;
            }

            $this->fields[$column['Field']]['type'] = !preg_match("/^(tinyint|smallint|mediumint|bigint|int|float|double|real|decimal|numeric|year)/", $column['Type']) ? PDO::PARAM_STR : PDO::PARAM_INT;
        }

        return;
    }

    public function fill($ID)
    {
        reset($this->fields);
        $idName = key($this->fields);
        $query = "SELECT c.* FROM {$this->table} c WHERE $idName = :ID";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        self::$stmt->execute();
        $dbFields = self::$stmt->fetchAll(PDO::FETCH_OBJ);
        if (count($dbFields)==0) return false;

        $dbField = $dbFields[0];
        foreach ($dbField as $key => $value){
            $this->$key= $value;
        }
        return $this;
    }

    public function __set($field, $value)
    {
        $this->fields[$field]['value'] = $value;

        return $this;
    }

    public function __get($field)
    {
        if (array_key_exists($field, $this->fields)) {
            return $this->fields[$field]['value'];
        }

        return null;
    }
}