<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 05-11-2015
 * Time: 14:33
 */
?>
<h2><?php echo $page_title; ?></h2>
<a class="btn btn-primary pull-right" href="<?php echo site_url('patient/add'); ?>">Add New Patient</a>
<br/>
<br/>

<?php if($this->session->flashdata('success')) : ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if($patient): ?>
<table class="table table-striped table-bordered" id="patient_table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Joined Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($patient as $patient_item): ?>
        <tr>
            <td><?php echo $patient_item->id; ?></td>
            <td><?php echo $patient_item->name; ?></td>
            <td><?php echo $patient_item->email; ?></td>
            <td><?php echo $patient_item->phone; ?></td>
            <td><?php echo $patient_item->address; ?></td>
            <td><?php echo date('d/m/Y', strtotime($patient_item->created_at)); ?></td>
            <td><a href="<?php echo site_url('report/view/'.$patient_item->id); ?>">Report</a> | <a href="<?php echo site_url('patient/edit/'.$patient_item->id); ?>">Edit</a> | <a href="<?php echo site_url('patient/delete/'.$patient_item->id); ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <h5>No patient added yet.</h5>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function(){
    $('#patient_table').DataTable();
});
</script>