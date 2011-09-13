 <?php $horasGestion = 0; ?>
<!-- 4. ACTIVIDADES GESTION INSTITUCIONAL -->  
<h3>Actividades de Gestión</h3>
    
<table class="table">
	
		<tr class="tr">
		    <td colspan="2" width="400" class="modo1">Tipo de Actividad </td>
		    <td colspan="2" class="modo1">descripción</td>
		    <td colspan="2" width="60" class="modo1">Centro de Costo x Proyecto Curricular</td>
		    <td colspan="2" width="40" class="modo1">Horas<br></br>/sem</td>
 		</tr>
               
		<?php foreach($models as $model) { ?>
                <?php if($model->codigoActividadGestion<=12){ ?>
		<tr class="tr">
		<td colspan="2" class="modo1_1">4.<?php echo $model->codigoActividadGestion;?> <?php echo $model->nombre; ?></td>	
		<td colspan="2" class="modo4"><?php echo $model->profesor->descripcion; ?></td>
		<td colspan="2" class="modo4"><?php if($model->profesor->horas>0) echo $model->profesor->centroCostoPrograma; ?></td>
		<td colspan="2" class="modo4"><?php echo $model->profesor->horas; ?></td>
                <?php $horasGestion = $horasGestion + $model->profesor->horas; ?>
		</tr>			
                <?php } }?>
		<tr class="tr"><td class="modo1_1" rowspan="7">4.13 Representación del profesorado a consejos y/o comités</td>
                <?php foreach($models as $model) { ?>
                <?php if($model->codigoActividadGestion>12){ ?>
                <tr class="tr"><td class="modo1_1"><?php echo $model->nombre;?></td>
                <td colspan="2" class="modo4"><?php echo $model->profesor->descripcion; ?></td>
                <td colspan="2" class="modo4"><?php if($model->profesor->horas>0) echo $model->profesor->centroCostoPrograma; ?></td>
                <td colspan="2" class="modo4"><?php echo $model->profesor->horas; ?></td>
                <?php $horasGestion = $horasGestion + $model->profesor->horas; ?>

                </tr>
		 <?php } }?>
             
			  
           
<!-- TOTAL HORAS GESTION -->
            <tr class="tr"><td colspan="2" class="modo3"><td colspan="5" class="modo1"><div align="right">TOTAL HORAS</div></td><td class="modo1" id="horasGestion"><?php echo $horasGestion; ?></td></tr>
       
        
			
			
</table>
<script type="text/javascript">
sumarHoras();
function sumarHorasActividadesGestion()
{
    
    return <?php echo $horasGestion; ?> ;

}
</script>
