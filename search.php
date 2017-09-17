<?php 
include_once("header.php");
?>
<div align="center">
<?php
echo '<table cellspacing="2" cellpadding="10" align="center"><tr><td valign="top">';


$find = $_GET["find"];
$field = $_GET["field"];
$search2 = $_GET["search2"];
$asc = $_GET["asc"];
$page = $_GET["page"];
$find = $_GET["find"];

//echo var_dump($field);
//echo var_dump($find);
//die();

$date=$_GET["date"];
$date_nuo =$_GET["date_nuo"];

 //If they did not enter a search term
 if ($find == "" && $date == "") 
 { 
 include "list.php";
 exit; 
 } 
 
 // We preform a bit of filtering 
 $find = strtoupper($find); 
 $find = strip_tags($find); 
 $find = trim ($find); 

$atvaizduoti_id = array();
//JEI PAGAL NUMERI

 if ($field=='Paraiskos_nr'){
  //echo var_dump('Krabas');
  //die();
 $result = PDO("SELECT Paraiskos_id FROM paraiskos WHERE Paraiskos_nr LIKE'%$find%' AND Aktyvus = '1' AND (Paraiskos_data BETWEEN '$date_nuo' AND '$date')", 'a');
 //echo var_dump($result);
 //die();
  foreach($result as $row) {  
  array_push($atvaizduoti_id,$row['Paraiskos_id']);
}

//JEI PAGAL UZSAKOVA
} elseif ($field=='Uzsakovas'){
   $uzsakovo_id = array();
   $pieces = explode(" ", $find);
   if ($pieces[1]){
      $result = PDO("SELECT id FROM klientai WHERE (vardas LIKE'%$pieces[0]%' AND pavarde LIKE'%$pieces[1]%') OR (vardas LIKE'%$pieces[1]%' AND pavarde LIKE'%$pieces[0]%')", 'a');
   }else{
      $result = PDO("SELECT id FROM klientai WHERE vardas LIKE'%$find%' OR pavarde LIKE'%$find%'", 'a');
   }
   foreach($result as $row) {    
      array_push($uzsakovo_id,$row['id']);
   }
   if(!empty($uzsakovo_id)){
   $uzsakovo_id = join(',',$uzsakovo_id);  
   $result = PDO("SELECT * FROM paraiskos WHERE (Uzsakovas IN ($uzsakovo_id)) AND Uzsakovo_tipas='privatus' AND Aktyvus = '1'", 'a');
   foreach($result as $row) {  
      array_push($atvaizduoti_id,$row['Paraiskos_id']);
   }
 }


   // Įmonės klientams
   if(empty($uzsakovo_id)){
   $uzsakovo_id = array();
   $result = PDO("SELECT id FROM klientai_imones WHERE pavadinimas LIKE'%$find%' OR imones_kodas LIKE'%$find%'", 'a');
   foreach($result as $row) {     
      array_push($uzsakovo_id,$row['id']);
   }

   $uzsakovo_id = join(',',$uzsakovo_id);  
   $result = PDO("SELECT * FROM paraiskos WHERE (Uzsakovas IN ($uzsakovo_id)) AND Uzsakovo_tipas='imone' AND (Paraiskos_data BETWEEN '$date_nuo' AND '2020-04-13') AND Aktyvus = '1'", 'a');
      foreach($result as $row) {  
      array_push($atvaizduoti_id,$row['Paraiskos_id']);
   }
 }
}
$numrows = count($atvaizduoti_id);
$atvaizduoti_id = join(',',$atvaizduoti_id);  

