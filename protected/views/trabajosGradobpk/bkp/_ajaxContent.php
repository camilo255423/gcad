<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'productos-form',
	'enableAjaxValidation'=>true,
)); ?>
<table>
<tr>
<td><th>codigo</th></td><td><th>T�tulo</th></td><td><th>noActa</th></td><td><th>Fecha</th></td><td><th>Centro de Costo</th></td><td><th>Nivel</th></td><td><th>Horas</th></td>
</tr>
<?php
$num=count($models);
foreach ($models as $i=>$model)
{

?>
<tr>

<td><th><?php if($model->codigoTrabajo!=-2) echo $model->codigoTrabajo;?> </th></td>


<td><th>
<?php echo CHtml::ActiveHiddenField($model,"[$i]codigoTrabajo"); ?>
<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'name'=>'m'.$i,
	'value'=>$model->titulo,
    'source'=>$arr,
    // additional javascript options for the autocomplete plugin
    'options'=>array(
        'minLength'=>'1',
		'select' => "js:function(event, ui){ 
		document.getElementById('".CHtml::activeId($model,"[$i]codigoTrabajo")."').value=ui.item.id;
	 jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajosGrado/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#data').replaceWith(html)}});return false;}"
				  
		
      
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>
</th></td>

<td><th><?php echo $model->noActa;?> </th></td>
<td><th><?php echo $model->fechaActa;?></th></td>
<td><th><?php echo $model->centroCostoPrograma;?></th></td>
<td><th><?php echo $model->nivel;?></th></td>
<td><th><?php if($i!=$num-1) echo CHtml::activeTextField($model,"[$i]horas",array("size"=>2)); ?></th></td>
<td><th><?php if($i!=$num-1) echo CHtml::imageButton(Yii::app()->request->baseUrl.'/images/del.jpg',array("onclick"=>"	document.getElementById('".CHtml::activeId($model,"[$i]codigoTrabajo")."').value=-1;jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajosGrado/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#data').replaceWith(html)}});return false;")); ?>
</th></td>
<td><th><?php echo $form->error($model,'horas',array('class'=>'ek')); ?>
<?php echo $form->error($model,'titulo',array('class'=>'ek')); ?>
</th></td>
</tr>

<?php
}
?>
<?php echo CHtml::submitButton('Guardar',array('name'=>'guardar','submit'=>'index.php?r=trabajosGrado/guardar')); ?>
<?php $this->endWidget(); ?>

</table>
</div>


