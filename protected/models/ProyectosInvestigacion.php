<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProyectosInvestigacion
 *
 * @author Camilo
 */
class ProyectosInvestigacion extends Proyectos {
    //put your code here
    function ProyectosInvestigacion($documentoProfesor)
    {
         $this->proyectosModel=ProyectoInvestigacion::model();
         $this->model=  ProfesorInvestigacion::model();
         $this->documentoProfesor = $documentoProfesor;
         $this->models=$this->model->findAllByAttributes(array('documentoProfesor'=>$this->documentoProfesor),'',array('Model'=>$this->proyectosModel));
        
    }
}
?>
