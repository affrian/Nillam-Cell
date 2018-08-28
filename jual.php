<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
$("#selesai").click(function(e) {
    $("#cc-bayar").slideDown(600);
	$("#cc-jual").slideUp(600);
		gt=$("#gt").val();

		$("#ttot2").load("proses_sales.php","op=val&angka="+gt);
ub=$("#ub").focus();
	
});	

$("#back").click(function(e) {
    $("#cc-bayar").slideUp(600);
		$("#cc-jual").slideDown(600);

});	

$("#selesai2").click(function(e) {
nota=$("#trans_nota").val();
ub=$("#ub").val();
uk=$("#uk").val();

if($.trim(ub)==""){
alert("Uang Bayar Belum Di Input !!");
	$("#ub").focus();
	exit();
}

if(Number(uk)<0){
alert("Uang Bayar Kurang !!!");	
$("#ub").focus();
exit();
}

$.ajax({
	url:"proses_sales.php",
	data:"op=updateub&nota="+nota+"&ub="+ub+"&uk="+uk,
	cache:false,
	success: function(h){
	window.open("cetak_faktur.php?no="+nota,"","fullScreen");
	$(".inp-kecil").val("");
	$(".inp").val("");
	$("#ttot").html("");	
	$("#tam_barang").load("proses_sales.php","op=tampil_bar");	



    $("#cc-bayar").slideUp(600);
	$("#cc-jual").slideDown(600);
	$("#nama_pelanggan").focus();
	
	}
}); //tutu[p ajax
});	

$("#ub").keyup(function(e) {
	ub=$(this).val();
	$("#vub").show(600);
   	$("#vub").load("proses_sales.php","op=val&angka="+ub);
	gt=$("#gt").val();
	uk=Number(ub)-Number(gt);
	$("#uk").val(uk);
	$("#tuk").load("proses_sales.php","op=val&angka="+uk);

if(event.keyCode==13){
$("#selesai2").click();	
}


});
	
$("#tam_barang").load("proses_sales.php","op=tampil_bar");
	
$("#simpan").click(function(e) {
   nama_pelanggan=$("#nama_pelanggan").val();
	alamat=$("#alamat").val(); 
	gt=$("#gt").val();
	nota=$("#trans_nota").val();
//		tb=$("#tb").val();

	if( $.trim(nama_pelanggan)==""    ){
	alert("Nama Pelanggan Kosong !!");
	$("#nama_pelanggan").focus();	
	exit();
	}
	
	kb=$("#kode").val();
	nb=$("#nabar").val();
	hj=$("#hj").val();
	qty=$("#qty").val();
	subtotal=$("#subtotal").val();
	
	if( $.trim(kb)==""    ){
	alert("Kode Barang Kosong !!");
	$("#kode").focus();	
	exit();
	}
	
	if( $.trim(nb)==""    ){
	alert("Nama Barang Kosong !!");
	$("#nabar").focus();	
	exit();
	}
	
	if( $.trim(qty)==""    ){
	alert("Quantity Kosong !!");
	$("#qty").focus();	
	exit();
	}
	
$.ajax({
	url:"proses_sales.php",
	data:"op=sim_trans&kb="+kb+"&qty="+qty+"&subtotal="+subtotal+"&nb="+nb+"&hj="+hj+"&nota="+nota+"&nama_pelanggan="+nama_pelanggan+"&alamat="+alamat+"&gt="+gt,
	cache:false,
	success: function(w){
	//alert(w);
	w=w.split("|");
	$("#trans_nota").val(w[1]);
	tampil();
	
	$("#kode").val("");
	$("#nabar").val("");
	$("#hj").val("");
	$("#stok").val("");

	$("#qty").val("");
	$("#subtotal").val("");
	
	tutupvalharg();
	}
	});
					
	
	
});  // tutup simpan

