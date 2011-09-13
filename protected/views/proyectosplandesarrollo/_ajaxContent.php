<?php $num=count($models); ?>
<script type="text/javascript">
    sumarHoras();
function sumarHorasPlanDesarrollo()
{
    suma=0;
     <?php for($z=0;$z<$num-1;$z++){ ?>
        <?php echo "valor=document.getElementById('ProfesorProyectoPlan_".$z."_horas').value;" ?>
        if((String(valor).search(/^\d+$/) != -1))
        {
         suma=suma+parseFloat(valor);
        }
       <?php } ?>
           document.getElementById('horasPlanDesarrollo').innerHTML=suma;
    return suma;
}
</script>

<div id="dataPlanDesarrollo">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formPlanDesarrollo',
	'enableAjaxValidation'=>true,
)); ?>
<?php //echo CHtml::hiddenField("documentoProfesor",$this->documentoProfesor); ?>
<div class="form">
<!-- Proyectos Plan de desarrollo -->
<h4>4.14 Proyectos del Plan de Desarrollo</h4>
<table class="table">

		<tr class="tr">
		    <td rowspan=2 class="modo1">Código</td>
		    <td rowspan=2 width="440" class="modo1">Título</td>
	
		    <td rowspan=2 class="modo1">Proyecto Curricular</td>
		    <td rowspan=2 class="modo1">Centro de Costo</td>
		    <td rowspan=2 class="modo1" width="50" >Horas</td>
                    <td rowspan=2 class="modo2" width="30"></td>
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
                                            'style'=>'height:40px;width:400px'
                                        ),
                                    ));
                                    ?>
                                </td>
		    		
                                <td class="modo4"><?php if($i!=$num-1) echo $model->nombreProyectoCurricular;?></td>
		    		<td class="modo4"><?php echo $model->centroCostoPrograma;?></td>
		    		<td class="modo4"><?php if($i!=$num-1) echo CHtml::activeTextField($model,"[$i]horas",array("maxlength"=>"2","style"=>"width:20px;","onKeyUp"=>"sumarHoras();")); ?>
                                <?php echo $form->error($model,'horas',array('class'=>'ek')); ?>
                                <?php echo $form->error($model,'titulo',array('class'=>'ek')); ?></td>
                                <td class="modo4"><?php if($i!=$num-1) echo CHtml::imageButton(Yii::app()->request->baseUrl.'/images/del.jpg',array("onclick"=>"document.getElementById('".CHtml::activeId($model,"[$i]codigoProyecto")."').value=-1;jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/UpdateAjax','cache':false,'data':jQuery(this).parents('form').serialize(),'success':function(html){jQuery('#dataPlanDesarrollo').replaceWith(html)}});return false;")); ?></td>
                                
                                </tr>

                                <?php
                                }
                                ?>
                                <!-- TOTAL HORAS PROYECTOS PLAN DESARROLLO -->
                                <tr class="tr"><td colspan="2" class="modo3"><td colspan="2" class="modo1"><div align="right">TOTAL HORAS</div></td><td class="modo1" id="horasPlanDesarrollo">0</td></tr>
<?php $this->endWidget(); ?>

</table>
		<!-- TOTAL HORAS  gestion -->
 <table class="table">
         <tr class="tr"><td colspan="4" class="modo3"><td colspan="6" class="modo1"><div align="right">TOTAL HORAS DE ACTIVIDADES DE GESTIÓN INSTITUCIONAL</div></td><td class="modo1" id="totalHorasGestion" width="5%">0</td></tr>

        </table>
 <!-- TOTAL HORAS-->
         <table class="table">
         <tr class="tr"><td class="modo1" width="20%">HORAS DOCENCIA</td><td class="modo1" width="20%">HORAS INVESTIGACIÓN</td><td class="modo1" width="20%">HORAS EXTENSIÓN	</td><td class="modo1" width="20%">HORAS GESTIÓN INST.</td><td class="modo1" width="20%">TOTAL HORAS SEMANALES</td></tr>
         <tr class="tr"><td class="modo3" width="20%"><div align="center" id="horasDocenciaFinal" >0</div></td><td class="modo3" width="20%"><div align="center" id="horasInvestigacionFinal">0</div></td><td class="modo3" width="20%" ><div align="center" id="horasExtensionFinal">0</div></td><td class="modo3" width="20%"><div align="center"  id="horasGestionFinal">0</div></td><td class="modo3" width="20%"><div align="center" id="horasSemanales">0</div></td></tr>

        </table>
</div>
</div>



