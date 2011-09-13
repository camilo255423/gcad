
<div id="data">
<h4>4.14 Proyectos del Plan de Desarrollo Institucional </h4>
<table class="table">

		<tr class="tr">
		    <td rowspan=2 class="modo1">Código</td>
		    <td rowspan=2 width="440" class="modo1">Título</td>

		    <td rowspan=2 class="modo1" width="80">Proyecto Curricular</td>
		    <td rowspan=2 class="modo1">Centro de Costo</td>
		    <td rowspan=2 class="modo1" width="50" >Horas</td>
 		</tr>
		
		<tr class="tr">
		<?php
                        $horasPlanDesarrollo=0;
			$num=count($models);
                        foreach ($models as $i=>$model)
                        {

                ?>

 <tr>
<td class="modo4"><?php echo $model->codigoProyecto;?></td>
<td class="modo4"><?php echo $model->titulo; ?></td>

<td class="modo4"><?php echo $model->nombreProyectoCurricular; ?>  </td>
<td class="modo4"><?php echo $model->centroCostoPrograma;?></td>

<td class="modo4"><?php echo $model->horas; ?></td>
<?php $horasPlanDesarrollo = $horasPlanDesarrollo + $model->horas; ?>
</tr>

<?php
}
?>
<!-- TOTAL HORAS PROYECTOS PLAN DESARROLLO -->
<tr class="tr"><td colspan="2" class="modo3"><td colspan="2" class="modo1"><div align="right">TOTAL HORAS</div></td><td class="modo1" id="horasPlanDesarrollo"><?php echo $horasPlanDesarrollo; ?></td></tr>
</table>

<!-- TOTAL HORAS  gestion -->

 <table class="table">
         <tr class="tr"><td colspan="4" class="modo3"><td colspan="6" class="modo1"><div align="right">TOTAL HORAS DE ACTIVIDADES DE GESTIÓN INSTITUCIONAL</div></td><td class="modo1" id="totalHorasGestion" width="5%"><?php echo $totalHorasGestion; ?></td></tr>

        </table>
 <!-- TOTAL HORAS-->
         <table class="table">
         <tr class="tr"><td class="modo1" width="20%">HORAS DOCENCIA</td><td class="modo1" width="20%">HORAS INVESTIGACIÓN</td><td class="modo1" width="20%">HORAS EXTENSIÓN	</td><td class="modo1" width="20%">HORAS GESTIÓN INST.</td><td class="modo1" width="20%">TOTAL HORAS SEMANALES</td></tr>
         <tr class="tr"><td class="modo3" width="20%"><div align="center" id="horasDocenciaFinal" >0</div></td><td class="modo3" width="20%"><div align="center" id="horasInvestigacionFinal">0</div></td><td class="modo3" width="20%" ><div align="center" id="horasExtensionFinal">0</div></td><td class="modo3" width="20%"><div align="center"  id="horasGestionFinal">0</div></td><td class="modo3" width="20%"><div align="center" id="horasSemanales">0</div></td></tr>

        </table>
</div>

<script type="text/javascript">
sumarHoras();
function sumarHoras()
{
    docencia = sumarHorasDocencia();
    extension = sumarHorasExtension();
    investigacion = sumarHorasInvestigacion();
    gestion = sumarHorasGestion();
    document.getElementById('totalHorasInvestigacion').innerHTML= investigacion;
    document.getElementById('totalHorasGestion').innerHTML= gestion;
     total=docencia+investigacion+extension+gestion;
      document.getElementById('horasDocenciaFinal').innerHTML=docencia;
      document.getElementById('horasInvestigacionFinal').innerHTML=investigacion;
      document.getElementById('horasExtensionFinal').innerHTML=extension;
      document.getElementById('horasGestionFinal').innerHTML=gestion;
      document.getElementById('horasSemanales').innerHTML=total;

}
 function sumarHorasGestion()
{

    return <?php echo $horasPlanDesarrollo; ?> + sumarHorasActividadesGestion();
}
</script>
