<?php

/**
 * This is the model class for table "curso".
 *
 * The followings are the available columns in table 'curso':
 * @property integer $codigoAsignatura
 * @property integer $grupo
 * @property integer $centroCostoPrograma
 *
 * The followings are the available model relations:
 * @property Programa[] $programas
 * @property Asignatura $codigoAsignatura0
 * @property Programa $centroCostoPrograma0
 * @property Cursoprofesor[] $cursoprofesors
 * @property Horarios[] $horarioses
 */
class Curso extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Curso the static model class
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
		return 'curso';
	}
	

	/**
	 * @return array validation rules for model attributes.
	 */
	 
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigoAsignatura, grupo, centroCostoPrograma', 'required'),
			array('codigoAsignatura, grupo, centroCostoPrograma', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigoAsignatura, grupo, centroCostoPrograma', 'safe', 'on'=>'search'),
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
			'programas' => array(self::MANY_MANY, 'Programa', 'asignaturaprograma(codigoAsignatura, centroCostoPrograma)'),
			'rasignatura' => array(self::BELONGS_TO, 'Asignatura', 'codigoAsignatura'),
			'rprograma' => array(self::BELONGS_TO, 'Programa', 'centroCostoPrograma'),
			'rcursoprofesor' => array(self::HAS_MANY, 'Cursoprofesor', 'codigoAsignatura'),
			'horarioses' => array(self::HAS_MANY, 'Horarios', 'codigoAsignatura'),
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
			'centroCostoPrograma' => 'Centro Costo Programa',
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
		$criteria->compare('centroCostoPrograma',$this->centroCostoPrograma);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	/**
	* Determina si un curzo est� cruzado en horarios con otro
	*/
	public function isCruzado($otro)
	{
	
	$horarios=Horarios::model()->findAllByAttributes(array('codigoAsignatura'=>$this->codigoAsignatura,'grupo'=>$this->grupo));
	$horarios2=Horarios::model()->findAllByAttributes(array('codigoAsignatura'=>$otro->codigoAsignatura,'grupo'=>$otro->grupo));
	
	 foreach($horarios as $horario)
	 {
	      foreach($horarios2 as $horario2)
		 {
	       if($horario['dia']==$horario2['dia'] && $horario['hora']==$horario2['hora'])
		   return true;
		 }
	 }
	 
     return false;
	}
	
	/**
	* Retorna los horarios del curso
	*
	**/
	public function getHorarios()
	{
	  
	$horas=array();
	$horasF=array();
	
	$horarios=Horarios::model()->findAllByAttributes(array('codigoAsignatura'=>$this->codigoAsignatura,'grupo'=>$this->grupo));
	if(count($horarios)>0)
	{
	 	foreach ($horarios as $h)
		{
		
		    if(!isset($horas[$h['dia']]))
			{
               
               $horas[$h['dia']]=$h['hora'];
			   
			}
			else
			{
				if($h['hora']<$horas[$h['dia']])
				{
					$horas[$h['dia']]=$h['hora'];
				}
			}
			 
			  if(!isset($horasF[$h['dia']]))
			{
               
               $horasF[$h['dia']]=$h['hora'];
			   
			}
			else
			{
				if($h['hora']>$horas[$h['dia']])
				{
					$horasF[$h['dia']]=$h['hora'];
				}
			}
		}
		
		$dias=array_keys($horas);
		foreach($dias as $dia)
		{
		  $horas[$dia]=$horas[$dia]."-".($horasF[$dia]+1);
		}
	
	}
	  return($horas);
	
	}
	
	public function toString()
	{
	   return $this->codigoAsignatura."-".$this->grupo;
	}
	
}