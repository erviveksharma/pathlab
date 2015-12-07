<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 06-11-2015
 * Time: 08:43
 */
?>
<h2><?php echo $page_title; ?></h2>

<?php if($this->session->flashdata('success')) : ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('errors')) : ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $this->session->flashdata('errors'); ?>
    </div>
<?php endif; ?>

<?php if($reports): ?>
<form action="<?php echo site_url('report/create/'.$patient_id); ?>" method="post">
    <table class="table table-striped table-bordered" id="test_table">
    <thead>
        <tr>
            <th>Test Name</th>
            <th>High Value</th>
            <th>Low Value</th>
            <th>Test Value</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($reports as $report): ?>
        <tr>
            <td><?php echo $report->name; ?></td>
            <td><?php echo $report->high_value; ?></td>
            <td><?php echo $report->low_value; ?></td>
            <?php
            $test_result = '';
            if(!empty($report->test_result)) $test_result = $report->test_result; ?>
            <td><input type="text" name="<?php echo 'test_result['.$report->id.']'; ?>" id="test_results_<?php echo $report->id; ?>" value="<?php echo $test_result; ?>"></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    <br/><br/>
    <div class="pull-right">
        <input type="submit" name="submit" id="submit" value="Save" class="btn btn-primary" />
        <a href="<?php echo site_url('patient'); ?>" class="btn btn-default">Back</a>
    </div>
    <br/><br/>
</form>
<?php else: ?>
    <h5>No reports added yet.</h5>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function(){
    $('#test_table').DataTable();
});
</script>