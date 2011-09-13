<?php $num=count($models); ?>
<script type="text/javascript">
    sumarHoras();
function sumarHorasTrabajo()
{
    suma=0;
     <?php for($z=0;$z<$num-1;$z++){ ?>
        <?php echo "valor=document.getElementById('TrabajoGrado_".$z."_horas').value;" ?>
        if((String(valor).search(/^\d+$/) != -1))
        {
         suma=suma+parseFloat(valor);
        }
       <?php } ?>
           document.getElementById('horasTrabajosGrado').innerHTML=suma;
    return suma;
}
</script>
<div id="dataTrabajos">
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formTrabajos',
	'enableAjaxValidation'=>true,
)); ?>
<?php echo CHtml::hiddenField("documentoProfesor",$this->documentoProfesor); ?>
<div class="form">
<!-- 2.1 DIRECCION DE TRABAJOS DE GRADO -->
<h4>2.1 Dirección de Trabajos de Grado</h4>
<table class="table">

		<tr class="tr">
		    <td rowspan=2 class="modo1">Código</td>
		    <td rowspan=2 width="440" class="modo1">Título</td>
		    <td colspan=2 class="modo1">Acta Consejo de Departamento</td>
		    <td rowspan=2 class="modo1">Proyecto Curricular</td>
		    <td rowspan=2 class="modo1">Centro de Costo</td>
		    <td rowspan=2 class="modo1" width="50">Nivel</td>
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
				<td class="modo4"><?php if($model->codigoTrabajo!=-2) echo $model->codigoTrabajo;?> </td>
		    		<td class="modo3" width="130" height="60">
                                    <?php echo CHtml::ActiveHiddenField($model,"[$i]codigoTrabajo"); ?>
                                    <?php $this->widget('zii.widgets.jui.CJuiAutoCompleteTextArea', array(
                                        'name'=>'mtrabajos'.$i,
                                            'value'=>$model->titulo,
                                        'source'=>$arr,
                                        // additional javascript options for the autocomplete plugin
                                        'options'=>array(
                                            'minLength'=>'1',
                                                    'select' => "js:function(event, ui){
                                                    document.getElementById('".CHtml::activeId($model,"[$i]codigoTrabajo")."').value=ui.item.id;
                                             jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#dataTrabajos').replaceWith(html)}});return false;}"



                                        ),
                                        'htmlOptions'=>array(
                                            'style'=>'height:40px;width:400px'
                                        ),
                                    ));
                                    ?>
                                </td>
		    		<td class="modo3"><?php echo $model->noActa;?></td>
		    		<td class="modo3"><?php echo $model->fechaActa;?> </td>
                                <td class="modo4"><?php if($i!=$num-1) echo $programas[$i];?></td>
		    		<td class="modo4"><?php echo $model->centroCostoPrograma;?></td>
		    		<td class="modo3"><?php echo $model->nivel;?> </td>
		    		<td class="modo3"><?php if($i!=$num-1) {echo CHtml::activeTextField($model,"[$i]horas",array("maxlength"=>"2","style"=>"width:20px;","onKeyUp"=>"sumarHoras();"));} ?>
                                <?php echo CHtml::error($model,'horas',array('class'=>'ek')); ?>
                                <?php echo CHtml::error($model,'titulo',array('class'=>'ek')); ?></td>
                                <td class="modo4"><?php if($i!=$num-1) echo CHtml::imageButton(Yii::app()->request->baseUrl.'/images/del.jpg',array("onclick"=>"document.getElementById('".CHtml::activeId($model,"[$i]codigoTrabajo")."').value=-1;jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#dataTrabajos').replaceWith(html)}});return false;")); ?></td>
                             
                                </tr>

                                <?php
                                }
                                ?>
  	<!-- TOTAL HORAS TRABAJOS DE GRADO -->
                                <tr class="tr"><td colspan="2" class="modo3"><td colspan="6" class="modo1"><div align="right">TOTAL HORAS DIRECCION TRABAJOS DE GRADO</div></td><td class="modo1" id="horasTrabajosGrado">0</td></tr>

</table>
	

<?php $this->endWidget(); ?>

</div>
</div>

