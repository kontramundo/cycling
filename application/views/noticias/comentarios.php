<?php
foreach ($comentarios AS $comentario):
    ?>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-12">
            <div class="portlet portlet-default">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="media">
                                <a class="pull-left" href="chat.html#">
                                    <img class="media-object img-circle" src="<?php echo base_url('assets_gral/img/usuarios/'.$comentario->foto);?>" alt="" style="width:40px;height:40px">
                                </a>
                                <div class="media-body comentario" id="<?php echo $comentario->id_comentario;?>">
                                    <h4 class="media-heading"><?php echo utf8_decode(ucwords(strtolower($comentario->nombre)));?>
                                        <span class="small pull-right"><?php echo $comentario->cuando;?></span>
                                    </h4>
                                    <p><?php echo utf8_decode($comentario->comentario);?></p>
                                    
                                </div>

                                <?php 
                                if($comentario->imagen):
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <img class="img-responsive" src="<?php echo base_url();?>imagen/crop/500/500/<?php echo $comentario->imagen;?>"/>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                                ?>



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
                                                <img class="media-object img-circle" src="<?php echo base_url('assets_gral/img/usuarios/'.$subcomentario->foto);?>" alt="" style="width:40px;height:40px">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><?php echo utf8_decode(ucwords(strtolower($subcomentario->nombre)));?>
                                                    <span class="small pull-right"><?php echo $subcomentario->cuando;?></span>
                                                </h4>
                                                <p><?php echo $subcomentario->subcomentario;?></p>
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
endforeach;
?>