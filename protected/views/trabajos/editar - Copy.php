<?php
        $documento = "80213456";
   ?>
<?php echo CHtml::button("Guardar",array("onclick"=>"
                                             alert('hola');
                                             var frm1_data = $('#form1').serialize();
                                             var frm2_data = $('#form2').serialize();
                                             jQuery.ajax({'type':'POST','url':'/gcad/index.php?r=trabajos/Guardar','cache':false,'data':frm1_data,'success':function(html){jQuery('#dataTrabajos').replaceWith(html)}});"



                                        ));?>
<div docencia>
    <?php
        $cursos = new Cursos($documento,true);
        $models = $cursos->getEspacios();
        $practicas = $cursos->getPracticas();
        $this->renderPartial('//docencia/editar',array('models'=>$models,'practicas'=>$practicas));
    ?>
</div>

<div trabajos>
   <h3>2. Actividades de Investigación</h3>

<?php
//trabajos de grado
         $trabajos = new TrabajosGrado($documento);
          $models = $trabajos->getModels();
          $arr = $trabajos->getTrabajos();
          $trabajo=new TrabajoGrado;
          array_push($models, $trabajo);
          $this->renderPartial('//trabajosGrado/editar', array('models'=>$models,'arr'=>$arr));
//investigacion
          $trabajos = new ProyectosInvestigacion($documento);
          $models = $trabajos->getModels();
          $arr = $trabajos->getTrabajos();
          $trabajo=new ProfesorInvestigacion;
          array_push($models, $trabajo);
          $this->renderPartial('//proyectosInvestigacion/editar', array('models'=>$models,'arr'=>$arr,));

          //EXTENSION
           $trabajos = new ProyectosExtension($documento);
          $models = $trabajos->getModels();
          $arr = $trabajos->getTrabajos();
          $trabajo=new ProfesorExtension();
          array_push($models, $trabajo);
         $this->renderPartial('//proyectosExtension/editar', array('models'=>$models,'arr'=>$arr,));

         //Actividades de Gestión

        $actividades = new ActividadesGestion($documento);
        $models=$actividades->getModels();

         $this->renderPartial('//actividadesgestion/editar',array('models'=>$models));


          //proyectos plan de desarrollo
           $trabajos = new ProyectosPlanDesarrollo($documento);
          $models = $trabajos->getModels();
          $arr = $trabajos->getTrabajos();
          $trabajo=new ProfesorProyectoPlan();
          array_push($models, $trabajo);
         $this->renderPartial('//proyectosplandesarrollo/editar', array('models'=>$models,'arr'=>$arr,));
       
?>

</div>