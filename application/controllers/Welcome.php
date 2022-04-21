<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {


	function __construct(){
		parent::__construct();
		$this->page->setTitle('SPK Apps - Beranda');
		$this->page->setTitleContent('Beranda');
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
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
		$data['c1'] = $this->db->get('kriteria')->num_rows();
		$data['c2'] = $this->db->get('subkriteria')->num_rows();
		$data['c3'] = $this->db->get('calon')->num_rows();

		loadPage('layouts/index', $data);
	}
}
