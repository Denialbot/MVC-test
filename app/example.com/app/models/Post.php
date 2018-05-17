<?php
  // Placeholder file för Models mappen. Models filer har storbokstav först eftersom det är klasser och skrivs i Singular form.
  // T.ex Post, User, etc.

    class Post {
      private $db;

      public function __construct(){
        $this->db = new Database();
      }

      public function CheckNameOverlap($username){
        $this->db->query("SELECT COUNT(name) AS overlap FROM users WHERE name = '$username'");
        return $this->db->single();
      }

      public function RegisterUser($data){
        $this->db->query("INSERT INTO users (name, password) VALUES ('$data[newuser]','$data[passhash]')");
        return $this->db->execute();
      }

      public function PasswordCheckSingleUser($username){
        $this->db->query("SELECT * FROM users WHERE name = '$username' LIMIT 1");
        return $this->db->single();
      }

      public function getPosts() {
        $this->db->query("SELECT * FROM blogposts ORDER BY id");
        return $this->db->resultSet();
      }

      public function getSinglePost($id){
        $this->db->query("SELECT * FROM blogposts WHERE id = $id");
        return $this->db->single();
      }

      public function newPost($data) {
        $this->db->query("INSERT INTO blogposts (title, post, author_id) VALUES ('$data[postTitle]','$data[content]',1)");
        return $this->db->execute();
      }

      public function deletePost($data){
        $this->db->query("DELETE FROM blogposts WHERE id = $data[id]");
        return $this->db->execute();
      }
    }