
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
<link href="assets/css/togle-btn.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/jquery.steps.css">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script> 
<style type="text/css"> 
    select[readonly]{
      pointer-events: none;
      color: #828282; 
    }
</style>
<form method="POST" action="saveAddSubCategory" id="form-subCat" enctype="multipart/form-data">
@csrf
<div class="row">

    <!-- NEW WIDGET START -->
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                <h2>Sub Category Setup</h2>
            </header>
            <div>
                <div class="widget-body">
                    <div class="form-horizontal">
                        <fieldset>
                            <legend>Create Sub Category Setup</legend>
                            <div class="col-xs-12 col-md-8">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Sub Category Name *</label>
                                    <div class="col-md-10">
                                        <input id="names" name="subCateName" class="form-control" placeholder="Sub Category Name" type="text" list="subCatName" autocomplete="off">
                                        <datalist id="subCatName">
                                            @foreach($subCat as $key => $val)
                                                <option value="{{$val->SUB_CATEGORY_NAME}}">{{$val->SUB_CATEGORY_NAME}}</option>
                                            @endforeach
                                        </datalist>
                                        <label style="color: red; display: none;" id="errorSubCatName">Name of Sub Category Must be Filled</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Description *</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="subCateDesc" id="subCateDesc" rows="4" required></textarea>
                                        <label style="color: red; display: none;" id="errorsubCateDesc">Description Must be Filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Work Instructions *</label>
                                    <div class="col-md-10">
                                        <textarea name="workInst" id="workInst"  required></textarea>
                                        <label style="color: red; display: none;" id="errorSubCatWOrkIns">Work Instruction Must be Filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Random Questions *</label>
                                    <div class="col-md-8">
                                        <input type="checkbox" name="subCateRandom" checked data-toggle="toggle" data-style="success">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Version *</label>
                                    <div class="col-md-4">
                                        <select class="form-control" id="Version" name="version">
                                            <option>New</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Effective Start Date *</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="subDateFrom" placeholder="Select a date" class="form-control" value="{{$arrDate['from']}}" id="effectiveStartDate" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <label style="color: red; display: none;" id="errorSubCatStartDate">Effective Start Date Must be Filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Effective End Date *</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="subDateTo" placeholder="{{$arrDate['to']}}" class="form-control" value="" id="effectiveEndDate">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <label style="color: red; display: none;" id="errorSubCatEndDate">Effective End Date Must be Filled</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend></legend>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-2">
                                        <div class="col-md-3">
                                            <button class="btn btn-warning" type="button" id="prev">
                                                <i class="fa fa-chevron-left"></i>
                                                    Prev Question
                                            </button>
                                        </div>
                                        <div class="col-md-1" id="queNumber">
                                            <h4></h4>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-warning" type="button" id="next">
                                                Next Question
                                                <i class="fa fa-chevron-right"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-danger" type="button" id="delete-question">
                                                Delete Question 
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <header>Question List</header>
                            <div id="wizards">
                                  
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-8">
                                    <button class="btn btn-primary" id="btnSaves">
                                        <i class="fa fa-save"></i>
                                            Save
                                    </button>
                                    <button class="btn btn-default">
                                        <a href="workspace#subcategory">
                                            Cancel
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>
</form>
<div class="default-question-form hide" >
    <input type="hidden" name="question_id[]" value="">
    <div class="form-group">
        <label class="col-md-2 control-label">Type Of Sub Category</label>
        <div class="col-md-8">
            <select class="form-control listSubCat" id="listSubCat" name="listSubCat[]">
                <option value="-">- Select -</option>
                <option value="ANALOGY">ANALOGY</option>
                <option value="SERIES COMPLETION">SERIES COMPLETION</option>
                <option value="CLASSIFICATION">CLASSIFICATION</option>
                <option value="MEMORY">MEMORY</option>
            </select>
            <label style="color: red; display: none;" id="errorTypeSubCategory" class="errorTypeSubCategory">Type of Sub Category Must be Filled</label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Is Actives</label>
        <div class="col-md-8">
            <input type="checkbox" id="isActive" class="isActive" name="isActive[]">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Duration Per Question</label>
        <div class="col-lg-2">
            <input class="form-control duration" placeholder="0" id="Duration" type="number" name="duration[]">
            <label style="color: red; display: none;" id="errorDuration" class="errorDuration">Duration must be filled</label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Is Example</label>
        <div class="col-md-8">
            <input type="checkbox" id="isExample" class="isExample" name="isExample[]">
            <label style="color: red; display: none;" id="errorIsExample">Hint or Text must be filled</label>
        </div>
    </div>
    <div class="form-group">
        <div class="inline-group">
            <label class="col-md-2 control-label">Hint</label>
            <div class="col-md-1">
                <input type="checkbox" id="chkTxtHint" disabled="true" class="chkTxtHint" name="chkTxtHint[]">
            </div>
            <label class="col-md-1 control-label">Text</label>
            <div class="col-md-6">
                <textarea class="form-control txtareaHint" rows="4" id="txtareaHint" disabled="true" name="txtareaHint[]"></textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="inline-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-1">
                <input type="checkbox" id="chkImgHint" class="chkImgHint" disabled="true" name="chkImgHint[]">
            </div>
            <label class="col-md-1 control-label">Image</label>
            <div class="col-md-6">
                  <input type="file" id="imgHint" name="imgHint[]" class="imgHint"disabled="true" style="border: solid 1px #ccc; padding: 5px 10px; width: 100%;" accept="image/*">

                <input type="hidden" name="imgHintText[]" value="">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Narration</label>
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-icon-left">
                        <input class="form-control" placeholder="Narration Name" id="narName" type="text" list="narations" autocomplete="off" name="naration_id[]">
                        <datalist id="narations">
                            @foreach($narations as $key => $val)
                                <option value="{{$val->NARRATION_NAME}}">{{$val->NARRATION_NAME}}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="inline-group">
            <label class="col-md-2 control-label">Question *</label>
            <div class="col-md-1">
                    <input type="checkbox" id="chkQueTxt" class="chkQueTxt" name="chkQueTxt[]">
            </div>
            <label class="col-md-1 control-label">Text</label>
            <div class="col-md-6">
                    <textarea class="form-control txtAreaQue" rows="4" id="txtAreaQue" disabled="true" name="txtAreaQue[]"></textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="inline-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-1">
                <input type="checkbox" id="chkQueImg" class="chkQueImg" name="chkQueImg[]">
            </div>
            <label class="col-md-1 control-label">Image</label>
            <div class="col-md-6">
                <input type="file" id="imgQue" disabled="true" class="imgQue" name="imgQue[]" style="border: solid 1px #ccc; padding: 5px 10px; width: 100%;" accept="image/*"> 
                <input type="hidden" name="imgQueText[]" value="" class="imgQueText">
            </div>
        </div>
    </div>
    <div class="form-group errorQuestion" style="display: none;" id="errorQuestion">
        <div class="inline-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-6">
                <label style="color: red;">Question Must be Filled</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Random Character</label>
        <div class="col-md-8">
            <input type="checkbox" id="randomCha" class="randomCha" name="randomCha[]" disabled="true">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Question Character</label>
        <div class="col-lg-2">
            <input class="form-control queCharacter" placeholder="0" id="queCharacter" type="number" disabled="true" name="queCharacter[]">
        </div>
    </div>
    <div class="form-group typeOfAnswer" id="typeOfAnswer">
        <label class="col-md-2 control-label">Type Of Answer *</label>
        <div class="col-md-8">
            <select class="form-control listTypeOfAnswer" id="listTypeOfAnswer" name="listTypeOfAnswer[]" readonly="true">
                <option value="-">- Select -</option>
                <option value="MULTIPLE_CHOICE">Multiple Choice </option>
                <option value="TEXT_SERIES">Text Series</option>
                <option value="MULTIPLE_GROUP">Multiple Group</option>
                <option value="MEMORY">Memory</option>
            </select>
            <label style="color: red; display: none;" id="errorTypeAnswer" class="errorTypeAnswer">Type of Answer Must be Filled</label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Random Answer *</label>
        <div class="col-md-8">
            <input type="checkbox" id="randomAnswer" name="randomAnswer[]">
        </div>
    </div>
    <!-- // ANSWER -->
    <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0"data-widget-editbutton="false">
        <header>
            <span class="widget-icon"></span>
            <h2>Question Answer</h2>
        </header>
        <div>
            <div class="widget-body">
                <div class="table-responsive">
                    <label style="color: red; display: none;" id="errorAnswer">Answer Must be Filled</label>
                    <table class="table table-bordered questionAnswerTbl" id="questionAnswerTbl">
                        <thead id="questionAnswerHead">
                            <tr>
                                <th class=".col-lg-9">Correct Answer</th>
                                <th class=".col-lg-2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="questionAnswerBody">
                              
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group col-xs-6 col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <a id="btnAddAnswer" class="btn btn-primary btnAddAnswer">
                            <i class="fa fa-plus"></i>
                                Add Answer
                        </a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div> 

<!-- PAGE RELATED PLUGIN(S) -->
<script src="assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.steps.js"></script>
<script src="assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script src="assets/js/plugin/ckeditor/ckeditor.js"></script>
<script src="assets/js/misc.js"></script>
<script src="js/app-add-subcategory.js"></script> 
