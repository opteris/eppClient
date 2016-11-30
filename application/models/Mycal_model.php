<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/26/2016
 * Time: 5:54 PM
 */

class Mycal_model extends CI_Model{

    var $conf;

    public function __construct()
    {
        parent::__construct();

        $this->conf=array(
            'start_day'=>'monday',
            /*'day_type'     => 'long',*/
            'show_next_prev'=>true,
            'show_next_prev_url'=>base_url().'DataEntryController/dailySalesCallSheet',
        );

        /*The calendar UI beauty*/
        $this->conf['template'] = '
            {table_open}<table border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-striped calendar">{/table_open}

           {heading_row_start}<tr>{/heading_row_start}

           {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;Prev Week</a></th>{/heading_previous_cell}
           {heading_title_cell}<th align="center" colspan="{colspan}">{heading}</th>{/heading_title_cell}
           {heading_next_cell}<th><a href="{next_url}">Next Week &gt;&gt;</a></th>{/heading_next_cell}

           {heading_row_end}</tr>{/heading_row_end}

           {week_row_start}<tr>{/week_row_start}
           {week_day_cell}<td><strong>{week_day}<strong></td>{/week_day_cell}
           {week_row_end}</tr>{/week_row_end}

           {cal_row_start}<tr class="days">{/cal_row_start}
           {cal_cell_start}<td class="day">{/cal_cell_start}

           {cal_cell_content}
               <div class="day_num">{day}</div>
               <div class="content">{content}</div>

           {/cal_cell_content}
           {cal_cell_content_today}
               <div class="day_num highlight">{day}</div>
               <div class="content">{content}</div>
           {/cal_cell_content_today}

           {cal_cell_no_content}
                <div class="day_num">{day}</div>
           {/cal_cell_no_content}

           {cal_cell_no_content_today}
                <div class="day_num highlight">{day}</div>
           {/cal_cell_no_content_today}

           {cal_cell_blank}&nbsp;{/cal_cell_blank}

           {cal_cell_end}</td>{/cal_cell_end}
           {cal_row_end}</tr>{/cal_row_end}

           {table_close}</table>{/table_close}
        ';



    }

    function get_calendar_data($year, $month){

        $db_rows=$this->db->select('activity_name, date_planned')
            -> from('tbl_call_sheet_planner')
            ->like('date_planned',"$year-$month",'after')->get();

        $calc_data=array();
        foreach ($db_rows->result() as $row) {
            $calc_data[substr($row->date_planned,8,2)] = $row->activity_name;
        }

        return $calc_data;

    }

    function add_calendar_data($date, $data){
        $staffId = $this->session->userdata['user_id'];
        $role_id = $this->session->userdata['role_id'];

        if($this->db->select('date_planned')
            ->from('tbl_call_sheet_planner')
            ->where('date_planned', $date)
            ->count_all_results()){

            $this->db->where('date_planned', $date)
                ->update('tbl_call_sheet_planner',array(
                    'user_id' => $staffId,
                    'groupCode' => $role_id,
                    'activity_name' => $data,
                    'activity_status' => '4',
                    'date_planned' => $date,
                    'date_created' => toDay,
                    'display' => 'Yes',

            ));

        }else{
            $this->db->insert('tbl_call_sheet_planner',array(
                'tbl_call_sheet_plannerId' => null,
                'user_id' => $staffId,
                'groupCode' => $role_id,
                'activity_name' => $data,
                'activity_status' => '4',
                'date_planned' => $date,
                'date_created' => toDay,
                'display' => 'Yes',

            ));
        }


    }

    function  generate ($year, $month){


        $this->load->library('calendar', $this->conf);

        $cal_data= $this->get_calendar_data($year,$month);
        return $this->calendar->generate($year, $month, $cal_data);

    }

}