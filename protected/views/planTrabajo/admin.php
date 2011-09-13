
<?php
$this->breadcrumbs=array(
	'PlanTrabajo'=>array('index'),
	'Manage',
);

//$this->menu=array(
//	array('label'=>'List facultad', 'url'=>array('index')),
//	array('label'=>'Create facultad', 'url'=>array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('planTrabajo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!-- -------------------------------------------------------------->
<!--- INICIO DEL FORMULARIO -->
<!-- INFORMACION GENERAL -->
<div>
<h2><?php echo CHtml::activeLabel($model,'informacionGeneral'); ?></h2>
<table class="table">
	<tr class="tr">
		<td class="modo1_1"><?php echo CHtml::activeLabel($model,'apellidos'); ?></td>
		<td class="modo2"><?php echo $model->apellido1 ." ". $model->apellido2; ?></td>
		<td class="modo1_1"><?php echo CHtml::activeLabel($model,'nombres'); ?></td>
		<td class="modo2"><?php echo $model->nombre1 ." ". $model->nombre2; ?></td>
		<td class="modo1_1"><?php echo CHtml::activeLabel($model,'documentoProfesor'); ?></td>
		<td class="modo2"><?php echo $model->documentoProfesor; ?></td>
	</tr>
	<tr class="tr">
		<td class="modo1_1"><?php echo CHtml::activeLabel($model,'nombreF'); ?></td>
		<td class="modo2"><?php echo $nombreFacultad ?></td>
		<td class="modo1_1"><?php echo CHtml::activeLabel($model,'nombreD'); ?></td>
		<td class="modo2"><?php echo $model->departamento->nombre; ?></td>
		<td class="modo1_1"><?php echo CHtml::activeLabel($model,'periodoAcademico'); ?></td>
		<td class="modo2">
		</td>
	</tr>
	<tr class="tr">
		<td class="modo1_1"><?php echo CHtml::activeLabel($model,'tipoVinculacion'); ?></td>
		<td class="modo2"><?php echo $model->vinculacion->nombre; ?></td>
		<td class="modo1_1"><?php echo CHtml::activeLabel($model,'tipoDedicacion'); ?></td>
		<td class="modo2"><?php echo $model->dedicacion->nombre; ?></td>
		<td class="modo1_1"><?php echo CHtml::activeLabel($model,'cateogoria'); ?></td>
		<td class="modo2"><?php echo $model->categoria->nombre; ?></td>
	</tr>
</table>	

<?php echo CHtml::errorSummary($model); ?>
</div><!-- search-form -->


<div>
<hr>
<p></p>
<h2><?php echo CHtml::activeLabel($model,'responsabilidadAcademica'); ?></h2>
<p></p>

<!-- 1. ACTIVIDADES ACADEMICAS DE DOCENCIA -->  

<h3><?php echo CHtml::activeLabel($model,'actividadesAcademicasDocencia'); ?></h3>
    
<!-- 1.1 DOCENCIA -->  
<h4><?php echo CHtml::activeLabel($model,'docencia'); ?></h4>

