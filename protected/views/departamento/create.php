<?php
$this->breadcrumbs=array(
	'Departamentos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Departamento', 'url'=>array('index')),
	array('label'=>'Manage Departamento', 'url'=>array('admin')),
);
?>

<h1>Create Departamento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>