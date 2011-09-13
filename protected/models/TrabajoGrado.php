<?php

/**
 * This is the model class for table "trabajogrado".
 *
 * The followings are the available columns in table 'trabajogrado':
 * @property string $codigoTrabajo
 * @property string $titulo
 * @property integer $noActa
 * @property string $fechaActa
 * @property integer $centroCostoPrograma
 * @property integer $nivel
 * @property string $documentoProfesor
 *
 * The followings are the available model relations:
 * @property Programa $centroCostoPrograma0
 * @property Niveltrabajo $nivel0
 * @property Profesor $documentoProfesor0
 */
class TrabajoGrado extends Trabajo
{
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return TrabajoGrado the static model class
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
		return 'trabajogrado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//	array('codigoTrabajo, titulo, noActa, fechaActa, centroCostoPrograma, nivel, documentoProfesor,horas', 'required'),
                        array('horas', 'required'),
			array('noActa, centroCostoPrograma, nivel,horas', 'numerical', 'integerOnly'=>true),
			array('codigoTrabajo, documentoProfesor', 'length', 'max'=>50),
		//	array('titulo', 'length', 'max'=>250),
			array('horas','verificarHoras'),
			array('titulo','verificarDuplicados'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('codigoTrabajo, titulo, noActa, fechaActa, centroCostoPrograma, nivel, documentoProfesor', 'safe', 'on'=>'search'),
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
			'centroCostoPrograma0' => array(self::BELONGS_TO, 'Programa', 'centroCostoPrograma'),
			'nivel0' => array(self::BELONGS_TO, 'Niveltrabajo', 'nivel'),
			'documentoProfesor0' => array(self::BELONGS_TO, 'Profesor', 'documentoProfesor'),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigoTrabajo' => 'Codigo Trabajo',
			'titulo' => 'Titulo',
			'noActa' => 'No Acta',
			'fechaActa' => 'Fecha Acta',
			'centroCostoPrograma' => 'Centro Costo Programa',
			'nivel' => 'Nivel',
                        'horas' => 'Horas de Trabajo de Grado',
			'documentoProfesor' => 'Documento Profesor',
		);
	}
          /**
         *
         * @param <type> $attribute
         * @param <type> $params
         */
    	public function verificarHoras($attribute,$params)
		{
              	if($this->horas>$this->nivel && $this->nivel==1)
		  {
		$this->addError($attribute,"error de horas. El número de horas de trabajo de pregrado debe ser como máximo 1 ");
		  }
		if($this->horas>$this->nivel && $this->nivel==2)
		  {
		$this->addError($attribute,"error de horas. El número de horas de trabajo de posgrado debe ser como máximo 2 ");
		  }


		}
    
	public function crearNuevo()
        {

        return new TrabajoGrado;
        }
        public function getIdName()
        {
            return "codigoTrabajo";
        }
	
    

    
}