<?php $ncursos = count($models);?>
<?php $npracticas = count($practicas);?>
<script type="text/javascript">

    function sumarHoras()
    {
      investigacion = sumarHorasTrabajo()+sumarHorasInvestigacion();
      extension = sumarHorasExtension();
      document.getElementById('totalHorasInvestigacion').innerHTML=investigacion;
      docencia = sumarHorasDocencia();
      gestion = sumarHorasGestion() + sumarHorasPlanDesarrollo();
      document.getElementById('totalHorasGestion').innerHTML=gestion;
      total=docencia+investigacion+extension+gestion;
      planDesarrollo = sumarHorasPlanDesarrollo();
      document.getElementById('horasDocenciaFinal').innerHTML=docencia;
      document.getElementById('horasInvestigacionFinal').innerHTML=investigacion;
      document.getElementById('horasExtensionFinal').innerHTML=extension;
      document.getElementById('horasGestionFinal').innerHTML=gestion;
      document.getElementById('horasSemanales').innerHTML=total;
      
     
     
    }
    function sumarHorasDocencia()
    {
        suma=0;
        docencia=0;
        apoyo=0;
        <?php $items = array('_horasTutoria','_horasPreparacion','_horasEvaluacion'); ?>

        <?php for($z=0;$z<$npracticas;$z++){ ?>
        
        <?php echo "valor=document.getElementById('practicaHoras_".$z."').innerHTML;" ?>

      
         suma=suma+parseFloat(valor);
       
        <?php }?>;

        <?php for($z=0;$z<$ncursos;$z++){ ?>
        <?php echo "valor=document.getElementById('cursoHoras_".$z."').innerHTML;" ?>
   
       
         suma=suma+parseFloat(valor);
        
        <?php }?>;
        document.getElementById('horasDocencia').innerHTML=suma;
        docencia=suma;
        suma=0;
        <?php foreach($items as $item){ ?>
        <?php for($z=0;$z<$ncursos;$z++){ ?>
        <?php echo "valor=document.getElementById('CursoProfesor_".$z.$item."').value;" ?>
       if((String(valor).search(/^\d+$/) != -1))
        {
         suma=suma+parseFloat(valor);
        }
        <?php }?>;
        <?php }?>;
        document.getElementById('horasApoyo').innerHTML=suma;
        suma = suma+docencia;
        document.getElementById('totalHorasDocencia').innerHTML=suma;
   return suma;
    }
</script>
<div id="docencia">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formDocencia',
	'enableAjaxValidation'=>true,
)); ?>

<h3>1. Actividades de Docencia</h3>

<!-- 1.1 DOCENCIA -->
<h4>1.1. Docencia</h4>

