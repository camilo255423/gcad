<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proyecto
 *
 * @author Camilo
 */
abstract class Proyecto extends Trabajo{
    //put your code here
    public $titulo;
    public $noActa;
    public $fechaActa;
    public $nombreProyectoCurricular;
    public $centroCostoPrograma;
    abstract public function cargarDatos($post);

        public function getModel($pk, $proyectosModel,$documentoProfesor)
        {
        
        $model = parent::findByAttributes(array($this->getIdName()=>$pk,'documentoProfesor'=>$documentoProfesor));
      
        $proyecto = $proyectosModel->findByPk($pk);
        if($proyecto==null)
        {
            return null;
        }
          if($model==null)
        {
            $model = $this->crearNuevo();
            $model[$this->getIdName()]=$proyecto[$this->getIdName()];
            $model->documentoProfesor = $documentoProfesor;
        }
        $model->titulo="";
        $model->titulo=$proyecto->titulo;
        $model->noActa=$proyecto->noActa;
        $model->fechaActa=$proyecto->fechaActa;
        $model->centroCostoPrograma=$proyecto->centroCostoPrograma;

               $proyecto = Programa::model()->findByAttributes(array('centroCostoPrograma'=>$proyecto->centroCostoPrograma));
                if($proyecto!=null)
                $model->nombreProyectoCurricular = $proyecto["nombre"];



        return $model;

        }

        public function findAllByAttributes($attributes,$condition='',$params=array())
        {

        $proyectosModel=$params["Model"];
        $params=array();
        $models = parent::findAllByAttributes($attributes,$condition, $params);
        foreach($models as $model)
        {
               $proyecto = $proyectosModel->findByAttributes(array($model->getIdName()=>$model[$model->getIdName()]));
               $model->titulo=$proyecto->titulo;
               $model->noActa=$proyecto->noActa;
               $model->fechaActa=$proyecto->fechaActa;
               $model->centroCostoPrograma=$proyecto->centroCostoPrograma;

               $proyecto = Programa::model()->findByAttributes(array('centroCostoPrograma'=>$proyecto->centroCostoPrograma));
                if($proyecto!=null)
                $model->nombreProyectoCurricular = $proyecto["nombre"];


        }

        return $models;
        }
      



}
?>
