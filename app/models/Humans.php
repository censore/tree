<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 24.04.2016
 * Time: 22:39
 */

namespace app\Models;

use core\Models\Model;

class Humans extends Model{
    public $table = 'humans';
    public $all = [
        'sex'=>['model'=>'sexes'],
        'tree_id'=>['model'=>'tries'],
    ];
    public $escape = ['tree_id'];

    public function sex($id){
        $return = $this->relate(new Sexes(), ['id'=>$id]);
        return $return;
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