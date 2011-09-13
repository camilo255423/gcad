<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CCurso
 *
 * @author Camilo
 */
class CCurso {
    //put your code here
    public $asignatura;
    public $curso;
    public $cursoProfesor;
    public function CCurso($asignatura,$curso,$cursoProfesor)
    {
      $this->asignatura = $asignatura;
      $this->curso = $curso;
      $this->cursoProfesor = $cursoProfesor;

    }
}
?>