function tampil(){
nota=$("#trans_nota").val();
	$("#tam_barang").load("proses_sales.php","op=tampil_bar&nota="+nota);	
	
//hitung gt
$.ajax({
	url:"proses_sales.php",
	data:"op=hitunggt&nota="+nota,
	cache:false,
	success: function(g){
	$("#gt").val(g);
	$("#ttot").load("proses_sales.php","op=val&angka="+g);
	
	}
});  // tutup ajax

	
}


 
 $("#simpan2").click(function(){
	//alert("ff");	
	//tgl=$("#tgl").val();
	//s=tgl.split("-");a=s[0];b=s[1];c=s[2];
	//tgl=c+"-"+b+"-"+a;
	
	kode_pelanggan=$("#kode_pelanggan").val();
	nama_pelanggan=$("#nama_pelanggan").val();
	alamat=$("#alamat").val();
		gt=$("#gt").val();
//		tb=$("#tb").val();
		sts=$("#sts").val();
		nota=$("#trans_nota").val();	
		nopo=$("#no_po").val();	

	
	if( $.trim(nama_pelanggan)==""  || $.trim(alamat)==""  ){
	alert("Data Ada yg Kosong");	
	exit();
	}
	 
	//alert("h");
	$.ajax({
		url:"proses_sales.php",
		data:"op=s_trans&nama_pelanggan="+nama_pelanggan+"&alamat="+alamat+"&gt="+gt+"&sts="+sts+"&kode_pelanggan="+kode_pelanggan+"&nota="+nota+"&nopo="+nopo,
		cache:false,
		success: function(e){
			//alert(e);
					for(i=1;i<=10;i++){
					kb=$("#kode"+i).val();
					nb=$("#nabar"+i).val();
					hj=$("#hj"+i).val();
					qty=$("#qty"+i).val();
					subtotal=$("#subtotal"+i).val();
					diskon=$("#diskon"+i).val();
					total=$("#total"+i).val();
					
					
				$.ajax({
				url:"proses_sales.php",
				data:"op=s_d_trans&nota="+e+"&kb="+kb+"&qty="+qty+"&subtotal="+subtotal+"&diskon="+diskon+"&total="+total
				+"&nb="+nb+"&hj="+hj+"&urutan="+i+"&nt="+nota,
				cache:false,
				success: function(w){
							//alert(w);
								}
							});
						 //tutup if
					} // tutup for
				//	$("#dis_barang").slideUp("slow");
					window.open("cetak_faktur.php?no="+e,"","fullScreen");
					$(".inp-kecil").val("");
					$(".inp").val("");
					$("#ttot").html("");
					alert("Data Sudah Tersimpan");
					

		} // tutup fungsi
	}); // tutup ajax jual

	});

/* 
 $("#nama_pelanggan").click(function(e) {
    $("#cari_pel").toggle(400);
	$("#cari_pel").load("proses_sales.php","op=ambilpelanggan");
	
});  
   
$("#nama_pelanggan").keyup(function(e) {
    nape=$(this).val();
	$("#cari_pel").load("proses_sales.php","op=ambilpelanggan&nape="+nape);
	
});     
*/

$("#jual_lihat").click(function(e) {
    $("#input").slideUp(600);
	$("#tampil_fak").slideDown(600);
	$("#tampil_transaksi").load("proses_sales.php","op=tampil_faktur");
});   
   
 $("#jual_tambah").click(function(e) {
	$(".inp").val("");
	$(".inp-kecil").val("");

    $("#input").slideDown(600);
	$("#tampil_fak").slideUp(600);
	$("#tampil_transaksi").load("proses_sales.php","op=tampil_faktur");
	$("#nama_pelanggan").focus();
}); 
  
$("#nama_pelanggan").keyup(function(e) {
	if(event.keyCode==13){
$("#alamat").focus();    
	}
});
 
$("#alamat").keyup(function(e) {
		if(event.keyCode==13){
$("#nabar").focus();    
		}
});
 
 
 
