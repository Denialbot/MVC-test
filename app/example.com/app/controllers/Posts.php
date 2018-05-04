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

    public function create(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
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