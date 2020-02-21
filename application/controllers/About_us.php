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
		$item = $this->m_nation->items();
		echo json_encode($item);
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
		if (empty($this->m_user->get_user_by_email($email))) {
			if ($this->m_user->add($data)) {
				echo json_encode(1);
			} else {
				echo json_encode(0);
			}
		} else {
			echo json_encode(-1);
		}
	}

	public function login_ionic() {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");
		
		$email 			= $this->input->post('email');
		$password 		= $this->input->post('password');

		$user = $this->m_user->login_ionic($email, $password);
		echo json_encode($user);
	}

	public function update_profile() {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");
		
		$id 			= $this->input->post('id');
		$fullname 		= $this->input->post('fullname');
		$phone 			= $this->input->post('phone');
		$address 		= $this->input->post('address');
		$country 		= $this->input->post('country');

		$data = array(
			'user_fullname' => $fullname,
			'phone' 		=> $phone,
			'address' 		=> $address,
			'country' 		=> $country,
		);

		$user = $this->m_user->update($data, array('id' => $id));
		echo json_encode($user);
	}

	public function get_myapplication() {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");
		
		$user_id = $this->input->post('user_id');
		$bookings = $this->m_visa_booking->book_by_user($user_id);
		echo json_encode($bookings);
	}
	public function change_password() {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");

		$id 				= $this->input->post('id');
		$password 			= $this->input->post('password');
		$new_password 		= $this->input->post('new_password');
		$re_new_password 	= $this->input->post('re_new_password');
		$data = array(
			'user_pass' => md5($new_password)
		);
		$user = $this->m_user->load($id);

		if ($user->user_pass != md5($password)) {
			echo json_encode(3);
		} else if ($new_password != $re_new_password) {
			echo json_encode(2);
		} else {
			$this->m_user->update($data, array('id' => $id));
			echo json_encode(1);
		}
	}
}

?>