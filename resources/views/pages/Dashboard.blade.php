<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> My Dashboard</span></h1>
    </div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">

    <div class="well">
        <div class="input-group">
            <input class="form-control"  type="text" id="network" name="network" value="{{$valeInput['NETWORK']}}" placeholder="Network" {{$isDisableByRole}}>
            <input type="hidden" name="network_id" id="network_id" value="{{$valeInput['NETWORK_ID']}}">
            <input type="hidden" name="cabang_id" id="cabang_id" value="{{$valeInput['CABANG_ID']}}">
            <div class="input-group-btn">
                <button class="btn btn-default btn-primary" id="btn-refresh-dashboard" type="button">
                    <i class="fa fa-refresh"></i> Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- row -->
    <div class="row">
        <article class="col-sm-12">
            <!-- new widget -->
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"

                -->
                <header>
                    <span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
                    <h2>Cms Dashboard </h2>

                    <ul class="nav nav-tabs pull-right in" id="myTab">
                        <li class="active">
                            <a data-toggle="tab" href="#s1"><i class="fa fa-clock-o"></i> <span class="hidden-mobile hidden-tablet">My Dashboard</span></a>
                        </li>
                    </ul>

                </header>

                <!-- widget div-->
                <div class="no-padding">
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">


                    </div>
                    <!-- end widget edit box -->

                    <div class="widget-body">
                        <!-- content -->
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in padding-10 no-padding-bottom" id="s1">
                                <!-- START BOX -->
                                <div class="row widget-row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="widget-body alert alert-success">
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="1349" style="font-size: 25px"><span class="value_box_total_iuran"></span> {{$COMPLETE}}</span>
                                                </div>
                                                <div class="desc">Total Complete</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="widget-body alert alert-warning">
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="1349" style="font-size: 25px"><span class="value_box_total_iuran"></span> {{$INCOMPLETE}}</span>
                                                </div>
                                                <div class="desc">Total Incomplete</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="widget-body alert alert-danger">

                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="1349" style="font-size: 25px"><span class="value_box_total_iuran"></span> {{$NOT_ATTEMPT}}</span>
                                                </div>
                                                <div class="desc">Total Not Attempt</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="widget-body alert alert-info">

                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="1349" style="font-size: 25px"><span class="value_box_total_iuran"></span> {{$CANCEL}}</span>
                                                </div>
                                                <div class="desc">Total Cancel</div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <!-- END BOX -->

                                <div class="row widget-row">
                                    <div class="col-sm-12">
                                        <hr>
                                        <p>Recomendation per Job - E-Psychotest Result</p>
                                        <input type="hidden" name="network_id" value="{{$cabangId}}" id="network_id">
                                    </div>
                                    <div class="col-sm-12">
                                        <form class="form-inline" role="form">

                                            <fieldset>
                                                <div class="form-group">
                                                    <label><span>Plan Date</span></label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputEmail2">Date From</label>
                                                    <input type="text" class="form-control" id="plan_start_date" name="plan_start_date" placeholder="Date From">
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputPassword2">Date To</label>
                                                    <input type="text" class="form-control plan_end_date" name="plan_end_date" id="plan_end_date" placeholder="Date To">
                                                </div>
                                                <button type="submit" id="btn-search-by-job" class="btn btn-primary">
                                                    Serach
                                                </button>
                                            </fieldset>

                                        </form>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            Above Requirment
                                        </p>
                                        <div class="well no-padding">
                                            <table class="table table-striped table-bordered table-hover" id="table-result-above">
                                                <thead>
                                                <tr>
                                                    <th width="50%">Job Name</th>
                                                    <th width="50%">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            Meet Requirment
                                        </p>
                                        <div class="well no-padding">
                                            <table class="table table-striped table-bordered table-hover" id="table-result-meet">
                                                <thead>
                                                <tr>
                                                    <th width="50%">Job Name</th>
                                                    <th width="50%">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            Below Requirment
                                        </p>
                                        <div class="well no-padding">
                                            <table class="table table-striped table-bordered table-hover" id="table-result-below">
                                                <thead>
                                                <tr>
                                                    <th width="50%">Job Name</th>
                                                    <th width="50%">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="row widget-row">
                                    <div class="col-sm-12">
                                        <hr>
                                        <p>Recomendation per Network per Job - E-Psychotest Result</p>
                                    </div>
                                </div>

                                <div class="row widget-row">
                                    <div class="col-sm-12">
                                        <form class="form-inline" role="form">

                                            <fieldset>
                                                <div class="form-group">
                                                    <label><span>Plan Date</span></label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputEmail2">Date From</label>
                                                    <input type="text" class="form-control date_from" id="date_from" name="date_from" placeholder="Date From">
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputPassword2">Date To</label>
                                                    <input type="text" class="form-control date_to" id="date_to" name="date_to" placeholder="Date To">
                                                </div>
                                                <button type="submit" id="btn-search-by-network" class="btn btn-primary">
                                                    Serach
                                                </button>
                                            </fieldset>

                                        </form>
                                    </div>
                                </div>

                                <div class="row widget-row">
                                    <div class="col-sm-12">
                                        <p>
                                            Above Requirment
                                        </p>
                                        <div class="well no-padding">
                                            <table class="table table-striped table-bordered table-hover table-result-network-above" id="table-result-network-above">
                                                <thead>
                                                <tr>

                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row widget-row">
                                    <div class="col-sm-12">
                                        <p>
                                            Meet Requirment
                                        </p>
                                        <div class="well no-padding">
                                            <table class="table table-striped table-bordered table-hover table-result-network-meet" id="table-result-network-meet">
                                                <thead>
                                                <tr>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row widget-row">
                                    <div class="col-sm-12">
                                        <p>
                                            Below Requirment
                                        </p>
                                        <div class="well no-padding">
                                            <table class="table table-striped table-bordered table-hover table-result-network-below" id="table-result-network-below">
                                                <thead>
                                                <tr>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- START BOX -->
                                <fieldset>
                                    <div class="row widget-row">

                                    </div>
                                </fieldset>
                                <!-- END BOX -->

                            </div>
                            <!-- end s1 tab pane -->
                        </div>

                        <!-- end content -->
                    </div>

                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->

        </article>
    </div>

    <!-- end row -->



