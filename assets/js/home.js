$(document).ready(function(e) {
        $("#entrar").click(function(){
		errores=0;
			$(".required").each(function() {
				if($(this).val()==""){
					errores = errores+1;
					$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
		if(errores>0){
			$("span#errores").text("Llene los campos correctamente").show().fadeOut(3000);
			return false;		
		}
		else{
			var usuario=$("#usuario-login").val();
			var pass=$("#password-login").val();
			$("#entrar").attr('href','index.php/home/verifylogin?usuario='+usuario+'&pass='+pass);
		}
	});
});