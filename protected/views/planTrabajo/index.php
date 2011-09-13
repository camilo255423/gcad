<?php
$this->breadcrumbs=array(
	'PlanTrabajo',
);

$this->menu=array(
	array('label'=>'Crear Plan de Trabajo', 'url'=>array('create')),
	array('label'=>'Modificar Plan de Trabajo', 'url'=>array('admin')),
);
?>

<h1>PlanTrabajo</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
