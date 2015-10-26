<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index',$cat_id,$sub_id),array('class'=>'boton'));
echo '  ';
echo $this->Html->link('Ver reporte',array('action' => 'admin_ver',$id,$cat_id,$sub_id,'ext' => 'pdf'),array('target'=>'_blank','class'=>'boton'));
echo $this->Html->link('Editar',array('action' => 'admin_editar',$cat_id,$id,$sub_id),array('class'=>'boton')).$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$id,$cat_id,$sub_id),array('class'=>'boton'),'¿Estás seguro que deseas eliminar?');

echo $this->element('admin_ver_articulo');
?>

