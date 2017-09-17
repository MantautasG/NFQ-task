<?php

?>

<script>
$(document).ready(function(){
    $("#btn").click(function(){
        if($("#wrap").is(":visible")){
            $("#wrap").hide();
        }
        else{
            $("#wrap").show();
        }
    });
});
</script>

<link rel="stylesheet" type="text/css" href="css/styleMenu.css">

<a href=index.php>
        <div class="logotipas">
            <img src="yuzoolthemes.png"/>
        </div>
    </a> 

<div class="mobile_menu">
    <input id="btn" type="image" src="images/menu.jpg" width="30" height="30"/>
</div>

<div id="wrap">
           
	<ul class="navbar">
        <li><a href=new.php><p id="new"><img src="images/list2.png" width="32" height="32"/><font color="white">Naujas užsakymas</font></p></a></li>
        <li><a href=index.php><p id="list"><img src="images/list1.png" width="32" height="32"/><font color="white">Sąrašas</font></p></a></li>                    
    </ul>
</div>

<figure>
  <div class="face top"><p id="s"></p></div>
  <div class="face front"><p id="m"></p></div>
  <div class="face left"><p id="h"></p></div>
</figure>


<style>
@font-face {
  font-family: 'Digital-7';
  src: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/184191/Digital-7.eot?#iefix') format('embedded-opentype'),  url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/184191/Digital-7.woff') format('woff'), url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/184191/Digital-7.ttf')  format('truetype'), url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/184191/Digital-7.svg#Digital-7') format('svg');font-weight: normal;font-style: normal;}
::selection{background:#333;}::-moz-selection{background:#111;}
*,html{margin:0;}
body{background:#333}
figure{width:100px;height:100px;position:fixed; top:15px; right:15px;transform-style: preserve-3d;-webkit-transform-style: preserve-3d;-webkit-transform: rotateX(-35deg) rotateY(45deg);transform: rotateX(-35deg) rotateY(45deg);transition:2s;}
figure:hover{-webkit-transform:rotateX(-50deg) rotateY(45deg);transform:rotateX(-50deg) rotateY(45deg);}
.face{width:100px;height:100px;position:fixed; top:15px; right:15px;-webkit-transform-origin: center;transform-origin: center;background:#000;text-align:center;}
#s{font-size:90px;font-family: 'Digital-7';margin-top:20px;color:#2982FF;text-shadow:0px 0px 5px #000;-webkit-animation:color 10s infinite;animation:color 10s infinite;line-height:80px;}
#m{font-size:90px;font-family: 'Digital-7';margin-top:20px;color:#2982FF;text-shadow:0px 0px 5px #000;-webkit-animation:color 10s infinite;animation:color 10s infinite;line-height:80px;}
#h{font-size:90px;font-family: 'Digital-7';margin-top:20px;color:#2982FF;text-shadow:0px 0px 5px #000;-webkit-animation:color 10s infinite;animation:color 10s infinite;line-height:80px;}
.front{-webkit-transform: translate3d(0, 0, 50px);transform: translate3d(0, 0, 50px);background:#111;}
.left{-webkit-transform: rotateY(-90deg) translate3d(0, 0, 50px);transform: rotateY(-90deg) translate3d(0, 0, 50px);background:#151515;}
.top{-webkit-transform: rotateX(90deg) translate3d(0, 0, 50px);transform: rotateX(90deg) translate3d(0, 0, 50px);background:#222;}

@keyframes color{
  0%{color:#2982ff;text-shadow:0px 0px 5px #000;}
  50%{color:#cc4343;text-shadow:0px 0px 5px #ff0000;}
}
@-webkit-keyframes color{
  0%{color:#2982ff;text-shadow:0px 0px 5px #000;}
  50%{color:#cc4343;text-shadow:0px 0px 5px #ff0000;}
}
</style>

<script>
function date_time(id)
{
        date = new Date;
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        document.getElementById("s").innerHTML = ''+s;
        document.getElementById("m").innerHTML = ''+m;
        document.getElementById("h").innerHTML = ''+h;
        setTimeout('date_time("'+"s"+'");','1000');
        return true;
}
window.onload = date_time('s');
</script>
