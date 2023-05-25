<?php
namespace Drupal\students\Controller;
class StudentController {
    public function message(){
        return [
            '#markup' =>'Hello world from custom module'
        ];
    }
    
}
?>