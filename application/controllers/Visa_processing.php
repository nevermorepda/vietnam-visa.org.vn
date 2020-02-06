<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visa_processing extends CI_Controller {

	public function index()
	{
		// $this->output->cache(CACHE_TIME);
		// $this->util->block_ip();
		$info = new stdClass();
		$info->catid = 4; // FAQs
		$info_evisa = new stdClass();
		$info_evisa->catid = 32; // FAQs
		
		$view_data = array();
		$view_data['faqs'] = $this->m_content->items($info, 1);
		$view_data['evisa_faqs'] = $this->m_content->items($info_evisa, 1);

		$tmpl_content = array();
		$tmpl_content['meta']['title'] = "How Vietnam Visa on Arrival works?";
		$tmpl_content['tabindex']  = "processing";
		$tmpl_content['content']   = $this->load->view("processing/index", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
	public function ajax_check_visa_available()
	{
		$nation_id = $this->input->post("nation_id");
		$types_of_tourist = $this->m_visa_fee->types_of_tourist($nation_id);
		$types_of_business = $this->m_visa_fee->types_of_business($nation_id);
		
		echo json_encode(array(sizeof($types_of_tourist), sizeof($types_of_business)));
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