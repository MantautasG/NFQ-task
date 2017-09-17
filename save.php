<?php

include_once("config.php");
doCSS();

header('Content-Type: text/html; charset=utf-8');

include "kintamieji.php";

$atlikta_nuolaida="0.00";

$ip = $_SERVER['REMOTE_ADDR'];
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$ip .= ' (' . $_SERVER['HTTP_CLIENT_IP'] . ')';
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip .= ' (' . $_SERVER['HTTP_X_FORWARDED_FOR'] . ')';
}


$paraiskos_data = "$metai-$menuo-$diena";
$issaugojimo_data = date('Y-m-d H:i:s', isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time());
$key = '0';
$daliu_valiuta = $_POST['daliu_valiuta_euras'];



if (empty($metai)
	OR empty($menuo)
	OR empty($diena)
	OR empty($tel)
	OR empty($atlikta_darbai_aprasymas)
) {
	?>
	<script type="text/javascript">
		alert('Ne visi privalomi laukai yra užpildyti!');
		history.go(-1);
	</script>
<?php
	die;
}

	//TIKRINAME DB UZSAKOVO
	if ($uzsakovo_tipas == 'privatus') {

		$result = PDO("SELECT id FROM klientai WHERE vardas = '$vardas' AND pavarde='$pavarde'", 'a');

		$num_rows = count($result);

		//echo var_dump($result);
		//die();
		if ($result === FALSE) {
			throw new Exception('Nėra tokio kliento');
		}
		if ($num_rows > 0) {
			foreach($result as $row){
				$uzsakovo_id = $row['id'];
			}
		} else {

			$uzsakovo_id = PDO("INSERT INTO klientai (
               vardas,
               pavarde,
               tel_nr,
               aktyvus
            ) VALUES (
               :vardas,
               :pavarde,
               :tel,
               :skaicius
            )", 
            'i', array(
	            ":vardas" => $vardas,
	            ":pavarde" => $pavarde,
	            ":tel" => $tel,
	            ":skaicius" => '1'
	            ) );

		}

	} else {
		
		$result = PDO("SELECT id FROM klientai_imones WHERE imones_kodas = '$imones_kodas' AND pvm_kodas = '$pvm_kodas' AND pavadinimas = '$pavadinimas' AND adresas = '$adresas'", 'a');

		$num_rows = count($result);
		if ($result === FALSE) {
			throw new Exception('Neįmanoma gauti įmonės duomenų');
		}
		if ($num_rows > 0){
			foreach($result as $row){
				$uzsakovo_id=$row['id'];
			}
		} else {

			$uzsakovo_id = PDO("INSERT INTO klientai_imones (
               imones_kodas,
               pvm_kodas,
               pavadinimas,
               vardas,
               pavarde,
               adresas,
               tel_nr,
               aktyvus
            ) VALUES (
               :imones_kodas,
               :pvm_kodas,
               :pavadinimas,
               :vardas,
               :pavarde,
               :adresas,
               :tel,
               :skaicius
            )", 
            'i', array(
	            ":imones_kodas" => $imones_kodas,
	            ":pvm_kodas" => $pvm_kodas,
	            ":pavadinimas" => $pavadinimas,
	            ":vardas" => $vardas,
	            ":pavarde" => $pavarde,
	            ":adresas" => $adresas,
	            ":tel" => $tel,
	            ":skaicius" => '1'
	            ) );
		}
	}


	$paraiskos_nr = 1;
	//$result = mysql_fetch_assoc(mysql_query ("SELECT max(Paraiskos_nr) as max FROM paraiskos"));
	$result = PDO("SELECT max(Paraiskos_nr) as max FROM paraiskos", 'a');

	$num_rows = count($result);
	if($result>0){
		foreach($result as $row)
		$paraiskos_nr=$row['max']+1;	
	}

	$paraiskos_id = PDO("INSERT INTO paraiskos (
               Paraiskos_nr,
               Paraiskos_data,
               Paraiskos_laikas,
               Uzsakovas,
               Uzsakovo_tipas,
               Paslauga,
               Aktyvus,
               tel_nr,
               Bendra_suma
            ) VALUES (
               :Paraiskos_nr,
               :Paraiskos_data,
               :Paraiskos_laikas,
               :Uzsakovas,
               :Uzsakovo_tipas,
               :Paslauga,
               :Aktyvus,
               :tel_nr,
               :Bendra_suma
            )", 
            'i', array(
	            ":Paraiskos_nr" => $paraiskos_nr,
	            ":Paraiskos_data" => $paraiskos_data,
	            ":Paraiskos_laikas" => $laikas,
	            ":Uzsakovas" => $uzsakovo_id,
	            ":Uzsakovo_tipas" => $uzsakovo_tipas,
	            ":Paslauga" => $atlikta_darbai_aprasymas[$key],
	            ":Aktyvus" => '1',
	            ":tel_nr" => $tel,
	            ":Bendra_suma" => $atlikta_viso
	            ) );
?>
	<script language="JavaScript">
		alert('Užsakymas automobilio diagnostikai sėkmingai išsaugotas');
	</script>
<?php

?><meta http-equiv='refresh' content='0; url=index.php'><?php
