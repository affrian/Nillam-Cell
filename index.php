<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Nilam Cell [JV-nese]</title>

<link rel="shortcut icon" href="img/fav.png">
<link href="css/desain.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="shortcut icon" href="img/fav.png">
<script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#tam_user").load("proses_login.php","op=tam_user");
$("#tam_user").click(function(e) {
	//alert("gg");
    $.ajax({
		url:"proses_login.php",
		data:"op=logout",
		cache:false,
		success: function(g){
			$("#conta").hide(10);
			$("#us").hide(10);
			$("#conta-login").slideDown(600); 	
			
			
		}
	});  // tutup ajax
});
				
$("#jual").click(function(e) {
    $("#cc-jual").slideDown(600);  
		$("#nama_pelanggan").focus();

});   
	
$("#produk").click(function(e) {
    $("#cc-bar").slideDown(600);  
});	
	
$("#laporan").click(function(e) {
	ha=$("#sts_login_ha").val();
	//alert(ha);
if(ha=='kasir'){
alert("Maaf.., Anda Tidak Berhak  ...");
 }else if(ha=="admin"){
   $("#cc-lap").slideDown(600);  
	
}

});	


$(".tutup_form").click(function(e) {
    $(".cc").slideUp(600);
});


//===========================
}); // fungsi utama
//===========================

</script>


</head>

<body>
<?php
include("barang.php");
include("jual.php");
include("kat_barang.php");
include("lap.php");
include("login.php");
//include("rt.php");

?>
<div id="us" style="display:none;height:40px;padding:5px;background:url(img/trans_hitam.png)">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="4%"><img id="cadmin" style="cursor:pointer;display:none"  src="img/add.png" width="39" height="40" alt=""/></td><td width="13%" style="color:#FFFFFF;font-size:18px"><!--Tambah Admin  --></td>
    <td width="79%" align="right" style="color:#FFFFFF;font-size:18px"><div id="tam_user" title="Logout"></div></td>
  </tr>
</table>

</div>

<div id="conta" style="display:none">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%" rowspan="2" valign="bottom"><img src="img/jual.png" alt="" width="400" height="404" class="menu" id="jual"/></td>
      <td width="50%" height="208" valign="bottom"><img src="img/barang.png" alt="" width="200" height="200" class="menu" id="produk"/></td>
      <td width="50%" valign="bottom"><img src="img/laporan.png" alt="" width="200" height="200" class="menu" id="laporan"/></td>
    </tr>
    <tr>
      <td colspan="2" valign="top"><img src="img/menuu_kun.png" width="400" height="200" alt=""/></td>
    </tr>
  </table>

</div>
</body>
</html>