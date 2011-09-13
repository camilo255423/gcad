<?php

class TrabajosController extends Controller
{
        public $searchTerm;
        public $documentoProfesor;
	public function actionIndex()
	{
            $listaProfesores=Yii::app()->cache->get("listaProfesores");
            if(!$listaProfesores)
             {
               $listaProfesores=Profesor::getListado();
                Yii::app()->cache->set("listaProfesores",$listaProfesores);

            }


       // $this->render('index');
       
         $this->render('autocompletar');

       
	}
        public function actionEditar()
	{        
       
        $this->documentoProfesor =$_POST['documentoProfesor'];
        $documento=$this->documentoProfesor;
        $cursos = new Cursos($documento,true);
        $trabajos = new TrabajosGrado($documento);
        $investigacion = new ProyectosInvestigacion($documento);
        $extension = new ProyectosExtension($documento);
        $actividades = new ActividadesGestion($documento);
        $proyectos = new ProyectosPlanDesarrollo($documento);
        $this->renderPartial('editar',array('cursos'=>$cursos, 'trabajos'=>$trabajos, 'investigacion'=>$investigacion, 'extension'=>$extension,'actividades'=>$actividades,'proyectos'=>$proyectos,'valido'=>1));
         
	}
       
         public function actionUpdateAjax()
        {

        $this->documentoProfesor =$_POST['documentoProfesor'];
        $documento=$this->documentoProfesor;
        if(isset($_POST['TrabajoGrado']))
        {
   	$trabajos = new TrabajosGrado($documento);
        $trabajos->actualizar($_POST['TrabajoGrado']);
        $models = $trabajos->getModels();

	$arr = $trabajos->getTrabajos();
      	$this->renderPartial('//trabajosGrado/_ajaxContent', array('models'=>$models,'arr'=>$arr), false, true);
        
        }
        
        if(isset($_POST["ProfesorInvestigacion"]))
        {
 	$trabajos = new ProyectosInvestigacion($documento);
        $trabajos->actualizar($_POST['ProfesorInvestigacion']);
        $models = $trabajos->getModels();
        $arr = $trabajos->getTrabajos();
        $this->renderPartial('//proyectosInvestigacion/_ajaxContent', array('models'=>$models,'arr'=>$arr), false, true);
        
        }
         if(isset($_POST["ProfesorExtension"]))
        {
	$trabajos = new ProyectosExtension($documento);
        $trabajos->actualizar($_POST['ProfesorExtension']);
        $models = $trabajos->getModels();
        $arr = $trabajos->getTrabajos();
        $this->renderPartial('//proyectosExtension/_ajaxContent', array('models'=>$models,'arr'=>$arr), false, true);
        }
 
      if(isset($_POST["ProfesorProyectoPlan"]))
        {
        $trabajos = new ProyectosPlanDesarrollo($documento);
        $trabajos->actualizar($_POST['ProfesorProyectoPlan']);
        $models = $trabajos->getModels();
        $arr = $trabajos->getTrabajos();
        $this->renderPartial('//proyectosplandesarrollo/_ajaxContent', array('models'=>$models,'arr'=>$arr), false, true);

        }
        
	}
        public function actionGuardar()
        {
      
          $documento = $_POST["documentoProfesor"];
          $this->documentoProfesor = $documento;
        
          
         $actividades = new ActividadesGestion($documento);
         $investigacion = new ProyectosInvestigacion($documento);
         $trabajos = new TrabajosGrado($documento);
         $proyectos = new ProyectosPlanDesarrollo($documento);
         $extension = new proyectosExtension($documento);
         $cursos = new Cursos($documento,true);

         $pValido=$proyectos->validation($_POST["ProfesorProyectoPlan"]);
         $cValido=$cursos->validar($_POST["CursoProfesor"]);
         $aValido=$actividades->validation($_POST["ProfesorGestion"]);
         $tValido=$trabajos->validation($_POST["TrabajoGrado"]);
         $iValido=$investigacion->validation($_POST["ProfesorInvestigacion"]);       
         $eValido=$extension->validation($_POST["ProfesorExtension"]);

         if($cValido && $aValido && $tValido && $iValido && $pValido && $eValido)
           {
       
            $cursos->guardar($_POST['CursoProfesor']);
            $trabajos->guardar($_POST['TrabajoGrado']);
            $investigacion->guardar($_POST['ProfesorInvestigacion']);
            $proyectos->guardar($_POST['ProfesorProyectoPlan']);
            $actividades->guardar($_POST['ProfesorGestion']);
            $extension->guardar($_POST['ProfesorExtension']);

            $this->renderPartial('planTrabajo',array($valido=>1));

           }
           else
           {
            $this->renderPartial('editar',array('cursos'=>$cursos, 'trabajos'=>$trabajos, 'investigacion'=>$investigacion, 'extension'=>$extension,'actividades'=>$actividades,'proyectos'=>$proyectos));

           }
         
             
        }
        public function actionCompletar()
        {
               

        $listaProfesores=Yii::app()->cache->get("listaProfesores");
        if(!$listaProfesores)
        {
         $listaProfesores=Profesor::getListado();
         Yii::app()->cache->set("listaProfesores",$listaProfesores);
        
        }
        
        $this->searchTerm = $_GET["term"];

        print(json_encode(array_values(array_filter($listaProfesores, array($this,"filter")))));

        }
        function filter($find) {

        return stripos($find['label'], $this->searchTerm) !== false;
        }

        public function actionCargarDocente()
        {

            $this->documentoProfesor = $_POST["documentoProfesor"];
        
            $this->renderPartial('index',array($valido=>1));
            
        }


	    /**
     * Genera pdf
    */


    public function actionImprimir()
	{
	require_once('protected/extensions/tcpdf/config/lang/spa.php');
        require_once('protected/extensions/tcpdf/tcpdf.php');
        $documento=$_GET["documento"];
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetPageOrientation("L");

		// set default header data
		$pdf->SetHeaderData('upn.jpg', PDF_HEADER_LOGO_WIDTH, 'VICERRECTORIA ACADEMICA', 'PLAN DE TRABAJO DEL PROFESOR UNIVERSITARIO');

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, 18, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, 5);

		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		//set some language-dependent strings
		$pdf->setLanguageArray($l);

		// ---------------------------------------------------------

		$pdf->SetFont('helvetica', '', 10);

		$pdf->AddPage();

		//Consultas
		$centro= '"centro"';
		$comillas = '"';

		$connection=Yii::app()->db;
		$sql1 = "SELECT profesor.nombre1 as nombre1, profesor.nombre2 as nombre2, profesor.apellido1 as apellido1, profesor.apellido2 as apellido2, ".
				"profesor.centroCostoDepartamento as centroDepto, profesor.codigoVinculacion as codVinculacion, ".
				"profesor.codigoCategoria as codCategoria, profesor.codigoDedicacion as codDedicacion, facultad.nombre as facultad, ".
				"departamento.nombre as departamento, vinculacion.nombre as vinculacion, dedicacion.nombre as dedicacion, ".
				"categoria.nombre as categoria ".
				"FROM profesor, departamento, facultad, vinculacion, dedicacion, categoria ".
				"WHERE profesor.documentoProfesor = $documento ".
				"AND facultad.centroCostoFacultad = departamento.centroCostoFacultad ".
				"AND profesor.codigoVinculacion = vinculacion.codigoVinculacion ".
				"AND profesor.codigoDedicacion = dedicacion.codigoDedicacion ".
				"AND profesor.codigoCategoria = categoria.codigoCategoria";

		$command1 = $connection->createCommand($sql1);
		$profesor = $command1->queryAll();

		$apellidos    = " " . $profesor[0]["apellido1"] . " " . $profesor[0]["apellido2"];
		$nombres      = " " . $profesor[0]["nombre1"] . " " . $profesor[0]["nombre2"];
		$documento    = " " . $documento;
		$facultad     = " " . $profesor[0]["facultad"];
		$departamento = " " . $profesor[0]["departamento"];
		$vinculacion  = " " . $profesor[0]["vinculacion"];
		$dedicacion   = " " . $profesor[0]["dedicacion"];
		$categoria    = " " . $profesor[0]["categoria"];

		//Consulta segunda parte
		//Cantidad de Cursos del Docente
		$sql2 = "SELECT COUNT(*) as numero FROM cursoprofesor WHERE cursoprofesor.documentoProfesor = $documento";

		$command2 = $connection->createCommand($sql2);
		$nCursos = $command2->queryAll();
		$numeroCursos = $nCursos[0]["numero"];

