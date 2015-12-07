<?php
/**
 * Created by PhpStorm.
 * User: Monty
 * Date: 06-11-2015
 * Time: 19:24
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url("assets/favicon.ico"); ?>">

    <title><?php echo $page_title; ?></title>

    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/jquery.dataTables.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/style.css"); ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <!-- Patients Login -->
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Report</div>
                <div class="panel-body">
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
</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.dataTables.min.js"); ?>"></script>
</body>
</html>