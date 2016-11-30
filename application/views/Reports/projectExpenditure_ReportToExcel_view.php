<div id="page-wrapper">
        <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped" border="1">
            <thead>
            <tr>
                <?php foreach ($data_get_expenditure_summations as $rSumsExpenditure) {
                    $projectName=$rSumsExpenditure->projectName;
                } ?>
                <th colspan="10">Project Billing Report on Project: <?=$projectName?> up until <?=thisYear;?></th>
            </tr>

            <tr>
                <th colspan="">Project</th>
                <th>Staff Name</th>
                <th>Level of Effort (LOE)</th>
                <th colspan="4">HR Fees(UGX)</th>
                <th>Transport</th>
                <th>Stationary</th>
                <th colspan="">Others</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $n = 1;
            foreach ($data_get_project_expenditure as $rExpenditure) {
            ?>
            <tr >
                <td><?=$n;?></td>
                <td><?=$rExpenditure->fullNames;?></td>
                <td align="right"><?=number_format(($rExpenditure->inputhours),2);?></td>
                <td align="right" class="" colspan="4" align="right"><?=number_format(($rExpenditure->hrfees),2);?></td>
                <td align="right" class="" align="right">-</td>
                <td align="right" class="" align="right">-</td>
                <td align="right" class="" align="right">-</td>
            </tr>

            <?php
            $n++;
            }
            ?>
            <?php
            foreach ($data_get_expenditure_summations as $rSumsExpenditure) {


            ?>
            <tr class="" style="color:black;">
                <td class="" colspan="2" bgcolor="#9BB7FF"><strong><i class="fa fa-star"></i>  Project Total:</strong></td>
                <td class="greenColor" style="color: #03054B;" colspan="" align="right" bgcolor="#9BB7FF">
                    <strong><?=number_format($rSumsExpenditure->sumHours,2);?>Hr(s) </strong></td>
                <td style="color: #9BB7FF;" colspan="4" align="right" bgcolor="#9BB7FF">
                    <strong style="color:#03054B;"><?=number_format($rSumsExpenditure->sumFees,2);?></strong></td>
                <td style="color: #9BB7FF;" colspan="3" align="right" bgcolor="#9BB7FF">
                    <strong style="color:#03054B;"></strong>
                </td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







