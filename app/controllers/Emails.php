<?php
class Emails extends Controller {
public function __construct(){

      $this->emailsModel = $this->model('Email');
}

public function sendEmail(){
if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
			'send_from' => 'nderrb@gmail.com',
			'sender' => $_POST['email'],
			'sender_name' => $_POST['name'],
			'phone' => $_POST['phone'],
			'subject' => "New Contact from PhotoRig",
			'message' => $_POST['message']
		];

		if(isset($_POST['contactMethod'])){
			if(isset($_POST['contactMethod']) && $_POST['contactMethod']=="contactMethod-email"){
				$data['contactMethod'] = "Reply Via Email";
				} else {
				$data['contactMethod'] = "Reply Via Phone";
				}
			}

		//validate data
			//
			if(empty($data['sender'])){
          $data['email_err'] = 'Please enter your email';
        }

        if(empty($data['sender_name'])){
          $data['name_err'] = 'Please enter your name';
        }

        if(empty($data['phone'])){
          $data['phone_err'] = 'Please enter your phone number';
        }

        if(empty($data['contactMethod'])){
          $data['contact_err'] = 'Please enter your preferred method of contact.';
        }

        if(empty($data['message'])){
          $data['msg_err'] = 'Please enter a description or reason for contacting us.';
        }

		//make sure errors are empty
        if(
        	empty($data['email_err']) 
        	&& empty($data['name_err'])
        	&& empty($data['phone_err'])
        	&& empty($data['contact_err'])
        	&& empty($data['msg_err'])
        ){

		$data['body'] .= "To: " .$data['send_from']."\r\n";
		$data['body'] .= "From: " .$data['sender_name'].",\r\n"
								  .$data['sender'].",\r\n"
								  .$data['phone'].",\r\n";
		$data['body'] .= "Contact Preference: ".$data['contactMethod']."\r\n";
		$data['body'] .= "Message: ".$data['message'];

	
		$this->emailsModel->sendEmail($data);
	} else {
		$this->view('pages/contact', $data);
	}
}
}

}
?>