<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 06-11-2015
 * Time: 12:35
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if(empty($this->session->userdata['is_loggedin'])) {
            $this->session->set_userdata(array('is_loggedin' => 'false'));
        }

        $this->load->model('home_model');
        $this->load->model('report_model');
        $this->load->model('patient_model');
    }

    public function index() {
        if($this->input->post('login_patient')) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('passcode', 'Passcode', 'trim|required|min_length[3]');

            if($this->form_validation->run() == FALSE) {
                $data = array(
                    'patient_errors' => validation_errors()
                );

                $this->session->set_flashdata($data);
            } else {
                $name = $this->input->post('name');
                $passcode = $this->input->post('passcode');

                $patient_id = $this->home_model->login_patient($name, $passcode);

                if($patient_id) {
                    $patient = $this->patient_model->get_patient_by_id($patient_id);
                    $user_data = array(
                        'patient_id' => $patient_id,
                        'name' => $name,
                        'email' => $patient[0]->email,
                        'is_loggedin' => true,
                        'logged_in_as' => 'patient',
                    );

                    $this->session->set_userdata($user_data);
                    redirect('home/dashboard');
                } else {
                    $this->session->set_flashdata(array("patient_errors" => '<p>Name or passcode is invalid.</p>'));
                }

            }

        } else if($this->input->post('login_operator')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');

            if($this->form_validation->run() == FALSE) {
                $data = array(
                    'operator_errors' => validation_errors()
                );

                $this->session->set_flashdata($data);
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $operator_id = $this->home_model->login_operator($username, $password);

                if($operator_id) {
                    $user_data = array(
                        'patient_id' => $operator_id,
                        'username' => $username,
                        'is_loggedin' => true,
                        'logged_in_as' => 'operator',
                    );

                    $this->session->set_userdata($user_data);
                    redirect('test');
                } else {
                    $this->session->set_flashdata(array("operator_errors" => '<p>Username or password is invalid.</p>'));
                }

            }

        }

        // user is logged in
        if($this->session->userdata['is_loggedin'] == "true") {
            // check logged in as and redirect them
            if($this->session->userdata['logged_in_as'] == 'operator') {
                redirect('test');
            } else {
                redirect('home/dashboard');
            }
        }

        $data['page_title'] = 'Login';
        $this->load->view('templates/header', $data);
        $this->load->view('home/login', $data);
        $this->load->view('templates/footer');

    }


    public function dashboard() {

        // user is logged in
        if($this->session->userdata['is_loggedin'] == "true") {
            // check logged in as and redirect them
            if($this->session->userdata['logged_in_as'] == 'operator') {
                redirect('test');
            }
        }

        $data['reports'] = $this->report_model->get_reports($this->session->userdata['patient_id']);
        $data['page_title'] = "My Report";
        $data['welcome_text'] = "Welcome ". $this->session->userdata['name'];

        $this->load->view('templates/header', $data);
        $this->load->view('home/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function emailpdf() {

        $filename = time().'-'.str_replace(" ","-",$this->session->userdata['name']);

        // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
        $pdfFilePath = FCPATH."/downloads/reports/$filename.pdf";
        $data['page_title'] = 'Hello world'; // pass data to the view

        if (file_exists($pdfFilePath) == FALSE)
        {
            $data['reports'] = $this->report_model->get_reports($this->session->userdata['patient_id']);
            $data['page_title'] = "My Report";
            $data['welcome_text'] = "Welcome ". $this->session->userdata['name'];

            ini_set('memory_limit','32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
            $html = $this->load->view('home/pdf', $data, true); // render the view into HTML

            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
            $pdf->WriteHTML($html); // write the HTML into the PDF
            $pdf->Output($pdfFilePath, 'F'); // save to file because we can
        }

        // File Path
        $file = file_get_contents(base_url("/downloads/reports/$filename.pdf")); // Read the file's contents

        // Send generated file to attachement.
        $this->load->library('email');
        $subject = 'Welcome to Pathlab application. Please find your reports here.';
        $message = '<p>Dear user, <br><br> Please find your attached reports. <br><br> Thanks,<br>Pathlab Team</p>';

        // Get full html:
        $body =
            '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    
    <title>'.html_escape($subject).'</title>
    <style type="text/css">
        body {
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body>
'.$message.'
</body>
</html>';
        // Also, for getting full html you may use the following internal method:
        //$body = $this->email->full_html($subject, $message);

        $result = $this->email
            ->from('r2andme@gmail.com')
            ->reply_to('r2andme@gmail.com')    // Optional, an account where a human being reads.
            ->to($this->session->userdata['email'])
            ->subject($subject)
            ->message($body)
            ->attach($pdfFilePath)
            ->send();
            

        $this->session->set_flashdata('success', 'Report has been sent on '. $this->session->userdata['email']);
        redirect("/home/dashboard");
    }

    public function downloadpdf($filename) {
        // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
        $pdfFilePath = FCPATH."/downloads/reports/$filename.pdf";
        $data['page_title'] = 'Hello world'; // pass data to the view

        if (file_exists($pdfFilePath) == FALSE)
        {
            $data['reports'] = $this->report_model->get_reports($this->session->userdata['patient_id']);
            $data['page_title'] = "My Report";
            $data['welcome_text'] = "Welcome ". $this->session->userdata['name'];

            ini_set('memory_limit','32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
            $html = $this->load->view('home/pdf', $data, true); // render the view into HTML

            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
            $pdf->WriteHTML($html); // write the HTML into the PDF
            $pdf->Output($pdfFilePath, 'F'); // save to file because we can
        }

        // force to download file
        $file = file_get_contents(base_url("/downloads/reports/$filename.pdf")); // Read the file's contents
        force_download($filename.'.pdf', $file);

        redirect("/home/dashboard");
    }


    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_userdata(array('is_loggedin' => false));
        redirect('home');
    }

}