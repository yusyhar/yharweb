<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
  	$this->load->view('email');
	}

	public function sendemail()
	{
  	$data = $this->input->post();
  	$this->load->library('email');

  	$config = array();
  	$config['protocol'] = 'smtp' ;
  	$config['smtp_host'] = 'ssl://mail.yharsolutions.com' ;
  	$config['smtp_user'] = 'admin@yharsolutions.com' ;
  	$config['smtp_pass'] = 'Yus@583890' ;
  	$config['smtp_port'] = '465' ;
  	$this->email->initialize($config);

  	$this->email->set_newline("\r\n");

  	$this->email->from($data['email']);
  	$this->email->to('admin@yharsolutions.com');
  	$this->email->subject($data['subject']);
  	$this->email->message($data['msg']);
  	if($this->email->send()){
  		$this->session->set_flashdata('success','Email Sent Successfully!');
  		redirect(base_url()."email/index");
  	}
	}
}
