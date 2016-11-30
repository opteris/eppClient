<!--start of Vertical Menu-->
<div style="display:none;" class="navbar-default sidebar" id='menuContainer' role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <?php
                $attributes = array("id" => "search_frm", "name" => "search_frm");
                echo form_open("SearchController/index", $attributes); ?>
                <div class="input-group custom-search-form">
                    <input type="text" name="project_profile" id="project_profile" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" onclick="location.href='<?= site_url('SearchController/index') ?>'">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <?= form_close(); ?>
                <!-- /input-group -->
            </li>
            <li class="sidebar-menu-item">
                <a href="<?= site_url('DashboardController/index'); ?>"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
            </li>

            <!--start menu Items-->
            <?php
            foreach ($data_get_cat as $rows_menuC) {

                $MenuCategory = $rows_menuC->MenuCategory;
                $tbl_menu_categoriesId = $rows_menuC->tbl_menu_categoriesId;
                $mnu_Cat_fa = $rows_menuC->font_awesome_icon;

                $mdata = '<li class="sidebar-menu-item">';
                $mdata .= '<a href="#">';
                $mdata .= '<i class="' . $mnu_Cat_fa . '"></i>';
                $mdata .= '&nbsp;' . $MenuCategory . '<span class="fa arrow"></span></a>';

                $mdataSub = '<ul class="nav nav-second-level sidebar-child">';

                foreach ($data_get_subCat as $rows_menuSubC) {
                    $a = $rows_menuSubC->MenuItem;
                    $b = $rows_menuSubC->menu_categoriesId;
                    $page = $rows_menuSubC->page;
                    $controller_name = $rows_menuSubC->ControllerName;
                    $view_name = $rows_menuSubC->ViewFile;

                    $linkvar = $rows_menuSubC->LinkvalCode;


                    $MenuItem = ($tbl_menu_categoriesId == $b) ? $a : '';
                    /*start submenu item*/
                    if ($MenuItem != '') {
                        $mdataSub .= '<li>';
                        $mdataSub .= '<a href=\'#\' onclick="location.href=\'' . site_url('' . $controller_name . 'Controller/' . $view_name . '#') . '\'">&nbsp;<i class="fa fa-hand-o-right"></i>
 ' . $MenuItem . '</a>';
                        $mdataSub .= '</li>';
                    } else {
                        $mdataSub .= '';
                    }
                    /*End submenu item*/
                }

                $mdataSub .= '</ul>';

                $mdata .= $mdataSub;

                $mdata .= '<!-- /.nav-second-level -->';
                $mdata .= '</li>';

                echo $mdata;

            }
            ?>
            <!--end menu items-->

        </ul>
    </div>
    <!-- /.sidebar-collapse -->

</div>

<!-- /.navbar-static-side -->
<!--End of Vertical Menu-->

</nav>