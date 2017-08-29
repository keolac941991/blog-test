<?php
session_start();
require_once('config.php');
require_once('model/User.php');
require_once('model/Post.php');
//unset($_SESSION['username']);
if ($_GET['url'] == 'login') {
    // redirect to login page if user have not logged in
    if (!isset($_SESSION['username'])) {
        if (!empty($_POST)) {
            $username = $_POST['username'] ? $_POST['username'] : '';
            $password = $_POST['password'] ? $_POST['password'] : '';
            if ($username == '' | $password = '') {
                $error = "Please enter required fields.";
            } else {
                $user = User::getUserByUsernamePassword($username, $password);
                if ($user) {
                    $_SESSION['username'] = $username;
                    $_SESSION['role']     = $user['role'];
                    header('Location: ' . BASEURL . 'index.php');
                    exit();
                } else {
                    $error = "Sorry! Your username or password is wrong!!!";
                }
            }
        }
    } else {
        header('Location: ' . BASEURL . 'index.php');
        exit();
    }
    include('view/login.php');
} elseif ($_GET['url'] == 'addPost') {
    if (!isset($_SESSION['username'])) {
        header('Location: ' . BASEURL . 'index.php?url=login');
        exit();
    }
    if (!empty($_POST)) {
        $post = new Post();
        $post->setTitle($_POST['title']);
        $post->setBody($_POST['body']);
        if ($_POST['title'] == '' | $_POST['body'] = '') {
            $error = "Please enter required fields.";
        } else {
            try {
                $post->insert();
            }
            catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }
    include('view/addPost.php');
} elseif ($_GET['url'] == 'publicPost') {
    if ($_SERVER['role'] == ADMIN) {
        $id = $_GET['id'] ? $_GET['id'] : '';
        if ($id) {
            Post::updateStatus($id);
        }
    }
    header('Location: ' . BASEURL . 'index.php');
    exit();
} elseif ($_GET['url'] == 'logout') {
    unset($_SESSION['username']);
    unset($_SESSION['roles']);
    header('Location: ' . BASEURL . 'index.php?url=login');
    exit();
} elseif ($_GET['url'] == 'post') {
    $id = $_GET['id'] ? $_GET['id'] : '';
    $post = Post::getPostById($id);
    $post['date_created'] = date("m/d/Y",$post['date_created']);
    $post['date_modified'] = date("m/d/Y",$post['date_modified']);
    echo json_encode($post);
    exit();
}else {
    $page   = $_GET['page'] ? $_GET['page'] : 1;
    $offset = ($page - 1) * 10;
    if (isset($_SESSION['role'])) {
        $status = "IN (0,1)";
    } else {
        $status = "= 1";
    }
    $posts = Post::getPosts($offset, $status);
    $count = Post::countPosts($status);
    $pages = ceil($count / 10);
    include('view/listPost.php');
}
