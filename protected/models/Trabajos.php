<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trabajos
 *
 * @author Camilo
 */
class Trabajos {
    //put your code 
    protected $modelName="";
    protected $model;
    protected $models;
    protected $documentoProfesor;
    public $valido=true;
    function Trabajos($documentoProfesor)
    {
       // $this->documentoProfesor = $documentoProfesor;
    
       //  $this->models=$this->model->findAllByAttributes(array('documentoProfesor'=>$this->documentoProfesor));
        /*
        $this->model=TrabajoGrado::model();
        $this->documentoProfesor = $documentoProfesor;
        $modelName="TrabajoGrado";
     
         $this->models=$this->model->findAllByAttributes(array('documentoProfesor'=>$this->documentoProfesor));

         */

    }
    function getModels()
    {
  
      return $this->models;

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
                             $models[$i]= $this->model->findByPk($post[$w][$idName]);

				if($models[$i]==null)
				{
				  $models[$i]=$this->crearNuevo();
				}
				else
				{
					$models[$i]["horas"]=$post[$w]["horas"];
				}
				$i++;
			}



		}
		$num=count($models);
			if(!($models[$num-1]->getIsNewRecord()))
				{
				  $models[$num]=$this->crearNuevo();
				}
          $this->models=$models;

    }
    function guardar($post)
    {
        $documento=$this->documentoProfesor;
        $idName=$this->getIdName();
        $n=count($post);
        $models = $this->model->findAllByAttributes(array('documentoProfesor'=>$documento));
        foreach($models as $model)
	{
            //// Pone en NULL aquellos trabajos que ya no pertenezcan al profesor
            $found=$this->findByCodigo($post,$model);
            if(!$found)
            {
                $model->documentoProfesor=new CDbExpression('NULL'); // asignar null prof
		$model->horas=0;
		$model->save();

            }
	 }

	// Actualiza los trabajos con la c�dula profesor y las horas asignadas
       for($w=0;$w<$n;$w++)
	{

       $model= $this->model->findByPk($post[$w][$idName]);
	if($model!=null)
            {
                $model->horas=$post[$w]["horas"]; //update
                $model->documentoProfesor=$documento; //update
                $model->save();

            }
	}//finfor

			

    }
    public function crearNuevo()
    {
       
       return $this->model->crearNuevo();
    }
    private function getIdName()
    {
        return $this->model->getIdName();
    }
    public function validation($post)
    {
        $documento=$this->documentoProfesor;
	$validation=true;
        $n=count($post);
        $idName=$this->getIdName();
       
        for($w=0;$w<$n;$w++)
		{
			$models[$w]=$this->model->findByPk($post[$w][$idName]);
			if($models[$w]==null)
			{
			$models[$w]=$this->crearNuevo();
			}
			else
			{
			$models[$w]["horas"]=$post[$w]["horas"];
			$validation = $validation & $models[$w]->validate("horas");
                        }
		}
               $validation = $validation & $this->validarDuplicados($models);
               $this->models=$models;
               $this->valido =$validation;
               return $validation;

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
 public function getTrabajos()
	{
     
	   $arr = array();
	   $models = $this->model->findAll();
            $idName=$this->getIdName();

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

}
?>
