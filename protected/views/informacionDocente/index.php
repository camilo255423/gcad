<!-- INFORMACION GENERAL -->

<h2>INFORMACION GENERAL</h2>
<table class="table">
	<tr class="tr">
		<td class="modo1_1">Apellidos</td>
		<td class="modo2"><?php echo $model->apellido1 ." ". $model->apellido2; ?></td>
		<td class="modo1_1">Nombres</td>
		<td class="modo2"><?php echo $model->nombre1 ." ". $model->nombre2; ?></td>
		<td class="modo1_1">Documento de Identidad No. </td>
		<td class="modo2"><?php echo $model->documentoProfesor; ?></td>
	</tr>
	<tr class="tr">
		<td class="modo1_1">Facultad</td>
		<td class="modo2"><?php echo $model->rDepartamento->rFacultad->nombre; ?></td>
		<td class="modo1_1">Departamento</td>
		<td class="modo2"><?php echo $model->rDepartamento->nombre; ?></td>
		<td class="modo1_1">Periódo Académico</td>
		<td class="modo2">
		</td>
	</tr>
	<tr class="tr">
		<td class="modo1_1">Tipo de Vinculación</td>
		<td class="modo2"><?php echo $model->rVinculacion->nombre; ?></td>
		<td class="modo1_1">Dedicación</td>
		<td class="modo2"><?php echo $model->rDedicacion->nombre; ?></td>
		<td class="modo1_1">Categoría</td>
		<td class="modo2"><?php echo $model->rCategoria->nombre; ?></td>
	</tr>
</table>
