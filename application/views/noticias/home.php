<!-- begin PAGE TITLE ROW -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">
            <h1>
                Cycling
                <small>Noticias</small>
            </h1>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- end PAGE TITLE ROW -->
<div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-12">

        <div class="page-title">
                <textarea class="form-control" placeholder="&iquest;Que est&aacute;s pensando?" id="comentario" style="resize: vertical;"></textarea>
                <ol class="breadcrumb">
                    <li> <i class="fa fa-user"></i></li>
                    <li>
                        <a href="" class="operacion" id="mapa"><i class="fa fa-map-marker"></i></a>
                    </li>
                    <li>
                        <a href="" class="operacion" id="foto"><i class="fa fa-camera"></i></a>
                    </li>
                    <li>
                         <a href="" class="operacion" id="emoticones"><i class="fa fa-smile-o"></i></a>
                    </li>    
                </ol>
        <div class="row">
            <div class="col-lg-8"></div>
            <div class="col-lg-4" style="margin-top:-38px;"><button type="button" id="btn_comentario" class="btn btn-red" style="float:right;padding:1px 5px;font-size:12px;line-height:1.5;border-radius:3px;">Publicar</button></div>    
        </div>
    

        <div id="div_operaciones">
            <div class="tile breadcrumb oculta" id="div_foto" style="display:none;">
               
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;display:none">
                        <img data-src="holder.js/100%x100%" >
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                    <div>
                        <span class="btn btn-red btn-file"><span class="fileinput-new">Seleccione</span><span class="fileinput-exists"><i class="fa fa-pencil"></i></span><input type="file" name="imagen" id="imagen" accept="image/*"></span>
                        <a href="#" class="btn btn-red fileinput-exists"  id="trash" data-dismiss="fileinput"><i class="fa fa-trash-o"></i></a>
                    </div>
                </div>

            </div>

            <div class="tile breadcrumb oculta" id="div_emoticones" style="display:none;">

                <div class="btn-group">
                    <?php
                    foreach ($emoticones as $emoticon) 
                    {
                        echo '<a href="" class="btn emoticon" title="'.$emoticon->signo.'"><img src="'.base_url('assets_gral/img/emoticones/'.$emoticon->emoticon).'" /></a>';
                    }
                    ?>
                </div>

            </div>


             <div class="tile breadcrumb oculta" id="div_mapa" style="display:none;">
                <form>
                    <input type="text" id="geocomplete" class="form-control" name="location" placeholder="¿D&oacute;nde est&aacute;s?"> 
                    <div class="map_canvas" style="height: 150px;"></div> 
                    <input type="hidden" name="lat" id="lat"/>
                    <input type="hidden" name="lng" id="lng"/>
                </form>  
            </div>
        </div>

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div id="likes"><!-- Imprime Resultado de Like --></div>


<div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-12">
        <div id="loader"></div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div id="mensajes"><!-- Imprime los mensajes --></div>
<!-- / Mensajes -->



<div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-12">
        <div id="loader_top"></div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->




<!-- JS Autosize -->
<script type="text/javascript" src="<?php echo base_url();?>assets_gral/js/plugins/autosize/jquery.autosize.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_gral/js/plugins/jasny-bootstrap/jasny-bootstrap.min.js"></script>

<!-- JS MAPS -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_gral/js/plugins/google-maps/jquery.geocomplete.js"></script>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_gral/css/plugins/jasny-bootstrap/jasny-bootstrap.min.css">


