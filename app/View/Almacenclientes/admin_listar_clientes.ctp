<div class="wrap">
<h1>Clientes</h1>
<?php
echo '<div class="listado_categoria">';
	echo '<table id="tabla_clientes">';
		echo '<thead> <tr><td></td></tr>';
		echo '</thead>';
		echo '<tbody>';
		foreach ($clientes as $c) {
				echo '<tr><td>'. $this->Html->link($c['Cliente']['denominacion_legal'], array('action' => $action,'admin_index',$c['Cliente']['id'])). '</td></tr>';
		}
echo '</tbody>';
	echo '</table>';

	echo '</div>';
?>

</div>

<script type="text/javascript">
$(document).ready(function() {
     $('#tabla_clientes').DataTable( {
        "paging":   false,	
        "info":     false,
        "language": {
	        "sZeroRecords":   "No se encontraron resultados",
	        "sEmptyTable":    "Ningún dato disponible en esta tabla",
	        "sSearch":        "Buscar:",


	    },
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            $('td', nRow).css('background-color', '#E5E5E5');      
         }

        
    } );
      $('table.dataTable thead td').css('border-bottom', '#E5E5E5');
      $('table.dataTable.no-footer').css('border-bottom', '#E5E5E5');
});
     </script>

 <style type="text/css">
	.sorting, .sorting_asc, .sorting_desc {
    background : none !important;
}
 </style>