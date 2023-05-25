<?php

namespace Drupal\custom_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;


class CustomUserDetails extends FormBase {

    private $student_names = array();

    // for database
    public function createConnection(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sms";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } else {
          return $conn;
        }
        }

    public function getFormId() {
        return "custom_user_details_form";
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['#attached']['library'][] = "custom_form/customjsform";
        $form['name'] = [
            '#type' => 'textfield',
            '#title' => 'student Name',
            '#required' => true,
        ];
        $form['attendance'] = [
            '#type' => 'select',
            '#title' => 'Attendance',
            '#options' => [
                'present' => 'Present',
                'absent' => 'Absent'
            ],
        ];
        $form['show_button'] = [
            '#type' => 'submit',
            '#value' => 'Show Details',
            '#submit' => ['::show_dets'],
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => 'Add',
        ];


        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        \Drupal::messenger()->addMessage("User Details Submitted Successfully");
        array_push($this->student_names, $form_state->getValue('name'));
        \Drupal::messenger()->addMessage($this->student_names[0]);

        // TODO: save to db
        $conn = createConnection();
        $sql = "INSERT into ";
        $result = $conn->query($sql);
    }

    public function show_dets(array &$form, FormStateInterface $form_state){
        \Drupal::messenger()->addMessage("clicked");
        $form['show_button']['#suffix']='<p>Clicked the button now</p>';

    }
    public function show_report(array &$form, FormStateInterface $form_state){

    }
}