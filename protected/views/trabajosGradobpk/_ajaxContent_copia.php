<script>

var trabajos = new Array();
<?php foreach($models2 as $m){ ?>
var trabajo = new Array();
var codigo = "<?php echo $m->codigoTrabajo; ?>";
trabajo["codigoTrabajo"]="<?php echo $m->codigoTrabajo; ?>";
trabajo["titulo"]="<?php echo $m->titulo; ?>";
trabajo["noActa"]="<?php echo $m->noActa; ?>";
trabajo["fechaActa"]="<?php echo $m->fechaActa; ?>";
trabajo["centroCostoPrograma"]="<?php echo $m->centroCostoPrograma; ?>";
trabajo["nivel"]="<?php echo $m->nivel; ?>";

trabajos[codigo]=trabajo;
<?php }?>
function displaymessage()
{
alert("Hello World!");
var z=<?php
  $model = new TrabajoGrado;
 $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'name'=>'m'.$i,
	'value'=>$model->titulo,
    'source'=>$arr,
    // additional javascript options for the autocomplete plugin
    'options'=>array(
        'minLength'=>'1',
		'select' => "js:function(event, ui){ 
		document.getElementById('".CHtml::activeId($model,"codigoTrabajo")."').value=ui.item.id;
	  document.getElementById('t".CHtml::activeId($model,"codigoTrabajo")."').innerHTML=ui.item.id;
		
      document.getElementById('".CHtml::activeId($model,"noActa")."').innerHTML=trabajos[ui.item.id].noActa;
		document.getElementById('".CHtml::activeId($model,"fechaActa")."').innerHTML=trabajos[ui.item.id].fechaActa;
		document.getElementById('".CHtml::activeId($model,"centroCostoPrograma")."').innerHTML=trabajos[ui.item.id].centroCostoPrograma;
		document.getElementById('".CHtml::activeId($model,"nivel")."').innerHTML=trabajos[ui.item.id].nivel;
		displaymessage();
				  
		 	}"	
      
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>;
}

</script>
<table>
<tr>
<td><th>codigo</th></td><td><th>Título</th></td><td><th>noActa</th></td><td><th>Fecha</th></td><td><th>Centro de Costo</th></td><td><th>Nivel</th></td><td><th>Horas</th></td>
</tr>
<?php
foreach ($models as $i=>$model)
{
?>
<tr>

<td><th id="t<?php echo CHtml::activeId($model,"[$i]codigoTrabajo"); ?>" ><?php echo $model->codigoTrabajo;?> </th></td>


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
				  
		 	}"	
      
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>
</th></td>

<td><th id="<?php echo CHtml::activeId($model,"[$i]noActa"); ?>" ><?php echo $model->noActa;?> </th></td>
<td><th id="<?php echo CHtml::activeId($model,"[$i]fechaActa"); ?>" ><?php echo $model->fechaActa;?></th></td>
<td><th id="<?php echo CHtml::activeId($model,"[$i]centroCostoPrograma"); ?>" ><?php echo $model->centroCostoPrograma;?></th></td>
<td><th id="<?php echo CHtml::activeId($model,"[$i]nivel"); ?>" ><?php echo $model->nivel;?></th></td>
<td><th><?php echo CHtml::activeTextField($model,"[$i]horas",array("size"=>4)); ?></th></td>

</tr>
</div>
<?php
}
?>
<?php echo CHtml::ajaxSubmitButton('Guardar',$this->createUrl('trabajosGrado/UpdateAjax'),array('replace'=>'#data')); ?>


