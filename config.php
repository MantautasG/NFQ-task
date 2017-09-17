<?php	 	 

ini_set('display_errors', 0);
//ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);
//error_reporting(E_ALL ^ E_DEPRECATED);


include_once("functions.php");
session_name("22g3creZ5yawabubrugafabua");
session_start();

$messages=array();

define("DBHOST", "eu-cdbr-west-01.cleardb.com");
define("DBUSER", "bf2381c596a840");
define("DBPASSWORD", "d408a0fa");
define("DBNAME", "heroku_5b4c176d326c33a");

/*DB*/
$dbhost="eu-cdbr-west-01.cleardb.com";
$dbuser="bf2381c596a840";
$dbpass="d408a0fa";
$dbname="heroku_5b4c176d326c33a";

$pvm_dydis = 21;


$rowsperpage = 15; // irasu per puslapi

if(!isset($_GET['action'		])) $_GET['action'		] = '';
if(!isset($_GET['find'  		])) $_GET['find'  		] = '';
if(!isset($_GET['field' 		])) $_GET['field' 		] = '';
if(!isset($_GET['page'  		])) $_GET['page'  		] = '';
if(!isset($_GET['link'  		])) $_GET['link'  		] = '';
if(!isset($_GET['err'   		])) $_GET['err'   		] = '';
if(!isset($_GET['search'		])) $_GET['search'		] = '';
if(!isset($_GET['asc'   		])) $_GET['asc'   		] = '';
if(!isset($_GET['vardas'		])) $_GET['vardas'  	] = '';
if(!isset($_GET['date'  		])) $_GET['date'   		] = '';
if(!isset($_GET['date_nuo'		])) $_GET['date_nuo'	] = '';

if(!isset($_GET['pavadinimas'	])) $_GET['pavadinimas'	] = '';
if(!isset($_GET['imones_kodas'	])) $_GET['imones_kodas'] = '';
if(!isset($_GET['pvm_kodas'		])) $_GET['pvm_kodas'	] = '';
if(!isset($_GET['pavarde'		])) $_GET['pavarde'		] = '';
if(!isset($_GET['adresas'		])) $_GET['adresas'		] = '';
if(!isset($_GET['tel_nr'		])) $_GET['tel_nr'		] = '';


if(!isset($_POST['vardas'		])) $_POST['vardas'		] = '';
if(!isset($_POST['date_nuo'		])) $_POST['date_nuo'	] = '';
if(!isset($_POST['date_iki'		])) $_POST['date_iki'	] = '';
if(!isset($_POST['date'			])) $_POST['date'		] = '';
if(!isset($_POST['field'		])) $_POST['field'		] = '';
if(!isset($_POST['find'			])) $_POST['find'		] = '';


if(isset($_GET['date_nuo']) && $_GET['date_nuo'] !== ''){
  setcookie("list_date_nuo", $_GET['date_nuo'], time() + (86400 * 30), "/");
}
if(isset($_GET['date']) && $_GET['date'] !== ''){
  setcookie("list_date", $_GET['date'], time() + (86400 * 30), "/");
}

?>
