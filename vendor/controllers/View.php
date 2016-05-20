<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 27.04.2016
 * Time: 21:46
 */

namespace core\Controllers;


class View {
    private static $_instance;
    public $viewPath;
    public $mainLayout = false;
    public static function init(){
        if(self::$_instance === null) {
            self::$_instance = new self();
            self::$_instance->viewPath = Loader::app()->systemDirectory . DIRECTORY_SEPARATOR . Loader::app()->val('system.view') . DIRECTORY_SEPARATOR ;
        }

        return self::$_instance;
    }

    public function render($file, $params = []){
        echo $this->getContent($this->findView($file), $params);
    }
    public function currentView($file, $params = []){
        $this->renderMainLayout();

        $setDefPath = $this->viewPath . Loader::app()->route->defaultController . DIRECTORY_SEPARATOR;
        echo $this->getContent($this->findView($file, $setDefPath),$params);

        $this->viewPath = $setDefPath;

    }
    public function renderMainLayout(){
        if($this->mainLayout == false){
            $this->mainLayout = true;
            $this->render(Loader::app()->val('system.layout'),['app'=>$this]);
        }
    }

    public function partial($file, $params = []){
        return $this->getContent($this->findView($file),$params);
    }

    public function getContent($path, $params){
        extract($params);
        if(file_exists($path)){
            ob_start();
            require_once $path;
            $content = ob_get_contents();
            ob_end_clean();
            ob_flush();
            return $content;
        }else{
            throw new \Exception ('Вьюхи нет: ' . $path);
        }
    }

    public function findView($search, $path = null){
        $path = ($path == null ?$this->viewPath:$path);
        $dir_iterator = new \RecursiveDirectoryIterator($path);
        $iterator = new \RecursiveIteratorIterator($dir_iterator, \RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iterator as $file) {
            if($file->isFile()){
                //echo 'Try find: '.$search.'.php in ' . $file . PHP_EOL;
               if($search . '.php' == $file->getFileName()) return $file->getPathName();
            }
        }
    }
//    public function assets($from = 'top'){
//        echo 'asfefwef';
//        $assets = Loader::app()->val('app.assets.'.$from);
//        print_r($assets);
//    }


}