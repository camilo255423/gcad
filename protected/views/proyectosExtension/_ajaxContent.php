<?php $num=count($models); ?>
<script type="text/javascript">
    sumarHoras();
function sumarHorasExtension()
{
    suma=0;
     <?php for($z=0;$z<$num-1;$z++){ ?>
        <?php echo "valor=document.getElementById('ProfesorExtension_".$z."_horas').value;" ?>
        if((String(valor).search(/^\d+$/) != -1))
        {
         suma=suma+parseFloat(valor);
        }
       <?php } ?>
           document.getElementById('horasExtension').innerHTML=suma;
    return suma;
}
</script>

<div id="dataExtension">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formExtension',
	'enableAjaxValidation'=>true,
)); ?>
<?php echo CHtml::hiddenField("documentoProfesor",$this->documentoProfesor); ?>

<!-- EXTENSION -->
<h3>3. Actividades de Extensión</h3>
<table class="table">

		<tr class="tr">
		    <td rowspan=2 class="modo1">Código</td>
		    <td rowspan=2 width="440" class="modo1">Título</td>
		    <td colspan=2 width="80" class="modo1">Acta Consejo de Facultad</td>
		    <td rowspan=2 class="modo1">Proyecto Curricular</td>
		    <td rowspan=2 class="modo1">Centro de Costo</td>
		    <td rowspan=2 class="modo1" width="50" >Horas</td>
                    <td rowspan=2 class="modo2" width="30"></td>
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
				<td class="modo4"><?php if($model->codigoActividadExtension!=-2) echo $model->codigoActividadExtension;?> </td>
		    		<td class="modo3" width="130" height="60">
                                    <?php echo CHtml::ActiveHiddenField($model,"[$i]codigoActividadExtension"); ?>
                                    <?php $this->widget('zii.widgets.jui.CJuiAutoCompleteTextArea', array(
                                        'name'=>'mextension'.$i,
                                            'value'=>$model->titulo,
                                        'source'=>$arr,
                                        // additional javascript options for the autocomplete plugin
                                        'options'=>array(
                                            'minLength'=>'1',
                                                    'select' => "js:function(event, ui){
                                                    document.getElementById('".CHtml::activeId($model,"[$i]codigoActividadExtension")."').value=ui.item.id;
                                             jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#dataExtension').replaceWith(html)}});return false;}"



                                        ),
                                      'htmlOptions'=>array(
                                            'style'=>'height:40px;width:400px'
                                        ),
                                    ));
                                    ?>
                                </td>
		    		<td class="modo3"><?php echo $model->noActa;?></td>
		    		<td class="modo3"><?php echo $model->fechaActa;?> </td>
                                <td class="modo4"><?php if($i!=$num-1) echo $model->nombreProyectoCurricular;?></td>
		    		<td class="modo4"><?php echo $model->centroCostoPrograma;?></td>
                                <td class="modo4"><?php if($i!=$num-1) echo CHtml::activeTextField($model,"[$i]horas",array("maxlength"=>"2","style"=>"width:20px;","onKeyUp"=>"sumarHoras();")); ?>
                                <?php echo $form->error($model,'horas',array('class'=>'ek')); ?>
                                <?php echo $form->error($model,'titulo',array('class'=>'ek')); ?></td>
                                <td class="modo4"><?php if($i!=$num-1) echo CHtml::imageButton(Yii::app()->request->baseUrl.'/images/del.jpg',array("onclick"=>"document.getElementById('".CHtml::activeId($model,"[$i]codigoActividadExtension")."').value=-1;jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#dataExtension').replaceWith(html)}});return false;")); ?></td>
                               
                                </tr>

                                <?php
                                }
                                ?>
                                <!-- TOTAL HORAS EXTENSION -->
                                <tr class="tr"><td colspan="2" class="modo3"><td colspan="5" class="modo1"><div align="right">TOTAL HORAS POR ACTIVIDADES DE EXTENSIÓN </div></td><td class="modo1" id="horasExtension">0</td></tr>
<?php $this->endWidget(); ?>

</table>
		<!-- TOTAL HORAS EXTENSION -->

</div>
</div>



