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
                    <li><i class="fa fa-map-marker"></i></li>
                    <li><a href="" class="operacion" id="foto"><i class="fa fa-camera"></i></a></li>
                    <li><i class="fa fa-smile-o"></i></li>    
                </ol>
        <div class="row">
            <div class="col-lg-8"></div>
            <div class="col-lg-4" style="margin-top:-38px;"><button type="button" id="btn_comentario" class="btn btn-red" style="float:right;padding:1px 5px;font-size:12px;line-height:1.5;border-radius:3px;">Publicar</button></div>    
        </div>
    

        <div class="tile gray" id="div_operacion" style="display:none;">
            <input type="file" name="upload" id="upload" />
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

<script type="text/javascript">
    $(document).ready(function(){

        //Comentario
        $('#comentario').autosize();

        //Click Accion
        $(".operacion").click(function(evento){
            evento.preventDefault();

            $("#div_operacion").slideToggle("fast");

        });


        //Click Publicar
        $("#btn_comentario").click(function(evento){
            evento.preventDefault();

            //Inserta Comentario
            $.ajax({url:"<?php echo base_url();?>noticias/insertar_comentario",
                type:'POST',
                data:{comentario: $("#comentario").val()},
                success:function(result){
                        $("#comentario").val('');
                        $("#mensajes").prepend(result);
                      }
            });
        });


        //Carga Mensajes
        $.ajax({url:"<?php echo base_url();?>noticias/mensajes",
            type:'POST',
            data:{last_id: '0'},
            success:function(result){
                $("#mensajes").html(result);
            }
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
