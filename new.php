<?php
include_once("header.php");

?>
<script type='text/javascript'>


//ISJUNGIAM ENTER KLAVISA FORMUOSE
function stopRKey(event) {
  event = event || window.event
  var node = event.target || event.srcElement || {type: 'none'};
  if ((event.keyCode == 13) && (node.type == 'text'))  {
    return false
  }
}

document.onkeypress = stopRKey;

//BENDRA SUMA
  $(function() {
    var price1 = $("#atlikta_viso").val();
    var bendra = Number(price1);
    console.log(price1);
    $("#viso").val(bendra);
  });

//UZSAKOVAS
//IMONES
$(function() {
    $( "#imone" ).autocomplete({
      source: "inc/uzsakovas/search_imone.php",
      select: function(event, ui) {
          document.getElementById("imone").value= ui.item.pavadinimas;
          document.getElementById("kodas").value= ui.item.imones_kodas;
          document.getElementById("pvm_kodas").value= ui.item.pvm_kodas;
          document.getElementById("adresas").value= ui.item.adresas;
          document.getElementById("tel").value= ui.item.tel_nr;
          //document.getElementById("apm_salyga").value = ui.item.apm_salyga;
      }

    });

});

//PRIVATUS
$(function() {
  $( "#vardas" ).autocomplete({
    source: "inc/uzsakovas/search_privatus.php",
    select: function(event, ui) {
      document.getElementById("vardas").value= ui.item.vardas;
      document.getElementById("pavarde").value= ui.item.pavarde;
     // document.getElementById("adresas").value= ui.item.adresas;
      document.getElementById("tel").value= ui.item.tel_nr;
    }
  });
});

$('#ats_data').datepicker({ dateFormat:'yy-mm-dd',lang:'lt'});


</script>
<script type="text/javascript">
function addRow(tableID) {
    
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    var max_darbai = 998;
    var max_darbai_value = 999;
    var max_detales = 998;
    var max_detales_value = 999;

     if (rowCount > max_darbai && tableID=="uzsakovas"){
      alert('Daugiau įrašų į darbų lentelę negalima pridėti!\nMaksimalus įrašų kiekis: '+ max_darbai_value);
    }

else{
      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;
     var row = table.insertRow(rowCount);

      var colCount = table.rows[0].cells.length;

      for(var i=0; i<colCount; i++) {

          var newcell = row.insertCell(i);
         
          
          if(tableID == "uzsakovas"){
            if (i == 0 ){newcell.width = "25";}
            if (i == 1 ){newcell.width = "";}
            if (i == 2 ){newcell.width = "70";}
            if (i == 3 ){newcell.width = "90";}
            if (i == 4 ){newcell.width = "70";}
            if (i == 5 ){newcell.width = "70";}
            if (i == 6 ){newcell.width = "70";}
          }
          newcell.align = "center";
          newcell.innerHTML = table.rows[0].cells[i].innerHTML;

          var rrr = newcell.childNodes.length;
          for(var ir=0; ir<rrr; ir++) {
            switch(newcell.childNodes[ir].nodeName) {
                case "P":
                        newcell.childNodes[ir].nodeValue = "";
                        break;
            }
            switch(newcell.childNodes[ir].type) {
               case "text":
                       newcell.childNodes[ir].value = "";
                        break;
                case "checkbox":
                        newcell.childNodes[ir].checked = false;
                        break;
                case "select-one":
                        newcell.childNodes[ir].selectedIndex = 0;
                        break;
                case "hidden":
                        newcell.childNodes[ir].value = "";
                        break;
            }
        }
      }
    }
}

function deleteRow(tableID) {
    try {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        //console.log(row.cells[0].childNodes[0]);
        if(null != chkbox && true == chkbox.checked) {
            if(rowCount <= 1) {
                alert("Negalima ištrinti visų įrašų.");
                break;
            }
            table.deleteRow(i);
            rowCount--;
            i--;
        }
    }
    }catch(e) {
        alert(e);
    }
}


