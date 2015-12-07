<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 05-11-2015
 * Time: 09:37
 */

class Test_model extends CI_Model {

    /**
     * Get All Tests
     * @return mixed
     */
    public function get_tests() {
        $query = $this->db->get('tests');

        return $query->result();
    }

    /**
     * Get Test by ID
     * @param $id - to get test
     * @return mixed
     */
    public function get_test_by_id($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('tests');

        return $query->result();
    }

    /**
     * Save test to database
     * @param $data - data to insert into database
     * @return mixed
     */
    public function create_test($data) {
        $insert_query = $this->db->insert('tests', $data);

        return $insert_query;
    }

    /**
     * Update data to database
     * @param $data - to update
     * @param $id - where data should be updated
     * @return mixed
     */
    public function update_test($data, $id) {
        $this->db->where(array('id' => $id));
        $update_query = $this->db->update('tests', $data);

        return $update_query;
    }

    /**
     * Delete data from database
     * @param $id -  which data should be deleted
     * @return mixed
     */
    public function delete_test($id) {
        $this->db->where(array('id' => $id));
        $delete_query = $this->db->delete('tests');

        return $delete_query;
    }
}