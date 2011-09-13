<?php

/**
 * This is the model class for table "profesorinvestigacion".
 *
 * The followings are the available columns in table 'profesorinvestigacion':
 * @property string $documentoProfesor
 * @property string $codigoProyecto
 * @property integer $codigoFuncion
 * @property integer $horas
 */
class ProfesorInvestigacion extends Proyecto
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProfesorInvestigacion the static model class
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
		return 'profesorinvestigacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentoProfesor, codigoProyecto, codigoFuncion, horas', 'required'),
			array('codigoFuncion, horas', 'numerical', 'integerOnly'=>true),
			array('documentoProfesor, codigoProyecto', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('documentoProfesor, codigoProyecto, codigoFuncion, horas', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentoProfesor' => 'Documento Profesor',
			'codigoProyecto' => 'Codigo Proyecto',
			'codigoFuncion' => 'Codigo Funcion',
			'horas' => 'Horas de Proyecto de Investigación',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function  getIdName() {
        return "codigoProyecto";
        }
        public function crearNuevo()
        {
            return new ProfesorInvestigacion();
        }
        public function  cargarDatos($post) {
        
         $this->horas = $post["horas"];
         $this->codigoFuncion = $post["codigoFuncion"];
        }
}