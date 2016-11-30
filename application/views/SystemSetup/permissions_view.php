<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/18/2016
 * Time: 4:16 PM
 */

?>
<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>View System Permissions</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_permissions", "name" => "filter_permissions");
    echo form_open("SystemSetupController/staffPermissions", $attributes); ?>


    <div class="col-sm-6" align="left">
        <div class="form-group">

            <?php
            $attributes = 'class = "form-control" id = "ugroup"';
            echo form_dropdown('ugroup', $ugroup, set_value('ugroup'), $attributes); ?>

            <span class="text-danger"><?= form_error('ugroup'); ?></span>
        </div>

        <input id="check_all" name="check_all" type="submit" class="btn btn-default" value="Check all"
               onclick="location.href='<?= site_url('SystemSetupController/staffPermissions') ?>'"/>

        <input id="un_check_all" name="un_check_all" type="submit" class="btn btn-default" value="Un Check all"
               onclick="location.href='<?= site_url('SystemSetupController/staffPermissions') ?>'"/>

        <input id="submit" name="submit" type="submit" class="btn ui-button-text-icon-primary" value="Go"
               onclick="location.href='<?= site_url('SystemSetupController/staffPermissions') ?>'"/>


    </div>


    <?= form_close(); ?>

    <?php
    if ($this->session->flashdata('msg') != ''):
        echo $this->session->flashdata('msg');
    endif; ?>

    <?php
    $attributes = array("class" => "form-horizontal", "id" => "form_savePermissions", "name" => "form_savePermissions");
    echo form_open("SystemSetupController/staffPermissions", $attributes); ?>
    <div class="col-sm-12 table-responsive">
        <input type="hidden" name="role_id" id="role_id" value="<?=$this->session->userdata['permission_role_id'];?>">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th colspan="5">ORS Staff Permissions</th>
            </tr>

            <tr>
                <th colspan="5">Please Check or UnCheck to Grant or Deny/Revoke access and save</th>
            </tr>

            <tr>
                <th colspan="1">#</th>
                <th colspan="4">Menu Item</th>
            </tr>
            </thead>
            <tbody>

            <!--start menu Items-->
            <?php
            foreach ($data_get_cat as $rows_menuC) {

                $MenuCategory = $rows_menuC->MenuCategory;
                $tbl_menu_categoriesId = $rows_menuC->tbl_menu_categoriesId;
                ?>
                <tr>
                    <td colspan="6" style="color: #fff; background-color:#3BAFDA; font-weight: bold"><i
                            class="fa fa-folder"></i> <?= $MenuCategory; ?></td>
                </tr>

                <?php
                $n = 1;
                foreach ($data_get_menu_items as $rowMenuItem) {

                    if ($tbl_menu_categoriesId == $rowMenuItem->menu_categoriesId) {
                        $presentMenuItem = $rowMenuItem->tbl_menu_itemsId;

                        ?>

                        <tr id="delete_link_<?= $rowMenuItem->tbl_menu_itemsId; ?>">
                            <td>
                                <input name="loopkey[]" id="loopkey<?= $rowMenuItem->tbl_menu_itemsId; ?>" value="1" type="hidden">
                                <input name="item_id[]" id="item_id<?= $rowMenuItem->tbl_menu_itemsId; ?>" value="<?= $rowMenuItem->tbl_menu_itemsId; ?>"
                                    <?php foreach ($data_get_current_permits as $rowCurrent) {
                                        $data = '';
                                        $currentItem = $rowCurrent->tbl_menu_itemsId;
                                        if ($currentItem != $presentMenuItem) $data .= "";
                                        else  $data .= "checked='checked'";

                                        ?>
                                        <?= $data; ?>
                                        <?php
                                    }
                                    ?>
                                       type="checkbox"> <?= $n; ?>.
                            </td>
                            <td colspan="4"><?= $rowMenuItem->MenuItem; ?></td>

                        </tr>

                        <?php
                        $n++;
                    } else {

                    }
                    ?>

                    <?php
                }
                ?>

            <?php }
            ?>


            </tbody>
        </table>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
            <input id="btn_saveRoles" name="btn_saveRoles" type="submit" class="btn btn-primary" value="Save Roles"/>
            <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel"
                   onclick="location.href='<?= base_url('SystemSetup/permissions_view.php') ?>'"/>
        </div>
    </div>
    <?= form_close(); ?>
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







