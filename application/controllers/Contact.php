<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function index()
	{
		$this->util->block_ip();
		$this->output->cache(CACHE_TIME);
		
		$tmpl_content = array();
		$tmpl_content['meta']['title'] = "Contact Us";
		$tmpl_content['tabindex']  = "contact";
		$tmpl_content['content']   = $this->load->view("contact", NULL, TRUE);
		$this->load->view('layout/view', $tmpl_content);
	}
	
	public function message()
	{
		if (!empty($_POST))
		{
			// Save
			$fullname = $this->util->value($this->input->post("fullname"), "");
			$email = $this->util->value($this->input->post("email"), "");
			$phone = $this->util->value($this->input->post("phone"), "");
			$content = $this->util->value($this->input->post("message"), "");
			$g_recatcha = $this->input->post("g-recaptcha-response");
			
			if ($this->captcha->test_recaptcha($g_recatcha, $this->input->ip_address(), $this->input->user_agent())) {
				// Inform by mail
				$mail = array(
	            		"subject"		=> "[Contact] ".$fullname,
						"from_sender"	=> $email,
	            		"name_sender"	=> $fullname,
						"to_receiver"   => MAIL_INFO, 
						"message"       => $content
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				$this->session->set_flashdata("success", "Your message has been sent successful.");
			} else {
				$this->session->set_flashdata("error", "The CAPTCHA field is telling me that you are a robot. Shall we give it another try?");
			}
		}
		
		redirect("contact", "back");
	}
}

?>