<?php

/**
 * This is the model class for table "grupo".
 *
 * The followings are the available columns in table 'grupo':
 * @property integer $codigoAsignatura
 * @property integer $grupo
 * @property integer $noEstudiantes
 *
 * The followings are the available model relations:
 * @property Cursoprofesor[] $cursoprofesors
 * @property Asignatura $codigoAsignatura0
 */
class Grupo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Grupo the static model class
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
		return 'grupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigoAsignatura, grupo, noEstudiantes', 'required'),
			array('codigoAsignatura, grupo, noEstudiantes', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigoAsignatura, grupo, noEstudiantes', 'safe', 'on'=>'search'),
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
			'rCursoProfesor' => array(self::HAS_MANY, 'CursoProfesor', 'codigoAsignatura,grupo'),
			'rAsignatura' => array(self::BELONGS_TO, 'Asignatura', 'codigoAsignatura'),
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
			'noEstudiantes' => 'No Estudiantes',
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
		$criteria->compare('noEstudiantes',$this->noEstudiantes);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}