
    <!-- START ROW -->
    <div class="row">

        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
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
                    <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                    <h2>E - Psychotest Schedule Search </h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                   <!-- widget content -->
                    <div class="widget-body no-padding">

                        <form action="" id="order-form" class="smart-form" novalidate="novalidate">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Applicant Name</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <i class="icon-append fa fa-search"></i>
                                                    <input type="text" name="user_name" id="user_name" placeholder="Applicant Name">
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Network</label>
                                            <div class="col col-8">
                                                 <label class="input {{$disableState}}">
                                                    <i class="icon-append fa fa-search"></i>
                                                    <input type="text" id="network" name="network" value="{{$valeInput['NETWORK']}}" placeholder="Network" {{$isDisableByRole}}>
                                                    <input type="hidden" name="network_id" id="network_id" value="{{$valeInput['NETWORK_ID']}}">
                                                    <input type="hidden" name="cabang_id" id="cabang_id" value="{{$valeInput['CABANG_ID']}}">
                                                </label>
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Applicant Id</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <i class="icon-append fa fa-search"></i>
                                                    <input type="text" name="applicant_id" id="applicant_id" placeholder="Applicant Id<">
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Location</label>
                                            <div class="col col-8">
                                                 <label class="input">
                                                    <i class="icon-append fa fa-search"></i>
                                                     <input type="input" list="loc" name="location" id="location" placeholder="Location" autocomplete="off">                                             
                                                    <input type="hidden" name="city_id" id="city_id" value="">
                                                    <input type="hidden" name="city_gawe_id" id="city_gawe_id" value="">                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">KTP</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <input type="text" name="ktp" maxlength="16" placeholder="KTP">
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Plan Date</label>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="plan_start_date" id="plan_start_date" placeholder="From">
                                                </label>
                                            </div>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="plan_end_date" id="plan_end_date" placeholder="To">
                                                </label>
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">E-Psychotest Status</label>
                                            <div class="col col-8">
                                               <label class="select">
                                                    <select name="test_status">
                                                        <option value="" selected="">- Select -</option>
                                                        <option value="NOT_ATTEMPT">NOT_ATTEMPT</option>
                                                        <option value="COMPLETE">COMPLETE</option>
														<option value="INCOMPLETE">INCOMPLETE</option>
                                                    </select><i></i>
                                                </label>

                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Actual Start Date</label>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="actual_start_date" id="actual_start_date" placeholder="From">
                                                </label>
                                            </div>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="actual_end_date" id="actual_end_date" placeholder="To">
                                                </label>
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Reschedule Reason</label>
                                            <div class="col col-8">
                                                <label class="select">
                                                    <select name="RESCHEDULE_REASON">
                                                         <option value="" selected="" >- Select -</option>
                                                        @foreach($valeInput['RESCHEDULE_REASON'] as $key=>$applicant )
                                                        <option value="{{$applicant['detailCodeLookUp']}}">{{$applicant['meaningLookUp']}}</option>
                                                        @endforeach
                                                    </select><i></i>
                                                </label>

                                            </div>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <button type="submit" id="find-schedule-entry" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>
                                <a href="psikotestscheduleadd" type="button" id="scheduleAdd" class="btn btn-success">
                                    <i class="fa fa-plus"></i>
                                    New
                                </a>
                               
                            </footer>
                        </form>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
        <!-- END COL -->

    </div>

    <!-- END ROW -->

    <!-- START ROW -->
    <div class="row">

        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
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
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2> E - Psychotest Schedule Inquiry </h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">

                        <table class="table table-striped table-bordered table-hover table-checkable" id="table-schedule-inquiry">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">

       <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                    <th width="5%"> Action </th>
                                                    <th> Applicant Name </th>
                                                    <th> Applicant ID </th>
                                                    <th> KTP </th>
                                                    <th> E - Psikotest Status </th>
                                                    <th> Plan Date (From) </th>
                                                    <th> Plan Date (To) </th>
                                                    <th> Actual Start Date </th>
                                                    <th> Total Reschedule </th>
                                                    <th> Reschedule Reason </th>
                                                    <th> Last updated Date </th>
                                                   <th> Last updated By </th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
