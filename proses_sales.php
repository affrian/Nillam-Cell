<?php
session_start();
$kode_adm=$_SESSION['adm_un_kmn'];
include("lib/koneksi.php");
switch($op){
case "val":
$angka=number_format($angka,0,",",".");
echo $angka;
break;

case "ambilbarangkode":
$tam=mysql_query("select * from barang where barcode='$kode'");
$d=mysql_fetch_array($tam);
echo "$d[nama_barang]||$d[harga_jual]|$d[stok]|$d[kode_barang]";
break;	


case "ambilbarangnama":
$tam=mysql_query("select * from barang where nama_barang like '%$nm%' order by nama_barang ");
$d=mysql_fetch_array($tam);

echo "$d[nama_barang]||$d[harga_jual]|$d[stok]|$d[kode_barang]";
break;	
	
case "ambilbarang":
$tam=mysql_query("select * from barang where kode_barang='$kobar'");
$d=mysql_fetch_array($tam);
//$cc=mysql_query("select * from det_t_jual,t_jual where  det_t_jual.nota=t_jual.nota and t_jual.kode_pelanggan='$kopel' anddet_t_jual.kode_barang='$kobar'") or die (mysql_error());
//$dd=mysql_fetch_array($cc);
echo "$d[nama_barang]||$d[harga_jual]|$d[stok]";
break;	

case "ambilpelanggan":
$no=1;
$tam=mysql_query("select * from customer where nama_cus like '%$nape%'order by nama_cus limit 10");
while($d=mysql_fetch_array($tam)){
?>
<li class="pil1" onClick="ambilpelanggan(<?php echo $no   ?>)">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15%"><img  src="pelanggan/<? echo $d['foto'] ?>" alt="" width="35"  height="35" style="display:none;border-radius:32.5px"/></td>
    <td width="85%" valign="bottom">
	<input type="hidden" value="<?php echo $d['kode_cus'] ?>" id="kopel<?php  echo $no ?>">
	<input type="hidden" value="<?php echo $d['nama_cus'] ?>" id="napel<?php  echo $no ?>">
	<input type="hidden" value="<?php echo $d['tlp_pel'] ?>" id="alpel<?php  echo $no ?>">

	<?php echo $d['nama_cus'] ?><br><span style="font-size:9px;"><?php echo $d['tlp_pel'] ?></span></td>
  </tr>
  </table>
</li>
<?	
$no++;
}
break;	

case "caribarang":
$no=1;
$tam=mysql_query("select * from barang where nama_barang like '%$nabar%'order by nama_barang limit 40");
while($d=mysql_fetch_array($tam)){
?>
<li class="pil1" onClick="ambilbarang(<?php echo $no   ?>)">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="3%">&nbsp;</td>
        <td width="97%" valign="bottom">
        	<input type="hidden" value="<?php echo $d['kode_barang'] ?>" id="kobar<?php  echo $no ?>">
        	
        	<?php echo $d['nama_barang'] ?>/
          <?php echo $d['satuan'] ?><br>
          <span style="font-size:12px;">
          <?php echo number_format($d['harga_jual'],0,",",".") ?>/
          <?php echo number_format($d['stok'],0,",",".") ?></span>
        </td>
      </tr>
  </table>
</li>
<?	
$no++;
}break;

case "sim_trans":
if($nota==""){

$tgl=date("Y-m-d");
$bl=date("m");
$th=date("Y");

$cek=mysql_query("select * from t_jual where tgl='$tgl' order by nota desc") or die (mysql_error());
$is=mysql_num_rows($cek);
$da=mysql_fetch_array($cek);

$tb=date("Ymd");
//echo $is;
//echo $tbn;
if($is<1){
		$nota="F".$tb."0001";
	}else{
	$jum=substr($da['nota'],9,4)+10001;
	$nota="F".$tb.substr($jum,1,4);
	}
	
	
mysql_query("insert into t_jual values('$nota','$tgl','$bl','$th','$kode_pelanggan','$nama_pelanggan','$alamat','$gt','$sts','$kode_adm','','')") or die (mysql_error());
//echo $nota;
}else{
mysql_query("update t_jual set kode_pelanggan='$kode_pelanggan',nama_pelanggan='$nama_pelanggan',tlp_pel='$alamat',gt='$gt',ub='$ub',uk='$uk' where nota='$nota' ") or die (mysql_error());
}
//echo $nota;  //penting ."/".$tbn."/".$bl



//===============Simpan Barang==========================
$car=mysql_query("select * from barang where kode_barang='$kb'") or die (mysql_error());
$dat=mysql_fetch_array($car);
//$harga_j=$dat['harga_jual'];

//$nama_barang=$dat['nama_barang'];
$harga_b=$dat['harga_beli'];
//$kat=$dat['kat'];
$s=$dat['stok'];

$tampil=mysql_query("select *from det_t_jual where kode_barang='$kb' and nota='$nota' ") or die (mysql_error()) ;
$isi=mysql_num_rows($tampil);
echo $isi."|";
if($isi<1){

mysql_query("insert into det_t_jual values('$nota','$kb','$nb','$harga_b','$hj','$qty','$subtotal','$diskon','$total','$urutan')");

//update stok baranhh======================================================
$stok=$s-$qty;
$ubahstok=mysql_query("update barang set stok='$stok' where kode_barang='$kb' ");
//=========================================================================


}else{
	
//update stok baranhh======================================================
$tampil=mysql_query("select *from det_t_jual where  kode_barang='$kb' and nota='$nota'") or die (mysql_error());
$tam=mysql_query("select *from barang where kode_barang='$kb'") or die (mysql_error()); 

$data=mysql_fetch_array($tampil);
$dat=mysql_fetch_array($tam);

$st=$dat['stok']+$data['qty'];



$stok=$st-$qty;
$ubahstok=mysql_query("update barang set stok='$stok' where kode_barang='$kb' ");
//=========================================================================
	
	
mysql_query("update det_t_jual set nama_barang='$nb',harga_jual='$hj',qty='$qty',subtotal='$subtotal' where nota='$nota' and kode_barang='$kb' ");
	
	
}

echo $nota;



break;

case "s_d_trans":
$car=mysql_query("select * from barang where kode_barang='$kb'") or die (mysql_error());
$dat=mysql_fetch_array($car);
//$harga_j=$dat['harga_jual'];

//$nama_barang=$dat['nama_barang'];
$harga_b=$dat['harga_beli'];
//$kat=$dat['kat'];
$s=$dat['stok'];

$tampil=mysql_query("select *from det_t_jual where kode_barang='$kb' and nota='$nota' ") or die (mysql_error()) ;
$isi=mysql_num_rows($tampil);

if($isi<1){
if($kb!="" && $qty!="0"){
mysql_query("insert into det_t_jual values('$nota','$kb','$nb','$harga_b','$hj','$qty','$subtotal','$diskon','$total','$urutan')");

//update stok baranhh======================================================
$stok=$s-$qty;
$ubahstok=mysql_query("update barang set stok='$stok' where kode_barang='$kb' ");
//=========================================================================

}
}else{
	
//update stok baranhh======================================================
$tampil=mysql_query("select *from det_t_jual where  kode_barang='$kb' and nota='$nota'") or die (mysql_error());
$tam=mysql_query("select *from barang where kode_barang='$kb'") or die (mysql_error()); 

$data=mysql_fetch_array($tampil);
$dat=mysql_fetch_array($tam);

$st=$dat['stok']+$data['qty'];



$stok=$st-$qty;
$ubahstok=mysql_query("update barang set stok='$stok' where kode_barang='$kb' ");
//=========================================================================
	
	
mysql_query("update det_t_jual set nama_barang='$nb',harga_jual='$hj',qty='$qty',subtotal='$subtotal',diskon='$diskon',total='$total' where nota='$nt' and kode_barang='$kb' ");
	
	
}


break;


case "cekstok":
$tampil=mysql_query("select *from det_t_jual where  kode_barang='$kd' and nota='$nota'");
$tam=mysql_query("select *from barang where kode_barang='$kd'"); 

$data=mysql_fetch_array($tampil);
$dat=mysql_fetch_array($tam);

$st=$dat['stok']+$data['qty'];

echo $st;
break;



case "tampil_faktur":
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl">
  <tr>
    <th width="5%">&nbsp;</th>
    <th width="12%">Nota</th>
    <th width="11%">      Tangggal</th>
    <th width="26%">Nama Pelanggan</th>
    <th width="11%">Alamat / Tlp</th>
    <th width="17%" align="right">Grandtotal</th>
    <th width="8%" align="center">Cetak</th>
  </tr>
  <?php
$jr=10;
  $tam=mysql_query("select * from t_jual ");
  $mp=mysql_num_rows($tam);
  $p=ceil($mp/$jr);
  
  if($s==""){
	$s=0;
	$pgd=1;
  }

  
  $no=1;
  $tam=mysql_query("select * from t_jual order by nota desc limit $s,$jr ") or die (mysql_error());
  while($data=mysql_fetch_array($tam)){
  ?>
  <tr>
    <td align="center"><img onClick="edittrans(<?php echo $no ?>)" style="cursor:pointer" src="img/edit_kcl.png" width="25" height="25" alt=""/></td>
    <td><input type="hidden" value="<?php  echo $data['nota']   ?>" id="nnota<?php echo $no ?>"> <?php  echo $data['nota']   ?></td>
    <td><?php  echo $data['tgl']   ?></td>
    <td><?php  echo $data['nama_pelanggan']   ?></td>
    <td><?php  echo $data['tlp_pel']   ?></td>
    <td align="right"><?php echo  number_format($data['gt'],0,",",".")   ?></td>
    <td align="center" style="text-align: center"><img style="cursor:pointer" onClick="ctk_fak(<? echo $no  ?>)" src="img/print_kcl.png" width="20" height="20" alt=""/></td>
  </tr>
  <?php
  $no++;
  }
  ?>
</table>
<?php
for($i=1;$i<=$p;$i++){
	if($pgd==$i ){
  $sty="color:red;box-shadow:0 0 10px #1F1DEC";
	}
  else{
  $sty="color:black;cursor:pointer";
	
  }
?>
<input onClick="pindahpagetrans(<? echo $i   ?>)" type="button" value="<? echo $i  ?>" style=";width:30px;height:30%;<?  echo $sty ?>">


<?php
}
break;

case "ambiltrans":
$tam=mysql_query("select * from t_jual where  nota='$nota'") or die (mysql_error());
$data=mysql_fetch_array($tam);
echo "$data[nama_pelanggan]|$data[tlp_pel]|$data[gt]";
break;

case "ambildettrans":
$tam=mysql_query("select * from det_t_jual where nota='$nota' and kode_barang='$kobar'") or die (mysql_error());
$data=mysql_fetch_array($tam);
echo "$data[kode_barang]|$data[nama_barang]|$data[harga_jual]|$data[qty]|$data[subtotal]";
break;



case "tampil_bar":
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl">
  <tr>
    <th width="3%">&nbsp;</th>
    <th width="14%">Kode Barang</th>
    <th width="35%">Nama Barang</th>
    <th width="21%">Harga</th>
    <th width="7%">Qty</th>
    <th width="20%">Total</th>
  </tr>
  <?php
  $no=1;
  $tampil=mysql_query("select * from det_t_jual where nota='$nota' ");
  while($data=mysql_fetch_array($tampil)){
  ?>
  <tr>
    <td><img onClick="editbar(<?php echo $no ?>)" style="cursor:pointer" src="img/edit_kcl.png" width="25" height="25" alt=""/></td>
    <td><?php echo $data['kode_barang'] ?><input type="hidden" id="bb<? echo $no ?>" value="<?php echo $data['kode_barang'] ?>"></td>
    <td><?php echo $data['nama_barang'] ?></td>
    <td><?php echo number_format($data['harga_jual'],0,",",".") ?></td>
    <td><?php echo number_format($data['qty'],0,",",".") ?></td>
    <td><?php echo number_format($data['subtotal'],0,",",".") ?></td>
  </tr>
  <?
  $no++;
  }
  ?>
</table>

<?php

break;


case "hitunggt":
$tampil=mysql_query("select sum(subtotal) as gt from det_t_jual where nota='$nota' ");
  $data=mysql_fetch_array($tampil);
  echo $data['gt'];
mysql_query("update t_jual set gt='$data[gt]' where nota='$nota' ") or die (mysql_error());
  
break;

case "updateub":
mysql_query("update t_jual set ub='$ub',uk='$uk' where nota='$nota' ") or die (mysql_error());

break;

}
?>