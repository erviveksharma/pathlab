<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php

/**

 * Created by PhpStorm.

 * User: Monty

 * Date: 04-11-2015

 * Time: 18:48

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



<nav class="navbar navbar-inverse navbar-fixed-top">

    <div class="container">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                <span class="sr-only">Toggle navigation</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand" href="javascript:void(0);">Pathlab</a>

        </div>

        <div id="navbar" class="collapse navbar-collapse">

            <ul class="nav navbar-nav">

                <?php if($this->session->userdata['is_loggedin'] == "true"): // is user logged in ?>

                    <?php if($this->session->userdata['logged_in_as'] == "operator"): // user is logged in as operator ?>

                    <li class="<?php echo activate_menu('patient'); ?> <?php echo activate_menu('report'); ?>"><a href="<?php echo site_url("patient"); ?>">Manage Patients</a></li>

                    <li class="<?php echo activate_menu('test'); ?>"><a href="<?php echo site_url("test"); ?>">Manage Tests</a></li>

                    <?php else : // user is logged in as patient ?>

                        <li class="<?php echo activate_menu('home'); ?>"><a href="<?php echo site_url("home/dashboard"); ?>">Dashboard</a></li>

                    <?php endif; ?>

                    <li><a href="<?php echo site_url("home/logout"); ?>">Logout</a></li>

                <?php else : // user is not logged in ?>

                    <li class="<?php echo activate_menu('home'); ?>"><a href="<?php echo site_url("home"); ?>">Home</a></li>

                <?php endif; ?>

            </ul>

        </div><!--/.nav-collapse -->

    </div>

</nav>



<div class="container pathlab-container">