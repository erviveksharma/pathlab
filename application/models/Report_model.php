<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 06-11-2015
 * Time: 08:53
 */

class Report_model extends CI_Model {

    /**
     * Get reports generated for patient.
     * @param $patient_id - patient id to generate report
     * @return mixed
     */
    public function get_reports($patient_id) {
        $this->db->from('reports');
        $this->db->join('tests', 'reports.test_id = tests.id', 'left');
        $this->db->where(array('reports.patient_id' => $patient_id));

        return $this->db->get()->result_array();
    }

    /**
     * This function will check if report data is posted for insert or update
     * and will insert or update as for data posted.
     * @param $data - to insert/update to database.
     */
    public function create_or_update_reports($data) {
        // first check if data exists in table using the provided  patient and test ID
        $data_exists_query = $this->db->get_where('reports', array(
            'patient_id' => $data['patient_id'],
            'test_id' => $data['test_id'],
        ));
        $data_exists = $data_exists_query->result();

        if(!empty($data_exists)) {
            // data already exists, so update table
            unset($data['created_at']);
            $this->db->update('reports', $data, array(
                'patient_id' => $data['patient_id'],
                'test_id' => $data['test_id'],
            ));
        } else {
            // data does not exists, so insert new data
            // if new value is empty then ignore.
            if($data['test_result'] != '') {
                $this->db->insert('reports', $data);
            }
        }
    }

}