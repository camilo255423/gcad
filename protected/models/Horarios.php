<?php

/**
 * This is the model class for table "horarios".
 *
 * The followings are the available columns in table 'horarios':
 * @property integer $codigoAsignatura
 * @property integer $grupo
 * @property integer $hora
 * @property string $dia
 *
 * The followings are the available model relations:
 * @property Curso $grupo0
 * @property Curso $codigoAsignatura0
 */
class Horarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Horarios the static model class
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
		return 'horarios';
	}
    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigoAsignatura, grupo, hora, dia', 'required'),
			array('codigoAsignatura, grupo, hora', 'numerical', 'integerOnly'=>true),
			array('dia', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigoAsignatura, grupo, hora, dia', 'safe', 'on'=>'search'),
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
			'grupo0' => array(self::BELONGS_TO, 'Curso', 'grupo'),
			'codigoAsignatura0' => array(self::BELONGS_TO, 'Curso', 'codigoAsignatura'),
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
			'hora' => 'Hora',
			'dia' => 'Dia',
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
		$criteria->compare('hora',$this->hora);
		$criteria->compare('dia',$this->dia,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}