<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 06-11-2015
 * Time: 08:37
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // user is not logged in as operator, redirecting to home page
        if(empty($this->session->userdata['logged_in_as']) || $this->session->userdata['logged_in_as'] != 'operator') {
            redirect('home');
        }

        $this->load->model('report_model');
        $this->load->model('test_model');
        $this->load->model('patient_model');
    }

    /**
     * Load Listing view
     */
    public function view($patient_id) {
        $tests = $this->test_model->get_tests();
        $data['patient_reports'] = $this->report_model->get_reports($patient_id);
        $patient = $this->patient_model->get_patient_by_id($patient_id);
        $data['page_title'] = $patient[0]->name  .'\'s Report';
	$data['patient_id']=$patient_id;
        foreach($tests as $test) {
            foreach($data['patient_reports'] as $report) {

                if($report['test_id'] == $test->id) {
                    $test->test_result = $report['test_result'];
                    $test->report_id = $report['id'];
                }
            }

            $data['reports'][] = $test;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('report/list', $data);
        $this->load->view('templates/footer');
    }

    /**
     * save or update report to database
     * @param $patient_id -  patient id to report data update
     */
    public function create($patient_id) {

        $data = array();
        if (!array_filter($this->input->post('test_result'))) {
            $this->session->set_flashdata('errors', 'Please fill atleat one test result to save report.');
            redirect('report/view/'.$patient_id);
        } else {

            foreach($this->input->post('test_result') as $test_id => $test_result) {
                $data['patient_id'] = $patient_id;
                $data['test_id'] = $test_id;
                $data['test_result'] = $test_result;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');

                $this->report_model->create_or_update_reports($data);
            }

            $this->session->set_flashdata('success', 'Report has been saved successfully.');
            redirect('report/view/'.$patient_id);

        }
        

    }
}
