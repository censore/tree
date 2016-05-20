<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 0:17
 */

namespace core\Models;

use app\Helpers\fakeHelper;
use app\helpers\getTypeHelper;
use core\Controllers\Loader;
use core\components\db\Crud;

class Model {
    public $table;
    public $db;
    public $crud;
    public $primary;
    public $attributes = [];
    public $attributesValidate = [];
    public $validateKey = [];
    public $separator = 'AND';
    public $result;
    public $all = [];
    public $escape = [];
    public function __construct(){
        $this->db = Loader::app()->db;
        $this->crud = new Crud();
        $this->initTable();
    }
    public function relate($model, $relateKey = []){
        $model->validateKey = $relateKey;
        return $model->find();
    }
    public function initTable(){
        $this->loadAttributes();
    }
    public function saveLink($params, $replace = []){
        $items = [];
        foreach($this->attributesValidate as $key=>$val){
            echo $key . PHP_EOL;
            if(in_array($key, array_keys($params))){
                if(isset($val['len']) && strlen($params[$key]) > $params[$key] && !isset($replace[$key])) continue;
                $items[':'.$key] = strip_tags(htmlspecialchars(addslashes($params[$key])));
            }
        }

        if(count($replace) > 0){
            foreach($replace as $key=>$val){
                $items[':'.$key] = $val;
            }
        }
        $sql = "INSERT INTO `{$this->table}` (".str_replace(':','',implode(', ', array_keys($items))).") VALUES (".implode(', ', array_keys($items)).")";

        $pdo = $this->db->pdo;
        $query = $pdo->prepare($sql);
        foreach($items as $key=>$val){
            $query->bindParam("{$key}", $val, \PDO::PARAM_STR);
        }
        $query->execute();
    }
    public function loadAttributes(){
        $q = $this->db->pdo->prepare("DESCRIBE {$this->table}");
        $q->execute();
        $table_fields = $q->fetchAll(\PDO::FETCH_ASSOC);
        foreach($table_fields as $field){
            if($field['Extra'] == 'auto_increment') $this->primary = $field['Field'];
            $type = getTypeHelper::getType($field['Type']);
            $this->attributes[strtolower($field['Field'])] = null;
            $this->attributesValidate[strtolower($field['Field'])] = [
                'type' => $type[0],
                'len' => $type[1],
                'allow_null' => $field['Null'],
            ];
        }
    }
    public function save(){
        if($this->find(true) == true){
            $this->insert();
        }else{
            $this->update();
        }

    }
    public function insert(){
        $sql = "INSERT INTO `{$this->table}` (".
            $this->fillStatements($this->clearAttributes(['id','update_at', 'created_at'])).
            ") VALUES (".$this->fillInsert($this->clearAttributes(['id','update_at', 'created_at'])).")";
        $pdo = $this->db->pdo;
        $query = $pdo->prepare($sql);

        foreach($this->clearAttributes(['id','update_at', 'created_at']) as $key => $value){
            $prepare[$key] = $value;
            $query->bindParam(":{$key}", $value, \PDO::PARAM_STR);
        }
        $query->execute($prepare);
        $key = ($this->primary);
        $this->$key = $pdo->lastInsertId();

    }
    public function clearAttributes($skip){
        $new = [];
        foreach($this->attributes as $key=>$val){
            if(in_array($key, $skip)) continue;
            $new[$key] = $val;
        }
        return $new;
    }
    public function fillStatements($attributes){
        $statement = [];
        foreach(array_keys($attributes) as $key){
            if($key == $this->primary) continue;
            $statement[] = "`{$key}`";
        }
        return implode(', ',$statement);
    }
    public function update($id = null, $fields = []){
        $pdo = $this->db->pdo;
        $sql = "UPDATE {$this->table} SET ";
        $_sql = [];
        foreach($fields as $key=>$val){
            $_sql[] = "`{$key}` = :{$key}";
        }
        $sql.=implode(', ', $_sql) . $this->getWhere();
        if($id !== null && (is_string($id) || is_numeric($id)) ) $fields['id'] = $id;
        if(is_array($id)) $fields[$id[0]] = $id[1];

        $stmt = $pdo->prepare($sql);
        foreach($fields as $key=>$val){
            $stmt->bindParam(":{$key}", $val, \PDO::PARAM_STR);
        }

        $if = $stmt->execute();

    }
    public function findAll(){
        $pdo = $this->db->pdo;
        $sql = "SELECT * FROM {$this->table} {$this->getWhere()} ORDER BY {$this->primary} DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($this->validateKey);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach($rows as $index=>$array){
            foreach($array as $key=>$value){
                if(method_exists($this, $key)){
                    $rows[$index][$key] = $this->$key($value);
                }
            }
        }
        return $rows;
    }
    public function find($validate = false){
        $pdo = $this->db->pdo;
        $sql = "SELECT * FROM {$this->table} " . $this->getWhere();
        $result = $pdo->prepare($sql);
        foreach($this->validateKey as $attr=>$value){
            $pdo_param = (is_numeric($value) ? \PDO::PARAM_INT: \PDO::PARAM_STR );
            $result->bindParam(":{$attr}", $value);
        }
        $result->execute();
        if(count($result)>0){
            if($validate == false){
                $this->fillAttributes($result);
            }else{
                return false;
            }
        }else{
            if($validate == false){
                return null;
            }else{
                return true;
            }
        }
    }
    public function fillInsert($attributes){
        $insert = [];
        foreach($attributes as $attr=>$value){
            if($attr == $this->primary) continue;
            $insert[] = ":{$attr}";
        }
        return implode(", ", $insert);
    }
    public function fillAttributes($result){
        foreach($result as $key=>$val){
            foreach($val as $k=>$v){
                if(!is_numeric($k)) $this->$k=$v;
            }
        }
    }
    public function getWhere(){
        $where = [];
        if(count($this->validateKey) < 1) return '';
        foreach($this->validateKey as $attr=>$value){
            $where[] = "`{$attr}` = :{$attr}";
        }

        return ' WHERE ' .implode(" {$this->separator} ", $where);
    }
    public function __get($name){
        if(isset($this->attributes[$name])) return $this->attributes[$name];
        return null;
    }
    public function __set($key, $value){
        $this->attributes[$key] = $value;
    }
}