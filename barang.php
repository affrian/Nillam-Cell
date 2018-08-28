<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="lib/jquery.js"></script>


<script type="text/javascript">
$(document).ready(function(e) {
    //alert("hh");
	
	
$("#barang_tampil_grid").load("pro_barang.php","op=tampil_barang");
$("#barang_kat").load("pro_barang.php","op=isi_kat");	

$("#barang_kat").load("pro_barang.php","op=isi_kat");	
$("#barang_hb").keyup(function(e) {
    this.value=this.value.replace(/[^0-9.]/g,'')
});

$("#barang_hj").keyup(function(e) {
    this.value=this.value.replace(/[^0-9.]/g,'')
});

$("#barang_stok").keyup(function(e) {
    this.value=this.value.replace(/[^0-9.]/g,'')
});

$("#barang_kat").click(function(){
kd_kat=$(this).val();
});  // tutup barang kat  

/*
$("#barang_simpan").click(function(){
barang_kat=$("#barang_kat").val();
barang_nama=$("#barang_nama").val();
barang_satuan=$("#barang_satuan").val();
barang_hb=$("#barang_hb").val();
barang_hj=$("#barang_hj").val();
barang_stok=$("#barang_stok").val();

barang_kd=$("#barang_kode").val();


//alert(barang_kd);
if($.trim(barang_kat)=="" || $.trim(barang_nama)=="" || $.trim(barang_satuan)=="" || $.trim(barang_hb)=="" || $.trim(barang_hj)=="" || $.trim(barang_stok)=="" ){
alert("Data Ada Yang Kosong");
exit();	
}

$.ajax({
	url:"pro_barang.php",
	data:"op=simpan_barang&barang_kat="+barang_kat+"&barang_nama="+barang_nama+"&barang_satuan="+barang_satuan+"&barang_kode="+barang_kd+"&barang_hb="+barang_hb+"&barang_hj="+barang_hj+"&barang_stok="+barang_stok,
	cache:false,
	success: function(j){
		//alert(j);
		//alert("Data Tersimpan");
		$(".inp").val("");
		$("#barang_tampil_grid").load("pro_barang.php","op=tampil_barang");
			$("#form_barang").slideUp(600);
	$("#tampil_barang").slideDown(600);

	} 
}); // tutup ajax

});
*/



$("#barang_tambah").click(function(){
	//alert("hh");
	$(".inp").val("");
	$("#form_barang").slideDown(600);
	$("#tampil_barang").slideUp(600);
$("#barang_kat").load("pro_barang.php","op=isi_kat");	
$("#barang_tampil_grid").load("pro_barang.php","op=tampil_barang");
$("#barang_kat").show(600);

	
});	
	
$("#barang_lihat").click(function(){
	//alert("hh");
	$("#form_barang").slideUp(600);
	$("#tampil_barang").slideDown(600);
	$("#barang_tampil_grid").load("pro_barang.php","op=tampil_barang");

$("#barang_kat").load("pro_barang.php","op=isi_kat");	
	
});	 //===

$("#kat_kategori_brg").click(function(e) {
    $("#cc-kat_barang").slideDown(600);

});


$("#crbarang").keyup(function(e) {
  	naba=$(this).val();
	$("#barang_tampil_grid").load("pro_barang.php","op=tampil_barang&naba="+naba);
}); 
	
// Validasiii  ---------------===================---------------- 
$("#barang_hb").keyup(function(e) {
    $("#val_hb").show(200);
	val=$(this).val();
	$("#val_hb").load("pro_barang.php","op=val&val="+val);
	
	if(event.keyCode==13){
	$("#barang_hj").focus();	
	}
});


$("#barang_hb").blur(function(e) {
$("#val_hb").hide(200);
});   

$("#barang_hj").keyup(function(e) {
    $("#val_hj").show(200);
	val=$(this).val();
	$("#val_hj").load("pro_barang.php","op=val&val="+val);
	
	if(event.keyCode==13){
	$("#barang_stok").focus();	
	}
});


$("#barang_hj").blur(function(e) {
$("#val_hj").hide(200);
});   

$("#barang_stok").keyup(function(e) {
	if(event.keyCode==13){
	$("#foto").focus();
	}
});

$("#barang_nama").blur(function(e) {
$("#val_nabar").hide(600);
});

$("#barang_nama").keyup(function(e) {
	nm=$(this).val();
$("#val_nabar").show(600);
$("#val_nabar").load("pro_barang.php","op=cekkatbar&nm="+nm);


	
	if(event.keyCode==13){
	$("#barang_satuan").focus();
	}
});


$("#barang_satuan").keyup(function(e) {
	if(event.keyCode==13){
	$("#barang_hb").focus();
	}
});



//  =============================================================
	
//======================================================================================	
});   //--------------------TUTUP FUNGSI UTAMA ----------------------------------------
//========================================================================================