<table class="table">
	<tr class="tr">
  	   	<td rowspan=2 class="modo1">&nbsp;</td>
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'codigo'); ?></td>
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'nombre'); ?></td>
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'proyectoCurricular'); ?></td>
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'centroCosto'); ?></td>
	    <td colspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'numeroEstudiantes'); ?></td>
	    <td colspan=6 width="200px" class="modo1"><?php echo CHtml::activeLabel($model,'horario'); ?></td>
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'horasSem'); ?></td>
 	</tr> 	
	<tr class="tr">
		<td class="modo1"><?php echo CHtml::activeLabel($model,'pregrado'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'posgrado'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'lunes'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'martes'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'miercoles'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'jueves'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'viernes'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'sabado'); ?></td>
	</tr>
	
	<!-- ESPACIOS ACADEMICOS -->
	<tr class="tr">
		<td rowspan=$numeroCursos class="modo1"><?php echo CHtml::activeLabel($model,'espacioAcademico'); ?></td>
			
			<?php $asig = 0;
				for ($i=0; $i<$practica0; $i++){ 
					if ($asig==0 and $practica[$i] == 0){
						$asig++; 
			?>
						<td class="modo4"><?php echo $codigoAsignatura[$i] . " - " . $grupo[$i]; ?></td>
			    		<td class="modo3"><?php echo $nombreAsignatura[$i]; ?></td>
			    		<td class="modo3"><?php echo $nombrePrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo $costoPrograma[$i]; ?></td>
			    		<td class="modo3">&nbsp;</td>
			    		<td class="modo3">&nbsp;</td>
			    		<td class="modo3">
							<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'L'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo3">
			    			<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'M'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo3">
			    			<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'W'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo3">
			    			<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'J'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo3">
			    			<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'V'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo3">
			    			<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'S'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4"><?php echo $horas[$i] ?></td>
			    	</tr>
			<?php	
					}
					else{
						if ($asig > 0 and $practica[$i] == 0){
			?>
						<tr class="tr">
							<td class="modo1">&nbsp;</td>
				        	<td class="modo4"><?php echo $codigoAsignatura[$i] . " - " . $grupo[$i]; ?></td>
				    		<td class="modo3"><?php echo $nombreAsignatura[$i]; ?></td>
				        	<td class="modo3"><?php echo $nombrePrograma[$i]; ?></td>
				    		<td class="modo4"><?php echo $costoPrograma[$i]; ?></td>
				        	<td class="modo3">&nbsp;</td>
				        	<td class="modo3">&nbsp;</td>
				        	<td class="modo3">
								<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'L'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				    		<td class="modo3">
				    			<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'M'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				    		<td class="modo3">
				    			<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'W'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				    		<td class="modo3">
				    			<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'J'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				    		<td class="modo3">
				    			<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'V'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				    		<td class="modo3">
				    			<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'S'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				        	<td class="modo4"><?php echo $horas[$i] ?></td>
						</tr>
				<?php	
						}
					} 
				}			
			?>

		<!------------- PRACTICA EDUCATIVA ------------->	
		<tr class="tr">
			<td rowspan=$practica1 class="modo1"><?php echo CHtml::activeLabel($model,'practicaEducativa'); ?></td>
			
			<?php 
			    $pract = 0;
				for ($i=0;$i<$numeroCursos;$i++){ 
					if ($pract == 0 and $practica[$i] == 1){
						$pract++;
			?>
						<td class="modo4"><?php echo $codigoAsignatura[$i] . " - " . $grupo[$i] ?></td>
			    		<td class="modo3"><?php echo $nombreAsignatura[$i] ?></td>
			    		<td class="modo3"><?php echo $nombrePrograma[$i] ?></td>
			    		<td class="modo4"><?php echo $costoPrograma[$i] ?></td>
			    		<td class="modo3">&nbsp;</td>
			    		<td class="modo3">&nbsp;</td>
			    		<td class="modo4">
							<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'L'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'M'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'W'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'J'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'V'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horario); $k=$k+2){
									if ($horario[$k][0] == $codigoAsignatura[$i]){
										if ($horario[$k][1] == 'S'){
											echo $horario[$k][2] . " - " . $horario[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4"><?php echo $horas[$i] ?></td>
		</tr>
			<?php	
					} 
					else{
						if ($pract > 0 and $practica[$i] == 1){
			?>
						<tr class="tr">
							<td class="modo1">&nbsp;</td>
				        	<td class="modo4"><?php echo $codigoAsignatura[$i] . " - " . $grupo[$i] ?></td>
				    		<td class="modo3"><?php echo $nombreAsignatura[$i] ?></td>
				        	<td class="modo3"><?php echo $nombrePrograma[$i] ?></td>
				    		<td class="modo4"><?php echo $costoPrograma[$i] ?></td>
				        	<td class="modo3">&nbsp;</td>
				        	<td class="modo3">&nbsp;</td>
				        	<td class="modo4">
								<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'L'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				    		<td class="modo4">
				    			<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'M'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				    		<td class="modo4">
				    			<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'W'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				    		<td class="modo4">
				    			<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'J'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				    		<td class="modo4">
				    			<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'V'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				    		<td class="modo4">
				    			<?php 
									for ($k=0; $k<count($horario); $k=$k+2){
										if ($horario[$k][0] == $codigoAsignatura[$i]){
											if ($horario[$k][1] == 'S'){
												echo $horario[$k][2] . " - " . $horario[$k+1][2];
											}
											else
											{
												?>&nbsp;<?php
											}
										}
									}
								?>
				    		</td>
				        	<td class="modo4"><?php echo $horas[$i] ?></td>
			</tr>
				<?php	
						} 
					}
				}
			?>
		
		<!-- TOTAL DOCENCIA -->
		<tr class="tr">
			<td colspan=13 class="total"><?php echo CHtml::activeLabel($model,'total'); ?></td>
  			<td class="totalText"><?php echo $horasTotalDocencia ?></td>
 		</tr>
</table>
	

<p></p>
<p></p>
<!-- 1.2 ACTIVIDADES DE APOYO A LA DOCENCIA -->  
<h4><?php echo CHtml::activeLabel($model,'acApDocencia'); ?></h4>

<table class="table">
	
		<tr class="tr">
  	    	<td  class="modo1"><?php echo CHtml::activeLabel($model,'tipoActividad'); ?></td>
		    <td  class="modo1"><?php echo CHtml::activeLabel($model,'espacioAc'); ?></td>
		    <td  class="modo1"><?php echo CHtml::activeLabel($model,'numeroEstudiantes'); ?></td>
		    <td  class="modo1"><?php echo CHtml::activeLabel($model,'proyectoCurricular'); ?></td>
		    <td  class="modo1"><?php echo CHtml::activeLabel($model,'centroCosto'); ?></td>
		    <td  class="modo1"><?php echo CHtml::activeLabel($model,'horasSem'); ?></td>
 		</tr> 	

		<!-- TUTORIA A ESTUDIANTES -->	
		<tr class="tr">
			<td rowspan=$numeroCursos class="modo1"><?php echo CHtml::activeLabel($model,'tutoria'); ?></td>
			<?php
				for ($i=0; $i<$numeroCursos; $i++){ 
					if ($i == 0){
			?>
						<td class="modo3"><?php echo $nombreAsignatura[$i]; ?></td>
			    		<td class="modo3">&nbsp;</td>
			    		<td class="modo3"><?php echo $nombrePrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo $costoPrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo CHtml::textField('Text', $hTutoria[$i],
											 array('id'       => 'hTutoria', 
											       'width'    => 1,
											       'size'     => 10, 
											       'maxlength'=> 3)); ?></td>
			    	</tr>
			<?php	
					}
					else{
						if ($i > 0){
			?>
					<tr class="tr">
						<td class="modo1">&nbsp;</td>
						<td class="modo3"><?php echo $nombreAsignatura[$i] ?></td>
			    		<td class="modo3">&nbsp;</td>
			    		<td class="modo3"><?php echo $nombrePrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo $costoPrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo CHtml::textField('Text', $hTutoria[$i],
											 array('id'       => 'hTutoria', 
											       'width'    => 1,
											       'size'     => 10, 
											       'maxlength'=> 3)); ?></td>
					</tr>
				<?php	
						}
					} 
				}			
			?>
		

		<!-- PREPARACION CLASE -->	
		<tr class="tr">
			<td rowspan=$numeroCursos class="modo1"><?php echo CHtml::activeLabel($model,'preparacion'); ?></td>
			<?php
				for ($i=0; $i<$numeroCursos; $i++){ 
					if ($i == 0){
			?>
						<td class="modo3"><?php echo $nombreAsignatura[$i]; ?></td>
			    		<td class="modo3">&nbsp;</td>
			    		<td class="modo3"><?php echo $nombrePrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo $costoPrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo CHtml::textField('Text', $hPreparacion[$i],
											 array('id'       => 'hPreparacion', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
			    	</tr>
			<?php	
					}
					else{
						if ($i > 0){
			?>
					<tr class="tr">
						<td class="modo1">&nbsp;</td>
						<td class="modo3"><?php echo $nombreAsignatura[$i] ?></td>
			    		<td class="modo3">&nbsp;</td>
			    		<td class="modo3"><?php echo $nombrePrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo $costoPrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo CHtml::textField('Text', $hPreparacion[$i],
											 array('id'       => 'hPreparacion', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
					</tr>
				<?php	
						}
					} 
				}			
			?>
		
		<!-- EVALUACION DE ACTIVIDADES -->	
		<tr class="tr">
			<td rowspan=$numeroCursos class="modo1"><?php echo CHtml::activeLabel($model,'evalAct'); ?></td>
			<?php
				for ($i=0; $i<$numeroCursos; $i++){ 
					if ($i == 0){
			?>
						<td class="modo3"><?php echo $nombreAsignatura[$i]; ?></td>
			    		<td class="modo3">&nbsp;</td>
			    		<td class="modo3"><?php echo $nombrePrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo $costoPrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo CHtml::textField('Text', $hEval[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
			    	</tr>
			<?php	
					}
					else{
						if ($i > 0){
			?>
					<tr class="tr">
						<td class="modo1">&nbsp;</td>
						<td class="modo3"><?php echo $nombreAsignatura[$i] ?></td>
			    		<td class="modo3">&nbsp;</td>
			    		<td class="modo3"><?php echo $nombrePrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo $costoPrograma[$i]; ?></td>
			    		<td class="modo4"><?php echo CHtml::textField('Text', $hEval[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
					</tr>
				<?php	
						}
					} 
				}			
			?>
		
		<!-- TOTAL DOCENCIA -->
		<tr class="tr">
			<td colspan=5 class="total"><?php echo CHtml::activeLabel($model,'totalApoyo'); ?></td>
  			<td class="totalText"><?php echo $horasTotalApoyo ?></td>
 		</tr>
</table>

<!-- TOTAL HORAS POR ACTIVIDADES ACADEMICAS DE DOCENCIA -->
<table class="table">
		<tr class="tr">
			<td colspan=5 class="total"><?php echo CHtml::activeLabel($model,'total'); ?></td>
  			<td class="totalText"><?php echo $horasTotalActividades ?></td>
 		</tr>
</table>

<p></p>
<hr>
<p></p>
<!-- 2. ACTIVIDADES DE INVESTIGACION -->  

<h3><?php echo CHtml::activeLabel($model,'actividadesInvestigacion'); ?></h3>
    
<!-- 2.1 DIRECCION DE TRABAJOS DE GRADO -->  
<h4><?php echo CHtml::activeLabel($model,'direccionGrado'); ?></h4>
<table class="table">
	
		<tr class="tr">
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'codigo'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'tituloTesis'); ?></td>
		    <td colspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'actaDepto'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'proyectoCurricular'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'centroCosto'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'nivel'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'horasSem'); ?></td>
 		</tr> 	
		<tr class="tr">
			<td class="modo1"><?php echo CHtml::activeLabel($model,'numero'); ?></td>
			<td class="modo1"><?php echo CHtml::activeLabel($model,'fecha'); ?></td>
		</tr>
		<tr class="tr">		
		<?php
			for ($i=0; $i<$nTrabajoGrado; $i++){ 
				if ($i == 0){
			?>
					<td class="modo4"><?php echo $codigoTrabajo[$i] ?></td>
		    		<td class="modo3"><?php echo $titulo[$i] ?></td>
		    		<td class="modo3"><?php echo $noActaTesis[$i] ?></td>
		    		<td class="modo3"><?php echo $fechaActaTesis[$i] ?></td>
		    		<td class="modo4"><?php echo $centroCostoP[$i] ?></td>
		    		<td class="modo3"><?php echo $nivel[$i] ?></td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $hEval[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0){
			?>
						<tr class="tr">
							<td class="modo4"><?php echo $codigoTrabajo[$i]; ?></td>
		    				<td class="modo3"><?php echo $titulo[$i]; ?></td>
		    				<td class="modo3"><?php echo $noActaTesis[$i]; ?></td>
		    				<td class="modo3"><?php echo $fechaActaTesis[$i]; ?></td>
		    				<td class="modo4"><?php echo $centroCostoP[$i]; ?></td>
		    				<td class="modo3"><?php echo $nivel[$i]; ?></td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $hEval[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
			</tr>
				<?php	
						} 
					}
				}
			?>
		
		<!-- TOTAL HORAS TRABAJOS DE GRADO -->
		<tr class="tr">
			<td colspan=7 class="total"><?php echo CHtml::activeLabel($model,'totalTrabGrado'); ?></td>
  			<td class="totalText"><?php echo $hTrabGrado; ?></td>
 		</tr>
</table>

<p></p>
<p></p>
<!-- 2.2 PROYECTOS DE INVESTIGACION -->  
<h4><?php echo CHtml::activeLabel($model,'investigacion'); ?></h4>
<table class="table">
	
		<tr class="tr">
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'codigo'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'tituloProyecto'); ?></td>
		    <td colspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'actaFacultad'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'proyectoCurricular'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'centroCosto'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'funcion'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'horasSem'); ?></td>
 		</tr> 	
		<tr class="tr">
			<td class="modo1"><?php echo CHtml::activeLabel($model,'numero'); ?></td>
			<td class="modo1"><?php echo CHtml::activeLabel($model,'fecha'); ?></td>
		</tr>
		<tr class="tr">	
		<?php
			for ($i=0; $i<$nTrabajoGrado; $i++){ 
				if ($i == 0){
			?>
					<td class="modo4"><?php echo $codigoTrabajo[$i] ?></td>
		    		<td class="modo3"><?php echo $titulo[$i] ?></td>
		    		<td class="modo3"><?php echo $noActaTesis[$i] ?></td>
		    		<td class="modo3"><?php echo $fechaActaTesis[$i] ?></td>
		    		<td class="modo4"><?php echo $centroCostoP[$i] ?></td>
		    		<td class="modo3"><?php echo $nivel[$i] ?></td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $hEval[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0){
			?>
						<tr class="tr">
							<td class="modo4"><?php echo $codigoTrabajo[$i]; ?></td>
		    				<td class="modo3"><?php echo $titulo[$i]; ?></td>
		    				<td class="modo3"><?php echo $noActaTesis[$i]; ?></td>
		    				<td class="modo3"><?php echo $fechaActaTesis[$i]; ?></td>
		    				<td class="modo4"><?php echo $centroCostoP[$i]; ?></td>
		    				<td class="modo3"><?php echo $nivel[$i]; ?></td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $hEval[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
			</tr>
				<?php	
						} 
					}
				}
			?>
		
		<!-- TOTAL HORAS TRABAJOS DE GRADO -->
		<tr class="tr">
			<td colspan=7 class="total"><?php echo CHtml::activeLabel($model,'totalTrabGrado'); ?></td>
  			<td class="totalText"><?php echo $hTrabGrado; ?></td>
 		</tr>
</table>

<!-- TOTAL HORAS POR ACTIVIDADES DE INVESTIGACION -->
<table class="table">
		<tr class="tr">
			<td colspan=7 class="total"><?php echo CHtml::activeLabel($model,'totalInvestigacion'); ?></td>
  			<td class="totalText">a</td>
 		</tr>
</table>

<hr>
<p></p>
<!-- 3. ACTIVIDADES DE EXTENSION -->  
<h3><?php echo CHtml::activeLabel($model,'actividadesExtension'); ?></h3>
<table class="table">
	
		<tr class="tr">
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'codigo'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'nombreProyecto'); ?></td>
		    <td colspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'actaDepto'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'proyectoCurricular'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'centroCosto'); ?></td>
		    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'horasSem'); ?></td>
 		</tr> 	
		<tr class="tr">
			<td class="modo1"><?php echo CHtml::activeLabel($model,'numero'); ?></td>
			<td class="modo1"><?php echo CHtml::activeLabel($model,'fecha'); ?></td>
		</tr>
		<tr class="tr">		
		<?php
			for ($i=0; $i<$nTrabajoGrado; $i++){ 
				if ($i == 0){
			?>
					<td class="modo4"><?php echo $codigoTrabajo[$i] ?></td>
		    		<td class="modo3"><?php echo $titulo[$i] ?></td>
		    		<td class="modo3"><?php echo $noActaTesis[$i] ?></td>
		    		<td class="modo3"><?php echo $fechaActaTesis[$i] ?></td>
		    		<td class="modo4"><?php echo $centroCostoP[$i] ?></td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $hEval[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0){
			?>
						<tr class="tr">
							<td class="modo4"><?php echo $codigoTrabajo[$i]; ?></td>
		    				<td class="modo3"><?php echo $titulo[$i]; ?></td>
		    				<td class="modo3"><?php echo $noActaTesis[$i]; ?></td>
		    				<td class="modo3"><?php echo $fechaActaTesis[$i]; ?></td>
		    				<td class="modo4"><?php echo $centroCostoP[$i]; ?></td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $hEval[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
			</tr>
				<?php	
						} 
					}
				}
			?>
		
		<!-- TOTAL HORAS EXTENSION -->
		<tr class="tr">
			<td colspan=6 class="total"><?php echo CHtml::activeLabel($model,'totalExtension'); ?></td>
  			<td class="totalText"><?php echo $hTrabGrado; ?></td>
 		</tr>
</table>


<hr>
<p></p>
<!-- 4. ACTIVIDADES GESTION INSTITUCIONAL -->  
<h3><?php echo CHtml::activeLabel($model,'actividadesGestion'); ?></h3>
    
<table class="table">
	
		<tr class="tr">
		    <td colspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'tipoActividad'); ?></td>
		    <td class="modo1"><?php echo CHtml::activeLabel($model,'descripcion'); ?></td>
		    <td class="modo1"><?php echo CHtml::activeLabel($model,'centroCostoProyecto'); ?></td>
		    <td class="modo1"><?php echo CHtml::activeLabel($model,'horasSem'); ?></td>
 		</tr> 	
		<tr class="tr">
			<td rowspan=3 colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_1'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					
					if ($i == 0 and $codigoGestion[$i] == 1){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 1){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr>
		
		<tr class="tr">
			<td colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_2'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 2){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 2){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr>
		<tr class="tr">
			<td colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_3'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 3){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 3){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr>
		<tr class="tr">
			<td colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_4'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 4){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 4){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr
		><tr class="tr">
			<td colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_5'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 5){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 5){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr>
		<tr class="tr">
			<td colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_6'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 6){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 6){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr>
		<tr class="tr">
			<td colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_7'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 7){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 7){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr>
		<tr class="tr">
			<td colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_8'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 8){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 8){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr>
		<tr class="tr">
			<td colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_9'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 9){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 9){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr>
		<tr class="tr">
			<td colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_10'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 10){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 19){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr>
		<tr class="tr">
			<td colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_11'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 11){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 11){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr>
		<tr class="tr">
			<td colspan=2 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_12'); ?></td>
			<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 12){
				?>
					<td class="modo4"><?php echo $nomGestion[$i] ?></td>
		    		<td class="modo3">Costo no se</td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0  and $codigoGestion[$i] == 12){
						?>
						    <tr class="tr">
							<td class="modo4"><?php echo $nomGestion[$i]; ?></td>
		    				<td class="modo3">Costo no se</td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
							</tr>
							
			<?php	
						} 
					}
				}
			?>
		</tr>
		<tr class="tr">
			<td rowspan=7 class="modo1_1"><?php echo CHtml::activeLabel($model,'4_13'); ?></td>
		</tr>
		<?php
				for ($i=0; $i<$nGestion; $i++){ 
					if ($i == 0 and $codigoGestion[$i] == 13){
				?>
							
			
		<tr class="tr">
			<td class="modo1"><?php echo CHtml::activeLabel($model,'comiteInst'); ?></td>
			<td class="modo3"></td>
			<td class="modo4"></td>
			<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		
		<tr>
			<td class="modo1"><?php echo CHtml::activeLabel($model,'ciarp'); ?></td>
			<td class="modo3"></td>
			<td class="modo4"></td>
			<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
		<tr>
			<td class="modo1"><?php echo CHtml::activeLabel($model,'consDepto'); ?></td>
			<td class="modo3"></td>
			<td class="modo4"></td>
			<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
		<tr>
			<td class="modo1"><?php echo CHtml::activeLabel($model,'consFac'); ?></td>
			<td class="modo3"></td>
			<td class="modo4"></td>
			<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
		<tr>
			<td class="modo1"><?php echo CHtml::activeLabel($model,'consAcad'); ?></td>
			<td class="modo3"></td>
			<td class="modo4"></td>
			<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
		<tr>
			<td class="modo1"><?php echo CHtml::activeLabel($model,'consSup'); ?></td>
			<td class="modo3"></td>
			<td class="modo4"></td>
			<td class="modo4"><?php echo CHtml::textField('Text', $horasGestion[$i],
											 array('id'       => 'hEval', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
		<?php	
						} 
					}
			?>
		
		<!-- TOTAL HORAS GESTION 1 -->
		<tr class="tr">
			<td colspan=4 class="total"><?php echo CHtml::activeLabel($model,'totalHoras'); ?></td>
  			<td class="totalText"><?php echo $hGestion ?></td>
 		</tr>
	
</table>


<!-- NUMERAL 4.14 -->
<table class="table">
<tr colspan=3 class="modo1"><?php echo CHtml::activeLabel($model,'4_14'); ?></tr>
	<tr class="tr">
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'codigo'); ?></td>
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'nombreP'); ?></td>
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'centroCosto'); ?></td>
	    <td colspan=6 width="30px" class="modo1"><?php echo CHtml::activeLabel($model,'horario'); ?></td>
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'horasSem'); ?></td>
 	</tr> 	
	<tr class="tr">
		<td class="modo1"><?php echo CHtml::activeLabel($model,'lunes'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'martes'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'miercoles'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'jueves'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'viernes'); ?></td>
		<td class="modo1"><?php echo CHtml::activeLabel($model,'sabado'); ?></td>
	</tr>
	
	<tr class="tr">
		<?php
			for ($i=0; $i<$nPlanDes; $i++){ 
				if ($i == 0){
			?>
					<td class="modo4"><?php echo $codigoProy[$i] ?></td>
		    		<td class="modo3"><?php echo $tituloProy[$i] ?></td>
		    		<td class="modo4"><?php echo $centroCostoProy[$i] ?></td>
		    		<td class="modo4">
		    		<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'L'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'M'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'W'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'J'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'V'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'S'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
		    		
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horas[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i > 0){
							
			?>
					<td class="modo4"><?php echo $codigoProy[$i] ?></td>
		    		<td class="modo3"><?php echo $tituloProy[$i] ?></td>
		    		<td class="modo4"><?php echo $centroCostoProy[$i] ?></td>
		    		<td class="modo4">
		    		<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'L'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'M'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'W'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'J'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'V'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
			    		<td class="modo4">
			    			<?php 
								for ($k=0; $k<count($horarioPlanDes); $k=$k+2){
									if ($horarioPlanDes[$k][0] == $codigoProy[$i]){
										if ($horarioPlanDes[$k][1] == 'S'){
											echo $horarioPlanDes[$k][2] . " - " . $horarioPlanDes[$k+1][2];
										}
										else
										{
											?>&nbsp;<?php
										}
									}
								}
							?>
			    		</td>
		    		
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horas[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
			</tr>
				<?php	
						} 
					}
				}
			?>	
 		</tr>
 		
 		<!-- TOTAL NUMERAL 4.14 -->
		<tr class="tr">
			<td colspan=9 class="total"><?php echo CHtml::activeLabel($model,'totalHoras'); ?></td>
  			<td class="totalText"><?php echo $hPlanDesDocente; ?></td>
 		</tr>
</table>

<!-- NUMERAL 4.15 -->
<table class="table">
	<tr colspan=3 class="modo1"><?php echo CHtml::activeLabel($model,'4_15'); ?></tr>
	<tr class="tr">
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'tipoSituacion'); ?></td>
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'centroCosto'); ?></td>
	    <td colspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'termino'); ?></td>
	    <td colspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'actoAdmin'); ?></td>
	    <td rowspan=2 class="modo1"><?php echo CHtml::activeLabel($model,'horasSem'); ?></td>
	</tr> 	
		<tr class="tr">
			<td class="modo1"><?php echo CHtml::activeLabel($model,'desde'); ?></td>
			<td class="modo1"><?php echo CHtml::activeLabel($model,'hasta'); ?></td>
			<td class="modo1"><?php echo CHtml::activeLabel($model,'numero'); ?></td>
			<td class="modo1"><?php echo CHtml::activeLabel($model,'fecha'); ?></td>
		</tr>
	<tr class="tr">	
	<?php
			for ($i=0; $i<$nSitAdmin; $i++){ 
				if ($i == 0){
			?>
					<td class="modo3"><?php echo $nomSituacion[$i] ?></td>
		    		<td class="modo4"><?php echo $centroCosto[$i] ?></td>
		    		<td class="modo4"><?php echo $desde[$i] ?></td>
		    		<td class="modo4"><?php echo $hasta[$i] ?></td>
		    		<td class="modo4"><?php echo $actoAdmin[$i] ?></td>
		    		<td class="modo4"><?php echo $fechaActoAdmin[$i] ?></td>
		    		<td class="modo4"><?php echo CHtml::textField('Text', $horas[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
		</tr>
			<?php	
					}
					else{
						if ($i < $nSitAdmin){
			?>
						<tr class="tr">
							<td class="modo3"><?php echo $nomSituacion[$i] ?></td>
		    				<td class="modo4"><?php echo $centroCosto[$i] ?></td>
		    				<td class="modo4"><?php echo $desde[$i] ?></td>
		    				<td class="modo4"><?php echo $hasta[$i] ?></td>
		    				<td class="modo4"><?php echo $actoAdmin[$i] ?></td>
		    				<td class="modo3"><?php echo $fechaActoAdmin[$i] ?></td>
		    				<td class="modo4"><?php echo CHtml::textField('Text', $horas[$i],
											 array('id'       => 'hActAdmin', 
											       'width'    => 5,
											       'size'     => 10, 
											       'maxlength'=> 5)); ?></td>
			</tr>
				<?php	
						} 
					}
				}
			?>	
 		</tr>
 		
 		<!-- TOTAL NUMERAL 4.15 -->
		<tr class="tr">
			<td colspan=6 class="total"><?php echo CHtml::activeLabel($model,'totalHoras'); ?></td>
  			<td class="totalText"><?php echo $hSitAdmin; ?></td>
 		</tr>
</table>

<!-- TOTAL HORAS POR ACTIVIDADES ACADEMICAS DE DOCENCIA -->
<table class="table">
		<tr class="tr">
			<td colspan=6 class="total"><?php echo CHtml::activeLabel($model,'totalGestion'); ?></td>
  			<td class="totalText"><?php echo $horasTotalActividades ?></td>
 		</tr>
</table>


<p></p>
<hr>
<p></p>
<!------------ TOTALES ------------>  
<table class="table">
	<tr class="tr">
	    <td class="modo1"><?php echo CHtml::activeLabel($model,'horasDocencia'); ?></td>
	    <td class="modo1"><?php echo CHtml::activeLabel($model,'horasInves'); ?></td>
	    <td class="modo1"><?php echo CHtml::activeLabel($model,'horasExt'); ?></td>
	    <td class="modo1"><?php echo CHtml::activeLabel($model,'horasGestion'); ?></td>
	    <td class="modo1"><?php echo CHtml::activeLabel($model,'horasSemana'); ?></td>
 	</tr> 	

 	<tr class="tr">
 		<td class="modo4"><?php echo $horasTotalActividades ?></td>
 		<td class="modo4"></td>
 		<td class="modo4"></td>
 		<td class="modo4"></td>
 		<td class="modo4"></td>		
	</tr>
</table>

<!------------ OBSERVACIONES ------------>  
<table class="table">
	<tr colspan=3 class="modo1"><?php echo CHtml::activeLabel($model,'observaciones'); ?></tr>
	<?php echo CHtml::textArea('Text', '',
 							array('id'=>'idTextField', 
       							  'width'=>300, 
       							  'cols'=>115,
       							  'rows'=>5,
       							  'maxlength'=>1000)); ?>
	    

</table>


