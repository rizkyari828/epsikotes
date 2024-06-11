 <!-- START ROW -->
    <div class="row">

        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                    <h2>Psikotest Result Search</h2>

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

                        <form action="javascript:void(0)" id="Search-form" class="smart-form" onsubmit="return validateNull();">
                            <fieldset>
                                <div class="row" style="margin-left: 0px;">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="full_name" class="label col col-3" style="text-align: right;">Applicant Name</label>
                                            <section class="col col-8">
                                                <label class="input"> 
                                                    <input type="text" list="full_namea" name="full_name" id="full_name" placeholder="Applicant Name" autocomplete="off">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <label for="applicant_id" class="label col col-3" style="text-align: right;">Applicant Id</label>
                                            <section class="col col-8">
                                                <label class="input"> 
                                                    <input type="text" list="appId" name="applicant_id" id="applicant_id" placeholder="Applicant Id" autocomplete="off">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <label for="ktp" class="label col col-3" style="text-align: right;">KTP</label>
                                            <section class="col col-8">
                                                <label class="input"> 
                                                    <input type="text" name="ktp" list="noktp" id="ktp" placeholder="No KTP" autocomplete="off" maxlength="16">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <label for="psikotest_result" class="label col col-3" style="text-align: right;">Psikotest Result</label>
                                            <section class="col col-8">
                                                <select id="psi_result" name="psi_result" class="form-control">
                                                    <option value="">- Select -</option>
                                                    <option value="COMPLETE">COMPLETE</option>
                                                    <option value="INCOMPLETE">INCOMPLETE</option>
                                                    <option value="NOT_ATTEMPT">NOT ATTEMPT</option>
                                                    <option value="CANCEL">CANCEL</option>
                                                </select>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <label for="recomendation" class="label col col-3" style="text-align: right;">Recomendation</label>
                                            <section class="col col-8">
                                                <select id="recomendation" name="recomendation" class="form-control">
                                                    <option value="">- Select -</option>
                                                    <option value="ABOVE_REQUIREMENT">ABOVE REQUIREMENT</option>
                                                    <option value="MEET_REQUIREMENT">MEET REQUIREMENT</option>
                                                    <option value="BELLOW_REQUIREMENT">BELLOW REQUIREMENT</option>
                                                </select>
                                            </section>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="margin-left: 0px;">
                                        <div class="row">
                                            <label for="Network" class="label col col-3" style="text-align: right;">Network</label>
                                            <section class="col col-9">
                                                <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="input" list="Listnetwork" name="network" id="network" placeholder="Network" autocomplete="off">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <label for="Location" class="label col col-3" style="text-align: right;">Location</label>
                                            <section class="col col-9">
                                                <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="input" list="loc" name="location" id="location" placeholder="Location" autocomplete="off">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <label for="date" class="label col col-3" style="text-align: right;">Plan Date</label>
                                            <section class="col col-4">
                                                <label class="input">
                                                    <input class="form-control" type="date" name="planDateFrom" placeholder="Date" id="planDateFrom">
                                                </label>
                                            </section>
                                            <div class="col">to</div>
                                            <section class="col col-4">
                                                <label class="input">
                                                    <input class="form-control" type="date" name="planDateTo" placeholder="Date" id="planDateTo">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <label for="actualdatefrom" class="label col col-3" style="text-align: right;">Start Actual Date</label>
                                            <section class="col col-4">
                                                <label class="input">
                                                    <input class="form-control" type="date" name="startDateFrom" placeholder="Date" id="startDateFrom">
                                                </label>
                                            </section>
                                            <div class="col">to</div>
                                            <section class="col col-4">
                                                <label class="input">
                                                    <input class="form-control" type="date" name="startDateTo" placeholder="Date" id="startDateTo">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <label for="jobName" class="label col col-3" style="text-align: right;">Job Name</label>
                                            <section class="col col-9">
                                                <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="input" list="Listjobs" name="jobName" id="jobName" placeholder="Location" autocomplete="off">
                                                </label>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                                
                            </fieldset>
                            <footer>
                                <button type="submit" id="findBtn" class="btn btn-primary">
                                    Search
                                </button>
                                <button type="submit" class="btn">
                                    <a href="#" id="downloadBtn" target="_blank">
                                        Download
                                    </a>
                                </button>
                            </footer>
                        </form>
                        <datalist id="full_namea">
                            @foreach($applicantData as $key => $value)
                                <option value="{{$value->FULL_NAME}}">{{$value->FULL_NAME}}</option>
                            @endforeach
                        </datalist>
                        <datalist id="appId">
                            @foreach($applicantData as $key => $value)
                                <option value="{{$value->APPLICANT_ID}}">{{$value->APPLICANT_ID}}</option>
                            @endforeach
                        </datalist>
                        <datalist id="noktp">
                            @foreach($applicantData as $key => $value)
                                <option value="{{$value->KTP}}">{{$value->KTP}}</option>
                            @endforeach
                        </datalist>
                        <datalist id="loc">
                            @foreach($location as $key => $value)
                                <option value="{{$value->CITY}}">{{$value->CITY}}</option>
                            @endforeach
                        </datalist>
                        <datalist id="Listnetwork">
                            @foreach($network as $key => $value)
                                <option value="{{$value->NETWORK}}">{{$value->NETWORK}}</option>
                            @endforeach
                        </datalist>
                        <datalist id="Listjobs">
                            @foreach($jobs as $key => $value)
                                <option value="{{$value->NAME}}">{{$value->NAME}}</option>
                            @endforeach
                        </datalist>

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
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Psikotest Result Inquiry </h2>
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                    </div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_result">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th> Action </th>
                                                    <th> Applicant Name </th>
                                                    <th> Applicant Id </th>
                                                    <th> KTP</th>
                                                    <th> E-Psikotest Status </th>
                                                    <th> Plan Date (from) </th>
                                                    <th> Plan Date (to) </th>
                                                   <th> Start Actual Date </th>
                                                   <th> Total Reschedule </th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> 1a </td>
                                                    <td> 1b </td>
                                                    <td> 1c </td>
                                                    <td> 1d </td>
                                                    <td> 1e </td>
                                                    <td> 1f </td>
                                                    <td> 1g </td>
                                                    <td> 1h </td>
                                                    <td> 1i </td>
                                                </tr>
                                                <tr>
                                                    <td> 2a </td>
                                                    <td> 3b </td>
                                                    <td> 4c </td>
                                                    <td> 5d </td>
                                                    <td> 6e </td>
                                                    <td> 7f </td>
                                                    <td> 8g </td>
                                                    <td> 9h </td>
                                                    <td> 10i </td>
                                                </tr>
                                            </tbody>
                                        </table>
                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>

    </div>

    <!-- END ROW -->
