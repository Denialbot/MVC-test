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

      public function GetUserData($id){
        $this->db->query("SELECT * FROM users WHERE id = $id LIMIT 1");
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

      public function getComments($id){
        $this->db->query("SELECT * FROM comments WHERE post_id = $id");
        return $this->db->resultSet();
      }

      public function newComment($data){
        $this->db->query("INSERT INTO comments (post_id, poster, comment) VALUES ($data[targetpost],'$data[poster]','$data[comment]')");
        return $this->db->execute();
      }

      public function newPost($data) {
        $this->db->query("INSERT INTO blogposts (title, post, author_id, hasimage) VALUES ('$data[postTitle]','$data[content]',$data[poster], $data[hasimage])");
        return $this->db->execute();
      }

      public function GetNewPostid($data){
        $this->db->query("SELECT * FROM blogposts WHERE title = '$data[postTitle]' AND post = '$data[content]' AND author_id = '$data[poster]'");
        return $this->db->single();
      }

      public function deletePost($data){
        $this->db->query("DELETE FROM blogposts WHERE id = $data[id]");
        return $this->db->execute();
      }

      public function UpdatePost($data){
        $this->db->query("UPDATE blogposts SET post = '$data[postContent]', title = '$data[postTitle]' WHERE id = $data[postid]");
        return $this->db->execute();
      }

      public function NewImage($name, $postid){
        $this->db->query("INSERT INTO images (filename, postid) VALUES ('$name', $postid)");
        return $this->db->execute();
      }

      public function GetImageName($postid){
        $this->db->query("SELECT * FROM images WHERE postid = $postid LIMIT 1");
        return $this->db->single();
      }
    }