<?php echo CHtml::hiddenField("documentoProfesor",$this->documentoProfesor); ?>
<table class="table">
	<tr class="tr">
	 <td rowspan=2 class="modo1">&nbsp;</td>
	    <td rowspan=2 class="modo1" width="60">codigo</td>
	    <td rowspan=2 class="modo1">nombre</td>
	    <td rowspan=2 class="modo1">Proyecto Curricular</td>
	    <td rowspan=2 class="modo1" width="50">Centro Costo</td>
	    <td colspan=2 class="modo1" width="150">No Estudiantes</td>
	    <td colspan=6 width="240px" class="modo1">Horario</td>
	    <td rowspan=2 class="modo1"  width="40">Horas</br>/sem</td>
 	</tr>
	<tr class="tr">
		<td class="modo1">pregrado</td>
		<td class="modo1">posgrado</td>
		<td class="modo1">L</td>
		<td class="modo1">M</td>
		<td class="modo1">W</td>
		<td class="modo1">J</td>
		<td class="modo1">V</td>
		<td class="modo1">S</td>
	</tr>

	<?php foreach($models as $i=>$model) { ?>
        <?php $horarios = $model->rcurso->getHorarios(); ?>
	<tr class="tr">
	<?php if($i==0) {?><td rowspan="<?php echo $ncursos;?>" class="modo1">Espacios Académicos</td><?php }?>
	<td class="modo3"><?php echo $model->rcurso->codigoAsignatura; ?>-<?php echo $model->rcurso->grupo;?></td>
	<td class="modo3"><?php echo $model->rcurso->rasignatura->nombre; ?></td>
	<td class="modo3"> <?php echo $model->rcurso->rprograma->nombre ?></td>
	<td class="modo3"><?php echo $model->rcurso->rprograma->centroCostoPrograma; ?></td>
	<td class="modo3"><?php echo $model->rcurso->noEstudiantes; ?></td>
	<td class="modo3"></td>
	<td class="modo3"><?php if(isset($horarios['L'])) echo $horarios['L'];?></td>
	<td class="modo3"><?php if(isset($horarios['M'])) echo $horarios['M'];?></td>
	<td class="modo3"><?php if(isset($horarios['W'])) echo $horarios['W'];?></td>
	<td class="modo3"><?php if(isset($horarios['J'])) echo $horarios['J'];?></td>
	<td class="modo3"><?php if(isset($horarios['V'])) echo $horarios['V'];?></td>
	<td class="modo3"><?php if(isset($horarios['S'])) echo $horarios['S'];?></td>
        <td class="modo3"><p id="cursoHoras_<?php echo $i;?>"> <?php echo $model->rcurso->rasignatura->horas; ?></p></td>
	</tr>
         <?php } ?>
        <?php $npracticas = count($practicas);?>
	<?php foreach($practicas as $i=>$model) { ?>
        <?php $horarios = $model->rcurso->getHorarios(); ?>
	<tr class="tr">
	<?php if($i==0) {?><td rowspan="<?php echo $npracticas;?>" class="modo1">Práctica Educativa</td><?php }?>
	<td class="modo3"><?php echo $model->rcurso->codigoAsignatura; ?>-<?php echo $model->rcurso->grupo;?></td>
	<td class="modo3"><?php echo $model->rcurso->rasignatura->nombre; ?></td>
	<td class="modo3"><?php echo $model->rcurso->rprograma->nombre; ?></td>
	<td class="modo3"><?php echo $model->rcurso->centroCostoPrograma; ?></td>
	<td class="modo3"><?php echo $model->rcurso->noEstudiantes; ?></td>
	<td class="modo3"></td>
	<td class="modo3"><?php if(isset($horarios['L'])) echo $horarios['L'];?></td>
	<td class="modo3"><?php if(isset($horarios['M'])) echo $horarios['M'];?></td>
	<td class="modo3"><?php if(isset($horarios['W'])) echo $horarios['W'];?></td>
	<td class="modo3"><?php if(isset($horarios['J'])) echo $horarios['J'];?></td>
	<td class="modo3"><?php if(isset($horarios['V'])) echo $horarios['V'];?></td>
	<td class="modo3"><?php if(isset($horarios['S'])) echo $horarios['S'];?></td>
	<td class="modo3"><p id="practicaHoras_<?php echo $i;?>"> <?php echo $model->rcurso->rasignatura->horas; ?></p></td>
	</tr>
         <?php } ?>
        <!-- Total Horas Docencia -->
           <tr class="tr"><td colspan="4" class="modo3"><td colspan="9" class="modo1"><div align="right">TOTAL HORAS POR ACTIVIDADES ACADÉMICAS DE DOCENCIA</div></td><td class="modo1" id="horasDocencia">0</td></tr>

	</table>

<!-- 1.1 Apoyo a la docencia -->
<h4>1.2. Apoyo a la Docencia</h4>

