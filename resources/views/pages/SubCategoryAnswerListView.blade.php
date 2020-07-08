<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet"> 
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>

<div class="row"> 
    <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
        <article class="col-sm-12 col-md-12 col-lg-12"> 
            <fieldset> 
                 <input type="hidden" name="category_id" id="category_id" value="{{$subCat['SUB_CATEGORY_ID']}}">
                <input type="hidden" name="question_id" id="question_id" value="{{$subCat['QUESTION_ID']}}">
            <legend><h2>View Answer</h2> </legend> 
            <div class="widget-body">
                <div class="row col-lg-12" style="border-bottom: 1px solid black;margin-bottom:10px;">
                    <div class="form-horizontal"> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Sub Category Name </label>
                                <div class="col-md-8"> 
                                    <?php echo $subCat['SUB_CATEGORY_NAME'];?>
                                </div>
                            </div> 
                             
                            <div class="form-group"> 
                                <label class="col-md-3 control-label">Question Text </label>
                                <div class="col-md-8"> 
                                    <?php echo $subCat['QUESTION_TEXT'];?>
                                </div>
                            </div> 
                            <div class="form-group"> 
                                <label class="col-md-3 control-label">Question Image </label>
                                <div class="col-md-8"> 
                                    <?php echo $subCat['QUESTION_IMG'];?>
                                </div>
                            </div> 
                            <div class="form-group"> 
                                <label class="col-md-3 control-label">Type Of Answer</label>
                                <div class="col-md-8"> 
                                    <?php echo $subCat['TYPE_ANSWER'];?>
                                    <input type="hidden" name="type_answer" id="type_answer" value="<?php echo $subCat['TYPE_ANSWER'];?>">
                                </div>
                            </div> 
                        </div>  
                    </div>
                </div>
                <div class="row col-lg-12">
                    <table id="multiple_choice_table" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr> 
                                <th>Choice Text</th>
                                <th>Choice Image</th>
                                <th>Correct Answer</th> 
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <table id="text_series_table" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>  
                                <th>Correct Answer</th> 
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <table id="multiple_group_table" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>  
                                <th>Image Question Sequence</th> 
                                <th>Group</th> 
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
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

        function loadMultiChoice(type_answer){ 
            console.log(type_answer);
            var table = $('#multiple_choice_table').DataTable({
                "bDestroy": true,
                "searching": false,
                "ajax":{
                    "method":"GET",
                    "dataType" : "JSON",
                    "url":"getViewAnswer/"+$("#question_id").val()+"/"+type_answer 
                },
                "columns":[ 
                    {"data":"CHOICE_TEXT"},
                    {"data":"CHOICE_IMG"},
                    {
                    "data": "CORRECT_ANSWER",
                    "render": function (data, type, row) {
                        if(data == 1){
                            return 'YES'
                        }else{
                            return 'NO'
                        }
                    }
                }, 
                ]
            }); 
        }

        function loadTextSeries(type_answer){
            var table = $('#text_series_table').DataTable({
                "bDestroy": true,
                "searching": false,
                "ajax":{
                    "method":"GET",
                    "dataType" : "JSON",
                    "url":"getViewAnswer/"+$("#question_id").val()+"/"+type_answer 
                },
                "columns":[ 
                    {"data":"CORRECT_TEXT"} 
                ]
            }); 
        }
        function loadMultipleGroup(type_answer){
            var table = $('#multiple_group_table').DataTable({
                "bDestroy": true,
                "searching": false,
                "ajax":{
                    "method":"GET",
                    "dataType" : "JSON",
                    "url":"getViewAnswer/"+$("#question_id").val()+"/"+type_answer 
                },
                "columns":[ 
                    {"data":"IMG_SEQUENCE"},
                    {"data":"GROUP_IMG"} 
                ]
            }); 
        }
        console.log("LOAD"); 

        var breakpointDefinition = {
            tablet : 1024,
            phone : 480
        };  

        var type_answer =$("#type_answer").val();

        if(type_answer == "MULTIPLE_CHOICE"){ 
            $('#multiple_choice_table').show();
            $('#text_series_table').hide();
            $('#multiple_group_table').hide();
            loadMultiChoice(type_answer);
        }else if(type_answer == "TEXT_SERIES"){

            $('#multiple_choice_table').hide();
            $('#text_series_table').show();
            $('#multiple_group_table').hide();
            loadTextSeries(type_answer);
        }else if(type_answer == "MULTIPLE_GROUP"){

            $('#multiple_choice_table').hide();
            $('#text_series_table').hide();
            $('#multiple_group_table').show();
            loadMultipleGroup(type_answer);
        }
        

        
    });
</script>