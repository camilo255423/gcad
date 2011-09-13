<div id="data">
<h4>2.2 Proyectos de Investigación</h4>
<table class="table">

		<tr class="tr">
		    <td rowspan=2 class="modo1">Código</td>
		    <td rowspan=2 width="440" class="modo1">Título</td>
		    <td colspan=2 class="modo1">Acta Consejo de Facultad</td>
		    <td rowspan=2 width="100" class="modo1">Proyecto Curricular</td>
		    <td rowspan=2 class="modo1">Centro de Costo</td>
                    <td rowspan=2 class="modo1" width="130">Función </td>
		    <td rowspan=2 class="modo1">Horas</td>
 		</tr>
		<tr class="tr">
			<td class="modo1">No.</td>
			<td class="modo1">fecha</td>
		</tr>
		<tr class="tr">
		<?php
                        $horasInvestigacion=0;
			$num=count($models);
                        foreach ($models as $i=>$model)
                        {

                ?>

 <tr>
<td class="modo4"><?php echo $model->codigoProyecto;?></td>
<td class="modo4"><?php echo $model->titulo; ?></td>
<td class="modo3"><?php echo $model->noActa;?></td>
<td class="modo3"><?php echo $model->fechaActa;?></td>
<td class="modo4"><?php echo $model->nombreProyectoCurricular; ?>  </td>
<td class="modo4"><?php echo $model->centroCostoPrograma;?></td>
<td class="modo4"><?php echo $model->codigoFuncion;?></td>
<td class="modo4"><?php echo $model->horas; ?></td>
<?php $horasInvestigacion = $horasInvestigacion + $model->horas;?>
</tr>

<?php
}
?>
<!-- TOTAL HORAS PROYECTO INVESTIGACION -->
<tr class="tr"><td colspan="2" class="modo3"><td colspan="5" class="modo1"><div align="right">TOTAL HORAS PROYECTOS DE INVESTIGACIÓN </div></td><td class="modo1" id="horasInvestigacion"><?php echo $horasInvestigacion; ?></td></tr>
</table>
 <!-- TOTAL HORAS  INVESTIGACION -->
        <?php $totalHorasInvestigacion = $horasTrabajosGrado + $horasInvestigacion; ?>
        <table class="table">
         <tr class="tr"><td colspan="4" class="modo3"><td colspan="6" class="modo1"><div align="right">TOTAL HORAS POR ACTIVIDADES DE INVESTIGACIÓN </div></td><td class="modo1" id="totalHorasInvestigacion" width="5%"><?php echo $totalHorasInvestigacion; ?></td></tr>

        </table>
</div>
<script type="text/javascript">
    
function sumarHorasInvestigacion()
{
    return <?php echo $horasInvestigacion; ?> + sumarHorasTrabajosGrado();
}
</script>