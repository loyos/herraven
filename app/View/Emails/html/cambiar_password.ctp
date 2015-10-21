<?php
if (!empty($nombre) && !empty($apellido)) {
	$persona = $nombre.' '.$apellido;
} else {
	$persona = $username;
}
echo '<p>¡Hola '.$persona.'!</p>';
echo '<p>Tu nueva clave es: '.$clave.', recuerda que puedes cambiarla editando tu perfil</p>';
?>