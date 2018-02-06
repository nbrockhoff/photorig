<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Regsiter user
    public function register($data){
      $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Login User
    public function login($email, $password){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }

    // Find user by email
    public function findUserByEmail($email){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      // Bind value
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }
      
    public function getUserCameras($id){
          $this->db->query(
               'SELECT cameras.camera_id, 
                       cameras.camera_brand,
                       cameras.camera_model
               FROM user_gear
               INNER JOIN cameras 
               ON user_gear.ug_camera_id = cameras.camera_id
               WHERE user_gear.ug_user_id = :user_id
               ');
        
          $this->db->bind(':user_id', $id);
        
          $user_cameras = $this->db->resultSet();
          
          return $user_cameras;
          
      }
      
      
      public function getUserLenses($id){
          $this->db->query(
               'SELECT lenses.lens_id, 
                       lenses.lens_brand,
                       lenses.lens_series,
                       lenses.lens_min_focal_length,
                       lenses.lens_type,
                       lenses.lens_min_aperture
               FROM user_gear
               INNER JOIN lenses 
               ON user_gear.ug_lens_id = lenses.lens_id
               WHERE user_gear.ug_user_id = :user_id
               ');
        
          $this->db->bind(':user_id', $id);
        
          $user_lenses = $this->db->resultSet();
          
          return $user_lenses;
          
      }
      
     public function addUserCamera($data){
         $this->db->query(
            'INSERT INTO user_gear 
                   (ug_user_id, 
                    ug_camera_id) 
            VALUES (:ug_user_id, 
                    :ug_camera_id)'
         );
         $this->db->bind(':ug_user_id', $data['user_id']);
         $this->db->bind(':ug_camera_id', $data['camera_id']);
         
         if($this->db->execute()){
        return true;
      } else {
        return false;
      }
     }
      
      public function removeUserCamera($data){
       $this->db->query('DELETE FROM user_gear WHERE ug_camera_id = :camera_id AND ug_user_id = :user_id');
      // Bind values
      $this->db->bind(':camera_id', $data['camera_id']);
      $this->db->bind(':user_id', $data['user_id']);
       
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
   }
      
      public function addUserLens($data){
         $this->db->query(
            'INSERT INTO user_gear 
                   (ug_user_id, 
                    ug_lens_id) 
            VALUES (:ug_user_id, 
                    :ug_lens_id)'
         );
         $this->db->bind(':ug_user_id', $data['user_id']);
         $this->db->bind(':ug_lens_id', $data['lens_id']);
         
         if($this->db->execute()){
        return true;
      } else {
        return false;
      }
     }
      
      public function removeUserLens($data){
       $this->db->query('DELETE FROM user_gear WHERE ug_lens_id = :lens_id AND ug_user_id = :user_id');
      // Bind values
      $this->db->bind(':lens_id', $data['lens_id']);
      $this->db->bind(':user_id', $data['user_id']);
       
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
   }
     
  }