</script>
<script>
function tampilbarang(){
//alert("ll");
$(".inp").val("");
$("#barang_tampil_grid").load("pro_barang.php","op=tampil_barang");
$("#barang_kat").load("pro_barang.php","op=isi_kat");	
}

function buka_kategori_barang(){

}

function pindahpagebar(v){
//alert(v);
jr=10;	
s=((v*jr)-jr);
$("#barang_tampil_grid").load("pro_barang.php","op=tampil_barang&s="+s+"&pgd="+v);
}


function edit_barang(p){
///alert(p);	
barang_kd=$("#barangkode"+p).val();
//alert(barang_kd);
$("#barang_kode").val(barang_kd);
$("#barang_kat").hide(600);

$.ajax({
	url:"pro_barang.php",
	data:"op=ambilbarang&kode_barang="+barang_kd,
	cache:false,
	success: function(e){
		//alert(e);
	$("#form_barang").slideDown(600);
	$("#tampil_barang").slideUp(600);
	
		e=e.split("|")
		$("#barang_kat").val(e[0])
		$("#barang_nama").val(e[2])
		$("#barang_satuan").val(e[3]);
		$("#barang_hb").val(e[4]);
		$("#barang_hj").val(e[5]);
		$("#barang_stok").val(e[6]);
	$("#barang_bar").val(e[8]);
	
	}  //  tutup fungsi
});  // tutup ajax


}

</script>


<link href="css/form.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="cc" id="cc-bar" style="display:none">
<div id="head" ></div>
<div align="center" >
  <table width="100%" border="0" cellspacing="0" cellpadding="0" >
    <tr>
      <td width="93%"><input name="barang_tambah" type="button" class="btn_nav" id="barang_tambah" value="Tambah">
        <input name="barang_lihat" type="button" class="btn_nav" id="barang_lihat" value="Lihat"></td>
      <td width="7%" align="right"><img class="tutup_form" style="cursor:pointer" src="img/arrow.png" width="50" height="50" alt=""/></td>
    </tr>
  </table>
</div>
<div id="main">
 <iframe name="upload-frame" id="upload-frame" style="display:none;"></iframe> 
  <form id="form_barang" style="display:none" name="formupload" method="post" enctype="multipart/form-data" action="pro_barang.php?op=simpan_barang" target="upload-frame" onsubmit="startupload();" >
  <input type="hidden" id="barang_kode" name="barang_kode" class="inp">
    <table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="89%" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
      <tr>
        <td width="12%">Kategori barang</td>
        <td width="4%" valign="top"><select name="barang_kat" class="inp" id="barang_kat">
          
        </select></td>
        <td width="35%" valign="top"><img  id="kat_kategori_brg"  style="cursor:pointer" src="img/add.png" width="25" height="25" alt=""/></td>
        <td width="7%" valign="top">&nbsp;</td>
        <td width="42%" valign="middle">&nbsp;</td>
      </tr>
      
      <tr>
        <td>Nama barang</td>
        <td colspan="4"><input name="barang_nama" type="text" class="inp" id="barang_nama" size="35">
        <div id="val_nabar" class="pop_cari"></div>
        </td>
        </tr>
      <tr>
        <td valign="top">Satuan</td>
        <td colspan="4"><input name="barang_satuan" type="text" class="inp" id="barang_satuan" size="20"></td>
        </tr>
      <tr>
        <td>Harga Beli</td>
        <td colspan="4"><input name="barang_hb" type="text" class="inp" id="barang_hb" size="15">
        <div id="val_hb" class="info_angka" ></div>
        </td>
      </tr>
      <tr>
        <td>Harga Jual</td>
        <td colspan="4"><input name="barang_hj" type="text" class="inp" id="barang_hj" size="15">
        <div id="val_hj" class="info_angka" ></div>
        </td>
      </tr>
      <tr>
        <td>Stok</td>
        <td colspan="4"><input name="barang_stok" type="text" class="inp" id="barang_stok" size="10"></td>
      </tr>
      
      <tr>
        <td>Foto</td>
        <td colspan="4"><input name="foto" type="file" class="inp" id="foto" size="10"></td>
      </tr>
       
      <tr>
        <td>Barcode</td>
        <td colspan="4"><input name="barang_bar" type="text" class="inp" id="barang_bar" size="35">
      
        </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="4"><input name="barang_simpan" type="submit" class="btn_utm" id="barang_simpan" value="Simpan"></td>
        </tr>
    </table></td>
  </tr>
  </table>
</form>
<form id="tampil_barang" >
<table>
<tr>
<td>Cari Barang <input type="text" class="inp" placeholder="Input Nama Barang" size="25" id="crbarang"></td>
<td></td>
</tr>
</table>
<div id="barang_tampil_grid"></div>
</form>



</div>
</div>
</body>
</html>