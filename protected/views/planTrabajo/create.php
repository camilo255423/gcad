<?php
$this->breadcrumbs=array(
	'PlanTrabajo'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Lista plan', 'url'=>array('index')),
	array('label'=>'Manage facultad', 'url'=>array('admin')),
);
?>

<h1>Crear Plan de Trabajo</h1>
<p>Seleccione la cedula o el nombre del Docente</p>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
