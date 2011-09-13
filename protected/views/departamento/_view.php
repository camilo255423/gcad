<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('centroCostoDepartamento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->centroCostoDepartamento), array('view', 'id'=>$data->centroCostoDepartamento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('centroCostoFacultad')); ?>:</b>
	<?php echo CHtml::encode($data->centroCostoFacultad); ?>
	<br />


</div>