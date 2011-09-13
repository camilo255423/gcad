<?php $documento = $this->documentoProfesor;   ?>
<div id="indice">


<?php echo CHtml::button("Imprimir",array("onclick"=>"
                                      window.open('index.php?r=trabajos/imprimir&documento='+document.getElementById('documentoProfesor').value);"



                                        ));?>





<?php echo CHtml::hiddenField("documentoProfesor",$this->documentoProfesor); ?>

<?php echo CHtml::button("Editar",array("onclick"=>"

                                             jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/Editar','cache':false,'data':{documentoProfesor:+document.getElementById('documentoProfesor').value},'success':function(html){jQuery('#indice').replaceWith(html)}});"



                                        ));?>

   <?php
        $cursos = new Cursos($documento,true);
        $models = $cursos->getEspacios();
        $practicas = $cursos->getPracticas();
        $this->renderPartial('//docencia/index',array('models'=>$models,'practicas'=>$practicas));
    ?>





    <!-- 2. ACTIVIDADES DE INVESTIGACION -->

    <h3>2. Actividades de Investigación</h3>

    <?php
        $trabajos = new TrabajosGrado($documento);
        $models = $trabajos->getModels();
        $this->renderPartial('//trabajosGrado/index', array('models'=>$models));
        ?>
    <?php

        $trabajos = new ProyectosInvestigacion($documento);
        $models = $trabajos->getModels();

        $this->renderPartial('//proyectosInvestigacion/index', array('models'=>$models));

    ?>
     <!-- 3. ACTIVIDADES DE EXTENSION -->

    <h3>3. Actividades de Extensión</h3>
        <?php

        $trabajos = new ProyectosExtension($documento);
        $models = $trabajos->getModels();

        $this->renderPartial('//proyectosExtension/index', array('models'=>$models));

    ?>
<!-- 4. ACTIVIDADES DE  GESTION-->

    <h3>4. Actividades de Gestión</h3>
        <?php $actividades = new ActividadesGestion($documento);
        $models=$actividades->getModels();

         $this->renderPartial('//actividadesgestion/index',array('models'=>$models));
         ?>
  <!-- 4.14 PROYECTOS PLAN DE DESARROLLo-->
        <?php

        $trabajos = new ProyectosPlanDesarrollo($documento);
        $models = $trabajos->getModels();

        $this->renderPartial('//proyectosPlanDesarrollo/index', array('models'=>$models));

    ?>
</div>
