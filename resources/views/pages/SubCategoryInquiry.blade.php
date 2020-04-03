<div class="row">
    <article class="col-sm-12 col-md-12 col-lg-12">

                                <!-- Widget ID (each widget will need unique ID)-->
                                <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
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
                                        <h2>Sub Category Setup</h2>

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

                                            <div class="form-horizontal">

                                                <fieldset>
                                                    <legend>Search Sub Category Setup</legend>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Sub Category Name</label>
                                                        <div class="col-md-6">
                                                            <!-- <input id="url" style="cursor: pointer;" class="form-control" placeholder="Narration Name" value="/api/sub-category" type="hidden" readonly="readonly" > -->
                                                            <input id="names" class="names form-control" placeholder="Sub Category Name" type="search" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Question Text</label>
                                                        <div class="col-md-6">
                                                            <textarea id="text" class="text form-control" placeholder="Narration Text" rows="4" name="question"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">In Random Question</label>
                                                        <div class="col-md-2">
                                                            <select class="form-control listRandom" id="listRandom" name="random">
                                                                <option value="">- select -</option>
                                                                <option value="1">Yes</option>
                                                                <option value="0">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row ">
                                                            <div class="col-md-4">

                                                                 <a class="btn btn-success" href="#addsubcategory"><i class="fa fa-plus"></i> New</a>

                                                                <button class="btn btn-primary" id="findBtn">
                                                                    <i class="fa fa-search"></i>
                                                                    Find
                                                                </button>

                                                                <!--<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                                                    Launch demo modal
                                                                </button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                    </div>
                                    <!-- end widget div -->

                                </div>

                            </article>
                        </div>
<div class="row">

    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

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
                <h2></h2>

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

                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Sub Category Name</th>
                                <th>Total Question Example</th>
                                <th>Total Question Active</th>
                                <th>Total Duration</th>
                                <th>Is Random Question</th>
                                <th>Last Updated Date</th>
                                <th>Last Updated By</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->
    </article>
    <!-- WIDGET END -->
</div>
                                            </div>

                                        </div>
                                        <!-- end widget content -->

            <!-- JQUERY MASKED INPUT -->
            <script src="assets/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

            <!-- JARVIS WIDGETS -->
            <script src="assets/js/smartwidgets/jarvis.widget.min.js"></script>
            <!-- PAGE RELATED PLUGIN(S) --><!-- JQUERY SELECT2 INPUT -->

            <!-- JQUERY UI + Bootstrap Slider -->
            <script src="assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

            <script src="assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
            <script src="assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
            <script src="assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
            <script src="assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
            <script src="assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
            <script src="assets/js/lookup.js"></script>

            <script type="text/javascript">

                // DO NOT REMOVE : GLOBAL FUNCTIONS!

                $(document).ready(function() {

                      obj["name"] =  $('.names').val();
        obj["question"] =  $('.text').val();
        obj["random"] =  $('.listRandom').val();

        var subCategoryName = "";
        var table_normatest = $('#dt_basic').DataTable({
                    "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                    "oLanguage": {
                        "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
                    },  
                    "autoWidth" : true,
                    "columns":[
                                {
                                    "data": "sub_category_id",
                                    "render": function (data, type, row) {
                                        return "<a href='workspace#editsubcategory/" + data + "'>Edit</a> | <a href='workspace#viewsubcategory/" + data + "'>View Question</a>";
                                    }
                                },
                                {"data":"sub_category_name"},
                                {"data":"total_example"},
                                {"data":"total_que_active"},
                                {"data":"total_duration"},
                                {
                                    "data": "is_random_que",
                                    "render": function (data, type, row) {
                                        if(data == 1){
                                            return 'YES'
                                        }else{
                                            return 'NO'
                                        }
                                    }
                                },
                                {"data":"last_update_date"},
                                {"data":"last_updated_by"}
                            ],
                    "ajax": {
                        "type": "GET",
                       "data": function( d ) {
                                      
                                  d._token= $('input[name="_token"]').val();
                                  d.paramFilters=obj;
                                },
                        "dataType": "JSON",
                        "url": "sub-category" // ajax source
                    },
                    "order": [
                        [1, "asc"]
                    ]// set first column as a default sort by asc
                });


                         param["message"] = "Searches might be slow without any parameter. Do you want to continue ?";
                        param["title"] = "Find All";

                        drawDialogConfirm(table_normatest,param,"find_all");

                        $("#findBtn").click(function(){
                         
                                obj["name"] =  $('.names').val();
                                obj["question"] =  $('.text').val();
                                obj["random"] =  $('.listRandom').val();

                            if(!obj["name"].length && !obj["question"].length && !obj["random"].length){
                                $('#dialog_simple').dialog('open');
                            }else{
                                table_normatest.ajax.reload();
                                pageSetUp();
                            }
                        });
                   


                    $("#names").autocomplete({
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
                });
