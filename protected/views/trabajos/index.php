<div id="PlanDeTrabajo">
<?php $documento = $this->documentoProfesor;   ?>

<div id="InformacionGeneral">
      <?php $model = Profesor::model()->with('rDepartamento','rVinculacion','rCategoria','rDedicacion')->findByPk($this->documentoProfesor);?>
      <?php $this->renderPartial('//informacionDocente/index',array('model'=>$model));?>
</div>
      <?php $this->renderPartial('planTrabajo');?>
</div>