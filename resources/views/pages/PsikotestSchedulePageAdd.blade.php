
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
                    <h2>E - Psychotest Schedule Add </h2>

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

                        <form id="applicant-find-form" class="smart-form">
                            <header>
                                Create E-Psychotest Schedule
                            </header>
                            <fieldset>
                                <div class="row">
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
                                    <section class="col col-6">
                                        <label class="label col col-2">Last Education</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <i class="icon-append fa fa-search"></i>
                                                    <input type="text" name="last_educations" id="last_educations" placeholder="Last Education">
                                                    <input type="hidden" name="detail_code" id="detail_code">
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Location</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <i class="icon-append fa fa-search"></i>
                                                    <input type="input" list="loc" name="location" id="location" placeholder="Location">                                             
                                                    <input type="hidden" name="city_id" id="city_id" value="">
                                                    <input type="hidden" name="city_gawe_id" id="city_gawe_id" value="">


                                                </label>
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Applicant Name</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <input type="text" name="full_name" placeholder="Applicant Name">
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Age</label>
                                            <div class="col col-2">
                                                <label class="input">
                                                    <input type="text" name="age" placeholder="Age">
                                                </label>
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Applicant Id</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <input type="text" name="applicant_id" placeholder="Applicant Id">
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">KTP</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <input type="text" name="ktp" maxlength="16" placeholder="KTP">
                                                </label>
                                            </div>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button data-loading-text="&lt;i class='fa fa-refresh fa-spin'&gt;&lt;/i&gt; &nbsp; Search..." type="button" id="find-applicant" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>
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
                    <h2> Schedule List </h2>

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

                         <form action="{{url('')}}/psikotestScheduleProcess" id="schedule-psikotest-form" method="post" class="smart-form" novalidate="novalidate">

                            <fieldset>
                                                    
                                <select multiple="multiple" size="10" name="candidate[]" id="initializeDuallistbox" class="candidate">
                                   {{!!$listApplicant!!}}
                                </select>
                                <!-- start -->

                            </fieldset>
                            <header>
                                Schedule
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">Plan Date</label>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="plan_start_date" id="plan_start_date" placeholder="From">
                                                </label>
                                            </div>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="plan_end_date" id="plan_end_date" class="plan_end_date" placeholder="To">
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">Use Job Mapping</label>
                                            <div class="col col-8">
                                                <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="input" name="name" id="name" placeholder="Job Mapping Name">
                                                    <input type="hidden" name="job_mapping_id" id="job_mapping_id" placeholder="Job Mapping Name">
                                                    <input type="hidden" name="job_mapping_version_id" id="job_mapping_version_id" placeholder="Job Mapping Name">
                                                </label>
                                            </div>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="cabang" id="cabang" value="{{$valeInput['CABANG_ID']}}">

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    Submit
                                </button>
                                <a class="btn btn-default" id="peopleEnterBack" href="psikotestschedule">
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

        </article>       <!-- END COL -->

    </div>

    <!-- END ROW -->

    <script type="text/javascript">

       var errorClass = 'invalid';
        var errorElement = 'em';
        

        $('#initializeDuallistbox').bootstrapDualListbox({
          nonSelectedListLabel: 'Non-selected',
          selectedListLabel: 'Selected',
          preserveSelectionOnMove: 'moved',
          moveOnSelect: false
        });


         $('#find-applicant').on('click', function (e) {

                

                

                    var obj = {};

                    $('input[name="network"]').on("blur",function(){
                        if($(this).val() == ''){
                            $('input[name="network_id"]').val('');
                            $('input[name="cabang_id"]').val('');
                            $('input[name="city_id"]').val('');
                            $('input[name="location"]').val('');

                        }
                    });

                    $('input[name="location"]').on("blur",function(){
                        if($(this).val() == ''){
                            $('input[name="city_id"]').val('');
                            $('input[name="city_gawe_id"]').val('');

                        }
                    });

                    $('input[name="last_educations"]').on("blur",function(){
                        if($(this).val() == ''){
                            $('input[name="detail_code"]').val('');
                        }
                    });

                    obj["city_id"] =  $('input[name="city_gawe_id"]').val();
                    obj["cabang_id"] =  $('input[name="cabang_id"]').val();
                    obj["full_name"] =  $('input[name="full_name"]').val();
                    obj["ktp"] =  $('input[name="ktp"]').val();
                    obj["applicant_id"] =  $('input[name="applicant_id"]').val();
                    obj["last_educations"] =  $('input[name="detail_code"]').val();
                    obj["birth_date"] =  $('input[name="birth_date"]').val();
                    obj["age"] =  $('input[name="age"]').val();

                    // Get some values from elements on the page:
                    var personId = $( "input[name='person_id']" ).val(),
                    url = 'findApplicant';

                    var $btn = $(this);
                    $btn.button('loading');

                    // wait for animation to finish and execute send script
                    setTimeout(function () {

                        // Send the data using post
                        var search = $.post( url, { _token : $('input[name="_token"]').val(),param: obj } );
                         
                          // Put the results in a div
                        search.done(function( data ) {
                            var obj = jQuery.parseJSON( data );
                            
                            $("#initializeDuallistbox").children().remove();

                            $.each(obj.data_rows, function( index, value ) {
                               // console.log(index + ": " + value.personId);
                             // alert( index + ": " + value );
                                if(value.applicantId){
                                   $('<option>').val(value.applicantId).text(value.applicantName+" - "+value.applicantId).appendTo("#initializeDuallistbox");
                                }
                            });


                            $(".candidate").bootstrapDualListbox('refresh', true);

                            $btn.button('reset');

                        });
                    }, 1000); // how long do you want the delay to be? 



        });


         var $reviewForm = $("#schedule-psikotest-form").validate({
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
                name : {
                    required : true
                },
                plan_start_date : {
                    required : true
                },
                plan_end_date : {
                    required : true
                },
                'candidate[]_helper2' : {
                    required : true

                }

            },

            // Messages for form validation
            messages : {
                
                name : {
                    required : 'Job Mapping must be filled'
                },
                plan_start_date : {
                    required : 'Plan Start Date must be filled'
                    
                },
                plan_end_date : {
                    required : 'Plan End Date must be filled'
                },
                'candidate[]_helper2' : {
                    required : 'Candidate must be filled'

                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
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
                                valueInput : item.jobMappingId,
                                valueVersion : item.versionId

                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $('#job_mapping_id').val(ui.item.valueInput);
                $('#job_mapping_version_id').val(ui.item.valueVersion);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });


         $("#peopleEnterBack").click(function(e) {
            e.preventDefault();

            var url = $(this).attr('href');
            loadURL(url, $('#content'));            
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
                $('#cabang').val(ui.item.valueCabangId);
                $('#cabang_id').val(ui.item.valueCabangId);


                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        }); 

        $('#birthdate').datepicker({
                dateFormat : 'dd-M-yy',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                 maxDate: 0,
                onSelect : function(selectedDate) {
                           var today = new Date();
                              var birthDate = new Date(selectedDate);
                              var age = today.getFullYear() - birthDate.getFullYear();
                              var m = today.getMonth() - birthDate.getMonth();
                              if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                                age--;
                              }
                             $('.ageyears').html(age);
                             $('.agemonth').html( Math.abs(m));
                }
            });

        $('#plan_start_date').datepicker({
               // defaultDate: "+1d",
               // minDate:1,
                dateFormat : 'dd-M-yy',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                dateFormat: 'dd-M-yy',
                onSelect : function(selectedDate) {
                    var day = new Date(selectedDate);
                    var nextDay = new Date(day);
                    const months = ["Jan", "Feb", "Mar","Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    nextDay.setDate(day.getDate()+2);
                    //$('.plan_end_date').datepicker('option', 'minDate', nextDay);
                    //$('#plan_end_date').datepicker('option', 'maxDate', nextDay);
                  //  alert(months[nextDay.getMonth().toString()]);
                   // alert(((nextDay.getMonth().toString().length > 1) ? (nextDay.getMonth()+1) : ('0' + (nextDay.getMonth()+1))));
                    $('.plan_end_date').val(
                        ((nextDay.getDate().toString().length > 1) ? nextDay.getDate() : ('0' + nextDay.getDate()))+'-'+
                        //((nextDay.getMonth().toString().length > 1) ? (nextDay.getMonth()+1) : ('0' + (nextDay.getMonth()+1)))
                        months[nextDay.getMonth().toString()]
                        +'-'+nextDay.getFullYear()

                        );
                }
            });
         $('#plan_end_date').datepicker({
                dateFormat : 'dd-M-yy',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                dateFormat: 'dd-M-yy',
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

       $("#last_educations").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getLastEducation",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        lookupDtlMeaning : $('input[name="last_educations"]').val(),
                        lookupName : 'MST_EDUCATION'
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.meaningLookUp,
                                value : item.meaningLookUp,
                                valueInput : item.detailCodeLookUp

                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $('#detail_code').val(ui.item.valueInput);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

       
    
 
        

    </script>

