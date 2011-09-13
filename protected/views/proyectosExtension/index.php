<div id="data">
<table class="table">

		<tr class="tr">
		    <td rowspan=2 class="modo1">Código</td>
		    <td rowspan=2 width="440" class="modo1">Título</td>
		    <td colspan=2 width="80" class="modo1">Acta Consejo de Facultad</td>
		    <td rowspan=2 class="modo1">Proyecto Curricular</td>
		    <td rowspan=2 class="modo1">Centro de Costo</td>
		    <td rowspan=2 class="modo1" width="50" >Horas</td>
        	</tr>
		<tr class="tr">
			<td class="modo1">No.</td>
			<td class="modo1">fecha</td>
		</tr>
		<tr class="tr">
		<?php
                        $horasExtension=0;
			$num=count($models);
                        foreach ($models as $i=>$model)
                        {

                ?>

 <tr>
<td class="modo4"><?php echo $model->codigoActividadExtension;?></td>
<td class="modo4"><?php echo $model->titulo; ?></td>
<td class="modo3"><?php echo $model->noActa;?></td>
<td class="modo3"><?php echo $model->fechaActa;?></td>
<td class="modo4"><?php echo $model->nombreProyectoCurricular; ?>  </td>
<td class="modo4"><?php echo $model->centroCostoPrograma;?></td>
<td class="modo4"><?php echo $model->horas; ?></td>
<?php $horasExtension = $horasExtension + $model->horas;?>
</tr>

<?php
}
?>
 <!-- TOTAL HORAS EXTENSION -->
<tr class="tr"><td colspan="2" class="modo3"><td colspan="4" class="modo1"><div align="right">TOTAL HORAS POR ACTIVIDADES DE EXTENSIÓN </div></td><td class="modo1" id="horasExtension"><?php echo $horasExtension; ?></td></tr>
</table>
</div>
 <script type="text/javascript">

function sumarHorasExtension()
{
    return <?php echo $horasExtension; ?>
}
</script>