<?php

/**
 * This is the model class for table "departamento".
 *
 * The followings are the available columns in table 'departamento':
 * @property integer $centroCostoDepartamento
 * @property string $nombre
 * @property integer $centroCostoFacultad
 *
 * The followings are the available model relations:
 * @property Facultad $centroCostoFacultad0
 * @property Profesor[] $profesors
 * @property Programa[] $programas
 */
class Departamento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Departamento the static model class
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
		return 'departamento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('centroCostoDepartamento, nombre, centroCostoFacultad', 'required'),
			array('centroCostoDepartamento, centroCostoFacultad', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('centroCostoDepartamento, nombre, centroCostoFacultad', 'safe', 'on'=>'search'),
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
			'rFacultad' => array(self::BELONGS_TO, 'Facultad', 'centroCostoFacultad'),
			'profesors' => array(self::HAS_MANY, 'Profesor', 'centroCostoDepartamento'),
			'programas' => array(self::HAS_MANY, 'Programa', 'centroCostoDepartamento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'centroCostoDepartamento' => 'Centro Costo Departamento',
			'nombre' => 'Nombre',
			'centroCostoFacultad' => 'Centro Costo Facultad',
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

		$criteria->compare('centroCostoDepartamento',$this->centroCostoDepartamento);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('centroCostoFacultad',$this->centroCostoFacultad);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}