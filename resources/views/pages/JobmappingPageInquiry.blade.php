
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
                    <h2>Job Mapping Search </h2>

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

                                    <label class="label col col-3">Job Mapping Name</label>

                                    <section class="col col-9">
                                             <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="input" name="name" id="name" placeholder="Job Mapping Name">
                                                    <input type="hidden" id="job_mapping_id" class="job_mapping_id"  name="job_mapping_id">
                                                </label>
                                    </section>
                                </div>
                                <div class="row">

                                    <label class="label col col-3">Job Name</label>

                                    <section class="col col-9">
                                             <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="input" name="job_name" id="job_name" placeholder="Job Name">
                                                    <input type="hidden" id="job_id" class="job_id"  name="job_id">
                                                </label>
                                    </section>
                                </div>
                                <div class="row">

                                    <label class="label col col-3">Category Name</label>

                                    <section class="col col-9">
                                             <label class="input">
                                                    <i class="icon-append fa fa-search"></i>
                                                    <input type="input" id="category_name" name="category_name" placeholder="Category Name">
                                                    <input type="hidden" id="category_id" class="category_id"  name="category_id">
                                                </label>
                                    </section>
                                </div>
                                <div class="row">

                                    <label class="label col col-3">Is Random Category</label>

                                    <section class="col col-2">
                                            <label class="select">
                                                    <select name="randomCategory">
                                                        <option value="">- Select -</option>
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                    </select><i></i>
                                                </label>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                 <button type="submit" class="btn btn-primary" id="find-jobmapping">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>
                                 <a href="#jobmappingsetupadd" id="jobmappingsetupadd" type="button" class="btn btn-success">
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
                    <h2> Job Mapping Inquiry </h2> 

                </header>

                <!-- widget div-->
                <div> 
                    @if(session()->has('success'))
                      <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{{ session()->get('success') }}</strong>
                      </div>
                    @endif

                    @if(session()->has('error'))
                      <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session()->get('error') }}</strong>
                      </div>
                    @endif
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">

                        <table class="table table-striped table-bordered table-hover table-checkable table-norma-inquiry" id="table-norma-inquiry">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">

       <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                    <th width="5%"> Action </th>
                                                    <th width="15%"> Job Mapping Name </th>
                                                    <th width="15%"> Is Random Category </th>
                                                    <th width="15%"> Last updated Date </th>
                                                   <th width="15%"> Last updated By </th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">

       <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td><a href="#jobmappingsetupadd">detail</a></td>
                                                    <td>23303</td>
                                                    <td>Yes</td>
                                                    <td>01 Jun 2017 10:25:12</td>
                                                    <td>23303 - Satria Adi</td>
                                                </tr>
                                            </tbody>
                                        </table>

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

        $("#jobmappingsetupadd").click(function(e) {
            e.preventDefault();
            loadURL("jobmappingsetupadd", $('#content'));
        });

        $('.table-norma-inquiry tbody').on( 'click', 'a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            loadURL(url, $('#content'));
        });

        var obj = {};
        var param = {};

        obj["jobMappingId"] =  $('input[name="job_mapping_id"]').val();
        obj["jobId"] =  $('input[name="job_id"]').val();
        obj["categoryId"] =  $('input[name="category_id"]').val();
        obj["isRandomCategory"] =  $('select[name="randomCategory"]').val();
        

        var jobMappingName = "";
        var table_normatest = $('#table-norma-inquiry').DataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
                },  
                "autoWidth" : true,
                "ajax": {
                        "type": "POST",
                        "data": function( d ) {
                                      
                                  d._token= $('input[name="_token"]').val();
                                  d.paramFilters=obj;
                        }, 
                        "dataType": "JSON",
                        "url": "getJobMappingAll" // ajax source
                    },
                "order": [
                        [1, "asc"]
                    ]// set first column as a default sort by asc
        });

        param["message"] = "Searches might be slow without any parameter. Do you want to continue ?";
        param["title"] = "Find All";

        drawDialogConfirm(table_normatest,param,"find_all");

        $('#find-jobmapping').on('click', function (e) {
            e.preventDefault();

            obj["jobMappingId"] =  $('input[name="job_mapping_id"]').val();
            obj["jobId"] =  $('input[name="job_id"]').val();
            obj["categoryId"] =  $('input[name="category_id"]').val();
            obj["isRandomCategory"] =  $('select[name="randomCategory"]').val();

            console.log(obj);

            if(!obj["jobMappingId"].length && !obj["jobId"].length && !obj["categoryId"].length && (obj["isRandomCategory"] == 0)){
                $('#dialog_simple').dialog('open');
            }else{
                console.log(table_normatest.ajax.params());
                table_normatest.ajax.reload();
            }

        });

        $("#category_name").autocomplete({
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
                                categoryId : item.categoryId
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) { 
                $(this).parent('.input').find('#category_id').val(ui.item.categoryId);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

        $('input[name="name"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="job_mapping_id"]').val('');
            }
        });
        $('input[name="category_name"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="category_id"]').val('');
            }
        });
        $('input[name="job_name"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="job_id"]').val('');
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
                                jobMappingId : item.jobMappingId
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $(this).parent('.input').find('#job_mapping_id').val(ui.item.jobMappingId);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

        $("#job_name").autocomplete({
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
                                jobId : item.jobId
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {

                $(this).parent('.input').find('#job_id').val(ui.item.jobId);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

    </script>
