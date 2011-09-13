<?php echo CHtml::ActiveTextField($model,'centroCostoFacultad'); ?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'departamento-form',
	'enableAjaxValidation'=>false,
)); ?>

		<?php echo $form->labelEx($model,'centroCostoFacultad'); ?>
		<?php echo CHtml::ActiveTextField($model,'centroCostoFacultad'); ?>
		<?php echo $form->error($model,'centroCostoFacultad'); ?>
	

<?php $this->endWidget(); ?>

