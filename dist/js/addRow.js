var count = 1;
var nRows = 2;


function addRowSunday(tableId, templateId, rowId) {
    var rowCount =0;
    var currentIndex =rowId;
    var templateSunday = $("#tblTimesheetSunday"+(currentIndex)).find((templateId == null ? "#template-divSunday"+(currentIndex) : "#" + templateId)).html();
    console.log(templateSunday);
    $("#tblTimesheetSunday"+(currentIndex)).find((tableId == null ? "#theBodySunday"+(currentIndex) : "#" + tableId)).append(templateSunday);
    $("#tblTimesheetSunday"+(currentIndex)).find((tableId == null ? "#theBodySunday"+(currentIndex) : "#" + tableId) + " tr#first-of-addRowSunday"+(currentIndex)).each(function (i,d) {

        rowCount++;
        if (rowCount > 1) {
            $(this).find("td#firstCell"+(currentIndex)).eq(0).text(rowCount);


            $(this).find("select,textarea,input").each(function () {
                var id = $(this).attr("name");
                if (id.indexOf("[") > 0) {
                    id = id.substring(0, id.indexOf("["));
                }
                id += rowCount;
                $(this).attr("id", id);
            });


        }
    });
}

function addRowMonday(tableId, templateId, rowId) {
    var rowCount =0;
    var currentIndex =rowId;
    var templateMonday = $("#tblTimesheetMonday"+(currentIndex)).find((templateId == null ? "#template-divMonday"+(currentIndex) : "#" + templateId)).html();
    console.log(templateMonday);
    $("#tblTimesheetMonday"+(currentIndex)).find((tableId == null ? "#theBodyMonday"+(currentIndex) : "#" + tableId)).append(templateMonday);
    $("#tblTimesheetMonday"+(currentIndex)).find((tableId == null ? "#theBodyMonday"+(currentIndex) : "#" + tableId) + " tr#first-of-addRowMonday"+(currentIndex)).each(function (i,d) {

        rowCount++;
        if (rowCount > 1) {
            $(this).find("td#firstCell"+(currentIndex)).eq(0).text(rowCount);


            $(this).find("select,textarea,input").each(function () {
                var id = $(this).attr("name");
                if (id.indexOf("[") > 0) {
                    id = id.substring(0, id.indexOf("["));
                }
                id += rowCount;
                $(this).attr("id", id);
            });


        }
    });
}

function addRowTuesday(tableId, templateId, rowId) {
    var rowCount =0;
    var currentIndex =rowId;
    var templateTuesday = $("#tblTimesheetTuesday"+(currentIndex)).find((templateId == null ? "#template-divTuesday"+(currentIndex) : "#" + templateId)).html();
    console.log(templateTuesday);
    $("#tblTimesheetTuesday"+(currentIndex)).find((tableId == null ? "#theBodyTuesday"+(currentIndex) : "#" + tableId)).append(templateTuesday);
    $("#tblTimesheetTuesday"+(currentIndex)).find((tableId == null ? "#theBodyTuesday"+(currentIndex) : "#" + tableId) + " tr#first-of-addRowTuesday"+(currentIndex)).each(function (i,d) {

        rowCount++;
        if (rowCount > 1) {
            $(this).find("td#firstCell"+(currentIndex)).eq(0).text(rowCount);


            $(this).find("select,textarea,input").each(function () {
                var id = $(this).attr("name");
                if (id.indexOf("[") > 0) {
                    id = id.substring(0, id.indexOf("["));
                }
                id += rowCount;
                $(this).attr("id", id);
            });


        }
    });
}

function addRowWednesday(tableId, templateId, rowId) {
    var rowCount =0;
    var currentIndex =rowId;
    var templateWednesday = $("#tblTimesheetWednesday"+(currentIndex)).find((templateId == null ? "#template-divWednesday"+(currentIndex) : "#" + templateId)).html();
    console.log(templateWednesday);
    $("#tblTimesheetWednesday"+(currentIndex)).find((tableId == null ? "#theBodyWednesday"+(currentIndex) : "#" + tableId)).append(templateWednesday);
    $("#tblTimesheetWednesday"+(currentIndex)).find((tableId == null ? "#theBodyWednesday"+(currentIndex) : "#" + tableId) + " tr#first-of-addRowWednesday"+(currentIndex)).each(function (i,d) {

        rowCount++;
        if (rowCount > 1) {
            $(this).find("td#firstCell"+(currentIndex)).eq(0).text(rowCount);


            $(this).find("select,textarea,input").each(function () {
                var id = $(this).attr("name");
                if (id.indexOf("[") > 0) {
                    id = id.substring(0, id.indexOf("["));
                }
                id += rowCount;
                $(this).attr("id", id);
            });


        }
    });
}

