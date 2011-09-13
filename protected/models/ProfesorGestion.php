<?php

/**
 * This is the model class for table "profesorgestion".
 *
 * The followings are the available columns in table 'profesorgestion':
 * @property integer $codigoActividadGestion
 * @property string $documentoProfesor
 * @property integer $centroCostoPrograma
 * @property integer $horas
 */
class ProfesorGestion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProfesorGestion the static model class
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
		return 'profesorgestion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigoActividadGestion, documentoProfesor, centroCostoPrograma', 'required'),
			array('codigoActividadGestion, centroCostoPrograma, horas', 'numerical', 'integerOnly'=>true),
			array('documentoProfesor', 'length', 'max'=>50),
                        array('horas','validarHoras'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigoActividadGestion, documentoProfesor, centroCostoPrograma, horas', 'safe', 'on'=>'search'),
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
			'codigoActividadGestion' => 'Codigo Actividad Gestion',
			'documentoProfesor' => 'Documento Profesor',
			'centroCostoPrograma' => 'Centro Costo Programa',
			'horas' => 'Horas',
		);
	}

	  	public function validarHoras($attribute,$params)
		{
              	if($this->codigoActividadGestion==2 && $this->horas>4)
		  {
		$this->addError($attribute,"Error de horas de Gestión. El número máximo de horas permitido para coordinación de línea de investigación es 4.");
		  }
		


		}
}