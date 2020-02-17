<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->util->block_ip();
		$this->output->cache(CACHE_TIME);

		$info = new stdClass();
		$info->catid = ID_EXTRA_SERVICES;
		$services = $this->m_content->items($info,1,4);
		
		$visa_news_info = new stdClass();
		$visa_news_info->catid = 2;

		$faqs_news_info = new stdClass();
		$faqs_news_info->catid = 4;

		$view_data = array();
		$view_data['services']  = $services;
		$view_data['nations'] = $this->m_country->items(NULL, 1);
		$view_data['visa_news'] = $this->m_content->items($visa_news_info, 1, 8);
		$view_data['faq_news'] = $this->m_content->items($faqs_news_info, 1, 8);

		$tmpl_content = array();
		$tmpl_content['tabindex']  = "home";
		$tmpl_content['content']   = $this->load->view("home", $view_data, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}

	function ajax_api() {
		$groupsize = $this->input->post('groupsize');
		$type = $this->input->post('type');
		$purpose = $this->input->post('purpose');
		$processing_time = $this->input->post('processing_time');
		$private_visa = $this->input->post('private_visa');

		$oj = '';
		if ($purpose == 'For business'){
			$oj .= 'business';
		} elseif($purpose == 'For tourist') {
			$oj .= 'tourist';
		}

		$oj .= '_'.$type;
		$fee = $this->m_visa_fee->search(0);
		$private_letter_fee = 0;
		if (!empty($private_visa)) {
			$private_letter_fee = (int)$this->m_private_letter_fee->search($oj);
		}
		$total = $fee->{$oj} * $groupsize;

		if ($processing_time == 'Urgent') {
			$oj .='_urgent';
		} elseif ($processing_time == 'Emergency') {
			$oj .='_emergency';
		}
		
		$processing_fee = $this->m_processing_fee->search($oj);
		$processing_fee = $processing_fee * $groupsize;
		$total = $total + $processing_fee + $private_letter_fee;
		echo json_encode($total);
	}

	function subscribe_email() {
		$email = $this->input->post('email');
		$info = new stdClass();
		$info->email = $email;
		if (empty($this->m_subscribe->items($info))) {
			$this->m_subscribe->add(array('email' => $email));
			echo 1;
		} else {
			echo 0;
		}
	}
}

?>