<?php

/**
 * This is the model class for table "planTrabajo".
 *
 * The followings are the available columns in table 'planTrabajo':
 * @property integer $f_codigo
 * @property string $f_nombre
 */
class planTrabajo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return facultad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'profesor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentoProfesor, apellido1', 'required'),
			array('documentoProfesor', 'numerical', 'integerOnly'=>true),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('documentoProfesor, apellido1', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//Relaciones Tabla Profesor
			'documentoProfesor'=>array(self::BELONGS_TO, 'profesor', 'documentoProfesor'),
			'apellido1'=>array(self::MANY_MANY, 'profesor', 'apellido1'),
			'apellido2'=>array(self::MANY_MANY, 'profesor', 'apellido2'),
			'vinculacion'=>array(self::BELONGS_TO, 'vinculacion', 'codigoVinculacion'),
            'departamento'=>array(self::BELONGS_TO, 'departamento', 'centroCostoDepartamento'),
            'dedicacion'=>array(self::BELONGS_TO, 'dedicacion', 'codigoDedicacion'),
            'categoria'=>array(self::BELONGS_TO, 'categoria', 'codigoCategoria'),
            //Relaciones Tabla Departamento
            //'facultad' =>array(self::BELONGS_TO, 'facultad', 'departamento(centroCostoDepartamento, centroCostoFacultad)'),
            //Relaciones Tabla cursoProfesor
            //'cursoProfesor'=>array(self::BELONGS_TO, 'cursoprofesor', '(documentoProfesor, codigoAsignatura, grupo)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		
		return array(
			'documentoProfesor'       => 'Documento de Identidad No.',
			'nombre1'                 => 'Primer Nombre',
			'nombre2'                 => 'Segundo Nombre',
			'apellido1'               => 'Primer Apellido',
			'apellido2'               => 'Segundo Apellido',
			'centroCostoDepartamento' => 'Centro de Costo',
			'codigoVinculacion'       => 'Codigo Vinculacic&oacute;n',
			'codigoCategoria'         => 'Codigo Categorc&iacute;dula',
			'codigoDedicacion'        => 'Codigo Dedicacic&oacute;n',
			
			//Informacion General
			'informacionGeneral'      => 'A. INFORMACI&Oacute;N GENERAL',
			'apellidos'               => 'Apellidos',
			'nombres'                 => 'Nombres',
			'nombreF'                 => 'Facultad',
			'nombreD'                 => 'Departamento',
			'periodoAcademico'        => 'Periodo Acad&eacute;mico',
			'tipoVinculacion'         => 'Tipo Vinculaci&oacute;n',
			'tipoDedicacion'          => 'Tipo Dedicaci&oacute;n',
			'cateogria'               => 'Categori&iacute;a',
			
			//Asignacion Responsabilidades Academicas
			'responsabilidadAcademica' => 'B. ASIGNACI&Oacute;N RESPONSABILIDADES ACAD&Eacute;MICAS',
			'tipoActividad' => 'Tipo de Actividad',
			
			//Docencia
			'actividadesAcademicasDocencia' => '1. Actividades Acad&eacute;micas de Docencia',
			'docencia'           => '1.1 Docencia',
			'codigo'             => 'C&oacute;digo',
			'nombre'             => 'Nombre',
			'proyectoCurricular' => 'Proyecto Curricular',
			'numeroEstudiantes'  => 'N&uacute;mero de Estudiantes',
			'horario'            => 'Horario',
			'horasSem'           => 'Horas / Sem',
			'espacioAcademico'   => 'Espacios Acad&eacute;micos o Asignaturas',
			'practicaEducativa'  => 'Pr&aacute;ctica Educativa',
			'pregrado'           => 'Pregrado',
            'posgrado'           => 'Posgrado',
            'lunes'              => 'L',
            'martes'             => 'M',
            'miercoles'           => 'C',
            'jueves'             => 'J',
            'viernes'            => 'V',
            'sabado'             => 'S',
            'totalApoyo'         => 'TOTAL HORAS POR ACTIVIDADES DE APOYO A LA DOCENCIA',
            'total'              => 'TOTAL HORAS POR ACTIVIDADES ACAD&Eacute;MICAS DE DOCENCIA',
            
            //Apoyo Docencia
			'acApDocencia'      => '1.2 Actividades de Apoyo a la Docencia',
			'espacioAc' 		=> 'Espacio Acad&eacute;mico',
			'tutoria' 			=> 'Tutor&iacute;a a Estudiantes',
			'preparacion'		=> 'Preparaci&oacute;n, actualizaci&oacute;n, sistematizaci&oacute;n e innovaci&oacute;n de clases',
			'evalAct' 			=> 'Evaluaci&oacute;n de Actividades',
			
			//Investigacion - Proyectos de Grado
			'actividadesInvestigacion' => '2. Actividades de Investigaci&oacute;n',
			'direccionGrado'           => '2.1 Direcci&oacute;n de Trabajos de Grado',
			'tituloTesis'              => 'T&iacute;tulo del trabajo de grado o tesis',
			'actaDepto'                => 'Acta Consejo de Departamento',
			'nivel'                    => 'Nivel',
			'numero'                   => 'N&uacute;mero',
			'fecha'                    => 'Fecha',
			'totalTrabGrado'           => 'TOTAL HORAS DIRECCI&Oacute;N DE TRABAJOS DE GRADO',
			
			//Investigacion - Proyectos de Investigacion
			'investigacion'      => '2.2 Proyectos de Investigaci&oacute;n',
			'tituloProyecto'     => 'T&iacute;tulo Proyecto',
			'actaFacultad'       => 'Acta Consejo de Facultad',
			'funcion'            => 'Funci&oacute;n',
			'totalInvestigacion' => 'TOTAL HORAS POR ACTIVIDADES DE INVESTIGACI&Oacute;N',
			
			//Extension
			'actividadesExtension' => '3. Actividades de Extensi&oacute;n',
			'nombreProyecto'       => 'Nombre del Proyecto o Actividad',
			'totalExtension'       => 'TOTAL HORAS POR ACTIVIDADES DE EXTENSI&Oacute;N',
			
			//Actividades de Gestion Institucional
			'actividadesGestion'  => '4. Actividades de Gesti&oacute;n Institucional',
			'tipoActividad'       => 'Tipo de Actividad',
			'descripcion'         => 'Descripci&oacute;n',
			'centroCostoProyecto' => 'Centro de Costo x Proyecto Curricular',
			'4_1'                 => '4.1 Coordinaci&oacute;n de proyectos curriculares o programas acad&eacute;micos',
			'4_2'                 => '4.2 Coordinador de L&iacute;nea de Investigaci&oacute;n',
            '4_3'            	  => '4.3 Coordinaci&oacute;n de &eacute;nfasis',
			'4_4'                 => '4.4 Asesor de cohorte - Coordinador de semestre',
			'4_5'                 => '4.5 Coordinaci&oacute;n general de pr&aacute;ctica',
			'4_6'                 => '4.6 Coordinador de &aacute;rea',
			'4_7'                 => '4.7 Jurados de trabajos de grado o tesis',
			'4_8'                 => '4.8 Participaci&oacute;n en Consejo de Departamento',
			'4_9'                 => '4.9 Reuni&oacute;n de profesores',
			'4_10'                => '4.10 Proceso de Autoevaluaci&oacute;n y Acreditaci&oacute;n',
			'4_11'                => '4.11 Participaci&oacute;n en equipos integrales de docencia',
			'4_12'                =>'4.12 Renovaci&oacute;n curricular y seguimiento de programas acad&eacute;micos',
			'4_13'                =>'4.13 Representaci&oacute;n del profesorado a consejos y/o comit&eacute;s',
			'4_14'                =>'4.14 Proyectos del Plan de Desarrollo Institucional',
			'4_15'                =>'4.15 Situaciones Administrativas',
			'comiteInst'		  => 'Comit&eacute;s Institucionales',
			'ciarp'   			  => 'CIARP',
			'consDepto' 		  => 'Consejo de Departamento',
			'consFac' 			  => 'Consejo de Facultad',
			'consAcad' 			  => 'Consejo Acad&eacute;mico',
			'consSup' 			  => 'Consejo Superior',
			'totalHoras' 		  => 'Total Horas',
			'nombreP'             => 'Nombre Proyecto',
			'tipoSituacion'       => 'Tipo Situaci&oacute;n',
			'termino'             => 'T&eacute;rmino',
            'actoAdmin'           => 'Acto Administrativo',
            'desde'               => 'Desde',
            'hasta'               => 'Hasta',
            'horasDocencia'       => 'HORAS DOCENCIA',
            'horasInves'          => 'HORAS INVESTIGACI&Oacute;N',
            'horasExt'            => 'HORAS EXTENSI&Oacute;N',
            'horasGestion'        => 'HORAS GESTI&Oacute;N INSTITUCIONAL',
            'horasSemana'         => 'TOTAL HORAS SEMANALES',
            'observaciones'       => 'Observaciones',
					                                                                                                                 
		);  		                                                          
	}       		                                                          
            		                                                          
                                                                        
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('documentoProfesor',$this->documentoProfesor);
		
		
		
		return new CActiveDataProvider('planTrabajo', array(
			'criteria'=>$criteria,
		));
	}
}



