<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 02.05.2016
 * Time: 15:42
 */

namespace app\Helpers;

use app\Models;
use core\Models\Model;

class htmlHelper {
    public static function form(Model $model, $type = 'create'){
        $container = [];
        $container[] = "<form action='/save/{$model->table}' method='POST'>";
        foreach($model->attributesValidate as $name=>$attribute){
            if(($type == 'create' && $name == 'id') || in_array($name, $model->escape)) continue;

            if(method_exists($model, $name) && $type !== 'create'){
                $attribute['type'] = 'enum';
                $attribute['data'] = $model->$name();
            }
            if(isset($model->all[$name]) && $type == 'create'){
                $className = 'app\\Models\\'.ucfirst(strtolower($model->all[$name]['model']));
                $instance = new $className();
                $attribute['type'] = 'enum';
                $attribute['data'] = $instance->findAll();

            }
            if($model->primary == $name) $attribute['type'] = 'hidden';
            $method = 'add'.ucfirst($attribute['type']);
            $container[] = '<div class="form-group">';
            //$container[] = self::addLabel($name);
            $container[] = self::$method($name, $attribute);
            $container[] = "</div>";
        }
        $container[] = self::submit('Add');
        return implode("\n",$container);
    }
    public function addTextarea($name, $attribute){

    }
    public static function submit($value){
        return '<input type="submit" value="'.$value.'" class="btn btn-success form-control" />';
    }
    public static function addEnum($name, $attribute){
        $fields = [];
        $fields[] = '<option value="">--SELECT ONE '.self::addLabel($name).'--</option>';
        foreach($attribute['data'] as $name=>$value){
            $fields[] = '<option value="'.$value['id'].'">'.ucfirst($value['value']).'</option>';
        }

        return '<select class="form-control" name="'.$name.'" id="'.$name.'">'.implode('',$fields) .'</select>';
    }
    public static function addLabel($name){
        $title = explode('_', $name);
        foreach($title as $i=>$t){
            $title[$i] = ucfirst($t);
        }

        return implode(' ', $title);
    }
    public static function addText($name, $attribute){
        return '<input type="text" class="form-control" placeholder="'.self::addLabel($name).'" id="field_'.$name.'" name="'.$name.'" '.(isset($attribute['len']) && $attribute['len']>0?'maxlength="'.$attribute['len'].'"':'').' '.($attribute['allow_null']=='NO'?'required':'').' />';
    }
    public static function AddDatetime($name, $attribute){
        return self::addDate($name, $attribute);
    }
    public static function addDate($name, $attribute){
        $holder = self::addLabel($name);
        return <<<HTML

<div class="container">
    <div class="col-sm-6" style="height:130px;">
        <div class="form-group">
            <div class='input-group date' id='field_{$name}'>
                <input type='text' class="form-control" placeholder="{$holder}"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#field_{$name}').datetimepicker({
                viewMode: 'years',
                format: 'DD/MM/YYYY'
            });
        });
    </script>
</div>

HTML;

    }
}