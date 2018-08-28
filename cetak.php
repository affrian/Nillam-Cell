<?php
$lipsum = ""; 
/* tulis dan buka koneksi ke printer */    
$printer = printer_open("kasir");  
/* write the text to the print job */  
printer_write($printer, $lipsum);   
/* close the connection */ 
printer_close($printer); 
?>
