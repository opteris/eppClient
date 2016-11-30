<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Reporting System">
    <meta name="keywords" content="Reporting,Human,Resource,Uganda,ORS">
    <meta name="author" content="Data Care, Asiimwe, Apollo,">
    <link rel="icon" href="<?= base_url() ?>assets/images/favicon.png">

    <link href="<?php echo base_url() ?>css/nta.css" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>css/slide.css" media="all" rel="stylesheet" type="text/css">
    <title>DC:ORS</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>assets/jquery.ui.1.9.2.theme/ui/1.9.2/themes/base/jquery-ui.css"
          type="text/html">
    <link href="<?php echo base_url() ?>assets/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" type="text/html">
    <link href="<?php echo base_url() ?>font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/login.css">


</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-12 well main-container">
            <div align="center" class="row h1-login-div">
                <h1><img src="<?php echo base_url() ?>assets/images/logo_header_main.png" width="100%" height="100%" alt="ORS-Login header"/></h1>
            </div>



            <div class="container">
                    <!--start of welcome text-->
                    <div class="col-sm-6 text-right welcome">
                        Flexible web-based project Management System,
                        ORS is a flexible web-based resource management tool for
                        business environments.
                        ORS's resources management capabilities enable organisations
                        to support their business processes in a simple, but
                        effective manner

                    </div>

                    <!--end of welcome text-->

                    <!--start login nav-->
                    <div class="col-sm-6 col-lg-6 login-container">
                        <?php
                        $attributes = array("class" => "navbar-form", "id" => "loginform", "name" => "loginform");
                        echo form_open("LoginController/index", $attributes); ?>
                        <div class="form-group">
                            <input class="form-control" id="txt_username" name="txt_username"
                                   placeholder="Username"
                                   type="text" value="<?php echo set_value('txt_username'); ?>"/>
                            <span class="text-danger"><?php echo form_error('txt_username'); ?></span>

                        </div>
                        <br/>
                        <div class="form-group">
                            <input class="form-control" id="txt_password" name="txt_password"
                                   placeholder="Password"
                                   type="password" value="<?php echo set_value('txt_password'); ?>"/>
                            <span class="text-danger"><?php echo form_error('txt_password'); ?></span>
                        </div><br/>

                        <input id="btn_login" name="btn_login" type="submit" class="btn btn-default"
                               value="Sign In"/>
                        <i class="fa fa-question-circle fa-2x"></i>
                        <?php echo form_close(); ?>
                        <?php echo $this->session->flashdata('msg'); ?>


                    </div>

                    <!--end login nav-->
            </div>

            <!--start of Footer-->
            <div align="center" class="row">
                <div class="col-xs-18 col-md-12">
                    <footer>
                        <div class="container">

                            <p>Developed By <a target="_blank" href="http://www.dcareug.com/" rel="author">Data Care (U)
                                    Ltd&trade;</a>&nbsp;&nbsp;  &copy;2006 - <?php echo date('Y'); ?>
                            </p>
                        </div>
                    </footer>
                </div>
            </div>
            <!--end of Footer-->

        </div>


    </div>
</div>


<div class="container">


</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url() ?>bootstrap-3.3.5/js/jquery-1.11.3.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url() ?>bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>js/slide.js"></script>
</body>
</html>