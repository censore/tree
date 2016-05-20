<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 01.05.2016
 * Time: 3:43
 */

namespace app\Components;

use app\Helpers\fakeHelper;
use app\Models\Tries;

class createComponent{

    public function createNew(){
        $model = new Tries();
        $model->link = fakeHelper::randomString();
        $model->block_style_id = 1;
        $model->background_id = 0;
        $model->size_id = 0;
        $model->created_at = time();

        $model->validateKey = ['link' => $model->link];
        $model->insert();
        return $model;
    }
}