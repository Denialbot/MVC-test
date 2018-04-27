<?php
  // Placeholder fil. I controllers mappen placerar man Controllers dvs de filer som kommunicerar mellan View och Model.
  // Controllers har stor bokstav först i namnet eftersom det är placeholder filer. Och är desutom i Plural t.ex Pages, Posts, Users etc.

  class Pages extends Controller{
    public function __construct() { 
      $this->pageModel = $this->model('Page');
    }

    public function index(){
      $this->view("pages/index");
    }

    public function about() {
      $data = [
        "title" => "About us",
      ];
      $this->view("pages/about", $data);
    }
  }