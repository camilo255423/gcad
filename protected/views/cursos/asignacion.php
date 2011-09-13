<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cursos-profesores-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo CHtml::submitButton('Editar',array('name'=>'editar','submit'=>'index.php?r=cursos/asignar')); ?>
<table class="table">
<tr class="modo1"><td class="modo1" width="7%">Código</td><td class="modo1" width="7%">Grupo</td><td class="modo1" width="20%">Nombre </td><td class="modo1" width="25%">Horarios</td><td class="modo1">Docente</td></tr>

<?php foreach($grupos as $grupo):?>
<?php $profesores = $grupo->rCursoProfesor; ?>
<?php if(count($profesores)>0): ?>
<tr>
<td class="modo3"><?php echo $grupo->codigoAsignatura ?></td>
<td class="modo3"><?php echo $grupo->grupo ?></td>
<td class="modo3"><?php $grupo->rAsignatura->nombre; ?></td>
<td class="modo3">
<?php
$c = Curso::model()->findByAttributes(array('codigoAsignatura'=>$grupo->codigoAsignatura,'grupo'=>$grupo->grupo));
$horarios=$c->getHorarios(); 
$dias = array_keys($horarios);
foreach ($dias as $dia) 
echo "$dia $horarios[$dia] , ";
?>
</td>
<td class="modo3"><?php if ($grupo->r))
{
$p=Profesor::model()->findByPk($curso->documentoProfesor); 
echo "$p->apellido1 $p->apellido2 $p->nombre1 $p->nombre2";
}
else  echo "-Sin Asignar-";
 ?></td>

</tr>
<?php endforeach; ?>
</table>
 
<?php echo CHtml::submitButton('Editar',array('name'=>'editar','submit'=>'index.php?r=cursos/asignar')); ?>
<?php $this->endWidget(); ?>
</div><!-- form -->