$(".tutup_form").click(function(e) {
$(".cc").slideUp(600);
$(".ee").slideDown(600);
});   
   
 $("#nabar").keyup(function(e) {
$("#cari_barang").show();
nabar=$("#nabar").val();
$("#cari_barang").load("proses_sales.php","op=caribarang&nabar="+nabar);
 
 if(event.keyCode==27){
//alert("gg");
if($.trim($("#kode").val())==""){
	$("#cari_barang").slideUp(600);
$("#selesai").click();	 
}}
 
 if(event.keyCode==13){

if($.trim(nabar)==""){
$("#selesai").click();	 
	
}


$.ajax({
	url:"proses_sales.php",
	data:"op=ambilbarangnama&nm="+nabar,
	cache:false,
	success: function(e){
	//alert(e);	
	e=e.split("|");
	$("#nabar").val(e[0]);
	
	$("#hj").val(e[2]);
	$("#stok").val(e[3]);
	$("#qty").focus();
$("#kode").val(e[4]);

	}
}); // tutup ajax



$("#cari_barang").hide(600);

 }
 
});   
  
   
  
 $("#kode").keyup(function(e) {
//$("#cari_barang").show();
//nabar=$("#nabar").val();
//$("#cari_barang").load("proses_sales.php","op=caribarang&nabar="+nabar);
if(event.keyCode==27){
//alert("gg");
if($.trim($("#kode").val())==""){
$("#selesai").click();	 
}

}

 
if(event.keyCode==13){

kode=$("#kode").val();
//alert(kode);
$.ajax({
	url:"proses_sales.php",
	data:"op=ambilbarangkode&kode="+kode,
	cache:false,
	success: function(e){
		
	e=e.split("|");
	if(e[0]==""){
	exit();	
	}
	$("#nabar").val(e[0]);
	$("#hj").val(e[2]);
	$("#stok").val(e[3]);
	$("#qty").val('1');
$("#kode").val(e[4]);
	settotal();
	qty=$("#qty").val();
	if(qty!=0){
	$("#simpan").click();	
	tutupvalharga();
$("#kode").focus();
	}


	}
}); // tutup ajax
 }
 });     
   
//tutup fungsi utama =================\\\\\\\    
}); //=======================================----
//=====================================//////


</script>
<script>
function editbar(b){
nota=$("#trans_nota").val();
kobar=$("#bb"+b).val();
$.ajax({
	url:"proses_sales.php",
	data:"op=ambildettrans&nota="+nota+"&kobar="+kobar,
	cache:false,
	success: function(p){
		p=p.split("|");
	$("#kode").val(p[0]);
	$("#nabar").val(p[1]);
	$("#hj").val(p[2]);
	//$("#stok").val("");
cek_stok();
	$("#qty").val(p[3]);
	$("#subtotal").val(p[4]);	
		
	}
}); // tutup ajax
}

function ctk_fak(v){
en=$("#nnota"+v).val();
window.open("cetak_faktur.php?no="+en,"","fullScreen")
}

function pindahpagetrans(v){
//alert(v);
jr=10;	
s=((v*jr)-jr);
$("#tampil_transaksi").load("proses_sales.php","op=tampil_faktur&s="+s+"&pgd="+v);
}




//Fungsi Edit
//==========================================================================================================================


//Fungsi Tambah
//==========================================================================================================================
function cek_stok(){
kde=$("#kode").val();
not=$("#trans_nota").val();
//alert(kde+"|"+not);
$.ajax({
	url:"proses_sales.php",
	data:"op=cekstok&kd="+kde+"&nota="+not,
	cache:false,
	success: function(m){
		//alert(m);
	$("#stok").val(m);
	} // tutup f
}); // tutup ajax
}  // tutup fungsi

function setdiskon(){
subtotal=$("#subtotal").val();
diskon=$("#diskon").val();
qqty=diskon.replace(/[^0-9.]/g,'');
$("#diskon").val(qqty);
subtotal=Number(subtotal);
diskon=Number(diskon);

	
//	alert("d");
	total=Number(subtotal)-Number(diskon);
	$("#total").val(total);
	settotal();

	fvalharga();
}
//===================================





function ambilbarang(b){
kobar=$("#kobar"+b).val();	
$("#kode").val(kobar);

$.ajax({
	url:"proses_sales.php",
	data:"op=ambilbarang&kobar="+kobar,
	cache:false,
	success: function(e){
	//alert(e);	
	e=e.split("|");
	$("#nabar").val(e[0]);
	
	$("#hj").val(e[2]);
	$("#stok").val(e[3]);
	$("#qty").focus();
	}
}); // tutup ajax



$("#cari_barang").hide(600);
}  // tutup fungsi ambil

function caribarangk(b){
//alert(b);
//$("#cari_barang"+b).toggle(600);
nabar=$("#nabar").val();
$("#cari_barang").load("proses_sales.php","op=caribarang&nabar="+nabar);

}



function caribarang(){
//alert(b);

$("#cari_barang").toggle(600);
nabar=$("#nabar").val();
//alert(nabar);
$("#cari_barang").load("proses_sales.php","op=caribarang&nabar="+nabar);

}



