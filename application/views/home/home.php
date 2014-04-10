<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="author" content="kontramundo systems">
  <meta name="description" content="Cycling Community, es el punto de encuentro de ciclistas, haz amigos, comparte rutas, rodadas, tips, etc. Unete y se parte de la comunidad ciclista">

  <title>Cycling</title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('/assets/img/icons/favicon.ico')?>" />

  <meta property="og:title" content="Cycling Community" />
  <meta property="og:description" content="Cycling Community, es el punto de encuentro de ciclistas, conoce nuevos amigos, comparte rutas, rodadas, tips, etc. Unete y se parte de la comunidad ciclista" />
  <meta property="og:image" content="http://cycling.kontramundo.com/assets/img/icons/logo_fb.png" />
  <meta property="og:type" content="website" /> 
  <!-- style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/styles-v=0.9.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
  
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->

  <!--[if IE 8]>
    <link rel="stylesheet" href="css/ie8.css">
  <![endif]-->

  <!--[if IE 7]>
    <style>body{color: #fff; text-align:center;}
      .home{background: #000 url("img/backgrounds/home-bg-ie.jpg") 50% 0 no-repeat !important;}
      .subMenu, .ipad, .interactions, .topTen, .people, .seenIn, .footer, .getIpad{display: none !important;}
      .homeArticle{width: 100%; height: 100% !important; display:block; float:none !important;}
      .centered{position: relative !important; margin: -291px auto 0px auto; display: block; width: 600px;}
      .btn-lg {width: 197px; height: 20px; padding: 25px 10px 25px 78px; font-size: 18px;}
      .col-sm-offset-1{margin-left: 0% !important;}
    </style>
  <![endif]-->


  <!-- video.js must be in the <head> for older IEs to work. -->
  <script src="<?php echo base_url('assets/js/video.js')?>"></script>
<body>
  <div data-type="background" data-speed="10000" class="pages home"><!-- open home -->
    <div class="container"><!-- open container -->
      <div class="row"><!-- open row -->
        <article class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 homeArticle">
          <div class="centered"><!-- open centered -->
            <header>
              <span title="Flow" class="logo"></span>
              <h1>Si andas en bici eres <br/>mi amigo</h1>
            </header>
            <a href="#frm_registro" class="btn btn-lg">Reg&iacute;strate</a>
            <h5 style="margin-top:-5%;"><a href="" data-toggle="modal" data-target="#myModal">Login</a></h5>

            <div style="socialMediaBox"><!-- open social media box -->
              <div class="socialMedia"><!-- open social media -->
                <ul class="list-inline">
                  <li><a href="https://www.facebook.com/kontramundo" class="sm-facebook sm-icon"></a></li>
                  <li><a href="https://twitter.com/kontramundo" class="sm-twitter sm-icon"></a></li>
                  <li><a href="https://google.com/+SalvadorSánchezkontramundo" class="sm-google sm-icon"></a></li>
                  <li><a href="http://instagram.com/kontramundo" class="sm-instagram sm-icon"></a></li>
                </ul>
              </div><!-- close social media -->
            </div><!-- close social media box -->
          </div><!-- close centered -->
        </article>
      </div><!-- close row -->
    </div><!-- close container -->
  </div><!-- close home -->



<!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel"><img src="<?php echo base_url('assets/img/icons/logo_negro.png')?>"/></h4>
            <h4 class="modal-title" id="myModalLabel">Login</h4>
          </div>
          <div id="res_login"></div>
          <form id="frm_login" method="post">
            <div class="modal-body">
              <div class="form-group">
               <label for="usuario" class="control-label">Usuario</label>
               <div class="">
                <input type="text" class="form-control" name="usuario-login" id="usuario-login" placeholder="Ingrese Usuario" required >
               </div>
                  <label for="password" class="control-label">Contrase&ntilde;a</label>
                <div class="">
                 <input type="password" class="form-control" name="password-login" id="password-login" placeholder="Ingrese Contrase&ntilde;a" required >
                </div>
                <br/>
                <div class=""> <span id="errores"></span></div>
        		</div>
            </div>         
            <div class="modal-footer">
             <input type="submit" value="Entrar" class="btn">
            </div>         
          </form>
        </div>
      </div>
    </div>
  <!-- Close Modal -->




  <div data-type="background" data-speed="10" class="pages ipad"><!-- open ipad video -->
    <div class="container"><!-- open container -->
        <article class="ipadArticle">
          <h2>Se parte de Cycling...</h2>

          <div class="ipadFrame"><!-- open video frame -->
            <div class="ipadVideo">
              <video id="iPadMainVideo" class="video-js vjs-default-skin vjs-big-play-centered" poster="img/backgrounds/video_bg.png" controls preload="none" width="574" height="431"  data-setup="{}">
                <source src="<?php echo base_url('assets/video/video.mp4')?>" type='video/mp4' />
                <track kind="captions" src="" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
                <track kind="subtitles" src="" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
              </video>
            </div>
          </div><!-- close video frame -->



          <!--<h3>Experience Instagram like never before</h3>-->
        </article>
    </div><!-- close container -->
  </div><!-- close ipad video -->

  <div data-type="background" data-speed="10" class="pages seenIn"><!-- open seen in -->
    <div class="container"><!-- open container -->
      <div class="row"><!-- open row -->
        <article class="col-xs-12 seenArticle">
          <ul class="l-centered list-inline logoList">
            <li><a href="http://ca.com" class="techcrunch"><img src="<?php echo base_url('assets/img/elements/byciclefilm.png')?>" alt="techcrunch logo" title="Techcrunch" /></a></li>
            <li><a href="http://techcrunch.com" class="techcrunch"><img src="<?php echo base_url('assets/img/elements/techcrunch-logo.png')?>" alt="techcrunch logo" title="Techcrunch" /></a></li>
            <li><a href="http://engadget.com" class="engadget"><img src="<?php echo base_url('assets/img/elements/engadget-logo.png')?>" alt="engadget logo" title="Engadget" /></a></li>
            <li><a href="http://thenextweb.com" class="tnw"><img src="<?php echo base_url('assets/img/elements/tnw-logo.png')?>" alt="tnw logo" title="TNW" /></a></li>
          </ul>
        </article>
      </div><!-- close row -->
    </div><!-- close container -->
  </div><!-- close seen in -->

  <div data-type="background" data-speed="10" class="pages people"><!-- open people -->
    <div class="container"><!-- open container -->
      <h2>Unete a Cycling Community</h2>

      <div class="row"><!-- open row -->
        <form name="frm_registro" id="frm_registro" method="post" action="<?php echo base_url('home/registro')?>">
          <div class="form-group">
            <div class="row">
              <div class="col-md-6"><input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required></div>
              <div class="col-md-6"><input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" required></div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6"><input type="email" class="form-control" name="email" id="email" placeholder="Email" required></div>
              <div class="col-md-6"><input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required></div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6"><input type="password" class="form-control" name="password" id="password" placeholder="Password" required></div>
              <div class="col-md-6"><input type="password" class="form-control" name="password2" id="password2" placeholder="Confirma T&uacute; Password" required></div>
            </div>
          </div>
          <div class="form-group">
              <div class="row">
              <div class="col-md-2"><input type="text" class="form-control" name="dia" id="dia" placeholder="DD" required></div>
              <div class="col-md-2"><input type="text" class="form-control" name="mes" id="mes" placeholder="MM" required></div>
              <div class="col-md-2"><input type="text" class="form-control" name="anio" id="anio" placeholder="AAAA" required></div>
              <div class="col-md-6">
                <select class="form-control" name="pais" id="pais" required>
                    <option value="" selected>Selecciona tu pa&iacute;s</option>
                    <option value="1">M&eacute;xico</option>
                  </select>
              </div>
            </div>
          </div>
          
          <div class="row" align="center">
            <div class="col-md-12"><input type="submit" value="Reg&iacute;strate" class="btn btn-lg"></div>
          </div>

        </form>
        <div class="clearfix"></div>
      </div><!-- close row -->
    </div><!-- close container -->
  </div><!-- close people -->
  
  

  <div data-type="background" data-speed="100000" class="pages footer"><!-- open footer -->
    <div class="container"><!-- open container -->
      <footer>
        <div class="socialMediaFooter l-pull-left"><!-- open social media -->
          <ul class="list-inline">
            <li><a href="#" 
                  onclick="
                  window.open(
                    'http://www.facebook.com/sharer.php?s=100&p[url]=http://cycling.kontramundo.com&p[title]=Cycling Community&p[summary]=Cycling Community, es el punto de encuentro de ciclistas. Conoce nuevos amigos, comparte rutas, rodadas, tips, etc. Unete y se parte de la comunidad ciclista&&p[images][0]=http://cycling.kontramundo.com/assets/img/icons/logo_fb.png', 
                    'facebook-share-dialog', 
                    'width=626,height=436'); 
                  return false;">
                <img src="http://www.imagui.com/compartir.png"/></a>
              </li>
          </ul>
        </div><!-- close social media -->

        <ul class="list-inline l-pull-right footerLinks">
          <li>Developed By <a href="https://kontramundo.com" class="press" target="_blank">Kontramundo Systems</a> Copyright © 2014 - All rights reserved</li>
        </ul>

        <div class="clearfix"></div>
      </footer>
    </div><!-- close container -->
  </div><!-- close footer -->

  <!-- require - app js -->
  <script data-main="js/main" src="<?php echo base_url('assets/js/require.js')?>"></script>
  <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
  <script src="<?php echo base_url('assets/js/home.js')?>"></script>

  <!-- SCRIPTS -->
  <script type="text/javascript">
     $(document).ready(function(){

        //Login
        $("#frm_login").submit(function(evento){
          evento.preventDefault();

          $.ajax({url:"<?php echo base_url();?>sesion/login",
            type:'POST',
            data:{usuario: $("#usuario-login").val(), password: $("#password-login").val()},
            success:function(result){
                    $("#res_login").html(result);
                  }
          });
        });

     });
  </script>
</body>
</html>