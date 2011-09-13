



<div id="data">
<h4>DIRECCION DE TRABAJOS DE GRADO</h4>
<table class="table">

		<tr class="tr">
		    <td rowspan=2 class="modo1">Código</td>
		    <td rowspan=2 class="modo1">Título</td>
		    <td colspan=2 class="modo1">Acta Consejo de Departamento</td>
		    <td rowspan=2 class="modo1">Proyecto Curricular</td>
		    <td rowspan=2 class="modo1">Centro de Costo</td>
		    <td rowspan=2 class="modo1">Nivel</td>
		    <td rowspan=2 class="modo1">Horas</td>
 		</tr>
		<tr class="tr">
			<td class="modo1">No.</td>
			<td class="modo1">fecha</td>
		</tr>
		<tr class="tr">
		<?php
			$num=count($models);
                        foreach ($models as $i=>$model)
                        {

                ?>

 <tr>
<td class="modo4"><?php echo $model->codigoTrabajo;?></td>
<td class="modo4"><?php echo $model->titulo; ?></td>
<td class="modo3"><?php echo $model->noActa;?></td>
<td class="modo3"><?php echo $model->fechaActa;?></td>
<td class="modo4"><?php echo $programas[$i]; ?>  </td>
<td class="modo4"><?php echo $model->centroCostoPrograma;?></td>
<td class="modo4"><?php echo $model->nivel;?></td>
<td class="modo4"><?php echo $model->horas; ?></td>

</tr>

<?php
}
?>
<?php echo CHtml::submitButton('Editar',array('name'=>'Editar','submit'=>'index.php?r=trabajosGrado/editar')); ?>
</div>
 