<?php
include("lib/koneksi.php");
switch($op){

case "cekkatbar":
$cari=mysql_query("select * from barang where nama_barang like '%$nm%' limit 40");
while($dta=mysql_fetch_array($cari)){
?>	
<li class="pil1">
<?php echo $dta['nama_barang'] ?>
</li>
<?php
}
break;


case "val":
echo number_format($val,0,",",".");
break;

case "isi_kat":
$tampil=mysql_query("select * from kat_barang order by nama_kat") or die (mysql_error());
while($data=mysql_fetch_array($tampil)){
?>
<option value="<? echo $data['kode_kat']  ?>"><? echo $data['nama_kat']  ?></option>
<?
}
break;
	

case "simpan_barang":
$foto=$_FILES['foto']['name'];
$gg=mysql_query("select * from kat_barang where kode_kat='$barang_kat'");
$dt=mysql_fetch_array($gg);
$nama_kat=$dt['nama_kat'];

if($barang_kode==""){
$cek=mysql_query("select * from barang where kode_kat='$barang_kat' order by kode_barang desc") or die (mysql_error());
$is=mysql_num_rows($cek);
//echo $is;
$da=mysql_fetch_array($cek);

	if($is<1){
		$nota="0001".$barang_kat;
	}else{
	
		$jum=substr($da['kode_barang'],0,4)+10001;
	//echo $jum;
	$nota=substr($jum,1,4).$barang_kat;
	}
	echo $nota;

mysql_query("insert into barang values ('$nota','$barang_kat','$nama_kat','$barang_nama','$barang_satuan','$barang_hb','$barang_hj','$barang_stok','$foto','$barang_bar')") or die (mysql_error());
copy($_FILES['foto']['tmp_name'],"fotobar/".$_FILES['foto']['name']);
}else{
	if($foto==""){
mysql_query("update barang set barcode='$barang_bar',kode_kat='$barang_kat',nama_kat='$nama_kat',nama_barang='$barang_nama',
satuan='$barang_satuan',harga_beli='$barang_hb',harga_jual='$barang_hj',stok='$barang_stok' where kode_barang='$barang_kode'") or die (mysql_error());
	}else{
mysql_query("update barang set barcode='$barang_bar',foto='$foto',kode_kat='$barang_kat',nama_kat='$nama_kat',nama_barang='$barang_nama',
satuan='$barang_satuan',harga_beli='$barang_hb',harga_jual='$barang_hj',stok='$barang_stok' where kode_barang='$barang_kode'") or die (mysql_error());
copy($_FILES['foto']['tmp_name'],"fotobar/".$_FILES['foto']['name']);
	
}
}
echo '<script type="text/javascript">';
//echo 'alert()';  
     echo "parent.tampilbarang();";  
 echo '</script>';   	
break;	

case "tampil_barang":
?>

<table width="1237" border="0" cellspacing="0" cellpadding="0" id="tbl">
  <tr>
    <th width="29">&nbsp;</th>
    <th width="84">Pict</th>
    <th width="84">Kode barang</th>
    <th width="169">Kategori</th>
    <th width="325">Nama barang</th>
    <th width="174">Satuan</th>
    <th width="124" align="right">Harga Beli</th>
    <th width="124" align="right">Harga Jual</th>
    <th width="124" align="right">Stok</th>
  </tr>
<?
$no=1;
$jr=10;
  $tam=mysql_query("select * from barang ");
  $mp=mysql_num_rows($tam);
  $p=ceil($mp/$jr);
  
  if($s==""){
	$s=0;
	$pgd=1;
  }

$tampil=mysql_query("select * from barang where nama_barang like '%$naba%' order by kode_barang limit $s,$jr ");
while($data=mysql_fetch_array($tampil)){
	?>
	
  <tr>
    <td><img style="cursor:pointer" onClick="edit_barang(<? echo $no ?>)" src="img/edit_kcl.png" width="20" height="20"  alt="Edit Barang"/></td>
    <td><?php if($data['foto']!=""){ ?>
    <img onClick="show_gam(<?php  echo $no  ?>)" style="border-radius:15px;margin-top:5px" src="fotobar/<?php echo $data['foto'] ?>"  height="30" width="30">
    <?  
	}else{ 
	?>
<img  style="border-radius:20px;margin-top:5px" src="fotobar/noim.jpg"  height="40" width="40">
    
    <?  }?></td>
    <td><? echo $data['kode_barang']  ?><input type="hidden" id="barangkode<? echo $no  ?>" value="<? echo $data['kode_barang']  ?>"></td>
    <td><? echo $data['nama_kat']  ?></td>
    <td><? echo $data['nama_barang']  ?></td>
    <td><? echo $data['satuan']  ?></td>
    <td align="right"><? echo number_format($data['harga_beli'],0,",",".")  ?></td>
    <td align="right"><? echo number_format($data['harga_jual'],0,",",".")  ?></td>
    <td align="right"><? echo $data['stok']  ?></td>
  </tr>
<?
$no++;
}

?>
</table>
<?php
for($i=1;$i<=$p;$i++){
	if($pgd==$i ){
  $sty="color:red;box-shadow:0 0 4px #1F1DEC";
	}
  else{
  $sty="color:black;cursor:pointer";
	
  }
?>

<input onClick="pindahpagebar(<? echo $i   ?>)" type="button" value="<? echo $i  ?>" style=";width:30px;height:30%;<?  echo $sty ?>">

<?

}
break;

case "ambilbarang":
$tampil=mysql_query("select * from barang where kode_barang='$kode_barang'");
$data=mysql_fetch_array($tampil);
echo $data['kode_kat']."|".$data['nama_kat']."|".$data['nama_barang']."|".$data['satuan']."|".$data['harga_beli']."|".$data['harga_jual']."|".$data['stok']."|".$data['foto']."|".$data['barcode'];

break;



	
}
?>