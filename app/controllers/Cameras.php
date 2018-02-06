<?php
  class Cameras extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
          redirect('users/login');
      }
      $this->cameraModel = $this->model('Camera');
    }
      
      public function index(){
          //Get Cameras
          $cameras = $this->cameraModel->getCameras();
          
          $data = [
              'cameras' => $cameras
          ];
          
          $this->view('cameras/index', $data);
          
          
      }

    public function addCamera(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'camera_brand' => trim($_POST['camera_brand']),
          'camera_model' => trim($_POST['camera_model']),
          'camera_crop' => trim($_POST['camera_crop']),
          'camera_resolution' => trim($_POST['camera_resolution']),
          'camera_lens_mount' => trim($_POST['camera_lens_mount']),
          'camera_brand_err' => '',
          'camera_model_err' => '',
          'camera_crop_err' => '',
          'camera_resolution_err' => '',
          'camera_lens_mount_err' => ''
        ];
        // Validate Data
          //Validate Brand
        if(empty($data['camera_brand'])){
          $data['camera_brand_err'] = 'Please enter the camera brand';
        }

          // Validate Model
        if(empty($data['camera_model'])){
          $data['camera_model_err'] = 'Please enter the camera model';
        }
        // Validate Resolution
        if(empty($data['camera_resolution'])){
          $data['camera_resolution_err'] = 'Please enter the maximum resolution of the camera' ;
        }
        // Validate Crop
        if(empty($data['camera_crop'])){
          $data['camera_crop_err'] = 'Please enter the camera sensor size';
        }

        // Validate lens mount
        if(empty($data['camera_lens_mount'])){
          $data['camera_lens_mount_err'] = 'Please enter the camera lens mount style';
        }
          
        // Make sure errors are empty
        if(
          empty($data['camera_brand_err']) 
          && empty($data['camera_model_err'])
          && empty($data['camera_resolution_err'])
          && empty($data['camera_crop_err'])
          && empty($data['camera_lens_mount_err'])
        ){
            
          // Add Camera to Database
          if($this->cameraModel->addCamera($data)){
            flash('camera_message', 'Camera added to database successfully');
            redirect('cameras');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('cameras/add_camera', $data);
        }

      } else {
        // Init data
        $data =[
          'camera_brand' => '',
          'camera_model' => '',
          'camera_crop' => '',
          'camera_resolution' => '',
          'camera_lens_mount' => '',
          'camera_brand_err' => '',
          'camera_model_err' => '',
          'camera_crop_err' => '',
          'camera_resolution_err' => '',
          'camera_lens_mount_err' => ''
        ];

        // Load view
        $this->view('cameras/add_camera', $data);
      }
    
    }
      
      
      public function viewCamera($id){
          $camera = $this->cameraModel->getCameraById($id);
          
          $data = [
              'camera' => $camera
          ];
          
          $this->view('cameras/view_camera', $data);
      }
      
      public function editCamera($id){
          
          // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
          'camera_id' => $id,
          'camera_brand' => trim($_POST['camera_brand']),
          'camera_model' => trim($_POST['camera_model']),
          'camera_crop' => trim($_POST['camera_crop']),
          'camera_resolution' => trim($_POST['camera_resolution']),
          'camera_lens_mount' => trim($_POST['camera_lens_mount']),
        ];
          
        /// Validate Data
          //Validate Brand
        if(empty($data['camera_brand'])){
          $data['camera_brand_err'] = 'Please enter the camera brand';
        }

          // Validate Model
        if(empty($data['camera_model'])){
          $data['camera_model_err'] = 'Please enter the camera model';
        }
        // Validate Resolution
        if(empty($data['camera_resolution'])){
          $data['camera_resolution_err'] = 'Please enter the maximum resolution of the camera' ;
        }
        // Validate Crop
        if(empty($data['camera_crop'])){
          $data['camera_crop_err'] = 'Please enter the camera sensor size';
        }

        // Validate lens mount
        if(empty($data['camera_lens_mount'])){
          $data['camera_lens_mount_err'] = 'Please enter the camera lens mount style';
        }
          
        // Make sure errors are empty
        if(
          empty($data['camera_brand_err']) 
          && empty($data['camera_model_err'])
          && empty($data['camera_resolution_err'])
          && empty($data['camera_crop_err'])
          && empty($data['camera_lens_mount_err'])
        ){
          
          if($this->cameraModel->editCamera($data)){
            flash('camera_message', 'Camera updated successfully');
            redirect('cameras');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('cameras/edit_camera', $data);
        }

      } else {
          
          $camera = $this->cameraModel->getCameraById($id);
          
            
          
          $data = [
            'camera_id' => $camera->camera_id,
            'camera_brand' => $camera->camera_brand,
            'camera_model' => $camera->camera_model,
            'camera_crop' => $camera->camera_crop,
            'camera_resolution' => $camera->camera_resolution,
            'camera_lens_mount' => $camera->camera_lens_mount
          ];
              
          $this->view('cameras/edit_camera', $data);
      }
      }
      
      public function deleteCamera($id){
          
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if($this->cameraModel->deleteCamera($id)){
            flash('camera_message', 'Camera removed successfully');
            redirect('cameras');
          } else {
            die('Something went horribly wrong');
          }
      } else {
            redirect('cameras');
        }
      }
  }