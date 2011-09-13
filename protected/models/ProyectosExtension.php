<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProyectosExtension
 *
 * @author Camilo
 */
class ProyectosExtension extends Proyectos {
    //put your code here
    function ProyectosExtension($documentoProfesor)
    {
         $this->proyectosModel=ActividadExtension::model();
         $this->model=  ProfesorExtension::model();
         $this->documentoProfesor = $documentoProfesor;
         $this->models=$this->model->findAllByAttributes(array('documentoProfesor'=>$this->documentoProfesor),'',array('Model'=>$this->proyectosModel));
     
    }
}
?>
