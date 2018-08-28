<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/cetak_faktur.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {

  /*  
$("#rtsimpan").click(function(){
no=$("#rtno").val();

//alert(no);
for(i=0;i<=no;i++){	
	kb=$("#rtkb"+i).val();
	stok=$("#rtstok"+i).val();
	//alert("fdfd");
	//alert(kb+stok);
	$.ajax({
		url:"proses_stok.php",
		data:"kb="+kb+"&stok="+stok,
		cache:false,
		success: function(){
		}
		
	}); // tutup ajax
	
}
		alert("Data Sudah Tersimpan");	

});
*/

$("#rt_tampil_bar2").load("proses_stok.php","op=tampil");

});


</script>
<script>
function pindahpagert(v){
//alert(v);
jr=4;	
s=((v*jr)-jr);
$("#rt_tampil_bar2").load("proses_stok.php","op=tampil&s="+s+"&pgd="+v);
}

</script>

<link href="css/form.css" rel="stylesheet" type="text/css">

</head>

<body>
<div class="cc" id="cc-rtt" style="display:none">
<div id="head" ></div>
<div align="center" >
  <table width="100%" border="0" cellspacing="0" cellpadding="0" >
    <tr>
      <td width="93%"></td>
      <td width="7%" align="right"><img class="tutup_form" style="cursor:pointer" src="img/arrow.png" width="50" height="50" alt=""/></td>
    </tr>
  </table>
</div>
<div id="main">


</div>
</div>
</body>
</html>