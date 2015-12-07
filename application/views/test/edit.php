<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 04-11-2015
 * Time: 19:15
 */
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo $page_title; ?> <a class="pull-right" href="<?php echo site_url('test/'); ?>">Back</a></div>
            <div class="panel-body">
                <?php if($this->session->flashdata('errors')) : ?>
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <?php echo $this->session->flashdata('errors'); ?>
                    </div>
                <?php endif; ?>
                <?php
                $attributes = array('class' => 'form-horizontal');
                echo form_open('test/update/'.$test->id, $attributes); ?>
                <div class="form-group">
                    <?php echo form_label("Test Name", "", array('class' => 'col-md-4 control-label')); ?>
                    <div class="col-md-6">
                        <?php
                        $data = array(
                            'class' => 'form-control',
                            'name' => 'name',
                            'id' => 'name',
                            'placeholder' => 'Enter Test Name',
                        );
                        echo form_input($data, $test->name); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo form_label("High Value", "", array('class' => 'col-md-4 control-label')); ?>
                    <div class="col-md-6">
                        <?php
                        $data = array(
                            'class' => 'form-control',
                            'name' => 'high_value',
                            'id' => 'high_value',
                            'placeholder' => 'Enter High Value',
                        );
                        echo form_input($data, $test->high_value); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo form_label("Low Value", "", array('class' => 'col-md-4 control-label')); ?>
                    <div class="col-md-6">
                        <?php
                        $data = array(
                            'class' => 'form-control',
                            'name' => 'low_value',
                            'id' => 'low_value',
                            'placeholder' => 'Enter Low Value',
                        );
                        echo form_input($data, $test->low_value); ?>
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