function settotal(){
cek_stok();
	
qty=$("#qty").val();
if(qty==""  ){
alert("Silahkan input Quantity !!!");
$("#qty").focus();
exit();
}
qqty=qty.replace(/[^0-9.]/g,'');
$("#qty").val(qqty);
hs=$("#hj").val();
stok=$("#stok").val();
diskon=$("#diskon").val();
subtotal=$("#subtotal").val();
	//alert(qty+stok);
qty=Number(qty);hs=Number(hs);
	if(qty>stok){
	alert("Stok Barang Tidak Mencukupi !!");
	$("#qty").focus();
	$("#qty").val(stok);
	stotal=stok*hs;
	$("#subtotal").val(stotal);
		}
	//alert(qty);
	qty=$("#qty").val();
	stotal=qty*hs;
	$("#subtotal").val(stotal);
		
fvalharga();
if(event.keyCode==13){
$("#simpan").click();	
$("#nabar").focus();
}
}
//===================================
//==========================================================================================================================
// validasi
function fvalharga(){
	$("#valharga").show(100);
	$("#valsubtotal").show(100);
	
	angka=$("#hj").val();
	subtotal=$("#subtotal").val();
	//alert(angka);
	$("#valharga").load("proses_sales.php","op=val&angka="+angka);
	$("#valsubtotal").load("proses_sales.php","op=val&angka="+subtotal);
	
	
}
function tutupvalharga(t){
	$("#valharga").hide(100);
	$("#valsubtotal").hide(100);
}

function edittrans(f){
//	alert(f);
nota=$("#nnota"+f).val();
$("#trans_nota").val(nota);
//alert(nota);
	$("#tam_barang").load("proses_sales.php","op=tampil_bar&nota="+nota);	

//tampil();
//alert("ff");
$.ajax({
	url:"proses_sales.php",
	data:"op=ambiltrans&nota="+nota,
	cache:false,
	success: function(g){
		g=g.split("|");
	$("#nama_pelanggan").val(g[0]);
	$("#alamat").val(g[1]);
	$("#gt").val(g[2]);
	    $("#input").slideDown(600);
	$("#tampil_fak").slideUp(600);
	$("#ttot").load("proses_sales.php","op=val&angka="+g[2]);


	}
	
});  //tutup ajax
	
}
</script>


<link href="css/form.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="cc-bayar" class="cc" style="display:none">
<br><br><br>
<br><br><br>
<div style="background:rgba(240,7,11,1.00);margin:0 auto;color:#FFFFFF;padding:35px 0">
<table width="180" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">Grand Total</td>
  </tr>
  <tr>
    <td align="center"><span  id="ttot2" style="font-size:30px"></span></td>
  </tr>
  <tr>
    <td align="center">Uang Bayar</td>
  </tr>
  <tr>
    <td align="center"><input type="text" class="inp" id="ub"  style="background:#FFFFFF"><div id="vub" class="info_angka"></div> </td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  
  </tr>
  <tr>
    <td align="center">Uang Kembali </td>
  </tr>
<tr>
    <td align="center"><span id="tuk" style="font-size:30px"></span><input type="hidden" class="inp" id="uk" ></td>
  </tr>
<tr>
  <td align="center">&nbsp;</td>
</tr>
<tr>
    <td align="center"><input name="button" type="button" class="btn_utm" id="selesai2" value="Selesai">
      <input name="button2" type="button" class="btn_nav" id="back" value="Kembali"></td>
  </tr>
<tr>
<td>&nbsp;</td>
</tr>


</table>

</div>
</div>


<div class="cc" id="cc-jual" style="display:none">
<div id="head" ></div>
<div align="center" >
  <table width="100%" border="0" cellspacing="0" cellpadding="0" >
    <tr>
      <td width="41%"><input name="jual_tambah" type="button" class="btn_nav" id="jual_tambah" value="Tambah">
        <input name="jual_lihat" type="button" class="btn_nav" id="jual_lihat" value="Lihat"></td>
        <td width="20%" align="right" style="font-size:24px;color:#FFFFFF"></td>
      <td width="34%" align="right"><span style="font-size:44px;color:#FFFFFF">Rp <span  id="ttot" style="font-size:42px"></span></span></td>
      <td width="5%" align="right"><img class="tutup_form" style="cursor:pointer" src="img/arrow.png" width="50" height="50" alt=""/></td>
    </tr>
  </table>
</div>
<div id="main">
<div id="input">
  <form >
  <input type="hidden" id="trans_nota" class="inp">
