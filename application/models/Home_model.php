<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 06-11-2015
 * Time: 15:58
 */
class Home_model extends CI_Model {

    public function login_patient($name, $passcode) {
        $this->db->where(array(
            'name' => $name,
            'passcode' => $passcode,
        ));

        $result = $this->db->get('patients');

        if($result->num_rows() == 1) {
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

    public function login_operator($username, $password) {
        $this->db->where(array(
            'username' => $username,
            'password' => $password,
        ));

        $result = $this->db->get('operators');

        if($result->num_rows() == 1) {
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

}
