<?php
$this->breadcrumbs=array(
	'PlanTrabajo'=>array('index'),
	$model->documentoProfesor,
);

$this->menu=array(
	array('label'=>'List facultad', 'url'=>array('index')),
	array('label'=>'Create facultad', 'url'=>array('create')),
	array('label'=>'Update facultad', 'url'=>array('update', 'id'=>$model->documentoProfesor)),
	array('label'=>'Delete facultad', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->documentoProfesor),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage facultad', 'url'=>array('admin')),
);
?>

<h1>View planTrabajo #<?php echo $model->documentoProfesor; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'documentoProfesor',
	),
)); ?>
