<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['main_content'] = 'main_form';
		$this->load->view('template/content',$data);
	}

	public function store()
	{
		var_dump($_POST);
		$data_uri = $this->input->post('txtsignature');
		$encoded_image = str_replace('data:image/png;base64,', '', $data_uri);
    	$encoded_image = str_replace(' ', '+', $encoded_image);
		$decoded_image = base64_decode($encoded_image);
		file_put_contents("./uploades_files/signature.png", $decoded_image);
	}
}
