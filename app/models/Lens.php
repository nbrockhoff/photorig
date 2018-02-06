<?php
  class Lens {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }
      
    //List Cameras
    public function getLenses(){
          $this->db->query('SELECT * FROM lenses');
          
          $results = $this->db->resultSet();
          
          return $results;
          
      }
      
      
    public function getLensById($id){
          $this->db->query('SELECT * FROM lenses WHERE lens_id = :id');
          $this->db->bind(':id', $id);
          
          $row = $this->db->single();
          
          return $row;
          
      }
      
    public function addLens($data){
       $this->db->query('INSERT INTO lenses (lens_brand, lens_series, lens_type, lens_lens_mount, lens_min_aperture, lens_max_aperture, lens_min_focal_length, lens_max_focal_length) VALUES (:lens_brand, :lens_series, :lens_type, :lens_lens_mount, :lens_min_aperture, :lens_max_aperture, :lens_min_focal_length, :lens_max_focal_length)');
      // Bind values
      $this->db->bind(':lens_brand', $data['lens_brand']);
      $this->db->bind(':lens_series', $data['lens_series']);
      $this->db->bind(':lens_type', $data['lens_type']);
      $this->db->bind(':lens_lens_mount', $data['lens_lens_mount']);
      $this->db->bind(':lens_min_aperture', $data['lens_min_aperture']);
      $this->db->bind(':lens_max_aperture', $data['lens_max_aperture']);
      $this->db->bind(':lens_min_focal_length', $data['lens_min_focal_length']);
      $this->db->bind(':lens_max_focal_length', $data['lens_max_focal_length']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
      
public function editLens($data){
          
          
       $this->db->query('UPDATE lenses 
                        SET lens_brand = :lens_brand, 
                            lens_series= :lens_series, 
                            lens_type = :lens_type, 
                            lens_lens_mount = :lens_lens_mount, 
                            lens_min_aperture = :lens_min_aperture, 
                            lens_max_aperture = :lens_max_aperture, 
                            lens_min_focal_length = :lens_min_focal_length, 
                            lens_max_focal_length = :lens_max_focal_length 
                        WHERE lens_id = :lens_id');
       
      // Bind values
      
      $this->db->bind(':lens_id', $data['lens_id']);
      $this->db->bind(':lens_brand', $data['lens_brand']);
      $this->db->bind(':lens_series', $data['lens_series']);
      $this->db->bind(':lens_type', $data['lens_type']);
      $this->db->bind(':lens_lens_mount', $data['lens_lens_mount']);
      $this->db->bind(':lens_min_aperture', $data['lens_min_aperture']);
      $this->db->bind(':lens_max_aperture', $data['lens_max_aperture']);
      $this->db->bind(':lens_min_focal_length', $data['lens_min_focal_length']);
      $this->db->bind(':lens_max_focal_length', $data['lens_max_focal_length']);
          
          
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
      
      public function deleteLens($id){
       $this->db->query('DELETE FROM lenses WHERE lens_id = :lens_id');
      // Bind values
      $this->db->bind(':lens_id', $id);
       
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
   }
      

  }