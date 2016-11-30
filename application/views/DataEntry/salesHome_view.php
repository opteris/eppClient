<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li>
                <a href="#"><?= $date = (empty($days[substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1)]) or ($days[substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1)]) == '') ? 'Weekly' : $days[substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1)]; ?></a>
            </li>
            <li class="active"><span>Sales Home</span></li>

        </ol>
    </div>

    <?php
    if ($this->session->flashdata('msg') != ''):
        echo $this->session->flashdata('msg');
    endif; ?>

    <div class="container">
        <div class="row">


            <a href="#suspectModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">Log Sales Data</a>


            <!-- Modal HTML -->

            <div id="suspectModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="suspectModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-lg">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                            <h4 id="suspectModalLabel" class="modal-title">Log Sales Data</h4>

                        </div>

                        <div class="modal-body" id="suspectModalContent">

                            <?php
                            $attributes = array("class" => "form-horizontal", "id" => "form_suspect", "name" => "form_suspect");
                            echo form_open("DataEntryController/addDailySalesSheet", $attributes); ?>
                            <div class="col-sm-6 well">
                                <!--<legend>Log Sales Data</legend>-->

                                <fieldset>
                                    <div class="form-group">
                                        <div class="row colbox">

                                            <div class="col-sm-4"><label for="date">First Sales Prospect Call
                                                    Date:</label>
                                            </div>


                                            <div class="col-sm-8 input-group date"
                                                 data-provide="datepicker"
                                                 align="right">
                                                <input id="activity_date" name="activity_date"
                                                       placeholder="Date"
                                                       type="text"
                                                       class="form-control"
                                                       value="<?= set_value('activity_date'); ?>"/>
                                                <div class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">

                                            <div class="col-sm-4"><label for="first_contact">First Prospect contact
                                                    details:</label></div>
                                            <div class="col-sm-8">
                                <textarea name="first_contact" id="first_contact" cols="45" rows="5"
                                          class="form-control"
                                          placeholder="Contact Details..."><?= set_value('first_contact'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">

                                            <div class="col-sm-4"><label for="company_name">Name Of Prospect
                                                    Company/Org:</label>
                                            </div>
                                            <div class="col-sm-8">

                                <textarea name="company_name" id="company_name" cols="45" rows="5" class="form-control"
                                          placeholder="Name Of Company"><?= set_value('company_name'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">

                                            <div class="col-sm-4"><label for="client_location">Location Of Prospect
                                                    Company/Org:</label>
                                            </div>
                                            <div class="col-sm-8">

                                <textarea name="client_location" id="client_location" cols="45" rows="5"
                                          class="form-control"
                                          placeholder="Client Location"><?= set_value('client_location'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">
                                            <div class="col-lg-4 col-sm-4">
                                                <label for="prospectType" class="control-label">Prospect Company/Org
                                                    Type:</label>
                                            </div>
                                            <div class="col-lg-8 col-sm-8">

                                                <?php
                                                $attributes = 'class = "form-control" id = "prospectType"';
                                                echo form_dropdown('prospectType', $prospect_type, set_value('prospectType'), $attributes); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">
                                            <div class="col-lg-4 col-sm-4">
                                                <label for="sectorType" class="control-label">Prospect Company/Org
                                                    Sector:</label>
                                            </div>
                                            <div class="col-lg-8 col-sm-8">
                                                <?php
                                                $attributes = 'class = "form-control" id = "sectorType"';
                                                echo form_dropdown('sectorType', $prospect_sector, set_value('sectorType'), $attributes); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">
                                            <div class="col-sm-4">
                                                <label for="prj_category" class="control-label">Proposed
                                                    product/solution on prospect
                                                    need:</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <?php
                                                $attributes = 'class = "form-control" id = "prj_category"';
                                                echo form_dropdown('prj_category', $prj_category, set_value('prj_category'), $attributes); ?>
                                            </div>
                                        </div>
                                    </div>


                                </fieldset>
                            </div>

                            <div class="col-sm-6 well">
                                <!--<legend>...</legend>-->

                                <fieldset>
                                    <div class="form-group">
                                        <div class="row colbox">

                                            <div class="col-sm-4"><label for="client_using_competitor_product">Is the
                                                    Prospect using an
                                                    existing product from a competitor :</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="radio">
                                                    <label><input type="radio" name="client_using_competitor_product"
                                                                  id="client_using_competitor_product_yes"
                                                                  value="Yes" <?php echo set_radio('client_using_competitor_product', 'Yes'); ?>>Yes</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="client_using_competitor_product"
                                                                  id="client_using_competitor_product_no"
                                                                  value="No" <?php echo set_radio('client_using_competitor_product', 'No'); ?>>No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">

                                            <div class="col-sm-4"><label for="desc_competitor_product">Name of
                                                    Competitor
                                                    Product:</label></div>
                                            <div class="col-sm-8">
                                                <input type="text" name="desc_competitor_product"
                                                       id="desc_competitor_product"
                                                       class="form-control"
                                                       value="<?= set_value('desc_competitor_product'); ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">

                                            <div class="col-sm-4"><label for="client_already_using_our_product">Is the
                                                    Prospect already
                                                    using a Data Care Product:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="radio">
                                                    <label><input type="radio" name="client_already_using_our_product"
                                                                  id="client_already_using_our_product_yes"
                                                                  value="Yes" <?php echo set_radio('client_already_using_our_product', 'Yes'); ?>>Yes</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="client_already_using_our_product"
                                                                  id="client_already_using_our_product_no"
                                                                  value="No" <?php echo set_radio('client_already_using_our_product', 'No'); ?>>No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">

                                            <div class="col-sm-4"><label for="desc_inhouse_product">Name of Data Care
                                                    Product:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" name="desc_inhouse_product" id="desc_inhouse_product"
                                                       class="form-control"
                                                       value="<?= set_value('desc_inhouse_product'); ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">

                                            <div class="col-sm-4"><label for="client_contact">Prospect Contact:</label>
                                            </div>
                                            <div class="col-sm-8">

                                <textarea name="client_contact" id="client_contact" cols="45" rows="5"
                                          class="form-control"
                                          placeholder="Client Contact"><?= set_value('client_contact'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">

                                            <div class="col-sm-4"><label for="call_comment">Comments:</label>
                                            </div>
                                            <div class="col-sm-8">

                                <textarea name="call_comment" id="call_comment" cols="45" rows="5" class="form-control"
                                          placeholder="Comments"><?= set_value('call_comment'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row colbox">

                                            <div class="col-sm-4"><label for="date">Next follow up date:</label>
                                            </div>
                                            <div class="col-sm-8 input-group date"
                                                 data-provide="datepicker"
                                                 align="right">
                                                <input id="next_follow_up_date" name="next_follow_up_date"
                                                       placeholder="Next Follow up Date"
                                                       type="text"
                                                       class="form-control"
                                                       value="<?= set_value('next_follow_up_date'); ?>"/>


                                                <div class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <p align="left" class="text-warning">
                                <small>If you don't save, your changes will be lost.</small>
                            </p>
                            <div align="right" class="col-lg-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                <input type='button' class="btn btn-primary"
                                       name='addSuspect'
                                       id="addSuspect"
                                       TITLE='Add Suspect' value='Add Suspect'
                                       onclick="submitSuspectForm()"/>

                            </div>
                            <div class="clearfix"></div>
                            <div class="errorMsgSuspect" id="alert-msg"></div>
                        </div>


                    </div>

                </div>

            </div>
            <!--end Suspect Model-->

            <div id="myModal2" class="modal hide fade" data-backdrop-limit="1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Modal 2 header</h3>
                </div>
                <div class="modal-body">
                    <p>Two modal body…</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
            </div>




        </div>
    </div>


    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







