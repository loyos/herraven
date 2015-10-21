<div class="wrap">
<h2>Linea <?php echo $bano['Lineasgalvanica']['nombre']?></h2>
<div class="caja_izquierda">
<div style="float:right">
	<?php echo $this->Html->link('Insumos',array('controller'=>'inventariomateriasgalvanicas','action' => 'admin_egreso',$bano['Bano']['id']),array('class' => 'boton'))?>
</div>
<h1><?php echo $bano['Bano']['nombre']?></h1>
<?php echo $bano['Bano']['descripcion']?>
</div>
<div class = "caja_derecha">
<div class="cronometro" id = "cronometro">

<span id="horas"><?php echo  str_pad($bano['Bano']['horas'], 2, "0", STR_PAD_LEFT);?></span>:<span id="minutos"><?php echo str_pad($bano['Bano']['minutos'], 2, "0", STR_PAD_LEFT)?></span>:<span id="segundos"><?php echo str_pad($bano['Bano']['segundos'], 2, "0", STR_PAD_LEFT)?></span>
</div>
<input type="button" onclick="comenzar()" value="Comenzar" class="boton_accion"/>
<input type="button" onclick="detenerse()" value="Detenerse" class="boton_accion"/>
<input type="button" onclick="continuar()" value="Continuar" class="boton_accion"/>
<br>
<div style="font-weight: bold;float: left;margin-top: 10px;">
Tiempo estimado: <?php echo  str_pad($bano['Bano']['horas'], 2, "0", STR_PAD_LEFT);?>:<?php echo str_pad($bano['Bano']['minutos'], 2, "0", STR_PAD_LEFT)?>:<?php echo str_pad($bano['Bano']['segundos'], 2, "0", STR_PAD_LEFT)?>
</div>
</div>

</div>
<script>
$(document).ready(function() {
	horas=<?php echo $bano['Bano']['horas'];?>;
	minutos = <?php echo $bano['Bano']['minutos']?>;
	segundos = <?php echo $bano['Bano']['segundos']?>;
	var cronometro;
	status = "detenerse";
})

function continuar(){
	if (status != 'continuar') {
		status = 'continuar';
		carga();
	}
}

function comenzar(){
	if (status != "comenzar") {
		status = "comenzar";
		horas=<?php echo $bano['Bano']['horas'];?>;
		minutos = <?php echo $bano['Bano']['minutos']?>;
		segundos = <?php echo $bano['Bano']['segundos']?>;
		clearInterval(cronometro);
		var cronometro;
		carga();
	}
}

function carga() {
	document.getElementById('cronometro').style.background='green';
	cronometro = setInterval(
		function(){
		h = document.getElementById('horas');
		m = document.getElementById('minutos');
		s = document.getElementById('segundos');
			if (segundos == 0 && minutos == 0 && horas == 0) {
				detenerse();
			}
			if (segundos == 0 && minutos != 0) {
				segundos = 60;
				minutos=("0" + minutos).slice(-2);
				minutos = minutos - 1;
				m.innerHTML = minutos;
			}
			if (minutos == 0 && horas != 0) {
				minutos = 60;
				horas = horas - 1;
				minutos=("0" + minutos).slice(-2);
				horas=("0" + horas).slice(-2);
				m.innerHTML = minutos;
				h.innerHTML = horas;
			}
			segundos=("0" + segundos).slice(-2);  // devolverá "01" si h=1; "12" si h=12
			s.innerHTML = segundos;
			segundos = segundos-1;
		},
		1000
	);
}
function detenerse(){
	if (status != "detenerse") {	
		status = "detenerse";
		document.getElementById('cronometro').style.background='red';
		clearInterval(cronometro);
	}
}
</script>