<table width="100%" border="0">
  <tr>
    <td width="14%">Tanggal</td>
    <td width="1%">:</td>
    <td width="85%"><? echo date("d-m-Y")?></td>
  </tr>
  <tr>
    <td>Nama Pelanggan</td>
    <td>:</td>
    <td><label for="nama_pelanggan"></label>
      <input name="nama_pelanggan" type="text" class="inp" id="nama_pelanggan"><div id="cari_pel" class="pop_cari"></div>
      <input style="display:none" name="kode_pelanggan" type="text" class="inp" id="kode_pelanggan" size="6" readonly></td>
  </tr>
  <tr>
    <td valign="top">Alamat/Tlp</td>
    <td valign="top">:</td>
    <td><span id="sprytextarea1">
      <label for="alamat"></label>
      <textarea name="alamat" cols="50" rows="5" class="inp" id="alamat"><? echo $dta['alamat']  ?></textarea>
    </span></td>
  </tr>
  <?php /*
  <tr>
    <td><!-- <input name="iptbrg" type="button" class="tombol" id="iptbrg" value="Input Barang" /> -->Status Pembayaran</td>
    <td>:</td>
    <td><label for="sts"></label>
      <select name="sts" class="inp" id="sts">
        <option value="cash">cash</option>
        <option value="tempo">tempo</option>
      </select>  &nbsp;&nbsp;&nbsp;No. PO :&nbsp;<input type="text" id="no_po" class="inp"> </td>
  </tr>
  */ ?>
</table>
<br>
<div style="border:2px solid #E9810C;width:1050px;padding:20px  10px;box-shadow:0 0 25px #6D4BF7" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="28" colspan="2" bgcolor="#ffffff">Barang</td>
    <td width="11%" bgcolor="#ffffff">Harga Jual</td>
    <td width="5%" bgcolor="#ffffff">Stok</td>
    <td width="5%" bgcolor="#ffffff">Qty</td>
    <td width="16%" bgcolor="#ffffff">Total</td>
    <td width="33%">&nbsp;</td>
  </tr>
  <tr>
    <td width="7%"><input type="text" class="inp" id="kode" size="8" /></td>
    <td width="23%"><input  onClick="caribarang()"  name="nabar<?php echo $i ?>" type="text" class="inp" id="nabar" size="32">
    	<div id="cari_barang" class="pop_cari"></div></td>
    <td><input type="text" class="inp" id="hj" style="text-align:right;padding-right:10px" onblur="tutupvalharga(<?php echo $i ?>)" onkeyup="settotal(<?php echo $i ?>)" size="13" />
    	<div id="valharga" class="info_angka"></div>
    </td>
    <td><input style="text-align:right;padding-right:10px" type="text" class="inp" id="stok" size="4" /></td>
    <td><input name="qty<?php echo $i ?>" type="text" style="text-align:right;padding-right:10px" class="inp" id="qty" onblur="tutupvalharga(<?php echo $i ?>)" onkeyup="settotal(<?php echo $i ?>)" size="4" /></td>
    <td><input style="text-align:right;padding-right:10px" name="subtotal<?php echo $i ?>" type="text" class="inp" id="subtotal" size="20" readonly /><div id="valsubtotal" class="info_angka"></div></td>
    <td width="33%">&nbsp;<input name="simpan2" type="button" class="btn_utm" id="simpan" value="Simpan" /></td>
    </tr>
  <tr>
    <td colspan="6"><div id="tam_barang" class=""></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3" align="right">Grand Total</td>
    <td align="right"><input style="text-align:right;padding-right:10px" type="text" class="inp" id="gt" size="20" /></td>
    <td>&nbsp;</td>
  </tr>
</table>


</form>

<div id="dis_barang" >
<table width="100%" border="0" >
 
    <tr>
    <td colspan="4" align="right" bgcolor="#fffffff">&nbsp;</td>
    <td width="27%" align="right" bgcolor="#fffffff">&nbsp;</td>
    <td width="33%" align="left" bgcolor="#fffffff">&nbsp;</td>
  </tr>
<tr>
<td width="8%"><input name="simpan" type="button" class="btn_utm" id="selesai" value="Selesai" />
</td>
<td colspan="7" align="right"></td>
</tr>
</table>
</div>

</div>

</div>
<div id="tampil_fak" style="display:none"> 
Tampil
<div id="tampil_transaksi" ></div>


</div>

<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
</script>


</div>
</div>
</body>
</html>