<?php

/**
 * This is the model class for table "proyectoinvestigacion".
 *
 * The followings are the available columns in table 'proyectoinvestigacion':
 * @property string $codigoProyecto
 * @property string $titulo
 * @property integer $noActa
 * @property string $fechaActa
 * @property integer $centroCosto
 *
 * The followings are the available model relations:
 * @property Profesor[] $profesors
 */
class ProyectoInvestigacion extends Trabajo
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProyectoInvestigacion the static model class
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
		return 'proyectoinvestigacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigoProyecto, titulo, noActa, fechaActa, centroCosto', 'required'),
			array('noActa, centroCosto', 'numerical', 'integerOnly'=>true),
			array('codigoProyecto', 'length', 'max'=>50),
			array('titulo', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigoProyecto, titulo, noActa, fechaActa, centroCosto', 'safe', 'on'=>'search'),
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
			'profesors' => array(self::MANY_MANY, 'Profesor', 'profesorinvestigacion(codigoProyecto, documentoProfesor)'),
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
			'centroCosto' => 'Centro Costo',
		);
	}

	public function crearNuevo()
        {

        return new ProyectoInvestigacion;
        }
        public function getIdName()
        {
            return "codigoProyecto";
        }
}