<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="lib/jquery.js"></script>
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(e) {
    //alert("hh");
$("#cetak").click(function(e) {

if(document.getElementById("radio4").checked==true){
//alert("tanggal");	
tgl=$("#tgl").val();
//alert(tgl);
if(tgl==""){
	exit();
}
window.open("cetak_lap_fak.php?tgl="+tgl+"&op=tgl");
window.open("proses_req.php?tgl="+tgl+"&op=tgl");

}else if(document.getElementById("radio2").checked==true){
//alert("bulan");	
bln=$("#bln").val();
thn=$("#thn2").val();
if(bln=="" &&  thn=="" ){
	exit();
}


window.open("cetak_lap_fak.php?op=bln&thn="+thn+"&bln="+bln);
}else if(document.getElementById("radio").checked==true){
//alert("tahun");	
thn=$("#thn3").val();
if(thn=="" ){
	exit();
}

window.open("cetak_lap_fak.php?op=thn&thn="+thn);


}else if(document.getElementById("radio3").checked==true){
//alert("tanggal");	
tgla=$("#dta").val();
tglz=$("#dtz").val();

//alert(tgl);
if(tgla=="" && tglz==""){
	exit();
}
window.open("cetak_lap_fak.php?op=per&tgla="+tgla+"&tglz="+tglz);

}
else if(document.getElementById("radio5").checked==true){
//alert("tanggal");	
st=$("#lpstok").val();

//alert(tgl);
if(st=="" ){
	exit();
}
window.open("cetak_lap_stok.php?stok="+st);

}
else{
alert("Silahkan Pilih Jenis Laporan !");	
	
	
}

		
    });	// tutup cetak
		


$("#kat_barang_tambah").click(function(){
	//alert("hh");
	$(".inp").val("");
	$("#form_kat_barang").slideDown(600);
	$("#tampil_kat_barang").slideUp(600);
	$("#kat_barang_kode").prop("readonly","");
	
});	
	
$("#kat_barang_lihat").click(function(){
	//alert("hh");
	$("#form_kat_barang").slideUp(600);
	$("#tampil_kat_barang").slideDown(600);
	
	
});	 //===


//======================================================================================	
});   //--------------------TUTUP FUNGSI UTAMA ----------------------------------------
//========================================================================================


</script>
<script>

</script>


<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="cc" id="cc-lap" style="display:none">
<div id="head" ></div>
<div align="center" >
  <table width="100%" border="0" cellspacing="0" cellpadding="0" >
    <tr>
      <td width="93%"><input style="display:none" name="kat_barang_tambah" type="button" class="btn_nav" id="kat_barang_tambah" value="Tambah">
        <input style="display:none" name="kat_barang_lihat" type="button" class="btn_nav" id="kat_barang_lihat" value="Lihat"></td>
      <td width="7%" align="right"><img class="tutup_form"  style="cursor:pointer" src="img/arrow.png" width="50" height="50" alt=""/></td>
    </tr>
  </table>
</div>
<div id="main">
<form>
 <h3><a href="#">Laporan Penjualan</a></h3>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="2%"><input type="radio" name="thn" id="radio" value="tahun" /></td>
        <td width="20%">Penjualan  Tahun</td>
        <td width="25%"><select name="thn3" class="inp" id="thn3">
          <? for($thn=date("Y");$thn>=2013;$thn-- ){  ?>
          <option><? echo $thn ?></option>
          <? } ?>
        </select></td>
        <td width="2%"><input type="radio" name="thn" id="radio5" value="tahun" /></td>
        <td width="14%">Laporan Stok</td>
        <td width="37%"><input name="lpstok" type="number" class="inp" id="lpstok" size="6" value="10"></td>
      </tr>
      <tr>
        <td><input type="radio" name="thn" id="radio2" value="tahun" /></td>
        <td>Penjualan  Bulan</td>
        <td><select name="bln2" class="inp" id="bln">
          <option value="01">Januari</option>
          <option value="02">Februari</option>
          <option value="03">Maret</option>
          <option value="04">April</option>
          <option value="05">Mei</option>
          <option value="06">Juni</option>
          <option value="07">Juli</option>
          <option value="08">Agustus</option>
          <option value="09">September</option>
          <option value="10">Oktober</option>
          <option value="11">November</option>
          <option value="12">Desember</option>
        </select>
          <select name="thn3" class="inp" id="thn2">
            <? for($thn=date("Y");$thn>=2013;$thn-- ){  ?>
            <option><? echo $thn ?></option>
            <? } ?>
          </select></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><input type="radio" name="thn" id="radio3" value="tahun" /></td>
        <td>Penjualan Periode</td>
        <td>
          
          <input type="text" id="dta" size="8" class="inp">
          -
          <input type="text" id="dtz" size="8" class="inp"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><input type="radio" name="thn" id="radio4" value="tahun" /></td>
        <td>Penjualan Tanggal</td>
        <td><input type="text" id="tgl" size="8" class="inp"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="cetak" type="button" class="btn_utm" id="cetak" value="Cetak" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
</form>
<hr>


</div>
</div>
<script type="text/javascript">
$(function() {
	$( "#dta" ).datepicker({
		dateFormat:"yy-mm-dd"
	}); 
});
$(function() {
	$( "#dtz" ).datepicker({
		dateFormat:"yy-mm-dd"
	}); 
});
$(function() {
	$( "#tgl" ).datepicker({
		dateFormat:"yy-mm-dd"
	}); 
});
</script>
</body>
</html>