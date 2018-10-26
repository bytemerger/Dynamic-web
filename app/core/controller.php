<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 6/28/18
 * Time: 10:53 PM
 */

class controller
{
     protected $view;
     protected $model;

     protected function view($viewname, $data=[])
     {

         $this->view= new view($viewname, $data);

         return $this->view;
     }
     protected  function model($modelname, $data=[])
     {
         if(file_exists(MODEL .$modelname.'.php'))
         {
             include MODEL .$modelname.'.php';
             $this->model= new $modelname;
             return $this->model;
         }
     }
}