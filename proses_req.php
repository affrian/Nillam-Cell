<?php
	session_start();
	$ns=$_SESSION['ses_bintang_un'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Draft Per Tanggal</title>
<link href="css/printdraft.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/fav.png">
<link href="css/cetak_faktur.css" rel="stylesheet" type="text/css" />

</head>

<body>

<?
$a=substr($tgl,8,2);
$b=substr($tgl,5,2);
$c=substr($tgl,0,4);
$tgll=$a."-".$b."-".$c;
  //echo $tgll;
?>
<div align="center">


<div style="width:800px;height:689px">

<?
  include("lib/koneksi.php");


?>
<table width="85%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" rowspan="2" align="right">&nbsp;</td>
    <td width="49%" height="38" class="judul1">Nilam Cell</td>
    <td width="14%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="25%">Tanggal Cetak</td>
  </tr>
  <tr>
    <td height="38" colspan="2" valign="top" class="hh">Kp. Ciketing Ds. Wanakerta, Teluk Jambe Barat <br />( 0857-8130-4567 )</td>
    <td>&nbsp;</td>
    <td><? echo date("d-m-Y") ?></td>
  </tr>
</table><hr /><br />
<table width="85%" border="0" align="left" class="grid">

 <tr>
  <td width="11%">Tanggal</td>
  <td width="89%"><b>
  <? echo $tgl ?></b></td>
</tr>


</table>
<table width="85%" border="1" class="grid" id="des">
  <tr>
    <td width="4%" height="18" bgcolor="#FBFBFB">No</td>
    <td width="43%" bgcolor="#FBFBFB">Nama Barang</td>
    <td width="11%" align="right" bgcolor="#FBFBFB">Qty</td>
    <td width="11%" align="right" bgcolor="#FBFBFB">Satuan</td>
    <td width="31%" align="right" bgcolor="#FBFBFB">Stok Gudang</td>
    </tr>
  <?
  $tampil=mysql_query("select *,sum(qty) as tj from det_t_jual,t_jual where t_jual.nota=det_t_jual.nota  group by kode_barang,tgl having  tgl='$tgl' ") or die (mysql_error());
 $isi=mysql_num_rows($tampil);
 //echo $isi;
 $no=1;
 while($dt=mysql_fetch_array($tampil)){
	 
//	 $cb=mysql_query("select * from det_t_jual where nota='$nota'");
	 	$kod=$dt['kode_barang'];
		
		$cs=mysql_query("select * from barang where kode_barang='$kod'");
		$dats=mysql_fetch_array($cs);
	if ($dats['stok']<0){

  ?>
  <tr>
    <td bgcolor="#F2F73C"><? echo $no ?></td>
    <td bgcolor="#F2F73C"><? echo $dt['nama_barang'] ?></td>
    <td align="right" bgcolor="#F2F73C"><? echo $dt['tj'] ?></td>
    <td align="right" bgcolor="#F2F73C"><? echo $dats['satuan'] ?></td>
    <td align="right" bgcolor="#F2F73C"> 

	<? echo $dats['stok'] ?>
	
    </td>
    </tr>
 <?  }else{
?>	 
<tr>
    <td><? echo $no ?></td>
    <td><? echo $dt['nama_barang'] ?></td>
    <td align="right"><? echo $dt['tj'] ?></td>
    <td align="right"><? echo $dats['satuan'] ?></td>
    <td align="right"> 

	<? echo $dats['stok'] ?>
	
    </td>
    </tr>
	 
 
 <?
 }
 $no++;
 }
 ?> 
  
</table>


<? //} ?>
<font size="-1">Design By Javanese</font>
<hr />

</div>

</body>
</html>