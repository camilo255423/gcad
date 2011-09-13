<?php

class PlanTrabajoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
						
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('findCedula', 'findNombre', 'tutoria'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
		{	
	
			
		$model=new planTrabajo;
		if(isset($_POST['cedula']))		
		{
	        if($_POST['cedula']!=-1)
			{
				echo "cedula";
				echo $_POST['cedula'];
			}
		}
		if(isset($_POST['apellido']))		
		{
	        if($_POST['apellido']!=-1)
			{
				echo "apellido";
				echo $_POST['apellido'];
			}
		}
		
		// Recuperacion cedula / apellido
		if(isset($_POST['cedula']))		
		{
			if ($_POST['cedula'] !=-1)
			{
				$model = planTrabajo::model()->findByPk($_POST['cedula']);
				//$this->render('admin',array(
				//'model'=>$model,
				//));

			}
			else
			{
				if ($_POST['apellido'] !=-1)
				{
					$model = planTrabajo::model()->findByPk($_POST['apellido']);
				}
			}
			echo "if22";
			$vinculacion  = $model->vinculacion;
			$departamento = $model->departamento;
			$dedicacion   = $model->dedicacion;
			$categoria    = $model->categoria;
			echo "if3";
			
			//Informacion Basica del Docente
			$connection=Yii::app()->db;
			$sql1 = "SELECT facultad.nombre as facultad ".
					"FROM facultad as facultad ".
					"WHERE facultad.centroCostoFacultad = $departamento->centroCostoFacultad";
			
			$command1 = $connection->createCommand($sql1);
			$facultad = $command1->queryAll();
			$nombreFacultad = $facultad[0]["facultad"];
			
			//Cantidad de Cursos del Docente
			$sql2 = "SELECT COUNT(*) as numero FROM cursoprofesor WHERE cursoprofesor.documentoProfesor = $model->documentoProfesor";
			
			$command2 = $connection->createCommand($sql2);
			$nCursos = $command2->queryAll();
			$numeroCursos = $nCursos[0]["numero"];
			
			//Codigo Asignaturas, Grupos y Nombres
			$sql3 = "SELECT cursoprofesor.codigoAsignatura as codigoAsignatura, cursoprofesor.grupo as grupo, asignatura.nombre as nombre, ".
					"cursoprofesor.horasTutoria as hTutoria, cursoprofesor.horasPreparacion as hPreparacion, cursoprofesor.horasEvaluacion as hEval, ".
					"programa.centroCostoPrograma as costoProg, programa.nombre as nProg, asignatura.horas as horas, asignatura.practica as practica ".
			        "FROM cursoprofesor, asignatura, programa, curso ".
			        "WHERE cursoprofesor.documentoProfesor = $model->documentoProfesor ".
			        "AND cursoprofesor.codigoAsignatura = asignatura.codigoAsignatura ".
			        "AND cursoprofesor.grupo = curso.grupo ".
			        "AND curso.codigoAsignatura = asignatura.codigoAsignatura ".
			        "AND programa.centroCostoPrograma = curso.centroCostoPrograma ";
			
			$command3 = $connection->createCommand($sql3);
			$docencia = $command3->queryAll();
			
			$practica0          = 0;
			$practica1          = 0;
			$horasTotalDocencia = 0;
			$horasTotalApoyo    = 0;
	$codigoAsignatura[] = 0;
				$grupo[]            = 0;
				$nombreAsignatura[] = 0;
				$hTutoria[]         = 0;
				$hPreparacion[]     = 0;
				$hEval[]         = 0;
				$nombrePrograma[]   = 0;
				$costoPrograma[]    = 0;
				$horas[]            = 0;
				$practica[]         = 0;
						
			for ($i=0; $i<$numeroCursos; $i++){
				$codigoAsignatura[$i] = $docencia[$i]["codigoAsignatura"];
				$grupo[$i]            = $docencia[$i]["grupo"];
				$nombreAsignatura[$i] = $docencia[$i]["nombre"];
				$hTutoria[$i]         = $docencia[$i]["hTutoria"];
				$hPreparacion[$i]     = $docencia[$i]["hPreparacion"];
				$hEval[$i]            = $docencia[$i]["hEval"];
				$nombrePrograma[$i]   = $docencia[$i]["nProg"];
				$costoPrograma[$i]    = $docencia[$i]["costoProg"];
				$horas[$i]            = $docencia[$i]["horas"];
				$practica[$i]         = $docencia[$i]["practica"];
				
				//Total de horas
				$horasTotalDocencia = $horasTotalDocencia + $horas[$i];
				$horasTotalApoyo = $horasTotalApoyo + $hTutoria[$i] + $hPreparacion[$i] + $hEval[$i];
				
				//Divide horas de asignaturas practicas y no practicas
				if ($docencia[$i]["practica"] == 0){
					$practica0++ ;
				}
				else{
					$practica1++ ;
				}
				
			}
			
			//Total Actividades Academicas Docencia
			$horasTotalActividades = $horasTotalDocencia + $horasTotalApoyo;
			
			
			
			//Horario Asignaturas
            $sql4 = "SELECT cursoprofesor.codigoAsignatura as codigoAsignatura, horarios.hora as horaAsig, horarios.dia as diaAsig ".
					"FROM cursoprofesor, horarios ".
					"WHERE cursoprofesor.documentoProfesor = $model->documentoProfesor ".
					"AND horarios.codigoAsignatura = cursoprofesor.codigoAsignatura ".
					"AND horarios.grupo = cursoprofesor.grupo ";                   
			
			$command4 = $connection->createCommand($sql4);
			$hAsig = $command4->queryAll();
			
			$j = 0;
			$horario[][] = 0;
			for ($i=0; $i<count($hAsig); $i++){
				$horario[$i][$j] = $hAsig[$i]["codigoAsignatura"];
				$horario[$i][$j+1] = $hAsig[$i]["diaAsig"];
				$horario[$i][$j+2] = $hAsig[$i]["horaAsig"];
				$j = 0;
			}
			
			
			//Trabajos de Grado
            $sql5 = "SELECT trabajogrado.codigoTrabajo as codigoTrabajo, trabajogrado.titulo as titulo, trabajogrado.noActa as noActaTesis, ".
            		"trabajogrado.fechaActa as fechaActaTesis, trabajogrado.centroCostoPrograma as centroCostoP, trabajogrado.nivel as nivel ".
					"FROM trabajogrado ".
					"WHERE trabajogrado.documentoProfesor = $model->documentoProfesor ";
			
			$command5 = $connection->createCommand($sql5);
			$trabGrado = $command5->queryAll();
			
			$nTrabajoGrado      = 0;
			$codigoTrabajo[]      = 0; 
			$titulo[]             = 0;
			$noActaTesis[]        = 0;
			$fechaActaTesis[]     = 0;
			$centroCostoP[]       = 0;
			$nivel[]              = 0;
			$hTrabGrado         = 0;
			
			for ($i=0; $i<count($trabGrado); $i++){
				$codigoTrabajo[$i]  = $trabGrado[$i]["codigoTrabajo"];
				$titulo[$i]         = $trabGrado[$i]["titulo"];
				$noActaTesis[$i]    = $trabGrado[$i]["noActaTesis"];
				$fechaActaTesis[$i] = $trabGrado[$i]["fechaActaTesis"];
				$centroCostoP[$i]   = $trabGrado[$i]["centroCostoP"];
				$nivel[$i]          = $trabGrado[$i]["nivel"];
				
				$nTrabajoGrado = $nTrabajoGrado + 1;
				$hTrabGrado = $hTrabGrado + 0;
			}
			
			//Actividades Gestion Institucional - Numerales 4.1 al 4.13
            $sql6 = "SELECT actividadgestion.nombre as nombreGestion, profesorgestion.horas as horasGestion, ".
            		"actividadgestion.codigoActividadGestion as codigoGestion ".
					"FROM profesor, actividadgestion, profesorgestion ".
					"WHERE profesor.documentoProfesor = $model->documentoProfesor ".
					"AND profesor.documentoProfesor = profesorgestion.documentoProfesor ".
					"AND actividadgestion.codigoActividadGestion = profesorgestion.codigoActividadGestion ";
			
			$command6 = $connection->createCommand($sql6);
			$gestion = $command6->queryAll();
			
			$nomGestion[]      = '';
			$codigoGestion[]    = 0; 
			$horasGestion[]    = 0; 
			$nGestion = 0;
			$hGestion = 0;
			
			for ($i=0; $i<count($gestion); $i++){
				$codigoGestion[$i]   = $gestion[$i]["codigoGestion"];
				$nomGestion[$i]   = $gestion[$i]["nombreGestion"];
				$horasGestion[$i] = $gestion[$i]["horasGestion"];
				
				$nGestion         = $nGestion + 1;
				$hGestion         = $hGestion + $horasGestion[$i];
			}
			
			//4.14 Plan Desarrollo Institucional
            $sql7 = "SELECT proyectoplandesarrollo.titulo as titulo, proyectoplandesarrollo.noActa as noActa, ".
            		"proyectoplandesarrollo.fechaActa as fechaActa, proyectoplandesarrollo.codigoProyecto as codigo, ".
            		"proyectoplandesarrollo.centroCostoPrograma as centroCosto ".
					"FROM profesor, proyectoplandesarrollo, profesorproyectoplan ".
					"WHERE profesor.documentoProfesor = $model->documentoProfesor ".
					"AND profesorproyectoplan.documentoProfesor = profesor.documentoProfesor ".
					"AND proyectoplandesarrollo.codigoProyecto = profesorproyectoplan.codigoProyecto ";
			
			$command7 = $connection->createCommand($sql7);
			$planDes = $command7->queryAll();
			
			$tituloProy[]      = '';
			$noActaProy[]      = 0; 
			$fechaActaProy[]   = 0;
			$centroCostoProy[] = 0;
			$horasProy[]       = 0;
			$nPlanDes      = 0;
			$hPlanDes      = 0;
			$codigoProy[] = 0;
			for ($i=0; $i<count($planDes); $i++){
				$codigoProy[$i] = $planDes[$i]["codigo"];
				$tituloProy[$i]      = $planDes[$i]["titulo"];
				$noActaProy[$i]      = $planDes[$i]["noActa"];
				$fechaActaProy[$i]   = $planDes[$i]["fechaActa"];
				$centroCostoProy[$i] = $planDes[$i]["centroCosto"];
				$horasProy[$i]       = 0;
				
				$nPlanDes = $nPlanDes + 1;
			}
			
			//Horario Plan Desarrollo
            $sql8 = "SELECT horariosproyectosplandesarrollo.hora as horaProy, horariosproyectosplandesarrollo.dia as diaProy, ".
            		"horariosproyectosplandesarrollo.codigoProyecto as codigoProy ".
					"FROM profesor, horariosproyectosplandesarrollo, profesorproyectoplan ".
					"WHERE profesor.documentoProfesor = $model->documentoProfesor ".
					"AND profesorproyectoplan.codigoProyecto = horariosproyectosplandesarrollo.codigoProyecto ";
			
			$command8 = $connection->createCommand($sql8);
			$hPlanDes = $command8->queryAll();
			
			
			$j = 0;
			$horarioPlanDes = 0;
			for ($i=0; $i<count($hPlanDes); $i++){
				$horarioPlanDes[$i][$j] = $hPlanDes[$i]["codigoProy"];
				$horarioPlanDes[$i][$j+1] = $hPlanDes[$i]["diaProy"];
				$horarioPlanDes[$i][$j+2] = $hPlanDes[$i]["horaProy"];

				$j = 0;
			}
			
			$hPlanDesDocente = 0;
			$k = count($hPlanDes)-2;
			
			for ($i=0; $i<=$k ; $i=$i+2){
				$hPlanDesDocente = $hPlanDesDocente + ($horarioPlanDes[$i+1][2] - $horarioPlanDes[$i][2]);
			}
			
			
			//4.15 Situacion Administrativa
            $sql9 = "SELECT profesorsituacionadministrativa.desde as desde, profesorsituacionadministrativa.hasta as hasta, ".
            		"profesorsituacionadministrativa.noActoAdministrativo as actoAdmin, ".
            		"profesorsituacionadministrativa.fechaActoAdministrativo as fechaActoAdmin, profesor.centroCostoDepartamento as centroCosto, ".
            		"profesorsituacionadministrativa.horas, situacionadministrativa.nombre as nomSituacion ".
					"FROM profesor, situacionadministrativa, profesorsituacionadministrativa ".
					"WHERE profesor.documentoProfesor = $model->documentoProfesor ".
					"AND profesorsituacionadministrativa.documentoProfesor = profesor.documentoProfesor ".
					"AND situacionadministrativa.codigoSituacion = profesorsituacionadministrativa.codigoSituacion ";
			
			$command9 = $connection->createCommand($sql9);
			$sitAdmin = $command9->queryAll();
			
			$nomSituacion      = '';
			$desde             = 0; 
			$hasta             = 0;
			$actoAdmin         = 0;
			$fechaActoAdmin    = 0;
			$centroCosto       = 0;
			$horas            = 0;
			$nSitAdmin          = 0;
			$hSitAdmin          = 0;
			
			for ($i=0; $i<count($sitAdmin); $i++){
				$nomSituacion[$i]   = $sitAdmin[$i]["nomSituacion"];
				$desde[$i]          = $sitAdmin[$i]["desde"];
				$hasta[$i]          = $sitAdmin[$i]["hasta"];
				$actoAdmin[$i]      = $sitAdmin[$i]["actoAdmin"];
				$fechaActoAdmin[$i] = $sitAdmin[$i]["fechaActoAdmin"];
				$centroCosto[$i]    = $sitAdmin[$i]["centroCosto"];
				$horas[$i]          = $sitAdmin[$i]["horas"];
				
				$nSitAdmin = $nSitAdmin + 1;
				$hSitAdmin = $hSitAdmin + $horas[$i];
			}
	
			
			
			echo "PRactica!!!!!!!!!!!!!!!!!!!!!!!!!!!".$nSitAdmin;
			echo "Departamento!!!!!!!!!!!!!!!!!!!!!!!!!!!".$model->departamento->nombre;
			//$model->$nombreFacultad;
			$this->render('admin',array(
				'model'=>$model,
				'nombreFacultad'=>$nombreFacultad,
				'numeroCursos'=>$numeroCursos,
				'codigoAsignatura'=>$codigoAsignatura,
				'grupo'=>$grupo,
				'nombreAsignatura'=>$nombreAsignatura,
				'hTutoria'=>$hTutoria,
				'hPreparacion'=>$hPreparacion,
				'hEval'=>$hEval,
				'nombrePrograma'=>$nombrePrograma,
				'costoPrograma'=>$costoPrograma,
				'horas'=>$horas,
				'practica'=>$practica,
				'practica0'=>$practica0,
				'practica1'=>$practica1,
				'horario'=>$horario,
				'horasTotalDocencia'=>$horasTotalDocencia,
				'horasTotalApoyo'=>$horasTotalApoyo,
				'horasTotalActividades'=>$horasTotalActividades,
				//Trabajo de Grado
				'nTrabajoGrado'=>$nTrabajoGrado,
				'codigoTrabajo'=>$codigoTrabajo,
				'titulo'=>$titulo,
				'noActaTesis'=>$noActaTesis,
				'fechaActaTesis'=>$fechaActaTesis,
				'centroCostoP'=>$centroCostoP,
				'nivel'=>$nivel,
				'hTrabGrado'=>$hTrabGrado,
				//Gestion
				'codigoGestion'=>$codigoGestion,
				'nomGestion'=>$nomGestion,
				'horasGestion'=>$horasGestion,
				'hGestion'=>$hGestion,
				'nGestion'=>$nGestion,        
				//Plan Desarrollo
				'codigoProy'=>$codigoProy,
				'tituloProy'=>$tituloProy,
				'noActaProy'=>$noActaProy,
				'fechaActaProy'=>$fechaActaProy,
				'centroCostoProy'=>$centroCostoProy,
				'horasProy'=>$horasProy,
				'nPlanDes'=>$nPlanDes,
				'hPlanDes'=>$hPlanDes,
				'horarioPlanDes'=>$horarioPlanDes,
				'hPlanDesDocente'=>$hPlanDesDocente,
				//Situacion Administrativa
				'nomSituacion'=>$nomSituacion,
				'desde'=>$desde,
				'hasta'=>$hasta,
				'actoAdmin'=>$actoAdmin,
				'fechaActoAdmin'=>$fechaActoAdmin,
				'centroCosto'=>$centroCosto,
				'horas'=>$horas,
				'nSitAdmin'=>$nSitAdmin,
				'hSitAdmin'=>$hSitAdmin
				
				));
			
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['planTrabajo']))
		{
			$model->attributes = $_POST['planTrabajo'];
	
			if($model->save())
			{
			}
				//$this->redirect(array('admin','id'=>$model->documentoProfesor));
		}

		$this->render('create',array(
			'model'=>$model//, 'nombreFacultad'=>$nombreFacultad
		));
		




	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['planTrabajo']))
		{
			$model->attributes=$_POST['planTrabajo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->documentoProfesor));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('planTrabajo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new planTrabajo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['planTrabajo']))
			$model->attributes=$_GET['planTrabajo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=planTrabajo::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='planTrabajo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	/**
	 * Performs Actions for GCAD.
	 */
	
	// Autocomplete cedula profesor
    public function actionFindCedula()
    {
	    if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
		{
			/* q is the default GET variable name that is used by
			/ the autocomplete widget to pass in user input
			*/
			$name = $_GET['q'];
			// this was set with the "max" attribute of the CAutoComplete widget
			$limit = min($_GET['limit'], 50);
			$criteria = new CDbCriteria;
			$criteria->condition = "documentoProfesor LIKE :sterm";
			$criteria->params = array(":sterm"=>'%'.$name.'%');
			$criteria->limit = $limit;
			$SiteArray = plantrabajo::model()->findAll($criteria);
			$returnVal = '';
			foreach($SiteArray as $Site)
			{
				$returnVal .= $Site->getAttribute('documentoProfesor').'|'.$Site->getAttribute('documentoProfesor')."\n";
				echo $returnVal;
			}
       }
    }  
    
    // Autocomplete nombre profesor
    public function actionFindNombre()
    {
	    if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
		{
			/* q is the default GET variable name that is used by
			/ the autocomplete widget to pass in user input
			*/
			$name = $_GET['q'];
			// this was set with the "max" attribute of the CAutoComplete widget
			$limit = min($_GET['limit'], 50);
			$criteria = new CDbCriteria;
			$criteria->condition = "apellido1 LIKE :sterm";
			$criteria->params = array(":sterm"=>'%'.$name.'%');
			$criteria->limit = $limit;
			$SiteArray = plantrabajo::model()->findAll($criteria);
			$returnVal = '';
			foreach($SiteArray as $Site)
			{
				$returnVal .= $Site->getAttribute('apellido1').'|'.$Site->getAttribute('documentoProfesor')."\n";
				echo $returnVal;
			}
       }
    }      
}



