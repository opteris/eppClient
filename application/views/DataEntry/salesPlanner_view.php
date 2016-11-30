<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>Weekly Sales Call Sheet Planner</span></li>
        </ol>
    </div>

    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_plannerForm", "name" => "filter_plannerForm");
    echo form_open("DataEntryController/dailySalesCallSheetActuals", $attributes); ?>


    <div class="col-sm-12" align="right">
        <input id="addActivity" name="addActivity" type="submit" class="btn btn-info" value="Click to enter Daily Actuals"
               onclick="location.href='<?= base_url('DataEntryController/dailySalesCallSheetActuals') ?>'"/>

    </div>





    <?= form_close(); ?>

    <?php
    if ($this->session->flashdata('msg') != ''):
        echo $this->session->flashdata('msg');
    endif; ?>

    <!--<div class="col-sm-12 alert-info">Click on particular day of the week to insert an item to the weekly planner.</div>
    <div class="col-sm-12 table-responsive">
        <?php /*echo $calendar; */?>
    </div>-->

    <div class="container">
        <ul class="nav nav-justified">
            <li><a class="text-center" href="#"><i class="fa fa-tag fa-5x"></i> <br>Tags</a></li>
            <li><a class="text-center" href="#"><i class="fa fa-bookmark fa-5x"></i> <br>Tasks</a></li>
            <li><a class="text-center" href="#"><i class="fa fa-camera fa-5x"></i> <br>Photos</a></li>
            <li><a class="text-center" href="#"><i class="fa fa-map-marker fa-5x"></i> <br>Tour</a></li>
            <li><a class="text-center" href="#"><i class="fa fa-music fa-5x"></i> <br>Tunes</a></li>
            <li><a class="text-center" href="#"><i class="fa fa-book fa-5x"></i> <br>Books</a></li>
            <li><a class="text-center" href="#"><i class="fa fa-film fa-5x"></i> <br>Videos</a></li>
        </ul>
    </div>

    <div class="container">
        <hr>
        <div id="calendar"></div>
    </div>

</div>