<!-- MODAL PLACE HOLDER -->
        <div class="modal fade remoteModal" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        <!-- END MODAL -->

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article        <!-- END COL -->

    </div>

    <!-- END ROW -->

    <script type="text/javascript">
        $("#scheduleAdd").click(function(e) {
            e.preventDefault();

            var url = $(this).attr('href');
            loadURL(url, $('#content'));            
        });

			$('#plan_start_date').datepicker({
                dateFormat : 'dd-M-yy',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>'
            });
			$('#plan_end_date').datepicker({
                dateFormat : 'dd-M-yy',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>'
            });
			$('#actual_start_date').datepicker({
                dateFormat : 'dd-M-yy',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>'
            });
			$('#actual_end_date').datepicker({
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
         $("#location").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getLocation",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        locationName : request.term,
                        networkId : $('#network_id').val()
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.city,
                                value : item.city,
                                valueInput : item.city_id,
                                valueCityInput : item.id_city_gawe

                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $('#city_id').val(ui.item.valueInput);
                $('#city_gawe_id').val(ui.item.valueCityInput);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

        $("#user_name").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getUserNamePsikotest",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        userName : request.term
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.name,
                                value : item.name,

                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

        $("#applicant_id").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getUserIdPsikotest",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        applicantId : request.term                   
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.applicantId,
                                value : item.applicantId,
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

        var obj = {};

        var param = {};

        $('input[name="location"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="city_id"]').val('');
                $('input[name="city_gawe_id"]').val('');

            }
        });

        $('input[name="network"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="network_id"]').val('');
                $('input[name="cabang_id"]').val('');
                
            }
        });

        obj["applicantName"] =  $('input[name="user_name"]').val();
        obj["applicantId"] =  $('input[name="applicant_id"]').val();
        obj["ktp"] =  $('input[name="ktp"]').val();
        obj["psikotestStatus"] =  $('select[name="test_status"]').val();
        obj["rescheduleReason"] =  $('select[name="RESCHEDULE_REASON"]').val();
        obj["networkId"] =  $('input[name="cabang_id"]').val();
        obj["locationId"] =  $('input[name="city_id"]').val();
        obj["location"] =  $('input[name="location"]').val();
        obj["planDateFrom"] =  $('input[name="plan_start_date"]').val();
        obj["planDateTo"] =  $('input[name="plan_end_date"]').val();
        obj["actualStartFrom"] =  $('input[name="actual_start_date"]').val();
        obj["actualStartTo"] =  $('input[name="actual_end_date"]').val();

        var subCategoryName = "";
        var table_normatest = $('#table-schedule-inquiry').DataTable({
                    "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                    "oLanguage": {
                        "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
                    },  
                    "autoWidth" : true,
                    "columns" :[
                        {'data':'checkbox'},
                        {'data':'action'},
                        {'data':'applicantName'},
                        {'data':'applicantId'},
                        {'data':'ktp'},
                        {'data':'psikotestStatus'},
                        {'data':'planDateFrom'},
                        {'data':'planDateTo'},
                        {'data':'actualStartFrom'},
                        {'data':'totalReschedule'},
                        {'data':'rescheduleReason'},
                        {'data':'lastUpdateDate'},
                        {'data':'lastUpdateBy'}
                    ],
                    "ajax": {
                        "type": "POST",
                       "data": function( d ) {
                                      
                                  d._token= $('input[name="_token"]').val();
                                  d.paramFilters=obj;
                                },
                        "dataType": "JSON",
                        "url": "getPsikotestSchedulleAll" // ajax source
                    },
                    "order": [
                        [1, "asc"]
                    ]// set first column as a default sort by asc
                });


        $('#table-schedule-inquiry tbody').on( 'click', 'a', function (e) {
            e.preventDefault();
           // console.log($(this).html());
            var url = $(this).attr('href');
            var link_type = $(this).attr('link_type');

            if(link_type === 'reschedule'){
                loadURL(url, $('#content'));
            }
        });


        param["message"] = "Searches might be slow without any parameter. Do you want to continue ?";
        param["title"] = "Find All";

        drawDialogConfirm(table_normatest,param,"find_all");


         $('#find-schedule-entry').on('click', function (e) {
            e.preventDefault();


            obj["applicantName"] =  $('input[name="user_name"]').val();
            obj["applicantId"] =  $('input[name="applicant_id"]').val();
            obj["ktp"] =  $('input[name="ktp"]').val();
            obj["psikotestStatus"] =  $('select[name="test_status"]').val();
			obj["rescheduleReason"] =  $('select[name="RESCHEDULE_REASON"]').val();
            obj["networkId"] =  $('input[name="cabang_id"]').val();
            obj["locationId"] =  $('input[name="city_id"]').val();
            obj["location"] =  $('input[name="location"]').val();
            obj["planDateFrom"] =  $('input[name="plan_start_date"]').val();
            obj["planDateTo"] =  $('input[name="plan_end_date"]').val();
            obj["actualStartFrom"] =  $('input[name="actual_start_date"]').val();
            obj["actualStartTo"] =  $('input[name="actual_end_date"]').val();

            //console.log(table_normatest.ajax.params());
            
            //table_normatest.ajax.reload();

            if(!obj["applicantName"].length && !obj["applicantId"].length && !obj["ktp"].length && !obj["psikotestStatus"].length && !obj["rescheduleReason"].length && !obj["networkId"].length && !obj["locationId"].length && !obj["location"].length ){
                $('#dialog_simple').dialog('open');
            }else{
                console.log(table_normatest.ajax.params());
                table_normatest.ajax.reload();
            }

        });

    </script>
