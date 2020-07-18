<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css"
      rel="stylesheet">
<link href="assets/css/togle-btn.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/jquery.steps.css">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>

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
                                    <label class="col-md-2 control-label">Sub Category Name</label>
                                    <div class="col-md-10">
                                        <input id="names" name="subCateName" class="form-control"
                                               placeholder="Sub Category Name" type="text" list="subCatName"
                                               autocomplete="off" value="{{$getSubCat->SUB_CATEGORY_NAME}}">
                                        <datalist id="subCatName">
                                            @foreach($subCat as $key => $val)
                                                <option
                                                    value="{{$val->SUB_CATEGORY_NAME}}">{{$val->SUB_CATEGORY_NAME}}</option>
                                            @endforeach
                                        </datalist>
                                        <label style="color: red; display: none;" id="errorSubCatName">Name of Sub
                                            Category Must be Filled</label>
                                    </div>
                                </div>
                                <input type="hidden" name="subCatId" id="subCateId"
                                       value="{{$getSubCat->SUB_CATEGORY_ID}}">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Description *</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="subCateDescs" id="subCateDesc" rows="4"
                                                  required>{{$getSubCat->DESCRIPTION}}</textarea>
                                        <label style="color: red; display: none;" id="errorsubCateDesc">Description Must
                                            be Filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Work Instructions *</label>
                                    <div class="col-md-10">
                                        <textarea name="ckeditor" id="workInst"
                                                  required>{!!$getSubCat->WORK_INSTRUCTION!!}</textarea>
                                        <label style="color: red; display: none;" id="errorSubCatWOrkIns">Work
                                            Instruction Must be Filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $checked = '';
                                    if ($getSubCat->RANDOM_QUESTION == 1) {
                                        $checked = 'checked';
                                    }
                                    ?>
                                    <label class="col-md-2 control-label">Random Questions</label>
                                    <div class="col-md-8">
                                        <input type="checkbox" name="subCateRandom" data-toggle="toggle"
                                               data-style="success"{{$checked}}>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Version</label>
                                    <div class="col-md-4">
                                        <select class="form-control" id="Version">
                                            <option value="New">New</option>
                                            @foreach($getVersionNumber as $key => $value)
                                                <option
                                                    value="{{$value->VERSION_ID}}" <?php if ($getSubCat->VERSION_NUMBER == $value->VERSION_NUMBER) echo "selected"; ?>>{{$value->VERSION_NUMBER}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Effective Start Date</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="mydate" placeholder="Select a date"
                                                   class="form-control" value="{{$getSubCat->DATE_FROM}}"
                                                   id="effectiveStartDate">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <label style="color: red; display: none;" id="errorSubCatStartDate">Effective
                                            Start Date Must be Filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Effective End Date</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="mydate2" placeholder="Select a date"
                                                   class="form-control" disabled="true" value="{{$getSubCat->DATE_TO}}"
                                                   id="effectiveEndDate">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <label style="color: red; display: none;" id="errorSubCatEndDate">Effective End
                                            Date Must be Filled</label>
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
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <header>Question List</header>
                            <div id="wizards">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Type Of Sub Category</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="listSubCat">
                                            <option value="-">- Select -</option>
                                            <option value="ANALOGY">ANALOGY</option>
                                            <option value="SERIES_COMPLETION">SERIES COMPLETION</option>
                                            <option value="CLASSIFICATION">CLASSIFICATION</option>
                                            <option value="MEMORY">MEMORY</option>
                                        </select>
                                        <label style="color: red; display: none;" id="errorTypeSubCategory">Type of Sub
                                            Category Must be Filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Is Actives</label>
                                    <div class="col-md-8">
                                        <input type="checkbox" id="isActive">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Duration Per Question</label>
                                    <div class="col-lg-2">
                                        <input class="form-control" placeholder="0" id="Duration" type="number">
                                        <label style="color: red; display: none;" id="errorDuration">Duration must be
                                            filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Is Example</label>
                                    <div class="col-md-8">
                                        <input type="checkbox" id="isExample">
                                        <label style="color: red; display: none;" id="errorIsExample">Hint or Text must
                                            be filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="inline-group">
                                        <label class="col-md-2 control-label">Hint</label>
                                        <div class="col-md-1">
                                            <input type="checkbox" id="chkTxtHint" disabled="true">
                                        </div>
                                        <label class="col-md-1 control-label">Text</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" rows="4" id="txtareaHint"
                                                      disabled="true"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="inline-group">
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-1">
                                            <input type="checkbox" id="chkImgHint" disabled="true">
                                        </div>
                                        <label class="col-md-1 control-label">Image</label>
                                        <div class="col-md-6">
                                            <input type="file" id="imgHint" disabled="true"
                                                   style="border: solid 1px #ccc; padding: 5px 10px; width: 100%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Narration</label>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-icon-left">
                                                    <input class="form-control" placeholder="Narration Name"
                                                           id="narName" type="text" list="narations">
                                                    <datalist id="narations">
                                                        @foreach($narations as $key => $val)
                                                            <option
                                                                value="{{$val->NARRATION_NAME}}">{{$val->NARRATION_NAME}}</option>
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
                                            <input type="checkbox" id="chkQueTxt">
                                        </div>
                                        <label class="col-md-1 control-label">Text</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" rows="4" id="txtAreaQue"
                                                      disabled="true"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="inline-group">
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-1">
                                            <input type="checkbox" id="chkQueImg">
                                        </div>
                                        <label class="col-md-1 control-label">Image</label>
                                        <div class="col-md-6">
                                            <input type="file" id="imgQue" disabled="true"
                                                   style="border: solid 1px #ccc; padding: 5px 10px; width: 100%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;" id="errorQuestion">
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
                                        <input type="checkbox" id="randomCha">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Question Character</label>
                                    <div class="col-lg-2">
                                        <input class="form-control" placeholder="0" id="queCharacter" type="number">
                                    </div>
                                </div>
                                <div class="form-group" id="typeOfAnswer">
                                    <label class="col-md-2 control-label">Type Of Answer *</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="listTypeOfAnswer">
                                            <option value="-">- Select -</option>
                                            <option value="MULTIPLE_CHOICE">Multiple Choice</option>
                                            <option value="TEXT_SERIES">Text Series</option>
                                            <option value="MULTIPLE_GROUP">Multiple Group</option>
                                            <option value="MEMORY">Memory</option>
                                        </select>
                                        <label style="color: red; display: none;" id="errorTypeAnswer">Type of Answer
                                            Must be Filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Random Answer *</label>
                                    <div class="col-md-8">
                                        <input type="checkbox" id="randomAnswer">
                                    </div>
                                </div>

                                <!-- // ANSWER -->
                                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0"
                                     data-widget-editbutton="false">
                                    <header>
                                        <span class="widget-icon"></span>
                                        <h2>Question Answer</h2>
                                    </header>
                                    <div>
                                        <div class="widget-body">
                                            <div class="table-responsive">
                                                <label style="color: red; display: none;" id="errorAnswer">Answer Must
                                                    be Filled</label>
                                                <table class="table table-bordered" id="questionAnswerTbl">
                                                    <thead id="questionAnswerHead">
                                                    <tr>
                                                        <th class=".col-lg-9">Correct Answer</th>
                                                        <th class=".col-lg-2">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="questionAnswerBody">
                                                    <!-- <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <input class="form-control" placeholder="Correct Answer" type="text">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="col-md-2">
                                                                    <a class="btn btn-warning"><i class="fa fa-trash-o"></i></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-6 col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button id="btnAddAnswer" class="btn btn-primary">
                                                        <i class="fa fa-plus"></i>
                                                        Add Answer
                                                    </button>
                                                    <button id="btnDeleteAnswer" class="btn btn-danger">
                                                        <i class="fa fa-trash-o"></i>
                                                        Delete All Answers
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-8">
                                    <button class="btn btn-primary" id="btnSaves">
                                        <i class="fa fa-save"></i>
                                        Save
                                    </button>
                                    <a href="#subcategory">
                                        <button class="btn btn-default">
                                            Cancel
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>

<?php
$formQue2 = array();
$ansMultipleChoice2 = array();
$ansMultipleGroup2 = array();
$ansTextSeries2 = array();

foreach ($getQuestions as $key => $value) {
    $formQue2[$key][0] = $value->TYPE_SUB_CATEGORY;
    $formQue2[$key][1] = $value->IS_ACTIVED;
    $formQue2[$key][2] = $value->DURATION_PER_QUE;
    $formQue2[$key][3] = $value->EXAMPLE;
    $formQue2[$key][4] = $value->HINT_TEXT;
    $formQue2[$key][5] = $value->HINT_IMG;
    $formQue2[$key][6] = $value->NARRATION_ID;
    $formQue2[$key][7] = $value->QUESTION_TEXT;
    $formQue2[$key][8] = $value->QUESTION_IMG;
    $formQue2[$key][9] = $value->TYPE_ANSWER;
    $formQue2[$key][10] = $value->RANDOM_ANSWER;
    $formQue2[$key][11] = $value->QUESTION_CHARACTER;
    $formQue2[$key][12] = $value->RANDOM_CHARACTER;
    $formQue2[$key][13] = $value->QUESTION_ID;

    if ($value->TYPE_ANSWER === 'MULTIPLE_CHOICE') {
        for ($i = 0; $i < count($getAnsChoices); $i++) {
            foreach ($getAnsChoices[$i] as $keys => $values) {
                if ($values->QUESTION_ID == $value->QUESTION_ID) {
                    $arrAns = [$key, $values->CHOICE_TEXT, $values->CHOICE_IMG, $values->CORRECT_ANSWER, $value->QUESTION_ID];
                    array_push($ansMultipleChoice2, $arrAns);
                }
            }
        }
    } elseif ($value->TYPE_ANSWER === 'MULTIPLE_GROUP') {
        for ($i = 0; $i < count($getAnsGroup); $i++) {
            foreach ($getAnsGroup[$i] as $keys => $values) {
                if ($values->QUESTION_ID == $value->QUESTION_ID) {
                    $arrAns = [$key, $values->IMG_SEQUENCE, $values->GROUP_IMG, $value->QUESTION_ID];
                    array_push($ansMultipleGroup2, $arrAns);
                }
            }
        }
    } elseif ($value->TYPE_ANSWER === 'TEXT_SERIES') {
        for ($i = 0; $i < count($getAnsTextSeries); $i++) {
            foreach ($getAnsTextSeries[$i] as $keys => $values) {
                if ($values->QUESTION_ID == $value->QUESTION_ID) {
                    $arrAns = [$key, $values->CORRECT_TEXT, $value->QUESTION_ID];
                    array_push($ansTextSeries2, $arrAns);
                }
            }
        }
    }
}
// echo "<pre>";
// print_r($formQue2);

?>


<!-- PAGE RELATED PLUGIN(S) -->
<script src="assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.steps.js"></script>
<script src="assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script src="assets/js/plugin/ckeditor/ckeditor.js"></script>
<script src="assets/js/misc.js"></script>
<script type="text/javascript">
    $('#effectiveStartDate').datepicker({
        dateFormat: 'dd-M-yy',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });
    $('#effectiveEndDate').datepicker({
        dateFormat: 'dd-M-yy',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function () {
        CKEDITOR.replace('ckeditor', {height: '200px', startupFocus: true});
        var indexQue = 0;
        var x = document.getElementById("wizards");
        var formQue = <?php echo json_encode($formQue2); ?>;
        var ansMultipleChoice = <?php echo json_encode($ansMultipleChoice2); ?>;
        var ansTextSeries = <?php echo json_encode($ansTextSeries2); ?>;
        var ansMultipleGroup = <?php echo json_encode($ansMultipleGroup2); ?>;
        var tblBody_1 = "<tr>" +
            "<td>" +
            "<div class='form-group'>" +
            "<div class='col-md-8'>" +
            "<input class='form-control multChoiceTxt' placeholder='Choice Text' name='multChoiceTxt[]' type='text'>" +
            "</div>" +
            "</div>" +
            "</td>" +
            "<td>" +
            "<div class='form-group'>" +
            "<div class='col-md-4'>" +
            "<input type='file' id='exampleInputFile1' name='multChoiceImg[]' style='border: solid 1px #ccc; padding: 5px 10px;'>" +
            "</div>" +
            "</div>" +
            "</td>" +
            "<td align='center'>" +
            "<div class='form-group'>" +
            "<div class='col-md-12' >" +
            "<input type='checkbox' class='btn btn-default' id='' name='multChoiceCorrect[]'>" +
            "</div>" +
            "</div>" +
            "</td>" +
            "<td>" +
            "<div class='form-group'>" +
            "<div class='col-md-1'>" +
            "<button class='btnDelete btn btn-warning'><i class='fa fa-trash-o'></i></button>" +
            "</div>" +
            "</div>" +
            "</td>" +
            "</tr>";
        var tblHead_1 = "<thead><tr>" +
            "<th class='col-lg-6'>Choice Text</th>" +
            "<th class='col-lg-2'>Choice Image</th>" +
            "<th class='col-lg-2'>Correct Answer</th> " +
            "<th class='col-lg-1'>Action</th> " +
            "</tr></thead>";

        var tblHead_2 = "<thead>" +
            "<tr>" +
            "<th class='.col-lg-9'>Correct Answer</th>" +
            "<th class='.col-lg-2'>Action</th>" +
            "</tr>" +
            "</thead>";
        var tblBody_2 = "<tr>" +
            "<td>" +
            "<div class='form-group'>" +
            "<div class='col-md-12'>" +
            "<input class='form-control' name='txtSeriesChoices[]' placeholder='Correct Answer' id='txtSeries' type='text'>" +
            "</div>" +
            "</div>" +
            "</td>" +
            "<td>" +
            "<div class='form-group'>" +
            "<div class='col-md-2'>" +
            "<a class='btnDelete btn btn-warning'><i class='fa fa-trash-o'></i></a>" +
            "</div>" +
            "</div>" +
            "</td>" +
            "</tr>";
        var tblHead_3 = "<thead><tr>" +
            "<th class='.col-lg-7'>Image Question Sequence</th>" +
            "<th class='.col-lg-4'>Group</th>" +
            "<th class='.col-lg-1'>Action</th> " +
            "</tr></thead>";
        var tblBody_3 = "<tr>" +
            "<td>" +
            "<div class='form-group'>" +
            "<div class='col-md-12'>" +
            "<input class='form-control' name='ansMultGroupImgSeq[]' placeholder='Image Sequence' type='text'>" +
            "</div>" +
            "</div>" +
            "</td>" +
            "<td>" +
            "<div class='form-group'>" +
            "<div class='col-md-12'>" +
            "<input class='form-control' name='ansMultGroupImg[]' placeholder='Group Image' type='text'>" +
            "</div>" +
            "</div>" +
            "</td>" +
            "<td>" +
            "<div class='form-group'>" +
            "<div class='col-md-1'>" +
            "<a class='btnDelete btn btn-warning'><i class='fa fa-trash-o'></i></a>" +
            "</div>" +
            "</div>" +
            "</td>" +
            "</tr>";
        setVal();
        disableAll();

        console.log(formQue.length);
        if(formQue.length == 1){
            $("#next").attr("disabled","disabled");
        }
        // SUB CATEGORY EVENT
        $("#listSubCat").change(function () {
            var selected = $('#listTypeOfAnswer').val();
            var divToChange = $("#typeOfAnswer");
            if (selected == "ELSE") {
                $("listTypeOfAnswer").toggle();
            }
        });
        // TYPE OF ANSWER EVENT
        $("#listTypeOfAnswer").change(function () {
            var selected = $('#listTypeOfAnswer').val();
            var table = $("#questionAnswerTbl");
            var returnTHead = "";
            var returnTBody = "";

            var tblHead_4 = "";
            var tblBody_4 = "";
            if (selected == 'MULTIPLE_CHOICE') {
                returnTHead = tblHead_1;
                returnTBody = tblBody_1;
            } else if (selected == 'TEXT_SERIES') {
                returnTHead = tblHead_2;
                returnTBody = tblBody_2;
            } else if (selected == 'MULTIPLE_GROUP') {
                returnTHead = tblHead_3;
                returnTBody = tblBody_3;
            } else {
                returnTHead = tblHead_4;
                returnTBody = tblBody_4;
            }

            table.find("thead").remove();
            table.find("tr").remove();
            table.append(returnTHead);
            table.append(returnTBody);
        });

        // DO NOT REMOVE : GLOBAL FUNCTIONS!
        $("#questionAnswerTbl").on('click', '.btnDelete', function () {
            $(this).closest('tr').remove();
        });

        $('#btnDeleteAnswer').click(function () {
            var selected = $('#listTypeOfAnswer').val();
            var table = $("#questionAnswerTbl");
            if (selected == 'MULTIPLE_CHOICE') {
                table.find("tbody").remove();
                table.append(tblBody_1);
            } else if (selected == 'TEXT_SERIES') {
                table.find("tbody").remove();
                table.append(tblBody_2);
            } else if (selected == 'MULTIPLE_GROUP') {
                table.find("tbody").remove();
                table.append(tblBody_3);
            }
        });

        $('#btnAddAnswer').click(function () {
            var selected = $('#listTypeOfAnswer').val();
            var table = $("#questionAnswerTbl tbody");
            if (selected == 'MULTIPLE_CHOICE') {
                table.append(tblBody_1);
            } else if (selected == 'TEXT_SERIES') {
                table.append(tblBody_2);
            } else if (selected == 'MULTIPLE_GROUP') {
                table.append(tblBody_3);
            }
        });
        $("#queNumber h4").html(indexQue+1);
        if (indexQue < 1)
            document.getElementById("prev").disabled = true;

        $("#next").click(function () { 
            var validate = validateQuestion();
            if (validate) {
                getValFormQuestion();
                resetFormQuestion();
                var countQue = formQue.length;
                indexQue++;
                // console.log(countQue);
                // console.log(indexQue);

                if (indexQue == (countQue - 1) && $("#Version").val() != "New") {
                   $("#next").prop("disabled",true);
                }
                // $("#queNumber h4").html(indexQue+1);
                $("#queNumber h4").html(indexQue+1);
                $("#wizards").hide("slow");
                $("#wizards").show("slow");
                document.getElementById("prev").disabled = false;
                if (indexQue < countQue) {
                    setVal();
                }
            } else {
                alert('Ada data yg belum di isi');
                 
            }


        });
        $("#prev").click(function () {
            var validate = validateQuestion();
            if (validate) {
                getValFormQuestion();
                resetFormQuestion();
                var countQue = formQue.length;
                indexQue--;
                // $("#queNumber h4").html(indexQue+1);
                

                if (indexQue == (countQue - 2) && $("#Version").val() != "New") {
                   $("#next").prop("disabled",false);
                }
                $("#queNumber h4").html(indexQue+1);
                $("#wizards").hide("slow");
                $("#wizards").show("slow");
                if (indexQue < countQue) {
                    setVal();
                }
                if (indexQue < 1)
                    document.getElementById("prev").disabled = true;
            } else {
                alert('Ada data yg belum di isi');
            }
        });
        $("#btnSaves").click(function (e) {
            e.preventDefault();
            var validateHeaders = validateHeader();
            var validate = validateQuestion();
            if (validateHeaders) {
                if (validate) {
                    getValFormQuestion();
                    var jsonQueList = JSON.stringify(formQue);
                    var jsonAnsMultChoice = JSON.stringify(ansMultipleChoice);
                    var jsonAnsTextSeries = JSON.stringify(ansTextSeries);
                    var jsonAnsMultGroup = JSON.stringify(ansMultipleGroup);
                    $.ajax({
                        type: "POST",
                        url: "saveEditSubCate",
                        dataType: "json",
                        cache: false,
                        data: {
                            _token: $('input[name="_token"]').val(),
                            subCateName: $('input[name="subCateName"]').val(),
                            subCateDesc: $('textarea[name="subCateDescs"]').val(),
                            subCateInst: CKEDITOR.instances.workInst.getData(),
                            subCateRandom: $('input[name="subCateRandom"]').val(),
                            subDateFrom: $('input[name="mydate"]').val(),
                            subDateTo: $('input[name="mydate2"]').val(),
                            subCateId: $('input[name="subCatId"]').val(),
                            queLists: jsonQueList,
                            ansMultipleChoice: jsonAnsMultChoice,
                            ansTextSeries: jsonAnsTextSeries,
                            ansMultipleGroup: jsonAnsMultGroup
                        },
                        success: function (msg) {
                            console.log(msg);
                            alert('sukses');
                            location.href = "#subcategory";
                        },
                        error: function (msg) {
                            console.log(msg);
                            alert('sukseess');
                            location.href = "#subcategory";
                        }
                    });
                    // document.getElementById("form-subCat").submit();
                } else {
                    alert('Ada data yg belum di isi');
                }
            } else {
                alert('Ada data yg belum di isi');
            }
        });

        function validateHeader() {
            var validate = true;
            var names = document.getElementById('names').value;
            var desc = document.getElementById('subCateDesc').value;
            var inst = CKEDITOR.instances.workInst.getData();
            var startDate = document.getElementById('effectiveStartDate').value;
            var EndDate = document.getElementById('effectiveEndDate').value;

            if (names == '') {
                document.getElementById("errorSubCatName").style.display = 'block';
                var validate = false;
            } else {
                document.getElementById("errorSubCatName").style.display = 'none';
            }
            if (desc == '') {
                document.getElementById("errorsubCateDesc").style.display = 'block';
                var validate = false;
            } else {
                document.getElementById("errorsubCateDesc").style.display = 'none';
            }
            if (inst == '') {
                document.getElementById("errorSubCatWOrkIns").style.display = 'block';
                var validate = false;
            } else {
                document.getElementById("errorSubCatWOrkIns").style.display = 'none';
            }
            if (startDate == '') {
                document.getElementById("errorSubCatStartDate").style.display = 'block';
                var validate = false;
            } else {
                document.getElementById("errorSubCatStartDate").style.display = 'none';
            }
            if (EndDate == '') {
                document.getElementById("errorSubCatEndDate").style.display = 'block';
                var validate = false;
            } else {
                document.getElementById("errorSubCatEndDate").style.display = 'none';
            }

            if (validate) {
                return true;
            } else {
                return false;
            }
        }

        function validateQuestion() {
            var validate = true;
            var a = document.getElementById("listSubCat").value;
            var b = document.getElementById("isActive").checked;
            var c = document.getElementById("Duration").value;
            var d = document.getElementById("isExample").checked;
            var e = document.getElementById("txtareaHint").value;
            var f = document.getElementById("imgHint").value;
            var g = document.getElementById("narName").value;
            var h = document.getElementById("txtAreaQue").value;
            var i = document.getElementById("imgQue").value;
            var j = document.getElementById("listTypeOfAnswer").value;
            var k = document.getElementById("randomAnswer").checked;
            var l = document.getElementById("queCharacter").value;
            var m = document.getElementById("randomCha").checked;
            if (a == '-') {
                document.getElementById("errorTypeSubCategory").style.display = 'block';
                validate = false;
            } else if (a != 'MEMORY') {
                document.getElementById("errorTypeSubCategory").style.display = 'none';

                // if (h == '' && i == '') {
                //     document.getElementById("errorQuestion").style.display = 'block';
                //     validate = false;
                // } else {
                //     document.getElementById("errorQuestion").style.display = 'none';
                // }
                if (j == '-') {
                    document.getElementById("errorTypeAnswer").style.display = 'block';
                    validate = false;
                } else {
                    document.getElementById("errorTypeAnswer").style.display = 'none';
                }
                // if(j == 'MULTIPLE_CHOICE' && ansMultipleChoice.length < 1){
                //     document.getElementById("errorAnswer").style.display = 'block';
                // }else if(j == 'TEXT_SERIES'  && ansTextSeries.length < 1){
                //     document.getElementById("errorAnswer").style.display = 'block';
                // }else if(j == 'MULTIPLE_GROUP'  && ansMultipleGroup.length < 1){
                //     document.getElementById("errorAnswer").style.display = 'block';
                // }else{
                //     document.getElementById("errorAnswer").style.display = 'none';
                // }
            }
            if (d) {
                if (e == '' && f == '') {
                    document.getElementById("errorIsExample").style.display = 'block';
                    validate = false;
                } else {
                    document.getElementById("errorIsExample").style.display = 'none';
                }
            } else {
                document.getElementById("errorIsExample").style.display = 'none';
            }
            if (c == '') {
                document.getElementById("errorDuration").style.display = 'block';
                validate = false;
            } else {
                document.getElementById("errorDuration").style.display = 'none';
            }

            if (validate) {
                return true;
            } else {
                return false;
            }

        }

        function getValFormQuestion() {
            var a = document.getElementById("listSubCat").value;
            var b = document.getElementById("isActive").checked;
            var c = document.getElementById("Duration").value;
            var d = document.getElementById("isExample").checked;
            var e = document.getElementById("txtareaHint").value;
            var f = document.getElementById("imgHint").value;
            var g = document.getElementById("narName").value;
            var h = document.getElementById("txtAreaQue").value;
            var i = document.getElementById("imgQue").value;
            var j = document.getElementById("listTypeOfAnswer").value;
            var k = document.getElementById("randomAnswer").checked;
            var l = document.getElementById("queCharacter").value;
            var m = document.getElementById("randomCha").checked;
            // GET ANSWER AND PUSH TO ARRAY
            if (j == 'MULTIPLE_CHOICE') {
                var l = document.getElementsByName("multChoiceTxt[]");
                var l2 = document.getElementsByName("multChoiceImg[]");
                var l3 = document.getElementsByName("multChoiceCorrect[]");
                var length = ansMultipleChoice.length;
                var arrIndex = Array();
                if (length > 0) {
                    for (var z = 0; z < length; z++) {
                        var index = ansMultipleChoice[z].indexOf(indexQue);
                        if (index !== -1) {
                            arrIndex.push(z);
                        }
                    }
                    arrIndex.sort(function (a, b) {
                        return b - a
                    });
                    // for (var x = 0; x < arrIndex.length; x++) {
                    //     ansMultipleChoice.splice(arrIndex[x], 1);
                    // }
                }
                for (var z = 0; z < l.length; z++) {
                    var val = l[z].value;
                    var val2 = l2[z].value;
                    var val3 = l3[z].checked;
                    // ansMultipleChoice.push([indexQue, val, val2, val3]);
                }
                // alert(ansMultipleChoice);
            } else if (j == 'TEXT_SERIES') {
                var txtSeries = document.getElementsByName("txtSeriesChoices[]");
                var length = ansTextSeries.length;
                var arrIndex = Array();
                if (length > 0) {
                    for (var z = 0; z < length; z++) {
                        var index = ansTextSeries[z].indexOf(indexQue);
                        if (index !== -1) {
                            arrIndex.push(z);
                        }
                    }
                    arrIndex.sort(function (a, b) {
                        return b - a
                    });
                    for (var x = 0; x < arrIndex.length; x++) {
                        ansTextSeries.splice(arrIndex[x], 1);
                    }
                }
                for (var z = 0; z < txtSeries.length; z++) {
                    var val = txtSeries[z].value;
                    ansTextSeries.push([indexQue, val]);
                }
            } else if (j == 'MULTIPLE_GROUP') {
                var l = document.getElementsByName("ansMultGroupImgSeq[]");
                var l2 = document.getElementsByName("ansMultGroupImg[]");
                var length = ansMultipleGroup.length;
                var arrIndex = Array();
                if (length > 0) {
                    for (var z = 0; z < length; z++) {
                        var index = ansMultipleGroup[z].indexOf(indexQue);
                        if (index !== -1) {
                            arrIndex.push(z);
                        }
                    }
                    arrIndex.sort(function (a, b) {
                        return b - a
                    });
                    for (var x = 0; x < arrIndex.length; x++) {
                        ansMultipleGroup.splice(arrIndex[x], 1);
                    }
                }
                for (var z = 0; z < l.length; z++) {
                    var val = l[z].value;
                    var val2 = l2[z].value;
                    ansMultipleGroup.push([indexQue, val, val2]);
                }
            }

            // PUSH QUESTION TO ARRAY
            if (formQue[indexQue] == null) {
                formQue.push([a, b, c, d, e, f, g, h, i, j, k, l, m]);
            } else {
                formQue[indexQue][0] = a;
                formQue[indexQue][1] = b;
                formQue[indexQue][2] = c;
                formQue[indexQue][3] = d;
                formQue[indexQue][4] = e;
                formQue[indexQue][5] = f;
                formQue[indexQue][6] = g;
                formQue[indexQue][7] = h;
                formQue[indexQue][8] = i;
                formQue[indexQue][9] = j;
                formQue[indexQue][10] = k;
                formQue[indexQue][11] = l;
                formQue[indexQue][12] = m;
            }
        }

        function resetFormQuestion() {
            document.getElementById("listSubCat").value = '-';
            document.getElementById("isActive").checked = false;
            document.getElementById("Duration").value = '';
            document.getElementById("isExample").checked = false;
            document.getElementById("txtareaHint").value = '';
            document.getElementById("imgHint").value = '';
            document.getElementById("narName").value = '';
            document.getElementById("txtAreaQue").value = '';
            document.getElementById("imgQue").value = '';
            document.getElementById("listTypeOfAnswer").value = '-';
            document.getElementById("randomAnswer").checked = false;
            document.getElementById("chkTxtHint").checked = false;
            document.getElementById("chkImgHint").checked = false;
            document.getElementById("chkQueTxt").checked = false;
            document.getElementById("chkQueImg").checked = false;
            document.getElementById("queCharacter").value = '';
            document.getElementById("randomCha").checked = false;

            var table = $("#questionAnswerTbl");
            table.find("thead").remove();
            table.find("tr").remove();
        }

        function setVal() {
            console.log("SET VALUE");
            // console.log(formQue[indexQue]);
            document.getElementById("listSubCat").value = formQue[indexQue][0];
            document.getElementById("isActive").checked = formQue[indexQue][1];
            document.getElementById("Duration").value = formQue[indexQue][2];
            document.getElementById("isExample").checked = formQue[indexQue][3];
            document.getElementById("txtareaHint").value = formQue[indexQue][4];
            // document.getElementById("imgHint").value = formQue[indexQue][5];
            document.getElementById("narName").value = formQue[indexQue][6];
            document.getElementById("txtAreaQue").value = formQue[indexQue][7];
            // document.getElementById("imgQue").value = formQue[indexQue][8];
            document.getElementById("listTypeOfAnswer").value = formQue[indexQue][9];
            document.getElementById("randomAnswer").checked = formQue[indexQue][10];
            document.getElementById("queCharacter").value = formQue[indexQue][11];
            document.getElementById("randomCha").checked = formQue[indexQue][12];
            if (formQue[indexQue][4] != '')
                document.getElementById("chkTxtHint").checked = true;
            if (formQue[indexQue][5] != '')
                document.getElementById("chkImgHint").checked = true;
            // SET CHOICES VALUE
            var table = $("#questionAnswerTbl");
            if (formQue[indexQue][9] == 'MULTIPLE_CHOICE') {
                var length = ansMultipleChoice.length;
                var arrIndex = Array();
                for (var z = 0; z < length; z++) {
                    if (ansMultipleChoice[z][0] == indexQue) {
                        table.append(tblBody_1);
                    }
                    var index = ansMultipleChoice[z].indexOf(indexQue);
                    if (index !== -1) {
                        arrIndex.push(z);
                    }
                }
                var l = document.getElementsByName("multChoiceTxt[]");
                var l2 = document.getElementsByName("multChoiceImg[]");
                var l3 = document.getElementsByName("multChoiceCorrect[]");
                for (var z = 0; z < l.length; z++) {
                    l[z].value = ansMultipleChoice[arrIndex[z]][1];
                    // l2[z].value = ansMultipleChoice[arrIndex[z]][2];
                    l3[z].checked = ansMultipleChoice[arrIndex[z]][3];
                }
            } else if (formQue[indexQue][9] == 'TEXT_SERIES') {
                var length = ansTextSeries.length;
                var arrIndex = Array();
                for (var z = 0; z < length; z++) {
                    if (ansTextSeries[z][0] == indexQue) {
                        table.append(tblBody_2);
                    }
                    var index = ansTextSeries[z].indexOf(indexQue);
                    if (index !== -1) {
                        arrIndex.push(z);
                    }
                }
                var l = document.getElementsByName("txtSeriesChoices[]");
                for (var z = 0; z < l.length; z++) {
                    l[z].value = ansTextSeries[arrIndex[z]][1];
                }
            } else if (formQue[indexQue][9] == 'MULTIPLE_GROUP') {
                var length = ansMultipleGroup.length;
                var arrIndex = Array();
                for (var z = 0; z < length; z++) {
                    if (ansMultipleGroup[z][0] == indexQue) {
                        table.append(tblBody_3);
                    }
                    var index = ansMultipleGroup[z].indexOf(indexQue);
                    if (index !== -1) {
                        arrIndex.push(z);
                    }
                }
                var l = document.getElementsByName("ansMultGroupImgSeq[]");
                var l2 = document.getElementsByName("ansMultGroupImg[]");
                for (var z = 0; z < l.length; z++) {
                    l[z].value = ansMultipleGroup[arrIndex[z]][1];
                    l2[z].value = ansMultipleGroup[arrIndex[z]][2];
                }
            }
        }

        $("#isExample").click(function () {
            a = document.getElementById("isExample").checked;
            if (a) {
                document.getElementById("chkImgHint").disabled = false;
                document.getElementById("chkTxtHint").disabled = false;
            } else {
                document.getElementById("chkImgHint").disabled = true;
                document.getElementById("chkTxtHint").disabled = true;
            }
        });
        $("#chkTxtHint").click(function () {
            a = document.getElementById("chkTxtHint").checked;
            if (a)
                document.getElementById("txtareaHint").disabled = false;
            else {
                document.getElementById("txtareaHint").disabled = true;
                document.getElementById("txtareaHint").value = '';
            }
        });
        $("#chkImgHint").click(function () {
            a = document.getElementById("chkImgHint").checked;
            if (a)
                document.getElementById("imgHint").disabled = false;
            else {
                document.getElementById("imgHint").disabled = true;
                document.getElementById("imgHint").value = '';
            }
        });
        $("#chkQueTxt").click(function () {
            a = document.getElementById("chkQueTxt").checked;
            if (a)
                document.getElementById("txtAreaQue").disabled = false;
            else {
                document.getElementById("txtAreaQue").disabled = true;
                document.getElementById("txtAreaQue").value = '';
            }
        });
        $("#chkQueImg").click(function () {
            a = document.getElementById("chkQueImg").checked;
            if (a)
                document.getElementById("imgQue").disabled = false;
            else {
                document.getElementById("imgQue").disabled = true;
                document.getElementById("imgQue").value = '';
            }
        });


        $("#namesa").autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: "POST",
                    url: "getSubCategories",
                    dataType: "json",
                    data: {
                        _token: $('input[name="_token"]').val(),
                        categoryName: request.term
                    },
                    success: function (data) {
                        response($.map(data.data_rows, function (item) {
                            return {
                                label: item.categoryName,
                                value: item.categoryName
                            }
                        }));
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

        $("#Version").change(function () {
            console.log(indexQue);
            var version = document.getElementById('Version').value;

            var countQue = formQue.length;
            if (indexQue == (countQue - 1) && $("#Version").val() == "New") {
               $("#next").prop("disabled",false);
            }   

            if (version != 'New') {
                disableAll();
            } else {
                enableAll();
            }
        });

        function disableAll() {
            console.log("DISABLED ALL");
            document.getElementById('names').disabled = true;
            document.getElementById('subCateDesc').disabled = true;
            document.getElementById('workInst').disabled = true;
            document.getElementById('effectiveStartDate').disabled = true;
            document.getElementById("listSubCat").disabled = true;
            document.getElementById("isActive").disabled = true;
            document.getElementById("Duration").disabled = true;
            document.getElementById("isExample").disabled = true;
            document.getElementById("txtareaHint").disabled = true;
            document.getElementById("imgHint").disabled = true;
            document.getElementById("narName").disabled = true;
            document.getElementById("txtAreaQue").disabled = true;
            document.getElementById("imgQue").disabled = true;
            document.getElementById("listTypeOfAnswer").disabled = true;
            document.getElementById("randomAnswer").disabled = true;
            document.getElementById("queCharacter").disabled = true;
            document.getElementById("randomCha").disabled = true;
            document.getElementById("chkTxtHint").disabled = true;
            document.getElementById("chkImgHint").disabled = true;
            document.getElementById("chkQueImg").disabled = true;
            document.getElementById("chkQueTxt").disabled = true;
             $('.multChoiceTxt').attr('disabled', 'disabled');
            // document.getElementsByName("multChoiceTxt[]").disabled = true;
            document.getElementsByName("multChoiceImg[]").disabled = true;
            document.getElementsByName("multChoiceCorrect[]").disabled = true;
            document.getElementsByName("txtSeriesChoices[]").disabled = true;
            document.getElementsByName("ansMultGroupImgSeq[]").disabled = true;
            document.getElementsByName("ansMultGroupImg[]").disabled = true;

            document.getElementById("btnSaves").disabled = true;

            // var today = new Date();
            // var tomorrow = new Date();
            // tomorrow.setDate(today.getDate()+1);
            // document.getElementById("dtfrom").value = tomorrow;
        }

        function enableAll() {
            console.log("enableAll");
            document.getElementById('names').disabled = false;
            document.getElementById('subCateDesc').disabled = false;
            document.getElementById('workInst').disabled = false;
            document.getElementById('effectiveStartDate').disabled = false;
            document.getElementById("listSubCat").disabled = false;
            document.getElementById("isActive").disabled = false;
            document.getElementById("Duration").disabled = false;
            document.getElementById("isExample").disabled = false;
            document.getElementById("txtareaHint").disabled = false;
            document.getElementById("imgHint").disabled = false;
            document.getElementById("narName").disabled = false;
            document.getElementById("txtAreaQue").disabled = false;
            document.getElementById("imgQue").disabled = false;
            document.getElementById("listTypeOfAnswer").disabled = false;
            document.getElementById("randomAnswer").disabled = false;
            document.getElementById("queCharacter").disabled = false;
            document.getElementById("randomCha").disabled = false;
            document.getElementById("chkTxtHint").disabled = false;
            document.getElementById("chkImgHint").disabled = false;
            document.getElementById("chkQueImg").disabled = false;
            document.getElementById("chkQueTxt").disabled = false;
            $('.multChoiceTxt').removeAttr('disabled');
            // document.getElementsByName("multChoiceTxt[]").disabled = false;
            document.getElementsByName("multChoiceImg[]").disabled = false;
            document.getElementsByName("multChoiceCorrect[]").disabled = false;
            document.getElementsByName("txtSeriesChoices[]").disabled = false;
            document.getElementsByName("ansMultGroupImgSeq[]").disabled = false;
            document.getElementsByName("ansMultGroupImg[]").disabled = false;

            document.getElementById("btnSaves").disabled = false;
        }

    });

</script>
