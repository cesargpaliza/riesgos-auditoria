<style media="screen">
.marco {
width: 250;
height: 200px;
/*position: absolute;*/
left: 0;
right: 0;
margin: 0 auto;

}
.div-img {
  width: 150px;
display: block;
margin-left: auto;
margin-right: auto;
}
.div-img .img {
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 50%;
display: block;
margin-left: auto;
margin-right: auto;
width: 100%;
transform: scale(1);
-ms-transform: scale(1);
-moz-transform: scale(1);
-webkit-transform: scale(1);
-o-transform: scale(1);
-webkit-transition: all 500ms ease-in-out;
-moz-transition: all 500ms ease-in-out;
-ms-transition: all 500ms ease-in-out;
-o-transition: all 500ms ease-in-out;
}
.div-img .text {
padding-top: 5px;
display: block;
width: 100%;
text-align: center;
transform: translate(0px);
-webkit-transition: all 500ms ease-in-out;
-moz-transition: all 500ms ease-in-out;
-ms-transition: all 500ms ease-in-out;
-o-transition: all 500ms ease-in-out;
opacity: 0;
transition: transfom opacity 1.5s;
}
.div-img:hover .img {
transform: scale(0.8);
-ms-transform: scale(0.8);
-moz-transform: scale(0.8);
-webkit-transform: scale(0.8);
-o-transform: scale(0.8);
}
.div-img:hover .text {
transform: translate(0px, -20px);
opacity: 1;
}
</style>
<h4 class="text-center">Equipo de Desarrollo</h4>
<hr>
<div class="col-8 offset-2">
  <div class="row">

    <div class="col">
      <div class="marco">
        <div class="div-img" >
          <img class="img" src="<?php echo base_url("img/1.jpg"); ?>" title="integrante" alt="integrante">
          <div class="text">Alderete, Francisco<br>31018</div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="marco">
        <div class="div-img" >
          <img class="img" src="<?php echo base_url("img/5.jpg"); ?>" title="integrante" alt="integrante">
          <div class="text">Alicata, Alejandro<br>31026</div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="marco">
        <div class="div-img" >
          <img class="img" src="<?php echo base_url("img/4.jpg"); ?>" title="integrante" alt="integrante">
          <div class="text">Macedo, Alejandro<br>99999</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-6 offset-3">
  <div class="row">
    <div class="col">
      <div class="marco">
        <div class="div-img" >
          <img class="img" src="<?php echo base_url("img/2.jpg"); ?>" >
          <div class="text">Paliza, César<br>33321</div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="marco">
        <div class="div-img" >
          <img class="img" src="<?php echo base_url("img/3.jpg"); ?>" title="integrante" alt="integrante">
          <div class="text text-center">Perez, Gerardo<br>33304</div>
        </div>
      </div>
    </div>
  </div>
</div>
<hr>
<p class="text-center">Todos ellos son alumnos de la carrera Ingenieria en Sistemas de Información, FRT UTN.<br> © 2018 - Todos los Derechos Reservados ®</p>
