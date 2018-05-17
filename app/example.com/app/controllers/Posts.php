<?php

class Posts extends Controller {

    public function __construct(){
        $this->postModel = $this->model('Post');
    }

    public function index(){
        $posts = $this->postModel->getPosts();
        $data = [
            "posts" => $posts,
            "title" => "Post Index"
        ];
        $this->view("posts/index", $data);
    }

    public function post($params) {
        session_start();
        $post = $this->postModel->getSinglePost($params);
        $data = [
            "title" => "View Post",
            "postid" => $post->id,
            "postTitle" => $post->title,
            "content" => $post->post,
            "postauthor" => $post->author_id
        ];
        $this->view("posts/post", $data);
    }

    public function register(){
        session_start();

        if($_SESSION['logged in'] == true){
            redirect("posts/index");
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Register',
                'nameerror' => '',
                'passerror' => '',
                'adderror' => '',
                'newuser' => $_POST['username'],
                'newpass' => $_POST['password'],
                'Cnewpass' => $_POST['Cpassword'],
                'passhash' => ''
            ];

            if(empty($data['newuser'])){
                $data['nameerror'] = 'No username has been entered';
            }

            if(empty($data['newpass'])){
                $data['passerror'] = 'No password has been entered';
            }

            if($data['newpass'] != $data['Cnewpass']){
                $data['passerror'] = 'The passwords do not match';
            }

            if(empty($data['passerror']) && empty($data['nameerror'])){
                $useroverlap = $this->postModel->CheckNameOverlap($data['newuser']);
                if($useroverlap->overlap > 0){
                    $data['nameerror'] = 'The name already exists';
                    $this->view("posts/register", $data);
                }
                else{
                    $data['passhash'] = password_hash($data['newpass'],PASSWORD_DEFAULT);
                    if($this->postModel->RegisterUser($data)){
                        $newuserdata = $this->postModel->PasswordCheckSingleUser($data['newuser']);
                        $_SESSION['logged in'] = true;
                        $_SESSION['user_id'] = $newuserdata->id;
                        redirect("posts/index");
                    }
                    else{
                        $data['adderror'] = 'There was an error in registering the user';
                        $this->view("posts/register", $data);
                    }
                }
            }
            else{
                $this->view("posts/register", $data);
            }
        }
        else{
            $data = [
                'title' => 'Register',
                'nameerror' => '',
                'passerror' => '',
                'adderror' => ''
            ];
            $this->view("posts/register", $data);
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        redirect("posts/index");
    }

    public function login(){
        session_start();
        if($_SESSION['logged in'] == true){
            redirect("posts/index");
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Log In',
                'nameerror' => '',
                'passerror' => '',
                'autherror' => '',
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password'])
            ];

            if(empty($data['username'])){
                $data['nameerror'] = 'Insert a username!';
            }

            if(empty($data['password'])){
                $data['passerror'] = 'A password is required!';
            }

            if(empty($data['nameerror']) && empty($data['passerror'])){
                $userdata = $this->postModel->PasswordCheckSingleUser($data['username']);
                if(password_verify($data['password'], $userdata->password)){
                    $_SESSION['logged in'] = true;
                    $_SESSION['user_id'] = $userdata->id;
                    redirect('posts/index');
                }
                else{
                    $data['autherror'] = 'Username or Password is incorrect!';
                    $this->view("posts/login", $data);
                }
            }
            else{
                $this->view("posts/login", $data);
            }
        }
        else{
            $data = [
                'title' => 'Log In',
                'nameerror' => '',
                'passerror' => ''
            ];
            $this->view("posts/login", $data);
        }
    }

    public function create(){
        session_start();
        if($_SESSION['logged in'] == false){
            redirect("posts/index");
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [ 
            'title' => 'Create Post',
            'titleerror' => '',
            'contenterror' => '',
            'postTitle' => trim($_POST['postTitle']),
            'content' => trim($_POST['postContent'])
        ];

        if(empty($data['postTitle'])) {
            $data['titleerror'] = 'The post requires a title!';
        }
        if(strlen($data['postTitle']) > 40) {
            $data['titleerror'] = 'The title is too long!';
        }
        if(empty($data['content'])) {
            $data['contenterror'] = 'The post requires content!';
        }

        if(empty($data['titleerror']) && empty($data['contenterror'])) {
            if($this->postModel->newPost($data)) {
                redirect("posts/index");
            }
        } else {
            $this->view("posts/create", $data);
        }
        } else {
        $data = [
            "title" => "Create Post",
            'error' => ''
        ];
        $this->view("posts/create", $data);
        }
    }

    public function dashboard(){
        session_start();
        if($_SESSION['logged in'] == false){
            redirect("posts/index");
        }
        $posts = $this->postModel->getPosts();
        $data=[
            "posts" => $posts,
            "title" => "Admin Dashboard"
        ];
        $this->view("posts/dashboard", $data);
    }

    public function delete($params){
        session_start();
        if($_SESSION['logged in'] == false){
            redirect("index");
        }
        $data = [
            "id" => $params
        ];
        $this->postModel->deletePost($data);
        redirect("posts/index");
    }
}

?>