//PASLAUGOS
$(function() {
   $("input.atlikta_kiekis").live("change", function() { 
    var kiekis = $( this ).val();
    var kaina = $(this).parent().next().find('input.atlikta_vnt_k').val();
    var ar_kaina_su_pvm=$(this).parent().next().find('input.atlikta_pvm_kaina').val(); 
    var kiekis = Number(kiekis.replace(",","."));
    var kaina = Number(kaina.replace(",","."));
    var ar_kaina_su_pvm = Number(ar_kaina_su_pvm.replace(",","."));
      if(ar_kaina_su_pvm==0){
        var bendra = (kaina*((100)/100)) * kiekis;
        var bendra_be_nuol = kaina;
        var pvm = 0;
      } else {
        var bendra = ((kaina*((100)/100))* (1+ar_kaina_su_pvm/100) * kiekis);
        var bendra_be_nuol = kaina*(1+ar_kaina_su_pvm/100);
        var pvm=((kaina*((100)/100)) * kiekis)*(ar_kaina_su_pvm/100);
      }

      var bendra_po_nuolaid=bendra;
    $(this).parent().next()
    .next().children('input').val(pvm.toFixed(2)).parent()
    .next().children('input').val(bendra_be_nuol.toFixed(2)).parent()
    .next().children('input').val(bendra_po_nuolaid.toFixed(2))
    .end();

  }); 
});
$(function() {
  $("input.atlikta_vnt_k").live("change", function() { 
    var kaina = $( this ).val();
    var kiekis = $(this).parent().prev().children('input').val();
    var ar_kaina_su_pvm=$(this).next().val(); 
    var kiekis = Number(kiekis.replace(",","."));
    var kaina = Number(kaina.replace(",","."));
    var ar_kaina_su_pvm = Number(ar_kaina_su_pvm.replace(",","."));
      if(ar_kaina_su_pvm==0){
        var bendra = (kaina*((100)/100)) * kiekis;
        var bendra_be_nuol = kaina;
        var pvm = 0;
      } else {
        var bendra = ((kaina*((100)/100))* (1+ar_kaina_su_pvm/100) * kiekis);
        var bendra_be_nuol = kaina*(1+ar_kaina_su_pvm/100);
        var pvm=((kaina*((100)/100)) * kiekis)*(ar_kaina_su_pvm/100);
      }

      var bendra_po_nuolaid=bendra;
    $(this).parent()
    .next().children('input').val(pvm.toFixed(2)).parent()
    .next().children('input').val(bendra_be_nuol.toFixed(2)).parent()
    .next().children('input').val(bendra_po_nuolaid.toFixed(2))
    .end();

  }); 


  $("input.atlikta_pvm_kaina").live("change", function() { 

    var kaina = $(this).prev().val();
    var kiekis = $(this).parent().prev().children('input').val();
    var ar_kaina_su_pvm=$(this).val();
    var kiekis = Number(kiekis.replace(",","."));
    var kaina = Number(kaina.replace(",","."));
    var ar_kaina_su_pvm = Number(ar_kaina_su_pvm.replace(",","."));

      if(ar_kaina_su_pvm==0){
        var bendra = (kaina*((100)/100)) * kiekis;
        var bendra_be_nuol = kaina;
        var pvm = 0;
      } else {
        var bendra = ((kaina*((100)/100))* (1+ar_kaina_su_pvm/100) * kiekis);
        var bendra_be_nuol = kaina*(1+ar_kaina_su_pvm/100);
        var pvm=((kaina*((100)/100)) * kiekis)*(ar_kaina_su_pvm/100);
      }

      var bendra_po_nuolaid=bendra;


    $(this).parent().next()
    .next().children('input').val(pvm.toFixed(2)).parent()
    .next().children('input').val(bendra_be_nuol.toFixed(2)).parent()
    .next().children('input').val(bendra_po_nuolaid.toFixed(2))
    .end();

  }); 


  $("input.atlikta_suma_bendra").live("input", function() { 

    var suma = $(this).val();
    var kaina_pvm = $(this).parent().prev().prev().prev().prev().find('.atlikta_pvm_kaina').val();
    var kiekis = $(this).parent().prev().prev().prev().prev().prev().children('input').val(); 
    
    var kiekis = Number(kiekis.replace(",","."));
    var kaina_pvm = Number(kaina_pvm.replace(",","."));
    var suma = Number(suma.replace(",","."));

    if(kaina_pvm==0){
      var kaina = suma / kiekis;
      var bendra = (kaina*((100)/100)) * kiekis;
      var bendra_be_nuol = kaina * kiekis;
      var pvm = 0;
      var vnt_sum = kaina;
    } else {
      var kaina = suma / (1+kaina_pvm/100) / kiekis;
      var bendra = (kaina*((100)/100)) * kiekis;
      var bendra_be_nuol = kaina * kiekis;
      var pvm = suma - (kaina * kiekis);
      var vnt_sum = suma / kiekis;
    }

      kaina = kaina * (100)/100;
      pvm = (kaina * kiekis) * (kaina_pvm/100);
     
    $(this).parent()
    .prev().children('input').val(vnt_sum.toFixed(2)).parent()
    .prev().children('input').val(pvm.toFixed(2)).parent()
    .prev().prev().find('input.atlikta_vnt_k').val(kaina.toFixed(2)).parent()
    .end();
  }); 

});

