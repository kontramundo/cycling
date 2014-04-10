<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fotos extends CI_Controller {
	
	function index()
	{
		if($this->session->userdata('logged_in')):
			$session_data = $this->session->userdata('logged_in');
			$data['usuario'] = $session_data['usuario'];
			$idusuario = $session_data['id_usuario'];
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/footer');
		else:
     		//si no tiene sesion lo manda al login
     	redirect('home', 'refresh');
 		endif;
	}
}

?>