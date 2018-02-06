<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      $data = [
        'title' => 'PhotoRig',
        'description' => 'Your virtual studio assistant'
      ];
     
      $this->view('pages/index', $data);
    }

    public function contact(){
      $data = [
        'title' => 'About Us',
        'description' => 'PhotoRig is a simple resource and workflow management tool for photographers'
      ];

      $this->view('pages/contact', $data);
    }
  }