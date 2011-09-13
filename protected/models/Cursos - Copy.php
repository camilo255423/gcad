<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cursos
 *
 * @author Camilo
 */
class Cursos {
    public $cursos;
    private $documentoProfesor;
    function Cursos($documento)
    {
        $this->documentoProfesor = $documento;
        $this->loadAll();
    }
    function getCursos()
    {
        return $this->cursos;
    }
    function loadAll()
    {
        $cursos=array();
        $models = CursoProfesor::model()->findAllByAttributes(array('documentoProfesor'=>$this->documentoProfesor));
        
        if($models!=null)
        {
        foreach($models as $model)
        {
            
            $asignatura = Asignatura::model()->findByAttributes(array('codigoAsignatura'=>$model->codigoAsignatura));
            $curso = Curso::model()->findByAttributes(array('codigoAsignatura'=>$model->codigoAsignatura,'grupo'=>$model->grupo));
            array_push($cursos,new CCurso($asignatura,$curso,$model));
        }
        }
        $this->cursos=$cursos;
    }
    function getEspacios()
    {
        $espacios=array();
        foreach($this->cursos as $model)
        {
            if($model->asignatura->practica==0)
                    array_push($espacios,$model);
        }

     return $espacios;
    }
        function getPracticas()
    {
        $practicas=array();
        foreach($this->cursos as $model)
        {
            if($model->asignatura->practica==1)
                    array_push($practicas,$model);
        }

     return $practicas;
    }
}
?>
