<?php

/**
 * Created by PhpStorm.
 * User: aasiimwe
 * Date: 1/11/2016
 * Time: 7:27 PM
 */
class Menu_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }

    function Categories()
    {
        $displayValue = 'Yes';
        $this->db->select("c.* from tbl_menu_categories c
                            where c.display like 'Yes%'
                            order by c.Rank, c.MenuCategory asc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function SubCategories(){
        $role_id = $this->session->userdata['role_id'];
        $this->db->select("s.tbl_menu_itemsId,
                            s.page,
                            s.menu_categoriesId,
                            c.font_awesome_icon,
                            s.MenuItem,
                            s.ControllerName,
                            s.ViewFile,
                            s.LinkvalCode,
                            s.Rank
                            from tbl_menu_items s
                            left join tbl_menu_categories c
                            on(c.tbl_menu_categoriesId=s.menu_categoriesId)
                            left join tbl_permisions p on (s.tbl_menu_itemsId =p.MenuItem)
                            where s.display like 'Yes%'
                            and p.role_id='".$role_id."'
                            order by
                            c.Rank,
                            c.MenuCategory,
                            s.Rank,
                            s.tbl_menu_itemsId
                             asc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }


}
