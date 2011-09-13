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
    function Cursos($documento, $cargarTodos )
    {
        $this->documentoProfesor = $documento;
        if($cargarTodos)
        {
        $this->loadAll();
        }
    }
    function validar($post)
    {
      
       $valido=true;
       foreach($this->cursos as $i=>$model)
        {
             if($model->rcurso->rasignatura->practica==0)
             {
            $model->horasTutoria = $post[$i]["horasTutoria"];
            $model->horasPreparacion = $post[$i]["horasPreparacion"];
            $model->horasEvaluacion = $post[$i]["horasEvaluacion"];
            $valido = $valido & $model->validate("horasTutoria");
             }

        }
        return $valido;
    }
    function Guardar($post)
    {
        $models = $this->cursos;
        foreach($models as $i=>$model)
        {
             if($model->rcurso->rasignatura->practica==0)
             {
            $model->horasTutoria = $post[$i]["horasTutoria"];
            $model->horasPreparacion = $post[$i]["horasPreparacion"];
            $model->horasEvaluacion = $post[$i]["horasEvaluacion"];
            $model->save();
             }
        }


    }
    function getCursos()
    {
        return $this->cursos;
    }
    function loadAll()
    {
        
        $models = CursoProfesor::model()->with('rcurso.rasignatura','rcurso.rprograma')->findAllByAttributes(array('documentoProfesor'=>$this->documentoProfesor));
        
        $this->cursos=$models;
    }
    function getEspacios()
    {
        $espacios=array();
        foreach($this->cursos as $model)
        {
            if($model->rcurso->rasignatura->practica==0)
                    array_push($espacios,$model);
        }

     return $espacios;
    }
    function getPracticas()
    {
        $practicas=array();
        foreach($this->cursos as $model)
        {
            if($model->rcurso->rasignatura->practica==1)
                    array_push($practicas,$model);
        }

     return $practicas;
    }
}
?>
