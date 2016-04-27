<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 0:17
 */

namespace core\Models;

use app\helpers\getTypeHelper;
use core\Controllers\Loader;

class Model {
    public $table;
    public $db;
    public $primary;
    public $attributes = [];
    public function __construct(){
        $this->db = Loader::app()->db;
        $this->initTable();
    }
    public function initTable(){
        $this->loadAttributes();
    }
    public function loadAttributes(){
        $q = $this->db->pdo->prepare("DESCRIBE {$this->table}");
        $q->execute();
        $table_fields = $q->fetchAll(\PDO::FETCH_ASSOC);
        foreach($table_fields as $field){
            if($field['Extra'] == 'auto_increment') $this->primary = $field['Field'];
            $type = getTypeHelper::getType($field['Type']);
            $this->attributes[strtolower($field['Field'])] = [
                'type' => $type[0],
                'len' => $type[1],
                'allow_null' => $field['Null'],
            ];
        }
    }
    public function __get($name){
        if(isset($this->attributes[$name])) return $this->attributes[$name];
        return null;
    }
    public function __set($key, $value){
        $this->attributes[$key] = $value;
    }
}