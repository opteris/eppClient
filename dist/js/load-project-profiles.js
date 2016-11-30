/**
 * Created by Administrator on 3/9/2016.
 */

$(document).on("hidden.bs.modal", function (e) {
    $(e.target).removeData("bs.modal").find(".modal-content").empty();
});

$(function(){
    $('#loading').hide();
});

function ConfirmStaffDelete(staffId) {
    var r=confirm("Do you want to delete this?")
    url=$(location).attr('href');
  var requiredPath=url.substring(0,url.lastIndexOf("/"))
    if (r==true)
    { window.location = requiredPath+"/deleteStaffMember/"+staffId;

    }else
        return false;

}

$(function(){
    $('[data-toggle="popover"]').popover();

    //$("body").on("click",".modal-footer .btn-primary")
});



function submitSuspectForm(){

    var formData = [];
    $(".modal #suspectModalContent div").each(function (i, d) {

        var row = $(d);
        formData.push({
            activity_date: row.find('input[name="activity_date"]').val(),
            first_contact: row.find('textarea[name="first_contact"]').val(),
            company_name: row.find('textarea[name="company_name"]').val(),
            client_location: row.find('textarea[name="client_location"]').val(),
            prospectType: row.find('select[name="prospectType"]').val(),
            sectorType: row.find('select[name="sectorType"]').val(),
            prj_category: row.find('select[name="prj_category"]').val(),
            client_using_competitor_product_no: row.find('input[name="client_using_competitor_product_no"]').val(),
            desc_competitor_product: row.find('input[name="desc_competitor_product"]').val(),
            client_already_using_our_product: row.find('input[name="client_already_using_our_product"]').val(),
            desc_inhouse_product: row.find('select[name="desc_inhouse_product"]').val(),
            client_contact: row.find('textarea[name="client_contact"]').val(),
            call_comment: row.find('textarea[name="call_comment"]').val(),
            next_follow_up_date: row.find('textarea[name="next_follow_up_date"]').val(),

        });

    });

    var urlString = $(location).attr('href');
    var requiredPath = urlString.substring(0, urlString.lastIndexOf("/"));
    var finalUrl = requiredPath + "/addDailySalesSheet/";


    $.post(finalUrl, $("#suspectModalContent").closest("form").serialize(), function (msg) {
        console.log(msg);
        if (msg.substring(0, 3) == 'YES') {

            $('.errorMsgSuspect#alert-msg').html('<div class="alert alert-success text-center">Suspect Data logged successfully!</div>');

        }
        else if (msg.substring(0, 2) == 'NO')
            $('.errorMsgSuspect#alert-msg').html('<div class="alert alert-success text-center">Suspect Data logged successfully!</div>');
        else
            $('.errorMsgSuspect#alert-msg').html('<div class="alert alert-danger text-left">' + '' + msg + '</div>');
    });


    return false;

}


