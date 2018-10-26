<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 6/20/18
 * Time: 1:02 PM
 */
//namespace app\core;
class Application
{
    protected $controller='';
    public static $controlID;
    protected $action='';
    protected $param=[];

    public function __construct()
    {
        $this->prepareUrl();
        //echo $this->controller, '<br>',$this->action,'<br>';print_r($this->param);
       //if (file_exists(CONTROLLER.$this->controller.'.php')){
            $this->controller= new $this->controller;
            if (method_exists($this->controller, $this->action)){
                call_user_func_array([$this->controller, $this->action], $this->param);
            }
            //$this->controller->$this->action();
        //}
    }
    protected function prepareUrl(){
        $request=trim($_SERVER['REQUEST_URI'], '/');
        if (!empty($request)){
            $url= explode('/',$request);
            self::$controlID=isset($url[1]) ? $url[1] :'index';
            $this->controller= isset($url[0]) ? $url[0].'_controller':'home_controller';
            if ($url[0]=='admin'){
            $this->action= isset($url[1]) ? $url[1] :'login';
            }
            $this->action= isset($url[1]) ? $url[1] :'index';
            unset($url[0],$url[1]);
            $this->param= !empty($url) ? array_values($url): [];
        }
    }
}
new config();
?>
