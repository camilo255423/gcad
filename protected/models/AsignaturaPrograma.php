<?php

/**
 * This is the model class for table "asignaturaprograma".
 *
 * The followings are the available columns in table 'asignaturaprograma':
 * @property integer $codigoAsignatura
 * @property integer $centroCostoPrograma
 * @property integer $version
 *
 * The followings are the available model relations:
 * @property Programa $centroCostoPrograma0
 */
class AsignaturaPrograma extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AsignaturaPrograma the static model class
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
		return 'asignaturaprograma';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigoAsignatura, centroCostoPrograma, version', 'required'),
			array('codigoAsignatura, centroCostoPrograma, version', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigoAsignatura, centroCostoPrograma, version', 'safe', 'on'=>'search'),
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
			'rGrupo' => array(self::HAS_MANY, 'Grupo', 'codigoAsignatura'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigoAsignatura' => 'Codigo Asignatura',
			'centroCostoPrograma' => 'Centro Costo Programa',
			'version' => 'Version',
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
		$criteria->compare('centroCostoPrograma',$this->centroCostoPrograma);
		$criteria->compare('version',$this->version);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}