function addRowThursday(tableId, templateId, rowId) {
    var rowCount =0;
    var currentIndex =rowId;
    var templateThursday = $("#tblTimesheetThursday"+(currentIndex)).find((templateId == null ? "#template-divThursday"+(currentIndex) : "#" + templateId)).html();
    console.log(templateThursday);
    $("#tblTimesheetThursday"+(currentIndex)).find((tableId == null ? "#theBodyThursday"+(currentIndex) : "#" + tableId)).append(templateThursday);
    $("#tblTimesheetThursday"+(currentIndex)).find((tableId == null ? "#theBodyThursday"+(currentIndex) : "#" + tableId) + " tr#first-of-addRowThursday"+(currentIndex)).each(function (i,d) {

        rowCount++;
        if (rowCount > 1) {
            $(this).find("td#firstCell"+(currentIndex)).eq(0).text(rowCount);


            $(this).find("select,textarea,input").each(function () {
                var id = $(this).attr("name");
                if (id.indexOf("[") > 0) {
                    id = id.substring(0, id.indexOf("["));
                }
                id += rowCount;
                $(this).attr("id", id);
            });


        }
    });
}

function addRowFriday(tableId, templateId, rowId) {
    var rowCount =0;
    var currentIndex =rowId;
    var templateFriday = $("#tblTimesheetFriday"+(currentIndex)).find((templateId == null ? "#template-divFriday"+(currentIndex) : "#" + templateId)).html();
    console.log(templateFriday);
    $("#tblTimesheetFriday"+(currentIndex)).find((tableId == null ? "#theBodyFriday"+(currentIndex) : "#" + tableId)).append(templateFriday);
    $("#tblTimesheetFriday"+(currentIndex)).find((tableId == null ? "#theBodyFriday"+(currentIndex) : "#" + tableId) + " tr#first-of-addRowFriday"+(currentIndex)).each(function (i,d) {

        rowCount++;
        if (rowCount > 1) {
            $(this).find("td#firstCell"+(currentIndex)).eq(0).text(rowCount);


            $(this).find("select,textarea,input").each(function () {
                var id = $(this).attr("name");
                if (id.indexOf("[") > 0) {
                    id = id.substring(0, id.indexOf("["));
                }
                id += rowCount;
                $(this).attr("id", id);
            });


        }
    });
}

function addRowSaturday(tableId, templateId, rowId) {
    var rowCount =0;
    var currentIndex =rowId;
    var templateSaturday = $("#tblTimesheetSaturday"+(currentIndex)).find((templateId == null ? "#template-divSaturday"+(currentIndex) : "#" + templateId)).html();
    console.log(templateSaturday);
    $("#tblTimesheetSaturday"+(currentIndex)).find((tableId == null ? "#theBodySaturday"+(currentIndex) : "#" + tableId)).append(templateSaturday);
    $("#tblTimesheetSaturday"+(currentIndex)).find((tableId == null ? "#theBodySaturday"+(currentIndex) : "#" + tableId) + " tr#first-of-addRowSaturday"+(currentIndex)).each(function (i,d) {

        rowCount++;
        if (rowCount > 1) {
            $(this).find("td#firstCell"+(currentIndex)).eq(0).text(rowCount);


            $(this).find("select,textarea,input").each(function () {
                var id = $(this).attr("name");
                if (id.indexOf("[") > 0) {
                    id = id.substring(0, id.indexOf("["));
                }
                id += rowCount;
                $(this).attr("id", id);
            });


        }
    });
}



function getElementWithNameLike(Caller, ElementName) {

    return $(Caller).closest("tr").find("input[name^='" + ElementName + "'],select[name^='" + ElementName + "'],textarea[name^='" + ElementName + "']").eq(0);
}
   			
 