<script type="text/javascript">
        function validateNull(){
            var validate = true;
            var a = document.getElementById('full_name').value;
            var b = document.getElementById('applicant_id').value;
            var c = document.getElementById('ktp').value;
            var d = document.getElementById('psi_result').value;
            var e = document.getElementById('recomendation').value;
            var f = document.getElementById('network').value;
            var g = document.getElementById('location').value;
            var h = document.getElementById('planDateFrom').value;
            var i = document.getElementById('planDateTo').value;
            var j = document.getElementById('startDateFrom').value;
            var k = document.getElementById('startDateFrom').value;
            var l = document.getElementById('jobName').value;

            if(a == '' && b == '' && c == '' && d == '' && e == '' && f == '' && g == '' && h == '' && i == '' && j == '' && k == '' && l == ''){
                validate = false;
            }

            if(validate){
                return true;
            }else{
                return confirm('Searches might be slow without any parameter. Do you want to continue ? ');
            }
        }

        $(document).ready(function() {

            $("#findBtn").click(function(){
                $("#datatable_result").dataTable().fnDestroy();
                $('#datatable_result').DataTable({
                    ajax: {
                        "type": "POST",
                        "data": { _token : $('input[name="_token"]').val(),
                                 full_name:$('input[name="full_name"]').val(),
                                 applicant_id: $('input[name="applicant_id"]').val(),
                                 ktp: $('#ktp').val(),
                                 psi_result: $('#psi_result').val(),
                                 recomendation: $('#recomendation').val(),
                                 network: $('#network').val(),
                                 location: $('#location').val(),
                                 planDateFrom: $('#planDateFrom').val(),
                                 planDateTo: $('#planDateTo').val(),
                                 startDateFrom: $('#startDateFrom').val(),
                                 startDateTo: $('#startDateTo').val(),
                                 jobName: $('#jobName').val()
                             },
                        "dataType": "JSON",
                        "cache"    : false,
                        "url": "getResultByParameter" // ajax source
                    },
                    "order": [
                        [1, "asc"]
                    ]// set first column as a default sort by asc
                });
            });


            $('#downloadBtn').click(function (e) {
            e.preventDefault();
                var full_name = $('input[name="full_name"]').val();
                var applicant_id = $('input[name="applicant_id"]').val();
                 var ktp = $('input[name="ktp"]').val();
                 var psi_result = $('#psi_result').val();
                 var recomendation = $('#recomendation').val();
                 var network = $('input[name="network"]').val();
                 var locations = $('input[name="location"]').val();
                 var planDateFrom = $('input[name="planDateFrom"]').val();
                 var planDateTo = $('input[name="planDateTo"]').val();
                 var startDateFrom = $('input[name="startDateFrom"]').val();
                 var startDateTo = $('input[name="startDateTo"]').val();
                 var jobName = $('input[name="jobName"]').val();
                
                 if(!full_name)
                    full_name = '-';
                 if(!applicant_id)
                    applicant_id = '0';
                 if(!ktp)
                    ktp = '0';
                 if(!psi_result)
                    psi_result = '-';
                 if(!recomendation)
                    recomendation = '-';
                 if(!network)
                    network = '-';
                 if(!locations)
                    locations = '-';
                 if(!planDateFrom)
                    planDateFrom = '-';
                 if(!planDateTo)
                    planDateTo = '-';
                 if(!startDateFrom)
                    startDateFrom = '-';
                 if(!startDateTo)
                    startDateTo = '-';
                 if(!jobName)
                    jobName = '-';

                var base = 'reportResultExcel';

                var url = base+'/'+full_name+'/'+applicant_id +'/'+ktp +'/'+psi_result +'/'+recomendation +'/'+network +'/'+locations +'/'+planDateFrom +'/'+planDateTo +'/'+startDateFrom+'/'+startDateTo+'/'+jobName;
                window.location.href=url;
                // alert(url);

            });
            
        });


        var subCategoryName = "";
        var table_normatest = $('#datatable_result').DataTable({
                    "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                    "oLanguage": {
                        "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
                    },  
                    "autoWidth" : true,
                    ajax: {
                        "type": "POST",
                        "data":{ _token : $('input[name="_token"]').val() },
                        "dataType": "JSON",
                       // "url": "getResultAll" // ajax source getResultByParameter
                        "url": "getResultByParameter"
                    },
                    "order": [
                        [1, "asc"]
                    ]// set first column as a default sort by asc
                });

        $("#sub_category_name").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getCategories",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        categoryName : request.term
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.catagoryName,
                                value : item.catagoryName
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

    </script>