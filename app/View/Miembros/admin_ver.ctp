<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
echo '<br><br>';
echo $this->Html->link('Ver reporte',array('action' => 'admin_ver',$id,'ext' => 'pdf'),array('target'=>'_blank','class' => 'boton'));
echo $this->element('admin_ver_miembro');
?>
</div>
