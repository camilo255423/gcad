<div id="dataPlanDesarrollo">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formDocencia',
	'enableAjaxValidation'=>true,
)); ?>

<!-- Proyectos Plan de desarrollo -->
<h4>4.14 Proyectos del Plan de Desarrollo</h4>
<table class="table">

		<tr class="tr">
		    <td rowspan=2 class="modo1">Código</td>
		    <td rowspan=2 width="190" class="modo1">Título</td>
	
		    <td rowspan=2 class="modo1">Proyecto Curricular</td>
		    <td rowspan=2 class="modo1">Centro de Costo</td>
		    <td rowspan=2 class="modo1">Horas</td>
 		</tr>
	
		<tr class="tr">
		<?php
			$num=count($models);
                        foreach ($models as $i=>$model)
                        {

                ?>
                                <tr>
				<td class="modo4"><?php if($model->codigoProyecto!=-2) echo $model->codigoProyecto;?> </td>
		    		<td class="modo3" width="130" height="60">
                                    <?php echo CHtml::ActiveHiddenField($model,"[$i]codigoProyecto"); ?>
                                    <?php $this->widget('zii.widgets.jui.CJuiAutoCompleteTextArea', array(
                                        'name'=>'mplandesarrollo'.$i,
                                            'value'=>$model->titulo,
                                        'source'=>$arr,
                                        // additional javascript options for the autocomplete plugin
                                        'options'=>array(
                                            'minLength'=>'1',
                                                    'select' => "js:function(event, ui){
                                                    document.getElementById('".CHtml::activeId($model,"[$i]codigoProyecto")."').value=ui.item.id;
                                             jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#dataPlanDesarrollo').replaceWith(html)}});return false;}"



                                        ),
                                        'htmlOptions'=>array(
                                            'style'=>'height:80px;'
                                        ),
                                    ));
                                    ?>
                                </td>
		    		
                                <td class="modo4"><?php if($i!=$num-1) echo $model->nombreProyectoCurricular;?></td>
		    		<td class="modo4"><?php echo $model->centroCostoPrograma;?></td>
		    		 <td class="modo4"><?php if($i!=$num-1) echo CHtml::activeTextField($model,"[$i]horas",array("size"=>2)); ?></td>
                                <td class="modo4"><?php if($i!=$num-1) echo CHtml::imageButton(Yii::app()->request->baseUrl.'/images/del.jpg',array("onclick"=>"document.getElementById('".CHtml::activeId($model,"[$i]codigoProyecto")."').value=-1;jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#dataPlanDesarrollo').replaceWith(html)}});return false;")); ?></td>
                                <td class="modo4"><?php echo $form->error($model,'horas',array('class'=>'ek')); ?>
                                <?php echo $form->error($model,'titulo',array('class'=>'ek')); ?></td>
                                </tr>

                                <?php
                                }
                                ?>
<?php $this->endWidget(); ?>

</table>
		

</div>
</div>



