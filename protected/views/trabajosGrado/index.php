<div>
<h4>2.1 Dirección de trabajos de Grado</h4>
<table class="table">

		<tr class="tr">
		    <td rowspan=2 class="modo1">Código</td>
		    <td rowspan=2 width="440" class="modo1">Título</td>
		    <td colspan=2 class="modo1">Acta Consejo de Departamento</td>
		    <td rowspan=2 class="modo1" width="100">Proyecto Curricular</td>
		    <td rowspan=2 class="modo1">Centro de Costo</td>
		    <td rowspan=2 class="modo1" width="50">Nivel</td>
		    <td rowspan=2 class="modo1" width="50" >Horas</td>
 		</tr>
		<tr class="tr">
			<td class="modo1">No.</td>
			<td class="modo1">fecha</td>
		</tr>
		<tr class="tr">
		<?php
                        $horasTrabajosGrado=0;
			$num=count($models);
                        foreach ($models as $i=>$model)
                        {

                ?>

 <tr>
<td class="modo4"><?php echo $model->codigoTrabajo;?></td>
<td class="modo4"><?php echo $model->titulo; ?></td>
<td class="modo3"><?php echo $model->noActa;?></td>
<td class="modo3"><?php echo $model->fechaActa;?></td>
<td class="modo4"><?php echo $model->nombreProyectoCurricular; ?>  </td>
<td class="modo4"><?php echo $model->centroCostoPrograma;?></td>
<td class="modo4"><?php echo $model->nivel;?></td>
<td class="modo4"><?php echo $model->horas; ?></td>
<?php $horasTrabajosGrado = $horasTrabajosGrado + $model->horas;?>


</tr>

<?php
}
?>
<!-- TOTAL HORAS TRABAJOS DE GRADO -->
<tr class="tr"><td colspan="2" class="modo3"><td colspan="5" class="modo1"><div align="right">TOTAL HORAS DIRECCION TRABAJOS DE GRADO</div></td><td class="modo1" id="horasTrabajosGrado"><?php echo $horasTrabajosGrado;?></td></tr>

</table>

</div>
<script type="text/javascript">

function sumarHorasTrabajosGrado()
{
    return <?php echo $horasTrabajosGrado; ?>
}
</script>