<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('sesion_model');
	}

	function index()
	{
		$this->load->helper('form');
		$this->load->view('home/home');
	}

	function registro()
 	{
	  	$nombre=$this->input->post('nombre');
		$apellidos=$this->input->post('apellidos');
		$email=$this->input->post('email');
		$username=$this->input->post('usuario');
		$password=$this->input->post('password');
		$fecha=$this->input->post('anio')."-".$this->input->post('mes')."-".$this->input->post('dia');
		$pais=$this->input->post('pais');
		  
		$result=$this->sesion_model->registra_user($nombre,$apellidos,$email,$username,$password,$fecha,$pais);

		if($result[0]["mensaje"]>0)
		{
			foreach($result as $row)
			{
				$sess_array = array(
				  'id_usuario' => $row["id_u"],
				  'usuario' => $row["u"],
				  'nombre' => $row["n"],
				  'foto' => 'default_user.jpg'
			    );
			    $this->session->set_userdata($sess_array);
			}
			
			redirect(base_url().'noticias');

		}
	  	else
	  	{
	  		redirect(base_url().'home');
		}	     	
	  
 	}
}

?>