<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cursos-profesores-form',
	'enableAjaxValidation'=>false,
)); ?>

<table>
<tr><th>Código</th><th>Grupo</th><th>Nombre </th><th>Horarios</th><th>Docente</th></tr>

<?php foreach($cursos as $i=>$curso): ?>
<tr>
<td><?php echo $curso->codigoAsignatura ?></td>
<td><?php echo $curso->grupo ?></td>
<td><?php $c=Asignatura::model()->findByPk($curso->codigoAsignatura); echo $c->nombre; ?></td>
<td>
<?php
$c = Curso::model()->findByPk(array('codigoAsignatura'=>$curso->codigoAsignatura,'grupo'=>$curso->grupo));
$horarios=$c->getHorarios(); 
$dias = array_keys($horarios);
foreach ($dias as $dia) echo "$dia $horarios[$dia] , ";
?>
</td>
<td><?php if (isset($curso->documentoProfesor)) 
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