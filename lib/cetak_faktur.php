<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Faktur Penjualan</title>
<link href="css/cetak_strik.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/logo_kecil.png" />
</head>

<body>
<? 
include("lib/koneksi.php");
include("lib/terbilang.php");

$tampil=mysql_query("select * from t_jual where nota='$no'");
$data=mysql_fetch_array($tampil);
?>


<div class="bingkai">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="38"  align="left"><b>&nbsp;Microsales JVnese</b><br />
        <span class="isi2">&nbsp;JL. Pucung
      Cikampek-Jawa Barat  </span></td>
    </tr>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0"  class="isi2" style="border-top:1px solid">
    <tr>
    <td width="20%"  widtd="16%">&nbsp;No.</td>
    <td widtd="17%">:<? echo $data['nota']  ?>/<? echo $data['tgl']  ?></td>
    </tr>
  <tr>
    <td>&nbsp;Nama</td>
    <td>:<? echo $data['nama_pelanggan']  ?>(<? echo $data['alamat'] ?>)</td>
    </tr>
</table>

<table width="100%" border="0" id="des">
  <tr>
    <th width="40%" height="22">&nbsp;Barang</th>
    <th width="3%" align="right">&nbsp;</th>
    <th width="4%" align="right">&nbsp;</th>
    <th width="16%" align="right">&nbsp;</th>
    <th width="13%" align="right">&nbsp;</th>
    <th width="24%" align="right">Total</th>
  </tr style="border-top:1px solid">
  <?
  $tampildet=mysql_query("select * from det_t_jual where nota='$no'");
  while($dat=mysql_fetch_array($tampildet)){  
  ?>
  <tr>
    <td colspan="4"><? echo $dat['nama_barang']  ?></td>
    <td colspan="2" align="right">-<? echo  number_format($dat['diskon'],0,",",".")  ?></td>
    </tr>
   <tr>
    <td colspan="4"><? echo number_format($dat['harga_jual'],0,",",".")  ?>x<? echo $dat['qty']  ?>=<? echo number_format($dat['subtotal'],0,",",".")  ?></td>
    <td colspan="2" align="right"><b><? echo number_format($dat['total'],0,",",".")  ?>@</b></td>
    </tr>
  <tr>
  <td colspan="6">&nbsp;</td>
  </tr>
   <?
  }
  
  ?>
  <tr>
    <td colspan="5" style="border-top:1px solid"><div style="font-size:14px;font-weight:bold">Terbilang : <? echo  toTerbilang($data['gt']); ?>&nbsp;rupiah</div>  </td>
    <td align="right" style="border-top:1px solid"><b><? echo number_format($data['gt'],0,",",".")  ?></b></td>
  </tr>
</table>
</div>
</body>
</html>