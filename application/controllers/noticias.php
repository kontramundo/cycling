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
			
			$this->load->view('noticias/comentarios', $datos);
		}
	}

	

	function mensajes_res()
	{		
		//NOTICIAS
		$id_usuario=$this->session->userdata['id_usuario'];
		$comentarios = $this->noticias_model->query_comentarios($id_usuario);

		foreach ($comentarios AS $comentario)
		{
			?>
    		<div class="row">
			    <div class="col-lg-8 col-lg-offset-2 col-md-12">
			        <div class="portlet portlet-default">
			            <div class="portlet-body">
			                <div class="row">
			                    <div class="col-lg-12">
			                        <div class="media">
			                            <a class="pull-left" href="chat.html#">
			                                <img class="media-object img-circle" src="<?php echo base_url();?>/assets_gral/img/user-profile-1.jpg" alt="" style="width:40px;height:40px">
			                            </a>
			                            <div class="media-body">
			                                <h4 class="media-heading"><?php echo utf8_decode(ucwords(strtolower($comentario->nombre)));?>
			                                    <span class="small pull-right"><?php echo $comentario->cuando;?></span>
			                                </h4>
			                                <p><?php echo utf8_decode($comentario->comentario);?></p>
			                            </div>
			                        </div>
			                    </div>


			                    <div class="col-md-7">
			                        <p class="text-muted">
			                        	<small>
			                        		<a href="<?php echo $comentario->id_comentario;?>" 
			                        			id="mg<?php echo $comentario->id_comentario;?>"
			                        			tipo_c="1" 
			                        			status_mg="<?php if ($comentario->me_gusta=='text-bold'){ echo 1;}else{ echo 0;}?>" 
			                        			class="<?php echo $comentario->me_gusta;?> me_gusta">
			                        			Me gusta
			                        		</a> 
			                        		- 
			                        		<a href="<?php echo $comentario->id_comentario;?>" 
			                        			id="nmg<?php echo $comentario->id_comentario;?>" 
			                        			tipo_c="1" 
			                        			status_nmg="<?php if ($comentario->no_me_gusta=='text-bold'){ echo 1;}else{ echo 0;}?>" 
			                        			class="<?php echo $comentario->no_me_gusta;?> no_me_gusta">
			                        			No me gusta
			                        		</a> 
			                        		- 
			                        		<a href="<?php echo $comentario->id_comentario;?>" class="text-muted btn_subcomentario">
			                        			Comentar
			                        		</a> 
			                        		- 
			                        		Compartir 
			                        			<a href="" class="text-muted facebook"><i class="fa fa-facebook"></i></a> 
			                        			<a href="" class="text-muted"><i class="fa fa-twitter"></i></a> 
			                        	</small>
			                        </p>
			                    </div>
			                    <div class="col-md-5">
			                        <p class="text-muted" style="float:right;">
			                            <small id="div_like_c_<?php echo $comentario->id_comentario;?>">
			                            	<i class="fa fa-thumbs-o-up"></i> <?php echo $comentario->total_me_gusta;?>  
			                            	<i class="fa fa-thumbs-o-down"></i> <?php echo $comentario->total_no_me_gusta;?> 
			                            	<i class="fa fa-comments"></i> <?php echo $comentario->total_subcomentarios;?>
			                            </small>
			                        </p>
			                    </div>
			                </div>



			                <!-- Imprime SUBCOMENTARIOS -->
			                <div id="subcomentario_<?php echo $comentario->id_comentario;?>">
				                <?php
								$subcomentarios = $this->noticias_model->query_subcomentarios($comentario->id_comentario);

								foreach ($subcomentarios AS $subcomentario)
								{
									?>
									<div class="portlet-footer">
					                    <div class="row">
					                        <div class="col-lg-12">
					                            <div class="media">
					                                <a class="pull-left" href="chat.html#">
					                                    <img class="media-object img-circle" src="<?php echo base_url();?>/assets_gral/img/user-profile-1.jpg" alt="" style="width:40px;height:40px">
					                                </a>
					                                <div class="media-body">
					                                    <h4 class="media-heading"><?php echo utf8_decode(ucwords(strtolower($subcomentario->nombre)));?>
					                                        <span class="small pull-right"><?php echo $subcomentario->cuando;?></span>
					                                    </h4>
					                                    <p><?php echo utf8_decode($subcomentario->subcomentario);?></p>
					                                </div>

					                                <div class="col-md-7">
					                                    <p class="text-muted">
					                                    	<small>
					                                    		<a href="<?php echo $comentario->id_comentario;?>" 
					                                    			id="smg<?php echo $comentario->id_comentario;?>" 
					                                    			tipo_c="2" 
				                        							status_mg="<?php if ($subcomentario->me_gusta=='text-bold'){ echo 1;}else{ echo 0;}?>" 
				                        							class="<?php echo $subcomentario->me_gusta;?> me_gusta">
				                        							Me gusta
				                        						</a> 
								                        		- 
								                        		<a href="<?php echo $comentario->id_comentario;?>" 
								                        			id="snmg<?php echo $comentario->id_comentario;?>" 
								                        			tipo_c="2" 
								                        			status_nmg="<?php if ($subcomentario->no_me_gusta=='text-bold'){ echo 1;}else{ echo 0;}?>" 
								                        			class="<?php echo $subcomentario->no_me_gusta;?> no_me_gusta">
								                        			No me gusta
								                        		</a> 
					                                    	</small>
					                                    </p>
					                                </div>
					                                <div class="col-md-5">
					                                    <p class="text-muted" style="float:right;">
					                                        <small id="div_like_s_<?php echo $subcomentario->id_comentario;?>">
					                                            <i class="fa fa-thumbs-o-down"></i> <?php echo $subcomentario->total_me_gusta;?> 
					                                            <i class="fa fa-thumbs-o-up"></i> <?php echo $subcomentario->total_no_me_gusta;?>
					                                        </small>
					                                    </p>
					                                </div>

					                            </div>
					                        </div>
					                    </div>
					                </div>
									<?php
								}
				                ?>
				            </div>




			                <div class="row">
			                    <div class="col-lg-12">
			                    	<div class="input-group">
										<input type="text" id="<?php echo $comentario->id_comentario;?>" class="form-control subcomentario" placeholder="Escribe un comentario...">
										<span class="input-group-addon"><a href=""><i class="fa fa-camera"></i></a></span>
									</div>
			                        
			                    </div>
			                    <!-- /.col-lg-12 -->
			                </div>
			                <!-- /.row -->



			            </div>
			        </div>
			    </div>
			    <!-- /.col-lg-12 -->
			</div>
    		<?php 
    	}
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

		$id_comentario=$this->noticias_model->query_insertar_comentario($id_usuario, $comentario);


		if($id_comentario)
		{

			$datos = array(
               'id_comentario' => $id_comentario,
               'comentario' => $comentario,
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