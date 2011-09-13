<?php

class TrabajosGradoController extends Controller
{
     /**
      * Indice
      *
      */
        public function actionIndex()
        {
        $documento='80213456';
        $models = TrabajoGrado::model()->findAllByAttributes(array('documentoProfesor'=>$documento));
        $programas = $this->getProyectosCurriculares($models);
        $this->render('index', array('models'=>$models,'programas'=>$programas));
        }
        public function actionEditar()
        {
        $documento='80213456';
        $models = TrabajoGrado::model()->findAllByAttributes(array('documentoProfesor'=>$documento));
        $programas = $this->getProyectosCurriculares($models);
	$arr = $this->getTrabajos();
	$trabajo=new TrabajoGrado;
        array_push($models, $trabajo);
        $this->render('editar', array('models'=>$models,'arr'=>$arr,'programas'=>$programas));
        }
	public function actionGuardar()
	{
	 $documento='80213456';    
	  $validation=true;
	  $n=count($_POST['TrabajoGrado']);
	  // VALIDACION DE DATOS
	  for($w=0;$w<$n;$w++)
		{
			$models[$w]=TrabajoGrado::model()->findByPk($_POST['TrabajoGrado'][$w]["codigoTrabajo"]);
			if($models[$w]==null)		
			{
			$models[$w]=new TrabajoGrado;
			}
			else
			{
			$models[$w]["horas"]=$_POST['TrabajoGrado'][$w]["horas"];
			$validation = $validation & $models[$w]->validate("horas");
                        }
		}
               $validation = $validation & $this->validarDuplicados($models);
		//////////////////////////
		if(!$validation)
		{
	   	$arr = $this->getTrabajos();
        	$this->render('editar', array('models'=>$models,'arr'=>$arr,$programas));
                }
		else
		{
		 		 $models = TrabajoGrado::model()->findAllByAttributes(array('documentoProfesor'=>$documento));
		 		 foreach($models as $model)
	   			 { 
				     // Pone en NULL aquellos trabajos que ya no pertenezcan al profesor
				     $found=$this->findByCodigo($_POST['TrabajoGrado'],$model);		
							 if(!$found)
							 {
						
							  $model->documentoProfesor=new CDbExpression('NULL'); // asignar null prof
							  $model->horas=0;
							  $model->codigoTrabajo;
							  $model->save();
							  
							 }
	   				}

				// Actualiza los trabajos con la c�dula profesor y las horas asignadas
				
					for($w=0;$w<$n;$w++)
					{
					   $model= TrabajoGrado::model()->findByPk($_POST['TrabajoGrado'][$w]["codigoTrabajo"]);
						if($model!=null)		
							{
							         
									$model->horas=$_POST['TrabajoGrado'][$w]["horas"]; //update
									$model->documentoProfesor=$documento; //update
									$model->save();
								
							}
					}//finfor
				
			  $this->actionIndex(); //Guardado con éxito, redirecciona al index
			}		// fin else
		
	      
	}	
	////////////////////////////
	///////////////////////////
    public function actionUpdateAjax()
      {
	  
	$documento='80213456'; 
	$models = TrabajoGrado::model()->findAllByAttributes(array('documentoProfesor'=>$documento));
	$arr = $this->getTrabajos();   
        $programas = $this->getProyectosCurriculares($models);
	
		$num=count($_POST['TrabajoGrado']);
		$models=array();
	
		for($w=0,$i=0;$w<$num;$w++)
		{
		     if( $_POST['TrabajoGrado'][$w]["codigoTrabajo"]!=-1)
			 {
                $models[$i]= TrabajoGrado::model()->findByPk($_POST['TrabajoGrado'][$w]["codigoTrabajo"]);
			     
				if($models[$i]==null)
				{
				
				  $models[$i]=new TrabajoGrado;
			
				 // $models[$i]->codigoTrabajo=-2;
				}
				else
				{
				    
					$models[$i]["horas"]=$_POST['TrabajoGrado'][$w]["horas"];
			
				}
				$i++;
			}
			
            
		      
		}
		$num=count($models);
			if(!($models[$num-1]->getIsNewRecord()))
				{
				  $models[$num]=new TrabajoGrado;
				}
	
      	$this->renderPartial('_ajaxContent', array('models'=>$models,'arr'=>$arr, 'programas'=>$programas), false, true);
		

		
	}
	public function getTrabajos()
	{
	   $arr = array();
	     $models = TrabajoGrado::model()->findAll();
	 
     	 foreach($models as $i=>$model)
      	{
        	$arr[] = array(
          	'label'=>$model->titulo,  // label for dropdown list
          	'value'=>$model->titulo,  // value for input field
          	'id'=>$model->codigoTrabajo,            // return value from autocomplete
        	);
			
      	}
		return $arr;
	}
	public function validarHoras($model)
	{
	    $mensaje=array();
		$mensaje[1]="El n�mero de horas de pregrado debe ser como m�ximo 1";
		$mensaje[2]="El n�mero de horas de pregrado debe ser como m�ximo 2";
		if($model->horas>$model->nivel)
		{
		$model->addCustomError($mensaje[$model->nivel],"horas");
		echo "error adicionado controlador";
		}
		
	}
	public function validarDuplicados($trabajos)
	{
         $n=count($trabajos);
         $valido=true;
	 for ($i=0;$i<$n;$i++)
		  {
                     for($j=$i+1;$j<$n;$j++)
                     {
                         if($trabajos[$i]["codigoTrabajo"]==$trabajos[$j]["codigoTrabajo"])
                         {
                             $trabajos[$j]->addCustomError("Trabajo Duplicado");
                             $trabajos[$j]->validate("titulo");
                             $valido=false;
                         }

                     }

		  }

        return $valido;
	}
        function getProyectosCurriculares($models)
        {
            $proyectos = array();
            foreach($models as $model)
            {
                $proyecto = Programa::model()->findByAttributes(array('centroCostoPrograma'=>$model->centroCostoPrograma));
                if($proyecto==null)
                array_push($proyectos, "");
                else
                array_push($proyectos, $proyecto["nombre"]);
            }
            return  $proyectos;
        }
	public function findByCodigo($trabajos,$model)
	{
							$n=count($trabajos);
							$k=0;
							while($k<$n)
							{ 
							echo $trabajos[$k]["codigoTrabajo"]." ".$model->codigoTrabajo."-";
							   if($trabajos[$k]["codigoTrabajo"]==$model->codigoTrabajo)
							   {
							   return true;
							   }
							   $k++;
							}
							
		return false;					
	} 
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}


	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}