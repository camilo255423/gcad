<?php

/**
 * This is the model class for table "cursoprofesor".
 *
 * The followings are the available columns in table 'cursoprofesor':
 * @property integer $codigoAsignatura
 * @property integer $grupo
 * @property string $documentoProfesor
 * @property integer $horasTutoria
 * @property integer $horasPreparacion
 * @property integer $horasEvaluacion
 *
 * The followings are the available model relations:
 * @property Profesor $documentoProfesor0
 * @property Curso $codigoAsignatura0
 * @property Curso $grupo0
 */
class CursoProfesor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CursoProfesor the static model class
	 */
    	public $compartido=false; //curso compartido
	private $errores=array();
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cursoprofesor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigoAsignatura, grupo, documentoProfesor, horasTutoria, horasPreparacion, horasEvaluacion', 'required'),
			array('codigoAsignatura, grupo, horasTutoria, horasPreparacion, horasEvaluacion', 'numerical', 'integerOnly'=>true),
			array('documentoProfesor', 'length', 'max'=>50),
                    	array('documentoProfesor', 'verificarHorario'),
		
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigoAsignatura, grupo, documentoProfesor, horasTutoria, horasPreparacion, horasEvaluacion', 'safe', 'on'=>'search'),
		);
	}
public function verificarHorario($attribute,$params)
		{
	      if(count($this->errores)>0)
		  $this->addError($attribute,$this->errores[0]);
		}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'rprofesor' => array(self::BELONGS_TO, 'Profesor', 'documentoProfesor'),
			'rcurso' => array(self::BELONGS_TO, 'Curso', 'codigoAsignatura'),
			'rgrupo' => array(self::BELONGS_TO, 'Curso', 'grupo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigoAsignatura' => 'Codigo Asignatura',
			'grupo' => 'Grupo',
			'documentoProfesor' => 'Documento Profesor',
			'horasTutoria' => 'Horas Tutoria',
			'horasPreparacion' => 'Horas Preparacion',
			'horasEvaluacion' => 'Horas Evaluacion',
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

		$criteria->compare('codigoAsignatura',$this->codigoAsignatura);
		$criteria->compare('grupo',$this->grupo);
		$criteria->compare('documentoProfesor',$this->documentoProfesor,true);
		$criteria->compare('horasTutoria',$this->horasTutoria);
		$criteria->compare('horasPreparacion',$this->horasPreparacion);
		$criteria->compare('horasEvaluacion',$this->horasEvaluacion);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        public function addCustomError($error)
	{
	   array_push($this->errores, $error);
	}
	public function numErrores()
	{
	  return count($this->errores);
	}
}