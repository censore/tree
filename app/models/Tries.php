<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 22:41
 */

namespace app\Models;


use core\Models\Model;

class Tries extends Model{
    public $table = 'tries';
    public function humans(){
        return $this->relate(new Humans(), ['id'=>$this->tree_id]);
    }
    public function queryUpdate($id, $params = []){
        $pdo = $this->db->pdo;
        $sql = "UPDATE {$this->table} SET ";
        $_sql = [];
        foreach($params as $key=>$val){
            $_sql[] = "`{$key}` = '{$val}'";
        }
        $sql.=implode(', ', $_sql);
        $sql.=" WHERE `id`={$id}";
        $pdo->query($sql);

    }
}