
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
                    <h2>View E - Psychotest Schedule </h2>

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

                        <form action="{{url('')}}/psikotestRescheduleProcess" method="post" id="reschedule-form" class="smart-form" novalidate="novalidate">
                            <header>
                                Applicant History
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">Applicant Name</label>
                                            <div class="col col-8">
                                                {!! $valeInput['full_name'] !!}
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">Applicant Id</label>
                                            <div class="col col-8">
                                                {!! $valeInput['applicant_id'] !!}

                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">Birth Date</label>
                                            <div class="col col-8">
                                                {!! $valeInput['birth_date'] !!}
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">KTP</label>
                                            <div class="col col-8">
                                                {!! $valeInput['ktp'] !!}

                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">Another Applicant ID</label>
                                            <div class="col col-8">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Applicant name</th>
                                                            <th>Applicant Id</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{!! $valeInput['full_name'] !!}</td>
                                                            <td>{!! $valeInput['candidate_id'] !!}</td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                    </section>
                                </div>
                            </fieldset>

                            <header>
                                Schedule History
                            </header>
                            <fieldset>

                                <div class="row">
                                    <section class="col col-12">
                                        <div class="product-content product-wrap clearfix product-deatil padding">
                                            <table class="table table-striped table-bordered table-hover table-checkable" width="100%" id="table-schedule-history">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="2%">
                                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                                <span></span>
                                                            </label>
                                                        </th>
                                                        <th width="10%"> Use Job Mapping </th>
                                                        <th width="10%"> Plan Date (From) </th>
                                                        <th width="10%"> Plan Date (To) </th>
                                                        <th width="15%"> Actual Start Date </th>
                                                        <th width="15%"> E-Psychotest Status </th>
                                                        <th width="15%"> Reschedule Reason </th>
                                                        <th width="15%"> Submit Inductive Reasoning </th>
                                                        <th width="15%"> Submit Decductive Reasoning </th>
                                                        <th width="15%"> Submit Reading Comp </th>
                                                        <th width="15%"> Submit Spatial Ability </th>
                                                        <th width="15%"> Submit Arithmatic Ability </th>
                                                        <th width="15%"> Submit Data Memory </th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </section>
                                </div>
                            </fieldset>
                            <header>
                                Schedule
                            </header>
                            @if($textWarning !== '')
                            <fieldset>
                                <div class="alert alert-block alert-danger">
                                    <h4 class="alert-heading">Schedule Validation</h4>
                                    <p>
                                        {{$textWarning}}
                                    </p>
                                </div>
                            </fieldset>
                            @endif
                            <fieldset>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">Effective Date</label>
                                            <div class="col col-4">
                                                <label class="input {{$disableState}}"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="startdate" id="startdate" placeholder="From" {{$isDisable}}>
                                                </label>
                                            </div>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="enddate" id="enddate" placeholder="To" {{$isDisable}}>
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">Use Job Mapping</label>
                                            <div class="col col-8">
                                                <label class="input {{$disableState}}">
                                                    <i class="icon-append fa fa-search"></i>
                                                    <input type="input" name="name" id="name" placeholder="Job Mapping Name" {{$isDisable}}>
                                                    <input type="hidden" name="job_mapping_id" id="job_mapping_id" >

                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">Reschedule Reason</label>
                                            <div class="col col-8">
                                               <label class="select {{$disableState}}">
                                                    <select name="RESCHEDULE_REASON" {{$isDisable}}>
                                                        <option value="0" selected="" disabled="">- Select -</option>
                                                        @foreach($valeInput['RESCHEDULE_REASON'] as $key=>$applicant )
                                                        <option value="{{$applicant['detailCodeLookUp']}}">{{$applicant['meaningLookUp']}}</option>
                                                        @endforeach

                                                    </select><i></i>
                                                </label>
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2"></label>
                                            <div class="col col-8">
                                                <label class="input {{$disableState}}">
                                                    <textarea id="text" class="form-control" name="RESCHEDULE_REASON_TEXT" placeholder="Reschedule Reason" rows="4" {{$isDisable}}></textarea>                                   
                                                </label>
                                            </div>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="candidate_id" value="{{ $valeInput['candidate_id'] }}">
                                <button type="submit" class="btn btn-primary" {{$isDisable}}>
                                    <i class="fa fa-save"></i>
                                    Submit
                                </button>
                                 <a class="btn btn-success" id="peopleEnterBack" href="psikotestschedule">
                                    <i class="fa fa-chevron-left"></i>
                                    Cancel
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

    <script type="text/javascript">


        var errorClass = 'invalid';
        var errorElement = 'em';

        

        var $reviewForm = $("#reschedule-form").validate({
            errorClass      : errorClass,
            errorElement    : errorElement,
            highlight: function(element) {
                $(element).parent().removeClass('state-success').addClass("state-error");
                $(element).removeClass('valid');
            },
            unhighlight: function(element) {
                $(element).parent().removeClass("state-error").addClass('state-success');
                $(element).addClass('valid');
            },
            // Rules for form validation
            rules : {
                startdate : {
                    required : true
                },
                enddate : {
                    required : true
                },
                name : {
                    required : true
                },
                RESCHEDULE_REASON : {
                    required : true

                },
                RESCHEDULE_REASON_TEXT : {
                    required : true

                }

            },

            // Messages for form validation
            messages : {
                
                startdate : {
                    required : 'Plan Start Date must be filled'

                },
                enddate : {
                    required : 'Plan End Date must be filled'                    
                },
                name : {
                    required : 'Job Mapping must be filled' 
                },
                RESCHEDULE_REASON : {
                    required : 'Reschedule Reason Code must be filled'

                },
                RESCHEDULE_REASON_TEXT : {
                    required : 'Reschedule Reason must be filled'

                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });

        $('#startdate').datepicker({
                defaultDate: "+1d",
                minDate:1,
                dateFormat : 'd-M-y',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                dateFormat: 'yy-mm-dd',
                onSelect : function(selectedDate) {
                    var day = new Date(selectedDate);
                    var nextDay = new Date(day);
                    nextDay.setDate(day.getDate()+2);
                    $('.plan_end_date').datepicker('option', 'minDate', nextDay);
                    $('#plan_end_date').datepicker('option', 'maxDate', nextDay);
					$('#enddate').val(nextDay.getFullYear()+'-'+((nextDay.getMonth().toString().length > 1) ? (nextDay.getMonth()+1) : ('0' + (nextDay.getMonth()+1)))+'-'+((nextDay.getDate().toString().length > 1) ? nextDay.getDate() : ('0' + nextDay.getDate())));

                }
            });

        $('#enddate').datepicker({
            dateFormat : 'd-M-y',
            prevText : '<i class="fa fa-chevron-left"></i>',
            nextText : '<i class="fa fa-chevron-right"></i>',
            dateFormat: 'yy-mm-dd',
        });

        $("#peopleEnterBack").click(function(e) {
            e.preventDefault();

            var url = $(this).attr('href');
            loadURL(url, $('#content'));            
        });

        $("#name").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getJobMapping",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        jobMappingName : request.term
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.jobMappingName,
                                value : item.jobMappingName,
                                value_jobid : item.jobMappingId
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $('#job_mapping_id').val(ui.item.value_jobid);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

        $("#city").autocomplete({
            source : function(request, response) {
                $.ajax({
                    url : "http://ws.geonames.org/citiesJSON",
                    dataType : "jsonp",
                    data : {
                        featureClass : "P",
                        style : "full",
                        maxRows : 12,
                        name_startsWith : request.term
                    },
                    success : function(data) {
                        response($.map(data.geonames, function(item) {
                            return {
                                label : item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                                value : item.name
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });


        var table_normatest = $('#table-schedule-history').DataTable({
                    "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                    "oLanguage": {
                        "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
                    },  
                    "autoWidth" : true,
                    "ajax": {
                        "type": "POST",
                        "data":{ _token : $('input[name="_token"]').val(),candidateId : $('input[name="candidate_id"]').val()},
                        "dataType": "JSON",
                        "url": "getScheduleHistory" // ajax source
                    },
                    "order": [
                        [1, "asc"]
                    ]// set first column as a default sort by asc
                });

        $('#initializeDuallistbox').bootstrapDualListbox({
          nonSelectedListLabel: 'Non-selected',
          selectedListLabel: 'Selected',
          preserveSelectionOnMove: 'moved',
          moveOnSelect: false
        });



    
 
        

    </script>

