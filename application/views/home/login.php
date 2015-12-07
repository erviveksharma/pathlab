<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 06-11-2015
 * Time: 12:48
 */
?>
<div class="row">
    <!-- Patients Login -->
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Patient Login</div>
            <div class="panel-body">
                <?php if($this->session->flashdata('patient_errors')) : ?>
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <?php echo $this->session->flashdata('patient_errors'); ?>
                    </div>
                <?php endif; ?>
                <?php
                $attributes = array('class' => 'form-horizontal');
                echo form_open('home', $attributes); ?>
                <div class="form-group">
                    <?php echo form_label("Name", "", array('class' => 'col-md-4 control-label')); ?>
                    <div class="col-md-6">
                        <?php
                        $username_array = array(
                            'class' => 'form-control',
                            'name' => 'name',
                            'id' => 'name',
                            'placeholder' => 'Enter name',
                        );
                        echo form_input($username_array); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo form_label("Passcode", "", array('class' => 'col-md-4 control-label')); ?>
                    <div class="col-md-6">
                        <?php
                        $password_array = array(
                            'class' => 'form-control',
                            'name' => 'passcode',
                            'id' => 'passcode',
                            'placeholder' => 'Enter passcode',
                        );
                        echo form_password($password_array); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <?php
                        $submit_array = array(
                            'class' => 'btn btn-primary',
                            'name' => 'login_patient',
                            'id' => 'login_patient',
                            'value' => 'Login',
                        );
                        echo form_submit($submit_array); ?>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Operators Login -->
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Operators Login</div>
            <div class="panel-body">
                <?php if($this->session->flashdata('operator_errors')) : ?>
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <?php echo $this->session->flashdata('operator_errors'); ?>
                    </div>
                <?php endif; ?>
                <?php
                $attributes = array('class' => 'form-horizontal');
                echo form_open('home', $attributes); ?>
                <div class="form-group">
                    <?php echo form_label("Username", "", array('class' => 'col-md-4 control-label')); ?>
                    <div class="col-md-6">
                        <?php
                        $username_array = array(
                            'class' => 'form-control',
                            'name' => 'username',
                            'id' => 'username',
                            'placeholder' => 'Enter Username',
                        );
                        echo form_input($username_array); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo form_label("Password", "", array('class' => 'col-md-4 control-label')); ?>
                    <div class="col-md-6">
                        <?php
                        $password_array = array(
                            'class' => 'form-control',
                            'name' => 'password',
                            'id' => 'password',
                            'placeholder' => 'Enter Password',
                        );
                        echo form_password($password_array); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <?php
                        $submit_array = array(
                            'class' => 'btn btn-primary',
                            'name' => 'login_operator',
                            'id' => 'login_operator',
                            'value' => 'Login',
                        );
                        echo form_submit($submit_array); ?>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>