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
                            <div class="media-body comentario" id="<?php echo $id_comentario;?>">
                                <h4 class="media-heading"><?php echo ucwords(strtolower($usuario));?>
                                    <span class="small pull-right"><?php echo 'Hace unos segundos';?></span>
                                </h4>
                                <p>
                                    <?php echo $comentario;

                                    //Verifica si hay ubicacion
                                    if($latitud && $longitud && $ubicacion):
                                        ?>
                                        <span class='text-muted'> - en </span><a href='<?php echo $id_comentario;?>' class='muestra_mapa text-muted'><?php echo $ubicacion;?></a>
                                        <?php
                                    endif;
                                    ?>
                                </p>
                            </div>

                            <!-- Contenido multimedia del comentario -->
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <?php 
                                    //Imprime mapa
                                    if($latitud && $longitud && $ubicacion):
                                        ?>
                                        <div id="mapa_<?php echo $id_comentario;?>" style="display:none">
                                            <img class="img-responsive" src="http://maps.googleapis.com/maps/api/staticmap?size=400x150&maptype=roadmap\&zoom=15&markers=size:mid%7Ccolor:red%7C<?php echo $latitud;?>,<?php echo $longitud;?>&sensor=false" />    
                                        </div>
                                        <?php
                                    endif;

                                    //imrpime imagen
                                    if($imagen):
                                        ?>
                                        <img class="img-responsive" src="<?php echo base_url();?>imagen/crop/400/400/<?php echo $imagen;?>"/>
                                        <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <!-- Fin contenido multimedia del comentario -->


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