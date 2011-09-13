<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cursos-profesores-form',
	'enableAjaxValidation'=>false,
)); ?>
	
<?php echo CHtml::submitButton('Guardar',array('name'=>'guardar')); ?>
<table class="table">
<tr class="modo1"><td class="modo1" width="4%"></td><td class="modo1" width="7%">Código</td><td class="modo1" width="7%">Grupo</td><td class="modo1" width="20%">Nombre </td><td class="modo1" width="15%">Horarios</td><td class="modo1">Docente</td></tr>

<?php foreach($cursos as $i=>$curso): ?>
<tr>
<td class="modo3"><?php echo CHtml::submitButton('b'+$i); ?>
<td class="modo3"><?php echo $curso->codigoAsignatura ?></td>
<td class="modo3"><?php echo $curso->grupo ?></td>
<?php if ($curso->compartido) $x=2; else if($curso->getIsNewRecord()) $x=1; else $x=0; ?>
<?php echo CHtml::hiddenField("n".$i,$x); ?>

<td class="modo3"><?php $c=Asignatura::model()->findByPk($curso->codigoAsignatura); echo $c->nombre; ?></td>
<td class="modo3">
<?php
$c = Curso::model()->findByPk(array('codigoAsignatura'=>$curso->codigoAsignatura,'grupo'=>$curso->grupo));
$horarios=$c->getHorarios(); 
$dias = array_keys($horarios);
foreach ($dias as $dia) echo "$dia $horarios[$dia] , ";
?>
</td>
<td class="modo3"><?php //echo CHtml::activeDropDownList($curso,"[$i]documentoProfesor", CHtml::ListData(Profesor::model()->findAllBySql("select documentoProfesor, concat(apellido1,' ',apellido2,' ',nombre1, ' ',nombre2) as nombre1 from profesor order by nombre1"),'documentoProfesor','nombre1'),array('empty'=>'--Sin Asignar--')); ?>
<?php echo CHtml::activeHiddenField($curso,"[$i]documentoProfesor"); ?>
<?php $nombreProfesor=$curso->rprofesor->apellido1." ".$curso->rprofesor->apellido2." ".$curso->rprofesor->nombre1." ".$curso->rprofesor->nombre2; ?>
<?php if($nombreProfesor=="   ")  $nombreProfesor="";?>
<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name'=>'buscar'.$i,
                                        'value'=>$nombreProfesor,
                                        'source'=>'index.php?r=trabajos/completar',
                                        // additional javascript options for the autocomplete plugin
                                        'options'=>array(
                                            'minLength'=>'4',
                                                    'select' => "js:function(event, ui){
                                                       document.getElementById('buscar$i').value=ui.item.value;
                                                       document.getElementById('CursoProfesor_".$i."_documentoProfesor').value=ui.item.id;
                                              }"


                                      


                                        ),
                                        'htmlOptions'=>array('size'=>'45'
                                           
                                        ),
                                    ));
                                   ?>
    <?php echo CHtml::imageButton(Yii::app()->request->baseUrl.'/images/del.jpg',array("name"=>"", "value"=>"","type"=>"button","onclick"=>" document.getElementById('buscar$i').value='';document.getElementById('CursoProfesor_".$i."_documentoProfesor').value=0; return false;")); ?>

    <?php echo $form->error($curso,'documentoProfesor'); ?>
</td>

</tr>
<?php endforeach; ?>
</table>
 
<?php echo CHtml::submitButton('Guardar',array('name'=>'guardar')); ?>
<?php $this->endWidget(); ?>
</div><!-- form -->