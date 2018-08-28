<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="lib/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(e) {
    //alert("hh");
$("#kat_barang_tampil_grid").load("pro_kat_barang.php","op=tampil_kat_barang");

$("#kat_barang_nama").keyup(function(e) {
nm=$(this).val();
$("#val_katbar").show(600);
$("#val_katbar").load("pro_kat_barang.php","op=cekkatbar&nm="+nm);

if(event.keyCode==13){
$("#kat_barang_simpan").click();	
}
/*
$.ajax({
	url:"pro_kat_barang.php",
	data:"op=cekkatbar&nm="+nm,
	cache:false,
	success: function(g){
	if(g=="ada"){
		
	}
	}
	*/
});


$("#kat_barang_simpan").click(function(){
kat_barang_nama=$("#kat_barang_nama").val();
//kat_barang_kd=$("#kat_barang_kode").val();
kat_barang_kd="";
//alert(kat_barang_kd);  || $.trim(kat_barang_kode)==""
if( $.trim(kat_barang_nama)==""   ){
alert("Data Ada Yang Kosong");
exit();	
}

$.ajax({
	url:"pro_kat_barang.php",
	data:"op=simpan_kat_barang&kat_barang_nama="+kat_barang_nama+"&kat_barang_kode="+kat_barang_kd,
	cache:false,
	success: function(j){
		//alert(j);
		//alert("Data Tersimpan");
		$(".inp").val("");
		$("#barang_kat").load("pro_barang.php","op=isi_kat");	

		$("#kat_barang_tampil_grid").load("pro_kat_barang.php","op=tampil_kat_barang");
		$("#form_kat_barang").slideUp(600);
	$("#tampil_kat_barang").slideDown(600);
	$("#kat_barang_kode").prop("readonly","");
	} 
}); // tutup ajax

});




$("#kat_barang_tambah").click(function(){
	//alert("hh");
	$(".inp").val("");
	$("#form_kat_barang").slideDown(600);
	$("#tampil_kat_barang").slideUp(600);
	$("#kat_barang_nama").focus();
	$("#kat_barang_kode").prop("readonly","");
	
});	
	
$("#kat_barang_lihat").click(function(){
	//alert("hh");
	$("#form_kat_barang").slideUp(600);
	$("#tampil_kat_barang").slideDown(600);
	
	
});	 //===

$("#kat_barang_kode").blur(function(e) {
	katbar=$("#kat_barang_kode").val();
    $.ajax({
		url:"pro_kat_barang.php",
		data:"op=cek_kat&katbar="+katbar,
		cache:false,
		success: function(k){
		$("#kat_barang_nama").val(k);
			
		}
	}); // tutup ajax
});


$("#tutup_katbar").click(function(e) {
    $("#cc-kat_barang").slideUp(600);
});	
	
//======================================================================================	
});   //--------------------TUTUP FUNGSI UTAMA ----------------------------------------
//========================================================================================


</script>
<script>
function pindahpage(v){
//alert(v);
jr=10;	
s=((v*jr)-jr);
$("#kat_barang_tampil_grid").load("pro_kat_barang.php","op=tampil_kat_barang&s="+s+"&pgd="+v);
}


function edit_kat_barang(p){
///alert(p);	
kat_barang_kd=$("#kat_barangkode"+p).val();
//alert(kat_barang_kd);
$("#kat_barang_kode").val(kat_barang_kd).prop("readonly","readonly");
$.ajax({
	url:"pro_kat_barang.php",
	data:"op=ambilkat_barang&kode_kat_barang="+kat_barang_kd,
	cache:false,
	success: function(e){
		//alert(e);
	$("#form_kat_barang").slideDown(600);
	$("#tampil_kat_barang").slideUp(600);
		
		e=e.split("|")
		
		$("#kat_barang_nama").val(e[1])
	}  //  tutup fungsi
});  // tutup ajax
}
</script>

<link href="css/form.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="cc" id="cc-kat_barang" style="display:none">
<div id="head" ></div>
<div align="center" >
  <table width="100%" border="0" cellspacing="0" cellpadding="0" >
    <tr>
      <td width="93%"><input name="kat_barang_tambah" type="button" class="btn_nav" id="kat_barang_tambah" value="Tambah">
        <input name="kat_barang_lihat" type="button" class="btn_nav" id="kat_barang_lihat" value="Lihat"></td>
      <td width="7%" align="right"><img id="tutup_katbar" style="cursor:pointer" src="img/arrow.png" width="50" height="50" alt=""/></td>
    </tr>
  </table>
</div>
<div id="main">
  <div id="form_kat_barang" style="display:none">
 
    <table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr><input type="hidden" class="inp" id="kat_barang_kode" maxlength="3">
    <td width="89%" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
      <!--
      <tr>
        <td>Kode Kategori</td>
        <td> <input type="text" class="inp" id="kat_barang_kode" maxlength="3">&nbsp;</td>
      </tr>
      -->
      <tr>
        <td width="12%">Nama Kategori</td>
        <td width="88%"><input name="kat_barang_nama" type="text" class="inp" id="kat_barang_nama" size="35">
        <div id="val_katbar" class="pop_cari"></div>
        </td>
      </tr>
      <tr>
        <td><input type="hidden" class="inp" id="fff" maxlength="3">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="kat_barang_simpan" type="button" class="btn_utm" id="kat_barang_simpan" value="Simpan"></td>
        </tr>
    </table></td>
  </tr>
  </table>
</div>
<form id="tampil_kat_barang" >
Tampil Data
<div id="kat_barang_tampil_grid"></div>
</form>



</div>
</div>
</body>
</html>