<table class="table">
	<tr class="tr">
	 <td rowspan=1 class="modo1" width="260" >Tipo de Actividad</td>
	    <td rowspan=1 class="modo1" width="160">Espacio Académico</td>
	    <td rowspan=1 class="modo1">No Estudiantes</td>
	    <td rowspan=1 class="modo1">Proyecto Curricular</td>
	    <td rowspan=1 class="modo1" width="50">Centro Costo</td>
	    <td rowspan=1 class="modo1"  width="40">Horas</br>/sem</td>
 	</tr>
        <!--tutorias-->

        <?php foreach($models as $i=>$model) { ?>
        <tr class="tr">
	<?php if($i==0) {?><td rowspan="<?php echo $ncursos;?>" class="modo1">Tutoria a Estudiantes</td><?php }?>
	<td class="modo3"><?php echo $model->rcurso->codigoAsignatura; ?>-<?php echo $model->rcurso->grupo;?></td>
	<td class="modo3"><?php echo $model->rcurso->noEstudiantes; ?></td>
        <td class="modo3"><?php echo $model->rcurso->rprograma->nombre; ?></td>
	<td class="modo3"><?php echo $model->rcurso->centroCostoPrograma; ?></td>
        <td class="modo3"><?php echo CHtml::activeTextField($model, "[$i]horasTutoria",array("maxlength"=>"2","style"=>"width:20px;","onKeyUp"=>"sumarHoras();")); ?>
        <?php echo $form->error($model,'horasTutoria',array('class'=>'ek')); ?>

        </td>
        </tr>
        <!--preparacion de clase-->

         <?php } ?>
	<?php foreach($models as $i=>$model) { ?>
        <tr class="tr">
	<?php if($i==0) {?><td rowspan="<?php echo $ncursos;?>" class="modo1">Preparación, actualización, sistematización e innovación de clases</td><?php }?>
	<td class="modo3"><?php echo $model->rcurso->codigoAsignatura; ?>-<?php echo $model->rcurso->grupo;?></td>
	<td class="modo3"><?php echo $model->rcurso->noEstudiantes; ?></td>
        <td class="modo3"><?php echo $model->rcurso->rprograma->nombre; ?></td>
	<td class="modo3"><?php echo $model->rcurso->centroCostoPrograma; ?></td>
        <td class="modo3"><?php echo CHtml::activeTextField($model, "[$i]horasPreparacion",array("maxlength"=>"2","style"=>"width:20px;","onKeyUp"=>"sumarHoras();")); ?>
        <?php echo $form->error($model,'horasPreparacion',array('class'=>'ek')); ?></td>
 
        </tr>
        <?php } ?>
        <!--Evaluación-->

        <?php foreach($models as $i=>$model) { ?>
        <tr class="tr">
	<?php if($i==0) {?><td rowspan="<?php echo $ncursos;?>" class="modo1">Evaluación de Actividades</td><?php }?>
	<td class="modo3"><?php echo $model->rcurso->codigoAsignatura; ?>-<?php echo $model->rcurso->grupo;?></td>
	<td class="modo3"><?php echo $model->rcurso->noEstudiantes; ?></td>
        <td class="modo3"><?php echo $model->rcurso->rprograma->nombre; ?></td>
	<td class="modo3"><?php echo $model->rcurso->centroCostoPrograma; ?></td>
        <td class="modo3"><?php echo CHtml::activeTextField($model, "[$i]horasEvaluacion",array("maxlength"=>"2","style"=>"width:20px;","onKeyUp"=>"sumarHoras();")); ?>
        <?php echo $form->error($model,'horasEvaluacion',array('class'=>'ek')); ?></td>
 	
        </tr>
        <?php } ?>
        <!--Total Horas Apoyo-->
           <tr class="tr"><td colspan="2" class="modo3"><td colspan="3" class="modo1"><div align="right">TOTAL HORAS ACTIVIDADES DE APOYO A LA DOCENCIA</div></td><td class="modo1" id="horasApoyo">0</td></tr>
     
	</table>
 <!--Total Horas Docencia-->
        <table class="table">
         <tr class="tr"><td colspan="4" class="modo3"><td colspan="6" class="modo1"><div align="right">TOTAL HORAS POR ACTIVIDADES ACADÉMICAS DE DOCENCIA</div></td><td class="modo1" id="totalHorasDocencia" width="5%">0</td></tr>

        </table>

<?php $this->endWidget(); ?>
</div>
</div>