<?php 
$date = date('Y-m-d'); 
$date_nuo = date('Y-m-d', strtotime('-1 year'));

if(isset($_COOKIE["list_date_nuo"])) {
    $date_nuo = $_COOKIE["list_date_nuo"];
}

if(isset($_COOKIE["list_date"])) {
    $date = $_COOKIE["list_date"];
}  

if(isset($_GET['date_nuo']) && $_GET['date_nuo'] !== ''){
  $date_nuo = $_GET['date_nuo'];
}

if(isset($_GET['date']) && $_GET['date'] !== ''){
  $date = $_GET['date'];
}

?>
<form name="search" method="get" action="search.php" align="center">
   <br>
   <br>
   <img src="images/search.png" width="20" height="20"/> 
   <font color="white">Ieškoti: </font><input type="text" name="find" style="background-color:#B8B6B6"> 
   <select NAME="field" style="background-color:#B8B6B6">
      <option VALUE="Paraiskos_nr">Paraiškos nr.</option>
      <option VALUE="Uzsakovas">Užsakovas</option>
 </select>
   <font color="white">Data nuo: </font>
   <input type="date" 
          name="date_nuo" 
          size="10" 
          min="2000" 
          max="2020" 
          style="background-color:#B8B6B6"
          value="<?=$date_nuo?>">
   <font color="white">Data iki: </font>
   <input type="date" 
          name="date" 
          size="10" 
          min="2000" 
          max="2020" 
          value="<?=$date?>"
          style="background-color:#B8B6B6">
   <input type="hidden" 
          name="searching" 
          value="yes" />

   <input id="searcho_submit" type="submit" 
          name="search" 
          value="Ieškoti" style="margin-left: 20px"
          style="background-color:#B8B6B6" />
</form> 

<?php

$result_new = PDO("SELECT * FROM paraiskos WHERE (Paraiskos_data BETWEEN '$date_nuo' AND '$date') AND Aktyvus = '1' ", 'r', null, $numrows);

//echo var_dump($result_new);
//die();


$totalpages = ceil($numrows / $rowsperpage);
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
   $page = (int) $_GET['page'];
} else {
   $page = 1;
}
if ($page > $totalpages) {
   $page = $totalpages;
}
if ($page < 1) {
   $page = 1;
}

$offset = ($page - 1) * $rowsperpage;



$search = $_GET["search"];
$asc = $_GET["asc"];

if ($search=="par_data" && $asc=="asc"){
  $order_by = ' Paraiskos_data ASC, Paraiskos_id DESC ';

}elseif ($search=="par_data" && $asc=="desc"){
  $order_by = ' Paraiskos_data DESC, Paraiskos_id DESC ';

}else {
  $order_by = ' Paraiskos_data DESC, Paraiskos_id ASC ';
}

$result_new = PDO("SELECT * FROM paraiskos
            WHERE (Paraiskos_data BETWEEN '".$date_nuo."' AND '".$date."') AND Aktyvus ='1'
            ORDER BY ".$order_by."
            LIMIT ".$offset.", ".$rowsperpage,
            'a');

//echo var_dump($result_new);
//die();

?>

<table border="0" width="100%" align="center">
   <tr>
      <td colspan="9" align="center">
<?php
if ($page > 1) {
   $prevpage = $page - 1;
   ?>
   <a style="color:white" href='<?=$_SERVER['PHP_SELF']?>?page=1&search=<?=$search?>&asc=<?=$asc?>'><<</a>
   <a style="color:white" href='<?=$_SERVER['PHP_SELF']?>?page=<?=$prevpage?>&search=<?=$search?>&asc=<?=$asc?>'><</a>
<?php
}
$range = 3;

for ($x = ($page - $range); $x < (($page + $range)  + 1); $x++) {
   if (($x > 0) && ($x <= $totalpages)) {
      if ($x == $page) {
         echo " [<b style='color:white'>$x</b>] ";
      } else {
         echo " <a style='color:white' href='{$_SERVER['PHP_SELF']}?page=$x&search=$search&asc=$asc'>$x</a> ";
      }
   }
}  
if ($page != $totalpages) {
   $nextpage = $page + 1; ?>
   <a style="color:white" href='<?=$_SERVER['PHP_SELF']?>?page=<?=$nextpage?>&search=<?=$search?>&asc=<?=$asc?>'>></a>
   <a style="color:white" href='<?=$_SERVER['PHP_SELF']?>?page=<?=$totalpages?>&search=<?=$search?>&asc=<?=$asc?>'>>></a>
   <?php
}
?>
      </td>
    </tr>
  </table>
  <br>
<?php
include 'list2.php';
?>
<table border="0" width="100%">
   <tr>
      <td colspan="9" align="center">
<?php
if ($page > 1) {
   $prevpage = $page - 1; 
   ?>
         <a style="color:white" href='<?=$_SERVER['PHP_SELF']?>?page=1&search=<?=$search?>&asc=<?=$asc?>'><<</a>
         <a style="color:white" href='<?=$_SERVER['PHP_SELF']?>page=<?=$prevpage?>&search=<?=$search?>&asc=<?=$asc?>'><</a>
<?php
}
$range = 3;

for ($x = ($page - $range); $x < (($page + $range)  + 1); $x++) {
   if (($x > 0) && ($x <= $totalpages)) {
      if ($x == $page) { ?>
         [<b style="color: white"><?=$x?></b>]
      <?php
      } else { ?>
         <a style="color:white" href='<?=$_SERVER['PHP_SELF']?>?page=<?=$x?>&search=<?=$search?>&asc=<?=$asc?>'><?=$x?></a>
      <?php
      }
   }
}
   
if ($page != $totalpages) {
   $nextpage = $page + 1;
   ?>
         <a style="color:white" href='<?=$_SERVER['PHP_SELF']?>?page=<?=$nextpage?>&search=<?=$search?>&asc=<?=$asc?>'>></a>
         <a style="color:white" href='<?=$_SERVER['PHP_SELF']?>?page=<?=$totalpages?>&search=<?=$search?>&asc=<?=$asc?>'>>></a>
   <?php
}
?>
      </td>
   </tr>
</table>

