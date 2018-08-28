<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Penjualan</title>
<link href="css/cetak_faktur.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/fav.png" />
<style>

.hh table{
font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
font-size:12px;
	
}

</style>

</head>

<body>


<div class="bingkai2">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="10%" rowspan="2" align="right">&nbsp;</td>
      <td width="49%" height="38" class="judul1">NILAM CELL</td>
      <td width="14%">&nbsp;</td>
      <td width="14%">&nbsp;</td>
      <td width="13%">Tanggal Cetak</td>
    </tr>
    <tr>
      <td height="21" valign="top" class="hh"></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><? echo date("d-m-Y") ?>  </td>
    </tr>
  </table>
  <hr style="border:1px solid" />
  <?php
  include("lib/koneksi.php");

if($op=="tgl"){
$tampil=mysql_query("select * from t_jual where tgl='$tgl' order by nota desc");
$st="Tanggal : ".$tgl;
}else if($op=="bln"){
$tampil=mysql_query("select * from t_jual where thn='$thn' and  bln='$bln' order by nota desc");
$st="Bulan : ".$bln."Tahun : ".$thn;
}else if($op=="thn"){
$tampil=mysql_query("select * from t_jual where thn='$thn'  order by nota desc");
$st="Tahun : ".$thn;
}else{	
$tampil=mysql_query("select * from t_jual where  tgl>='$tgla' and tgl<='$tglz'  order by nota desc") or die (mysql_error());
$st="Tanggal : ".$tgla." Sampai ".$tglz;
	
}
//echo $tglz;
  ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0"  >
  <tr>
    <td colspan="5" align="center" class="isi_konten"> LAPORAN PENJUALAN<br /><? echo $st ?> </td>
    </tr>
  <tr>
    <td width="15%">&nbsp;</td>
    <td width="30%">&nbsp;</td>
    <td width="11%">&nbsp;</td>
    <td width="14%">&nbsp;</td>
    <td width="30%">&nbsp;</td>
  </tr>
</table>

<table width="100%" border="1" cellspacing="1" cellpadding="0" id="des">
  <tr>
    <th width="4%">No.</th>
    <th width="10%">Nota</th>
    <th width="8%">Tanggal</th>
    <th width="10%">Pelanggan</th>
    <th width="27%">Alamat</th>
    <th width="20%">Laba</th>
    <th width="21%">Grandtotal</th>
    
  </tr>
<? 
$no=1;


while($data=mysql_fetch_array($tampil)){
	
	
$gt=$gt+$data['gt'];
?>
  <tr>
    <td><?  echo $no   ?></td>
    <td><? echo $data['nota']  ?></td>
    <td><? echo $data['tgl']  ?></td>
    <td><? echo $data['nama_pelanggan']  ?></td>
    <td><? echo $data['alamat']  ?></td>
    <td align="right"><? 
	$nn=$data['nota'];
	$ff=mysql_query("select * from det_t_jual where nota='$nn' ") or die (mysql_error());	
	$ll=0;
	while($dat=mysql_fetch_array($ff)){
	$laba=($dat['harga_jual']-$dat['harga_beli'])*$dat['qty'];
	$jl=$jl+$laba;
	$ll=$ll+$laba;
	//echo $laba;
	}
	echo number_format($ll,0,",",".")  ?></td>
    <td align="right"><? echo number_format($data['gt'],0,",",".")  ?></td>
   
  </tr>
  <?
$no++;
}
?>
 <tr>
    <th colspan="5">Total</th>
    <th align="right"><?
	
	echo number_format($jl,0,",",".")  ?></th>
    <th align="right"><? echo number_format($gt,0,",",".")  ?></th>
    
  </tr>
  
</table>


</div>

</body>
</html>