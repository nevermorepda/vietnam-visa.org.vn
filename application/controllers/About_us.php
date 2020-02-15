<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_us extends CI_Controller {

	public function index()
	{
		$breadcrumb = array("Abouts us" => site_url("{$this->util->slug($this->router->fetch_class())}"));
		$this->util->block_ip();
		$this->output->cache(CACHE_TIME);
		
		$info = new stdClass();
		$info->catid = 11;
		$items = $this->m_content->items($info, 1);
		
		if (!empty($items)) {
			$item = $items[0];
		}
		
		// Check error before load page content
		$this->util->checkPageError($item);
		
		$view_data = array();
		$view_data['item'] = $item;
		$view_data['breadcrumb'] = $breadcrumb;
		
		$tmpl_content = array();
		$tmpl_content['meta']['title'] = $this->util->getMetaTitle($item);
		$tmpl_content['meta']['keywords'] = $item->meta_key;
		$tmpl_content['meta']['description'] = $item->meta_desc;
		$tmpl_content['content'] = $this->load->view("content/detail", $view_data, TRUE);
		$this->load->view('layout/view', $tmpl_content);
	}
	
	public function team()
	{
		//$this->output->cache(CACHE_TIME);
		
		$tmpl_content = array();
		$tmpl_content['content'] = $this->load->view("team/index", NULL, TRUE);
		$this->load->view('layout/view', $tmpl_content);
	}
	public function get_cate() {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");
		echo json_encode(1);
		// $item = $this->m_content_category->items();
		// echo json_encode($item);
	}
	public function post_cate() {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");
		$title 			= $this->input->post('title');
		$fullname 		= $this->input->post('fullname');
		$phone 			= $this->input->post('phone');
		$email 			= $this->input->post('email');
		$password 		= $this->input->post('password');
		$re_password 	= $this->input->post('re_password');
		$data = array(
			"title"				=> $title,
			"user_fullname"		=> $fullname,
			"user_login"		=> $email,
			"user_pass"			=> md5($password),
			"user_email"		=> $email,
			"active"			=> 1,
			"phone"				=> $phone,
			"user_registered"	=> date($this->config->item("log_date_format")),
			"client_ip"			=> $this->util->realIP()
		);
		echo json_encode($data);
	}
	public function check_mail() {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");
		$email = $this->input->post('email');
		if (empty($this->m_user->get_user_by_email($email))) {
			// $this->m_users->add(array('email' => $email));
			echo json_encode(1);
		} else {
			echo json_encode(0);
		}
	}

}

?>