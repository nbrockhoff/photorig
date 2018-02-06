<?php
  class Camera {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }
      
    //List Cameras
      public function getCameras(){
          $this->db->query('SELECT * FROM cameras');
          
          $results = $this->db->resultSet();
          
          return $results;
          
      }
      
      
      public function getCameraById($id){
          $this->db->query('SELECT * FROM cameras WHERE camera_id = :id');
          $this->db->bind(':id', $id);
          
          $row = $this->db->single();
          
          return $row;
          
      }
      

   public function addCamera($data){
       $this->db->query('INSERT INTO cameras (camera_brand, camera_model, camera_crop, camera_resolution, camera_lens_mount) VALUES (:camera_brand, :camera_model, :camera_crop, :camera_resolution, :camera_lens_mount)');
      // Bind values
      $this->db->bind(':camera_brand', $data['camera_brand']);
      $this->db->bind(':camera_model', $data['camera_model']);
      $this->db->bind(':camera_crop', $data['camera_crop']);
      $this->db->bind(':camera_resolution', $data['camera_resolution']);
      $this->db->bind(':camera_lens_mount', $data['camera_lens_mount']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
      
public function editCamera($data){
          
          
       $this->db->query('UPDATE cameras 
                        SET camera_brand = :camera_brand, 
                            camera_model = :camera_model, 
                            camera_crop = :camera_crop, 
                            camera_resolution = :camera_resolution, 
                            camera_lens_mount =:camera_lens_mount 
                        WHERE camera_id = :camera_id');
       
      // Bind values
      
      $this->db->bind(':camera_id', $data['camera_id']);
      $this->db->bind(':camera_brand', $data['camera_brand']);
      $this->db->bind(':camera_model', $data['camera_model']);
      $this->db->bind(':camera_crop', $data['camera_crop']);
      $this->db->bind(':camera_resolution', $data['camera_resolution']);
      $this->db->bind(':camera_lens_mount', $data['camera_lens_mount']);

          
          
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

      
public function deleteCamera($id){
       $this->db->query('DELETE FROM cameras WHERE camera_id = :camera_id');
      // Bind values
      $this->db->bind(':camera_id', $id);
       
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
   }
      

  }