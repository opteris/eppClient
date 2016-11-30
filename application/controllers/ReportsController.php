<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/8/2016
 * Time: 7:38 PM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class ReportsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->helper('utility');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->model('Setups_model');
        $this->load->model('Project_model');
        $this->load->model('Projectexpenditure_model');
        $this->load->library("excel");
        $this->load->model('Hoursworked_model');
        $this->load->model('Menu_model');
        $this->load->model('Sales_model');
    }


    public function hoursWorked()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Reports Hours Worked',
            'filter_projectId' => $this->input->post("projectId"),
            'filter_staffId' => $this->input->post("staffId"),
            'filter_fromDate' => $this->input->post("fromDate"),
            'filter_toDate' => $this->input->post("toDate")
        );
        $this->session->set_userdata($pageAndFilterParameters);


        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['data_get_all_projects'] = $this->Project_model->getAllProjects($projectId = '');
        $data['data_get_all_staff'] = $this->Project_model->getAllStaff($staffId = '');

        $filter = ($this->input->post('submit') == "Search") ? $this->input->post('submit') : "";

        $filter_projectId = $this->session->userdata['filter_projectId'];
        $filter_staffId = $this->session->userdata['filter_staffId'];
        $filter_fromDate = $this->session->userdata['filter_fromDate'];
        $filter_toDate = $this->session->userdata['filter_toDate'];

        $data['data_get_all_monthly_effort_in_hours'] = $this->Hoursworked_model->getAllMonthlyEffortInHours($filter_projectId, $filter_staffId, $filter_fromDate, $filter_toDate);


        $postToExcel = ($this->input->post('export_to_excel') == "Export to Excel") ? $this->input->post('export_to_excel') : '';
        if ($postToExcel != '') {
            redirect('ReportsController/hoursWorkedExcel');
        } else {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('Reports/hoursWorked_Report_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }


    }

    public function hoursWorkedExcel()
    {
        //retrive contries table data
        $projectId = $this->session->userdata['filter_projectId'];
        $staffId = $this->session->userdata['filter_staffId'];
        $fromDate = $this->session->userdata['filter_fromDate'];
        $toDate = $this->session->userdata['filter_toDate'];

        $appendUserName = ($staffId == '' or empty($staffId)) ? 'All Staff' : $staffId;
        $appendProject = ($projectId == '' or empty($projectId)) ? 'All Projects' : $projectId;
        $appendDates = ($fromDate == '' and $toDate == '') ? '' : 'From: ' . $fromDate . ' To: ' . $toDate . '';

        $reportTitle = "Hours Worked by " . $appendUserName . " on " . $appendProject . " " . $appendDates . " in " . thisYear . "";
        $this->excel->setActiveSheetIndex(0);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $this->excel->getDefaultStyle()->applyFromArray($styleArray);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Hours Worked');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', '' . $reportTitle . '');
        $this->excel->getActiveSheet()->setCellValue('A2', '#');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Department');
        $this->excel->getActiveSheet()->setCellValue('C2', 'Designation');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Staff Name');

        $this->excel->getActiveSheet()->setCellValue('E2', 'JAN');
        $this->excel->getActiveSheet()->setCellValue('E3', 'T');
        $this->excel->getActiveSheet()->setCellValue('F3', 'A');
        $this->excel->getActiveSheet()->setCellValue('G3', '%');

        $this->excel->getActiveSheet()->setCellValue('H2', 'FEB');
        $this->excel->getActiveSheet()->setCellValue('H3', 'T');
        $this->excel->getActiveSheet()->setCellValue('I3', 'A');
        $this->excel->getActiveSheet()->setCellValue('J3', '%');

        $this->excel->getActiveSheet()->setCellValue('K2', 'MAR');
        $this->excel->getActiveSheet()->setCellValue('K3', 'T');
        $this->excel->getActiveSheet()->setCellValue('L3', 'A');
        $this->excel->getActiveSheet()->setCellValue('M3', '%');

        $this->excel->getActiveSheet()->setCellValue('N2', 'APR');
        $this->excel->getActiveSheet()->setCellValue('N3', 'T');
        $this->excel->getActiveSheet()->setCellValue('O3', 'A');
        $this->excel->getActiveSheet()->setCellValue('P3', '%');

        $this->excel->getActiveSheet()->setCellValue('Q2', 'MAY');
        $this->excel->getActiveSheet()->setCellValue('Q3', 'T');
        $this->excel->getActiveSheet()->setCellValue('R3', 'A');
        $this->excel->getActiveSheet()->setCellValue('S3', '%');

        $this->excel->getActiveSheet()->setCellValue('T2', 'JUN');
        $this->excel->getActiveSheet()->setCellValue('T3', 'T');
        $this->excel->getActiveSheet()->setCellValue('U3', 'A');
        $this->excel->getActiveSheet()->setCellValue('V3', '%');

        $this->excel->getActiveSheet()->setCellValue('W2', 'JUL');
        $this->excel->getActiveSheet()->setCellValue('W3', 'T');
        $this->excel->getActiveSheet()->setCellValue('X3', 'A');
        $this->excel->getActiveSheet()->setCellValue('Y3', '%');

        $this->excel->getActiveSheet()->setCellValue('Z2', 'AUG');
        $this->excel->getActiveSheet()->setCellValue('Z3', 'T');
        $this->excel->getActiveSheet()->setCellValue('AA3', 'A');
        $this->excel->getActiveSheet()->setCellValue('AB3', '%');

        $this->excel->getActiveSheet()->setCellValue('AC2', 'SEP');
        $this->excel->getActiveSheet()->setCellValue('AC3', 'T');
        $this->excel->getActiveSheet()->setCellValue('AD3', 'A');
        $this->excel->getActiveSheet()->setCellValue('AE3', '%');

        $this->excel->getActiveSheet()->setCellValue('AF2', 'OCT');
        $this->excel->getActiveSheet()->setCellValue('AF3', 'T');
        $this->excel->getActiveSheet()->setCellValue('AG3', 'A');
        $this->excel->getActiveSheet()->setCellValue('AH3', '%');

        $this->excel->getActiveSheet()->setCellValue('AI2', 'NOV');
        $this->excel->getActiveSheet()->setCellValue('AI3', 'T');
        $this->excel->getActiveSheet()->setCellValue('AJ3', 'A');
        $this->excel->getActiveSheet()->setCellValue('AK3', '%');

        $this->excel->getActiveSheet()->setCellValue('AL2', 'DEC');
        $this->excel->getActiveSheet()->setCellValue('AL3', 'T');
        $this->excel->getActiveSheet()->setCellValue('AM3', 'A');
        $this->excel->getActiveSheet()->setCellValue('AN3', '%');


        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:AN1');
        $this->excel->getActiveSheet()->mergeCells('A2:A3');
        $this->excel->getActiveSheet()->mergeCells('B2:B3');
        $this->excel->getActiveSheet()->mergeCells('C2:C3');
        $this->excel->getActiveSheet()->mergeCells('D2:D3');
        $this->excel->getActiveSheet()->mergeCells('E2:G2');
        $this->excel->getActiveSheet()->mergeCells('H2:J2');
        $this->excel->getActiveSheet()->mergeCells('K2:M2');
        $this->excel->getActiveSheet()->mergeCells('N2:P2');
        $this->excel->getActiveSheet()->mergeCells('Q2:S2');
        $this->excel->getActiveSheet()->mergeCells('T2:V2');
        $this->excel->getActiveSheet()->mergeCells('W2:Y2');
        $this->excel->getActiveSheet()->mergeCells('Z2:AB2');
        $this->excel->getActiveSheet()->mergeCells('AC2:AE2');
        $this->excel->getActiveSheet()->mergeCells('AF2:AH2');
        $this->excel->getActiveSheet()->mergeCells('AI2:AK2');
        $this->excel->getActiveSheet()->mergeCells('AL2:AN2');

        //set aligment to center for that merged cell (A1 to C1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B2:AN2')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getStyle('E3:AN3')->getFont()->setBold(true);

        /*$this->excel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G3')->getFont()->setBold(true);*/


        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#29388F');
        for ($col = ord('A'); $col <= ord('AN'); $col++) {
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);


            $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }


        $queryPartProjectId = ($projectId == '' or empty($projectId)) ? "and p.`tbl_projectId` like '%'" : "and p.`tbl_projectId` = " . $projectId . "";
        $queryPartStaffId = ($staffId == '' or empty($staffId)) ? "and s.`tbl_staffId` like '%'" : "and s.`tbl_staffId` = " . $staffId . "";
        $queryPartDate = ($fromDate == '' && $toDate == '') ? "" : "and t.timesheetdate between ('" . date("Y-m-d", strtotime($fromDate)) . "') and ('" . date("Y-m-d", strtotime($toDate)) . "')";
        $year = ($fromDate == '' && $toDate == '') ? "" : "and year(t.timesheetdate) between year('" . date("Y-m-d", strtotime($fromDate)) . "') and year('" . date("Y-m-d", strtotime($toDate)) . "')";
        $queryPartYear = ($year == '' or empty($year)) ? "and YEAR(t.`timesheetDate`)=" . thisYear . "" : "" . $year . "";


        $this->db->select(" @r := @r+1 as `rowNumber` , z.* from(
         select
        `d`.`Department`,
        `de`.`name` as `designationName`,
        `s`.`fullNames`,
        160 as `TJan`,
        round(sum(if(month(t.timesheetdate)=1,t.`inputHours`,0)),2) as `HoursJan`,
        round((((sum(if(month(t.timesheetdate)=1,t.`inputHours`,0)))/(160))*100),2) as `percentJan`,

        160 as `TFeb`,
        round(sum(if(month(t.timesheetdate)=2,t.`inputHours`,0)),2) as `HoursFeb`,
        round((((sum(if(month(t.timesheetdate)=2,t.`inputHours`,0)))/(160))*100),2) as `percentFeb`,

        160 as `TMar`,
        round(sum(if(month(t.timesheetdate)=3,t.`inputHours`,0)),2) as `HoursMar`,
        round((((sum(if(month(t.timesheetdate)=3,t.`inputHours`,0)))/(160))*100),2) as `percentMar`,

        160 as `TApr`,
        round(sum(if(month(t.timesheetdate)=4,t.`inputHours`,0)),2) as `HoursApr`,
        round((((sum(if(month(t.timesheetdate)=4,t.`inputHours`,0)))/(160))*100),2) as `percentApr`,

        160 as `TMay`,
        round(sum(if(month(t.timesheetdate)=5,t.`inputHours`,0)),2) as `HoursMay`,
        round((((sum(if(month(t.timesheetdate)=5,t.`inputHours`,0)))/(160))*100),2) as `percentMay`,

        160 as `TJun`,
        round(sum(if(month(t.timesheetdate)=6,t.`inputHours`,0)),2) as `HoursJun`,
        round((((sum(if(month(t.timesheetdate)=6,t.`inputHours`,0)))/(160))*100),2) as `percentJun`,

        160 as `TJul`,
        round(sum(if(month(t.timesheetdate)=7,t.`inputHours`,0)),2) as `HoursJul`,
        round((((sum(if(month(t.timesheetdate)=7,t.`inputHours`,0)))/(160))*100),2) as `percentJul`,

        160 as `TAug`,
        round(sum(if(month(t.timesheetdate)=8,t.`inputHours`,0)),2) as `HoursAug`,
        round((((sum(if(month(t.timesheetdate)=8,t.`inputHours`,0)))/(160))*100),2) as `percentAug`,

        160 as `TSep`,
        round(sum(if(month(t.timesheetdate)=9,t.`inputHours`,0)),2) as `HoursSep`,
        round((((sum(if(month(t.timesheetdate)=9,t.`inputHours`,0)))/(160))*100),2) as `percentSep`,

        160 as `TOct`,
        round(sum(if(month(t.timesheetdate)=10,t.`inputHours`,0)),2) as `HoursOct`,
        round((((sum(if(month(t.timesheetdate)=10,t.`inputHours`,0)))/(160))*100),2) as `percentOct`,

        160 as `TNov`,
        round(sum(if(month(t.timesheetdate)=11,t.`inputHours`,0)),2) as `HoursNov`,
        round((((sum(if(month(t.timesheetdate)=11,t.`inputHours`,0)))/(160))*100),2) as `percentNov`,

        160 as `TDec`,
        round(sum(if(month(t.timesheetdate)=12,t.`inputHours`,0)),2) as `HoursDec`,
        round((((sum(if(month(t.timesheetdate)=12,t.`inputHours`,0)))/(160))*100),2) as `percentDec`
        FROM
        `tbl_timesheet` as `t`,
        `tbl_staff` as `s`,
        `tbl_project` as `p`,
        `tbl_department` as `d`,
        `tbl_designation` as `de`
        WHERE p.`tbl_projectId`=t.`projectId`
        AND s.`tbl_staffId`=t.`userName`
        and d.tbl_departmentId=s.`groupCode`
        and `de`.`tbl_designationId` = designation
        " . $queryPartProjectId . "
        " . $queryPartStaffId . "
        " . $queryPartDate . "
        " . $queryPartYear . "
        GROUP BY t.`userName` ORDER BY s.`fullNames`
        )z, (select @r:=0)y", FALSE);

        $rs = $this->db->get();
        $i = $rs->num_rows();
        $exceldata = "";
        foreach ($rs->result_array() as $row) {
            $exceldata[] = $row;
        }
        //Fill data
        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A4');


        $filename = 'HoursWorked Report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }

    public function timeSheet()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Reports: Timesheet',
            'filter_projectId' => $this->input->post("projectId"),
            'filter_staffId' => $this->input->post("staffId"),
            'filter_fromDate' => $this->input->post("fromDate"),
            'filter_toDate' => $this->input->post("toDate")

        );
        $this->session->set_userdata($pageAndFilterParameters);
        $filter_projectId = $this->session->userdata['filter_projectId'];
        $filter_staffId = $this->session->userdata['filter_staffId'];
        $filter_fromDate = $this->session->userdata['filter_fromDate'];
        $filter_toDate = $this->session->userdata['filter_toDate'];

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['data_get_staff_name'] = $this->Project_model->getStaffName($filter_staffId);
        $data['data_get_active_projects'] = $this->Project_model->getAllActiveUserProjects($filter_staffId);
        $data['data_get_all_projects'] = $this->Project_model->getAllProjects($filter_projectId);
        $data['data_get_timesheet_projects'] = $this->Project_model->getTimesheetProjects($filter_projectId, $filter_staffId, $filter_fromDate, $filter_toDate);
        $data['data_get_timesheet_milestones'] = $this->Project_model->getTimesheetMilestones($filter_projectId, $filter_staffId, $filter_fromDate, $filter_toDate);
        $data['data_get_timesheet_activities'] = $this->Project_model->getTimeSheetActivities($filter_projectId, $filter_staffId, $filter_fromDate, $filter_toDate);
        $data['data_get_timesheet_sub_activities'] = $this->Project_model->getTimeSheetSubActivities($filter_projectId, $filter_staffId, $filter_fromDate, $filter_toDate);
        $data['data_get_timesheet'] = $this->Project_model->getTimeSheet($filter_projectId, $filter_staffId, $filter_fromDate, $filter_toDate);
        $data['data_get_timesheet_summary'] = $this->Project_model->timesheetSummary($filter_projectId, $filter_staffId, $filter_fromDate, $filter_toDate);


        $data['data_get_all_staff'] = $this->Project_model->getAllStaff($staffId = '');

        $filter = ($this->input->post('submit') == "Search") ? $this->input->post('submit') : "";


        $postToExcel = ($this->input->post('export_to_excel') == "Export to Excel") ? $this->input->post('export_to_excel') : '';
        if ($postToExcel != '') {
            /*redirect('ReportsController/timeSheetExcel');*/

            header("Cache-control: private");
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=ORS_file.xls");
            header("Content-Description: PHP Generated Data");
            header("Pragma: no-cache");
            header("Expires: 0");

            $this->load->view('Reports/timeSheet_ReportToExcel_view', $data);


        } else {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('Reports/timeSheet_Report_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }


    }

    public function timeSheetExcel()
    {
        //retrive contries table data
        $projectId = $this->session->userdata['filter_projectId'];
        $staffId = $this->session->userdata['filter_staffId'];
        $fromDate = $this->session->userdata['filter_fromDate'];
        $toDate = $this->session->userdata['filter_toDate'];


        $sess_staffId = ($this->session->userdata['user_id']);
        $query_append_staffId = (!empty($staffId) or ($staffId != '')) ? " WHERE `t`.`userName`  =" . $staffId . "" : " WHERE `t`.`userName`  ='" . $sess_staffId . "'";
        $query_append_projectId = (!empty($projectId) or ($projectId != '')) ? " and t.projectId  =" . $projectId . "" : "";
        $appendFromDate = (empty($fromDate) or ($fromDate == '')) ? date("Y-m-01") : @date('Y-m-d', @strtotime($fromDate));
        $timestamp = strtotime("last day of");
        $appendToDate = (empty($toDate) or ($toDate == '')) ? date("Y-m-d", $timestamp) : @date('Y-m-d', @strtotime($toDate));
        $appendDate = " and `t`.`timesheetDate` between ('" . $appendFromDate . "')and ('" . $appendToDate . "')";


        $reportTitle = "Detailed Timesheet Report by " . $staffId . " on " . $projectId . " between " . $appendFromDate . " and " . $appendToDate . "";
        $this->excel->setActiveSheetIndex(0);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $this->excel->getDefaultStyle()->applyFromArray($styleArray);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Timesheet Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', '' . $reportTitle . '');
        $this->excel->getActiveSheet()->setCellValue('A2', '#');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Task Description');
        $this->excel->getActiveSheet()->setCellValue('C2', 'Planned Hours');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Input Hours');

        $this->excel->getActiveSheet()->setCellValue('E2', 'Date');
        $this->excel->getActiveSheet()->setCellValue('F2', 'Status');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Staff Comment');
        $this->excel->getActiveSheet()->setCellValue('H2', 'Supervisor Comment');

        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:H1');
        $this->excel->getActiveSheet()->mergeCells('A3:H3');
        $this->excel->getActiveSheet()->mergeCells('A4:H4');
        $this->excel->getActiveSheet()->mergeCells('A5:H5');
        $this->excel->getActiveSheet()->mergeCells('A6:H6');

        //set aligment to center for that merged cell (A1 to C1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B2:H2')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getStyle('E3:H3')->getFont()->setBold(true);

        /*$this->excel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G3')->getFont()->setBold(true);*/


        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#29388F');
        for ($col = ord('A'); $col <= ord('H'); $col++) {
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);


            $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }


        $projects = $this->db->select(" p.projectName
                    FROM `tbl_timesheet` as `t`
                    join tbl_project as p
                    on (p.tbl_projectId=t.projectId)
                    " . $query_append_staffId . "
                    " . $query_append_projectId . "
                    " . $appendDate . "
                    group by `t`.`projectId`
                    order by `t`.`tbl_timeSheetId` desc", FALSE)->get();
        $projectsData = "";
        $p = 1;
        foreach ($projects->result_array() as $rowP) {
            $projectsData[] = $rowP;

            $tasks = $this->db->select(" @r := @r+1 as `rowNumber` , z.* from(
         select
                    `t`.`taskDescription`,
                    `t`.`plannedHours`,
                    `t`.`inputHours`,
                    `t`.`timesheetDate`,
                    `t`.`statusCode`,
                    `t`.`comment`,
                    `t`.`supervisorComment`
                    FROM `tbl_timesheet` as `t`
                    " . $query_append_staffId . "
                    " . $query_append_projectId . "
                    " . $appendDate . "
                    order by `t`.`tbl_timeSheetId` desc )z, (select @r:=0)y", FALSE)->get();

            $tasksData = "";
            foreach ($tasks->result_array() as $row) {
                $tasksData[] = $row;
            }

            $p++;
        }


        //Fill data
        $this->excel->getActiveSheet()->fromArray($projectsData, 'xx', 'A3');
        $this->excel->getActiveSheet()->setCellValue('A4', 'Milestone:');
        $this->excel->getActiveSheet()->setCellValue('A5', 'Activity:');
        $this->excel->getActiveSheet()->setCellValue('A6', 'Sub-Activity:');

        $this->excel->getActiveSheet()->fromArray($tasksData, null, 'A7');


        $filename = 'Detailed Timesheet Report.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }

    public function daysWorked()
    {
        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Reports:Days Worked',
            'filter_DW_projectId' => $this->input->post("projectId"),
            'filter_DW_staffId' => $this->input->post("staffId"),
            'filter_DW_fromDate' => $this->input->post("fromDate"),
            'filter_DW_toDate' => $this->input->post("toDate")
        );
        $this->session->set_userdata($pageAndFilterParameters);


        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['data_get_all_projects'] = $this->Project_model->getAllProjects($projectId = '');
        $data['data_get_all_staff'] = $this->Project_model->getAllStaff($staffId = '');

        $filter = ($this->input->post('submit') == "Search") ? $this->input->post('submit') : "";

        $filter_projectId = $this->session->userdata['filter_DW_projectId'];
        $filter_staffId = $this->session->userdata['filter_DW_staffId'];
        $filter_fromDate = $this->session->userdata['filter_DW_fromDate'];
        $filter_toDate = $this->session->userdata['filter_DW_toDate'];

        $data['data_get_all_monthly_effort_in_hours'] = $this->Hoursworked_model->getAllMonthlyEffortInHours($filter_projectId, $filter_staffId, $filter_fromDate, $filter_toDate);


        $postToExcel = ($this->input->post('export_to_excel') == "Export to Excel") ? $this->input->post('export_to_excel') : '';
        if ($postToExcel != '') {
            $this->load->view('header_to_excel');
            $this->load->view('Reports/daysWorked_ReportToExcel_view', $data);
        } else {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('Reports/daysWorked_Report_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }

    }

    public function projectExpenditure()
    {
        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Reports Project Expenditure',
            'filter_projectId' => $this->input->post("projectId"),
            'filter_staffId' => $this->input->post("staffId"),
            'filter_fromDate' => $this->input->post("fromDate"),
            'filter_toDate' => $this->input->post("toDate")
        );
        $this->session->set_userdata($pageAndFilterParameters);


        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['data_get_all_projects'] = $this->Project_model->getAllProjects($projectId = '');
        $data['data_get_all_staff'] = $this->Project_model->getAllStaff($staffId = '');

        $filter = ($this->input->post('submit') == "Search") ? $this->input->post('submit') : "";

        $filter_projectId = $this->session->userdata['filter_projectId'];
        $filter_staffId = $this->session->userdata['filter_staffId'];
        $filter_fromDate = $this->session->userdata['filter_fromDate'];
        $filter_toDate = $this->session->userdata['filter_toDate'];

        $data['data_get_project_expenditure'] = $this->Projectexpenditure_model->getProjectExpenditure($filter_projectId, $filter_staffId, $filter_fromDate, $filter_toDate);
        $data['data_get_expenditure_summations'] = $this->Projectexpenditure_model->getExpenditureSummations($filter_projectId, $filter_staffId, $filter_fromDate, $filter_toDate);

        $postToExcel = ($this->input->post('export_to_excel') == "Export to Excel") ? $this->input->post('export_to_excel') : '';
        if ($postToExcel != '') {
            $this->load->view('header_to_excel');
            $this->load->view('Reports/projectExpenditure_ReportToExcel_view', $data);
        } else {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('Reports/projectExpenditure_Report_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }


    }

    public function lastReported()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Reports:Over Due Reporters',
            'filter_DW_projectId' => $this->input->post("projectId"),
            'filter_DW_staffId' => $this->input->post("staffId"),
            'filter_DW_fromDate' => $this->input->post("fromDate"),
            'filter_DW_toDate' => $this->input->post("toDate")
        );
        $this->session->set_userdata($pageAndFilterParameters);

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['data_get_all_staff'] = $this->Project_model->LateReporters();


        $this->load->view('header');
        $this->load->view('left_nav_menu', $data);
        $this->load->view('Reports/staffMembersLateReporting_view', $data);
        $this->load->view('footer');
        $this->load->view('footer_close_tags');


    }

    public function sendReminderMail()
    {

        //get the posted staffId
        $id = $this->uri->segment(3);
        $data['staff_record'] = $this->Project_model->getAllStaffLastReported($id);
        foreach ($data['staff_record'] as $rowStaff) {


            $fname = $rowStaff->fullNames;
            $lastReported = $rowStaff->lastReported;
            $timestamp = strtotime($lastReported);
            $day = date('l', $timestamp);
            $emailAdress = $rowStaff->email;
        }


        $message = "<p style='font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        font-size: 14px;
        font-style: normal;
        font-variant: normal;
        font-weight: 500;
        line-height: 26.4px;'>";
        $message .= "Dear  <strong>" . $fname . "</strong>,<br/>
        Greetings from ORS Revision Team.<br/>

        Your last ORS Update was on <strong>" . $day . "</strong>,  <strong>" . $lastReported . "</strong>.<br/>
        This serves to remind you to update your daily TIMESHEET.<br/>

        Please address any queries and/or feedback to:<br/>
        1.ors@dcareug.com<br/>
        2.support@dcareug.com<br/>

        Yours Sincerely;<br/>
        <strong>ORS TEAM</strong><br/>
        Data Care (U) LTD<br/>
        Plot 2A, Kyambogo Drive, off Martyrs Way<br/>
        Ntinda , Kampala Uganda | www.dcareug.com<br/>
        Office:   +256-312-512-246<br/></p>";


        $this->email->from('ors@dcareug.com', 'ORS Administrator');
        $this->email->to($emailAdress);
        $this->email->cc('rmutesi@dcareug.com');
        $this->email->bcc('aasiimwe@dcareug.com');
        $this->email->subject('ORS Timesheet Submission Reminder');
        $this->email->message($message);
        /*$this->email->attach(''.$_SERVER["DOCUMENT_ROOT"].'/assets/images/email_graphs/1_Farmers Trained.png'); // attach file
        $this->email->attach(''.$_SERVER["DOCUMENT_ROOT"].'/assets/images/email_graphs/2_Hectares Under Production.png');
        */
        /*$this->email->send();*/


        if (!$this->email->send()) {
            //display failure message
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">' . $this->email->print_debugger() . '</div>');
            redirect('ReportsController/lastReported');

        } else {
            $this->email->send();

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Email Sent Successfully</div>');
            redirect('ReportsController/lastReported');
        }

    }

    public function dailySalesCallSheet()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Reports: Daily Sales Call Report',
            'filter_staffId' => $this->input->post("staffId"),
            'filter_fromDate' => $this->input->post("fromDate"),
            'filter_toDate' => $this->input->post("toDate")

        );
        $this->session->set_userdata($pageAndFilterParameters);

        $filter_staffId = $this->session->userdata['filter_staffId'];
        $filter_fromDate = $this->session->userdata['filter_fromDate'];
        $filter_toDate = $this->session->userdata['filter_toDate'];

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['data_get_staff_name'] = $this->Project_model->getStaffName($filter_staffId);
        $data['get_all_sales_team'] = $this->Sales_model->getAllSalesTeamStaff();

        $data['data_get_daily_sales'] = $this->Project_model->getDailySalesActuals($filter_staffId, $filter_fromDate, $filter_toDate);
        $data['data_get_daily_sales_team'] = $this->Project_model->getDailySalesActualsTeam($filter_staffId, $filter_fromDate, $filter_toDate);
        $data['data_get_daily_sales_summary'] = $this->Project_model->getDailySalesActualsSummary($filter_staffId, $filter_fromDate, $filter_toDate);


        $data['data_get_all_staff'] = $this->Project_model->getAllStaff($staffId = '');
        $postToExcel = ($this->input->post('export_to_excel') == "Export to Excel") ? $this->input->post('export_to_excel') : '';
        $postDetailed = ($this->input->post('details') == "View Details") ? $this->input->post('details') : '';
        if ($postToExcel != '') {
            /*redirect('ReportsController/timeSheetExcel');*/

            header("Cache-control: private");
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=ORS_file.xls");
            header("Content-Description: PHP Generated Data");
            header("Pragma: no-cache");
            header("Expires: 0");

            $this->load->view('Reports/dailySalesCallSheet_ReportToExcel_view', $data);


        } else {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('Reports/dailySalesCallSheet_Report_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }

        if ($postDetailed != '') {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('Reports/dailySalesCallSheetDetailed_Report_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }


    }

    public function dailySalesCallSheetDetails()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Reports: Daily Sales Call Report',
            'filter_staffId' => $this->input->post("staffId"),
            'filter_fromDate' => $this->input->post("fromDate"),
            'filter_toDate' => $this->input->post("toDate")

        );
        $this->session->set_userdata($pageAndFilterParameters);

        $filter_staffId = $this->session->userdata['filter_staffId'];
        $filter_fromDate = $this->session->userdata['filter_fromDate'];
        $filter_toDate = $this->session->userdata['filter_toDate'];

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['data_get_staff_name'] = $this->Project_model->getStaffName($filter_staffId);
        $data['get_all_sales_team'] = $this->Sales_model->getAllSalesTeamStaff();

        $data['data_get_daily_sales'] = $this->Project_model->getDailySalesActuals($filter_staffId, $filter_fromDate, $filter_toDate);
        $data['data_get_daily_sales_team'] = $this->Project_model->getDailySalesActualsTeam($filter_staffId, $filter_fromDate, $filter_toDate);
        $data['data_get_daily_sales_summary'] = $this->Project_model->getDailySalesActualsSummary($filter_staffId, $filter_fromDate, $filter_toDate);


        $data['data_get_all_staff'] = $this->Project_model->getAllStaff($staffId = '');
        $postToExcel = ($this->input->post('export_to_excel_details') == "Export to Excel") ? $this->input->post('export_to_excel_details') : '';
        $postDetailed = ($this->input->post('details') == "View Details") ? $this->input->post('details') : '';
        if ($postToExcel != '') {
            /*redirect('ReportsController/timeSheetExcel');*/

            header("Cache-control: private");
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=ORS_Daily_Sales_Report_Details_file.xls");
            header("Content-Description: PHP Generated Data");
            header("Pragma: no-cache");
            header("Expires: 0");

            $this->load->view('Reports/dailySalesCallSheetDetails_ReportToExcel_view', $data);


        } else {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('Reports/dailySalesCallSheetDetailed_Report_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }


    }

    public function salesPipeLine()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Sales Pipeline Report',
            'filter_projectId' => $this->input->post("projectId"),
            'filter_staffId' => $this->input->post("staffId"),
            'filter_fromDate' => $this->input->post("fromDate"),
            'filter_toDate' => $this->input->post("toDate")
        );
        $this->session->set_userdata($pageAndFilterParameters);
        $filter = ($this->input->post('submit') == "Search") ? $this->input->post('submit') : "";

        $filter_projectId = $this->session->userdata['filter_projectId'];
        $filter_staffId = $this->session->userdata['filter_staffId'];
        $filter_fromDate = $this->session->userdata['filter_fromDate'];
        $filter_toDate = $this->session->userdata['filter_toDate'];

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['data_get_all_staff'] = $this->Project_model->getAllStaff($staffId = '');
        $data['data_get_sales_all_staff'] = $this->Sales_model->getAllSalesTeamStaff($staffId = '');

        $config = array();
        $config["base_url"] = base_url() . '/index.php/ReportsController/salesPipeLine';
        $config["total_rows"] = $this->Setups_model->record_count_sales_pipeline_records($filter_staffId);
        $config['per_page'] = "20";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config['per_page'];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['data_get_sales_pipe_line'] = $this->Sales_model->getSalesPipeline($filter_staffId, $config['per_page'], $data['page']);
        $data['pagination'] = $this->pagination->create_links();







        $postToExcel = ($this->input->post('export_to_excel') == "Export to Excel") ? $this->input->post('export_to_excel') : '';
        if ($postToExcel != '') {
            redirect('ReportsController/hoursWorkedExcel');
        } else {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('Reports/salesPipeline_Report_view', $data);

            /*$emailAdress = 'pkagenda@dcareug.com';
            $salutation = 'Team';
            $message = "<p style='font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
            font-size: 14px;
            font-style: normal;
            font-variant: normal;
            font-weight: 500;
            line-height: 26.4px;'>";
            $message .= "Dear  <strong>" . $salutation . "</strong>,<br/>";

            $message .= "
                <table style='color:#171433; font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
            font-size: 14px;
            font-style: normal;
            font-variant: normal;
            font-weight: 500;'  border='1' cellpadding='0' cellspacing='0' width='100%'>
                    <thead>
                    <tr>
                        <th colspan='8'>" . "Sales pipeline Report From: " . appendSuperpositionInteger(1) . " ".date('M').", ".date('Y')."   To: " . appendSuperpositionInteger(date('d')) . " ".date('M').", ".date('Y')."</th>
                    </tr>
                    <tr style='color:#ffffff; background:#171433;' >
                        <th rowspan='2'>#</th>
                        <th rowspan='2'>Client</th>
                        <th rowspan='2'>Sales Executive</th>
                        <th rowspan='2'>Assignment</th>
                        <th rowspan='2'>Contract Amount</th>
                        <th rowspan='2'>Sale Close date</th>
                        <th colspan='2'>Sale Key Dates</th>
                    </tr>
                    <tr style='color:#ffffff; background:#171433;'>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td align='right'>1</td>
                        <td width='30%'>UNBS</td>
                        <td width='30%'>Mugabi Brian</td>
                        <td>&nbsp;</td>
                        <td width='20%' align='right'>-</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align='right'>2</td>
                        <td>Nu-Tec MD MRMS</td>
                        <td width='30%'>Bamwiine Nelson</td>
                        <td>&nbsp;</td>
                        <td align='right'>-</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align='right'>3</td>
                        <td>SopNet-Mwebale</td>
                        <td width='30%'>Wachege Christine</td>
                        <td>&nbsp;</td>
                        <td align='right'>-</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align='right'>4</td>
                        <td>PROMISE ERP</td>
                        <td width='30%'>Mukasa N Joseph</td>
                        <td>M&amp;E</td>
                        <td align='right'>-</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            ";

            $message .= "Please address any queries and/or feedback to:<br/>
            1.ors@dcareug.com<br/>
            2.support@dcareug.com<br/>

            Yours Sincerely;<br/>
            <strong>ORS TEAM</strong><br/>
            Data Care (U) LTD<br/>
            Plot 2A, Kyambogo Drive, off Martyrs Way<br/>
            Ntinda , Kampala Uganda | www.dcareug.com<br/>
            Office:   +256-312-512-246<br/></p>";


            $this->email->from('ors@dcareug.com', 'Test Mail from ORS Sales Module');
            $this->email->to($emailAdress);
            $this->email->cc('aasiimwe@dcareug.com');
            $this->email->bcc('jnmukasa@dcareug.com');
            $this->email->bcc('rmutesi@dcareug.com');
            $this->email->bcc('dkyeyune@dcareug.com');
            $this->email->subject('Test Sales Pipeline Report');
            $this->email->message($message);
            //$this->email->attach(''.$_SERVER["DOCUMENT_ROOT"].'/assets/images/email_graphs/1_Farmers Trained.png'); // attach file
            //$this->email->attach(''.$_SERVER["DOCUMENT_ROOT"].'/assets/images/email_graphs/2_Hectares Under Production.png');

            $this->email->send();*/


            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }


    }


}

/* End of file ReportsController.php */
/* Location: ./application/controllers/ReportsController.php */