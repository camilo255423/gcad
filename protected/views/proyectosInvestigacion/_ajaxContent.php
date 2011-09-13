<?php $num=count($models); ?>
<script type="text/javascript">
    sumarHoras();
function sumarHorasInvestigacion()
{
    suma=0;
     <?php for($z=0;$z<$num-1;$z++){ ?>
        <?php echo "valor=document.getElementById('ProfesorInvestigacion_".$z."_horas').value;" ?>
        if((String(valor).search(/^\d+$/) != -1))
        {
         suma=suma+parseFloat(valor);
        }
       <?php } ?>
           document.getElementById('horasInvestigacion').innerHTML=suma;
    return suma;
}
</script>

<div id="dataInvest">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formInvestigacion',
	'enableAjaxValidation'=>true,
)); ?>
<?php echo CHtml::hiddenField("documentoProfesor",$this->documentoProfesor); ?>

<!-- INVESTIGACION -->
<h4>2.2 Proyectos de Investigación</h4>
<table class="table">

		<tr class="tr">
		    <td rowspan=2 class="modo1">Código</td>
		    <td rowspan=2 width="440" class="modo1">Título</td>
		    <td colspan=2 class="modo1">Acta Consejo de Facultad</td>
		    <td rowspan=2 width="80" class="modo1">Proyecto Curricular</td>
		    <td rowspan=2 class="modo1">Centro de Costo</td>
                    <td rowspan=2 class="modo1" width="70">Función </td>
		    <td rowspan=2 class="modo1" width="50">Horas</td>
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
				<td class="modo4"><?php if($model->codigoProyecto!=-2) echo $model->codigoProyecto;?> </td>
		    		<td class="modo3" width="130" height="60">
                                    <?php echo CHtml::ActiveHiddenField($model,"[$i]codigoProyecto"); ?>
                                    <?php $this->widget('zii.widgets.jui.CJuiAutoCompleteTextArea', array(
                                        'name'=>'m'.$i,
                                            'value'=>$model->titulo,
                                        'source'=>$arr,
                                        // additional javascript options for the autocomplete plugin
                                        'options'=>array(
                                            'minLength'=>'1',
                                                    'select' => "js:function(event, ui){
                                                    document.getElementById('".CHtml::activeId($model,"[$i]codigoProyecto")."').value=ui.item.id;
                                             jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#dataInvest').replaceWith(html)}});return false;}"



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
		    		<td class="modo4" width="100"><?php if($i!=$num-1) echo $form->DropDownList($model,"[$i]codigoFuncion", CHtml::ListData(FuncionInvestigacion::model()->findAll(array('order'=>'codigoFuncion')),'codigoFuncion','nombre')); ?></td>
                                <td class="modo4"><?php if($i!=$num-1) echo CHtml::activeTextField($model,"[$i]horas",array("maxlength"=>"2","style"=>"width:20px;","onKeyUp"=>"sumarHoras();")); ?>
                                <?php echo $form->error($model,'horas',array('class'=>'ek')); ?>
                                <?php echo $form->error($model,'titulo',array('class'=>'ek')); ?></td>
                                <td class="modo4"><?php if($i!=$num-1) echo CHtml::imageButton(Yii::app()->request->baseUrl.'/images/del.jpg',array("onclick"=>"document.getElementById('".CHtml::activeId($model,"[$i]codigoProyecto")."').value=-1;jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#dataInvest').replaceWith(html)}});return false;")); ?></td>
                                
                                </tr>

                                <?php
                                }
                                ?>
   	<!-- TOTAL HORAS PROYECTO INVESTIGACION -->
                                <tr class="tr"><td colspan="2" class="modo3"><td colspan="6" class="modo1"><div align="right">TOTAL HORAS PROYECTOS DE INVESTIGACIÓN </div></td><td class="modo1" id="horasInvestigacion">0</td></tr>
                                </table>
     <!-- TOTAL HORAS  INVESTIGACION -->
        <table class="table">
         <tr class="tr"><td colspan="4" class="modo3"><td colspan="6" class="modo1"><div align="right">TOTAL HORAS POR ACTIVIDADES DE INVESTIGACIÓN </div></td><td class="modo1" id="totalHorasInvestigacion" width="5%">0</td></tr>

        </table>
<?php $this->endWidget(); ?>


		

</div>
</div>



