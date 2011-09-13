<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentoProfesor')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->documentoProfesor), array('view', 'id'=>$data->documentoProfesor)); ?>
	<br />

</div>