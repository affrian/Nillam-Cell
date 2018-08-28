<?php
session_start();
include("lib/koneksi.php");
//$pass=md5($pass);
$cari=mysql_query("select * from admin where un='$un2' and password='$pass' ") or die (mysql_error());
$jum=mysql_num_rows($cari);
$data=mysql_fetch_array($cari);

//echo $pass;
//echo $un;

if($jum>=1){
	echo "sukses|".$data['hak_akses'];
	$_SESSION['ses_jve_un']=$un2;
	$_SESSION['ses_jve_nama']=$data['nama_admin'];
	$_SESSION['ses_jve_foto']=$data['foto'];
	$_SESSION['ses_jve_ha']=$data['hak_akses'];
//	echo $_SESSION['ses_cafe_un'];
//echo "gg";
	//$w=date("d-m-Y G:i:s");
//	mysql_query("update admin set jejak_login='$w' where kode_admin='$un'");
}else{
	echo "gagal";
	
}

switch($op){
	
case "logout":
session_unregister('ses_jve_un');
break;

case "tam_user":
?>
<td valign="middle"><?php echo  $_SESSION['ses_jve_nama'] ?> &nbsp; </td>
    <td width="4%" align="right" ><img src="foto_admin/<?php echo  $_SESSION['ses_jve_foto'] ?>" width="45" height="45" style="border-radius:22.5px;cursor:pointer" id="logout" alt=""/>
<?
break;
	
}

?>