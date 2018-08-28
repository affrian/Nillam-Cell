<?php
session_start();
$un=$_SESSION['ses_bintang_un'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>STOK BARANG</title>
<link href="css/cetak_faktur.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/fav.png" />
<style>

.hh table{
font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
font-size:12px;
	
}

td{
	
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
      <td height="21" colspan="3" valign="top" class="hh"><br />
        Kp. Ciketing Ds. Wanakerta, Teluk Jambe Barat ( 0857-8130-4567 )</td>
      <td><? echo date("d-m-Y") ?>  </td>
    </tr>
  </table>
  <hr style="border:1px solid" />
  <?php
  include("lib/koneksi.php");
$tampil=mysql_query("select * from barang where stok<='$stok' order by stok desc");
//echo $tglz;
  ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0"  >
  <tr>
    <td colspan="5" align="center" class="isi_konten">STOK BARANG<br /><? echo $st ?> </td>
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
    <th width="5%">No.</th>
    <th width="55%" align="left">Nama Barang</th>
    <th width="10%" align="right">Satuan</th>
    <th width="30%" align="right">Stok</th>
    
  </tr>
<? 
$no=1;


while($data=mysql_fetch_array($tampil)){
?>
  <tr>
    <td><?  echo $no   ?></td>
    <td><? echo $data['nama_barang']  ?></td>
    <td align="right"><? echo $data['satuan']  ?></td>
    <td align="right"><? echo number_format($data['stok'],0,",",".")  ?></td>
   
  </tr>
  <?
$no++;
}
?>
  
</table>


</div>

</body>
</html>