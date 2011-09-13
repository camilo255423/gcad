<?php
$this->breadcrumbs=array(
	'PlanTrabajo'=>array('index'),
	$model->documentoProfesor=>array('view','id'=>$model->documentoProfesor),
	'Update',
);

$this->menu=array(
	array('label'=>'List facultad', 'url'=>array('index')),
	array('label'=>'Create facultad', 'url'=>array('create')),
	array('label'=>'View facultad', 'url'=>array('view', 'id'=>$model->documentoProfesor)),
	array('label'=>'Manage facultad', 'url'=>array('admin')),
);
?>

<h1>Update planTrabajo <?php echo $model->documentoProfesor; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>