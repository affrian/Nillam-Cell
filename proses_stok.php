<?php
include("lib/koneksi.php");
switch($op){

case "tampil":
?>
<form>
 <table width="100%" border="1" cellpadding="5" id="des" >
   <tr >
    <th width="14%"><div align="center">Kategori</div></th>
    <th width="20%"><div align="center">Nama Barang</div></th>
    <th width="12%"><div align="center">Satuan</div></th>
    <th width="13%"><div align="center">Harga Beli</div></td>
    <th width="12%"><div align="center">Harga Jual</div></th>
    
    <th width="6%"><div align="center">Stok</div></th>
    </tr>
 <?

$no=1;
$jr=4;
  $tam=mysql_query("select * from barang ");
  $mp=mysql_num_rows($tam);
  $p=ceil($mp/$jr);
  
  if($s==""){
	$s=0;
	$pgd=1;
  }


$tampil=mysql_query("select * from  barang  where nama_barang like '%$q%' order by nama_barang  limit $s,$jr");
while($data=mysql_fetch_array($tampil)){
	?>
  <tr class="satu">
    <td><input type="hidden" id="rtkb<? echo $no  ?>" value="<? echo $data['kode_barang'] ?>" /><? echo $data['nama_kat'] ?> </td>
    <td><? echo $data['nama_barang'] ?> </td>
    <td> <? echo $data['satuan'] ?> </td>
    <td><? echo number_format($data['harga_beli'],0,".",",") ?> </td>
    <td> <? echo number_format($data['harga_jual'],0,".",",") ?> </td>
    <td>  <input type="text" class="inp" style="text-align:right" name="rt_stok"  id="rt_stok<? echo $no ?>"
     value="<? echo $data['stok'] ?> " size="4" onClick="cek_val(<? echo $no ?>)" />
   </td>
   </tr>
   
  <?
  $no++;
  }
  ?>
</table>
<? $no=$no-1 ?>
<input type="hidden" id="rtno" value="<? echo $no ?>" />
<input name="simpan" type="button" class="btn_utm" id="rtsimpan" value="Simpan" />


<hr />

<?php
for($i=1;$i<=$p;$i++){
	if($pgd==$i ){
  $sty="color:red;box-shadow:0 0 4px #1F1DEC;font-size:12px;";
	}
  else{
  $sty="color:black;cursor:pointer";
	
  }
?>
<input onClick="pindahpagert(<? echo $i   ?>)" type="button" value="<? echo $i  ?>" style=";min-width:30px;height:30%;<?  echo $sty ?>">

<?

}



break;

case "simpan":
mysql_query("update barang set stock='$stok' where kode_barang='$kb'");

break;
}
?>