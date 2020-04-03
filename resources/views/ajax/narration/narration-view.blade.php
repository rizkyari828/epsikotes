
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <link href="assets/css/togle-btn.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
<div class="row">
    <div id="img_modal" title="Notification">
        <div id="contentholder">
        <img src="https://i3.ytimg.com/vi/vr0qNXmkUJ8/maxresdefault.jpg" alt="" style="width:100%">
        </div>
    </div>
    <!-- NEW WIDGET START -->
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">

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
                            <legend>View Narration Setup</legend>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Naration Name</label>
                                <div class="col-md-8">
                                    <input id="name" class="form-control" readonly type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Narration Text</label>
                                <div class="col-md-8">
                                        <textarea id="narrationText" name="ckeditor" disabled></textarea>
                                </div>
                            </div>


                        </fieldset>

                    </div>

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>

    </article>

    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">

            <header>
                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                <h2>Question List </h2>

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

                    <table id="q_list" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class=".col-lg-3">Sub Category Name</th>
                                <th class=".col-lg-5"> Question Text</th>
                                <th class=".col-lg-2"> Question Image</th>
                                <th class=".col-lg-1">Is Active </th>
                                <th class=".col-lg-1">Is Example</th>
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
                <h2>Job Mapping</h2>

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

                    <table id="jobTable" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class=".col-lg-9"> Job Mapping Name</th>
                                <th class=".col-lg-9"> General Instructions</th>
                                <th class=".col-lg-1"> Find Greating </th>
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
    <article>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-12">
                    <button style="display:none" class="btn btn-primary" id="btnSbtnSave">
                            <i class="fa fa-save"></i>
                            Save
                        </button>

                    <a class="btn btn-default" href="?#ajax/narration/narration-inquiry.blade.php"> Cancel</a>
            </div>
        </div>
    </div>
</article>
</div>


		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
		<script src="assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
		<script src="assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
		<script src="assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
        <script src="assets/js/misc.js"></script>
		<script type="text/javascript">

            // DO NOT REMOVE : GLOBAL FUNCTIONS!

            $(document).ready(function() {

                pageSetUp();

                /* // DOM Position key index //

                l - Length changing (dropdown)
                f - Filtering input (search)
                t - The Table! (datatable)
                i - Information (records)
                p - Pagination (paging)
                r - pRocessing
                < and > - div elements
                <"#id" and > - div with an id
                <"class" and > - div with a class
                <"#id.class" and > - div with an id and class

                Also see: http://legacy.datatables.net/usage/features
                */

                /* BASIC ;*/
                    var responsiveHelper_q_list = undefined;

                    var breakpointDefinition = {
                        tablet : 1024,
                        phone : 480
                    };

                    // $('#q_list').dataTable({
                    //     "searching": false,
                    //     "scrollY":        "200px",
                    //     "scrollCollapse": true,
                    //     "paging":         false
                    // });
                    // $('#jobTable').dataTable({
                    //     "searching": false,
                    //     "scrollY":        "200px",
                    //     "scrollCollapse": true,
                    //     "paging":         false
                    // });

                /* END BASIC */



            })

            </script>


<!-- PAGE RELATED PLUGIN(S) -->
<script src="assets/js/plugin/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var url      = window.location.href;
        var param = url.split('=');
        getHeader(param[1]);
        getQuestionList(param[1]);
        getJoblist(param[1]);
    });
    var getJoblist = function(id){
        var table = $('#jobTable').DataTable({
                            "bDestroy": true,
                            "searching": false,
                            "paging" :false,
                            "scrollY": "200px",
                            "scrollCollapse": true,
                            "ajax":{
                                "method":"GET",
                                "dataType" : "JSON",
                                "url":"/api/narration/list-jobs",
                                "data" : {
                                    "id":id
                                },
                            },
                            "columns":[
                                {"data":"jobName"},
                                {"data":"generalInst"},
                                {"data":"finalGreating"}
                            ]
                        })
                    };

    var getQuestionList = function(id){
        var table = $('#q_list').DataTable({
                            "bDestroy": true,
                            "searching": false,
                            "paging" :false,
                            "scrollY":        "200px",
                            "scrollCollapse": true,
                            "ajax":{
                                "method":"GET",
                                "dataType" : "JSON",
                                "url":"/api/narration/list-questions",
                                "data" : {
                                    "id":id
                                },
                            },
                            "columns":[
                                {"data":"categoryName"},
                                {"data":"questionText"},
                                {
                                    "data": "questionImg",
                                    "render": function (data, type, row) {
                                        return "<button onClick='openImage(\'"+data+"\')'>View</button>";
                                    }
                                },
                                {
                                    "data": "isActived",
                                    "render": function (data, type, row) {
                                        if(data == 1){
                                            return 'YES'
                                        }else{
                                            return 'NO'
                                        }
                                    }
                                },
                                {
                                    "data": "example",
                                    "render": function (data, type, row) {
                                        if(data == 1){
                                            return 'YES'
                                        }else{
                                            return 'NO'
                                        }
                                    }
                                }
                            ]
                        })
                    };

    var getHeader = function(param){
        $.ajax({
            url: "/api/narration/dtl",
            dataType : "JSON",
            method : "GET",
            data : {
                "id":param
            },
            cache: false,
            success: function(results){
                $.each(results, function(i, result){
                    $.each(result, function(i, field){
                        $('#name').val(field.narrationName);
                        CKEDITOR.instances.narrationText.setData(field.narrationText);
                        // $('#narrationText').html(field.narrationText);
                    });
                });
            }
        });
    }
$("#btnSave").click(function(){
    alert("OK");
});
</script>

<script type="text/javascript">

// DO NOT REMOVE : GLOBAL FUNCTIONS!

$(document).ready(function() {

CKEDITOR.replace( 'ckeditor', { height: '200px', startupFocus : true} );

})

</script>
