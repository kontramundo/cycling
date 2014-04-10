<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class sesion extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('sesion_model','',TRUE);
	}

	function login()
 	{



	   	$this->load->library('form_validation');
   		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'trim|required|xss_clean|callback_check_database');
		
		if($this->form_validation->run() == FALSE)
		{
		 	//si fallo lo regreso a la pagina de login
		 	//$this->load->view('home/home');
		 	echo validation_errors();
		}
		else
		{	
			//de lo contrario se va a home
			//redirect('sesion/home', 'refresh');
			
			?>
			<script>		
			url = "<?php echo base_url();?>noticias";  
			$(location).attr('href',url); 
			</script>
			<?php
			//echo "ok";
		}
 	}
	
	function check_database($password)
	{
		//recibo variable usuario
	    $username = $this->input->post('usuario');
	
	    //consulta base de datos
	    $result = $this->sesion_model->login($username,$password);
	
	    if($result)
	    {
			$sess_array = array();
		  	foreach($result as $row)
		  	{
			    $sess_array = array(
				  'id_usuario' => $row->id_usuario,
				  'usuario' => $row->usuario,
				  'nombre' => $row->nombre,
				  'foto' => $row->foto
			    );
		    	$this->session->set_userdata($sess_array);
		  	}
		  	return TRUE;
		}
	    else
	    {
			$this->form_validation->set_message('check_database', '<center><b>El usuario o contrase&ntilde;a no son v&aacute;lidos</b></center>');
		  	return FALSE;
	    }
	}

	 function logout()
 	 {
   	 	//$this->session->unset_userdata('usuario');
   	 	$this->session->sess_destroy();
   	 	redirect(base_url().'home');
 	 }
 }