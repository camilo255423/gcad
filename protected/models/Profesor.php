<?php

/**
 * This is the model class for table "profesor".
 *
 * The followings are the available columns in table 'profesor':
 * @property string $documentoProfesor
 * @property string $apellido1
 * @property string $apellido2
 * @property string $nombre1
 * @property string $nombre2
 * @property integer $centroCostoDepartamento
 * @property integer $codigoVinculacion
 * @property integer $codigoCategoria
 * @property integer $codigoDedicacion
 *
 * The followings are the available model relations:
 * @property Cursoprofesor[] $cursoprofesors
 * @property Departamento $centroCostoDepartamento0
 * @property Vinculacion $codigoVinculacion0
 * @property Categoria $codigoCategoria0
 * @property Dedicacion $codigoDedicacion0
 * @property Actividadextension[] $actividadextensions
 * @property Actividadgestion[] $actividadgestions
 * @property Proyectoinvestigacion[] $proyectoinvestigacions
 * @property Proyectoplandesarrollo[] $proyectoplandesarrollos
 * @property Situacionadministrativa[] $situacionadministrativas
 * @property Trabajogrado[] $trabajogrados
 */
class Profesor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Profesor the static model class
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
		return 'profesor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentoProfesor, apellido1, apellido2, nombre1, nombre2, centroCostoDepartamento, codigoVinculacion, codigoCategoria, codigoDedicacion', 'required'),
			array('centroCostoDepartamento, codigoVinculacion, codigoCategoria, codigoDedicacion', 'numerical', 'integerOnly'=>true),
			array('documentoProfesor', 'length', 'max'=>50),
			array('apellido1, apellido2, nombre1, nombre2', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('documentoProfesor, apellido1, apellido2, nombre1, nombre2, centroCostoDepartamento, codigoVinculacion, codigoCategoria, codigoDedicacion', 'safe', 'on'=>'search'),
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
			'rcursoprofesor' => array(self::HAS_MANY, 'CursoProfesor', 'documentoProfesor'),
			'rDepartamento' => array(self::BELONGS_TO, 'Departamento', 'centroCostoDepartamento'),
			'rVinculacion' => array(self::BELONGS_TO, 'Vinculacion', 'codigoVinculacion'),
			'rCategoria' => array(self::BELONGS_TO, 'Categoria', 'codigoCategoria'),
			'rDedicacion' => array(self::BELONGS_TO, 'Dedicacion', 'codigoDedicacion'),
			'actividadextensions' => array(self::MANY_MANY, 'Actividadextension', 'profesorextension(documentoProfesor, codigoActividadExtension)'),
			'actividadgestions' => array(self::MANY_MANY, 'Actividadgestion', 'profesorgestion(codigoProfesor, codigoActividadGestion)'),
			'proyectoinvestigacions' => array(self::MANY_MANY, 'Proyectoinvestigacion', 'profesorinvestigacion(documentoProfesor, codigoProyecto)'),
			'proyectoplandesarrollos' => array(self::MANY_MANY, 'Proyectoplandesarrollo', 'profesorproyectoplan(documentoProfesor, codigoProyecto)'),
			'situacionadministrativas' => array(self::MANY_MANY, 'Situacionadministrativa', 'profesorsituacionadministrativa(documentoProfesor, codigoSituacion)'),
			'trabajogrados' => array(self::HAS_MANY, 'Trabajogrado', 'documentoProfesor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentoProfesor' => 'Documento Profesor',
			'apellido1' => 'Apellido1',
			'apellido2' => 'Apellido2',
			'nombre1' => 'Nombre1',
			'nombre2' => 'Nombre2',
			'centroCostoDepartamento' => 'Centro Costo Departamento',
			'codigoVinculacion' => 'Codigo Vinculacion',
			'codigoCategoria' => 'Codigo Categoria',
			'codigoDedicacion' => 'Codigo Dedicacion',
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

		$criteria->compare('documentoProfesor',$this->documentoProfesor,true);
		$criteria->compare('apellido1',$this->apellido1,true);
		$criteria->compare('apellido2',$this->apellido2,true);
		$criteria->compare('nombre1',$this->nombre1,true);
		$criteria->compare('nombre2',$this->nombre2,true);
		$criteria->compare('centroCostoDepartamento',$this->centroCostoDepartamento);
		$criteria->compare('codigoVinculacion',$this->codigoVinculacion);
		$criteria->compare('codigoCategoria',$this->codigoCategoria);
		$criteria->compare('codigoDedicacion',$this->codigoDedicacion);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        public static function getListado()
        {
          $models = Profesor::model()->findAll();

             foreach($models as $model)
             {
        	$arr[] = array(
          	'label'=>$model->apellido1." ".$model->apellido2." ".$model->nombre1." ".$model->nombre2,  // label for dropdown list
          	'value'=>$model->apellido1." ".$model->apellido2." ".$model->nombre1." ".$model->nombre2,  // value for input field
          	'id'=>$model->documentoProfesor,            // return value from autocomplete
        	);

             }
          return $arr;
        }
      
}