<?php

/**
 * This is the model class for table "actividadgestion".
 *
 * The followings are the available columns in table 'actividadgestion':
 * @property integer $codigoActividadGestion
 * @property string $nombre
 *
 * The followings are the available model relations:
 * @property Profesor[] $profesors
 */
class ActividadGestion extends CActiveRecord
{
      public $profesor;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @return ActividadGestion the static model class
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
		return 'actividadgestion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigoActividadGestion, nombre', 'required'),
			array('codigoActividadGestion', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigoActividadGestion, nombre', 'safe', 'on'=>'search'),
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
			'profesors' => array(self::MANY_MANY, 'Profesor', 'profesorgestion(codigoActividadGestion, codigoProfesor)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigoActividadGestion' => 'Codigo Actividad Gestion',
			'nombre' => 'Nombre',
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

		$criteria->compare('codigoActividadGestion',$this->codigoActividadGestion);
		$criteria->compare('nombre',$this->nombre,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}