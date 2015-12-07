<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 04-11-2015
 * Time: 19:15
 */
?>
<h2><?php echo $page_title; ?></h2>
<a class="btn btn-primary pull-right" href="<?php echo site_url('test/add'); ?>">Add New Test</a>
<br/>
<br/>

<?php if($this->session->flashdata('success')) : ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if($test): ?>
<table class="table table-striped table-bordered" id="test_table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Test Name</th>
            <th>High Value</th>
            <th>Low Value</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($test as $test_item): ?>
        <tr>
            <td><?php echo $test_item->id; ?></td>
            <td><?php echo $test_item->name; ?></td>
            <td><?php echo $test_item->high_value; ?></td>
            <td><?php echo $test_item->low_value; ?></td>
            <td><a href="<?php echo site_url('test/edit/'.$test_item->id); ?>">Edit</a> | <a href="<?php echo site_url('test/delete/'.$test_item->id); ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <h5>No tests added yet.</h5>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function(){
    $('#test_table').DataTable();
});
</script>