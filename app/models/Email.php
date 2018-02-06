<?php 
class Email {
	private $db;

    public function __construct(){
    }


	public function sendEmail($data){	
			if(mail($data['send_from'],
					$data['subject'],
					$data['body'],
					$data['sender']
				)){
				flash('contact_success', 'Email Successful - Your message has been sent!');
			redirect('pages/contact');
		} else {
				flash('contact_fail', 'Email Failed - Your message has not been sent.');
				redirect('pages/contact');
		}			
	}
  }

    ?>