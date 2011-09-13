<div id="data">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'productos-form',
	'enableAjaxValidation'=>true,
)); ?>

<!-- 2.1 DIRECCION DE TRABAJOS DE GRADO -->
<h4>DIRECCION DE TRABAJOS DE GRADO</h4>
<table class="table">

		<tr class="tr">
		    <td rowspan=2 class="modo1">Código</td>
		    <td rowspan=2 width="190" class="modo1">Título</td>
		    <td colspan=2 class="modo1">Acta</td>
		    <td rowspan=2 class="modo1">Proyecto Curricular</td>
		    <td rowspan=2 class="modo1">Centro de Costo</td>
		    <td rowspan=2 class="modo1">Nivel</td>
		    <td rowspan=2 class="modo1">Horas</td>
 		</tr>
		<tr class="tr">
			<td class="modo1">Acta No</td>
			<td class="modo1">Fecha Acta</td>
		</tr>
		<tr class="tr">
		<?php
			$num=count($models);
                        foreach ($models as $i=>$model)
                        {

                ?>
                                <tr>
				<td class="modo4"><?php if($model->codigoTrabajo!=-2) echo $model->codigoTrabajo;?> </td>
		    		<td class="modo3" width="130" height="60">
                                    <?php echo CHtml::ActiveHiddenField($model,"[$i]codigoTrabajo"); ?>
                                    <?php $this->widget('zii.widgets.jui.CJuiAutoCompleteTextArea', array(
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
                                            'style'=>'height:80px;'
                                        ),
                                    ));
                                    ?>
                                </td>
		    		<td class="modo3"><?php echo $model->noActa;?></td>
		    		<td class="modo3"><?php echo $model->fechaActa;?> </td>
                                <td class="modo4"><?php if($i!=$num-1) echo $programas[$i];?></td>
		    		<td class="modo4"><?php echo $model->centroCostoPrograma;?></td>
		    		<td class="modo3"><?php echo $model->nivel;?> </td>
		    		<td class="modo4"><?php if($i!=$num-1) echo CHtml::activeTextField($model,"[$i]horas",array("size"=>2)); ?></td>
                                <td class="modo4"><?php if($i!=$num-1) echo CHtml::imageButton(Yii::app()->request->baseUrl.'/images/del.jpg',array("onclick"=>"	document.getElementById('".CHtml::activeId($model,"[$i]codigoTrabajo")."').value=-1;jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajosGrado/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#data').replaceWith(html)}});return false;")); ?></td>
                                <td class="modo4"><?php echo $form->error($model,'horas',array('class'=>'ek')); ?>
                                <?php echo $form->error($model,'titulo',array('class'=>'ek')); ?></td>
                                </tr>

                                <?php
                                }
                                ?>
<?php echo CHtml::submitButton('Guardar',array('name'=>'guardar','submit'=>'index.php?r=trabajosGrado/guardar')); ?>
<?php $this->endWidget(); ?>

</table>
		<!-- TOTAL HORAS TRABAJOS DE GRADO -->

</div>


