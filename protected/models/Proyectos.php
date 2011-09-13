<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proyectos
 *
 * @author Camilo
 */
class Proyectos {
    //put your code here
    protected $model;
    protected $proyectosModel;
    protected $models;
    protected $documentoProfesor;
    public $valido=true;
        function Proyectos($documentoProfesor)
         {
            /*
         $this->proyectosModel=ProyectoInvestigacion::model();
         $this->model=  ProfesorInvestigacion::model();
         $this->documentoProfesor = $documentoProfesor;
         $this->models=$this->model->findAllByAttributes(array('documentoProfesor'=>$this->documentoProfesor),'',array('Model'=>$this->proyectosModel));
         */
         }
     function getModels()
    {

      return $this->models;

    }
     private function getIdName()
    {
        return $this->model->getIdName();
    }
    function actualizar($post)
    {
        $num=count($post);
	$models=array();
        $idName=$this->getIdName();

		for($w=0,$i=0;$w<$num;$w++)
		{
		     if( $post[$w][$idName]!=-1)
			 {
                         
                           $models[$i]= $this->model->getModel($post[$w][$idName],  $this->proyectosModel, $this->documentoProfesor);

				if($models[$i]==null)
				{
				  $models[$i]=$this->model->crearNuevo();
                                  $models[$i][$idName]=-2;
				}
				else
				{
					$models[$i]->cargarDatos($post[$w]);
				}
				$i++;
			}



		}
		$num=count($models);

                if($models[$num-1][$idName]!=-2)
		{
		$models[$num]=$this->model->crearNuevo();
		}
                
          $this->models=$models;

    }
     public function validation($post)
    {
        $documento=$this->documentoProfesor;
	$validation=true;
        $n=count($post);
        $idName=$this->getIdName();
        for($w=0,$i=0;$w<$n;$w++)
		{
                           $models[$i]= $this->model->getModel($post[$w][$idName],  $this->proyectosModel, $this->documentoProfesor);
				if($models[$i]==null)
				{
				  $models[$i]=$this->model->crearNuevo();
				}
				else
				{
					$models[$i]->cargarDatos($post[$w]);
                                        $models[$i]->documentoProfesor = $this->documentoProfesor;
                                        $validation = $validation & $models[$w]->validate("horas");
				}
				$i++;

		}
               $validation = $validation & $this->validarDuplicados($models);
               $this->models=$models;
               $this->valido=$validation;
               return $validation;

    }
    function guardar($post)
    {
        $idName=$this->getIdName();
        $n=count($post);
        $models=$this->model->findAllByAttributes(array('documentoProfesor'=>$this->documentoProfesor),'',array('Model'=>$this->proyectosModel));
        foreach($models as $model)
	{
            //// Pone en NULL aquellos trabajos que ya no pertenezcan al profesor
            $found=$this->findByCodigo($post,$model);
            if(!$found)
            {
        	$model->delete();
            }
	 }

	// Actualiza los trabajos con la c�dula profesor y las horas asignadas

                for($w=0;$w<$n;$w++)
		{
                           $model= $this->model->getModel($post[$w][$idName],  $this->proyectosModel, $this->documentoProfesor);

				if($model!=null)
				{
    					$model->cargarDatos($post[$w]);
                                        $model->documentoProfesor=$this->documentoProfesor; //update
                                        $model->save();
				}
                               

		}



    }
       	public function findByCodigo($trabajos,$model)
	{
		$n=count($trabajos);
                $k=0;
                $idName=$this->getIdName();
		while($k<$n)
                {
                    if($trabajos[$k][$idName]==$model[$idName])
                    {
                    return true;
                    }
		$k++;
		}

		return false;
	}
     public function getTrabajos()
	{
         
	   $arr = array();
	   $models = $this->proyectosModel->findAll();
           $idName=$this->model->getIdName();

     	 foreach($models as $i=>$model)
      	{
        	$arr[] = array(
          	'label'=>$model->titulo,  // label for dropdown list
          	'value'=>$model->titulo,  // value for input field
          	'id'=>$model[$idName],            // return value from autocomplete
        	);

      	}
		return $arr;
	}
          public function validarDuplicados($trabajos)
	{
         $idName=$this->getIdName();
         $n=count($trabajos);
         $valido=true;
	 for ($i=0;$i<$n;$i++)
		  {
                     for($j=$i+1;$j<$n;$j++)
                     {
                         if($trabajos[$i][$idName]==$trabajos[$j][$idName])
                         {
                             $trabajos[$j]->addCustomError("Trabajo Duplicado");
                             $trabajos[$j]->validate("titulo");
                             $valido=false;
                         }

                     }

		  }

        return $valido;
	}
}
?>
