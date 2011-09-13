<script type="text/javascript">
   sumarHoras();
function sumarHorasGestion()
    {
        suma=0;
                <?php for($z=0;$z<18;$z++){ ?>
        <?php echo "valor=document.getElementById('ProfesorGestion_".$z."_horas').value;" ?>
       if((String(valor).search(/^\d+$/) != -1))
        {
         suma=suma+parseFloat(valor);
        }
        <?php }?>;
        document.getElementById('horasGestion').innerHTML=suma;
       
   return suma;
    }
</script>
<div id="dataActividadesGestion">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formGestion',
	'enableAjaxValidation'=>true,
)); ?>
<!-- 4. ACTIVIDADES GESTION INSTITUCIONAL -->
<h3>Actividades de Gestión</h3>

<table class="table">

		<tr class="tr">
		    <td colspan="2" width="500" class="modo1">Tipo de Actividad </td>
		    <td colspan="2" class="modo1">descripción</td>
		    <td colspan="2" width="60" class="modo1">Centro de Costo x Proyecto Curricular</td>
		    <td colspan="2" width="40" class="modo1">Horas</br>/sem</td>
 		</tr>
                <?php foreach($models as $i=>$model) { ?>
                <?php if($model->codigoActividadGestion<=12){ ?>
		<tr class="tr">
		<td colspan="2" class="modo1_1">4.<?php echo $model->codigoActividadGestion;?> <?php echo $model->nombre; ?></td>
		<td colspan="2" class="modo4"><?php echo $model->profesor->descripcion; ?></td>
		<td colspan="2" class="modo4"><?php echo $model->profesor->centroCostoPrograma; ?></td>
		<td colspan="2" class="modo4"><?php echo CHtml::activeTextField($model->profesor,"[$i]horas",array("maxlength"=>"2","style"=>"width:20px;","onKeyUp"=>"sumarHoras();"));  ?><?php echo $form->error($model->profesor,'horas',array('class'=>'ek'));?></td>
		</tr>
                <?php } }?>
                <tr class="tr"><td class="modo1_1" rowspan="7">4.13 Representación del profesorado a consejos y/o comités</td>
                <?php foreach($models as $i=>$model) { ?>
                <?php if($model->codigoActividadGestion>12){ ?>
                <tr class="tr"><td class="modo1_1"><?php echo $model->nombre;?></td>
                <td colspan="2" class="modo4"><?php echo $model->profesor->descripcion; ?></td>
                <td colspan="2" class="modo4"><?php echo $model->profesor->centroCostoPrograma; ?></td>
                <td colspan="2" class="modo4"><?php echo CHtml::activeTextField($model->profesor,"[$i]horas",array("maxlength"=>"2","style"=>"width:20px;","onKeyUp"=>"sumarHoras();","onKeyUp"=>"sumarHoras();"));  ?><?php echo $form->error($model->profesor,'horas',array('class'=>'ek'));?></td>
                </tr>
		 <?php } }?>
 <!-- TOTAL HORAS GESTION -->
            <tr class="tr"><td colspan="2" class="modo3"><td colspan="5" class="modo1"><div align="right">TOTAL HORAS</div></td><td class="modo1" id="horasGestion">0</td></tr>

</table>
<?php $this->endWidget(); ?>
</div>
</div>
<script type="text/javascript">

function sumarHorasActividadesGestion()
{
    return <?php echo $horasGestion; ?>
}
</script>

