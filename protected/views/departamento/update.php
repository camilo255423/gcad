<?php
$this->breadcrumbs=array(
	'Departamentos'=>array('index'),
	$model->centroCostoDepartamento=>array('view','id'=>$model->centroCostoDepartamento),
	'Update',
);

$this->menu=array(
	array('label'=>'List Departamento', 'url'=>array('index')),
	array('label'=>'Create Departamento', 'url'=>array('create')),
	array('label'=>'View Departamento', 'url'=>array('view', 'id'=>$model->centroCostoDepartamento)),
	array('label'=>'Manage Departamento', 'url'=>array('admin')),
);
?>

<h1>Update Departamento <?php echo $model->centroCostoDepartamento; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>