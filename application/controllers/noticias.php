<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('noticias_model');

		$this->verifica_sesion();

	}

	function verifica_sesion()
	{
		if (!$this->session->userdata('usuario'))
		{
			//si no tiene sesion lo manda al login
     		redirect(base_url().'home');
		}
	}

	function index()
	{
		$id_usuario = $this->session->userdata['id_usuario'];
		$data['usuario'] = $this->session->userdata['usuario'];
		$data['foto'] = $this->session->userdata['foto'];

		//Emoticones
		$data['emoticones']=$this->noticias_model->query_emoticones();

		$this->load->view('templates/header', $data);
		$this->load->view('noticias/home');
		$this->load->view('templates/footer', $data);
	}


	function mensajes()
	{
		$first_id=$this->input->post('first_id');
		$last_id=$this->input->post('last_id');
		
		$id_usuario = $this->session->userdata['id_usuario'];
		$data['usuario'] = $this->session->userdata['usuario'];


		if($first_id)
		{
			$id=">".$first_id;
		}
		else if($last_id)
		{
			$id="<".$last_id;
		}
		else
		{
			$id="!=0";
		}

		if($id_usuario && $id)
		{
			//Obtiene los comentarios de la seccion Noticias
			$datos['comentarios']=$this->noticias_model->query_comentarios($id_usuario, $id);

			//Emoticones
			$emoticon=$this->emoticones();
			$datos['signo']=$emoticon[0];
			$datos['emoticon']=$emoticon[1];
			
			$this->load->view('noticias/comentarios', $datos);
		}
	}

	function emoticones()
	{
		//Emoticones
		$emoticones=$this->noticias_model->query_emoticones();
		$emoticon=array();
		$signo=array();

		foreach ($emoticones as $emoti) 
		{
			$signo[]=$emoti->signo;
			$emoticon[]='<img src="'.base_url('assets_gral/img/emoticones/'.$emoti->emoticon).'"/>';
		}

		return array($signo,$emoticon);
	}


	function likes()
	{
		//Captura variables POST enviadas por AJAX
		$tipo_comentario=$this->input->post('tipo_comentario');
		$tipo_like=$this->input->post('tipo_like');
		$id_comentario=$this->input->post('id_comentario');
		$status=$this->input->post('status'); //Status para saber si se inserta o no 1-Si 0- NO
		$id_usuario=$this->session->userdata['id_usuario'];

		//Llama al modelo insertar like
		$like=$this->noticias_model->query_insertar_like($tipo_comentario,$tipo_like,$id_comentario,$status,$id_usuario);

		if($like->mensaje==1)
		{
			if($tipo_comentario==1)
			{
				$div="#div_like_c_".$id_comentario;
			}
			else if($tipo_comentario==2)
			{
				$div="#div_like_s_".$id_comentario;
			}
			?>
			<script type="text/javascript">

			//Hace llamado al metodo que actualiza los likes
	        $.ajax({url:"<?php echo base_url();?>noticias/actualizar_likes",
	            type:'POST',
	            data:{id_comentario: <?php echo $id_comentario;?>, tipo_comentario: <?php echo $tipo_comentario;?>},
	            success:function(result){
	                $("<?php echo $div;?>").html(result);
	            }
	        });
			</script>
			<?php
		}
		else
		{
			?>
			<div class="alert alert-danger">
				<strong>ERROR:</strong> Al insertar Like
			</div>
			<?php
		}
		
	}

	function actualizar_likes()
	{
		$id_comentario=$this->input->post('id_comentario');
		$tipo_comentario=$this->input->post('tipo_comentario');

		//Llama al modelo actualizar likes
		$actualizar=$this->noticias_model->query_actualizar_likes($id_comentario, $tipo_comentario);

		
		if($actualizar)
		{	
			?>
			<i class="fa fa-thumbs-o-up"></i> <?php echo $actualizar->total_me_gusta;?>  
	    	<i class="fa fa-thumbs-o-down"></i> <?php echo $actualizar->total_no_me_gusta;
	    	if($tipo_comentario==1)
			{
				?>
	    		<i class="fa fa-comments"></i> <?php echo $actualizar->total_subcomentarios;?>
				<?php
			}
		}

		
	}

	function insertar_comentario()
	{
		$id_usuario=$this->session->userdata['id_usuario'];
		$usuario=$this->session->userdata['usuario'];
		$foto=$this->session->userdata['foto'];


		$comentario=$this->input->post('comentario');
		
		$comentario = str_replace("\n", "<br/>", $comentario);




		if (!empty($_FILES)) 
		{
			$tempFile = $_FILES['imagen']['tmp_name'];

			$nameFile='img_'.uniqid().'.jpg';
			$targetFile=$_SERVER['DOCUMENT_ROOT'].'/cycling/assets_gral/img/uploads/'.$nameFile;
			
			// Validate the file type
			//$fileTypes = array('jpg','jpeg','JPG','JPEG'); // File extensions
			$fileTypes = array("image/jpg", "image/jpeg");
			$fileParts = pathinfo($_FILES['imagen']['name']);

			
			
			if (in_array($_FILES['imagen']['type'],$fileTypes)) 
			{
				if (move_uploaded_file($tempFile,$targetFile))
				{
					$imagen=$nameFile;
					?>
					<!-- <p class="msj">El archivo "<?php echo $_FILES['imagen']['name'];?>" se ha cargado correctamente</p> -->
					<?php
				}
				else
				{
					?>
					<p class="error">No se pudo cargar el archivo</p>
					<?php
				}
			} 
			else 
			{
				?>
				<p class="error">Archivo Invalido</p>
				<?php
			}

		}
		else
		{
			$imagen="";
		}




		
		$id_comentario=$this->noticias_model->query_insertar_comentario($id_usuario, $comentario, $imagen);


		if($id_comentario)
		{

			//Emoticones
			$emoticon=$this->emoticones();
			$comentario=str_replace($emoticon[0], $emoticon[1], $comentario);

			$datos = array(
               'id_comentario' => $id_comentario,
               'comentario' => $comentario,
               'imagen' => $imagen,
               'usuario' => $usuario,
               'foto' => $foto
          	);

			//Carga la vista publicar comentario
			$this->load->view('noticias/publicar_comentario', $datos);
		}
		else
		{
			?>
			<div class="alert alert-danger">
				<strong>ERROR:</strong> Al insertar Comentario
			</div>
			<?php
		}
	}


	function insertar_subcomentario()
	{
		$id_usuario=$this->session->userdata['id_usuario'];
		$usuario=$this->session->userdata['usuario'];
		$foto=$this->session->userdata['foto'];
		

		$id_comentario=$this->input->post('id_comentario');
		$subcomentario=$this->input->post('subcomentario');

		$id_subcomentario=$this->noticias_model->query_insertar_subcomentario($id_usuario, $id_comentario, $subcomentario);


		if($id_subcomentario)
		{

			//Emoticones
			$emoticon=$this->emoticones();
			$subcomentario=str_replace($emoticon[0], $emoticon[1], $subcomentario);

			$datos = array(
               'id_comentario' => $id_comentario,
               'id_subcomentario' => $id_subcomentario,
               'subcomentario' => $subcomentario,
               'usuario' => $usuario,
               'foto' => $foto
          	);

			//Carga la vista publicar subcomentario
			$this->load->view('noticias/publicar_subcomentario', $datos);
			?>

			<script type="text/javascript">
				//Hace llamado al metodo que actualiza los likes
		        $.ajax({url:"<?php echo base_url();?>noticias/actualizar_likes",
		            type:'POST',
		            data:{id_comentario: <?php echo $id_comentario;?>, tipo_comentario: 1},
		            success:function(result){
		                $("#div_like_c_<?php echo $id_comentario;?>").html(result);
		            }
		        });
			</script>
			<?php
		}
		else
		{
			?>
			<div class="alert alert-danger">
				<strong>ERROR:</strong> Al insertar Comentario
			</div>
			<?php
		}
	}
}

?>