<?php

/**

 * Created by PhpStorm.

 * User: Monty

 * Date: 04-11-2015

 * Time: 19:09

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Test extends CI_Controller {



    public function __construct() {

        parent::__construct();



        // user is not logged in as operator, redirecting to home page

        if(empty($this->session->userdata['logged_in_as']) || $this->session->userdata['logged_in_as'] != 'operator') {

            redirect('home');

        }



        $this->load->model('test_model');

    }



    /**

     * Load Index / Listing view

     */

    public function index() {

        $data['test'] = $this->test_model->get_tests();

        $data['page_title'] = 'Manage Tests';

        $this->load->view('templates/header', $data);

        $this->load->view('test/list', $data);

        $this->load->view('templates/footer');

    }



    /**

     * Load Add Test View

     */

    public function add() {



        // Validating and saving data

        if($this->input->post()) {

            $this->form_validation->set_rules('name', 'Test Name', 'trim|required|min_length[3]|max_length[200]');

            $this->form_validation->set_rules('high_value', 'High Value', 'trim|required|max_length[4]');

            $this->form_validation->set_rules('low_value', 'Low Value', 'trim|required|max_length[4]');



            if($this->form_validation->run() == FALSE) {

                $data = array(

                    'errors' => validation_errors()

                );



                $this->session->set_flashdata($data);

            } else {



                $data = array(

                    'name' => $this->input->post('name'),

                    'high_value' => $this->input->post('high_value'),

                    'low_value' => $this->input->post('low_value'),

                    'created_at' => date('Y-m-d H:i:s'),

                    'updated_at' => date('Y-m-d H:i:s'),

                );



                if($this->test_model->create_test($data)) {

                    $this->session->set_flashdata('success', 'Test has been added successfully.');

                    redirect('test/index');

                }



            }

        }





        // Loading view

        $data['page_title'] = 'Add New Test';

        $this->load->view('templates/header', $data);

        $this->load->view('test/add', $data);

        $this->load->view('templates/footer');

    }



    /**

     * Save Test to database

     */

    public function create() {



    }



    /**

     * Load Edit test view

     * @param $id - to update test

     */

    public function edit($id) {

        $data['page_title'] = 'Update Test';

        $test = $this->test_model->get_test_by_id($id);

        $data['test'] = $test[0];



        $this->load->view('templates/header', $data);

        $this->load->view('test/edit', $data);

        $this->load->view('templates/footer');

    }



    /**

     * Update test to database

     * @param $id - to update

     */

    public function update($id) {

        $this->form_validation->set_rules('name', 'Test Name', 'trim|required|min_length[3]|max_length[200]');

        $this->form_validation->set_rules('high_value', 'High Value', 'trim|required|max_length[4]');

        $this->form_validation->set_rules('low_value', 'Low Value', 'trim|required|max_length[4]');



        if($this->form_validation->run() == FALSE) {

            $data = array(

                'errors' => validation_errors()

            );



            $this->session->set_flashdata($data);

            redirect('test/edit/'.$id);

        } else {



            $data = array(

                'name' => $this->input->post('name'),

                'high_value' => $this->input->post('high_value'),

                'low_value' => $this->input->post('low_value'),

                'updated_at' => date('Y-m-d H:i:s'),

            );



            if($this->test_model->update_test($data, $id)) {

                $this->session->set_flashdata('success', 'Test has been updated successfully.');

                redirect('test/index');

            }



        }

    }



    /**

     * Delete test from database

     * @param $id - test id to delete

     */

    public function delete($id) {



        if($this->test_model->delete_test($id)) {

            $this->session->set_flashdata('success', 'Test has been deleted successfully.');

            redirect('test/index');

        }



    }

}

