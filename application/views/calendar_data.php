<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/18/2016
 * Time: 10:51 AM
 */
?>
<script type="text/javascript">
    $.getScript('<?php echo base_url() ?>/dist/js/fullcalendar.min.js', function () {

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            events: [
                /*daily events*/
                <?php foreach ($get_all_sales_plan as $rPlan){
               $plannedActivity = $rPlan->activity_name;
               $startDate = $rPlan->start_date;
               $endDate = $rPlan->end_date;

               if($startDate==$endDate){
               $time = strtotime($startDate);
               $year='y';
               $month='m';
               $start_date=date("d", $time);
               ?>

                {
                    title: '<?=$plannedActivity;?>',
                    start: new Date(<?=$year;?>, <?=$month;?>, <?=$start_date;?>)
                },


                <?php }
                 }
                 ?>
                /*long plans spin across diferrent days with reference to today*/
                <?php foreach ($get_all_sales_plan as $rPlan){
                  $plannedActivity = $rPlan->activity_name;
                  $startDate = $rPlan->start_date;
                  $endDate = $rPlan->end_date;

               if($startDate!==$endDate){
                  $s_time = strtotime($startDate);
                  $e_time = strtotime($endDate);
                  $year='y';
                  $month='m';
                  $start_date=date("d", $s_time);
                  $end_date=date("d", $e_time);
                  $hrs_start=date("H", $s_time);
                  $hrs_end=date("H", $e_time);

                  $min_start=date("i", $s_time);
                  $min_end=date("i", $e_time);

               ?>

                {
                    title: '<?=$plannedActivity;?>',
                    start: new Date(<?=$year;?>, <?=$month;?>, <?=($start_date);?>,<?=($hrs_start);?>, <?=($hrs_start);?>),
                    end: new Date(<?=$year;?>, <?=$month;?>, <?=($end_date);?>, <?=($hrs_end);?>, <?=($min_end);?>),

                    allDay: false
                },

                <?php
                  }
                  }
                  ?>





                /*repeating event: different Days same event*/
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d - 3, 16, 0),
                    allDay: false
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d + 4, 16, 0),
                    allDay: false
                },
                /*get daily events in different times*/
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false
                },
                /*Get time in minutes and hours of an event*/

                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false
                },

                /*Schedule activity between two or more days of the same month*/
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/'
                }
            ]
        });
    })

</script>