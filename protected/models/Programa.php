<?php

/**
 * This is the model class for table "programa".
 *
 * The followings are the available columns in table 'programa':
 * @property integer $centroCostoPrograma
 * @property string $nombre
 * @property integer $centroCostoDepartamento
 * @property string $ccoscodigo
 *
 * The followings are the available model relations:
 * @property Actividadextension[] $actividadextensions
 * @property Asignaturaprograma[] $asignaturaprogramas
 * @property Departamento $centroCostoDepartamento0
 * @property Proyectoinvestigacion[] $proyectoinvestigacions
 * @property Proyectoplandesarrollo[] $proyectoplandesarrollos
 * @property Trabajogrado[] $trabajogrados
 */
class Programa extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Programa the static model class
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
		return 'programa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('centroCostoPrograma, nombre, centroCostoDepartamento, ccoscodigo', 'required'),
			array('centroCostoPrograma, centroCostoDepartamento', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>250),
			array('ccoscodigo', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('centroCostoPrograma, nombre, centroCostoDepartamento, ccoscodigo', 'safe', 'on'=>'search'),
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
			'actividadextensions' => array(self::HAS_MANY, 'Actividadextension', 'centroCostoPrograma'),
			'rAsignaturaPrograma' => array(self::HAS_MANY, 'AsignaturaPrograma', 'centroCostoPrograma'),
			'centroCostoDepartamento0' => array(self::BELONGS_TO, 'Departamento', 'centroCostoDepartamento'),
			'proyectoinvestigacions' => array(self::HAS_MANY, 'Proyectoinvestigacion', 'centroCostoPrograma'),
			'proyectoplandesarrollos' => array(self::HAS_MANY, 'Proyectoplandesarrollo', 'centroCostoPrograma'),
			'trabajogrados' => array(self::HAS_MANY, 'Trabajogrado', 'centroCostoPrograma'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'centroCostoPrograma' => 'Centro Costo Programa',
			'nombre' => 'Nombre',
			'centroCostoDepartamento' => 'Centro Costo Departamento',
			'ccoscodigo' => 'Ccoscodigo',
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

		$criteria->compare('centroCostoPrograma',$this->centroCostoPrograma);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('centroCostoDepartamento',$this->centroCostoDepartamento);
		$criteria->compare('ccoscodigo',$this->ccoscodigo,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}