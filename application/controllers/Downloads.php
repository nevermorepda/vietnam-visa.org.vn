<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads extends CI_Controller {

	public function index()
	{
		redirect("faqs/download-form");
	}
}

?>