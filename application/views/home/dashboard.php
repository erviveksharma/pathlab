<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 06-11-2015
 * Time: 16:58
 */
?>
<div class="row">
    <!-- Patients Login -->
    <div class="col-md-8 col-md-offset-2">
        
        <?php if($this->session->flashdata('success')) : ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
              <?php endif; ?>

        <div class="panel panel-default">
            <div class="panel-heading"><?php echo $welcome_text; ?> <?php if(!empty($reports)): ?><span class="pull-right"><a href="<?php echo site_url('home/downloadpdf/'.time().'-'.str_replace(" ","-",$this->session->userdata['name'])); ?>"><i class="glyphicon glyphicon-download-alt"></i> Download Report</a> | <a href="<?php echo site_url("home/emailpdf"); ?>"><i class="glyphicon glyphicon-envelope"></i> Email Report</a></span><?php endif; ?></div>
               
               <table class="table table-bordered table-hover">
                   <thead>
                   <tr>
                       <th>Test Name</th>
                       <th>High Value</th>
                       <th>Low Value</th>
                       <th>Your Result</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php if(!empty($reports)): ?>

                       <?php foreach($reports as $report): ?>
                           <tr>
                               <td><?php echo $report['name']; ?></td>
                               <td><?php echo $report['high_value']; ?></td>
                               <td><?php echo $report['low_value']; ?></td>
                               <td><?php echo $report['test_result']; ?></td>
                           </tr>
                       <?php endforeach; ?>

                   <?php else: ?>
                       <tr>
                           <td colspan="4">No reports generated yet. Please check after some time.</td>
                       </tr>
                   <?php endif; ?>

                   </tbody>
               </table>
            </div>
        </div>
    </div>
</div>