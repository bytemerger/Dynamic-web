<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 10/7/18
 * Time: 12:04 AM
 */
session_start();
class admin_controller extends controller
{

    //for the index editing
    public function index()
    {
        if (!$_SESSION['loggedin']){header('location: /admin/login');}
        $this->model('admin');
        if (isset($_POST['headId'])){
            $id=$_POST['headId'];
            $allowed = array('gif', 'png', 'jpg');
            $filename = $_FILES['headerImg']['name'];
            $fileTmp = $_FILES['headerImg']['tmp_name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            //set the image name
            if (!in_array($ext, $allowed)) {
                echo 'file format not supported';
                exit();
            } else {
                //checking if file exsists
                foreach ($allowed as $extension) {
                    if (file_exists("app/helpers/img/headerImage/" . $id . '.' . $extension)) unlink("app/helpers/img/headerImage/" . $id . '.' . $extension);
                }
            }
            move_uploaded_file($fileTmp, "app/helpers/img/headerImage/" . $id . '.' . $ext);
            $this->model->changeHeaderImg($id,$ext);
            echo 'successfully change header image';
            exit();
        }
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $postTitle = $_POST['title'];
            $postSum = $_POST['summary'];
            $postImg = 'none';

            if (!empty($_FILES['file']['size'])) {
                $allowed = array('gif', 'png', 'jpg');
                $filename = $_FILES['file']['name'];
                $fileTmp = $_FILES['file']['tmp_name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                //set the image name
                $postImg = $id . '.' . $ext;
                if (!in_array($ext, $allowed)) {
                    echo 'file format not supported';
                    exit();
                } else {
                    //checking if file exsists
                    foreach ($allowed as $extension) {
                        if (file_exists("app/helpers/img/introImage/" . $id . '.' . $extension)) unlink("app/helpers/img/introImage/" . $id . '.' . $extension);
                    }
                }
                move_uploaded_file($fileTmp, "app/helpers/img/introImage/" . $id . '.' . $ext);

            }


            $data = array(
                'postID' => $id,
                'postTitle' => $postTitle,
                'postSum' => $postSum,
                'postImg' => $postImg

            );
            $this->model->updateIntro($data);
            echo 'successfully uploaded';
            exit();
        }




            //var_dump($this->model->getImagePathHead('home'));
        $this->view('app/views/admin/admin-index',[
            'headImage'=> $this->model->getImagePathHead(Application::$controlID),
            'intro'=> $this->model->getIntro(),
            'posts'=>blog::getList(2)
        ]);
        $this->view->render();


    }
    //about us
    public function aboutUs()
    {
        if (!$_SESSION['loggedin']){header('location: /admin/login');}
        $this->model('admin');
        if (isset($_POST['headId'])){
            $id=$_POST['headId'];
            $allowed = array('gif', 'png', 'jpg');
            $filename = $_FILES['headerImg']['name'];
            $fileTmp = $_FILES['headerImg']['tmp_name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            //set the image name
            if (!in_array($ext, $allowed)) {
                echo 'file format not supported';
                exit();
            } else {
                //checking if file exsists
                foreach ($allowed as $extension) {
                    if (file_exists("app/helpers/img/headerImage/" . $id . '.' . $extension)) unlink("app/helpers/img/headerImage/" . $id . '.' . $extension);
                }
            }
            move_uploaded_file($fileTmp, "app/helpers/img/headerImage/" . $id . '.' . $ext);
            $this->model->changeHeaderImg($id,$ext);
            echo 'successfully change header image';
            exit();
        }
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $postTitle = $_POST['title'];
            $keywords = $_POST['keywords'];
            $content = $_POST['content'];

            $data = array(
                'postID' => $id,
                'postTitle' => $postTitle,
                'postSum' => $keywords,
                'postCon' => $content

            );
            $this->model->updateAbout($data);
            echo $content;
            echo 'successfully changed';
            exit();
        }
        $this->view('app/views/admin/admin-about',[
            'headImage'=> $this->model->getImagePathHead(Application::$controlID),
            'aboutUs'=>$this->model->getAboutUs()
        ])->render();
    }

    public function contact()
    {
        if (!$_SESSION['loggedin']){header('location: /admin/login');}
        $this->model('admin');
        if (isset($_POST['headId'])){
            $id=$_POST['headId'];
            $allowed = array('gif', 'png', 'jpg');
            $filename = $_FILES['headerImg']['name'];
            $fileTmp = $_FILES['headerImg']['tmp_name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            //set the image name
            if (!in_array($ext, $allowed)) {
                echo 'file format not supported';
                exit();
            } else {
                //checking if file exsists
                foreach ($allowed as $extension) {
                    if (file_exists("app/helpers/img/headerImage/" . $id . '.' . $extension)) unlink("app/helpers/img/headerImage/" . $id . '.' . $extension);
                }
            }
            move_uploaded_file($fileTmp, "app/helpers/img/headerImage/" . $id . '.' . $ext);
            $this->model->changeHeaderImg($id,$ext);
            echo 'successfully change header image';
            exit();
        }
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $postTitle = $_POST['title'];
            $content = $_POST['content'];

            $data = array(
                'postID' => $id,
                'postTitle' => $postTitle,
                'postCon' => $content

            );
            $this->model->updateContact($data);
            echo $content;
            echo 'successfully changed';
            exit();
        }
        $this->view('app/views/admin/admin-contact',[
            'headImage'=> $this->model->getImagePathHead(Application::$controlID),
            'contact' => $this->model->getContact()
        ])->render();
    }
    public function login()
    {
        if ($_SESSION['loggedin']){header('location: /admin/index');}

        $this->model('admin');
        if (isset($_POST['submit']))
        {
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $password = $_POST['password'];

            if ($username == '') {
                $error[] = 'Username is required';
            }

            if(!$error) {
                $user = $this->model->loginInfo($username);
                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        header('location: /admin/index');
                        $_SESSION['loggedin'] = true;


                    } else {
                        $error[] = 'incorrect password';
                    }
                } else {
                    $error[] = 'username does not exist';
                }
            }

        }

        $this->view('app/views/admin/login',[
            'error'=>$error
        ])->render();
    }
    public function editAdmin()
    {
        if (!$_SESSION['loggedin']) {
            header('location: /admin/login');
        }
        $this->model('admin');

        if (isset($_POST['submit'])) {

            //collect form data
            extract($_POST);


                if ($username == '') {
                    $error[] = 'Please enter the username.';
                }


                if ($password == '') {
                    $error[] = 'Please enter the password.';
                }


                if ($passwordConfirm == '') {
                    $error[] = 'Please confirm the password.';
                }

                if ($password != $passwordConfirm) {
                    $error[] = 'Passwords do not match.';
                }
                if (!$error)
                {
                    $hashedPassword= password_hash($password,PASSWORD_BCRYPT);
                    $data = array(
                        'username' => $username,
                        'hashPass' => $hashedPassword

                    );
                    $status = $this->model->updateAdmin($data);
                    if (isset($status) && !empty($status)) {
                        $error[] = $status;
                    }
                    if (!$error) {
                        header('location: /admin/index');
                    }
                }




        }

        $this->view('app/views/admin/edit-user',[
       'error'=> $error
        ])->render();


    }
    public function logout()
    {
        unset($_SESSION['loggedin']);
        session_destroy();
        header('location: /admin');
    }
}
