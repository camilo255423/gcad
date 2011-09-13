<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of actividadesGestion
 *
 * @author Camilo
 */
class ActividadesGestion {
    //put your code here
    protected  $models;
    protected $documentoProfesor;
    function ActividadesGestion($documento)
    {
        $this->documentoProfesor = $documento;
       $this->models=$this->loadAll();
    }
    function getModels()
    {
        return $this->models;
    }
    function guardar($post)
    {
        $n=count($post);

        for($w=0;$w<$n;$w++)
        {
          
            if($post[$w]["horas"]>0)
            {
            $this->models[$w]->profesor->horas=$post[$w]["horas"];

            $this->models[$w]->profesor->save();
            }
            else
            {
                if(!($this->models[$w]->profesor->getIsNewRecord()))
                {
                    $this->models[$w]->profesor->delete();
                }
            }

        }
        
    }
    function loadAll()
    {
        $documento = $this->documentoProfesor;
          $actividades=ActividadGestion::model()->findAll();
  
          foreach($actividades as $actividad)
          {
           
        
              $actividad->profesor=ProfesorGestion::model()->findByAttributes(array("codigoActividadGestion"=>$actividad->codigoActividadGestion,"documentoProfesor"=>$documento));
              if($actividad->profesor==null)
              {
                      $actividad->profesor= new ProfesorGestion ();
                      $actividad->profesor->codigoActividadGestion=$actividad->codigoActividadGestion;
                      $actividad->profesor->documentoProfesor=$this->documentoProfesor;
                      $actividad->profesor->centroCostoPrograma=80403;
              }
          }
          return $actividades;
    }
    function validation($post)
    {
        $valido=true;
        $n=count($post);

        for($w=0;$w<$n;$w++)
        {

           
            $this->models[$w]->profesor->horas=$post[$w]["horas"];
            $valido= $valido  & $this->models[$w]->profesor->validate(array("horas"));


        }
        return $valido;

    }
}
?>
