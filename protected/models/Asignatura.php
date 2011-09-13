<?php

/**
 * This is the model class for table "asignatura".
 *
 * The followings are the available columns in table 'asignatura':
 * @property integer $codigoAsignatura
 * @property string $nombre
 * @property integer $horas
 * @property integer $creditos
 * @property integer $practica
 *
 * The followings are the available model relations:
 * @property Curso[] $cursos
 */
class Asignatura extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Asignatura the static model class
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
		return 'asignatura';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigoAsignatura, nombre, horas, creditos', 'required'),
			array('codigoAsignatura, horas, creditos, practica', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigoAsignatura, nombre, horas, creditos, practica', 'safe', 'on'=>'search'),
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
			'cursos' => array(self::HAS_MANY, 'Curso', 'codigoAsignatura'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigoAsignatura' => 'Codigo Asignatura',
			'nombre' => 'Nombre',
			'horas' => 'Horas',
			'creditos' => 'Creditos',
			'practica' => 'Practica',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('horas',$this->horas);
		$criteria->compare('creditos',$this->creditos);
		$criteria->compare('practica',$this->practica);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}