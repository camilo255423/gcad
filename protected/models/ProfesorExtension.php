<?php

/**
 * This is the model class for table "profesorextension".
 *
 * The followings are the available columns in table 'profesorextension':
 * @property string $documentoProfesor
 * @property string $codigoActividadExtension
 * @property integer $horas
 */
class ProfesorExtension extends Proyecto
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProfesorExtension the static model class
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
		return 'profesorextension';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentoProfesor, codigoActividadExtension, horas', 'required'),
			array('horas', 'numerical', 'integerOnly'=>true),
			array('documentoProfesor, codigoActividadExtension', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('documentoProfesor, codigoActividadExtension, horas', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentoProfesor' => 'Documento Profesor',
			'codigoActividadExtension' => 'Codigo Actividad Extension',
			'horas' => 'Horas',
		);
	}

	public function  getIdName() {
        return "codigoActividadExtension";
        }
        public function crearNuevo()
        {
            return new ProfesorExtension();
        }
        public function  cargarDatos($post) {

         $this->horas = $post["horas"];
    
        }
}