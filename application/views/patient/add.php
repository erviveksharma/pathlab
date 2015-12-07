<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 05-11-2015
 * Time: 14:20
 */
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo $page_title; ?> <a class="pull-right" href="<?php echo site_url('patient/'); ?>">Back</a></div>
            <div class="panel-body">
                <?php if($this->session->flashdata('errors')) : ?>
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <?php echo $this->session->flashdata('errors'); ?>
                    </div>
                <?php endif; ?>
                <?php
                $attributes = array('class' => 'form-horizontal');
                echo form_open('patient/add', $attributes); ?>
                <div class="form-group">
                    <?php echo form_label("Name", "", array('class' => 'col-md-4 control-label')); ?>
                    <div class="col-md-6">
                        <?php
                        $data = array(
                            'class' => 'form-control',
                            'name' => 'name',
                            'id' => 'name',
                            'placeholder' => 'Enter Name',
                            'value' => set_value('name'),
                        );
                        echo form_input($data); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo form_label("Email", "", array('class' => 'col-md-4 control-label')); ?>
                    <div class="col-md-6">
                        <?php
                        $data = array(
                            'class' => 'form-control',
                            'name' => 'email',
                            'id' => 'email',
                            'placeholder' => 'Enter Email',
                        );
                        echo form_input($data, set_value('email')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo form_label("Phone", "", array('class' => 'col-md-4 control-label')); ?>
                    <div class="col-md-6">
                        <?php
                        $data = array(
                            'class' => 'form-control',
                            'name' => 'phone',
                            'id' => 'phone',
                            'placeholder' => 'Enter Phone',
                            'value' => set_value('phone'),
                        );
                        echo form_input($data); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo form_label("Address", "", array('class' => 'col-md-4 control-label')); ?>
                    <div class="col-md-6">
                        <?php
                        $data = array(
                            'class' => 'form-control',
                            'name' => 'address',
                            'id' => 'address',
                            'placeholder' => 'Enter Address',
                            'value' => set_value('address'),
                        );
                        echo form_textarea($data); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <?php
                        $data = array(
                            'class' => 'btn btn-primary',
                            'name' => 'submit',
                            'id' => 'submit',
                            'value' => 'Save',
                        );
                        echo form_submit($data); ?>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