		//Codigo Asignaturas, Grupos y Nombres
		$sql3 = "SELECT cursoprofesor.codigoAsignatura as codigoAsignatura, cursoprofesor.grupo as grupo, asignatura.nombre as nombre, ".
				"cursoprofesor.horasTutoria as hTutoria, cursoprofesor.horasPreparacion as hPreparacion, cursoprofesor.horasEvaluacion as hEval, ".
				"programa.centroCostoPrograma as costoProg, programa.nombre as nProg, asignatura.horas as horas, asignatura.practica as practica, ".
				"curso.noEstudiantes as noEstudiantes ".
		        "FROM cursoprofesor, asignatura, programa, curso ".
		        "WHERE cursoprofesor.documentoProfesor = $documento ".
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
		$horasTotalActividades = 0;

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
			$noEstudiantes[$i]    = $docencia[$i]["noEstudiantes"];

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
				"WHERE cursoprofesor.documentoProfesor = $documento ".
				"AND horarios.codigoAsignatura = cursoprofesor.codigoAsignatura ".
				"AND horarios.grupo = cursoprofesor.grupo ";

		$command4 = $connection->createCommand($sql4);
		$hAsig = $command4->queryAll();

		$prac = 0;
		$nprac = 0;

		for ($i=0; $i<count($hAsig); $i=$i+1){
			$horario[$i][0] = $hAsig[$i]["codigoAsignatura"];
			$horario[$i][1] = $hAsig[$i]["diaAsig"];
			$horario[$i][2] = $hAsig[$i]["horaAsig"];
		}

		$asigPractica  = "";
		$asigPractica1 = "";
		$tempL = "";
		$tempM = "";
		$tempW = "";
		$tempJ = "";
		$tempV = "";
		$tempS = "";
		$hora = "";


