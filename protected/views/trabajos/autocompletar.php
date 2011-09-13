<div id="autoCompletar">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'autocompletar',
	'enableAjaxValidation'=>true,
)); ?>
<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
    <h1> Buscar Docente: </h1>
 <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name'=>'buscar',
                                        'value'=>'',
                                        'source'=>'index.php?r=trabajos/completar',
                                        // additional javascript options for the autocomplete plugin
                                        'options'=>array(
                                            'minLength'=>'1',
                                                    'select' => "js:function(event, ui){
                                                       document.getElementById('buscar').value='';
                                                       jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/cargarDocente','cache':false,'data':{documentoProfesor: + ui.item.id},'success':function(html){jQuery('#PlanDeTrabajo').replaceWith(html)}});return false;}"


                                      


                                        ),
                                        'htmlOptions'=>array('size'=>'100'
                                           
                                        ),
                                    ));
                                    ?>
<?php $this->endWidget(); ?>
</div>
<div id="PlanDeTrabajo"
</div>