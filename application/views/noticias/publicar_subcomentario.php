<div class="portlet-footer">
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
                    <p><?php echo utf8_decode($subcomentario);?></p>
                </div>

                <div class="col-md-7">
                    <p class="text-muted">
                        <small>
                            <a href="<?php echo $id_comentario;?>" 
                                id="smg<?php echo $id_comentario;?>" 
                                tipo_c="2" 
                                status_mg="0" 
                                class="text_muted me_gusta">
                                Me gusta
                            </a> 
                            - 
                            <a href="<?php echo $id_comentario;?>" 
                                id="snmg<?php echo $id_comentario;?>" 
                                tipo_c="2" 
                                status_nmg="0" 
                                class="text-muted no_me_gusta">
                                No me gusta
                            </a> 
                        </small>
                    </p>
                </div>
                <div class="col-md-5">
                    <p class="text-muted" style="float:right;">
                        <small id="div_like_s_<?php echo $id_comentario;?>">
                            <i class="fa fa-thumbs-o-down"></i> 
                            <i class="fa fa-thumbs-o-up"></i> 
                        </small>
                    </p>
                </div>

            </div>
        </div>
    </div>