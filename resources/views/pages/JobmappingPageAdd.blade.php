
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
                    <h2>Job Mapping Add </h2>

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

                        <form action="{{url('')}}/jobmappingProcess" method="POST" id="order-form" class="smart-form">
                            <header>
                                Create Job Mapping Setup
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Job Mapping Name</label>
                                            <div class="col col-8">
                                                <label class="input"> 
                                                    <input type="input" name="name" id="name" value="{{$valeInput['NAME']}}" {{$isDisable}} {{$isDisableCurrent}} {{$isDisablePast}} placeholder="Job Mapping Name" required>

                                                     <input type="hidden" name="jobMappingId" value="{{$jobMappingId}}"  id="jobMappingId">
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Version</label>
                                            <div class="col col-3">
                                                <label class="select">
                                                    <select name="version_number" required>
                                                        <option value="0" disabled="">- Select -</option>
                                                        {!! $valeInput['VERSION_NUMBER'] !!}
                                                    </select><i></i>
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Description</label>
                                            <div class="col col-8">
                                                <label class="textarea">
                                                    <textarea rows="5" name="description" id="description"   placeholder="Description"   {{$isDisableCurrent}} {{$isDisablePast}} required>{!! $valeInput['DESCRIPTION'] !!}</textarea>
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Effective Date</label>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="date_from" id="date_from" value="{{$valeInput['DATE_FROM']}}"   placeholder="From"  {{$isDisableCurrent}} {{$isDisablePast}} required>
                                                </label>
                                            </div>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="date_to" value="{{$valeInput['DATE_TO']}}"   id="date_to" placeholder="To"  {{$isDisableCurrent}} {{$isDisablePast}} required>
                                                </label>
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">General Instruction</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <i class="icon-append fa fa-search"></i>
                                                    <input type="text" name="general_instruction_name" value="{{$valeInput['GENERAL_INSTRUCTION_NAME']}}"  id="general_instruction" placeholder="General Instruction"  {{$isDisableCurrent}} {{$isDisablePast}} required>
                                                    <input type="hidden" name="general_instruction" value="{{$valeInput['GENERAL_INSTRUCTION_ID']}}"  id="general_instruction_id">

                                                </label>
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Final Greating</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <i class="icon-append fa fa-search"></i>
                                                    <input type="text" name="final_greating" id="final_greating" value="{{$valeInput['FINAL_GREATING']}}"  placeholder="Final Greating"  {{$isDisableCurrent}} {{$isDisablePast}} required>
                                                     <input type="hidden" name="final_greating_id" value="{{$valeInput['FINAL_GREATING_ID']}}"  id="final_greating_id">
                                                </label>
                                            </div>
                                    </section>
                                </div>
                                <div class="row"> 
                                    <section class="col col-12">
                                        <label class="label col col-10">Is Random Category *</label>
                                        <div class="col col-2"> 
                                                <input type="checkbox" name="IS_RANDOM_CATEGORY" id="IS_RANDOM_CATEGORY"  <?php 
                                                    if($valeInput['RANDOM_CATEGORY'] == 1){ echo "checked"; }?>
                                                    >
                                           
                                        </div>
                                    </section>
                                </div>
                            </fieldset>

                            <header >
                                Category List <br> 
                                <div class="category-error"></div>
                            </header>

                            <fieldset>
                                
                                <div class="row">
                                    <section class="col col-12">
                                        <div class="product-content product-wrap clearfix product-deatil padding">

                                            <table class="table table-striped table-bordered table-hover table-checkable" width="100%" id="table-category-list">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="1%">
                                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type="checkbox" class="checkAllCategory" data-set="#sample_2 .checkboxes" />
                                                                <span></span>
                                                            </label>
                                                        </th>
                                                        <th width="15%"> Category Name </th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    {!! $valeInput['CATEGORY_LIST'] !!}

                                                </tbody>
                                            </table>
                                             <?php if(!$isDisablePast && !$isDisableCurrent){?>
                                            <div class="row">
                                                <section class="col col-11">
                                                    <label class="button bg-color-green"> 
                                                        <button id="add-row-categorylist" class="btn bg-color-green txt-color-white"> Add Row
                                                        <i class="fa fa-plus"></i>
                                                    </label>
                                                 </section> 

                                                 <section class="col col-11">
                                                    <label class="button bg-color-red"> 
                                                        <button id="delete-row-categorylist" class="btn bg-color-red txt-color-white"> Delete Row
                                                        <i class="fa fa-minus"></i>
                                                    </label>
                                                 </section> 
                                            </div>
                                            <?php }?>
                                        </div>
                                    </section>
                                </div>
                            </fieldset>
                            <header >
                                Job Profile <br> 
                                <div class="job-error"></div>
                            </header>
                            <fieldset>
                                
                                <div class="row">
                                    <section class="col col-12">
                                        <div class="product-content product-wrap clearfix product-deatil padding">
                                            <table class="table table-striped table-bordered table-hover table-checkable" width="100%" id="table-job-profile">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="2%">
                                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type="checkbox" class="group-checkable checkAllJobProfile" data-set="#sample_2 .checkboxes" />
                                                                <span></span>
                                                            </label>
                                                        </th>
                                                        <th width="30%"> Job Name </th>
                                                        <th width="10%"> Inductive Reasoning </th>
                                                        <th width="10%"> Deductive Reasoning </th>
                                                        <th width="15%"> Reading Comp </th>
                                                        <th width="15%"> Arithmetic Ability </th>
                                                        <th width="15%"> Spatial Ability </th>
                                                        <th width="15%"> Memory </th>
                                                        <th width="15%"> Total Score </th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    {!! $valeInput['JOB_PROFILE'] !!}

                                                </tbody>
                                            </table>
                                            <?php if(!$isDisablePast && !$isDisableCurrent){?>
                                            <div class="row">
                                                <section class="col col-11">
                                                    <label class="button bg-color-green"> 
                                                        <button id="add-row-jobprofile" class="btn bg-color-green txt-color-white"> Add Row
                                                        <i class="fa fa-plus"></i>
                                                    </label>
                                                 </section> 

                                                 <section class="col col-11">
                                                    <label class="button bg-color-red"> 
                                                        <button id="delete-row-jobprofile" class="btn bg-color-red txt-color-white"> Delete Row
                                                        <i class="fa fa-minus"></i>
                                                    </label>
                                                 </section> 
                                             </div>
                                            <?php }?>
                                        </div>
                                    </section>
                                   
                                </div>


                            </fieldset>
                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="JOB_MAPPING_ID" value="{{$valeInput['JOB_MAPPING_ID']}}">
                                <?php if(!$isDisablePast && !$isDisableCurrent){?>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class='fa fa-save'></i>&nbsp;
                                    Submit
                                </button>
                            <?php } ?>
                                <a class="btn btn-default" id="jobmappingback" href="jobmappingsetup">
                                      <i class="fa fa-chevron-left"></i>&nbsp;
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
        if ($("#order-form").length > 0) { 
            $("#order-form").validate({
                rules: {
                    name: {
                        required: true, 
                    }, 
                    description: {
                        required: true, 
                    } , 
                    date_from: {
                        required: true, 
                    }, 
                    date_to: {
                        required: true, 
                    }, 
                    general_instruction: {
                        required: true, 
                    }, 
                    final_greating: {
                        required: true, 
                    } 
                },
                messages: {
                    name: {
                        required: "Name is Required" 
                    } , 
                    description: {
                        required: "Description is Required" 
                    } , 
                    date_from: {
                         required: "Effective Date  is Required" 
                    }, 
                    date_to: {
                         required: "Effective Date  is Required" 
                    }, 
                    general_instruction: {
                         required: "General Instruction is Required" 
                    }, 
                    final_greating: {
                       required: "Final Greating is Required" 
                     } 
                },
                debug: true,

                errorPlacement: function (error, element) {
                    var name = element.attr('name');
                    console.log(element[0].tagName);
                    var type = element[0].tagName;
                    var errorSelector = '.form-control-feedback[for="' + name + '"]';
                    var $element = $(errorSelector);
                    if ($element.length) {
                        $(errorSelector).html(error.html());
                    } else {
                        if (type == 'SELECT') {
                            error.insertAfter(element.next());
                        }
                        else {
                            error.insertAfter(element);
                        }
                    }
                },
                submitHandler: function (element) { 
                    $(".job-error").html("");
                    $(".category-error").html(""); 
                    if(checkGenInfo() && checkFinalGreating() &&  checkCategoryList() && checkJobList() && checkScoreList()){
                        var param = {};
                        param["message"] = "Are you sure want to save this setup ?";
                        param["title"] = "Save Job Mapping Setup";
                        drawDialogConfirm(element,param,'submit_form');
                        $('#dialog_simple').dialog('open');
                       
                    }else{
                        if(!checkCategoryList()){
                            $(".category-error").html(""); 
                            $(".category-error").append('<em id="sub-category-name-error" class="error">Category List Is Required</em>'); 
                        }else if(!checkJobList()){
                            $(".job-error").html("");
                            $(".job-error").append('<em id="sub-category-name-error"  class="error">Job List Is Required</em>'); 
                        }else if(!checkScoreList()){
                           $(".job-error").html("");
                           $(".job-error").append('<em id="sub-category-name-error"  class="error">Score Is Required</em>'); 
                        }else{  
                            return false;
                        }
                    }
                }
            });
        } 

        function checkFinalGreating(){
            $category_id_component = $('#final_greating_id');
            let category_id_value = $category_id_component.val();
            if (category_id_value === "" || category_id_value == null) {
                $component = $('#final_greating');
                if (!$component.parent().hasClass("state-error")) {
                    $component.parent().removeClass('state-success').addClass("state-error");
                    $component.parent().parent().append('<em id="sub-category-name-error">Final Greating must be selected from selections</em>')
                    $component.removeClass('valid');
                }
                return false;
            }
             return true;
        }
        function checkGenInfo(){
            $category_id_component = $('#general_instruction_id');
            let category_id_value = $category_id_component.val();
            if (category_id_value === "" || category_id_value == null) {
                $component = $('#general_instruction');
                if (!$component.parent().hasClass("state-error")) {
                    $component.parent().removeClass('state-success').addClass("state-error");
                    $component.parent().parent().append('<em id="sub-category-name-error">General Instruction must be selected from selections</em>')
                    $component.removeClass('valid');
                }
                return false;
            }
             return true;
        }
        function checkCategoryList(){
            var categoryList = $(".category_id"); 
            var totalFilledCategory = 0; 
            for (var i = 0; i < categoryList.length; i++) { 
                if($(categoryList[i]).val() != ""){
                    totalFilledCategory++;
                } 

            } 

            if(categoryList.length === 0 || categoryList.length !== totalFilledCategory){ 
                return false;
            }else{
               return true;
            }  
        }
        
        function checkJobList(){
            var jobList = $(".job_id");
            var totalFilledJob = 0; 
            for (var i = 0; i < jobList.length; i++) { 
                if($(jobList[i]).val() != ""){
                    totalFilledJob++;
                } 

            } 
            if(jobList.length === 0 || jobList.length !== totalFilledJob){ 
                return false;
            }else{
               return true;
            }  
        }

        function checkScoreList(){
            var scoreList = $(".pass_score");
            var totalFilledScore = 0; 
            var totalMandatory = 0; 
            for (var i = 0; i < scoreList.length; i++) {
                var name = $(scoreList[i]).attr("name").replace(/pass_score/g,'mandatory');;
                
                var isChecked = $( "input[name*='"+name+"']:checked" ).length;
                if(isChecked == 1){

                    if($(scoreList[i]).val() != ""){
                        totalFilledScore++;
                    }
                    totalMandatory++;
                }  
            }  
            if(totalMandatory === 0 || totalMandatory !== totalFilledScore){ 
                return false;
            }else{
               return true;
            }  
        }
        $('#date_from').datepicker({
                defaultDate: "+0d",
                minDate:0,
                dateFormat : 'd-M-y',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                dateFormat: 'yy-mm-dd',
                beforeShow: function(i) { if ($(i).attr('readonly')) { return false; } },
                onSelect : function(selectedDate) {
                    var day = new Date(selectedDate);
                    var nextDay = new Date(day);
                    nextDay.setDate(day.getDate()+1);
                    $('#date_to').datepicker('option', 'minDate', nextDay);
                }
            });
         $('#date_to').datepicker({
                dateFormat : 'dd.mm.yy',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                dateFormat: 'yy-mm-dd',
                beforeShow: function(i) { if ($(i).attr('readonly')) { return false; } },
                onSelect : function(selectedDate) {
                     
                }
            });

        var table_categorylist = $('#table-category-list').DataTable({
                    "sDom": "<'row'<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>>"+
                        "<'row't>"+
                        "<'row'<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>>",
                    "oLanguage": {
                        "sSearch": '<label class="input"><i class="icon-append fa fa-search"></i></label>'
                    },  
                    "autoWidth" : true
                });

        var counter = 1;
     
        $('#add-row-categorylist').on( 'click', function (e) {
             e.preventDefault();
            table_categorylist.row.add( [
                '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable checkSingleCategory" name="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label>',
                '<label class="input"><input type="input" id="sub_category_name" class="sub_category_name" name="sub_category_name[]" placeholder="Category Name"><input type="hidden" name="category_id[]" class="category_id" id="category_id"> <i class="icon-append fa fa-search"></i></label>'
            ] ).draw( false );

            $(".sub_category_name").autocomplete({
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
                                    value : item.catagoryName,
                                    value_cateid : item.categoryId
                                }
                            }));
                        }
                    });
                },
                minLength : 2,
                select : function(event, ui) {
                    $(this).parent('.input').find('.category_id').val(ui.item.value_cateid);
                    console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                }
            });
     
            counter++;
        });

        $('#delete-row-categorylist').on( 'click', function (e) { 
            e.preventDefault();
            $('.checkSingleCategory:checked').each(function () {
               table_categorylist
                .row($(this).parents('tr') )
                .remove();
            });
            table_categorylist.draw();
        });

        var table_jobprofile = $('#table-job-profile').DataTable({
                    "sDom": "<'row'<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>>"+
                        "<'row't>"+
                        "<'row'<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>>",
                    "oLanguage": {
                        "sSearch": '<label class="input"><i class="icon-append fa fa-search"></i></label>'
                    },  
                    "pageLength": 100,
                    "autoWidth" : true
                });
        var jobMappingId = $("#jobMappingId").val();
        var counter_job = 1;
        console.log(jobMappingId.length);
        if(jobMappingId > 0 ){
            var counter_job = $('#table-job-profile > tbody > tr').length+1; 
        }

        console.log("Counter Job : "+counter_job);
        function replaceNameJob(){  
             var scoreList =$("#"+counter_job).find('.pass_score');
             for (var i = 0; i < scoreList.length; i++) {
                var last_score = $(scoreList[i]).attr("name");
                var current_score = last_score.slice(0,-1)+counter_job+"]";
                $(scoreList[i]).attr("name",current_score); 
             } 
             var mandatoryList =$("#"+counter_job).find('.mandatory');
             for (var i = 0; i < mandatoryList.length; i++) {
                var last_mandatory = $(mandatoryList[i]).attr("name");
                var current_mandatory = last_mandatory.slice(0,-1)+counter_job+"]";
                $(mandatoryList[i]).attr("name",current_mandatory); 
             } 
        }


        $('.pass_score').blur(function(e){
            e.preventDefault(); 

            /*
            var pengurangUpah = $('#tempUpah').val();
            var jmlupah = $('#JumlahUpah').val().replace(/\,/g,'');
            var thisPengurang = parseInt(this.value.replace(/\,/g,''));
            if(isNaN(thisPengurang)){
              thisPengurang = 0;
            }
            var penambahUpah = thisPengurang - parseInt(pengurangUpah);
            var totalupah =  parseInt(jmlupah) + penambahUpah;
            console.log("total upah : "+totalupah);
            $('#JumlahUpah').val(totalupah);
            $('#tempUpah').val(0); */

            var sum = 0;
             $(this).parents('tr').find(".pass_score").each(function(){
                  sum += +($(this).val().replace(/\,/g,''));
              });
            // console.log(sum);

            $(this).parents('tr').find('.total_pass_score').val(sum);


        });
        $('#add-row-jobprofile').on( 'click', function (e) {
             e.preventDefault();
            table_jobprofile.row.add( [
                '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable checkSingleJobProfile" data-set="#sample_2 .checkboxes" /> <span></span> </label>',
                '<label class="input"><input type="text" name="job_name[]" class="job_name" placeholder="Job Name"><input type="hidden" name="job_id[]" class="job_id" id="job_id"> <i class="icon-append fa fa-search"></i></label>',
                '{!!$INDUCTIVEREASONING!!}',
                '{!!$DEDUCTIVEREASONING!!}',
                '{!!$READINGCOMPREHENSION!!}',
                '{!!$ARITHMETICABILITY!!}',
                '{!!$SPATIALABILITY!!}',
                '{!!$MEMORY!!}',
                '<label class="input"><input type="text" readonly name="total_pass_score[]" id="total_pass_score" class="total_pass_score" placeholder=""> </label>',
            ] ).node().id = counter_job;
            table_jobprofile.draw( false );

            replaceNameJob();
            $(".job_name").autocomplete({
                source : function(request, response) {
                    $.ajax({
                        type: "POST",
                        url : "getJobs",
                        dataType : "json",
                        data : {
                            _token : $('input[name="_token"]').val(),
                            jobName : request.term
                        },
                        success : function(data) {
                            response($.map(data.data_rows, function(item) {
                                return {
                                    label : item.jobName,
                                    value : item.jobName,
                                    value_jobid : item.jobId
                                }
                            }));
                        }
                    });
                },
                minLength : 2,
                select : function(event, ui) {
                    $(this).parent('.input').find('.job_id').val(ui.item.value_jobid);
                    console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                }
            });

              $('.pass_score').blur(function(e){
            e.preventDefault(); 

            /*
            var pengurangUpah = $('#tempUpah').val();
            var jmlupah = $('#JumlahUpah').val().replace(/\,/g,'');
            var thisPengurang = parseInt(this.value.replace(/\,/g,''));
            if(isNaN(thisPengurang)){
              thisPengurang = 0;
            }
            var penambahUpah = thisPengurang - parseInt(pengurangUpah);
            var totalupah =  parseInt(jmlupah) + penambahUpah;
            console.log("total upah : "+totalupah);
            $('#JumlahUpah').val(totalupah);
            $('#tempUpah').val(0); */

            var sum = 0;
             $(this).parents('tr').find(".pass_score").each(function(){
                  sum += +($(this).val().replace(/\,/g,''));
              });
            // console.log(sum);

            $(this).parents('tr').find('.total_pass_score').val(sum);


        });

            counter_job++;
        });

        $('#delete-row-jobprofile').on( 'click', function (e) {
            e.preventDefault(); 

            $('.checkSingleJobProfile:checked').each(function () {
               table_jobprofile
                .row($(this).parents('tr') )
                .remove();
            });
            table_jobprofile.draw();
        });

        $("#general_instruction").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getNarrations",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        narrationName : request.term
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.narrationName,
                                value : item.narrationName,
                                valueInput : item.narrationId
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $('#general_instruction_id').val(ui.item.valueInput);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });
        $("#final_greating").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getNarrations",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        narrationName : request.term
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.narrationName,
                                value : item.narrationName,
                                valueInput : item.narrationId
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                console.log(ui.item.valueInput);
                $('#final_greating_id').val(ui.item.valueInput);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });


        $("#jobmappingback").click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            loadURL(url, $('#content'));
        });

        
        $(".checkAllCategory").change(function() {
            console.log("CHECK ALL");
            if (this.checked) {
                $(".checkSingleCategory").each(function() {
                    this.checked=true;
                });
            } else {
                $(".checkSingleCategory").each(function() {
                    this.checked=false;
                });
            }
        });

        $(".checkSingleCategory").click(function () {
            if ($(this).is(":checked")) {
                var isAllChecked = 0;

                $(".checkSingleCategory").each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $(".checkAllCategory").prop("checked", true);
                }     
            }
            else {
                $(".checkAllCategory").prop("checked", false);
            }
        });
        
        $(".checkAllJobProfile").change(function() {
            console.log("CHECK ALL");
            if (this.checked) {
                $(".checkSingleJobProfile").each(function() {
                    this.checked=true;
                });
            } else {
                $(".checkSingleJobProfile").each(function() {
                    this.checked=false;
                });
            }
        });

        $(".checkSingleJobProfile").click(function () {
            if ($(this).is(":checked")) {
                var isAllChecked = 0;

                $(".checkSingleJobProfile").each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $(".checkAllJobProfile").prop("checked", true);
                }     
            }
            else {
                $(".checkAllJobProfile").prop("checked", false);
            }
        });
    
 
        

    </script>

