  <!-- Page level plugin CSS-->
  <link href="assets/css/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet"> 

 
  <style type="text/css">
    .dataTables_info{
      white-space:none !important;
    }
    .form-inline{
      display: block !important;
    }
    .dataTables_scroll{
      margin-top: 10px;
    }
  </style>
  <div id="wrapper"> 
    <div id="content-wrapper"> 
      <div class="container-fluid"> 

        <div class="row"> 
          <div class="col-xl-12 col-sm-12">
             <div class="card mb-12 grid-margin">
              <div class="card-body">  
                    <input class="form-control col-xl-8 col-sm-8"  type="text" id="network" name="network" value="{{$valeInput['NETWORK']}}" placeholder="Network" {{$isDisableByRole}}>
                    <input type="hidden" name="network_id" id="network_id" value="{{$valeInput['NETWORK_ID']}}">
                    <input type="hidden" name="cabang_id" id="cabang_id" value="{{$valeInput['CABANG_ID']}}">
                    <div class="input-group-btn col-xl-4 col-sm-4">
                        <button class="btn btn-default btn-primary" id="btn-refresh-dashboard" type="button">
                            <i class="fa fa-refresh"></i> Refresh
                        </button>
                    </div> 
              </div>
            </div>
          </div>  
        </div>
        <div class="row">
          <div class="col-xl-3 col-sm-6 grid-margin">
            <div class="card bg-gradient-primary o-hidden h-100">
              <div class="card-body more-pad">
                <p class="info-text-title">Total Complete</p>
                <h2 class="info-text-number">{{$COMPLETE}}</h2>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 grid-margin">
            <div class="card bg-gradient-danger o-hidden h-100">
              <div class="card-body more-pad">
                <p class="info-text-title">Total InComplete</p>
                <h2 class="info-text-number">{{$INCOMPLETE}}</h2>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 grid-margin">
            <div class="card bg-gradient-warning o-hidden h-100">
              <div class="card-body more-pad">
                <p class="info-text-title">Total Not Attempt</p>
                <h2 class="info-text-number">{{$NOT_ATTEMPT}}</h2>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 grid-margin">
            <div class="card bg-gradient-info o-hidden h-100">
              <div class="card-body more-pad">
                <p class="info-text-title">Total Cancel</p>
                <h2 class="info-text-number"> {{$CANCEL}}</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row"> 
          <div class="col-xl-12 col-sm-12">
             <div class="card mb-12 grid-margin">
              <div class="card-body"> 
                <form class="form-inline" role="form"> 
                  <fieldset>
                    <div class="form-group col-xl-2">
                        <label><span>Plan Date</span></label>
                    </div>
                    <div class="row">
                      <div class="form-group col-xl-2 col-sm-2">
                          <label class="sr-only" for="exampleInputEmail2">Date From</label>
                          <input type="text" class="form-control" id="plan_start_date" name="plan_start_date" placeholder="Date From">
                      </div>
                      <div class="form-group col-xl-2 col-sm-2">
                          <label class="sr-only" for="exampleInputPassword2">Date To</label>
                          <input type="text" class="form-control plan_end_date" name="plan_end_date" id="plan_end_date" placeholder="Date To">
                      </div>

                      <button type="submit" id="btn-search-by-job" class="btn btn-primary col-xl-2 col-sm-2">
                          Search
                      </button>
                    </div> 
                  </fieldset> 
                </form>
              </div>
            </div>
          </div>  
        </div>
        <div class="row"> 
          <div class="col-xl-4 col-sm-6 grid-margin">
            <div class="card mb-12 grid-margin">
              <div class="card-body">
                <p class="card-title">
                  Above Requirement
                </p> 

                <div class="table-responsive">
                  <table class="table table-bordered" id="table-result-above"  cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Job Name</th>
                        <th>Total</th> 
                      </tr>
                    </thead>
                    <tbody> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> 
          <div class="col-xl-4 col-sm-6 grid-margin">
            <div class="card mb-12 grid-margin">
              <div class="card-body">
                <p class="card-title">
                  Meet Requirement
                </p> 
                <div class="table-responsive">
                  <table class="table table-bordered" id="table-result-meet"  cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Job Name</th>
                        <th>Total</th> 
                      </tr>
                    </thead>
                    <tbody> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> 
          <div class="col-xl-4 col-sm-6 grid-margin">
            <div class="card mb-12 grid-margin">
              <div class="card-body">
                <p class="card-title">
                  Below Requirement
                </p> 
                <div class="table-responsive">
                  <table class="table table-bordered table-bordered table-hover" id="table-result-below"  cellspacing="0" width="100%">
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
          </div> 
        </div>


        <div class="row"> 
          <div class="col-xl-12 col-sm-12">
            <div class="card mb-12 grid-margin">
              <div class="card-body"> 
                <form class="form-inline" role="form"> 
                  <fieldset>
                      <div class="form-group col-xl-2">
                          <label><span>Plan Date</span></label>
                      </div>
                      <div class="row">
                        <div class="form-group col-xl-2 col-sm-2">
                            <label class="sr-only" for="exampleInputEmail2">Date From</label>
                            <input type="text" class="form-control date_from" id="date_from" name="date_from" placeholder="Date From">
                        </div>
                        <div class="form-group col-xl-2 col-sm-2">
                            <label class="sr-only" for="exampleInputPassword2">Date To</label>
                            <input type="text" class="form-control date_to" id="date_to" name="date_to" placeholder="Date To">
                        </div>
                        <button type="submit" id="btn-search-by-network" class="btn btn-primary col-xl-2 col-sm-2">
                            Serach
                        </button>
                      </div>
                  </fieldset>

                </form>
              </div>
            </div>
          </div>  
        </div>
        <div class="row"> 
          <div class="col-xl-12 col-sm-6 grid-margin">
            <div class="card mb-12 grid-margin">
              <div class="card-body">
                <p class="card-title">
                  Above Requirement
                </p> 
                <div class="row col-xl-12" >
                  <label class="col-xl-2 no-padding">
                    Show Column: 
                  </label> 
                  <div class="col-xl-10" id="container-vis-tar">
                       
                  </div>
                 
                </div> 
                <br>
                <div class="table-responsive">
                  <table class="table table-bordered table-result-network-above" id="table-result-network-above"  cellspacing="0" width="100%">
                    <thead>
                      <tr> 
                      </tr>
                    </thead>
                    <tbody> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> 
          <div class="col-xl-12 col-sm-6 grid-margin">
            <div class="card mb-12 grid-margin">
              <div class="card-body">
                <p class="card-title">
                  Meet Requirement
                </p> 
                <div class="row col-xl-12" >
                  <label class="col-xl-2 no-padding">
                    Show Column: 
                  </label> 
                  <div class="col-xl-10" id="container-vis-tmr"> 
                  </div>
                 
                </div> 
                <br>
                <div class="table-responsive">
                  <table class="table table-bordered table-result-network-meet" id="table-result-network-meet"  cellspacing="0" width="100%">
                    <thead>
                      <tr> 
                      </tr>
                    </thead>
                    <tbody> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> 
          <div class="col-xl-12 col-sm-6 grid-margin">
            <div class="card mb-12 grid-margin">
              <div class="card-body">
                <p class="card-title">
                  Below Requirement
                </p> 
                <div class="row col-xl-12" >
                  <label class="col-xl-2 no-padding">
                    Show Column: 
                  </label> 
                  <div class="col-xl-10" id="container-vis-tbr"> 
                  </div>
                 
                </div> 
                <br>
                <div class="table-responsive">
                  <table class="table table-bordered table-result-network-below" id="table-result-network-below"  cellspacing="0" width="100%">
                    <thead>
                      <tr> 
                      </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> 
        </div>  
      </div>
      <!-- /.container-fluid --> 
    </div>
    <!-- /.content-wrapper -->

  </div> 
  <script>

    function generateFilterVisTAR(obj){
       var html ='<div class="form-check form-check-inline">'+
        '<input class="form-check-input toggle-vis-TAR" type="checkbox" id="inlineCheckbox1" value="option1" checked data-column="'+obj.index+'">'+
         '<label class="form-check-label" for="inlineCheckbox1">'+obj.name+'</label>'+
        '</div> ';

        if(obj.index > 0){
          $('#container-vis-tar').append(html);
        }
    } 
    function generateFilterVisTMR(obj){
       var html ='<div class="form-check form-check-inline">'+
        '<input class="form-check-input toggle-vis-tmr" type="checkbox" id="inlineCheckbox1" value="option1" checked data-column="'+obj.index+'">'+
         '<label class="form-check-label" for="inlineCheckbox1">'+obj.name+'</label>'+
        '</div> ';

        if(obj.index > 0){
          $('#container-vis-tmr').append(html);
        }
    } 
    function generateFilterVisTBR(obj){
       var html ='<div class="form-check form-check-inline">'+
        '<input class="form-check-input toggle-vis-tbr" type="checkbox" id="inlineCheckbox1" value="option1" checked data-column="'+obj.index+'">'+
         '<label class="form-check-label" for="inlineCheckbox1">'+obj.name+'</label>'+
        '</div> ';

        if(obj.index > 0){
          $('#container-vis-tbr').append(html);
        }
    } 
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
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-12'f>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-6 'i><'col-sm-6 col-xs-6'p>>",
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
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-12'f>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-6'i><'col-sm-6 col-xs-6'p>>",
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
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-12'f>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-6'i><'col-sm-6 col-xs-6'p>>",
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
                $('#container-vis-tar').html("");
                // Iterate each column and print table headers for Datatables
                $.each(dataAboveRequirement.columns, function (k, colObj) {
                    strAboveRequirement = '<th>' + colObj.name + '</th>';
                    colObj.index = k; 
                    generateFilterVisTAR(colObj);
                    $(strAboveRequirement).appendTo(tableNameAboveRequirement+'>thead>tr');
                });

                // Add some Render transformations to Columns
                // Not a good practice to add any of this in API/ Json side
                dataAboveRequirement.columns[0].render = function (data, type, row) {
                    return '<h4>' + data + '</h4>';
                }
                // Debug? console.log(data.columns[0]);

                var TAR = $(tableNameAboveRequirement).dataTable({
                    "scrollX": true,
                    "data": dataAboveRequirement.data,
                    "columns": dataAboveRequirement.columns,
                    "fnInitComplete": function () {
                        // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                        console.log('Datatable rendering complete 1');
                    }
                }); 
                $('.toggle-vis-TAR').on( 'change', function (e) {  
                    e.preventDefault(); 
                    // Get the column API object
                    var column = TAR.api().columns( $(this).attr('data-column') );
                    
                    // Toggle the visibility
                    column.visible(!column.visible()[0]); 
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
                    colObj.index = k;  
                    generateFilterVisTMR(colObj);
                    strMeetRequirement = '<th>' + colObj.name + '</th>';
                    $(strMeetRequirement).appendTo(tableNameMeetRequirement+'>thead>tr');
                });

                // Add some Render transformations to Columns
                // Not a good practice to add any of this in API/ Json side
                dataMeetRequirement.columns[0].render = function (data, type, row) {
                    return '<h4>' + data + '</h4>';
                }
                // Debug? console.log(data.columns[0]);

                var TMR = $(tableNameMeetRequirement).dataTable({
                    "scrollX": true,
                    "data": dataMeetRequirement.data,
                    "columns": dataMeetRequirement.columns,
                    "fnInitComplete": function () {
                        // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                        console.log('Datatable rendering complete');
                    }
                });

                 $('.toggle-vis-tmr').on( 'change', function (e) {  
                    e.preventDefault(); 
                    // Get the column API object
                    var column = TMR.api().columns( $(this).attr('data-column') );
                    
                    // Toggle the visibility
                    column.visible(!column.visible()[0]); 
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
                   colObj.index = k;  
                    generateFilterVisTBR(colObj);
                    strBelowRequirement = '<th>' + colObj.name + '</th>';
                    $(strBelowRequirement).appendTo(tableNameBelowRequirement+'>thead>tr');
                });

                // Add some Render transformations to Columns
                // Not a good practice to add any of this in API/ Json side
                dataBelowRequirement.columns[0].render = function (data, type, row) {
                    return '<h4>' + data + '</h4>';
                }
                // Debug? console.log(data.columns[0]);

                var TBR = $(tableNameBelowRequirement).dataTable({
                    "scrollX": true,
                    "data": dataBelowRequirement.data,
                    "columns": dataBelowRequirement.columns,
                    "fnInitComplete": function () {
                        // Event handler to be fired when rendering is complete (Turn off Loading gif for example)
                        console.log('Datatable rendering complete');
                    }
                });


                 $('.toggle-vis-tbr').on( 'change', function (e) {  
                    e.preventDefault(); 
                    // Get the column API object
                    var column = TBR.api().columns( $(this).attr('data-column') );
                    
                    // Toggle the visibility
                    column.visible(!column.visible()[0]); 
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
          strMeetRequirement,jqxhrMeetRequirement = $.post("getResultByNetwork",{_token : $('input[name="_token"]').val(),paramFilters:objMeeet})
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


      }, 1000); 


    }); 
</script> 
 
