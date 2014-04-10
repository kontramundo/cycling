<div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-12">
        <div class="portlet portlet-default">
            <div class="portlet-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="media">
                            <a class="pull-left" href="chat.html#">
                                <img class="media-object img-circle" src="<?php echo base_url('assets_gral/img/usuarios/'.$foto);?>" alt="" style="width:40px;height:40px">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo utf8_decode(ucwords(strtolower($usuario)));?>
                                    <span class="small pull-right"><?php echo 'Hace unos segundos';?></span>
                                </h4>
                                <p><?php echo utf8_decode($comentario);?></p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-7">
                        <p class="text-muted">
                        	<small>
                        		<a href="<?php echo $id_comentario;?>" 
                        			id="mg<?php echo $id_comentario;?>"
                        			tipo_c="1" 
                        			status_mg="0" 
                        			class="text-muted me_gusta">
                        			Me gusta
                        		</a> 
                        		- 
                        		<a href="<?php echo $id_comentario;?>" 
                        			id="nmg<?php echo $id_comentario;?>" 
                        			tipo_c="1" 
                        			status_nmg="0" 
                        			class="text-muted no_me_gusta">
                        			No me gusta
                        		</a> 
                        		- 
                        		<a href="<?php echo $id_comentario;?>" class="text-muted btn_subcomentario">
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
                            <small id="div_like_c_<?php echo $id_comentario;?>">
                            	<i class="fa fa-thumbs-o-up"></i>   
                            	<i class="fa fa-thumbs-o-down"></i> 
                            	<i class="fa fa-comments"></i> 
                            </small>
                        </p>
                    </div>
                </div>


                <div id="subcomentario_<?php echo $id_comentario;?>"></div>
                    <div class="row">
                        <div class="col-lg-12">
                        	<div class="input-group">
    							<input type="text" id="<?php echo $id_comentario;?>" class="form-control subcomentario" placeholder="Escribe un comentario...">
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