var tid = setTimeout(suma1, 200);
function suma1() {
  var ilgis = $("input.atlikta_suma_bendra").parent().parent().parent().children().length;
  //debugger;
  //console.log(ilgis);
  var parent = $("input.atlikta_suma_bendra").parent().parent().parent().children().children();
 // console.log(parent);
  var i = 0;
  var bendra_suma=0;
  while( i < ilgis){
    bendra_suma += Number(parent.next().next().next().next().next().next().children().val());
    parent=parent.parent().next().children();
    i++;
  }
 // console.log(bendra_suma);
  $("#atlikta_viso").val(bendra_suma.toFixed(2));
  var tid = setTimeout(suma1, 200);
}

var tid3 = setTimeout(suma3, 200);
function suma3() {

  var ilgis = $("input.atlikta_suma").parent().parent().parent().children().length;
  var parent = $("input.atlikta_suma").parent().parent().parent().children().children();
  var i = 0;
  var suma_be_nuolaidos=0;
  var pvm =0;
  while( i < ilgis){
    suma_be_nuolaidos += Number(parent.next().next().next().next().next().children().val());
    pvm += Number(parent.next().next().next().next().children().val());
    parent=parent.parent().next().children();
    i++;
   // debugger;
  //  console.log(pvm);
  }

  var suma1 = $("#atlikta_viso").val();
  var bendrai = Number(suma1);
  $("#viso_be_nuolaidos").val(suma_be_nuolaidos.toFixed(2));
  $("#viso_pvm").val(pvm.toFixed(2));
  $("#viso").val(bendrai.toFixed(2));

  var tid3 = setTimeout(suma3, 200);
}

function rodymas(){
  var tipas = document.getElementById("uzsakovo_tipas").value;
  if (tipas == "privatus") {
    $( ".imonesTR" ).hide();
    $( ".Privatus").show();
  } else {
    $( ".imonesTR" ).show();
    $( ".Privatus").hide();
  }
}

$(function() {
  var tipas = document.getElementById("uzsakovo_tipas").value;
  if (tipas == "privatus") {
    $( ".imonesTR" ).hide();
    $( ".Privatus").show();
  } else {
    $( ".imonesTR" ).show();
    $( ".Privatus").hide();
  }
  $("#uzsakovo_tipas").live("change", function() {
    var tipas = document.getElementById("uzsakovo_tipas").value;
    if (tipas == "privatus") {
    $(".imonesTR").hide();
    $(".Privatus").show().attr('required');

  } else {
    $( ".imonesTR" ).show();
    $( ".Privatus").hide().removeAttr('required');
  }
  });
});


function validateForm() {
    var x1 = document.forms["blankas"]["metai"].value;
    var x2 = document.forms["blankas"]["menuo"].value;
    var x3 = document.forms["blankas"]["diena"].value;
    var uzsakovo_tipas = document.forms["blankas"]["uzsakovo_tipas"].value;

    var x4 = document.forms["blankas"]["imone"].value;
    var x5 = document.forms["blankas"]["kodas"].value;

    var x6 = document.forms["blankas"]["vardas"].value;
    var x7 = document.forms["blankas"]["pavarde"].value;
    var x8 = document.forms["blankas"]["tel"].value;

    if (uzsakovo_tipas=='imone'){
      if ((x1==null || x1=="") 
        || (x2==null || x2=="") 
        || (x3==null || x3=="") 
        || (x4==null || x4=="")
        || (x5==null || x5=="")
        || (x8==null || x8=="") ) {
          alert("Ne visi privalomi laukai yra užpildyti!");
          return false;
      }
    } else {
      if ( (x1==null || x1=="") 
        || (x2==null || x2=="") 
        || (x3==null || x3=="")  
        || (x6==null || x6=="") 
        || (x8==null || x8=="")   ) {
          alert("Ne visi privalomi laukai yra užpildyti!");
          return false;
      }
    }
}


