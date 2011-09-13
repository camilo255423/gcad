<?php

/**
 * This is the model class for table "profesorproyectoplan".
 *
 * The followings are the available columns in table 'profesorproyectoplan':
 * @property string $documentoProfesor
 * @property string $codigoProyecto
 *
 * The followings are the available model relations:
 * @property Horariosproyectosplandesarrollo[] $horariosproyectosplandesarrollos
 */
class ProfesorProyectoPlan extends Proyecto
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProfesorProyectoPlan the static model class
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
		return 'profesorproyectoplan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentoProfesor, codigoProyecto', 'required'),
			array('documentoProfesor, codigoProyecto', 'length', 'max'=>50),
                    	array('horas', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('documentoProfesor, codigoProyecto', 'safe', 'on'=>'search'),
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
			'horariosproyectosplandesarrollos' => array(self::HAS_MANY, 'Horariosproyectosplandesarrollo', 'codigoProyecto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentoProfesor' => 'Documento Profesor',
			'codigoProyecto' => 'Codigo Proyecto',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
        public function  getIdName() {
        return "codigoProyecto";
        }
        public function crearNuevo()
        {
            return new ProfesorProyectoPlan();
        }
        public function  cargarDatos($post) {
         $this->horas = $post["horas"];
  
        }
}