<?php

class Posts extends Controller {

    public function __construct(){
        $this->postModel = $this->model('Post');
    }

    public function index(){
        $posts = $this->postModel->getPosts();
        $data = [
            "posts" => $posts
        ];
        $this->view("posts/index", $data);
    }

    public function create(){
        $this->view("posts/create");
    }
}

?>