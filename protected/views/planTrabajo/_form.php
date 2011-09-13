<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'planTrabajo-form',
	'enableAjaxValidation'=>false,
)); 
?>

<!-- PLAN DE TRABAJO -->

<!-- BUSQUEDA DE DOCENTE -->
<table width="900"; style='border: 1px solid #0033FF;'>
	<caption align="top">
		<h2>Buscar Docente</h2>
		<p>Ingrese la c&eacute;dula o el peimer apellido del docente.</p>
	</caption>
	<tr style='background-color: #DDDDDD; text-align: center; font-weight: bold;'>
		<td width="160" height="50"><?php echo CHtml::activeLabel($model,'documentoProfesor'); ?></td>
		<?php echo CHtml::hiddenField("cedula", "-1"); ?>
		<td>
			<?php $this->widget('CAutoComplete',
				array(
				'model'=>$model,
				'id'=>'documentoProfesor',
				'name'=>CHtml::activeName($model, 'plantrabajo'),
				'url'=>array('findCedula'),
				'max'=>10,
				'minChars'=>1,
				'delay'=>300,
				'matchCase'=>true,
				'htmlOptions'=>array('size'=>'20'),
				'methodChain'=>'
     			   .result
        			(
            			function(event,item)
            			{
						      this.form.cedula.value=item[1];
	            		      this.form.submit();
            			}
        			)'
					,
					));
			?>
			
			<?php echo CHtml::hiddenField('documentoProfesor'); ?>
		</td>
		<?php echo CHtml::hiddenField("apellido", "-1"); ?>
		<td width="160"><?php echo CHtml::activeLabel($model,'apellido1'); ?></td>
		<td>
			<?php $this->widget('CAutoComplete',
				array(
				'model'=>$model,
				'id'=>'apellido1',
				'name'=>CHtml::activeName($model, 'planTrabajo'),
				'url'=>array('findNombre'),
				'max'=>10,
				'minChars'=>1,
				'delay'=>300,
				'matchCase'=>true,
				'htmlOptions'=>array('size'=>'20'),
				'methodChain'=>'
     			   .result
        			(
            			function(event,item)
            			{
						      this.form.apellido.value=item[1];
	            		      this.form.submit();
            			}
        			)'
					,
					));
			?>
			<?php echo CHtml::hiddenField('apellido1'); ?>
		</td>
	</tr>
</table>	
   
<?php $this->endWidget(); ?>

</div><!-- form -->


 