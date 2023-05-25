<?php

namespace Drupal\custom_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Code\Database\Database;


class CustomUserDetails extends FormBase {

    private $student_names = array();

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
            '#submit' => ['::display'],
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
    }

    public function display(array &$form, FormStateInterface $form_state){
        \Drupal::messenger()->addMessage("clicked");

    }
}