		for ($i=0; $i<$numeroCursos; $i++){
			if ($practica[$i] == 0){
				$prac++;
				for ($k=0; $k<count($horario); $k=$k+2){
					if ($horario[$k][0] == $codigoAsignatura[$i]){
						if ($horario[$k][1] == 'L'){
							$tempL = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
						if ($horario[$k][1] == 'M'){
							$tempM = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
						if ($horario[$k][1] == 'W'){
							$tempW = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
						if ($horario[$k][1] == 'J'){
							$tempJ = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
						if ($horario[$k][1] == 'V'){
							$tempV = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
						if ($horario[$k][1] == 'S'){
							$tempS = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
					}
				}
				$codigoGrupo = $codigoAsignatura[$i]. "-" . $grupo[$i];
				$nombre = $nombreAsignatura[$i];
				$costo = $costoPrograma[$i];
				$programa = $nombrePrograma[$i];
				$hora = $horas[$i];
				$nEst = $noEstudiantes[$i];


				$cantidad = $comillas.$practica0.$comillas;
				if ($prac == 1)	{
					$asigPractica = "<tr><td rowspan=$cantidad align=$centro>Espacios Acad&eacute;micos o Asignaturas</td>".
									"<td>$codigoGrupo</td>" .
	    							"<td>$nombre</td>".
    								"<td>$programa</td>".
    								"<td align=$centro>$costo</td>".
    								"<td align=$centro>$nEst</td>".
    								"<td align=$centro></td>".
    								"<td align=$centro>$tempL</td>".
							    	"<td align=$centro>$tempM</td>".
    								"<td align=$centro>$tempW</td>".
    								"<td align=$centro>$tempJ</td>".
    								"<td align=$centro>$tempV</td>".
    								"<td align=$centro>$tempS</td>".
    								"<td align=$centro>$hora</td>".
    								"</tr>";
				}
				if ($prac > 1)	{
					$asigPractica =  $asigPractica .
									"<tr>".
									"<td>$codigoGrupo</td>" .
    								"<td>$nombre</td>".
    								"<td>$programa</td>".
    								"<td align=$centro>$costo</td>".
	    							"<td align=$centro>$nEst</td>".
    								"<td align=$centro></td>".
    								"<td align=$centro>$tempL</td>".
							    	"<td align=$centro>$tempM</td>".
    								"<td align=$centro>$tempW</td>".
    								"<td align=$centro>$tempJ</td>".
    								"<td align=$centro>$tempV</td>".
	    							"<td align=$centro>$tempS</td>".
    								"<td align=$centro>$hora</td></tr>";
				}
			}

			else{
				$nprac = $nprac + 1;
				$tempL = "";
				$tempM = "";
				$tempW = "";
				$tempJ = "";
				$tempV = "";
				$tempS = "";
				$hora  = "";

				for ($k=0; $k<count($horario); $k=$k+2){
					if ($horario[$k][0] == $codigoAsignatura[$i]){
						if ($horario[$k][1] == 'L'){
							$tempL = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
						if ($horario[$k][1] == 'M'){
							$tempM = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
						if ($horario[$k][1] == 'W'){
							$tempW = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
						if ($horario[$k][1] == 'J'){
							$tempJ = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
						if ($horario[$k][1] == 'V'){
							$tempV = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
						if ($horario[$k][1] == 'S'){
							$tempS = $horario[$k][2] . " - " . $horario[$k+1][2];
						}
					}
				}

				$codigoGrupo = $codigoAsignatura[$i]. "-" . $grupo[$i];
				$nombre = $nombreAsignatura[$i];
				$costo = $costoPrograma[$i];
				$programa = $nombrePrograma[$i];
				$hora = $horas[$i];
				$nEst = $noEstudiantes[$i];

				$cantidad1 = $comillas.$practica1.$comillas;
				if ($nprac == 1)	{
					$asigPractica1 = "<tr><td rowspan=$cantidad1 align=$centro>Pr&aacute;ctica Educativa</td>".
									"<td>$codigoGrupo</td>" .
	    							"<td>$nombre</td>".
    								"<td>$programa</td>".
    								"<td align=$centro>$costo</td>".
    								"<td align=$centro>$nEst</td>".
    								"<td align=$centro></td>".
    								"<td align=$centro>$tempL</td>".
							    	"<td align=$centro>$tempM</td>".
    								"<td align=$centro>$tempW</td>".
    								"<td align=$centro>$tempJ</td>".
    								"<td align=$centro>$tempV</td>".
    								"<td align=$centro>$tempS</td>".
    								"<td align=$centro>$hora</td>".
    								"</tr>";
				}
				else{

				$asigPractica1 =  $asigPractica1 .
									"<tr>".
									"<td>$codigoGrupo</td>" .
	    							"<td>$nombre</td>".
    								"<td>$programa</td>".
    								"<td align=$centro>$costo</td>".
    								"<td align=$centro>$nEst</td>".
    								"<td align=$centro></td>".
    								"<td align=$centro>$tempL</td>".
							    	"<td align=$centro>$tempM</td>".
    								"<td align=$centro>$tempW</td>".
    								"<td align=$centro>$tempJ</td>".
    								"<td align=$centro>$tempV</td>".
    								"<td align=$centro>$tempS</td>".
    								"<td align=$centro>$hora</td>".
    								"</tr>";
				}
			}
		}

		if ($practica0 == 0){
			$asigPractica = "<tr><td rowspan=$numeroCursos> Espacios Acad&eacute;micos o Asignaturas</td>".
							"<td></td>" .
	    					"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
					    	"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"</tr>";
		}

		if ($practica1 == 0){
			$asigPractica1 = "<tr><td rowspan=$numeroCursos> Pr&aacute;ctica Educativa</td>".
							"<td></td>" .
	    					"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
					    	"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"<td></td>".
    						"</tr>";
		}


		$apoyoDoc1 = "";
		$tutoria = 0;
		$apoyoDoc2 = "";
		$clase = 0;
		$apoyoDoc3 = "";
		$eval = 0;

		$ctutoria = 0;
		$cpreparacion = 0;
		$cevaluacion = 0;
		for ($i=0; $i<$numeroCursos; $i++){
			if ($hTutoria[$i] != 0){
				$ctutoria++;
			}
			if ($hPreparacion[$i] != 0){
				$cpreparacion++;
			}
			if ($hEval[$i] != 0){
				$cevaluacion++;
			}
		}
		$cantidadT = $comillas.$ctutoria.$comillas;
		$cantidadP = $comillas.$cpreparacion.$comillas;
		$cantidadE = $comillas.$cevaluacion.$comillas;

		for ($i=0; $i<$numeroCursos; $i++){
			if ($hTutoria[$i] != 0){
				$tutoria++;
				$nAsignatura = $nombreAsignatura[$i];
				$nombreProg = $nombrePrograma[$i];
				$costoPro = $costoPrograma[$i];
				$hTut = $hTutoria[$i];
				$nEst = $noEstudiantes[$i];

				if ($tutoria == 1){
					$apoyoDoc1 = "<tr><td rowspan=$cantidadT>Tutor&iacute;a a Estudiantes</td>" .
						"<td>$nAsignatura</td>" .
    					"<td align=$centro>$nEst</td>".
    					"<td>$nombreProg</td>".
    					"<td align=$centro>$costoPro</td>".
    					"<td align=$centro>$hTut</td>".
    					"</tr>";

				}
				if ($tutoria > 1){
					$apoyoDoc1 = $apoyoDoc1 .
								"<tr>".
								"<td>$nAsignatura</td>" .
    							"<td align=$centro>$nEst</td>".
	    						"<td>$nombreProg</td>".
    							"<td align=$centro>$costoPro</td>".
    							"<td align=$centro>$hTut</td>".
    							"</tr>";
				}
			}

			//Prepraracion Clase
			if ($hPreparacion[$i] != 0){
				$clase++;
				$nAsignatura = $nombreAsignatura[$i];
				$nombreProg = $nombrePrograma[$i];
				$costoPro = $costoPrograma[$i];
				$hClase = $hPreparacion[$i];
				$nEst = $noEstudiantes[$i];

				if ($clase == 1){
					$apoyoDoc2 = "<tr><td rowspan=$cantidadP>Preparaci&oacute;n, actualizaci&oacute;n, sistematizaci&oacute;n e innovaci&oacute;n de clases</td>" .
						"<td>$nAsignatura</td>" .
    					"<td align=$centro>$nEst</td>".
    					"<td>$nombreProg</td>".
    					"<td align=$centro>$costoPro</td>".
    					"<td align=$centro>$hClase</td>".
    					"</tr>";

				}
				if ($clase > 1){
					$apoyoDoc2 = $apoyoDoc2 .
								"<tr>".
								"<td>$nAsignatura</td>" .
    							"<td align=$centro>$nEst</td>".
	    						"<td>$nombreProg</td>".
    							"<td align=$centro>$costoPro</td>".
    							"<td align=$centro>$hClase</td>".
    							"</tr>";
				}
			}

			//Evaluacion Actividades
			if ($hEval[$i] != 0){
				$eval++;
				$nAsignatura = $nombreAsignatura[$i];
				$nombreProg = $nombrePrograma[$i];
				$costoPro = $costoPrograma[$i];
				$hEvaluacion = $hEval[$i];
				$nEst = $noEstudiantes[$i];

				if ($eval == 1){
					$apoyoDoc3 = "<tr><td rowspan=$cantidadE>Evaluaci&oacute;n de Actividades</td>" .
						"<td>$nAsignatura</td>" .
    					"<td align=$centro>$nEst</td>".
    					"<td>$nombreProg</td>".
    					"<td align=$centro>$costoPro</td>".
    					"<td align=$centro>$hEvaluacion</td>".
    					"</tr>";

				}
				if ($eval > 1){
					$apoyoDoc3 = $apoyoDoc3 .
								"<tr>".
								"<td></td>".
								"<td>$nAsignatura</td>" .
    							"<td align=$centro>$nEst</td>".
	    						"<td>$nombreProg</td>".
    							"<td align=$centro>$costoPro</td>".
    							"<td align=$centro>$hEvaluacion</td>".
    							"</tr>";
				}
			}
		}
		if ($ctutoria == 0){
			$apoyoDoc1 = $apoyoDoc1 .
						 "<tr>".
						 "<td></td>".
						 "<td></td>" .
    					 "<td></td>".
	    				 "<td></td>".
    					 "<td></td>".
    					 "<td></td>".
    					 "</tr>";
		}
		if ($cpreparacion == 0){
			$apoyoDoc2 = "<tr><td rowspan=$cantidadP>Preparaci&oacute;n, actualizaci&oacute;n, sistematizaci&oacute;n e innovaci&oacute;n de clases</td>" .
						 "<td></td>" .
    					 "<td></td>".
	    				 "<td></td>".
    					 "<td></td>".
    					 "<td></td>".
    					 "</tr>";
		}
		if ($cevaluacion == 0){
			$apoyoDoc3 = "<tr><td rowspan=$cantidadE>Evaluaci&oacute;n de Actividades</td>" .
						 "<td></td>".
						 "<td></td>" .
    					 "<td></td>".
	    				 "<td></td>".
    					 "<td></td>".
    					"</tr>";
		}


		//Trabajos de Grado
        $sql5 = "SELECT trabajogrado.codigoTrabajo as codigoTrabajo, trabajogrado.titulo as titulo, trabajogrado.noActa as noActaTesis, ".
           		"trabajogrado.fechaActa as fechaActaTesis, trabajogrado.centroCostoPrograma as centroCostoP, trabajogrado.nivel as nivel, ".
           		"trabajogrado.horas as horas, programa.nombre as programaT ".
				"FROM trabajogrado, programa ".
				"WHERE trabajogrado.documentoProfesor = $documento ".
				"AND trabajogrado.centroCostoPrograma = programa.centroCostoPrograma";

		$command5 = $connection->createCommand($sql5);
		$trabGrado = $command5->queryAll();

		$nTrabajoGrado      = 0;
		$codigoTrabajo[]      = 0;
		$titulo[]             = 0;
		$noActaTesis[]        = 0;
		$fechaActaTesis[]     = 0;
		$centroCostoP[]       = 0;
		$nombrePrograma[]     = 0;
		$nivel[]              = 0;
		$hTrabGrado           = 0;

		for ($i=0; $i<count($trabGrado); $i++){
			$codigoTrabajo[$i]  = $trabGrado[$i]["codigoTrabajo"];
			$titulo[$i]         = $trabGrado[$i]["titulo"];
			$noActaTesis[$i]    = $trabGrado[$i]["noActaTesis"];
			$fechaActaTesis[$i] = $trabGrado[$i]["fechaActaTesis"];
			$centroCostoP[$i]   = $trabGrado[$i]["centroCostoP"];
			$nombrePrograma[$i] = $trabGrado[$i]["programaT"];
			$nivel[$i]          = $trabGrado[$i]["nivel"];
			$hTrabajoGrado[$i]  = $trabGrado[$i]["horas"];

			$nTrabajoGrado = $nTrabajoGrado + 1;
			$hTrabGrado = $hTrabGrado + $hTrabajoGrado[$i];
		}

		$trabajosGrado = "";

		if ($nTrabajoGrado == 0){
			$trabajosGrado = "<tr>".
							 "<td></td>".
							 "<td></td>" .
    						 "<td></td>".
	    					 "<td></td>".
    						 "<td></td>".
    						 "<td></td>".
    						 "<td></td>".
    						 "<td></td>".
    						 "</tr>";
		}
		else{
			for ($i=0; $i<$nTrabajoGrado; $i++){
				$codigoT   = $codigoTrabajo[$i];
				$tituloT   = $titulo[$i];
				$actaT     = $noActaTesis[$i];
				$fechaT    = $fechaActaTesis[$i];
				$costoT    = $centroCostoP[$i];
				$programaT = $nombrePrograma[$i];
				$nivelT    = $nivel[$i];
				$horasT    = $hTrabajoGrado[$i];


				$trabajosGrado = $trabajosGrado .
							"<tr>".
							"<td>$codigoT</td>".
							"<td>$tituloT</td>" .
	    					"<td align=$centro>$actaT</td>".
		    				"<td align=$centro>$fechaT</td>".
		    				"<td align=$centro>$programaT</td>".
	    					"<td align=$centro>$costoT</td>".
	    					"<td align=$centro>$nivelT</td>".
	    					"<td align=$centro>$horasT</td>".
	    					"</tr>";
			}
		}


		//Proyectos Investigacion
        $sql6 = "SELECT proyectoinvestigacion.codigoProyecto as codigoPI, proyectoinvestigacion.titulo as titulo, ".
        		"proyectoinvestigacion.noActa as noActaTesis, proyectoinvestigacion.fechaActa as fechaActaTesis, ".
        		"proyectoinvestigacion.centroCostoPrograma as centroCostoP, programa.nombre as programaI, ".
        		"profesorinvestigacion.horas, funcioninvestigacion.nombre as funcion ".
				"FROM proyectoinvestigacion, profesorinvestigacion, funcioninvestigacion, programa ".
				"WHERE profesorinvestigacion.documentoProfesor = $documento ".
				"AND proyectoinvestigacion.centroCostoPrograma = programa.centroCostoPrograma ".
				"AND proyectoinvestigacion.codigoProyecto = profesorinvestigacion.codigoProyecto ".
				"AND profesorinvestigacion.codigoFuncion = funcioninvestigacion.codigoFuncion ";

		$command6 = $connection->createCommand($sql6);
		$proyectoInv = $command6->queryAll();

		$nProyInv          = 0;
		$codigoProyectoI[] = 0;
		$titulo[]          = 0;
		$noActaTesis[]     = 0;
		$fechaActaTesis[]  = 0;
		$centroCostoP[]    = 0;
		$nombreProgramaI[] = 0;
		$funcion[]         = 0;
		$horasProy[]       = 0;
		$hInvest           = 0;

		for ($i=0; $i<count($proyectoInv); $i++){
				$codigoProyectoI[$i] = $proyectoInv[$i]["codigoPI"];
				$titulo[$i]          = $proyectoInv[$i]["titulo"];
				$noActaTesis[$i]     = $proyectoInv[$i]["noActaTesis"];
				$fechaActaTesis[$i]  = $proyectoInv[$i]["fechaActaTesis"];
				$centroCostoP[$i]    = $proyectoInv[$i]["centroCostoP"];
				$nombreProgramaI[$i] = $proyectoInv[$i]["programaI"];
				$funcion[$i]         = $proyectoInv[$i]["funcion"];
				$horasProy[$i]       = $proyectoInv[$i]["horas"];

				$nProyInv = $nProyInv + 1;
				$hInvest = $hInvest + $horasProy[$i];
		}

		$hTotalInvestigacion = $hTrabGrado + $hInvest;

		if ($nProyInv == 0){
			$proyectoInvestigacion = "<tr>".
							 		 "<td></td>".
							 		 "<td></td>" .
    						 		 "<td></td>".
	    					 		 "<td></td>".
    						 		 "<td></td>".
    						 		 "<td></td>".
    						 		 "<td></td>".
    						 		 "<td></td>".
    						 		 "</tr>";
		}
		else{
			$proyectoInvestigacion = "";

			for ($i=0; $i<$nProyInv; $i++){
				$codigoI   = $codigoProyectoI[$i];
				$tituloI   = $titulo[$i];
				$actaI     = $noActaTesis[$i];
				$fechaI    = $fechaActaTesis[$i];
				$costoI    = $centroCostoP[$i];
				$programaI = $nombreProgramaI[$i];
				$funcionI  = $funcion[$i];
				$horasI    = $horasProy[$i];


				$proyectoInvestigacion = $proyectoInvestigacion .
							"<tr>".
							"<td>$codigoI</td>".
							"<td>$tituloI</td>" .
	    					"<td align=$centro>$actaI</td>".
		    				"<td align=$centro>$fechaI</td>".
	    					"<td>$programaI</td>".
	    					"<td align=$centro>$costoI</td>".
	    					"<td>$funcionI</td>".
	    					"<td align=$centro>$horasI</td>".
	    					"</tr>";
			}
		}

		//Extension
        $sql7 = "SELECT actividadextension.codigoActividadExtension as codigoEx, actividadextension.titulo as titulo, ".
        		"actividadextension.noActa as noActaTesis, actividadextension.fechaActa as fechaActaTesis, ".
        		"actividadextension.centroCostoPrograma as centroCostoP, programa.nombre as programaE, profesorextension.horas as horas ".
				"FROM actividadextension, profesorextension, programa ".
				"WHERE profesorextension.documentoProfesor = $documento ".
				"AND profesorextension.codigoActividadExtension = actividadextension.codigoActividadExtension ".
				"AND actividadextension.centroCostoPrograma = programa.centroCostoPrograma ";


		$command7 = $connection->createCommand($sql7);
		$extension = $command7->queryAll();

		$nExtension        = 0;
		$codigoE[]       = 0;
		$titulo[]          = 0;
		$noActaTesis[]     = 0;
		$fechaActaTesis[]  = 0;
		$centroCostoP[]    = 0;
		$nombreProgramaE[] = 0;
		$horasExt[]        = 0;
		$hExt           = 0;

		for ($i=0; $i<count($extension); $i++){
				$codigoE[$i]         = $extension[$i]["codigoEx"];
				$titulo[$i]          = $extension[$i]["titulo"];
				$noActaTesis[$i]     = $extension[$i]["noActaTesis"];
				$fechaActaTesis[$i]  = $extension[$i]["fechaActaTesis"];
				$centroCostoP[$i]    = $extension[$i]["centroCostoP"];
				$nombreProgramaE[$i] = $extension[$i]["programaE"];
				$horasExt[$i]        = $extension[$i]["horas"];

				$nExtension = $nExtension + 1;
				$hExt = $hExt + $horasExt[$i];
		}

		$proyExtension = "";

		if ($nExtension == 0){
			$proyExtension = "<tr>".
							 "<td></td>".
							 "<td></td>" .
    						 "<td></td>".
	    					 "<td></td>".
    						 "<td></td>".
    						 "<td></td>".
    						 "<td></td>".
    						 "</tr>";
		}
		else{
			for ($i=0; $i<$nExtension; $i++){
				$codigoE   = $codigoE[$i];
				$tituloE   = $titulo[$i];
				$actaE     = $noActaTesis[$i];
				$fechaE    = $fechaActaTesis[$i];
				$costoE    = $centroCostoP[$i];
				$programaE = $nombreProgramaE[$i];
				$horasE    = $horasExt[$i];


				$proyExtension = $proyExtension .
							"<tr>".
							"<td>$codigoE</td>".
							"<td>$tituloE</td>" .
	    					"<td align=$centro>$actaE</td>".
		    				"<td align=$centro>$fechaE</td>".
	    					"<td>$programaE</td>".
	    					"<td align=$centro>$costoE</td>".
	    					"<td align=$centro>$horasE</td>".
	    					"</tr>";
			}
		}


		//Actividades Gestion Institucional - Numerales 4.1 al 4.13
       	$sql8 = "SELECT profesorgestion.descripcion as descripcion, profesorgestion.horas as horasGestion, ".
       			"profesorgestion.centroCostoPrograma as costo, profesorgestion.codigoActividadGestion as codigoGestion ".
				"FROM profesorgestion ".
				"WHERE profesorgestion.documentoProfesor = $documento ";

		$command8 = $connection->createCommand($sql8);
		$gestion = $command8->queryAll();

		$codigo[]   = '';
		$descrip[]   = '';
		$horasGes[]  = 0;
		$centroCos[] = 0;
		$nGestion    = 0;
		$hGestion    = 0;

		for ($i=0; $i<count($gestion); $i++){
			$codigo[$i]    = $gestion[$i]["codigoGestion"];
			$descrip[$i]   = $gestion[$i]["descripcion"];
			$horasGes[$i]  = $gestion[$i]["horasGestion"];
			$centroCos[$i] = $gestion[$i]["costo"];

			$nGestion      = $nGestion + 1;
			$hGestion      = $hGestion + $horasGes[$i];
		}

		$gestion1 = "";
		$ng1 = 0;
		$gestion2 = "";
		$ng2 = 0;
		$gestion3 = "";
		$ng3 = 0;
		$gestion4 = "";
		$ng4 = 0;
		$gestion5 = "";
		$ng5 = 0;
		$gestion6 = "";
		$ng6 = 0;
		$gestion7 = "";
		$ng7 = 0;
		$gestion8 = "";
		$ng8 = 0;
		$gestion9 = "";
		$ng9 = 0;
		$gestion10 = "";
		$ng10 = 0;
		$gestion11 = "";
		$ng11 = 0;
		$gestion12 = "";
		$ng12 = 0;
		$gestion13 = "";
		$ng13 = 0;

		$rows = 2;
		$cantidad = $comillas.$rows.$comillas;
		$rowspan = 6;
		$cant = $comillas.$rows.$comillas;

		for ($i=0; $i<$nGestion; $i++){
			if ($codigo[$i] == 1){
				$ng1++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];


				$gestion1 = $gestion1 .
							"<tr>".
							"<td colspan=$cantidad>4.1 Coordinaci&oacute;n de Proyectos Curriculares o Programas Acad&eacute;micos</td>".
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
					if ($codigo[$i] == 2){
				$ng2++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

				$gestion2 = $gestion2 .
							"<tr>".
							"<td colspan=$cantidad>4.2 Coordinador de L&iacute;nea de Investigaci&oacute;n</td>".
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
			if ($codigo[$i] == 3){
				$ng3++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

				$gestion3 = $gestion3 .
							"<tr>".
							"<td colspan=$cantidad>4.3 Coordinaci&oacute;nn de &Eacute;nnfasis</td>".
							"<td>$nombreG</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
			if ($codigo[$i] == 4){
				$ng4++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

				$gestion4 = $gestion4 .
							"<tr>".
							"<td colspan=$cantidad>4.4 Asesor de cohorte - Coordinador de semestre</td>".
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
			if ($codigo[$i] == 5){
				$ng5++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

				$gestion5 = $gestion5 .
							"<tr>".
							"<td colspan=$cantidad>4.5 Coordinaci&oacute;n general de Pr&aacute;ctica</td>".
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
			if ($codigo[$i] == 6){
				$ng6++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

				$gestion6 = $gestion6 .
							"<tr>".
							"<td colspan=$cantidad>4.6 Coordinador de &Aacute;rea</td>".
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
			if ($codigo[$i] == 7){
				$ng7++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

				$gestion7 = $gestion7 .
							"<tr>".
							"<td colspan=$cantidad>4.7 Jurados de Trabajos de Grado o Tesis</td>".
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
			if ($codigo[$i] == 8){
				$ng8++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

				$gestion8 = $gestion8 .
							"<tr>".
							"<td colspan=$cantidad>4.8 Participaci&oacute;n en Consejo de Departamento</td>".
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
			if ($codigo[$i] == 9){
				$ng9++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

				$gestion9 = $gestion9 .
							"<tr>".
							"<td colspan=$cantidad>4.9 Reuni&oacute;n de Profesores</td>".
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
			if ($codigo[$i] == 10){
				$ng10++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

				$gestion10 = $gestion10 .
							"<tr>".
							"<td colspan=$cantidad>4.10 Proceso de Autoevaluaci&oacute;n y Acreditaci&oacute;n</td>".
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
			if ($codigo[$i] == 11){
				$ng11++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

				$gestion11 = $gestion11 .
							"<tr>".
							"<td colspan=$cantidad>4.11 Participaci&oacute;n en Equipos Integrales de Docencia</td>".
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
			if ($codigo[$i] == 12){
				$ng12++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

				$gestion12 = $gestion12 .
							"<tr>".
							"<td colspan=$cantidad>4.12 Renovaci&oacute;n Curricular y Seguimiento de Programas Acad&eacute;micos</td>".
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
	    					"</tr>";
			}
			if ($codigo[$i] == 131 || $codigo[$i] == 132 || $codigo[$i] == 133 || $codigo[$i] == 134 || $codigo[$i] == 135 || $codigo[$i] == 136){
				$ng13++;
				$descripcion = $descrip[$i];
				$costoG = $centroCos[$i];
				$horasG = $horasGes[$i];

	    		$rowspan = 6;
				$cant = $comillas.$rowspan.$comillas;

				$gestion13 = "<tr>".
							"<td rowspan=$cant>4.13 Representaci&oacute;n del Profesorado a Consejos y/o Comit&eacute;s</td>".
							"<td>Comit&eacute;s Institucionales</td>" .
							"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
		    				"</tr>".

			    			"<tr><td>CIARP</td>".
		    				"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
		    				"</tr>" .

			    			"<tr><td>Consejo de Departamento</td>".
			    			"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
			    			"</tr>" .

			    			"<tr><td>Consejo de Facultad</td>" .
			    			"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
		    				"</tr>" .

			    			"<tr><td>Consejo Acad&eacute;mico</td>".
		    				"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
		    				"</tr>" .

			    			"<tr><td>Consejo Superior</td>".
			    			"<td>$descripcion</td>" .
	    					"<td>$costoG</td>".
		    				"<td>$horasG</td>".
		    				"</tr>";
				}
			}


		$rows = 2;
		$cantidad = $comillas.$rows.$comillas;

		if ($ng1 == 0){
			$gestion1 = "<tr>".
						"<td colspan=$cantidad>4.1 Coordinaci&oacute;n de Proyectos Curriculares o Programas Acad&eacute;micos</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng2 == 0){
			$gestion2 = "<tr>".
						"<td colspan=$cantidad>4.2 Coordinador de L&iacute;nea de Investigaci&oacute;n</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng3 == 0){
			$gestion3 = "<tr>".
						"<td colspan=$cantidad>4.3 Coordinaci&oacute;nn de &Eacute;nnfasis</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng4 == 0){
			$gestion4 = "<tr>".
						"<td colspan=$cantidad>4.4 Asesor de cohorte - Coordinador de semestre</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng5 == 0){
			$gestion5 = "<tr>".
						"<td colspan=$cantidad>4.5 Coordinaci&oacute;n general de Pr&aacute;ctica</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng6 == 0){
			$gestion6 = "<tr>".
						"<td colspan=$cantidad>4.6 Coordinador de &Aacute;rea</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng7 == 0){
			$gestion7 = "<tr>".
						"<td colspan=$cantidad>4.7 Jurados de Trabajos de Grado o Tesis</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng8 == 0){
			$gestion8 = "<tr>".
						"<td colspan=$cantidad>4.8 Participaci&oacute;n en Consejo de Departamento</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng9 == 0){
			$gestion9 = "<tr>".
						"<td colspan=$cantidad>4.9 Reuni&oacute;n de Profesores</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng10 == 0){
			$gestion10 = "<tr>".
						"<td colspan=$cantidad>4.10 Proceso de Autoevaluaci&oacute;n y Acreditaci&oacute;n</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng11 == 0){
			$gestion11 = "<tr>".
						"<td colspan=$cantidad>4.11 Participaci&oacute;n en Equipos Integrales de Docencia</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng12 == 0){
			$gestion12 = "<tr>".
						"<td colspan=$cantidad>4.12 Renovaci&oacute;n Curricular y Seguimiento de Programas Acad&eacute;micos</td>".
						"<td></td>" .
    					"<td></td>".
	    				"<td></td>".
    					"</tr>";

			}

		if ($ng13 == 0){
			$rowspan = 6;
			$cant = $comillas.$rowspan.$comillas;

			$gestion13 = "<tr>".
						"<td rowspan=$cant>4.13 Representaci&oacute;n del Profesorado a Consejos y/o Comit&eacute;s</td>".
						"<td>Comit&eacute;s Institucionales</td>" .
						"<td></td>" .
	    				"<td></td>".
		    			"<td></td>".
	    				"</tr>".

		    			"<tr><td>CIARP</td>".
	    				"<td></td>" .
	    				"<td></td>".
		    			"<td></td></tr>" .

		    			"<tr><td>Consejo de Departamento</td>".
		    			"<td></td>" .
	    				"<td></td>".
		    			"<td></td></tr>" .

		    			"<tr><td>Consejo de Facultad</td>" .
		    			"<td></td>" .
	    				"<td></td>".
		    			"<td></td></tr>" .

		    			"<tr><td>Consejo Acad&eacute;mico</td>".
	    				"<td></td>" .
	    				"<td></td>".
		    			"<td></td></tr>" .

		    			"<tr><td>Consejo Superior</td>".
		    			"<td></td>" .
	    				"<td></td>".
		    			"<td></td></tr>";
			}


		//Gestion 4.14
        $sql9 = "SELECT profesorproyectoplan.codigoProyecto as codigoPr, profesorproyectoplan.horas as horas, ".
        		"proyectoplandesarrollo.titulo as titulo, proyectoplandesarrollo.fechaActa as fechaActaTesis, ".
        		"proyectoplandesarrollo.noActa as noActa, proyectoplandesarrollo.centroCostoPrograma as centroC ".
				"FROM profesorproyectoplan, proyectoplandesarrollo ".
				"WHERE profesorproyectoplan.documentoProfesor = $documento ".
				"AND profesorproyectoplan.codigoProyecto = proyectoplandesarrollo.codigoProyecto ";


		$command9 = $connection->createCommand($sql9);
		$proyectoPlan = $command9->queryAll();

		$nProyectoP       = 0;
		$codigoPr[]       = 0;
		$titulo[]         = 0;
		$noActa[]         = 0;
		$fechaActa[]      = 0;
		$centroCostoP[]   = 0;
		$horasPr[]        = 0;
		$hProyectoP       = 0;

		for ($i=0; $i<count($proyectoPlan); $i++){
				$codigoPr[$i]        = $proyectoPlan[$i]["codigoPr"];
				$titulo[$i]          = $proyectoPlan[$i]["titulo"];
				$noActa[$i]     = $proyectoPlan[$i]["noActa"];
				$fechaActa[$i]  = $proyectoPlan[$i]["fechaActaTesis"];
				$centroCostoP[$i]    = $proyectoPlan[$i]["centroC"];
				$horasPr[$i]         = $proyectoPlan[$i]["horas"];

				$nProyectoP = $nProyectoP + 1;
				$hProyectoP = $hProyectoP + $horasPr[$i];
		}


		//Horario 4.14
        $sql11 = "SELECT horariosproyectosplandesarrollo.codigoProyecto as codigoProyecto, horariosproyectosplandesarrollo.hora as horaProyecto, ".
        		 "horariosproyectosplandesarrollo.dia as diaProyecto ".
				 "FROM profesorproyectoplan, horariosproyectosplandesarrollo ".
				 "WHERE profesorproyectoplan.documentoProfesor = $documento ".
				 "AND profesorproyectoplan.codigoProyecto = horariosproyectosplandesarrollo.codigoProyecto ";

		$command11 = $connection->createCommand($sql11);
		$hProy = $command11->queryAll();
		$horarioP = "";
		for ($i=0; $i<count($hProy); $i=$i+1){
			$horarioP[$i][0] = $hProy[$i]["codigoProyecto"];
			$horarioP[$i][1] = $hProy[$i]["diaProyecto"];
			$horarioP[$i][2] = $hProy[$i]["horaProyecto"];
		}

		$tempL = "";
		$tempM = "";
		$tempW = "";
		$tempJ = "";
		$tempV = "";
		$tempS = "";
		$hora = "";


		for ($i=0; $i<$nProyectoP; $i++){
			for ($k=0; $k<count($horarioP); $k=$k+2){
					if ($horarioP[$k][1] == 'L'){
						$tempL = $horarioP[$k][2] . " - " . $horarioP[$k+1][2];
					}
					if ($horarioP[$k][1] == 'M'){
						$tempM = $horarioP[$k][2] . " - " . $horarioP[$k+1][2];
					}
					if ($horarioP[$k][1] == 'W'){
						$tempW = $horarioP[$k][2] . " - " . $horarioP[$k+1][2];
					}
					if ($horarioP[$k][1] == 'J'){
						$tempJ = $horarioP[$k][2] . " - " . $horarioP[$k+1][2];
					}
					if ($horarioP[$k][1] == 'V'){
						$tempV = $horarioP[$k][2] . " - " . $horarioP[$k+1][2];
					}
					if ($horarioP[$k][1] == 'S'){
						$tempS = $horarioP[$k][2] . " - " . $horarioP[$k+1][2];
					}
				}


		$proyectoPlanD = "";

		if ($nProyectoP == 0){
			$proyectoPlanD = "<tr>".
							 "<td></td>".
							 "<td></td>" .
    						 "<td></td>".
	    					 "<td></td>".
    						 "<td></td>".
    						 "<td></td>".
    						 "<td></td>".
    						 "<td></td>".
    						 "<td></td>".
    						 "<td></td>".
    						 "</tr>";
		}
		else{
			for ($i=0; $i<$nProyectoP; $i++){
				$codigoP   = $codigoPr[$i];
				$tituloP   = $titulo[$i];
				$actaP     = $noActa[$i];
				$fechaP    = $fechaActa[$i];
				$costoP    = $centroCostoP[$i];
				$horasP    = $horasPr[$i];


				$proyectoPlanD = $proyectoPlanD .
							"<tr>".
							"<td>$codigoP</td>".
							"<td>$tituloP</td>" .
	    					"<td align=$centro>$costoP</td>".
	    					"<td align=$centro>$tempL</td>".
		    				"<td align=$centro>$tempM</td>".
	    					"<td align=$centro>$tempW</td>".
	    					"<td align=$centro>$tempJ</td>".
	    					"<td align=$centro>$tempV</td>".
	    					"<td align=$centro>$tempS</td>".
	    					"<td align=$centro>$horasP</td>".
	    					"</tr>";
			}
		}
		}

		//Gestion 4.15
        $sql10 = "SELECT profesorsituacionadministrativa.codigoSituacion as codigoS, profesorsituacionadministrativa.desde as desde, ".
        		"profesorsituacionadministrativa.hasta as hasta, profesorsituacionadministrativa.fechaActoAdministrativo as fechaActa, ".
        		"profesorsituacionadministrativa.noActoAdministrativo as noActa, profesorsituacionadministrativa.horas as horas, ".
        		"situacionAdministrativa.nombre as nombre, profesor.centroCostoDepartamento as centroCosto ".
				"FROM profesorsituacionadministrativa, situacionAdministrativa, profesor ".
				"WHERE profesorsituacionadministrativa.documentoProfesor = $documento ".
				"AND profesorsituacionadministrativa.codigoSituacion = situacionAdministrativa.codigoSituacion ".
				"AND profesorsituacionadministrativa.documentoProfesor = profesor.documentoProfesor ";


		$command10 = $connection->createCommand($sql10);
		$situacionAdmin = $command10->queryAll();

		$nSituacion   = 0;
		$codigoSit[]  = 0;
		$noActa[]     = 0;
		$fechaActa[]  = 0;
		$desde[]      = 0;
		$hasta[]      = 0;
		$horasS[]     = 0;
		$nombreS[]    = 0;
		$centroS[]    = 0;
		$hSituacion   = 0;
		$s1           = 0;
		$s2           = 0;
		$s3           = 0;
		$s4           = 0;
		$s5           = 0;

		for ($i=0; $i<count($situacionAdmin); $i++){
				$codigoSit[$i]  = $situacionAdmin[$i]["codigoS"];
				$noActa[$i]     = $situacionAdmin[$i]["noActa"];
				$fechaActa[$i]  = $situacionAdmin[$i]["fechaActa"];
				$desde[$i]      = $situacionAdmin[$i]["desde"];
				$hasta[$i]      = $situacionAdmin[$i]["hasta"];
				$nombreS[$i]    = $situacionAdmin[$i]["nombre"];
				$horasS[$i]     = $situacionAdmin[$i]["horas"];
				$centroS[$i]    = $situacionAdmin[$i]["centroCosto"];

				if ($codigoSit[$i] == 1){
					$s1++;
				}
				if ($codigoSit[$i] == 2){
					$s2++;
				}
				if ($codigoSit[$i] == 3){
					$s3++;
				}
				if ($codigoSit[$i] == 4){
					$s4++;
				}
				if ($codigoSit[$i] == 5){
					$s5++;
				}

				$nSituacion = $nSituacion + 1;
				$hSituacion = $hSituacion + $horasS[$i];
		}

		$totalGestion = $hGestion + $hProyectoP + $hSituacion;

		$situacion = "";

		if ($nSituacion != 0)
		{
			for ($i=0; $i<$nSituacion; $i++){
				$codigoSit = $codigoSit[$i];
				$costoS    = $centroS[$i];
				$desde     = $desde[$i];
				$hasta     = $hasta[$i];
				$actaS     = $noActa[$i];
				$fechaS    = $fechaActa[$i];
				$horaS     = $horasS[$i];


				if ($codigoSit == 1){
					$situacion = $situacion .
								"<tr><td>Comisi&oacute;n de Servicio</td>".
								"<td align=$centro>$costoS</td>".
								"<td align=$centro>$desde</td>".
								"<td align=$centro>$hasta</td>".
								"<td align=$centro>$actaS</td>".
								"<td align=$centro>$fechaS</td>".
								"<td align=$centro>$horaS</td></tr>";
				}
				if ($codigoSit == 2){
					$situacion = $situacion .
								"<tr><td>Comisi&oacute;n de Estudio</td>".
								"<td align=$centro>$costoS</td>".
								"<td align=$centro>$desde</td>".
								"<td align=$centro>$hasta</td>".
								"<td align=$centro>$actaS</td>".
								"<td align=$centro>$fechaS</td>".
								"<td align=$centro>$horaS</td></tr>";
				}
				if ($codigoSit == 3){
					$situacion = $situacion .
								"<tr><td>Comisi&oacute;n de Administrativa</td>".
								"<td align=$centro>$costoS</td>".
								"<td align=$centro>$desde</td>".
								"<td align=$centro>$hasta</td>".
								"<td align=$centro>$actaS</td>".
								"<td align=$centro>$fechaS</td>".
								"<td align=$centro>$horaS</td></tr>";
				}
				if ($codigoSit == 4){
					$situacion = $situacion .
								"<tr><td>A&nacute;o Sab&aacute;tico</td>".
								"<td align=$centro>$costoS</td>".
								"<td align=$centro>$desde</td>".
								"<td align=$centro>$hasta</td>".
								"<td align=$centro>$actaS</td>".
								"<td align=$centro>$fechaS</td>".
								"<td align=$centro>$horaS</td></tr>";
				}
				if ($codigoSit == 5){
					$situacion = $situacion .
								"<tr><td>Encargo</td>".
								"<td align=$centro>$costoS</td>".
								"<td align=$centro>$desde</td>".
								"<td align=$centro>$hasta</td>".
								"<td align=$centro>$actaS</td>".
								"<td align=$centro>$fechaS</td>".
								"<td align=$centro>$horaS</td></tr>";
				}

			}
		}

		if ($s1 == 0){
			$situacion = $situacion . "<tr><td>Comisi&oacute;n de Servicio</td><td></td><td></td><td></td><td></td><td></td></tr>";
		}
		if ($s2 == 0){
			$situacion = $situacion . "<tr><td>Comisi&oacute;n de Estudio</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		}
		if ($s3 == 0){
			$situacion = $situacion . "<tr><td>Comisi&oacute;n de Administrativa</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		}
		if ($s4 == 0){
			$situacion = $situacion . "<tr><td>A&nacute;o Sab&aacute;tico</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		}
		if ($s5 == 0){
			$situacion = $situacion . "<tr><td>Encargo</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		}

		$horasTotal =$hTotalInvestigacion + $hExt + $totalGestion + $horasTotalActividades;

		// Paso de Tabla para generacion de PDF
		$tablealign = <<<EOT

		<h3>A. INFORMACI&Oacute;N GENERAL</h3>
		<table border="1">
			<tr border="1">
				<td border="1"> Apellidos: $apellidos</td>
				<td border="1"> Nombres: $nombres</td>
				<td border="1"> Documento de Identidad No.: $documento</td>
			</tr>
			<tr border="1">
				<td border="1"> Facultad: $facultad</td>
				<td border="1"> Departamento: $departamento</td>
				<td border="1"> Periodo Acad&eacute;mico:
				</td>
			</tr>
			<tr border="1">
				<td border="1"> Tipo de Vinculaci&oacute;n: $vinculacion</td>
				<td border="1"> Tipo de Dedicaci&oacute;n: $dedicacion</td>
				<td border="1"> Categor&iacute;a: $categoria</td>
			</tr>
		</table>
		<p></p>

		<h3>B. ASIGNACI&Oacute;N DE RESPONSABILIDADES ACAD&Eacute;MICAS</h3>

		<h3>1. ACTIVIDADES ACAD&Eacute;MICAS DE DOCIENCIA</h3>
		<h4>1.1 DOCENCIA</h4>
		<table border="1" style="font-size:8">
			<tr>
		  	   	<td rowspan="2" align="center" width="105"></td>
			    <td rowspan="2" VALIGN="MIDDLE" align="center" width="70" style="font-size:9">C&oacute;digo</td>
			    <td rowspan="2" align="center" width="160" style="font-size:9">Nombre</td>
			    <td rowspan="2" align="center" width="150" style="font-size:9">Proyecto Curricular</td>
			    <td rowspan="2" align="center" width="55" style="font-size:9">Centro de Costo</td>
			    <td colspan="2" align="center" width="90" style="font-size:9">N&uacute;mero de Estudiantes</td>
			    <td colspan="6" align="center" width="270" style="font-size:9">Horario</td>
			    <td rowspan="2" align="center" width="40" style="font-size:9">Horas /Sem</td>
	 	</tr>
		<tr style="font-size:7">
			<td align="center">Pregrado</td>
			<td align="center">Posgrado</td>
			<td align="center">Lunes</td>
			<td align="center">Martes</td>
			<td align="center">Mi&eacute;rcoles</td>
			<td align="center">Jueves</td>
			<td align="center">Viernes</td>
			<td align="center">S&aacute;bado</td>

		</tr>
		<!-- ESPACIOS ACADEMICOS -->
		$asigPractica

		$asigPractica1
	</table>
	<!-- TOTAL DOCENCIA -->
	<table style="font-size:9;font-weight: bold">
		<tr><td colspan=13  align="rigth" width="900">TOTAL HORAS POR ACTIVIDADES ACAD&Eacute;MICAS DE DOCENCIA</td>
  			<td width="40" align="center" border="1">$horasTotalDocencia</td>
 		</tr>
	</table>

	<!-- 1.2 ACTIVIDADES DE APOYO A LA DOCENCIA -->

	<h4>1.2 ACTIVIDADES DE APOYO A LA DOCENCIA</h4>

	<table border="1" style="font-size:8">
		<tr>
  	    	<td align="center" style="font-size:9" width="350">Tipo de Actividad</td>
		    <td align="center" style="font-size:9" width="210">Espacio Acad&eacute;mico</td>
		    <td align="center" style="font-size:9" width="90">N&uacute;mero de Estudiantes</td>
		    <td align="center" style="font-size:9" width="200">Proyecto Curricular</td>
		    <td align="center" style="font-size:9" width="55">Centro de Costo</td>
		    <td align="center" style="font-size:9" width="40">Horas /Sem</td>
 		</tr>

 		$apoyoDoc1
 		$apoyoDoc2
 		$apoyoDoc3

	</table>
	<!-- TOTAL APOYO DOCENCIA -->
	<table style="font-size:9;font-weight: bold">
		<tr><td colspan=13 align="rigth" width="905">TOTAL HORAS ACTIVIDADES DE APOYO A LA DOCENCIA</td>
  			<td width="40" align="center" border="1">$horasTotalApoyo</td>
 		</tr>
	</table>
	<p></p>

	<!-- TOTAL HORAS POR ACTIVIDADES ACADEMICAS DE DOCENCIA -->
	<table style="font-size:10;font-weight: bold">
		<tr>
			<td colspan=5 align="rigth" width="905">TOTAL HORAS POR ACTIVIDADES ACAD&Eacute;MICAS DE DOCENCIA</td>
  			<td width="40" align="center" border="1">$horasTotalActividades</td>
 		</tr>
	</table>

EOT;

	// print a block of text using Write()
	$pdf->writeHTML($tablealign, true, 0, true, 0);

	$pdf->AddPage();

	// Paso de Tabla para generacion de PDF
	$tablealign1 = <<<EOT

	<!-- 2. ACTIVIDADES DE INVESTIGACION -->
	<h3>2. ACTIVIDADES DE INVESTIGACI&Oacute;N</h3>

	<!-- 2.1 DIRECCION DE TRABAJOS DE GRADO -->
	<h4>2.1 DIRECCI&Oacute;N DE TRABAJOS DE GRADO</h4>

	<table border="1" style="font-size:8">

		<tr>
		    <td rowspan="2" align="center" style="font-size:9" width="70">C&oacute;digo</td>
		    <td rowspan="2" align="center" style="font-size:9" width="320">T&iacute;tulo del Trabajo de Grado o Tesis</td>
		    <td colspan="2" align="center" style="font-size:9" width="170">Acta Consejo de Departamento</td>
		    <td rowspan="2" align="center" style="font-size:9" width="180">Proyecto Curricular</td>
		    <td rowspan="2" align="center" style="font-size:9" width="100">Centro de Costo</td>
		    <td rowspan="2" align="center" style="font-size:9" width="70">Nivel</td>
		    <td rowspan="2" align="center" style="font-size:9" width="40">Horas /Sem</td>
 		</tr>
		<tr style="font-size:7">
			<td align="center">N&uacute;mero</td>
			<td align="center">Fecha</td>
		</tr>

		$trabajosGrado

 	</table>
 	<!-- TOTAL TRABAJOS DE GRADO -->
	<table style="font-size:9;font-weight: bold">
		<tr><td colspan=7 align="rigth" width="910">TOTAL HORAS DIRECCI&Oacute;N DE TRABAJOS DE GRADO</td>
  			<td width="40" align="center" border="1">$hTrabGrado</td>
 		</tr>
	</table>

	<!-- 2.2 PROYECTOS DE INVESTIGACION -->
	<h4>2.2 PROYECTOS DE INVESTIGACI&Oacute;N</h4>
	<table border="1" style="font-size:8">

		<tr>
		    <td rowspan="2" align="center" style="font-size:9" width="70">C&oacute;digo</td>
		    <td rowspan="2" align="center" style="font-size:9" width="320">T&iacute;tulo Proyecto</td>
		    <td colspan="2" align="center" style="font-size:9" width="170">Acta Consejo de Departamento</td>
		    <td rowspan="2" align="center" style="font-size:9" width="180">Proyecto Curricular</td>
		    <td rowspan="2" align="center" style="font-size:9" width="100">Centro Costo</td>
		    <td rowspan="2" align="center" style="font-size:9" width="70">Funci&oacute;n</td>
		    <td rowspan="2" align="center" style="font-size:9" width="40">Horas / Sem</td>
 		</tr>
		<tr style="font-size:7">
			<td align="center">N&uacute;mero</td>
			<td align="center">Fecha</td>
		</tr>

		$proyectoInvestigacion

	</table>
	<!-- TOTAL PROYECTOS INVESTIGACION -->
	<table style="font-size:9;font-weight: bold">
		<tr><td colspan=7 align="rigth" width="910">TOTAL HORAS DIRECCI&Oacute;N PROYECTOS DE INVESTIGACI&Oacute;N</td>
  			<td width="40" align="center" border="1">$hInvest</td>
 		</tr>
	</table>

	<p></p>
	<!-- TOTAL HORAS POR ACTIVIDADES DE INVESTIGACION -->
	<table style="font-size:10;font-weight: bold">
		<tr>
			<td colspan=5 align="rigth" width="905">TOTAL HORAS POR ACTIVIDADES DE INVESTIGACI&Oacute;N</td>
  			<td width="40" align="center" border="1">$hTotalInvestigacion</td>
 		</tr>
	</table>

	<p></p>
	<!-- 3. ACTIVIDADES DE EXTENSION -->
	<h3>3. ACTIVIDADES DE EXTENSI&Oacute;N</h3>
	<table border="1" style="font-size:8">
		<tr>
		    <td rowspan="2" align="center" style="font-size:9" width="70">C&oacute;digo</td>
		    <td rowspan="2" align="center" style="font-size:9" width="330">T&iacute;tulo Proyecto</td>
		    <td colspan="2" align="center" style="font-size:9" width="170">Acta Consejo de Departamento</td>
		    <td rowspan="2" align="center" style="font-size:9" width="240">Proyecto Curricular</td>
		    <td rowspan="2" align="center" style="font-size:9" width="100">Centro Costo</td>
		    <td rowspan="2" align="center" style="font-size:9" width="40">Horas /Sem</td>
 		</tr>
		<tr style="font-size:7">
			<td align="center">N&uacute;mero</td>
			<td align="center">Fecha</td>
		</tr>

		$proyExtension

	</table>

	<!-- TOTAL EXTENSION -->
	<table style="font-size:10;font-weight: bold">
		<tr><td colspan=7 align="rigth" width="910">TOTAL HORAS POR ACTIVIDADES DE EXTENSI&Oacute;N</td>
  			<td width="40" align="center" border="1">$hExt</td>
 		</tr>
	</table>

EOT;

	// print a block of text using Write()
	$pdf->writeHTML($tablealign1, true, 0, true, 0);

	$pdf->AddPage();

	// Paso de Tabla para generacion de PDF
	$tablealign2 = <<<EOT

	<!-- 4. ACTIVIDADES GESTION INSTITUCIONAL -->
	<h3>4. ACTIVIDADES GESTI&Oacute;N INSTITUCIONAL</h3>

	<table border="1" style="font-size:8">

		<tr>
		    <td colspan="2" align="center" style="font-size:9" width="330">Tipo de Actividad</td>
		    <td align="center" style="font-size:9" width="420">Descripci&oacute;n</td>
		    <td align="center" style="font-size:9" width="150">Centro de Costo x Proyecto Curricular</td>
		    <td align="center" style="font-size:9" width="40">Horas /Sem</td>
 		</tr>

 		$gestion1
 		$gestion2
 		$gestion3
 		$gestion4
 		$gestion5
 		$gestion6
 		$gestion7
 		$gestion8
 		$gestion9
 		$gestion10
 		$gestion11
 		$gestion12
 		$gestion13

 	</table>
 	<!-- TOTAL HORAS GESTION -->
	<table style="font-size:9;font-weight: bold">
		<tr><td colspan=13 align="rigth" width="900">TOTAL HORAS</td>
  			<td width="40" align="center" border="1">$hGestion</td>
 		</tr>
	</table>

	<!-- 4.14 Proyectos Plan Desarrollo Institucional -->
	<h5>4.14 Proyectos Plan Desarrollo Institucional</h5>
	<table border="1" style="font-size:8">
		<tr>
		    <td rowspan="2" VALIGN="MIDDLE" align="center" width="80" style="font-size:9">C&oacute;digo</td>
		    <td rowspan="2" align="center" width="450" style="font-size:9">Nombre Proyecto</td>
		    <td rowspan="2" align="center" width="100" style="font-size:9">Centro de Costo</td>
		    <td colspan="6" align="center" width="270" style="font-size:9">Horario</td>
		    <td rowspan="2" align="center" width="40" style="font-size:9">Horas /Sem</td>
	 	</tr>
		<tr style="font-size:7">
			<td align="center">Lunes</td>
			<td align="center">Martes</td>
			<td align="center">Mi&eacute;rcoles</td>
			<td align="center">Jueves</td>
			<td align="center">Viernes</td>
			<td align="center">S&aacute;bado</td>
		</tr>
		$proyectoPlanD

	</table>
	<!-- TOTAL 4.14 -->
	<table style="font-size:9;font-weight: bold">
		<tr><td colspan=7 align="rigth" width="900">TOTAL HORAS</td>
  			<td width="40" align="center" border="1">$hProyectoP</td>
 		</tr>
	</table>

	<!-- 4.15 Situaciones Administrativas -->
	<h5>4.15 Situaciones Administrativas</h5>
	<table border="1" style="font-size:8">
		<tr>
		    <td rowspan="2" align="center" style="font-size:9" width="450">Tipo de Situaci&oacute;n</td>
		    <td rowspan="2" align="center" style="font-size:9" width="80">Centro Costo</td>
		    <td colspan="2" align="center" style="font-size:9" width="185">T&eacute;rmino</td>
		    <td colspan="2" align="center" style="font-size:9" width="185">Acto Administrativo</td>
		    <td rowspan="2" align="center" style="font-size:9" width="40">Horas /Sem</td>
 		</tr>
		<tr style="font-size:7">
			<td align="center">Desde</td>
			<td align="center">Hasta</td>
			<td align="center">N&uacute;mero</td>
			<td align="center">Fecha</td>
		</tr>

		$situacion

	</table>

	<!-- TOTAL 4.15 -->
	<table style="font-size:9;font-weight: bold">
		<tr><td colspan=7 align="rigth" width="900">TOTAL HORAS</td>
  			<td width="40" align="center" border="1">$hSituacion</td>
 		</tr>
	</table>
	<p></p>
	<!-- TOTAL HORAS DE ACTIVIDADES DE GESTION INSTITUCIONAL-->
	<table style="font-size:10;font-weight: bold">
		<tr>
			<td colspan=5 align="rigth" width="900">TOTAL HORAS DE ACTIVIDADES DE GESTI&Oacute;N INSTITUCIONAL</td>
  			<td width="40" align="center" border="1">$totalGestion</td>
 		</tr>
	</table>
	<p></p>
	<!-- TOTALES -->
	<table border="1" style="font-size:9;font-weight: bold">
		<tr>
		    <td align="center" style="font-size:9" width="188">HORAS DOCENCIA</td>
		    <td align="center" style="font-size:9" width="188">HORAS INVESTIGACI&Oacute;N</td>
		    <td align="center" style="font-size:9" width="188">HORAS EXTENSI&Oacute;N</td>
		    <td align="center" style="font-size:9" width="188">HORAS GESTI&Oacute;N INST.</td>
		    <td align="center" style="font-size:9" width="188">TOTAL HORAS SEMANALES</td>
 		</tr>
 		<tr>
 		<td align="center">$horasTotalActividades</td>
 		<td align="center">$hTotalInvestigacion</td>
 		<td align="center">$hExt</td>
 		<td align="center">$totalGestion</td>
 		<td align="center">$horasTotal</td>
 		</tr>
	</table>

	<p></p><p></p><p></p>
	<!-- FIRMAS -->
	<table border="0" style="font-size:9">
		<tr>
		    <td align="center" style="font-size:9" width="235">Firma del Profesor</td>
		    <td align="center" style="font-size:9" width="235">Firma Jefe de Departamento</td>
		    <td align="center" style="font-size:9" width="235">Firma del Decano</td>
		    <td align="center" style="font-size:9" width="235">Fecha</td>
 		</tr>
	</table>

EOT;


	// print a block of text using Write()
	$pdf->writeHTML($tablealign2, true, 0, true, 0);


		// ---------------------------------------------------------





		//Close and output PDF document
		$pdf->Output('plan_trabajo.pdf', 'I');
	}
}






