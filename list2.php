
<table border="1" class="visos2 list2" id="1"> <?php
$nr=1;
?>
<tr>
	<th align="center" 
		class="unsortable"><b style="color:white">Nr.</b>
	</th>
	<th align="center" ><b style="color:white"><nobr>&nbsp;Data&nbsp; <a href="index.php?search=par_data&asc=asc"><img src="images/arrow_up.png"/></a> <a href="index.php?search=par_data&asc=desc"><img src="images/arrow_down.png"/></a></nobr></b></th>
	<th align="center"><b style="color:white">&nbsp;<nobr>Paslauga</nobr>&nbsp;</b></th>
	<th class="unsortable"><b style="color:white">&nbsp;Užsakovas&nbsp;</b></th>
	<th class="unsortable"><b style="color:white">&nbsp;Tel.&nbsp;</b></th>
	<th class="unsortable"><b style="color:white">&nbsp;Paslaugos kaina&nbsp;</b></th>
  

  </tr><?php

foreach ($result_new as $row) {

if($row['Aktyvus']!=0){
	if ($odd=$nr%2){ ?>
	<tr>
		<td style="background-color:#B8B6B6" 
			align='center'
			class='unsortable'><?=$nr?></td>
		<td style="background-color:#B8B6B6">&nbsp;<?php echo $row['Paraiskos_data'], " ", $row['Paraiskos_laikas']?>&nbsp;</td>
		<td style="background-color:#B8B6B6">&nbsp;<?=$row['Paslauga']?></td>
		<?php
		if ($row['Uzsakovo_tipas'] == 'privatus'){
			$result2 = PDO("SELECT * FROM klientai WHERE id = '".$row['Uzsakovas']."'", 'a' ); 
			foreach ($result2 as $row2){ ?>
				<td style="background-color:#B8B6B6">&nbsp;<?=$row2['vardas']." ".$row2['pavarde']?>&nbsp;</td>
				<td style="background-color:#B8B6B6">&nbsp;<?=$row2['tel_nr']?>&nbsp;</td>
			<?php }
		} else if ($row['Uzsakovo_tipas']=='imone'){
			$result2 = PDO("SELECT * FROM klientai_imones WHERE id = '".$row['Uzsakovas']."'", 'a' ); 
			foreach ($result2 as $row2){ ?>
				<td style="background-color:#B8B6B6">&nbsp;<?=$row2['pavadinimas']?>&nbsp;</td>
				<td style="background-color:#B8B6B6">&nbsp;<?=$row2['tel_nr']?>&nbsp;</td>
			<?php
			}
		}
		?>
		<td style="background-color:#B8B6B6">&nbsp;<?=$row['Bendra_suma']?></td>
		<?php
		if(!$result2){?>
			<td>-</td>
			<td>-</td>
		<?php 
		}
		?>
	<?php
	$nr++;

} else { ?>
	<tr>
 		<td style="background-color:#B8B6B6"
 			align='center' 
 			class='unsortable'>
 			<?=$nr?>
 		</td>
		<td style="background-color:#B8B6B6">&nbsp;<?=$row['Paraiskos_data']?> <?=$row['Paraiskos_laikas']?>&nbsp;</td>
		<td style="background-color:#B8B6B6">&nbsp;<?=$row['Paslauga']?></td>
		<?php
		if( $row['Uzsakovo_tipas'] == 'privatus' ) {
			$result2 = PDO("SELECT * FROM klientai WHERE id = '".$row['Uzsakovas']."'", 'a' ); 
			foreach ( $result2 as $row2 ){ ?> 
				<td style="background-color:#B8B6B6">&nbsp;<?=$row2['vardas']?> <?=$row2['pavarde']?>&nbsp;</td>
   			<?php } ?>
      		<td style="background-color:#B8B6B6">&nbsp;<?=$row['tel_nr']?></td>
      	<?php
		} elseif( $row['Uzsakovo_tipas'] == 'imone' ){
			$result2 = PDO("SELECT * FROM klientai_imones WHERE id = '".$row['Uzsakovas']."'", 'a' ); 
			foreach ($result2 as $row2) { ?>
      			<td style="background-color:#B8B6B6">&nbsp;<?=$row2['pavadinimas']?>&nbsp;</td>
   			<?php } ?>
      			<td style="background-color:#B8B6B6">&nbsp;<?=$row['tel_nr']?>&nbsp;</td>
		<?php }
		?>
		<td style="background-color:#B8B6B6">&nbsp;<?=$row['Bendra_suma']?></td>
		<?php
		if( !$result2 ){ ?>
			<td>-</td>
			<td>-</td>
		<?php } ?>
			</td>
		</tr> <?php
		$nr++;
		}
	} 
}
?>
</table>
<br>