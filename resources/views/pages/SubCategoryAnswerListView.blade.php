<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet"> 
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>

<div class="row"> 
    <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
        <article class="col-sm-12 col-md-12 col-lg-12"> 
            <fieldset> 
                <input type="hidden" name="answer_id" id="answer_id" value=" ">
            <legend><h2>View Answer</h2> </legend> 
            <div class="widget-body">
                <div class="form-horizontal"> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sub Category Name *</label>
                            <div class="col-md-8"> 

                            </div>
                        </div> 
                         
                        <div class="form-group"> 
                            <label class="col-md-3 control-label">Question Text </label>
                            <div class="col-md-8"> 

                            </div>
                        </div> 
                        <div class="form-group"> 
                            <label class="col-md-3 control-label">Question Image </label>
                            <div class="col-md-8"> 

                            </div>
                        </div> 
                        <div class="form-group"> 
                            <label class="col-md-3 control-label">Type Of Answer</label>
                            <div class="col-md-8"> 
                                
                            </div>
                        </div> 
                    </div>  
                </div>

                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr> 
                                <th>Type Of Sub Category</th>
                                <th>Question Text</th>
                                <th>Question Image</th>
                                <th>Question Digit</th>
                                <th>Duration (Seconds)</th>
                                <th>Is Example</th>
                                <th>Is Active</th>
                                <th>Type Of Answer</th>
                                <th>Is Random Answer</th>
                                <th>Answer</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
            </div>
            </fieldset> 
        </article>
    </div>
</div>
  
<script src="assets/js/smartwidgets/jarvis.widget.min.js"></script>  
<script src="assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
 

<script type="text/javascript"> 
    $(document).ready(function() {
        console.log("LOAD");
        var responsiveHelper_dt_basic = undefined;

        var breakpointDefinition = {
            tablet : 1024,
            phone : 480
        };  
        var table = $('#dt_basic').DataTable({
            "bDestroy": true,
            "searching": false,
            "ajax":{
                "method":"GET",
                "dataType" : "JSON",
                "url":"getViewQuestion/"+$("#category_id").val() 
            },
            "columns":[ 
                {"data":"sub_category_name"},
                {"data":"question_text"},
                {"data":"question_image"},
                {"data":"question_digit"},
                {"data":"total_duration"}, 
                {
                    "data": "is_example",
                    "render": function (data, type, row) {
                        if(data == 1){
                            return 'YES'
                        }else{
                            return 'NO'
                        }
                    }
                }, 
                {
                    "data": "is_actived",
                    "render": function (data, type, row) {
                        if(data == 1){
                            return 'YES'
                        }else{
                            return 'NO'
                        }
                    }
                },
                {"data":"type_answer"}, 
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
                {
                    "data": "question_id",
                    "render": function (data, type, row) {
                        return " <a href='workspace#viewAnswer/" + data + "'>Answer</a>";
                    }
                }
            ]
        });  
    });
</script>