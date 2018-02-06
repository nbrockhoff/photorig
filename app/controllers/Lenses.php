<?php
  class Lenses extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
          redirect('users/login');
      }
      $this->lensModel = $this->model('Lens');
    }
      
      public function index(){
          //Get Lenses
          $lenses = $this->lensModel->getLenses();
          
          $data = [
              'lenses' => $lenses
          ];
          
          $this->view('lenses/index', $data);
      }

      
      
      public function viewLens($id){
          $lens = $this->lensModel->getLensById($id);
          
          $data = [
              'lens' => $lens
          ];
          
          $this->view('lenses/view_lens', $data);
      }
      
      public function addLens(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'lens_brand' => trim($_POST['lens_brand']),
          'lens_series' => trim($_POST['lens_series']),
          'lens_type' => trim($_POST['lens_type']),
          'lens_lens_mount' => trim($_POST['lens_lens_mount']),
          'lens_min_aperture' => trim($_POST['lens_min_aperture']),
          'lens_max_aperture' => trim($_POST['lens_max_aperture']),
          'lens_min_focal_length' => trim($_POST['lens_min_focal_length']),
          'lens_max_focal_length' => trim($_POST['lens_max_focal_length']),
          'lens_brand_err' => '',
          'lens_series_err' => '',
          'lens_type_err' => '',
          'lens_lens_mount_err' => '',
          'lens_min_aperture_err' => '',
          'lens_max_aperture_err' => '',
          'lens_min_focal_length_err' => '',
          'lens_max_focal_length_err' => ''
        ];
        // Validate Data
          //Validate Brand
        if(empty($data['lens_brand'])){
          $data['lens_brand_err'] = 'Please enter the lens brand';
        }

          //Validate Series
        if(empty($data['lens_series'])){
          $data['lens_series_err'] = 'Please enter the lens series';
        }
            //Validate Type
        if(empty($data['lens_type'])){
          $data['lens_type_err'] = 'Please select the lens type';
        }
          
          //Validate mount
        if(empty($data['lens_lens_mount'])){
          $data['lens_lens_mount_err'] = 'Please enter the compatable lens mount';
        }
          //Validate Aperture
        if(empty($data['lens_min_aperture'])){
          $data['lens_min_aperture_err'] = 'Please enter the minimum aperture';
        }
        if(empty($data['lens_max_aperture'])){
          $data['lens_max_aperture_err'] = 'Please enter the maximum aperture';
        }
          
          //Validate Focal Length

        if(empty($data['lens_min_focal_length'])){
          $data['lens_min_focal_length_err'] = 'Please enter the minimum focal length';
        }
        if(empty($data['lens_max_focal_length'])){
          $data['lens_max_focal_length_err'] = 'Please enter the maximum focal length';
        }
          
          
          
        // Make sure errors are empty
        if(empty($data['lens_brand_err'])  
          && empty($data['lens_series_err'])
          && empty($data['lens_type_err'])  
          && empty($data['lens_lens_mount_err'])
          && empty($data['lens_min_aperture_err']) 
          && empty($data['lens_max_aperture_err'])
          && empty($data['lens_min_focal_length_err'])
          && empty($data['lens_max_focal_length_err'])){
            
          // Add Lens to Database
          if($this->lensModel->addLens($data)){
            flash('lens_message', 'Lens added successfully');
            redirect('lenses');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('lenses/add_lens', $data);
        }

      } else {
        // Init data
        $data =[
          'lens_brand' => '',
          'lens_series' => '',
          'lens_type' => '',
          'lens_lens_mount' => '',
          'lens_min_aperture' => '',
          'lens_max_aperture' => '',
          'lens_min_focal_length' => '',
          'lens_max_focal_length' => '',
          
          'lens_brand_err' => '',
          'lens_series_err' => '',
          'lens_type_err' => '',
          'lens_lens_mount_err' => '',
          'lens_min_aperture_err' => '',
          'lens_max_aperture_err' => '',
          'lens_min_focal_length_err' => '',
          'lens_max_focal_length_err' => ''
        ];

        // Load view
        $this->view('lenses/add_lens', $data);
      }
    
    }
      
      public function editLens($id){
          
          // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
          'lens_id' => $id,
          'lens_brand' => trim($_POST['lens_brand']),
          'lens_series' => trim($_POST['lens_series']),
          'lens_type' => trim($_POST['lens_type']),
          'lens_lens_mount' => trim($_POST['lens_lens_mount']),
          'lens_min_aperture' => trim($_POST['lens_min_aperture']),
          'lens_max_aperture' => trim($_POST['lens_max_aperture']),
          'lens_min_focal_length' => trim($_POST['lens_min_focal_length']),
          'lens_max_focal_length' => trim($_POST['lens_max_focal_length'])
        ];
          
        // Validate Data
          //Validate Brand
        if(empty($data['lens_brand'])){
          $data['lens_brand_err'] = 'Please enter the lens brand';
        }
            //Validate Type
        if(empty($data['lens_type'])){
          $data['lens_type_err'] = 'Please select the lens type';
        }
          
          //Validate Aperture
        if(empty($data['lens_min_aperture'])){
          $data['lens_min_aperture_err'] = 'Please enter the minimum aperture';
        }
          
          //Validate Focal Length
        if(empty($data['lens_min_focal_length'])){
          $data['lens_min_focal_length_err'] = 'Please enter the minimum focal length';
        }
          
          
          
        // Make sure errors are empty
        if(empty($data['lens_brand_err']) && empty($data['lens_type_err']) && empty($data['lens_min_aperture_err']) && empty($data['lens_min_focal_length_err'])){
            
          
          if($this->lensModel->editLens($data)){
            flash('lens_message', 'Lens updated successfully');
            redirect('lenses');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('lenses/edit_lens', $data);
        }

      } else {
          
          $lens = $this->lensModel->getLensById($id);
          
            
          
          $data = [
            'lens_id' => $lens->lens_id,
            'lens_brand' => $lens->lens_brand,
          'lens_series' => $lens->lens_series,
          'lens_type' => $lens->lens_type,
          'lens_lens_mount' =>$lens->lens_lens_mount,
          'lens_min_aperture' => $lens->lens_min_aperture,
          'lens_max_aperture' => $lens->lens_max_aperture,
          'lens_min_focal_length' => $lens->lens_min_focal_length,
          'lens_max_focal_length' => $lens->lens_max_focal_length 
          ];
              
          $this->view('lenses/edit_lens', $data);
      }
      }
       public function deleteLens($id){
          
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if($this->lensModel->deleteLens($id)){
            flash('lens_message', 'Lens removed successfully');
            redirect('Lenses');
          } else {
            die('Something went horribly wrong');
          }
      } else {
            redirect('Lenses');
        }
      }
  }