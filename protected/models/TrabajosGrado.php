<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TrabajosGrado
 *
 * @author Camilo
 */
class TrabajosGrado extends Trabajos{
     function TrabajosGrado($documentoProfesor)
         {
         $this->model=TrabajoGrado::model();
        $this->documentoProfesor = $documentoProfesor;
        $modelName="TrabajoGrado";
      
         $this->models=$this->model->findAllByAttributes(array('documentoProfesor'=>$this->documentoProfesor));
           parent::Trabajos($documentoProfesor);

         }
}
?>
