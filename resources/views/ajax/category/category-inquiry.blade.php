<div class="row">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Sub Category Lookup</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" id="textLookup">
                                    <input id="nameLookup" type="text" class="form-control" placeholder="Sub Category Name" required />
                                </div>
                                <!--<div class="form-group">
                                    <textarea class="form-control" placeholder="Sub Category Text" rows="5" required></textarea>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="button" id="btnFind" class="btn btn-primary">
                                        Find
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
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
                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
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

                                        <table id="lookupTbl" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
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
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary">
                            Post Article
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

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
                                                <legend>Search Category Setup</legend>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Category Name</label>
                                                    <div class="col-md-6">
                                                        <input id="categoryName" style="cursor: pointer;" class="form-control" placeholder="Category Name" type="search" readonly="readonly" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Sub Category Name</label>
                                                    <div class="col-md-6">
                                                        <input id="name" style="cursor: pointer;" class="form-control" placeholder="Sub Category Name" type="search" readonly="readonly" >
                                                    </div>
                                                </div>
                                                <div class="form-group" id="typeOfAnswer">
                                                    <label class="col-md-2 control-label">is Random Sub Category</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" id="isRandom">
                                                            <option selected hidden value="null">- Select -</option>
                                                            <option value="YES">YES</option>
                                                            <option value="NO">NO</option>
                                                        </select>
                                                    </div>
                                                 </div>
                                                 <div class="form-group" id="typeOfAnswer">
                                                    <label class="col-md-2 control-label">Only Get 1 Sub Category</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" id="getOneSubCat">
                                                            <option selected hidden value="null">- Select -</option>
                                                            <option value="YES">YES</option>
                                                            <option value="NO">NO</option>
                                                        </select>
                                                    </div>
                                                 </div>
                                                <div class="form-actions">
                                                    <div class="row ">
                                                        <div class="col-md-4">
                                                            <button class="btn btn-default" id="findBtn">
                                                                <i class="fa fa-search"></i>
                                                                Find
                                                            </button>
                                                            <a class="btn btn-warning" href="#ajax/category/category-form.blade.php"><i class="fa fa-plus"></i> New</a>

                                                            <!--<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                                                Launch demo modal
                                                            </button> -->
                                                        </div>
                                                    </div>

                                                </div>
                                            </fieldset>
                                            <legend> </legend>
                                            <div class="row">

                                                    <!-- NEW WIDGET START -->
                                                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                                        <!-- Widget ID (each widget will need unique ID)-->
                                                        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">

                                                            <header>
                                                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
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
                                                                                <th>Category Name</th>
                                                                                <th>Total Sub Category</th>
                                                                                <th>Is Random Question</th>
                                                                                <th>Only Get 1 Sub Category</th>
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

                                </div>
                                <!-- end widget div -->

                            </div>

                        </article>
                    </div>

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
        <script src="assets/js/misc.js"></script>

        <script type="text/javascript">

            // DO NOT REMOVE : GLOBAL FUNCTIONS!

            $(document).ready(function() {
                var responsiveHelper_dt_basic = undefined;

                    var breakpointDefinition = {
                        tablet : 1024,
                        phone : 480
                    };
                    // var table = $('#dt_basic').dataTable( {
                    //     "searching": false,
                    //     "scrollY":        "200px",
                    //     "scrollCollapse": true,
                    //     "paging":         false
                    // } );
                    $("#findBtn").click(function(){
                        // var q = $('#name').val();
                        // var t = $('#text').val()

                        getTables();
                        pageSetUp();
                        console.log('AKDNSD : '+$('#name').val());
                    });
                var getTables = function(){
                    var table = $('#dt_basic').DataTable({
                        "bDestroy": true,
                        "searching": false,
                        "ajax":{
                            "method":"GET",
                            "dataType" : "JSON",
                            "url":"/api/category",
                            "data" : {
                                "categoryName":$('#categoryName').val(),
                                "subCategoryName" : $('#name').val(),
                                "isRandom":$('#isRandom option:selected').val(),
                                "getOneSubCat":$('#getOneSubCat option:selected').val()
                            },
                        },
                        "columns":[
                            {
                                "data": "CATEGORY_ID",
                                "render": function (data, type, row) {
                                    return "<a href='#ajax/category/category-form.blade.php?id=" + data + "'>Detail</a>";
                                }
                            },
                            {"data":"CATEGORY_NAME"},
                            {"data":"TOTAL_SUB_CATEGORY"},
                            {
                                "data": "RANDOM_SUB_CATEGORY",
                                "render": function (data, type, row) {
                                    if(data == 1){
                                        return 'YES'
                                    }else{
                                        return 'NO'
                                    }
                                }
                            },
                            {
                                "data": "ONLY_GET_ONE_SUB_CATEGORY",
                                "render": function (data, type, row) {
                                    if(data == 1){
                                        return 'YES'
                                    }else{
                                        return 'NO'
                                    }
                                }
                            },
                            {"data":"LAST_UPDATED_DATE"},
                            {"data":"LAST_UPDATED_BY"}
                        ]
                    })
                };

            });
            </script>

