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
                                        <h2>Narration Setup</h2>

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
                                                    <legend>Search Narration Setup</legend>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Narration Name</label>
                                                        <div class="col-md-6">
                                                            <input id="name"class="form-control" placeholder="Narration Name" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Naration Text</label>
                                                        <div class="col-md-6">
                                                            <textarea id="text" class="form-control" placeholder="Narration Text" rows="4"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row ">
                                                            <div class="col-md-4">
                                                                <button class="btn btn-default" id="findBtn">
                                                                    <i class="fa fa-search"></i>
                                                                    Find
                                                                </button>
                                                                <a class="btn btn-warning" href="?#ajax/narration/naration-form.blade.php"><i class="fa fa-plus"></i> New</a>
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

                                                                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Action</th>
                                                                                    <th> Name</th>
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
                            var q = $('#name').val();
                            var t = $('#text').val();
                            getTables(q,t);
                            pageSetUp();
                        });
                    var getTables = function(q, text){
                        var table = $('#dt_basic').DataTable({
                            "bDestroy": true,
                            "searching": false,
                            "ajax":{
                                "method":"GET",
                                "dataType" : "JSON",
                                "url":"/api/naration",
                                "data" : {
                                    "q":q,
                                    "text":text
                                },
                            },
                            "columns":[
                                {
                                    "data": "narrationId",
                                    "render": function (data, type, row) {
                                        return "<a href='#ajax/narration/naration-form.blade.php?id=" + data + "'>Edit</a> | <a href='#ajax/narration/narration-view.blade.php?id=" + data + "'>View</a>";
                                    }
                                },
                                {"data":"narrationName"},
                                {"data":"lastUpdatedDate"},
                                {"data":"lastUpdatedBy"}
                            ]
                        })
                    };

                });
                </script>

            // DO NOT REMOVE : GLOBAL FUNCTIONS!

