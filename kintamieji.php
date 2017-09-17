<?php
include_once("config.php");
$paraiskos_nr =                empty($_POST["paraiskos_nr"]) ? ''                : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["paraiskos_nr"]);
$metai =                       empty($_POST["metai"]) ? ''                       : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["metai"]);
$menuo =                       empty($_POST["menuo"]) ? ''                       : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["menuo"]);
$diena =                       empty($_POST["diena"]) ? ''                       : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["diena"]);

$vardas =                      empty($_POST["vardas"]) ? ''                      : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["vardas"]);
$pavarde =                     empty($_POST["pavarde"]) ? ''                     : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["pavarde"]);
$adresas =                     empty($_POST["adresas"]) ? ''                     : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["adresas"]);
$tel =                         empty($_POST["tel"]) ? ''                         : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["tel"]);

$paraiskos_data= "$metai-$menuo-$diena";
$uzsakovas =                   empty($_POST["uzsakovas"]) ? ''                   : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["uzsakovas"]);
$adresas_tel =                 empty($_POST["adresas_tel"]) ? ''                 : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["adresas_tel"]);
$atlikta_viso =                empty($_POST["atlikta_viso"]) ? ''                : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["atlikta_viso"]);
$atlikta_darbai_aprasymas =    empty($_POST["atlikta_darbai_aprasymas"]) ? ''    : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["atlikta_darbai_aprasymas"]);
$viso =                        empty($_POST["viso"]) ? ''                        : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST["viso"]);
$pastabos =                    empty($_POST["pastabos"]) ? ''                    : htmlspecialchars($_POST["pastabos"]);
$uzsakovo_tipas=               empty($_POST['uzsakovo_tipas']) ? ''              : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST['uzsakovo_tipas']);
$pavadinimas=                  empty($_POST['imone']) ? ''                       : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST['imone']);

$imones_kodas=                 empty($_POST['kodas']) ? ''                       : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST['kodas']);
$pvm_kodas=                    empty($_POST['pvm_kodas']) ? ''                   : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST['pvm_kodas']);
$laikas=                       empty($_POST['valandos']) ? ''                    : str_replace(array("\"", "'"), array("&quot;", "&#39;"), $_POST['valandos']);