// --------------------------------------------------------------------------------------------
// ------------------------- paieska ----------------------------------------
?>
 <img src="images/search.png" width="20" height="20"/> 
 Ieškoti: <input type="text" name="find" value="<?=$find?>"> 
 <Select NAME="field" style="background-color: #B8B6B6">
 <Option VALUE="Paraiskos_nr" <?php if($_GET['field']=='Paraiskos_nr') echo 'selected'; ?> >Paraiškos nr.</option>
 <Option VALUE="Uzsakovas" <?php if($_GET['field']=='Uzsakovas') echo 'selected';?> >Užsakovas</option>
 </Select> 
 Data nuo: <input type="date" name="date_nuo" size="10" min="2000" max="2020" value="<?=$date_nuo?>"> 
 Data iki: <input type="date" name="date" size="10"  min="2000" max="2020" value="<?=$date?>">

 <input type="hidden" name="searching" value="yes" />

 <input type="submit" id="Paieska" name="search" value="Ieškoti" style="margin-left: 20px" />
 </form> <?php

// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

//echo var_dump($totalpages);
//die();

// get the current page or set a default
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
   // cast var as int
   $page = (int) $_GET['page'];
} else {
   // default page num
   $page = 1;
} // end if

// if current page is greater than total pages...
if ($page > $totalpages) {
   // set current page to last page
   $page = $totalpages;
} // end if
// if current page is less than first page...
if ($page < 1) {
   // set current page to first page
   $page = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($page - 1) * $rowsperpage;

 ?>
 <tr>
 <td align="center">
 <b>Viso rasta įrašų: </b><?=$numrows?><br> </td> </tr>
 <tr>
 <td align="center">
 <b>Rodomi rezultatai užklausai:</b> <?=$find?> <br> </td> </tr>
 <?php


print '<table border="0" width="100%"><tr><td colspan="9" align="center">';
// if not on page 1, don't show back links
if ($page > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?page=1&find=$find&field=$field&date=$date&date_nuo=$date_nuo&searching=yes&search=Search'><<</a> ";
   // get previous page num
   $prevpage = $page - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?page=$prevpage&find=$find&field=$field&date=$date&date_nuo=$date_nuo&searching=yes&search=Search'><</a> ";
} // end if

// range of num links to show
$range = 3;

// loop to show links to range of pages around current page
for ($x = ($page - $range); $x < (($page + $range)  + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $page) {
         // 'highlight' it but don't make a link
         echo " [<b>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='{$_SERVER['PHP_SELF']}?page=$x&find=$find&field=$field&date=$date&date_nuo=$date_nuo&searching=yes&search=Search'>$x</a> ";
      } // end else
   } // end if 
} // end for

// if not on last page, show forward and last page links        
if ($page != $totalpages) {
   // get next page
   $nextpage = $page + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?page=$nextpage&find=$find&field=$field&date=$date&date_nuo=$date_nuo&searching=yes&search=Search'>></a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?page=$totalpages&find=$find&field=$field&date=$date&date_nuo=$date_nuo&searching=yes&search=Search'>>></a> ";
} // end if
print "</td></tr></table><br>";
/****** end build pagination links ******/
// --------------------------------------------------------------------------------------------

print '<table border="1" class="visos2" align="center" id="1">';
$nr=1;

?><tr><th align="center" class="unsortable" style="color:white"><b>Nr.</b></th>
	<th align="center" style="color:white"><b>&nbsp;Data&nbsp;<a href="search.php?search2=par_data&asc=asc&page=1&date_nuo=<?=$date_nuo?>&find=<?=$find?>&field=<?=$field?>&date=<?=$date?>&searching=yes&search=Search"><img src="images/arrow_up.png"/></a><a href="search.php?search2=par_data&date_nuo=<?=$date_nuo?>&asc=desc&page=1&find=<?=$find?>&field=<?=$field?>&date=<?=$date?>&searching=yes&search=Search"><img src="images/arrow_down.png"/></a></b></th>
	<th align="center"><b style="color:white">&nbsp;<nobr>Paslauga</nobr>&nbsp;</b></th>
  <th class="unsortable"><b style="color:white">&nbsp;Užsakovas&nbsp;</b></th>
  <th class="unsortable"><b style="color:white">&nbsp;Tel.&nbsp;</b></th>
  <th class="unsortable"><b style="color:white">&nbsp;Paslaugos kaina&nbsp;</b></th>

