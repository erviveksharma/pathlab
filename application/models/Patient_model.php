<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 05-11-2015
 * Time: 14:48
 */

class Patient_model extends CI_Model {

    /**
     * Get All Patients
     * @return mixed
     */
    public function get_patients() {
        $query = $this->db->get('patients');

        return $query->result();
    }

    /**
     * Get patient by ID
     * @param $id - to get patient
     * @return mixed
     */
    public function get_patient_by_id($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('patients');

        return $query->result();
    }

    /**
     * Save patient to database
     * @param $data - data to insert into database
     * @return mixed
     */
    public function create_patient($data) {
        $insert_query = $this->db->insert('patients', $data);

        return $insert_query;
    }

    /**
     * Update data to database
     * @param $data - to update
     * @param $id - where data should be updated
     * @return mixed
     */
    public function update_patient($data, $id) {
        $this->db->where(array('id' => $id));
        $update_query = $this->db->update('patients', $data);

        return $update_query;
    }

    /**
     * Delete data from database
     * @param $id -  which data should be deleted
     * @return mixed
     */
    public function delete_patient($id) {
        $this->db->where(array('id' => $id));
        $delete_query = $this->db->delete('patients');

        return $delete_query;
    }
}