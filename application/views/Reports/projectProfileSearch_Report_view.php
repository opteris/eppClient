<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>Project Profile Search Results</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_search_results", "name" => "filter_search_results");
    echo form_open("SearchController/index", $attributes); ?>

    <?= form_close(); ?>

    <!--Start Project display-->

    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped">


            <tbody>
            <?php foreach ($data_get_search_results as $results) {

            }
            ?>
            <tr>
                <td  ><p><strong>Assignment name:</strong><br />
                        <?=$results->projectName;?> </p>
                    <p><strong>&nbsp;</strong></p></td>
                <td  ><p><strong>Approx. value of the contract (in current US$ or Euro):</strong><br />
                        USD:    <?=number_format($results->Amount);?> </p></td>
            </tr>
            <tr>
                <td  ><p><strong>Country: </strong><?=($results->Country);?><br />
                        <strong>Location within country: </strong><?=($results->location_within_country);?></p></td>
                <td  ><p><strong>Duration of assignment (months):</strong><br />
                        4 months</p></td>
            </tr>
            <tr>
                <td  ><p><strong>Name of Client:</strong><br />
                        <?=($results->client);?><strong> </strong></p>
                    <p><strong>&nbsp;</strong></p></td>
                <td  ><p><strong>Total N<u>o</u> of staff-months of the assignment:</strong></p>
                    <p><strong>&nbsp;</strong></p></td>
            </tr>
            <tr>
                <td  ><p><strong>Address:</strong><br/><strong><?=($results->client_address);?> </strong></p></td>
                <td  ><p><strong>Approx. value of the services provided by your firm under the contract    (in current US$ or Euro):</strong><?=number_format($results->value_services_provided_our_firm_in_contract);?> </p></td>
            </tr>
            <tr>
                <td  ><p><strong>Start date (month/year):</strong><?=($results->startDate);?><br />
                        <strong>Completion date (month/year):</strong></p><?=($results->endDate);?></td>
                <td  ><p><strong>N<u>o</u> of professional staff-months provided by    associated Consultants:</strong></p></td>
            </tr>
            <tr>
                <td  ><p><strong>Name of associated Consultants, if any:</strong></p>
                    <p><strong>__</strong></p></td>
                <td  ><p><strong>Name of senior professional staff of your firm involved and functions    performed (indicate most significant profiles such as Project    Director/Coordinator, Team Leader):</strong>__</p></td>
            </tr>
            <tr>
                <td  colspan="2" ><p><strong>Narrative description of Project:</strong><br /><?=$results->project_narrative;?><strong> </strong></p></td>
            </tr>
            <tr>
                <td  colspan="2" ><p><strong>Description of actual services provided by your staff within the    assignment:</strong></p>
                    <ul>
                        <li>System Analysis and Design;</li>
                        <li>System Development and Testing;</li>
                        <li>Training Users</li>
                        <li>Managing the system for one year after the    final deliverable (Support period)</li>
                    </ul></td>
            </tr>


            </tbody>
        </table>
        <div class="col-md-12 text-left">
            <?/*= $pagination; */?>
        </div>
    </div>

    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







