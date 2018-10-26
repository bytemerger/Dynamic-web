<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 10/19/18
 * Time: 1:35 PM
 */
session_start();
class adBlog_controller extends controller
{
    public function __construct()
    {
        if (!$_SESSION['loggedin']){header('location: /admin/login');}
    }

    public function index()
    {
        $this->model('admin');
        $this->view('app/views/admin/blog-index', [
            'headImage' => $this->model->getImagePathHead('blog'),
            'posts' => blog::getList(1000000)
        ]);
        $this->view->render();
    }

    public function editPost($id = '')
    {
        $this->model('admin');
        $fileTmp = '';
        if (!empty($_POST['submit'])) {
            $postTitle = $_POST['postTitle'];
            $postSum = $_POST['postDesc'];
            $postCont = $_POST['postCont'];
            $postCat = $_POST['cat_list'];
            $postImg = 'none';
            if ($postTitle == '') {
                $error[] = 'Title is required';
            }

            if ($postSum == '') {
                $error[] = 'Description is required';
            }

            if ($postCont == '') {
                $error[] = 'Content is required';
            }

            if ($postCat == '') {
                $postCat[] = 'general';
            }
            if (!empty($_FILES['image']['size'])) {
                $allowed = array('gif', 'png', 'jpg');
                $filename = $_FILES['image']['name'];
                $fileTmp = $_FILES['image']['tmp_name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                //set the image name
                $postImg = '.' . $ext;
                if (!in_array($ext, $allowed)) {
                    $error[] = 'file format not supported';

                }
            }
            if (!$error) {


                $data = array(
                    'postId' => $id,
                    'postTitle' => $postTitle,
                    'postSum' => $postSum,
                    'postCont' => $postCont,
                    'postImg' => $postImg,
                    'postCat' => $postCat,
                    'postDate' => date('Y-m-d H:i:s')

                );
                $status = blog::editPost($data);
                if (isset($status) && !empty($status)) {
                    $error[] = $status;
                }
                foreach ($allowed as $extension) {

                    if (file_exists("app/helpers/img/postImage/" . $id . '.' . $extension)) unlink("app/helpers/img/postImage/" . $id . '.' . $extension);
                }
                move_uploaded_file($fileTmp, "app/helpers/img/postImage/" . $id . $postImg);
                header('location: /adBlog/index');

            }
        }

        $this->view('app/views/admin/edit-post', [
            'categories' => blog::getCat(),
            'categories_in' => blog::getViewCat($id),
            'post' => blog::getById($id),
            'error' => $error
        ]);
        $this->view->render();

    }

    public function deletePost($id = '')
    {
        blog::deletePost($id);
        header('Location: /adBlog/index');
        exit;
    }

    public function deleteCat($name = '')
    {
        blog::deleteCat($name);
        header('Location: /adBlog/categories');
        exit;
    }

    public function categories()
    {
        $this->model('admin');
        $this->view('app/views/admin/admin-categories', [
            'categories' => blog::getCat(),
        ]);
        $this->view->render();
    }

    public function editCat($catName='')
    {
        $this->model('admin');
        if (!empty($_POST['submit'])) {

            $postTitle = $_POST['catTitle'];
            $postDesc = $_POST['catDesc'];

            if ($postTitle == '') {
                $error[] = 'Title is required';
            }

            if ($postDesc == '') {
                $error[] = 'Description is required';
            }

            if (!$error) {


                $data = array(
                    'name'=>$catName,
                    'postTitle' => $postTitle,
                    'postDesc' => $postDesc,

                );
                blog::editCat($data);
                header('Location: /adBlog/categories');
            }
        }
        $this->view('app/views/admin/edit-cat', [
            'category'=>blog::getCategoryVar($catName),
            'error' => $error
        ]);
        $this->view->render();


    }

    public function addPost()
    {
        $this->model('admin');
        $fileTmp = '';
        if (!empty($_POST['submit'])) {

            $postTitle = $_POST['postTitle'];
            $postSum = $_POST['postDesc'];
            $postCont = $_POST['postCont'];
            $postCat = $_POST['cat_list'];
            $postImg = 'none';
            if ($postTitle == '') {
                $error[] = 'Title is required';
            }

            if ($postSum == '') {
                $error[] = 'Description is required';
            }

            if ($postCont == '') {
                $error[] = 'Content is required';
            }

            if ($postCat == '') {
                $postCat[] = 'general';
            }
            if (!empty($_FILES['image']['size'])) {
                $allowed = array('gif', 'png', 'jpg');
                $filename = $_FILES['image']['name'];
                $fileTmp = $_FILES['image']['tmp_name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                //set the image name
                $postImg = '.' . $ext;
                if (!in_array($ext, $allowed)) {
                    $error[] = 'file format not supported';

                }
            }
            if (!$error) {


                $data = array(
                    'postTitle' => $postTitle,
                    'postSum' => $postSum,
                    'postCont' => $postCont,
                    'postImg' => $postImg,
                    'postCat' => $postCat,
                    'postDate' => date('Y-m-d H:i:s')

                );
                $id = blog::addPost($data);
                move_uploaded_file($fileTmp, "app/helpers/img/postImage/" . $id . $postImg);
                header('/adBlog/index');

            }
        }

        $this->view('app/views/admin/add-post', [
            'categories' => blog::getCat(),
            'error' => $error
        ]);
        $this->view->render();
    }

    public function addCat()
    {
        $this->model('admin');
        if (!empty($_POST['submit'])) {

            $postTitle = $_POST['catTitle'];
            $postDesc = $_POST['catDesc'];

            if ($postTitle == '') {
                $error[] = 'Title is required';
            }

            if ($postDesc == '') {
                $error[] = 'Description is required';
            }

            if (!$error) {


                $data = array(
                    'postTitle' => $postTitle,
                    'postDesc' => $postDesc,

                );
                blog::addCat($data);
            }
        }
            $this->view('app/views/admin/add-cat', [
                'error' => $error
            ]);
            $this->view->render();


    }
}