<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProyectosPlanDesarrollo
 *
 * @author Camilo
 */
class ProyectosPlanDesarrollo extends Proyectos{
     function ProyectosPlanDesarrollo($documentoProfesor)
    {
         $this->proyectosModel=ProyectoPlanDesarrollo::model();
         $this->model= ProfesorProyectoPlan::model();
         $this->documentoProfesor = $documentoProfesor;
         $this->models=$this->model->findAllByAttributes(array('documentoProfesor'=>$this->documentoProfesor),'',array('Model'=>$this->proyectosModel));
    }
}
?>