function submitSundayTimesheet(rowid){

        var formData = [];
        $(".modal #theBodySunday"+rowid+" tr").each(function (i, d) {
            var row = $(d);
            formData.push({
                staffId: row.find('select[name="staffId[]"]').val(),
                loopkey: row.find('input[name="loopkey[]"]').val(),
                projectId: row.find('input[name="projectId[]"]').val(),
                milestoneId: row.find('input[name="milestoneId[]"]').val(),
                activityId: row.find('input[name="activityId[]"]').val(),
                subactivityId: row.find('input[name="subactivityId[]"]').val(),
                Date: row.find('input[name="Date[]"]').val(),
                day: row.find('input[name="day[]"]').val(),
                taskDescription: row.find('textarea[name="taskDescription[]"]').val(),
                plannedHours: row.find('input[name="plannedHours[]"]').val(),
                hoursSpent: row.find('input[name="hoursSpent[]"]').val(),
                comment: row.find('textarea[name="comment[]"]').val(),
                statusCode: row.find('select[name="statusCode[]"]').val(),


            });
        });

        var urlString = $(location).attr('href');
        var requiredPath = urlString.substring(0, urlString.lastIndexOf("/"));
        var finalUrl = requiredPath + "/submitTimeSheet/";


        $.post(finalUrl, $("#theBodySunday"+rowid).closest("form").serialize(), function (msg) {
            if (msg.substring(0, 3) == 'YES') {

                $("#theBodySunday"+rowid).closest("table").remove();
                $("#addTask").remove();
                $('.errorMsgSunday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
                $("#theBodySunday"+rowid).closest("#form_timeSheetSunday"+rowid)[0].reset();
            }
            else if (msg.substring(0, 2) == 'NO')
                $('.errorMsgSunday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
            else
                $('.errorMsgSunday'+rowid+'#alert-msg').html('<div class="alert alert-danger text-left">' + '' + msg + '</div>');
        });


        return false;

}

function submitMondayTimesheet(rowid){

        var formData = [];
        $(".modal #theBodyMonday"+rowid+" tr").each(function (i, d) {
            var row = $(d);
            formData.push({
                staffId: row.find('select[name="staffId[]"]').val(),
                loopkey: row.find('input[name="loopkey[]"]').val(),
                projectId: row.find('input[name="projectId[]"]').val(),
                milestoneId: row.find('input[name="milestoneId[]"]').val(),
                activityId: row.find('input[name="activityId[]"]').val(),
                subactivityId: row.find('input[name="subactivityId[]"]').val(),
                Date: row.find('input[name="Date[]"]').val(),
                day: row.find('input[name="day[]"]').val(),
                taskDescription: row.find('textarea[name="taskDescription[]"]').val(),
                plannedHours: row.find('input[name="plannedHours[]"]').val(),
                hoursSpent: row.find('input[name="hoursSpent[]"]').val(),
                comment: row.find('textarea[name="comment[]"]').val(),
                statusCode: row.find('select[name="statusCode[]"]').val(),


            });
        });

        var urlString = $(location).attr('href');
        var requiredPath = urlString.substring(0, urlString.lastIndexOf("/"));
        var finalUrl = requiredPath + "/submitTimeSheet/";


        $.post(finalUrl, $("#theBodyMonday"+rowid).closest("form").serialize(), function (msg) {
            if (msg.substring(0, 3) == 'YES') {

                $("#theBodyMonday"+rowid).closest("table").remove();
                $("#addTask").remove();
                $('.errorMsgMonday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
                $("#theBodyMonday"+rowid).closest("#form_timeSheetMonday"+rowid)[0].reset();
            }
            else if (msg.substring(0, 2) == 'NO')
                $('.errorMsgMonday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
            else
                $('.errorMsgMonday'+rowid+'#alert-msg').html('<div class="alert alert-danger text-left">' + '' + msg + '</div>');
        });


        return false;

}

function submitTuesdayTimesheet(rowid){

        console.log('clicked submit button');
        var formData = [];
        $(".modal #theBodyTuesday"+rowid+" tr").each(function (i, d) {
            var row = $(d);
            formData.push({
                staffId: row.find('select[name="staffId[]"]').val(),
                loopkey: row.find('input[name="loopkey[]"]').val(),
                projectId: row.find('input[name="projectId[]"]').val(),
                milestoneId: row.find('input[name="milestoneId[]"]').val(),
                activityId: row.find('input[name="activityId[]"]').val(),
                subactivityId: row.find('input[name="subactivityId[]"]').val(),
                Date: row.find('input[name="Date[]"]').val(),
                day: row.find('input[name="day[]"]').val(),
                taskDescription: row.find('textarea[name="taskDescription[]"]').val(),
                plannedHours: row.find('input[name="plannedHours[]"]').val(),
                hoursSpent: row.find('input[name="hoursSpent[]"]').val(),
                comment: row.find('textarea[name="comment[]"]').val(),
                statusCode: row.find('select[name="statusCode[]"]').val(),


            });
        });

        var urlString = $(location).attr('href');
        var requiredPath = urlString.substring(0, urlString.lastIndexOf("/"));
        var finalUrl = requiredPath + "/submitTimeSheet/";


        $.post(finalUrl, $("#theBodyTuesday"+rowid).closest("form").serialize(), function (msg) {
            if (msg.substring(0, 3) == 'YES') {

                $("#theBodyTuesday"+rowid).closest("table").remove();
                $("#addTask").remove();
                $('.errorMsgTuesday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
                $("#theBodyTuesday"+rowid).closest("#form_timeSheetTuesday"+rowid)[0].reset();
            }
            else if (msg.substring(0, 2) == 'NO')
                $('.errorMsgTuesday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
            else
                $('.errorMsgTuesday'+rowid+'#alert-msg').html('<div class="alert alert-danger text-left">' + '' + msg + '</div>');
        });


        return false;

}

function submitWednesdayTimesheet(rowid){

        console.log('clicked submit button');
        var formData = [];
        $(".modal #theBodyWednesday"+rowid+" tr").each(function (i, d) {
            var row = $(d);
            formData.push({
                staffId: row.find('select[name="staffId[]"]').val(),
                loopkey: row.find('input[name="loopkey[]"]').val(),
                projectId: row.find('input[name="projectId[]"]').val(),
                milestoneId: row.find('input[name="milestoneId[]"]').val(),
                activityId: row.find('input[name="activityId[]"]').val(),
                subactivityId: row.find('input[name="subactivityId[]"]').val(),
                Date: row.find('input[name="Date[]"]').val(),
                day: row.find('input[name="day[]"]').val(),
                taskDescription: row.find('textarea[name="taskDescription[]"]').val(),
                plannedHours: row.find('input[name="plannedHours[]"]').val(),
                hoursSpent: row.find('input[name="hoursSpent[]"]').val(),
                comment: row.find('textarea[name="comment[]"]').val(),
                statusCode: row.find('select[name="statusCode[]"]').val(),


            });
        });

        var urlString = $(location).attr('href');
        var requiredPath = urlString.substring(0, urlString.lastIndexOf("/"));
        var finalUrl = requiredPath + "/submitTimeSheet/";


        $.post(finalUrl, $("#theBodyWednesday"+rowid).closest("form").serialize(), function (msg) {
            if (msg.substring(0, 3) == 'YES') {

                $("#theBodyWednesday"+rowid).closest("table").remove();
                $("#addTask").remove();
                $('.errorMsgWednesday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
                $("#theBodyWednesday"+rowid).closest("#form_timeSheetWednesday"+rowid)[0].reset();
            }
            else if (msg.substring(0, 2) == 'NO')
                $('.errorMsgWednesday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
            else
                $('.errorMsgWednesday'+rowid+'#alert-msg').html('<div class="alert alert-danger text-left">' + '' + msg + '</div>');
        });


        return false;

}

function submitThursdayTimesheet(rowid){

        console.log('clicked submit button');
        var formData = [];
        $(".modal #theBodyThursday"+rowid+" tr").each(function (i, d) {
            var row = $(d);
            formData.push({
                staffId: row.find('select[name="staffId[]"]').val(),
                loopkey: row.find('input[name="loopkey[]"]').val(),
                projectId: row.find('input[name="projectId[]"]').val(),
                milestoneId: row.find('input[name="milestoneId[]"]').val(),
                activityId: row.find('input[name="activityId[]"]').val(),
                subactivityId: row.find('input[name="subactivityId[]"]').val(),
                Date: row.find('input[name="Date[]"]').val(),
                day: row.find('input[name="day[]"]').val(),
                taskDescription: row.find('textarea[name="taskDescription[]"]').val(),
                plannedHours: row.find('input[name="plannedHours[]"]').val(),
                hoursSpent: row.find('input[name="hoursSpent[]"]').val(),
                comment: row.find('textarea[name="comment[]"]').val(),
                statusCode: row.find('select[name="statusCode[]"]').val(),


            });
        });

        var urlString = $(location).attr('href');
        var requiredPath = urlString.substring(0, urlString.lastIndexOf("/"));
        var finalUrl = requiredPath + "/submitTimeSheet/";


        $.post(finalUrl, $("#theBodyThursday"+rowid).closest("form").serialize(), function (msg) {
            if (msg.substring(0, 3) == 'YES') {

                $("#theBodyThursday"+rowid).closest("table").remove();
                $("#addTask").remove();
                $('.errorMsgThursday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
                $("#theBodyThursday"+rowid).closest("#form_timeSheetThursday"+rowid)[0].reset();
            }
            else if (msg.substring(0, 2) == 'NO')
                $('.errorMsgThursday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
            else
                $('.errorMsgThursday'+rowid+'#alert-msg').html('<div class="alert alert-danger text-left">' + '' + msg + '</div>');
        });


        return false;

}

function submitFridayTimesheet(rowid){

        console.log('clicked submit button');
        var formData = [];
        $(".modal #theBodyFriday"+rowid+" tr").each(function (i, d) {
            var row = $(d);
            formData.push({
                staffId: row.find('select[name="staffId[]"]').val(),
                loopkey: row.find('input[name="loopkey[]"]').val(),
                projectId: row.find('input[name="projectId[]"]').val(),
                milestoneId: row.find('input[name="milestoneId[]"]').val(),
                activityId: row.find('input[name="activityId[]"]').val(),
                subactivityId: row.find('input[name="subactivityId[]"]').val(),
                Date: row.find('input[name="Date[]"]').val(),
                day: row.find('input[name="day[]"]').val(),
                taskDescription: row.find('textarea[name="taskDescription[]"]').val(),
                plannedHours: row.find('input[name="plannedHours[]"]').val(),
                hoursSpent: row.find('input[name="hoursSpent[]"]').val(),
                comment: row.find('textarea[name="comment[]"]').val(),
                statusCode: row.find('select[name="statusCode[]"]').val(),


            });
        });

        var urlString = $(location).attr('href');
        var requiredPath = urlString.substring(0, urlString.lastIndexOf("/"));
        var finalUrl = requiredPath + "/submitTimeSheet/";


        $.post(finalUrl, $("#theBodyFriday"+rowid).closest("form").serialize(), function (msg) {
            if (msg.substring(0, 3) == 'YES') {

                $("#theBodyFriday"+rowid).closest("table").remove();
                $("#addTask").remove();
                $('.errorMsgFriday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
                $("#theBodyFriday"+rowid).closest("#form_timeSheetFriday"+rowid)[0].reset();
            }
            else if (msg.substring(0, 2) == 'NO')
                $('.errorMsgFriday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
            else
                $('.errorMsgFriday'+rowid+'#alert-msg').html('<div class="alert alert-danger text-left">' + '' + msg + '</div>');
        });


        return false;

}

function submitSaturdayTimesheet(rowid){

        console.log('clicked submit button');
        var formData = [];
        $(".modal #theBodySaturday"+rowid+" tr").each(function (i, d) {
            var row = $(d);
            formData.push({
                staffId: row.find('select[name="staffId[]"]').val(),
                loopkey: row.find('input[name="loopkey[]"]').val(),
                projectId: row.find('input[name="projectId[]"]').val(),
                milestoneId: row.find('input[name="milestoneId[]"]').val(),
                activityId: row.find('input[name="activityId[]"]').val(),
                subactivityId: row.find('input[name="subactivityId[]"]').val(),
                Date: row.find('input[name="Date[]"]').val(),
                day: row.find('input[name="day[]"]').val(),
                taskDescription: row.find('textarea[name="taskDescription[]"]').val(),
                plannedHours: row.find('input[name="plannedHours[]"]').val(),
                hoursSpent: row.find('input[name="hoursSpent[]"]').val(),
                comment: row.find('textarea[name="comment[]"]').val(),
                statusCode: row.find('select[name="statusCode[]"]').val(),


            });
        });

        var urlString = $(location).attr('href');
        var requiredPath = urlString.substring(0, urlString.lastIndexOf("/"));
        var finalUrl = requiredPath + "/submitTimeSheet/";


        $.post(finalUrl, $("#theBodySaturday"+rowid).closest("form").serialize(), function (msg) {
            if (msg.substring(0, 3) == 'YES') {

                $("#theBodySaturday"+rowid).closest("table").remove();
                $("#addTask").remove();
                $('.errorMsgSaturday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
                $("#theBodySaturday"+rowid).closest("#form_timeSheetSaturday"+rowid)[0].reset();
            }
            else if (msg.substring(0, 2) == 'NO')
                $('.errorMsgSaturday'+rowid+'#alert-msg').html('<div class="alert alert-success text-center">Your Timesheet has been sent successfully!</div>');
            else
                $('.errorMsgSaturday'+rowid+'#alert-msg').html('<div class="alert alert-danger text-left">' + '' + msg + '</div>');
        });


        return false;

}



$(function () {
    $('#filter_timeSheet select[name=filter_TS_projectId]').change(function(){
        $("#submit").click();
    });

    $('#filter_timeSheet select[name=filter_TS_milestoneId]').change(function(){
        $("#submit").click();
    });

    $('#filter_timeSheet select[name=filter_TS_activityId]').change(function(){
        $("#submit").click();
    });

    $('.modal').on('hidden.bs.modal', function(e)
    {
        $(this).removeData();
    }) ;

/*submitting permissions*/
    $('#filter_permissions select[id=ugroup]').change(function(){
        $("#submit").click();
    });



});

$(function () {

$('.calendar.day').click(
    function(){


        day_num = $(this).find('.day_num').html();
        day_data = prompt('Enter day\'s Activity',$(this).find('.content').html());
        myUrl =window.location;
        methodType='POST';if(day_data != null){
             $.ajax({
                url: myUrl,
                 type: methodType,
                 data:{
                     day: day_num,
                     data_day: day_data
                 },
                 success: function(msg){
                     location.reload(true);
                 },

             });


         }
    }
);

});

$(".datepicker.present").datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    endDate: new Date(2016,1,1)
});

$(function(){
    $('tbody a[id^="Sunday"]').each(
        function(i){
            this.id = 'Sunday' + (i+1);

            $(".timesheetSunday").attr("id","timesheetSunday"+ (i + 1));
            $("#tblTimesheetSunday").attr("id","tblTimesheetSunday"+ (i + 1));
            $(".form_timeSheetSunday").attr("id","form_timeSheetSunday"+ (i + 1));
            $("#template-divSunday").attr("id","template-divSunday" + (i + 1));
            $("#theBodySunday").attr("id","theBodySunday" + (i + 1));


        });
});

$(function(){
    $('tbody a[id^="Monday"]').each(
        function(i){
            this.id = 'Monday' + (i+1);

            $(".timesheetMonday").attr("id","timesheetMonday"+ (i + 1));
            $("#tblTimesheetMonday").attr("id","tblTimesheetMonday"+ (i + 1));
            $(".form_timeSheetMonday").attr("id","form_timeSheetMonday"+ (i + 1));
            $("#template-divMonday").attr("id","template-divMonday" + (i + 1));
            $("#theBodyMonday").attr("id","theBodyMonday" + (i + 1));


        });
});

$(function(){
    $('tbody a[id^="Tuesday"]').each(
        function(i){
            this.id = 'Tuesday' + (i+1);

            $(".timesheetTuesday").attr("id","timesheetTuesday"+ (i + 1));
            $("#tblTimesheetTuesday").attr("id","tblTimesheetTuesday"+ (i + 1));
            $(".form_timeSheetTuesday").attr("id","form_timeSheetTuesday"+ (i + 1));
            $("#template-divTuesday").attr("id","template-divTuesday" + (i + 1));
            $("#theBodyTuesday").attr("id","theBodyTuesday" + (i + 1));


        });
});

$(function(){
    $('tbody a[id^="Wednesday"]').each(
        function(i){
            this.id = 'Wednesday' + (i+1);

            $(".timesheetWednesday").attr("id","timesheetWednesday"+ (i + 1));
            $("#tblTimesheetWednesday").attr("id","tblTimesheetWednesday"+ (i + 1));
            $(".form_timeSheetWednesday").attr("id","form_timeSheetWednesday"+ (i + 1));
            $("#template-divWednesday").attr("id","template-divWednesday" + (i + 1));
            $("#theBodyWednesday").attr("id","theBodyWednesday" + (i + 1));


        });
});

$(function(){
    $('tbody a[id^="Thursday"]').each(
        function(i){
            this.id = 'Thursday' + (i+1);

            $(".timesheetThursday").attr("id","timesheetThursday"+ (i + 1));
            $("#tblTimesheetThursday").attr("id","tblTimesheetThursday"+ (i + 1));
            $(".form_timeSheetThursday").attr("id","form_timeSheetThursday"+ (i + 1));
            $("#template-divThursday").attr("id","template-divThursday" + (i + 1));
            $("#theBodyThursday").attr("id","theBodyThursday" + (i + 1));


        });
});

$(function(){
    $('tbody a[id^="Friday"]').each(
        function(i){
            this.id = 'Friday' + (i+1);

            $(".timesheetFriday").attr("id","timesheetFriday"+ (i + 1));
            $("#tblTimesheetFriday").attr("id","tblTimesheetFriday"+ (i + 1));
            $(".form_timeSheetFriday").attr("id","form_timeSheetFriday"+ (i + 1));
            $("#template-divFriday").attr("id","template-divFriday" + (i + 1));
            $("#theBodyFriday").attr("id","theBodyFriday" + (i + 1));


        });
});

$(function(){
    $('tbody a[id^="Saturday"]').each(
        function(i){
            this.id = 'Saturday' + (i+1);

            $(".timesheetSaturday").attr("id","timesheetSaturday"+ (i + 1));
            $("#tblTimesheetSaturday").attr("id","tblTimesheetSaturday"+ (i + 1));
            $(".form_timeSheetSaturday").attr("id","form_timeSheetSaturday"+ (i + 1));
            $("#template-divSaturday").attr("id","template-divSaturday" + (i + 1));
            $("#theBodySaturday").attr("id","theBodySaturday" + (i + 1));


        });
});







