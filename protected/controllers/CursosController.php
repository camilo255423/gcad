<?php

class CursosController extends Controller
{

	
	public function actionIndex()
	{
$programa = Programa::model()->findByPk('25');
			
		$cursos = $programa->rAsignaturaPrograma;
		/*
		foreach($cursos as $curso)
		{
		$grupos = $curso->rGrupo;
			foreach($grupos as $grupo)
			{
			echo "</br>".$grupo->codigoAsignatura."-".$grupo->grupo;
			    $profesores = $grupo->rCursoProfesor;
				foreach($profesores as $profesor)
				{
				    
					if($profesor->rprofesor!=null)
					{
					echo $profesor->rprofesor->nombre1." ".$profesor->rprofesor->apellido1." ".$profesor->rprofesor->apellido2;
					}
					
				}
				
			}
        
		}	
		*/
		$this->render('asignacion',array(
			'cursos'=>$cursos));
			
			
	}
	public function actionAsignar()
	{
	$validacion=0;
	$models=array();
	$connection=Yii::app()->db;   // assuming you have configured a "db" 
    $command=$connection->createCommand("SELECT curso.codigoAsignatura as codigoAsignatura , curso.grupo as grupo, documentoProfesor FROM curso left join cursoprofesor on curso.codigoAsignatura=cursoprofesor.codigoAsignatura and curso.grupo=cursoprofesor.grupo where curso.centroCostoPrograma=25 order by  curso.codigoAsignatura,curso.grupo");   
	$items=$command->queryAll();
	$num = count($items);
	//////////////////////
		if(isset($_POST['CursoProfesor']))
		{
			$filas=$_POST['CursoProfesor'];
			$nfilas=count($filas);
			$i=0;
			foreach($filas as $f=>$fila)
        	{
			       if($_POST['n'.$f]==2)
				  {
				 
				  $model=new CursoProfesor;
					$model->codigoAsignatura=$items[$i-1]["codigoAsignatura"];
					$model->grupo=$items[$i-1]["grupo"];
					$model->horasTutoria=0;
					$model->horasEvaluacion=0;
					$model->horasPreparacion=0;
					$model->compartido=true;
				
					}
				  else if($_POST['n'.$f]==1)
				  {
					$model=new CursoProfesor;
					$model->codigoAsignatura=$items[$i]["codigoAsignatura"];
			 		$model->grupo=$items[$i]["grupo"];
					$model->horasTutoria=0;
					$model->horasEvaluacion=0;
					$model->horasPreparacion=0;
					
			        $i++;
	
				  }
				  else if ($_POST['n'.$f]==0)
				  {
				 $model=$this->loadModel($items[$i]["codigoAsignatura"],$items[$i]["documentoProfesor"],$items[$i]["grupo"]);
					$i++;
					
				  }
				  array_push($models,$model);
				  
				  if(isset($_POST["yt".$f]))
				  {
				    $model=new CursoProfesor;
				
					$model->codigoAsignatura=$items[$i-1]["codigoAsignatura"];
					$model->grupo=$items[$i-1]["grupo"];
					$model->compartido=true;
					$model->horasTutoria=0;
					$model->horasEvaluacion=0;
					$model->horasPreparacion=0;
					 array_push($models,$model);
				  }
				 
			 } //for -each 
			 
			
			  if(isset($_POST['guardar']))
			  {	
			  
			      $models2=array();
		          foreach($models as $i=>$model)
				  {
				 // array_push($models2,new CursoProfesor);
				  	if(isset($_POST['CursoProfesor'][$i]))
					{
					$models2[$i]->codigoAsignatura = $model->codigoAsignatura;
					$models2[$i]->grupo = $model->grupo;
					$models2[$i]->documentoProfesor = $_POST['CursoProfesor'][$i]['documentoProfesor'];
				 		
				 	}
				  }
				  
			 	  foreach($models as $i=>$model)
				  {
				   
						if(isset($_POST['CursoProfesor'][$i]))
						{
						
						$anteriorID = $model->documentoProfesor;
						$model->attributes=$_POST['CursoProfesor'][$i];
				
						
						if(!isset($model->documentoProfesor) || $model->documentoProfesor==0)
						{
						   if(!$model->getIsNewRecord())
						   {
							$model->documentoProfesor=$anteriorID;
							$model->delete();
							}
						
						}
						else
						{
						     $this->validarHorarios($model,$models2);
							 $validacion=$validacion+$model->numErrores();
							 $model->save();
						
						}
						
					}//if isset($_POST['CursoProfesor'][$i]
						 
					}// for-each model
			
					
						
			
			} //if save
			
			
	}//if post
	else 
	{ //else POST	

		for($i=0;$i<$num;$i++)
		{	    
			$model=null;
				if(isset($items[$i]["codigoAsignatura"]) && isset($items[$i]["documentoProfesor"]) && isset($items[$i]["grupo"]))
				{
				 $model=$this->loadModel($items[$i]["codigoAsignatura"],$items[$i]["documentoProfesor"],$items[$i]["grupo"]);
				 }
			if($model==null)
		   {
			array_push($models,new CursoProfesor);
			$models[$i]->codigoAsignatura=$items[$i]["codigoAsignatura"];
			$models[$i]->grupo=$items[$i]["grupo"];
			
			}
			else
			array_push($models, $model);
		}
	}	
       if(isset($_POST['guardar']) && $validacion==0)
	   {
	   $this->actionIndex();	
	   }
	   else{

          $this->render('asignar',array(
			'cursos'=>$models));
			}
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
	function validarHorarios($model2,$models)
	{
	   $model2->clearErrors();
		      
	       foreach ($models as $model)
		   {
		       if(isset($model->codigoAsignatura) )
			   {
		
			     if($model->documentoProfesor==$model2->documentoProfesor && !($model->codigoAsignatura==$model2->codigoAsignatura && $model->grupo==$model2->grupo))
				 { 
				   $curso1 =  Curso::model()->findByPk(array('codigoAsignatura'=>$model->codigoAsignatura,'grupo'=>$model->grupo));
				   $curso2 = Curso::model()->findByPk(array('codigoAsignatura'=>$model2->codigoAsignatura,'grupo'=>$model2->grupo));
				   if($curso1->isCruzado($curso2))
				   {
				    $model2->addCustomError("Cruce de horarios ".$curso2->toString()." ".$curso1->toString());   
				
					}
				 }
				 }
			 
		   }
		  
		
	
	}
	public function loadModel($codigoAsignatura,$documentoProfesor,$grupo)
	{
		$model=CursoProfesor::model()->with('rprofesor')->findByPk(array('codigoAsignatura'=>$codigoAsignatura,'documentoProfesor'=>$documentoProfesor,'grupo'=>$grupo));
	   // $model=CursoProfesor::model()->findByPk(int($id));
                
		return $model;
	}
}