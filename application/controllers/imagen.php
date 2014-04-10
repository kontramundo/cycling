<?php
class Imagen extends CI_Controller 
{
	public function __construct () 
	{
		parent::__construct();
		$this->load->library('image_moo');
	}

	public function crop($width, $height, $imagen)
	{
		/*
		$this->load->library('image_moo');

		$this->image_moo
			->load($_SERVER['DOCUMENT_ROOT'].'/cycling/assets_gral/img/usuarios/iphone.jpg')
			->resize_crop(50,50)
			->save_dynamic();
		if($this->image_moo->errors) print $this->image_moo->display_errors();



		/*
		$this->load->library('image_lib');


		$config['image_library'] = 'GD';
		$config['source_image']	= $_SERVER['DOCUMENT_ROOT'].'/cycling/assets_gral/img/usuarios/mario.png';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']	 = 75;
		$config['height']	= 50;

		$this->load->library('image_lib', $config); 

		$this->image_lib->resize();

		 if ( !$this->image_lib->resize() ) echo $this->image_lib->display_errors();
		*/
	
		$this->image_moo
			->load($_SERVER['DOCUMENT_ROOT'].'/cycling/assets_gral/img/uploads/'.$imagen)
			->resize_crop($width,$height)
			->save_dynamic();
		
		if($this->image_moo->errors) print $this->image_moo->display_errors();
	}
}
?>