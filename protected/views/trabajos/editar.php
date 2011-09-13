<div id="trabajos" class="form">
<?php echo CHtml::button("Guardar",array("onclick"=>"
                                          
                                             var formDocencia = $('#formDocencia').serialize();
                                             var formTrabajos = $('#formTrabajos').serialize();
                                             var formInvestigacion = $('#formInvestigacion').serialize();
                                             var formExtension = $('#formExtension').serialize();
                                             var formGestion = $('#formGestion').serialize();
                                             var formPlanDesarrollo = $('#formPlanDesarrollo').serialize();
                                             jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/Guardar','cache':false,'data':formDocencia + '&' + formTrabajos + '&' + formInvestigacion + '&' + formExtension + '&' + formGestion + '&' + formPlanDesarrollo,'success':function(html){jQuery('#trabajos').replaceWith(html)}});"



                                        ));?>


    <?php
        $modelsCursos = $cursos->getEspacios();
        $practicas = $cursos->getPracticas();
        $modelsTrabajos = $trabajos->getModels();
          $arrTrabajos = $trabajos->getTrabajos();
          $modelsInvestigacion = $investigacion->getModels();
          $arrInvestigacion = $investigacion->getTrabajos();

          if(isset($valido))
          {
          $trabajo=new TrabajoGrado;
          array_push($modelsTrabajos, $trabajo);
          }
          if(isset($valido)){
          $trabajo=new ProfesorInvestigacion;
          array_push($modelsInvestigacion, $trabajo);
          }

        echo CHtml::errorSummary(array_merge($modelsCursos,$modelsTrabajos,$modelsInvestigacion));

        $this->renderPartial('//docencia/editar',array('models'=>$modelsCursos,'practicas'=>$practicas));
    ?>


   <h3>2. Actividades de Investigación</h3>

<?php

         $this->renderPartial('//trabajosGrado/editar', array('models'=>$modelsTrabajos,'arr'=>$arrTrabajos),false, true);

//investigacion
          $this->renderPartial('//proyectosInvestigacion/editar', array('models'=>$modelsInvestigacion,'arr'=>$arrInvestigacion),false, true);

//EXTENSION
          $modelsExtension = $extension->getModels();
          $arrExtension = $extension->getTrabajos();
          if(isset($valido)){
          $trabajo=new ProfesorExtension();
          array_push($modelsExtension, $trabajo);
          }
         $this->renderPartial('//proyectosExtension/editar', array('models'=>$modelsExtension,'arr'=>$arrExtension),false, true);
         //Actividades de Gestión

         $modelsGestion=$actividades->getModels();
         $this->renderPartial('//actividadesgestion/editar',array('models'=>$modelsGestion));


          //proyectos plan de desarrollo
          $modelsProyectos = $proyectos->getModels();
          $arrProyectos = $proyectos->getTrabajos();

          if(isset($valido)){
               
          $trabajo=new ProfesorProyectoPlan();
          array_push($modelsProyectos, $trabajo);
          }
          $this->renderPartial('//proyectosplandesarrollo/editar', array('models'=>$modelsProyectos,'arr'=>$arrProyectos),false, true);

         ?>
       

</div>