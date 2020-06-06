
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

                        <form action="{{url('')}}/jobmappingProcess" method="POST" id="order-form" class="smart-form" novalidate="novalidate">
                            <header>
                                Create Job Mapping Setup
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Job Mapping Name</label>
                                            <div class="col col-8">
                                                <label class="input"> 
                                                    <input type="input" name="name" id="name" value="{{$valeInput['NAME']}}" {{$isDisable}} placeholder="Job Mapping Name">

                                                     <input type="hidden" name="jobMappingId" value="{{$jobMappingId}}"  id="jobMappingId">
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Version</label>
                                            <div class="col col-3">
                                                <label class="select">
                                                    <select name="version_number">
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
                                                    <textarea rows="5" name="description"   placeholder="Description">{!! $valeInput['DESCRIPTION'] !!}</textarea>
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Effective Date</label>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="date_from" id="date_from" value="{{$valeInput['DATE_FROM']}}"   placeholder="From">
                                                </label>
                                            </div>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="date_to" value="{{$valeInput['DATE_TO']}}"   id="date_to" placeholder="To">
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
                                                    <input type="text" name="general_instruction_name" value="{{$valeInput['GENERAL_INSTRUCTION_NAME']}}"  id="general_instruction" placeholder="General Instruction">
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
                                                    <input type="text" name="final_greating" id="final_greating" value="{{$valeInput['FINAL_GREATING']}}"  placeholder="Final Greating">
                                                     <input type="hidden" name="final_greating_id" value="{{$valeInput['FINAL_GREATING_ID']}}"  id="final_greating_id">
                                                </label>
                                            </div>
                                    </section>
                                </div>
                            </fieldset>

                            <header>
                                Category List
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
                                                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
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
                                        </div>
                                    </section>
                                </div>
                            </fieldset>
                            <header>
                                Job Profile
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
                                                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                                <span></span>
                                                            </label>
                                                        </th>
                                                        <th width="30%"> Job Name </th>
                                                        <th width="10%"> Inductive Reasongin </th>
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
                                        </div>
                                    </section>
                                   
                                </div>


                            </fieldset>
                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="JOB_MAPPING_ID" value="{{$valeInput['JOB_MAPPING_ID']}}">
                                <button type="submit" class="btn btn-primary">
                                    <i class='fa fa-save'></i>&nbsp;
                                    Submit
                                </button>
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
        
        $('#date_from').datepicker({
                defaultDate: "+1d",
                minDate:1,
                dateFormat : 'd-M-y',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                dateFormat: 'yy-mm-dd',
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
                '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label>',
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
            table_categorylist
            .row( $('input:checkbox:checked').parents('tr') )
            .remove()
            .draw();
        });

        var table_jobprofile = $('#table-job-profile').DataTable({
                    "sDom": "<'row'<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>>"+
                        "<'row't>"+
                        "<'row'<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>>",
                    "oLanguage": {
                        "sSearch": '<label class="input"><i class="icon-append fa fa-search"></i></label>'
                    },  
                    "autoWidth" : true
                });

        var counter = 1;
     
        $('#add-row-jobprofile').on( 'click', function (e) {
             e.preventDefault();
            table_jobprofile.row.add( [
                '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label>',
                '<label class="input"><input type="text" name="job_name[]" class="job_name" placeholder="Job Name"><input type="hidden" name="job_id[]" class="job_id" id="job_id"> <i class="icon-append fa fa-search"></i></label>',
                '{!!$INDUCTIVEREASONING!!}',
                '{!!$DEDUCTIVEREASONING!!}',
                '{!!$READINGCOMPREHENSION!!}',
                '{!!$ARITHMETICABILITY!!}',
                '{!!$SPATIALABILITY!!}',
                '{!!$MEMORY!!}',
                '<label class="input"><input type="text" readonly name="total_pass_score[]" id="total_pass_score" class="total_pass_score" placeholder=""> </label>',
            ] ).draw( false );
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
                console.log(sum);

                $(this).parents('tr').find('.total_pass_score').val(sum);


            });

            

            counter++;
        });

        $('#delete-row-jobprofile').on( 'click', function (e) {
            e.preventDefault();
            table_jobprofile
            .row( $('input:checkbox:checked').parents('tr') )
            .remove()
            .draw();
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

        

    
 
        

    </script>

