<?php

/**

 * Created by PhpStorm.

 * User: Monty

 * Date: 05-11-2015

 * Time: 14:46

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Patient extends CI_Controller {



    public function __construct() {

        parent::__construct();



        // user is not logged in as operator, redirecting to home page

        if(empty($this->session->userdata['logged_in_as']) || $this->session->userdata['logged_in_as'] != 'operator') {

            redirect('home');

        }

        $this->load->model('patient_model');

    }



    /**

     * Load Index / Listing view

     */

    public function index() {

        $data['patient'] = $this->patient_model->get_patients();

        $data['page_title'] = 'Manage Patients';



        $this->load->view('templates/header', $data);

        $this->load->view('patient/list', $data);

        $this->load->view('templates/footer');

    }



    /**

     * Load Add Patient View

     */

    public function add() {



        // Validating and saving data

        if($this->input->post()) {

            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[100]');

            //$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique["patients"."email"]');

            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]|max_length[10]');

            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');



            if($this->form_validation->run() == FALSE) {

                $data = array(

                    'errors' => validation_errors()

                );



                $this->session->set_flashdata($data);

            } else {



                // generate random 6 digit passcode

                $passcode = rand(111111, 999999);



                $data = array(

                    'name' => $this->input->post('name'),

                    'email' => $this->input->post('email'),

                    'phone' => $this->input->post('phone'),

                    'address' => $this->input->post('address'),

                    'passcode' => $passcode,

                    'created_at' => date('Y-m-d H:i:s'),

                    'updated_at' => date('Y-m-d H:i:s'),

                );



                if($this->patient_model->create_patient($data)) {

                    $this->session->set_flashdata('success', 'Patient has been added successfully.');

                    redirect('patient/index');

                }



            }

        }





        // Loading View

        $data['page_title'] = 'Add New Patient';

        $this->load->view('templates/header', $data);

        $this->load->view('patient/add', $data);

        $this->load->view('templates/footer');

    }



    /**

     * Load Edit Patient view

     * @param $id - to update patient

     */

    public function edit($id) {

        $data['page_title'] = 'Update Patient';

        $patient = $this->patient_model->get_patient_by_id($id);

        $data['patient'] = $patient[0];



        $this->load->view('templates/header', $data);

        $this->load->view('patient/edit', $data);

        $this->load->view('templates/footer');

    }



    /**

     * Update patient to database

     * @param $id - to update

     */

    public function update($id) {

        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[100]');

        //$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        $this->form_validation->set_rules('passcode', 'Passcode', 'trim|required|min_length[6]|max_length[6]');

        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]|max_length[10]');

        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');



        if($this->form_validation->run() == FALSE) {

            $data = array(

                'errors' => validation_errors()

            );



            $this->session->set_flashdata($data);

            redirect('patient/edit/'.$id);

        } else {



            $data = array(

                'name' => $this->input->post('name'),

                'passcode' => $this->input->post('passcode'),

                'phone' => $this->input->post('phone'),

                'address' => $this->input->post('address'),

                'updated_at' => date('Y-m-d H:i:s'),

            );



            if($this->patient_model->update_patient($data, $id)) {

                $this->session->set_flashdata('success', 'Patient has been updated successfully.');

                redirect('patient/index');

            }



        }

    }



    /**

     * Delete patient from database

     * @param $id - patient id to delete

     */

    public function delete($id) {



        if($this->patient_model->delete_patient($id)) {

            $this->session->set_flashdata('success', 'Patient has been deleted successfully.');

            redirect('patient/index');

        }



    }

}