<script type="text/javascript">
    $(document).ready(function(){


        //Localizacion
        $("#geocomplete").geocomplete({
            map: ".map_canvas",
            details: "form",
            types: ["geocode", "establishment"]
          }); 

        //Comentario
        $('#comentario').autosize();

        //Click Accion
        $(".operacion").click(function(evento){
            evento.preventDefault();

            if($(this).attr('id')=='foto')
            {
                $("#div_mapa").hide("fast");
                $("#div_emoticones").hide("fast");

                $("#div_foto").slideToggle("fast");
            }
            else if($(this).attr('id')=='emoticones')
            {
                $("#div_foto").hide("fast");
                $("#div_mapa").hide("fast");

                $("#div_emoticones").slideToggle("fast");
            }
            else if($(this).attr('id')=='mapa')
            {
                $("#div_foto").hide("fast");
                $("#div_emoticones").hide("fast");

                $("#div_mapa").slideToggle("fast");
            }

        });

        //Click Emoticon
        $(".emoticon").click(function(evento){
            evento.preventDefault();

            $("#comentario").val($("#comentario").val()+$(this).attr('title'));
        });


        //Publicar Comentario
        $("#btn_comentario").click(function(evento){
            evento.preventDefault();

            var comentario=$("#comentario").val();
            var latitud=$("#lat").val();
            var longitud=$("#lng").val();
            var ubicacion=$("#geocomplete").val();


            if(comentario)
            {
                var inputFileImage = document.getElementById("imagen");
                var file = inputFileImage.files[0];
                var data = new FormData();
                    data.append('imagen',file);
                    data.append('lat',latitud);
                    data.append('lng',longitud);
                    data.append('ubicacion',ubicacion);
                    data.append('comentario',comentario);

                 //Inserta Comentario
                $.ajax({url:"<?php echo base_url();?>noticias/insertar_comentario",
                    type:'POST',
                    contentType:false,
                    data:data,
                    processData:false,
                    cache:false,
                    success:function(result){
                            $("#comentario").val('');
                            $("#mensajes").prepend(result);
                            $("#div_operaciones").hide("fast");
                                $("#geocomplete").val('');
                                $('#trash').click();
                          }
                });
            }
            else
            {
                $("#comentario").focus();
            }
        });


        //Carga Mensajes
        $.ajax({url:"<?php echo base_url();?>noticias/mensajes",
            type:'POST',
            data:{last_id: '0'},
            success:function(result){
                $("#mensajes").html(result);
            }
        });

        //Muestra Mapa de comentario
        $("#mensajes").on('click', '.muestra_mapa', function(evento){
            evento.preventDefault();
            var id_comentario=$(this).attr('href');

            $("#mapa_"+id_comentario).slideToggle("fast");
        });

        //Click Me gusta
        $("#mensajes").on('click', '.me_gusta', function(evento){
            evento.preventDefault();

            var tipo_comentario=$(this).attr('tipo_c');
            var tipo_like=1;
            var id_comentario=$(this).attr('href');
            var status=$(this).attr('status_mg');

            //Oculta Me gusta o No me gusta
            if(tipo_comentario==1)
            {
                $("#nmg"+id_comentario).removeClass("text-bold").addClass( "text-muted" );
                $("#nmg"+id_comentario).attr('status_nmg', '0');
            }
            else if(tipo_comentario==2)
            {
                $("#snmg"+id_comentario).removeClass("text-bold").addClass( "text-muted" );
                $("#snmg"+id_comentario).attr('status_nmg', '0');
            }
            
            //Actualiza Estatus y estilo
            if (status==1)
            {
                $(this).attr('status_mg', '0');
                $(this).removeClass("text-bold").addClass( "text-muted" );
            }
            else
            {
                $(this).attr('status_mg', '1');
                $(this).removeClass("text-muted").addClass( "text-bold" );
            }


            //Inserta Like
            $.ajax({url:"<?php echo base_url();?>noticias/likes",
                type:'POST',
                data:{tipo_comentario: tipo_comentario, tipo_like: tipo_like, id_comentario: id_comentario, status: status},
                success:function(result){
                        $("#likes").html(result);
                      }
            });
            
        });


        //Click No me gusta
        $("#mensajes").on('click', '.no_me_gusta', function(evento){
            evento.preventDefault();

            var tipo_comentario=$(this).attr('tipo_c');
            var tipo_like=2
            var id_comentario=$(this).attr('href');
            var status=$(this).attr('status_nmg');

            //Oculta Me gusta o No me gusta
            if(tipo_comentario==1)
            {
                $("#mg"+id_comentario).removeClass("text-bold").addClass( "text-muted" );
                $("#mg"+id_comentario).attr('status_mg', '0');
            }
            else if(tipo_comentario==2)
            {
                $("#smg"+id_comentario).removeClass("text-bold").addClass( "text-muted" );
                $("#smg"+id_comentario).attr('status_mg', '0');
            }

            //Actualiza Estatus y estilo
            if (status==1)
            {
                
                $(this).attr('status_nmg', '0');
                $(this).removeClass("text-bold").addClass( "text-muted" );
            }
            else
            {
                
                $(this).attr('status_nmg', '1');
                $(this).removeClass("text-muted").addClass( "text-bold" );
            }

            //Inserta Like
            $.ajax({url:"<?php echo base_url();?>noticias/likes",
                type:'POST',
                data:{tipo_comentario: tipo_comentario, tipo_like: tipo_like, id_comentario: id_comentario, status: status},
                success:function(result){
                        $("#likes").html(result);
                      }
            });
        });

        //Clic Subcomentario
        $("#mensajes").on('click', '.btn_subcomentario', function(evento){
            evento.preventDefault();

            var id_comentario=$(this).attr('href');

            $("#com_"+id_comentario).focus();
        });


        //Click Facebook
        $("#mensajes").on('click', '.facebook', function(evento){
            evento.preventDefault();

            window.open(
                    'http://www.facebook.com/sharer.php?s=100&p[url]=http://cycling.kontramundo.com&p[title]=Cycling Community&p[summary]=lala&p[images][0]=http://cycling.kontramundo.com/assets/img/icons/logo_fb.png', 
                    'facebook-share-dialog', 
                    'width=626,height=436'); 
                  return false;
        });


        //Publicar Subcomentario
        $("#mensajes").on('keypress', '.subcomentario', function(evento){

            if(evento.which == 13) 
            {

                var id_comentario = $(this).attr('id');

                if(id_comentario)
                {
                    var subcomentario = $(this).val();

                    //Inserta Comentario
                    $.ajax({url:"<?php echo base_url();?>noticias/insertar_subcomentario",
                        type:'POST',
                        data:{id_comentario: id_comentario, subcomentario: subcomentario},
                        success:function(result){
                                $('.subcomentario').val('');
                                $("#subcomentario_"+id_comentario).append(result);
                              }
                    });
                }
            }

        });


        var cont = 1;
        $(window).scroll(function(){

            //Carga viejos comentarios
            if  ($(window).scrollTop() == $(document).height() - $(window).height())
            {    
                var last_id = $(".comentario").last().attr("id");   


                //Muestra Animacion
                $("#loader_top").show('slow').html('<img src="<?php echo base_url();?>/assets_gral/img/loader.gif" align="absmiddle">');

               
                if(last_id)
                {
                    //Carga viejos comentarios
                    $.ajax({url:"<?php echo base_url();?>noticias/mensajes",
                        type:'POST',
                        data:{last_id: last_id},
                        success:function(result){
                            $("#mensajes").append(result).show('slow');
                        }
                    });

                    $("#loader_top").hide('slow');
                }
            }


            //carga nuevos comentarios
            if($(window).scrollTop() <= 0) 
            {

                var first_id = $(".comentario").first().attr("id");

                if(cont==1)
                {
                    cont=0;

                    $("#loader").show('fast').html('<img src="<?php echo base_url();?>/assets_gral/img/loader.gif" align="absmiddle">');
                    
                    //Carga viejos comentarios
                    $.ajax({url:"<?php echo base_url();?>noticias/mensajes",
                        type:'POST',
                        data:{first_id: first_id},
                        success:function(result){
                            
                            $("#mensajes").prepend(result).show('slow');
                            

                        }
                    });

                    $("#loader").hide('fast');
                }
            } 
            else 
            {
                $("#loader").hide('fast');
                cont=1;
            }




        });
    });
</script>
