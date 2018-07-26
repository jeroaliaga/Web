<?php 
require_once 'excel_reader2.php';
$xls = new Spreadsheet_Excel_Reader('example.xls'); 
?>
<?php
 $rows = $xls->rowcount();
 $cols = $xls->colcount();
 $csv = "";

 for($r = 0; $r < $rows; $r++) {
    for($c = 0; $c < $cols; $c++) {
       $csv .= $xls->raw($r, $c);
       if($c == $cols - 1) {
          $csv .= "\n";
       } else {
          $csv .= ",";
       }   
    }
 }
?>
<?php
echo $csv;
 ?>