<?php

 //And we display the results 
   
$result = PDO("SELECT * FROM paraiskos WHERE Paraiskos_id IN ($atvaizduoti_id) LIMIT $rowsperpage", 'a');


foreach($result as $row) 
{ 
 Print "<tr>";
 Print "<td bgcolor='#B8B6B6' align='center'  class='unsortable'>".$nr. "</td> ";
 Print "<td bgcolor='#B8B6B6'>&nbsp;".$row['Paraiskos_data']. "&nbsp;</td> ";
 Print "<td bgcolor='#B8B6B6'>&nbsp;".$row['Paslauga']. "&nbsp;</td> ";
 
if ($row['Uzsakovo_tipas']=='privatus'){
 $result2 = PDO("SELECT * FROM klientai WHERE id = '".$row['Uzsakovas']."'", 'a');
   foreach($result2 as $row2) 
   { 
      Print "<td bgcolor='#B8B6B6'>&nbsp;".$row2['vardas']." ".$row2['pavarde']."&nbsp;</td>"; 
      Print "<td bgcolor='#B8B6B6'>&nbsp;".$row['tel_nr']."&nbsp;</td> ";
   }
   Print "<td bgcolor='#B8B6B6'>&nbsp;".$row['Bendra_suma']. "&nbsp;</td> ";
} else if ($row['Uzsakovo_tipas']=='imone'){
    $result2 = PDO("SELECT * FROM klientai_imones WHERE id = '".$row['Uzsakovas']."'", 'a');
   foreach($result2 as $row2) 
   { 
      Print "<td bgcolor='#B8B6B6'>&nbsp;".$row2['pavadinimas']."&nbsp;</td>"; 
      Print "<td bgcolor='#B8B6B6'>&nbsp;".$row['tel_nr']."&nbsp;</td> ";
   }
   Print "<td bgcolor='#B8B6B6'>&nbsp;".$row['Bendra_suma']. "&nbsp;</td> ";
}
Print "</tr>";
$nr++;
} 
print "</table><br>";
/******  build the pagination links ******/
print '<table border="0" width="100%"><tr><td colspan="9" align="center">';
// if not on page 1, don't show back links
if ($page > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?page=1&find=$find&field=$field&date=$date&date_nuo=$date_nuo&searching=yes&search=Search'><<</a> ";
   // get previous page num
   $prevpage = $page - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?page=$prevpage&find=$find&field=$field&date=$date&date_nuo=$date_nuo&searching=yes&search=Search'><</a> ";
} // end if

// range of num links to show
$range = 3;

// loop to show links to range of pages around current page
for ($x = ($page - $range); $x < (($page + $range)  + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $page) {
         // 'highlight' it but don't make a link
         echo " [<b>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='{$_SERVER['PHP_SELF']}?page=$x&find=$find&field=$field&date=$date&date_nuo=$date_nuo&searching=yes&search=Search'>$x</a> ";
      } // end else
   } // end if 
} // end for

// if not on last page, show forward and last page links        
if ($page != $totalpages) {
   // get next page
   $nextpage = $page + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?page=$nextpage&find=$find&field=$field&date=$date&date_nuo=$date_nuo&searching=yes&search=Search'>></a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?page=$totalpages&find=$find&field=$field&date=$date&date_nuo=$date_nuo&searching=yes&search=Search'>>></a> ";
} // end if
print "</td></tr></table><br>";
/****** end build pagination links ******/
// --------------------------------------------------------------------------------------------
 //This counts the number or results - and if there wasn't any it gives them a little message explaining that
 $num_rows = count($result); 
 //$anymatches=mysql_num_rows($result); 
 if ($num_rows == 0) 
 { 
 echo "Pagal Jūsų užklausą įrašų nerasta.<br><br>"; 
 } 
 
echo '</td></tr></table>';
?>
</table>
</div>
<?php
include "footer.php";
 ?> 
