<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trabajo
 *
 * @author Camilo
 */
abstract class Trabajo extends CActiveRecord {
    //put your code here
    protected $errores=array();
    public $nombreProyectoCurricular="" ;

    abstract public function getIdName();
    abstract public function crearNuevo();

    public function findAllByAttributes($attributes,$condition='',$params=array())
    {
        $models = parent::findAllByAttributes($attributes,$condition, $params);
        foreach($models as $model)
        {
               $proyecto = Programa::model()->findByAttributes(array('centroCostoPrograma'=>$model->centroCostoPrograma));
                if($proyecto!=null)
                $model->nombreProyectoCurricular = $proyecto["nombre"];

        }

        return $models;
    }

      
               /**
                *
                * @param <type> $attribute
                * @param <type> $params
                */
		public function verificarDuplicados($attribute,$params)
		{
		 if($this->hasCustomErrors())
		 {
		  $this->addError($attribute,"Está asignando el trabajo al profesor más de una vez");
		  }
		}
               /**
                *
                * @param <type> $error
                */

                public function addCustomError($error)
                {
                   array_push($this->errores, $error);
                }
               /**
                *
                * @return <type>
                */
                public function hasCustomErrors()
                {
                  return (count($this->errores)>0);
                }
             

}
?>
