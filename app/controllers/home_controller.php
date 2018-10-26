<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 6/26/18
 * Time: 2:17 AM
 */

class home_controller extends controller
{
    public function index($id='', $name='')
    {
        //echo 'I am in ' .__class__. 'and in ' .__METHOD__;
       // echo 'id is '. $id . 'and name '.$name;
        //echo( home::getImagePathHead(Application::$controlID));
      $this->model('home');
      //var_dump($this->model->getImagePathHead('home'));
      $this->view('app/views/home/index',[
          'name'=> $name,
          'id' => $id,
          'headImage'=> $this->model->getImagePathHead(Application::$controlID),
          'intro'=> $this->model->getIntro(),
          'posts'=>blog::getList(2)
      ]);
      $this->view->render();


    }

    public function aboutUs()
    {
        $this->model('home');
        $this->view('app/views/home/about',[
            'headImage'=> $this->model->getImagePathHead(Application::$controlID),
            'aboutUs'=>$this->model->getAboutUs()
        ])->render();
    }

    public function contact()
    {
        $this->model('home');
        $this->view('app/views/home/contact',[
            'headImage'=> $this->model->getImagePathHead(Application::$controlID),
            'contact' => $this->model->getContact()
        ])->render();
    }

    public function blog($action='',$id='')
    {
       /* $this->model('home');
        $this->view('app/views/home/blog',[
            'headImage'=> $this->model->getImagePathHead(Application::$controlID)
        ])->render();*/

        switch ($action){
            case 'read':
                $this->model('home');
                $this->view('app/views/home/view',[
                    'headImage'=> $this->model->getImagePathHead(Application::$controlID),
                    'categories'=>blog::getCat(),
                    'post'=>blog::getById($id),
                    'categories_in'=>blog::getViewCat($id)
                ])->render();
                break;
            case '':
                $this->model('home');
                $this->view('app/views/home/blog',[
                    'headImage'=> $this->model->getImagePathHead(Application::$controlID),
                    'categories'=>blog::getCat(),
                    'posts'=>blog::getList(4)
                ])->render();
                break;
            default:
                if (in_array($action, blog::getCat())) {
                    $this->model('home');
                    $this->view('app/views/home/categories',[
                        'headImage'=> $this->model->getImagePathHead(Application::$controlID),
                        'categories'=>blog::getCat(),
                        'post'=>blog::getCatPost($action)
                    ])->render();
                    }
                else{
                    $this->model('home');
                    $this->view('app/views/home/blog',[
                        'headImage'=> $this->model->getImagePathHead(Application::$controlID)
                    ])->render();
                }
        }
    }

}