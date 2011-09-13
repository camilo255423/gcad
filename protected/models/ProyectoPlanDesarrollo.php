<?php

/**
 * This is the model class for table "proyectoplandesarrollo".
 *
 * The followings are the available columns in table 'proyectoplandesarrollo':
 * @property string $codigoProyecto
 * @property string $titulo
 * @property integer $noActa
 * @property string $fechaActa
 * @property integer $centroCostoPrograma
 *
 * The followings are the available model relations:
 * @property Profesor[] $profesors
 * @property Programa $centroCostoPrograma0
 */
class ProyectoPlanDesarrollo extends Trabajo
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProyectoPlanDesarrollo the static model class
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
		return 'proyectoplandesarrollo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigoProyecto, titulo, noActa, fechaActa, centroCostoPrograma', 'required'),
			array('noActa, centroCostoPrograma', 'numerical', 'integerOnly'=>true),
			array('codigoProyecto', 'length', 'max'=>50),
			array('titulo', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigoProyecto, titulo, noActa, fechaActa, centroCostoPrograma', 'safe', 'on'=>'search'),
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
			'profesors' => array(self::MANY_MANY, 'Profesor', 'profesorproyectoplan(codigoProyecto, documentoProfesor)'),
			'centroCostoPrograma0' => array(self::BELONGS_TO, 'Programa', 'centroCostoPrograma'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigoProyecto' => 'Codigo Proyecto',
			'titulo' => 'Titulo',
			'noActa' => 'No Acta',
			'fechaActa' => 'Fecha Acta',
			'centroCostoPrograma' => 'Centro Costo Programa',
		);
	}

        public function crearNuevo()
        {

        return new ProyectoPlanDesarrollo();
        }
        public function getIdName()
        {
            return "codigoProyecto";
        }
}