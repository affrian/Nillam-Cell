<?php
include("lib/koneksi.php");
switch($op){

case "cekkatbar":
$cari=mysql_query("select * from kat_barang where nama_kat like '%$nm%' limit 40");
while($dta=mysql_fetch_array($cari)){
?>	
<li class="pil1">
<?php echo $dta['nama_kat'] ?>
</li>
<?php
}
break;

case "simpan_kat_barang":

$gg=mysql_query("select * from kat_barang where kode_kat='$kat_barang_kode'");
$dt=mysql_fetch_array($gg);
$is=mysql_num_rows($gg);

if($is<1){

mysql_query("insert into kat_barang values ('$kat_barang_kode','$kat_barang_nama')") or die (mysql_error());
}else{

mysql_query("update kat_barang set nama_kat='$kat_barang_nama' where kode_kat='$kat_barang_kode'") or die (mysql_error());
	
}
	
break;	

case "tampil_kat_barang":
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl">
  <tr>
    <th width="40">&nbsp;</th>
    <th width="110">Kode Kategori</th>
    <th width="918" align="left">Nama Kategori</th>
  </tr>
<?php
$no=1;
$jr=10;
  $tam=mysql_query("select * from kat_barang ");
  $mp=mysql_num_rows($tam);
  $p=ceil($mp/$jr);
  
  if($s==""){
	$s=0;
	$pgd=1;
  }

$tampil=mysql_query("select * from kat_barang order by kode_kat limit $s,$jr ");
while($data=mysql_fetch_array($tampil)){
	?>
	
  <tr>
    <td><img style="cursor:pointer" onClick="edit_kat_barang(<? echo $no ?>)" src="img/edit_kcl.png" width="25" height="25" alt=""/></td>
    <td><? echo $data['kode_kat']  ?><input type="hidden" id="kat_barangkode<? echo $no  ?>" value="<? echo $data['kode_kat']  ?>"></td>
    <td><? echo $data['nama_kat']  ?></td>
  </tr>
<?php
$no++;
}

?>
</table>
<?php
for($i=1;$i<=$p;$i++){
	if($pgd==$i ){
  $sty="color:red;box-shadow:0 0 3px #1F1DEC";
	}
  else{
  $sty="color:black;cursor:pointer";
	
  }
?>
<input onClick="pindahpage(<? echo $i   ?>)" type="button" value="<? echo $i  ?>" style=";width:30px;height:30%;<?  echo $sty ?>">

<?php

}
break;

case "ambilkat_barang":
$tampil=mysql_query("select * from kat_barang where kode_kat='$kode_kat_barang'");
$data=mysql_fetch_array($tampil);
echo $data['kode_kat']."|".$data['nama_kat'];

break;

case "cek_kat":
$tampil=mysql_query("select * from kat_barang where kode_kat='$katbar'");
$data=mysql_fetch_array($tampil);
$isi=mysql_num_rows($tampil);
echo $data['nama_kat'];

break;

	
}
?>