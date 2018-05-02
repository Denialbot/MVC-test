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

    public function create(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
            "title" => "Create Post",
            'titleerror' => '',
            'contenterror' => '',
            'postTitle' => trim($_POST['postTitle']),
            'content' => trim($_POST['postContent']),
        ];

        if(empty($data['postTitle'])) {
            $data['titleerror'] = 'The post requires a title!';
        }
        if(len($data['postTitle'] > 40)) {
            $data['titleerror'] = 'The title is too long!';
        }
        if(empty($data['content'])) {
            $data['contenterror'] = 'The post requires content!';
        }

        if(empty($data['titleerror']) && empty($data['contenterror'])) {
            if($this->Post->newPost($data)) {
                
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
}

?>