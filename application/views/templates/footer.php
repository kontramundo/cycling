</div>
            <!-- /.page-content -->

        </div>
        <!-- /#page-wrapper -->
        <!-- end MAIN PAGE CONTENT -->

    </div>
    <!-- /#wrapper -->

    <!-- GLOBAL SCRIPTS -->
    
    <script src="<?php echo base_url('assets_gral/js/plugins/bootstrap/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets_gral/js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
    <script src="<?php echo base_url('assets_gral/js/plugins/popupoverlay/jquery.popupoverlay.js')?>"></script>
    <script src="<?php echo base_url('assets_gral/js/plugins/popupoverlay/defaults.js')?>"></script>
    <!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
            <img class="img-circle img-logout" src="<?php echo base_url('assets_gral/img/usuarios/'.$foto);?>" style="width:150px;height:150px"alt="">
            <h3>
                <i class="fa fa-sign-out text-green"></i> Quieres salir?
            </h3>
            <p>Seleccione "Salir" si est&aacute; listo para<br>finalizar la sesi&oacute;n.</p>
            <ul class="list-inline">
                <li>
                    <a href="<?php echo base_url('index.php/sesion/logout');?>" class="btn btn-green">
                        <strong>Salir</strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green">Cancelar</button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
    <script src="<?php echo base_url('assets_gral/js/plugins/popupoverlay/logout.js')?>"></script>
    <!-- HISRC Retina Images -->
    <script src="<?php echo base_url('assets_gral/js/plugins/hisrc/hisrc.js')?>"></script>

    <!-- THEME SCRIPTS -->
    <script src="<?php echo base_url('assets_gral/js/flex.js')?>"></script>
    <script src="<?php echo base_url('assets_gral/js/demo/dashboard-demo.js')?>"></script>

</body>

</html>