</section>
<!-- end widget grid -->

<script>

    $('input[name="network"]').on("blur",function(){
        if($(this).val() == ''){
            $('input[name="network_id"]').val('');
            $('input[name="cabang_id"]').val('');
        }
    });

    $('#plan_start_date').datepicker({
        dateFormat : 'dd-M-yy',
        prevText : '<i class="fa fa-chevron-left"></i>',
        nextText : '<i class="fa fa-chevron-right"></i>',
        onSelect : function(selectedDate) {
            var day = new Date(selectedDate);
            var nextDay = new Date(day);
            nextDay.setDate(day.getDate()+1);
            $('.plan_end_date').datepicker('option', 'minDate', nextDay);
        }
    });
    $('#plan_end_date').datepicker({
        dateFormat : 'dd-M-yy',
        prevText : '<i class="fa fa-chevron-left"></i>',
        nextText : '<i class="fa fa-chevron-right"></i>'
    });


    $('#date_from').datepicker({
        dateFormat : 'dd-M-yy',
        prevText : '<i class="fa fa-chevron-left"></i>',
        nextText : '<i class="fa fa-chevron-right"></i>',
        onSelect : function(selectedDate) {
            var day = new Date(selectedDate);
            var nextDay = new Date(day);
            nextDay.setDate(day.getDate()+1);
            $('.date_to').datepicker('option', 'minDate', nextDay);
        }
    });
    $('#date_to').datepicker({
        dateFormat : 'dd-M-yy',
        prevText : '<i class="fa fa-chevron-left"></i>',
        nextText : '<i class="fa fa-chevron-right"></i>'
    });

    $("#network").autocomplete({
        source : function(request, response) {
            $.ajax({
                type: "POST",
                url : "getNetworks",
                dataType : "json",
                data : {
                    _token : $('input[name="_token"]').val(),
                    networkName : request.term
                },
                success : function(data) {
                    response($.map(data.data_rows, function(item) {
                        return {
                            label : item.networkName,
                            value : item.networkName,
                            valueInput : item.networkId,
                            valueCabangId: item.cabangId
                        }
                    }));
                }
            });
        },
        minLength : 2,
        select : function(event, ui) {
            $('#network_id').val(ui.item.valueInput);
            $('#cabang_id').val(ui.item.valueCabangId);
            console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
        }
    });

    var objByJobAbove = {};

    objByJobAbove["resultBySystem"] = 'ABOVE_REQUIREMENT';
    objByJobAbove["cabangId"] =  $('input[name="cabang_id"]').val();
    objByJobAbove["planDateFrom"] = $('input[name="plan_start_date"]').val();
    objByJobAbove["planDateTo"] = $('input[name="plan_end_date"]').val();

    var table_result_above = $('#table-result-above').DataTable({
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "ajax": {
            "type": "POST",
            "data": function( d ) {

                d._token= $('input[name="_token"]').val();
                d.paramFilters=objByJobAbove;
            },  //{ _token : $('input[name="_token"]').val(),paramFilters:obj},
            "dataType": "JSON",
            "url": "getResultByJob" // ajax source
        },
        "language": {
            "emptyTable": "No data available in table"
        },
        "autoWidth" : true,
        "columns" :[
            {'data':'jobName'},
            {'data':'totalResult'}
        ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    });

    var objByJobMeet = {};

    objByJobMeet["resultBySystem"] = 'MEET_REQUIREMENT';
    objByJobMeet["cabangId"] =  $('input[name="cabang_id"]').val();
    objByJobMeet["planDateFrom"] = $('input[name="plan_start_date"]').val();
    objByJobMeet["planDateTo"] = $('input[name="plan_end_date"]').val();

    var table_result_meet = $('#table-result-meet').DataTable({
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "ajax": {
            "type": "POST",
            "data": function( d ) {

                d._token= $('input[name="_token"]').val();
                d.paramFilters=objByJobMeet;
            },  //{ _token : $('input[name="_token"]').val(),paramFilters:obj},
            "dataType": "JSON",
            "url": "getResultByJob" // ajax source
        },
        "language": {
            "emptyTable": "No data available in table"
        },
        "autoWidth" : true,
        "columns" :[
            {'data':'jobName'},
            {'data':'totalResult'}
        ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    });

    var objByJobBelow = {};

    objByJobBelow["resultBySystem"] = 'BELOW_REQUIREMENT';
    objByJobBelow["cabangId"] =  $('input[name="cabang_id"]').val();
    objByJobBelow["planDateFrom"] = $('input[name="plan_start_date"]').val();
    objByJobBelow["planDateTO"] = $('input[name="plan_end_date"]').val();

    var table_result_below = $('#table-result-below').DataTable({
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "ajax": {
            "type": "POST",
            "data": function( d ) {

                d._token= $('input[name="_token"]').val();
                d.paramFilters=objByJobBelow;
            },  //{ _token : $('input[name="_token"]').val(),paramFilters:obj},
            "dataType": "JSON",
            "url": "getResultByJob" // ajax source
        },
        "language": {
            "emptyTable": "No data available in table"
        },
        "autoWidth" : true,
        "columns" :[
            {'data':'jobName'},
            {'data':'totalResult'}
        ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    });

    $('#btn-search-by-job').on('click', function (e) {
        e.preventDefault();


        objByJobAbove["resultBySystem"] = 'ABOVE_REQUIREMENT';
        objByJobAbove["cabangId"] =  $('input[name="cabang_id"]').val();
        objByJobAbove["planDateFrom"] = $('input[name="plan_start_date"]').val();
        objByJobAbove["planDateTo"] = $('input[name="plan_end_date"]').val();

        console.log(table_result_above.ajax.params());

        table_result_above.ajax.reload();

        objByJobMeet["resultBySystem"] = 'MEET_REQUIREMENT';
        objByJobMeet["cabangId"] =  $('input[name="cabang_id"]').val();
        objByJobMeet["planDateFrom"] = $('input[name="plan_start_date"]').val();
        objByJobMeet["planDateTo"] = $('input[name="plan_end_date"]').val();

        console.log(table_result_meet.ajax.params());

        table_result_meet.ajax.reload();

        objByJobBelow["resultBySystem"] = 'BELOW_REQUIREMENT';
        objByJobBelow["cabangId"] =  $('input[name="cabang_id"]').val();
        objByJobBelow["planDateFrom"] = $('input[name="plan_start_date"]').val();
        objByJobBelow["planDateTo"] = $('input[name="plan_end_date"]').val();

        console.log(table_result_below.ajax.params());

        table_result_below.ajax.reload();

    });

    var obj = {};
    obj["resultBySystem"] = 'ABOVE_REQUIREMENT';
    obj["cabangId"] =  $('input[name="cabang_id"]').val();
    obj["planDateFrom"] = $('input[name="date_from"]').val();
    obj["planDateTo"] = $('input[name="date_to"]').val();

    var dataAboveRequirement,
        tableNameAboveRequirement= '#table-result-network-above',
        columnsAboveRequirement,
        strAboveRequirement,jqxhrAboveRequirement = $.post( "getResultByNetwork",{_token : $('input[name="_token"]').val(),paramFilters:obj})
            .done(function(response) {
                dataAboveRequirement = JSON.parse(response);

                // Iterate each column and print table headers for Datatables
                $.each(dataAboveRequirement.columns, function (k, colObj) {
                    strAboveRequirement = '<th>' + colObj.name + '</th>';
                    $(strAboveRequirement).appendTo(tableNameAboveRequirement+'>thead>tr');
                });

                // Add some Render transformations to Columns
                // Not a good practice to add any of this in API/ Json side
                dataAboveRequirement.columns[0].render = function (data, type, row) {
                    return '<h4>' + data + '</h4>';
                }
                // Debug? console.log(data.columns[0]);

                $(tableNameAboveRequirement).dataTable({
                    "scrollX": true,
                    "data": dataAboveRequirement.data,
                    "columns": dataAboveRequirement.columns,
                    "fnInitComplete": function () {
                        // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                        console.log('Datatable rendering complete');
                    }
                });
            }).fail(function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            });

    var objMeeet = {};
    objMeeet["resultBySystem"] = 'MEET_REQUIREMENT';
    objMeeet["cabangId"] =  $('input[name="cabang_id"]').val();
    objMeeet["planDateFrom"] = $('input[name="date_from"]').val();
    objMeeet["planDateTo"] = $('input[name="date_to"]').val();

    var dataMeetRequirement,
        tableNameMeetRequirement= '#table-result-network-meet',
        columnsMeetRequirement,
        strMeetRequirement,jqxhrMeetRequirement = $.post( "getResultByNetwork",{_token : $('input[name="_token"]').val(),paramFilters:objMeeet})
            .done(function(response) {
                dataMeetRequirement = JSON.parse(response);

                // Iterate each column and print table headers for Datatables
                $.each(dataMeetRequirement.columns, function (k, colObj) {
                    strMeetRequirement = '<th>' + colObj.name + '</th>';
                    $(strMeetRequirement).appendTo(tableNameMeetRequirement+'>thead>tr');
                });

                // Add some Render transformations to Columns
                // Not a good practice to add any of this in API/ Json side
                dataMeetRequirement.columns[0].render = function (data, type, row) {
                    return '<h4>' + data + '</h4>';
                }
                // Debug? console.log(data.columns[0]);

                $(tableNameMeetRequirement).dataTable({
                    "scrollX": true,
                    "data": dataMeetRequirement.data,
                    "columns": dataMeetRequirement.columns,
                    "fnInitComplete": function () {
                        // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                        console.log('Datatable rendering complete');
                    }
                });
            })
            .fail(function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            });

    var objBelowRequirement = {};
    objBelowRequirement["resultBySystem"] = 'BELOW_REQUIREMENT';
    objBelowRequirement["cabangId"] =  $('input[name="cabang_id"]').val();
    objBelowRequirement["planDateFrom"] = $('input[name="date_from"]').val();
    objBelowRequirement["planDateTo"] = $('input[name="date_to"]').val();

    var dataBelowRequirement,
        tableNameBelowRequirement= '.table-result-network-below',
        columnsBelowRequirement,
        strBelowRequirement,jqxhrBelowRequirement = $.post( "getResultByNetwork",{_token : $('input[name="_token"]').val(),paramFilters:objBelowRequirement})
            .done(function(response) {
                dataBelowRequirement = JSON.parse(response);

                // Iterate each column and print table headers for Datatables
                $.each(dataBelowRequirement.columns, function (k, colObj) {
                    strBelowRequirement = '<th>' + colObj.name + '</th>';
                    $(strBelowRequirement).appendTo(tableNameBelowRequirement+'>thead>tr');
                });

                // Add some Render transformations to Columns
                // Not a good practice to add any of this in API/ Json side
                dataBelowRequirement.columns[0].render = function (data, type, row) {
                    return '<h4>' + data + '</h4>';
                }
                // Debug? console.log(data.columns[0]);

                $(tableNameBelowRequirement).dataTable({
                    "scrollX": true,
                    "data": dataBelowRequirement.data,
                    "columns": dataBelowRequirement.columns,
                    "fnInitComplete": function () {
                        // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                        console.log('Datatable rendering complete');
                    }
                });
            })
            .fail(function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            });




    $('#btn-search-by-network').on('click', function (e) {
        e.preventDefault();

        var obj = {};
        obj["resultBySystem"] = 'ABOVE_REQUIREMENT';
        obj["cabangId"] =  $('input[name="cabang_id"]').val();
        obj["planDateFrom"] = $('input[name="date_from"]').val();
        obj["planDateTo"] = $('input[name="date_to"]').val();

        var dataAboveRequirement,
            tableNameAboveRequirement= '#table-result-network-above',
            columnsAboveRequirement,
            strAboveRequirement,jqxhrAboveRequirement = $.post( "getResultByNetwork",{_token : $('input[name="_token"]').val(),paramFilters:obj})
                .done(function(response) {
                    dataAboveRequirement = JSON.parse(response);

                    if ($.fn.DataTable.isDataTable(tableNameAboveRequirement)) {
                        $(tableNameAboveRequirement).DataTable().destroy();
                        $(tableNameAboveRequirement).empty();
                    }


                    var TableHeader = "<thead><tr>";

                    $.each(dataAboveRequirement.columns, function (key, value) {
                        TableHeader += "<th>" + value.name + "</th>"
                    });
                    TableHeader += "</thead></tr>";

                    $(tableNameAboveRequirement).append(TableHeader);

                    $(tableNameAboveRequirement).dataTable({
                        "scrollX": true,
                        "data": dataAboveRequirement.data,
                        "columns": dataAboveRequirement.columns,
                        "fnInitComplete": function () {
                            // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                            console.log('Datatable rendering complete');
                        }
                    });
                }).fail(function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                });

        var objMeeet = {};
        objMeeet["resultBySystem"] = 'MEET_REQUIREMENT';
        objMeeet["cabangId"] =  $('input[name="cabang_id"]').val();
        objMeeet["planDateFrom"] = $('input[name="date_from"]').val();
        objMeeet["planDateTo"] = $('input[name="date_to"]').val();

        var dataMeetRequirement,
            tableNameMeetRequirement= '#table-result-network-meet',
            columnsMeetRequirement,
            strMeetRequirement,jqxhrMeetRequirement = $.post( "getResultByNetwork",{_token : $('input[name="_token"]').val(),paramFilters:objMeeet})
                .done(function(response) {
                    dataMeetRequirement = JSON.parse(response);

                    if ($.fn.DataTable.isDataTable(tableNameMeetRequirement)) {
                        $(tableNameMeetRequirement).DataTable().destroy();
                        $(tableNameMeetRequirement).empty();
                    }


                    var TableHeader = "<thead><tr>";

                    $.each(dataMeetRequirement.columns, function (key, value) {
                        TableHeader += "<th>" + value.name + "</th>"
                    });
                    TableHeader += "</thead></tr>";

                    $(tableNameMeetRequirement).append(TableHeader);

                    $(tableNameMeetRequirement).dataTable({
                        "scrollX": true,
                        "data": dataMeetRequirement.data,
                        "columns": dataMeetRequirement.columns,
                        "fnInitComplete": function () {
                            // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                            console.log('Datatable rendering complete');
                        }
                    });
                })
                .fail(function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                });




        //bellow requirment
        var objBelowRequirement = {};
        objBelowRequirement["resultBySystem"] = 'BELOW_REQUIREMENT';
        objBelowRequirement["cabangId"] =  $('input[name="cabang_id"]').val();
        objBelowRequirement["planDateFrom"] = $('input[name="date_from"]').val();
        objBelowRequirement["planDateTo"] = $('input[name="date_to"]').val();

        var dataBelowRequirement,
            tableNameBelowRequirement= '#table-result-network-below',
            columnsBelowRequirement,
            strBelowRequirement,jqxhrBelowRequirement = $.post( "getResultByNetwork",{_token : $('input[name="_token"]').val(),paramFilters:objBelowRequirement})
                .done(function(response) {

                    if ($.fn.DataTable.isDataTable(tableNameBelowRequirement)) {
                        $(tableNameBelowRequirement).DataTable().destroy();
                        $(tableNameBelowRequirement).empty();
                    }
                    dataBelowRequirement = JSON.parse(response);


                    var TableHeader = "<thead><tr>";

                    $.each(dataBelowRequirement.columns, function (key, value) {
                        TableHeader += "<th>" + value.name + "</th>"
                    });
                    TableHeader += "</thead></tr>";

                    $(tableNameBelowRequirement).append(TableHeader);


                    // Add some Render transformations to Columns
                    // Not a good practice to add any of this in API/ Json side
                    dataBelowRequirement.columns[0].render = function (data, type, row) {
                        return '<h4>' + data + '</h4>';
                    }
                    // Debug? console.log(data.columns[0]);
                    $(tableNameBelowRequirement).dataTable({
                        "scrollX": true,
                        "data": dataBelowRequirement.data,
                        "columns": dataBelowRequirement.columns,
                        "fnInitComplete": function () {
                            // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                            console.log('Datatable rendering complete');
                        }
                    });

                })
                .fail(function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                });


    });




    $('#btn-refresh-dashboard').on('click', function (e) {

        var $btn = $(this);
        $btn.button('loading');

        // wait for animation to finish and execute send script
        setTimeout(function () {


            objByJobAbove["resultBySystem"] = 'ABOVE_REQUIREMENT';
            objByJobAbove["cabangId"] =  $('input[name="cabang_id"]').val();
            objByJobAbove["planDateFrom"] = null;
            objByJobAbove["planDateTo"] = null;

            console.log(table_result_above.ajax.params());

            table_result_above.ajax.reload();



            objByJobMeet["resultBySystem"] = 'MEET_REQUIREMENT';
            objByJobMeet["cabangId"] =  $('input[name="cabang_id"]').val();
            objByJobMeet["planDateFrom"] = null;
            objByJobMeet["planDateTo"] = null;

            console.log(table_result_meet.ajax.params());

            table_result_meet.ajax.reload();

            objByJobBelow["resultBySystem"] = 'BELOW_REQUIREMENT';
            objByJobBelow["cabangId"] =  $('input[name="cabang_id"]').val();
            objByJobBelow["planDateFrom"] = null;
            objByJobBelow["planDateTo"] = null;

            console.log(table_result_below.ajax.params());

            table_result_below.ajax.reload();

            var obj = {};
            obj["resultBySystem"] = 'ABOVE_REQUIREMENT';
            obj["cabangId"] =  $('input[name="cabang_id"]').val();
            obj["planDateFrom"] = null;
            obj["planDateTo"] = null;

            var dataAboveRequirement,
                tableNameAboveRequirement= '#table-result-network-above',
                columnsAboveRequirement,
                strAboveRequirement,jqxhrAboveRequirement = $.post( "getResultByNetwork",{_token : $('input[name="_token"]').val(),paramFilters:obj})
                    .done(function(response) {
                        dataAboveRequirement = JSON.parse(response);

                        if ($.fn.DataTable.isDataTable(tableNameAboveRequirement)) {
                            $(tableNameAboveRequirement).DataTable().destroy();
                            $(tableNameAboveRequirement).empty();
                        }


                        var TableHeader = "<thead><tr>";

                        $.each(dataAboveRequirement.columns, function (key, value) {
                            TableHeader += "<th>" + value.name + "</th>"
                        });
                        TableHeader += "</thead></tr>";

                        $(tableNameAboveRequirement).append(TableHeader);

                        $(tableNameAboveRequirement).dataTable({
                            "scrollX": true,
                            "data": dataAboveRequirement.data,
                            "columns": dataAboveRequirement.columns,
                            "fnInitComplete": function () {
                                // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                                console.log('Datatable rendering complete');
                            }
                        });
                    }).fail(function(jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        console.log(msg);
                    });

            var objMeeet = {};
            objMeeet["resultBySystem"] = 'MEET_REQUIREMENT';
            objMeeet["cabangId"] =  $('input[name="cabang_id"]').val();
            objMeeet["planDateFrom"] = null;
            objMeeet["planDateTo"] = null;

            var dataMeetRequirement,
                tableNameMeetRequirement= '#table-result-network-meet',
                columnsMeetRequirement,
                strMeetRequirement,jqxhrMeetRequirement = $.post( "getResultByNetwork",{_token : $('input[name="_token"]').val(),paramFilters:objMeeet})
                    .done(function(response) {
                        dataMeetRequirement = JSON.parse(response);

                        if ($.fn.DataTable.isDataTable(tableNameMeetRequirement)) {
                            $(tableNameMeetRequirement).DataTable().destroy();
                            $(tableNameMeetRequirement).empty();
                        }


                        var TableHeader = "<thead><tr>";

                        $.each(dataMeetRequirement.columns, function (key, value) {
                            TableHeader += "<th>" + value.name + "</th>"
                        });
                        TableHeader += "</thead></tr>";

                        $(tableNameMeetRequirement).append(TableHeader);

                        $(tableNameMeetRequirement).dataTable({
                            "scrollX": true,
                            "data": dataMeetRequirement.data,
                            "columns": dataMeetRequirement.columns,
                            "fnInitComplete": function () {
                                // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                                console.log('Datatable rendering complete');
                            }
                        });
                    })
                    .fail(function(jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        console.log(msg);
                    });




            //bellow requirment
            var objBelowRequirement = {};
            objBelowRequirement["resultBySystem"] = 'BELOW_REQUIREMENT';
            objBelowRequirement["cabangId"] =  $('input[name="cabang_id"]').val();
            objBelowRequirement["planDateFrom"] = null;
            objBelowRequirement["planDateTo"] = null;

            var dataBelowRequirement,
                tableNameBelowRequirement= '#table-result-network-below',
                columnsBelowRequirement,
                strBelowRequirement,jqxhrBelowRequirement = $.post( "getResultByNetwork",{_token : $('input[name="_token"]').val(),paramFilters:objBelowRequirement})
                    .done(function(response) {

                        if ($.fn.DataTable.isDataTable(tableNameBelowRequirement)) {
                            $(tableNameBelowRequirement).DataTable().destroy();
                            $(tableNameBelowRequirement).empty();
                        }
                        dataBelowRequirement = JSON.parse(response);


                        var TableHeader = "<thead><tr>";

                        $.each(dataBelowRequirement.columns, function (key, value) {
                            TableHeader += "<th>" + value.name + "</th>"
                        });
                        TableHeader += "</thead></tr>";

                        $(tableNameBelowRequirement).append(TableHeader);


                        // Add some Render transformations to Columns
                        // Not a good practice to add any of this in API/ Json side
                        dataBelowRequirement.columns[0].render = function (data, type, row) {
                            return '<h4>' + data + '</h4>';
                        }
                        // Debug? console.log(data.columns[0]);
                        $(tableNameBelowRequirement).dataTable({
                            "scrollX": true,
                            "data": dataBelowRequirement.data,
                            "columns": dataBelowRequirement.columns,
                            "fnInitComplete": function () {
                                // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                                console.log('Datatable rendering complete');
                            }
                        });

                    })
                    .fail(function(jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        console.log(msg);
                    });

            $btn.button('reset');


        }, 1000); // how long do you want the delay to be?



    });




</script>
