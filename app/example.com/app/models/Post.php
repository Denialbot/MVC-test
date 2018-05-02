<?php
  // Placeholder file för Models mappen. Models filer har storbokstav först eftersom det är klasser och skrivs i Singular form.
  // T.ex Post, User, etc.

    class Post {
      private $db;

      public function __construct(){
        $this->db = new Database();
      }

      public function getPosts() {
        $this->db->query("SELECT * FROM blogposts ORDER BY id");
        return $this->db->resultSet();
      }

      public function newPost($data) {

      }
    }