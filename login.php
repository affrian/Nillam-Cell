<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login Administrator JVnese</title>
<link href="css/login.css" rel="stylesheet" type="text/css">

<link rel="shortcut icon" href="img/fav.png">
<link href="css/form.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
   $("#un2").focus(); 
sts=$("#sts_login").val();
//alert(sts);
if(sts!=""){
$("#conta-login").slideUp(600);
  					$("#conta").slideDown(600);
					$("#us").slideDown(600);
					 	
}

$("#un2").keyup(function(e) {
    if(event.keyCode==13){
	$("#pass").focus();	
	}
});
	
$("#pass").keyup(function(e) {
    if(event.keyCode==13){
	$("#login").click();	
	}
});	
	
$("#login").click(function(e) {

un=$("#un2").val();
pass=$("#pass").val();

if($.trim(un)==""){
alert("Kode Admin Silahkan di Isi");	
$("#un").focus();
exit();
}

if($.trim(pass)==""){
alert("Password Harus di Isi");	
$("#pass").focus();
exit();
}

//alert(un);
$.ajax({
			url:"proses_login.php",
			data:"un2="+un+"&pass="+pass,
			cache:false,
			success: function(g){
				//	alert(g);
				g=g.split("|");
					if(g[0]=="sukses"){
					$("#sts_login_ha").val(g[1]);
					$("#conta-login").slideUp(600);
  					$("#conta").slideDown(600); 
					$("#us").slideDown(600); 
					$("#tam_user").load("proses_login.php","op=tam_user");
					
					}else{
					alert("Maaf, Proses Login Gagal, Silahkan Coba Lagi !!");	
						
					}
				
			}
		}); // tutup  ajax

});	
	
});


</script>
</head>

<body>
<?php
//include("lap_draft.php");
?>
<div id="conta-login">
<br><br>
<h2 align="center" style="font-family:calibri;color:#7974F1">Login Admin</h2>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="center"><input type="text" class="inp" id="un2" placeholder="Input Kode Admin" style="background:#F9F2F2"></td>
  </tr>
  <tr>
    <td align="center"><input type="password" class="inp" id="pass" placeholder="Password" style="background:#F9F2F2"></td>
  </tr>
  <tr>
    <td><input type="hidden" id="sts_login" value="<?php echo $_SESSION['ses_jve_un']; ?>">
    <input type="hidden" id="sts_login_ha" value="<?php echo $_SESSION['ses_jve_ha']; ?>"></td>
  </tr>
  <tr>
    <td align="center"><input type="button" value="Login" class="btn_nav" id="login"></td>
  </tr>
</table>

<center><h5 style="color:#C1B7B7;font-family:calibri">Copyright &copy; 2015-<?php echo date("Y") ?> By JVnese <br>
CS-081393877448
</h5></center>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br>
</div>


</body>
</html>