</script>


<div align="center">
<table cellspacing="2" cellpadding="10" align="center" width="600">
  <tr>
    <td valign="top">
      <form id="blankas"
            accept-charset="utf-8" 
            name="blankas" 
            action="save.php" 
            method="post" 
            onsubmit="return validateForm()">
        <input type="hidden" 
               name="daliu_valiuta_euras" 
               value="<?=$paraiskos_vedamos_eurais!='1' ? '0' : '1'?>">
        <table border="0" 
               width="100" 
               class="font">
          <!-- virsus -->
          <!-- kaire lenteles puse -->
          <tr>
            <td width="400">
              <!-- vidurys -->
              <br>
              <table border="0" class="font">
      		      <tr>
                  <td colspan="3" align="left" width="400">
                    <font color="white">Teikiama aukščiausio lygio automobilių diagnostikos paslaugas visiems modeliams už prieinamą kainą, esame sukaupę daugiametę patirtį! Dėl platesnės informacijos rašykite nurodytu el. pašto adresu.</font>
                  </td>
                </tr>
              </table>
            </td>
            <!-- desine lenteles puse -->
            <td valign="top">
              <table style="width: 400px;" 
                     border="0" 
                     class="font">
				        <tr>
               <td align="right"><b style="color:white">PREKĖS/PASLAUGOS UŽSAKYMO NR.</b></td>
                  <td>
                    <input type="text"
                           width="50px" 
                           size="6" 
                           name="paraiskos_nr" 
                           value=<?php                              

                              $result_new = PDO("SELECT MAX(Paraiskos_nr) as numeris FROM paraiskos ", 'a', null); 
                              foreach ($result_new as $row) {
                                  echo $row['numeris']+1;
                              }?> 
                              >
                  </td>
				        </tr>
        				<tr>
                  <td colspan="2" 
                      align="center">
                    <b style="color:white">Metai </b>
                    <b style="color:#FF0000">*</b>
			              <select name="metai" style="background-color:#B8B6B6;">
                    <?php for ($i = 2016; $i < 2023; ++$i) { ?>
                        <option value="<?=$i?>"<?=date('Y')== $i ? ' selected' : ''?>><?= $i ?></option>
                    <?php } ?>
			              </select> 
                    <b style="color:white">mėn. </b><b style="color:#FF0000">*</b>
            				<select name="menuo" style="background-color:#B8B6B6;">
            					<option value="01" <?=date('m')=="01" ? ' selected' : ''?>>Sausis</option>
            					<option value="02" <?=date('m')=="02" ? ' selected' : ''?>>Vasaris</option>
            					<option value="03" <?=date('m')=="03" ? ' selected' : ''?>>Kovas</option>
            					<option value="04" <?=date('m')=="04" ? ' selected' : ''?>>Balandis</option>
            					<option value="05" <?=date('m')=="05" ? ' selected' : ''?>>Gegužė</option>
            					<option value="06" <?=date('m')=="06" ? ' selected' : ''?>>Birželis</option>
            					<option value="07" <?=date('m')=="07" ? ' selected' : ''?>>Liepa</option>
            					<option value="08" <?=date('m')=="08" ? ' selected' : ''?>>Rugpjūtis</option>
            					<option value="09" <?=date('m')=="09" ? ' selected' : ''?>>Rugsėjis</option>
            					<option value="10" <?=date('m')=="10" ? ' selected' : ''?>>Spalis</option>
            					<option value="11" <?=date('m')=="11" ? ' selected' : ''?>>Lapkritis</option>
            					<option value="12" <?=date('m')=="12" ? ' selected' : ''?>>Gruodis</option>
            				</select>
 					          <b style="color:white">d.</b><b style="color:#FF0000">*</b>
          					<select name="diena" style="background-color:#B8B6B6;">
                    <?php for($i = 1; $i <= 31; $i++){
                      $day = sprintf('%02d',$i); ?>
            					<option value="<?=$day?>" <?=date('d')== $day ? ' selected' : ''?>><?=$day?></option>
                    <?php } ?>
          				  </select>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" 
                      width="100%" 
                      align="center">
                    <b style="color:white">Laikas: </b>
                    <input placeholder="HH:mm" 
                           size="4" 
                           name="valandos" 
                           id="valandos"
                           style="background-color:#B8B6B6;" 
                           value=<?="'".date("H:i")."'";?>>
                  </td>
                </tr>
				        <tr>
                  <td colspan="2">
                    <table width="100%" 
                           border="0" 
                           class="font">
						          <tr>
                        <td>
                          <br><b style="color:white">Užsakovas:</b> <b style="color:#FF0000">*</b>
                        </td>
                        <td>
                          <select id="uzsakovo_tipas" 
                                  style="background-color:#B8B6B6;"
                                  name="uzsakovo_tipas">
                            <option value="privatus" selected>Privatus</option>
                            <option value="imone">Imonė</option>
                          </select>
                        </td>
						          </tr>
                      <tr class="imonesTR">
                      <td>
                        <b style="color:white">Įmonės pav.: </b><b style="color:#FF0000">*</b>
                      </td>
                      <td>
                        <input type="text" 
                               size="35" 
                               name="imone" 
                               id="imone">
                      </td>
                    </tr>
                    <tr class="imonesTR">
                      <td>
                        <b style="color:white">Įmonės kodas: </b>
                      </td>
                      <td>
                        <input type="text" 
                               size="35" 
                               name="kodas" 
                               id="kodas">
                      </td>
                    </tr>
                    <tr class="imonesTR">
                      <td>
                        <b style="color:white">PVM kodas: </b>
                      </td>
                      <td>
                        <input type="text" 
                               size="35" 
                               name="pvm_kodas" 
                               id="pvm_kodas">
                      </td>
                    </tr>
        						<tr class="Privatus">
        							<td>
        								<b style="color:white">Vardas: </b><b style="color:#FF0000">*</b>
        							</td>
        							<td>
        								<input type="text" 
                               size="35" 
                               name="vardas" 
                               id="vardas">
        							</td>
        						</tr>
        						<tr class="Privatus">
        							<td>
        								<b style="color:white">Pavardė: </b>
        							</td>
        							<td>
        								<input type="text" 
                               size="35" 
                               name="pavarde" 
                               id="pavarde">
        							</td>
        						</tr>
                    <tr class="imonesTR">
                      <td>
                        <b style="color:white">Adresas: </b><b style="color:#FF0000">*</b>
                      </td>
                      <td>
                        <input type="text" 
                               size="35" 
                               name="adresas" 
                               id="adresas">
                      </td>
                    </tr>
        						<tr>
        							<td>
        								<b style="color:white">Tel.nr.: </b><b style="color:#FF0000">*</b>
        							</td>
        							<td>
        								<input type="number" 
                               size="35"
                               name="tel" 
                               id="tel">
        							</td>
        						</tr>
        					</table>
        				</td>
              </tr>
		        </table>
	         </td>
          </tr>
          <!-- virsaus pabaiga -->
          <!-- atiliktu darbu lenteles pradzia -->
          <tr>
            <td colspan="2">
              <font color="white">Žemiau esančiame lauke pavadinimu - Prekės/Paslaugos pav. įveskite automobilio markę, kuriam norite, kad būtų suteikta diagnostikos paslauga, taip pat įveskitę norimą kiekį, kiti duomenys bus apskaičiuoti!!!!</font>
              <table width="100%" 
                     border="0" 
                     class="visos font">
                <tr>
          				<td align="center" 
                      width="25px" 
                      style="border-bottom:1px solid gray;
                             border-right:1px solid gray;">
                    <img src="images/delete.png" width="20">
                  </td>
                  <td align="center" width="300px">
                    <b style="color:white">Prekės/Paslaugos pav.</b>
                  </td>
                  <td align="center" 
                      width="80px">
                    <b style="color:white">Kiekis</b>
                  </td>
                  <td align="center" 
                      width="90px">
                    <b style="color:white">Vnt./Val. kaina</b>
                  </td>
                  <td align="center" 
                      width="70px">
                    <b style="color:white">PVM</b>
                  </td>        
                  <td align="center" 
                      width="70px">
                    <b style="color:white">Suma, vnt su PVM</b>
                  </td>
                  <td align="center" 
                      width="70px">
                    <b style="color:white">Bendra suma/Su PVM</b>
                  </td>
                </tr>
		          </table>
		          <table width="100%" 
                     border="0" 
                     class="visos font" 
                     id="uzsakovas">
                <tr>
				          <td align="center" width="25px"><INPUT type="checkbox" name="chk"/></td>

                  <td align="center" width="300px">
                    <textarea rows="1" 
                              style="width:98%; background-color:#B8B6B6" 
                              name="atlikta_darbai_aprasymas[]" 
                              class="atlikta_darbai_aprasymas"
                              id="atlikta_darbai_aprasymas"></textarea>
                  </td>
                  <td align="center" 
                      width="70px">
                    <input type="text" 
                           size="4" 
                           name="atlikta_kiekis[]"
                           class="atlikta_kiekis"
                           id="atlikta_kiekis">        
                  </td>
                  <td align="center" 
                      width="90px">
                    <input type="text" 
                           size="6" 
                           name="atlikta_vnt_k[]"
                           class="atlikta_vnt_k"
                           id="atlikta_vnt_k"
                           value="15.00"> 
                    <input style="width: 4em; display: none" 
                           type="number" 
                           name="atlikta_pvm_kaina[]" 
                           min="0" 
                           id="atlikta_pvm_kaina" 
                           class="atlikta_pvm_kaina" 
                           value="21">
                  </td> 
                  <td align="center" 
                      width="70px">
                    <input style="width:80%" 
                           type="text" 
                           size="6" 
                           name="atlikta_pvm[]"  
                           class="atlikta_pvm" 
                           id="atlikta_pvm" 
                           readonly>
                  </td>
                  <td align="center" 
                      width="70px">
                    <input style="width:80%" 
                           type="text" 
                           size="6" 
                           name="atlikta_suma[]"  
                           id="atlikta_suma" 
                           class="atlikta_suma" 
                           readonly="">
                  </td>
                  <td align="center" 
                      width="70px">
                    <input style="width:80%" 
                           type="text" 
                           size="6" 
                           name="atlikta_suma_bendra[]"
                           id="atlikta_suma_bendra"
                           class="atlikta_suma_bendra">
                  </td>
          			</tr>
          		</table>
            </td>
          </tr>
          <tr>
            <td>
            	<input type="button" 
                     value="Pridėti įrašą" 
                     onclick="addRow('uzsakovas')" />
            	<input type="button" 
                     value="Ištrinti įrašą" 
                     onclick="deleteRow('uzsakovas')" />
            </td>
          </tr>
          <tr>
            <td colspan="3" 
                align="right"><font color="white">Viso už atliktus darbus</font> 
              <input type="text" 
                     size="6" 
                     name="atlikta_viso" 
                     id="atlikta_viso" 
                     readonly>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <font color="white">Kol kas yra tik mygtukų funkcionalumas(Pridėti/Ištrinti įrašą), keliant kelis įrašus nesuveiks, pagal užduotį buvo pasakyta tik viena prekė, tad pradžioje palikau taip</font>
            </td>
          </tr>
      	
          <!-- atliktu darbu lenteles pabaiga -->
        <!-- uzsakovo perduotu detaliu lenteles pradzia -->
      	<tr>
          <td colspan="2">
            <br><b style="color:white">Pastabos ir rekomendacijos:</b>
          </td>
        </tr>
      	<tr>
          <td colspan="2">
      		  <table width="100%" 
                   border="0"
                   class="visos font">
              <tr>
      				  <td>
                  <textarea rows="5" 
                            cols="105" 
                            id="pastabos"
                            style="background-color:#B8B6B6;" 
                            name="pastabos"></textarea>
                </td>
              </tr>
      		  </table>
          </td>
        </tr>
        <!-- apacios pabaiga -->
      	<tr>
      		<td align="center">
            <br>
            <br>
            <input type="submit" 
                   value="IŠSAUGOTI" 
                   style="height: 30px; 
                          width: 200px">
          </td>
      		<td align="right">
            <br>
            <br>
            <input type="reset" 
                   value="Išvalyti formą" 
                   style="height: 30px; 
                          width: 200px">
          </td>
        </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
</div>
<?php include_once("footer.php");