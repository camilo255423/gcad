<?php

class TrabajosGradoController extends Controller
{
     
	public function actionIndex()
	{ 
       $documento='80213456';    
       $models = TrabajoGrado::model()->findAllByAttributes(array('documentoProfesor'=>$documento));
	   $arr = $this->getTrabajos();
	   $trabajo=new TrabajoGrado;
	  // $trabajo->codigoTrabajo=-2;
		array_push($models, $trabajo);
      $this->render('index', array('models'=>$models,'arr'=>$arr));
        }
	public function actionGuardar()
	{
	 $documento='80213456';    
	
	  $models = TrabajoGrado::model()->findAllByAttributes(array('documentoProfesor'=>$documento));
		$n=count($_POST['TrabajoGrado']);
	   foreach($models as $model)
	   {
	   echo "revisando!!";
	 					$found = false;
						$k=0;
					    while($k<$n && !$found)
						{ 
						   if($_POST['TrabajoGrado'][$k]["codigoTrabajo"]==$model->codigoTrabajo)
						   {
						   echo"encontradp";
						   $found=true;
						   }
						   $k++;
						}
						 if(!$found)
						 {
						 echo "delete";
						   $model->documentoProfesor=new CDbExpression('NULL'); // asignar null prof
						   $model->horas=0;
						  // $this->validarHoras($model);
						   $model->save();
						   
						 }
	   }

	
		for($w=0;$w<$n;$w++)
		{
		   $model= TrabajoGrado::model()->findByPk($_POST['TrabajoGrado'][$w]["codigoTrabajo"]);
 				if($model!=null)		
				{
						 $model->horas=$_POST['TrabajoGrado'][$w]["horas"]; //update
						 $model->documentoProfesor=$documento; //update
						  echo " update ".$model->horas." ";
						//$this->validarHoras($model);
						$this->validarDuplicados($model,$_POST['TrabajoGrado']);			  
						$model->save();
				}
		}//finfor
		for($w=0;$w<$n;$w++)
		{
			$models[$w]=TrabajoGrado::model()->findByPk($_POST['TrabajoGrado'][$w]["codigoTrabajo"]);
			if($models[$w]==null)		
				{
					$models[$w]=new TrabajoGrado;
					}
					else{
					$this->validarDuplicados($model,$_POST['TrabajoGrado']);			  
						
                                        $models[$w]["horas"]=$_POST['TrabajoGrado'][$w]["horas"];
					$models[$w]->save();
					}
		echo "num errores".count($models[$w]->errors)."-";
		}
	   $arr = $this->getTrabajos();
	
		//array_push($models, new TrabajoGrado);
      $this->render('index', array('models'=>$models,'arr'=>$arr));
	      
	}	
	////////////////////////////
	///////////////////////////
    public function actionUpdateAjax()
      {
	  
	$documento='80213456'; 
	$models = TrabajoGrado::model()->findAllByAttributes(array('documentoProfesor'=>$documento));
	   $arr = $this->getTrabajos();   
		echo "<div id='data'>";
			
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
	
      	$this->renderPartial('_ajaxContent', array('models'=>$models,'arr'=>$arr), false, true);
		

		
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
		$mensaje[1]="El número de horas de pregrado debe ser como máximo 1";
		$mensaje[2]="El número de horas de pregrado debe ser como máximo 2";
		if($model->horas>$model->nivel)
		{
		$model->addCustomError($mensaje[$model->nivel],"horas");
		echo "error adicionado controlador";
		}
		
	}
	public function validarDuplicados($model,$models)
	{
	$cont=0;
	      for($i=0;$i<count($models);$i++)
		  {
                    if($model!==null)
                    {
		     			if($models[$i]["codigoTrabajo"]==$model->codigoTrabajo)
			 			{
						$cont=$cont+1;
						 if($cont>1)
						 {
						 echo "valor conteoooo".$cont;
						 $model->addCustomError("El trabajo está asginado a este profesor más de una vez","duplicado");
						 return true;
						 }
			 			}
           			}
		  }
		
	}
	public function addCustomError($error)
	{
	   array_push($this->errores, $error);
	}
	public function numErrores()
	{
	  return count($this->errores);
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