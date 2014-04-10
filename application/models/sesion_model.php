<?php
class sesion_model extends CI_Model {

	function login($username,$password)
	{		
		$query=$this->db->query("select * from usuarios where usuario='$username' and password=sha1('$password') and borrado=0");

		if($query->num_rows()==1):
			return $query->result();
		else:
			return false;
		endif;
	}

	function registra_user($nombre,$apellidos,$email,$usuario,$pass,$fecha,$pais)
	{
		$query=$this->db->query(" CALL registrar_usuario('$nombre','$apellidos','$email','$usuario','$pass','$fecha','$pais')");

		$result = $query->result_array();
		$query->next_result();
		$query->free_result();

		return $result;
	}
	
	function busca_usuario($usuario,$pass)
	{
		$query=$this->db->query("select * from usuarios where usuario='$usuario' and password=sha1('$pass') and borrado=0");
		return $query->result_array();
	}
}