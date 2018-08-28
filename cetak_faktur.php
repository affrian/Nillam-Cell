<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Faktur Penjualan</title>
<link href="css/cetak_strik.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/fav.png" />
<script language="javascript">
//print(document);


</script>
<script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
    var a=setInterval(function(){
//alert("gg");
window.close();
},3000)


});

</script>
</head>

<body>
<? 
include("lib/koneksi.php");
include("lib/terbilang.php");

$tampil=mysql_query("select * from t_jual where nota='$no'");
$data=mysql_fetch_array($tampil);
$bold1 = Chr(27) . Chr(69); $bold0 = Chr(27) . Chr(70);

$d="         \"Nilam Cell\"  \n";
$d.=" KP. CIKETING DS. WANAKERTA\n";
$d.="      Hp. 0857-8130-4567 \n";

$d.="==============================\n";
$d.="Nota=".$data['nota']."/".$data['tgl']."\n";
$d.="Nama=".$data['nama_pelanggan']."/".$data['alamat']."\n";
$d.="==============================\n";

?>


    <div class="bingkai">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="38"  align="left"><b>&nbsp;Nilam Cell</b><br />
            <span class="isi2">&nbsp;Kp. Ciketing Ds. Wanakerta, Teluk Jambe Barat (0857-8130-4567)  </span></td>
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
    <?php

    ?>
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
          $d.=$dat['nama_barang']."\n";

          $d.=number_format($dat['harga_jual'],0,",",".")." X ".$dat['qty']." = ".number_format($dat['subtotal'],0,",",".")."\n\n";
      ?>
        <tr>
          <td colspan="4"><? echo $dat['nama_barang']  ?></td>
          <td colspan="2" align="right">&nbsp;</td>
        </tr>

        <tr>
          <td colspan="4"><? echo number_format($dat['harga_jual'],0,",",".")  ?>x<? echo $dat['qty']  ?></td>
          <td colspan="2" align="right"><b><? echo number_format($dat['subtotal'],0,",",".")  ?></b></td>
        </tr>

        <tr>
          <td colspan="6">&nbsp;</td>
        </tr>
       
       <?
      }
       
        $d.="==============================\n";
        $d.="Grand Total=".number_format($data['gt'],0,",",".")."\n";
        $d.="Bayar      =".number_format($data['ub'],0,",",".")."\n";
        $d.="Kembali    =".number_format($data['uk'],0,",",".")."\n";


        //$d.=toTerbilang($data['gt'])." Rupiah\n\n";
        $d.="======== Terima Kasih ========\n\n";
        $d.="======Atas Pembelian Anda=====\n\n";
      
      ?>
        <tr>
          <td colspan="5" style="border-top:1px solid"><div style="font-size:14px;font-weight:bold">Terbilang : <? echo  toTerbilang($data['gt']); ?>&nbsp;rupiah</div>  </td>
          <td align="right" style="border-top:1px solid"><b><? echo number_format($data['gt'],0,",",".")  ?></b></td>
        </tr>

        <tr>
          <td colspan="5" style="border-top:1px solid">Bayar</td>
          <td align="right" style="border-top:1px solid"><b><? echo number_format($data['ub'],0,",",".")  ?></b></td>
        </tr>

        <tr>
          <td colspan="5" style="border-top:1px solid">Kembali</td>
          <td align="right" style="border-top:1px solid"><b><? echo number_format($data['uk'],0,",",".")  ?></b></td>
        </tr>

    </table>
    <?
    ?>
    </div>
</body>
</html>


<?php

$printer = printer_open("Canon iP2700 series");  
/* write the text to the print job */  
printer_write($printer, $d);
   
/* close the connection */ 
printer_close($printer); 


?>