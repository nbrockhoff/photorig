<?php
  class Users extends Controller {
    public function __construct(){
      $this->userModel = $this->model('User');
    }
    
    public function index(){
    
        if(!isLoggedIn()){
          redirect('users/login');
      }
        
        $id = $_SESSION['user_id'];
        
        $user_cameras = $this->userModel->getUserCameras($id);
        $user_lenses = $this->userModel->getUserLenses($id);
        
          
        $data = [
            'user_cameras' => $user_cameras,
            'user_lenses' => $user_lenses
        ]; 
        
        
      $this->view('users/index', $data);
    }

    public function register(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter your email';
        } else {
          // Check email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter your name';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter your password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Please confirm your password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated
          
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->register($data)){
            flash('register_success', 'You are registered and can log in');
            redirect('users/login');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('users/register', $data);
        }

      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Init data
        $data =[
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'password_err' => '',      
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter email';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        }

        // Check for user/email
        if($this->userModel->findUserByEmail($data['email'])){
          // User found
        } else {
          // User not found
          $data['email_err'] = 'No user found';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

            $this->view('users/login', $data);
          }
        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }


      } else {
        // Init data
        $data =[    
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',        
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }

    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      $_SESSION['user_level'] = $user->user_level;
      flash('login_message', 'Login Successful - Welcome Back!');
      
        redirect('users/index');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      unset($_SESSION['user_level']);
      session_destroy();
      redirect('users/login');
    }

    public function isLoggedIn(){
      if(isset($_SESSION['user_id'])){
        return true;
      } else {
        return false;
      }
    }
      
public function addUserCamera($id){
    
    $data = [
    'camera_id' => $id,
    'user_id' => $_SESSION['user_id'],
        ];
    
    if($this->userModel->addUserCamera($data)){
        flash('gear_message', 'Camera has added to your gear successfully');
        redirect('users');
    } else {
        die('something went wrong');
    }
    
}
      
       public function removeUserCamera($id){
          
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $data = [
                'camera_id' => $id,
                'user_id' => $_SESSION['user_id']
                
            ];
            
          if($this->userModel->removeUserCamera($data)){
            flash('gear_message', 'Camera removed successfully');
            redirect('users');
          } else {
            die('Something went horribly wrong');
          }
      } else {
            redirect('users');
        }
      }
      
      public function addUserLens($id){
    
    $data = [
    'lens_id' => $id,
    'user_id' => $_SESSION['user_id'],
        ];
    
    if($this->userModel->addUserLens($data)){
        flash('gear_message', 'Lens has added to your gear successfully');
        redirect('users');
    } else {
        die('something went wrong');
    }
    
}
      
       public function removeUserLens($id){
          
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $data = [
                'lens_id' => $id,
                'user_id' => $_SESSION['user_id']
                
            ];
            
          if($this->userModel->removeUserLens($data)){
            flash('gear_message', 'Lens removed successfully');
            redirect('users');
          } else {
            die('Something went horribly wrong');
          }
      } else {
            redirect('users');
        }
      }
  }