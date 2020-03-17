<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services_app extends CI_Controller {
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

		foreach ($bookings as $booking) {
			$info             = new stdClass();
			$info->book_id    = $booking->id;
			$booking->paxs    = $this->m_visa_pax->items($info);
		}

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
	////////// apply visa //////////////////
	public function visa_step1 () {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");

		$visa_types 	= $this->m_visa_type->items(NULL, 1);
		$arrival_ports 	= $this->m_arrival_port->items(NULL, 1);

		echo json_encode(array($visa_types, $arrival_ports));
	}
	public function valid_option() {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");

		$status = 0;

		$visa_type 		= $this->input->post('visa_type');
		$visit_purpose 	= $this->input->post('visit_purpose');
		$arrival_date 	= $this->input->post('arrival_date');

		if (!empty($visa_type) && !empty($visit_purpose) &&!empty($arrival_date)) {
			$status = $this->util->detect_processing_time($arrival_date, $visa_type, $visit_purpose);
		}

		echo json_encode($status);
	}
	function cal_visa_fee() {
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");

		$group_size			= (!empty($_POST["group_size"]) ? $_POST["group_size"] : 0);
		$visa_type			= (!empty($_POST["visa_type"]) ? $_POST["visa_type"] : "1ms");
		$visit_purpose		= (!empty($_POST["visit_purpose"]) ? $_POST["visit_purpose"] : "");
		$arrival_port		= (!empty($_POST["arrival_port"]) ? $_POST["arrival_port"] : 0);
		$processing_time	= $_POST["process_time"];
		$service_type		= ($_POST["fast_checkin"] == true) ? 1 : 0;
		$car_type			= (!empty($_POST["car_type"]) ? $_POST["car_type"] : "");
		$num_seat			= (!empty($_POST["num_seat"]) ? $_POST["num_seat"] : 0);
		
		$result = array();
		
		// Private letter
		$private_visa = $this->m_private_letter_fee->search(((stripos(strtolower($visit_purpose), "business") === false) ? "tourist_" : "business_").$visa_type);
		
		// FC
		$fast_checkin = $this->m_fast_checkin_fee->search($service_type, $arrival_port);
		
		// Car pick-up
		$car_pickup = $this->m_car_fee->search($num_seat, $arrival_port);
		
		// Visa service
		if ($visa_type == 'e-1ms') {
			$visa_fee = $this->m_visa_fee->cal_e_visa_fee('1ms', $group_size, $processing_time, "", $visit_purpose, $arrival_port);
		} else {
			$visa_fee = $this->m_visa_fee->cal_visa_fee($visa_type, $group_size, $processing_time, "", $visit_purpose, $arrival_port);
		}
		// Full package
		$full_package = $this->m_fast_checkin_fee->search(1, $arrival_port);
		
		$result = array($private_visa, $full_package, $fast_checkin, $car_pickup, $visa_fee->service_fee, $visa_fee->rush_fee, $visa_fee->stamp_fee);
		echo json_encode($result);
	}
}

?>