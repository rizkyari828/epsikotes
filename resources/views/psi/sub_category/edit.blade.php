@if(request()->has('standalone'))
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endif

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/jquery.steps.css">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>

<script src="/assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/jquery.steps.js"></script>
<script src="/assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="/assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="/assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="/assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script src="/assets/js/plugin/ckeditor/ckeditor.js"></script>
<script src="/assets/js/misc.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="row">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                <h2>Edit Sub Category</h2>
            </header>
            <div>
                <div class="widget-body">
                    <div class="form-horizontal">
                        <fieldset>
                            <legend>Edit Sub Category : {{ $data->SUB_CATEGORY_NAME }}</legend>
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Sub Category Name</label>
                                        <div class="col-md-10">
                                            <input id="names" name="subCateName" class="form-control"
                                                   placeholder="Sub Category Name" type="text" list="sub_category_name_datalist"
                                                   autocomplete="off" value="{{$data->SUB_CATEGORY_NAME}}">
                                            <datalist id="sub_category_name_datalist"></datalist>
                                            <label style="color: red; display: none;" id="errorSubCatName">Name of Sub
                                                Category Must be Filled</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="subCatId" id="subCateId"
                                           value="{{$data->SUB_CATEGORY_ID}}">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Description *</label>
                                        <div class="col-md-10">
                                        <textarea class="form-control" name="version_description" id="version_description" rows="4"
                                                  required></textarea>
                                            <label style="color: red; display: none;" id="errorsubCateDesc">Description Must
                                                be Filled</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Work Instructions *</label>
                                        <div class="col-md-10">
                                        <textarea name="ckeditor" id="version_work_instruction"
                                                  required></textarea>
                                            <label style="color: red; display: none;" id="errorSubCatWOrkIns">Work
                                                Instruction Must be Filled</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Random Questions</label>
                                        <div class="col-md-8">
                                            <input type="checkbox" name="subCateRandom" data-toggle="toggle" id="version_random_question"
                                                   data-style="success">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Version</label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="versions">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Effective Start Date</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="text" name="mydate" placeholder="Select a date"
                                                       class="form-control" value="{{$data->DATE_FROM}}"
                                                       id="version_date_form">
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
                                                       class="form-control" disabled="true" value="{{$data->DATE_TO}}"
                                                       id="version_date_to">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <label style="color: red; display: none;" id="errorSubCatEndDate">Effective End
                                                Date Must be Filled</label>
                                        </div>
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
                                            <button class="btn btn-warning" type="button" id="question_button_prev">
                                                <i class="fa fa-chevron-left"></i>
                                                Prev Question
                                            </button>
                                        </div>
                                        <div class="col-md-3" id="queNumber">
                                            <h4 id="question_index"></h4>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-warning" type="button" id="question_button_next">
                                                Next Question
                                                <i class="fa fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Question List</legend>
                            <form id="question-form" enctype="multipart/form-data" method="post">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="text" id="question_question_id" hidden>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Type Of Sub Category</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="question_type_sub_category" name="TYPE_SUB_CATEGORY">
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
                                        <input type="checkbox" id="question_is_actived" name="IS_ACTIVED">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Duration Per Question</label>
                                    <div class="col-lg-2">
                                        <input class="form-control" placeholder="0" id="question_duration_per_que" type="number" name="DURATION_PER_QUE">
                                        <label style="color: red; display: none;" id="errorDuration">Duration must be
                                            filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Is Example</label>
                                    <div class="col-md-8">
                                        <input type="checkbox" id="question_example" name="EXAMPLE">
                                        <label style="color: red; display: none;" id="errorIsExample">Hint or Text must
                                            be filled</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="inline-group">
                                        <label class="col-md-2 control-label">Hint</label>
                                        <div class="col-md-1">
                                            <input type="checkbox" id="question_hint_text_checkbox">
                                        </div>
                                        <label class="col-md-1 control-label">Text</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" rows="4" id="question_hint_text" name="HINT_TEXT"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="inline-group">
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-1">
                                            <input type="checkbox" id="question_hint_image_checkbox">
                                        </div>
                                        <label class="col-md-1 control-label">Image</label>
                                        <div class="col-md-6">
                                            <input type="file" id="question_hint_image" style="border: solid 1px #ccc; padding: 5px 10px; width: 100%;" name="HINT_IMG">
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
                                                           id="question_narration_name" type="text" list="question_narrations_datalist">
                                                    <input type="hidden" name="NARRATION_ID" id="question_narration_id">
                                                    <datalist id="question_narrations_datalist"></datalist>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="inline-group">
                                        <label class="col-md-2 control-label">Question *</label>
                                        <div class="col-md-1">
                                            <input type="checkbox" id="question_question_text_checkbox">
                                        </div>
                                        <label class="col-md-1 control-label">Text</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" rows="4" id="question_question_text" name="QUESTION_TEXT"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="inline-group">
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-1">
                                            <input type="checkbox" id="question_question_image_checkbox">
                                        </div>
                                        <label class="col-md-1 control-label">Image</label>
                                        <div class="col-md-6">
                                            <input type="file" id="question_question_image" style="border: solid 1px #ccc; padding: 5px 10px; width: 100%;" name="QUESTION_IMG">
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
                                        <input type="checkbox" id="question_random_character" name="RANDOM_CHARACTER">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Question Character</label>
                                    <div class="col-lg-2">
                                        <input class="form-control" placeholder="0" id="question_question_character" type="number" name="QUESTION_CHARACTER">
                                    </div>
                                </div>
                                <div class="form-group" id="typeOfAnswer">
                                    <label class="col-md-2 control-label">Type Of Answer *</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="question_type_answer" name="TYPE_ANSWER">
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
                                        <input type="checkbox" id="question_random_answer" name="RANDOM_ANSWER">
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
                                                <table class="table table-bordered" id="answer_table">
                                                    <thead id="questionAnswerHead">
                                                    <tr>
                                                        <th class=".col-lg-9">Correct Answer</th>
                                                        <th class=".col-lg-2">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="answer_body">
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
                                                    <button id="btn_add_question" class="btn btn-primary" type="button">
                                                        <i class="fa fa-plus"></i>
                                                        Add Answer
                                                    </button>
                                                    <button id="btn_delete_all_question" class="btn btn-danger">
                                                        <i class="fa fa-trash-o"></i>
                                                        Delete All Answers
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

<script>
    let questions = [];

    let current_question_sequence = 0;

    let current_question_index = 0;

    let narrations = [];

    let answer_header_multiple_choice = "<thead><tr>" +
        "<th class='col-lg-6'>Choice Text</th>" +
        "<th class='col-lg-2'>Choice Image</th>" +
        "<th class='col-lg-2'>Correct Answer</th> " +
        "<th class='col-lg-1'>Action</th> " +
        "</tr></thead>";

    let answer_header_text_series = "<thead>" +
        "<tr>" +
        "<th class='.col-lg-9'>Correct Answer</th>" +
        "<th class='.col-lg-2'>Action</th>" +
        "</tr>" +
        "</thead>";
    let answer_body_text_series = "<tr>" +
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

    let answer_header_multiple_group = "<thead><tr>" +
        "<th class='.col-lg-7'>Image Question Sequence</th>" +
        "<th class='.col-lg-4'>Group</th>" +
        "<th class='.col-lg-1'>Action</th> " +
        "</tr></thead>";
    let answer_body_multiple_group = "<tr>" +
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

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        CKEDITOR.replace('ckeditor', {height: '200px', startupFocus: true});
        let sub_category_id = "{{ $data->SUB_CATEGORY_ID }}";
        fetchSubCategoryNames(() => {
            fetchNarrations(() => {
                fetchSubCategoryDetail(sub_category_id, () => {
                    onReady();
                })
            })
        });

        $('#question_button_next').on('click', function () {
            saveCurrentQuestion(() => {
                selectNextQuestion();
            });
        });

        $('#question_button_prev').on('click', function () {
            saveCurrentQuestion(() => {
                selectPrevQuestion();
            });
        });

        let previousVersion;
        $('#versions')
            .on('focus', function () {
                previousVersion = this.value;
            })
            .on('change', function () {
                if (this.value === "New") {
                    createNewVersion(previousVersion);
                } else {
                    fetchSubCategoryVersionDetail(this.value);
                    disableQuestionForm();
                }
            })
        setupAnswersTable();
        setupAnswersOptionsTools();
        setupDeleteAnswerRowButton();
    });

    function setupAnswersOptionsTools() {
        $('#btn_add_question').on('click', function () {
            let question_type_answer = $('#question_type_answer').val();
            if (question_type_answer === "MULTIPLE_CHOICE") {
                appendNewAnswerMultipleChoice()
            }
            if (question_type_answer === "TEXT_SERIES") {
                //
            }
            if (question_type_answer === "MULTIPLE_GROUP") {
                //
            }
            if (question_type_answer === "MEMORY") {
                //
            }
        });
        $('#btn_delete_all_question').on('click', function () {
            //
        });
    }

    function appendNewAnswerMultipleChoice() {
        answerTableBody()
            .append(generateNewRowForAnswerMultipleChoice());
    }

    function onReady() {
        // Here are the point of readiness.
        disableQuestionForm();
    }

    function setupAnswersTable() {
        $('#question_type_answer').on('change', function () {
            refreshAnswerTable();
        })
    }

    function refreshAnswerTable() {
        let question_type_answer = $('#question_type_answer').val();
        if (question_type_answer === "MULTIPLE_CHOICE") {
            setupHeaderAnswersForMultipleChoice();
            setupContentAnswerForMultipleChoice()
        }
        if (question_type_answer === "TEXT_SERIES") {
            setupHeaderAnswersForTextSeries();
            setupContentAnswerForTextSeries();
        }
        if (question_type_answer === "MULTIPLE_GROUP") {
            setupHeaderAnswersForMultipleGroup();
            setupContentAnswerForMultipleGroup();
        }
        if (question_type_answer === "MEMORY") {
            setupHeaderAnswersForMemory();
            setupContentAnswerForMemory();
        }
    }

    function setupContentAnswerForMultipleChoice() {
        let answers = questions[current_question_index].answer_choices
        answers.forEach(function (answer, index) {
            let correct_answer_checked_status = "";
            if (answer.CORRECT_ANSWER === 1 || answer.CORRECT_ANSWER === "1") {
                correct_answer_checked_status = "checked";
            }
            answerTableBody()
                .append("<tr>" +
                    "<td>" +
                    "<div class='form-group'>" +
                    "<div class='col-md-8'>" +
                    "<input hidden placeholder='ID' name='answers[ANS_CHOICE_ID][" + answer.ANS_CHOICE_ID + "]' type='text' value='" + answer.ANS_CHOICE_ID + "'>" +
                    "<input class='form-control multChoiceTxt' placeholder='Choice Text' name='answers[CHOICE_TEXT][" + answer.ANS_CHOICE_ID + "]' type='text' value='" + answer.CHOICE_TEXT + "'>" +
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    "<td>" +
                    "<div class='form-group'>" +
                    "<div class='col-md-4'>" +
                    "<input type='file' id='exampleInputFile1' name='answers[CHOICE_IMG][" + answer.ANS_CHOICE_ID + "]' style='border: solid 1px #ccc; padding: 5px 10px;'>" +
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    "<td align='center'>" +
                    "<div class='form-group'>" +
                    "<div class='col-md-12' >" +
                    "<input type='checkbox' class='btn btn-default' id='' name='answers[CORRECT_ANSWER][" + answer.ANS_CHOICE_ID + "]'" + correct_answer_checked_status + " value='1'>" +
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    "<td>" +
                    "<div class='form-group'>" +
                    "<div class='col-md-1'>" +
                    "<button class='btnDelete btn btn-warning' type='button'><i class='fa fa-trash-o'></i></button>" +
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    "</tr>");
        })
    }

    function setupContentAnswerForTextSeries() {
        let answers = questions[current_question_index].answer_groups
        answers.forEach(function (answer, index) {
            answerTableBody()
                .append("<tr>" +
                    "<td>" +
                    "<div class='form-group'>" +
                    "<div class='col-md-12'>" +
                    "<input class='form-control' name='txtSeriesChoices[]' placeholder='Correct Answer' id='txtSeries' type='text' value='" + answer.CORRECT_TEXT + "'>" +
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
                    "</tr>");
        });
    }

    function setupContentAnswerForMultipleGroup() {
        let answers = questions[current_question_index].answer_text_series
        answers.forEach(function (answer, index) {
            answerTableBody()
                .append("<tr>" +
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
                    "</tr>");
        });
    }

    function setupContentAnswerForMemory() {
        //
    }

    function replaceHeaderAnswer(htmlText) {
        let answer_table = $("#answer_table")
        answer_table.find("thead").remove();
        answer_table.find("tr").remove();
        answer_table.append(htmlText);
    }

    function setupHeaderAnswersForMultipleChoice() {
        replaceHeaderAnswer(answer_header_multiple_choice);
    }

    function setupHeaderAnswersForTextSeries() {
        replaceHeaderAnswer(answer_header_text_series);
    }

    function setupHeaderAnswersForMultipleGroup() {
        replaceHeaderAnswer(answer_header_multiple_group);
    }

    function setupHeaderAnswersForMemory() {
        replaceHeaderAnswer("");
    }

    function fetchSubCategoryNames(then) {
        $.ajax({
            type: "GET",
            url: "/rest/sub-category",
            success: function (response) {
                displayCategoryNames(response);
                then();
            },
            error: function (reason) {
                window.console.log(reason);
            },
        });
    }

    function fetchNarrations(then) {
        $.ajax({
            type: "GET",
            url: "/rest/narration",
            success: function (response) {
                narrations = response;
                displayNarrations(narrations);
                then();
            },
            error: function (reason) {
                window.console.log(reason);
            },
        });
    }

    function fetchSubCategoryDetail(sub_category_id, then) {
        $.ajax({
            type: "GET",
            url: '/rest/sub-category/' + sub_category_id,
            success: function (response) {
                displayVersions(response.versions);
                selectVersion(response.versions[0], true);
                then();
            },
            error: function (reason) {
                window.console.log(reason);
            },
        });
    }

    function fetchSubCategoryVersionDetail(version_id) {
        $.ajax({
            type: "GET",
            url: '/rest/sub-category-version/' + version_id,
            success: function (response) {
                selectVersion(response, false);
                questions = response.questions;
                selectQuestionByIndex(0);
            },
            error: function (reason) {
                window.console.log(reason);
            },
        });
    }

    function saveCurrentQuestion(then) {
        let current_question = questions[current_question_index];
        $("#question_narration_id").val(narrations.filter(function (item) { return item.NARRATION_NAME === $('#question_narration_name').val() })[0].NARRATION_ID);
        let question_form = $('#question-form');
        let formData = new FormData(question_form[0]);
        $.ajax({
            type: "POST",
            url: "/rest/question/" + current_question.QUESTION_ID,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                questions[current_question_index] = response;
                then();
            },
            error: function (reason) {
                window.console.log(reason);
            }
        });
    }

    function selectPrevQuestion() {
        selectQuestionByIndex(current_question_index - 1);
    }

    function selectNextQuestion() {
        selectQuestionByIndex(current_question_index + 1);
    }

    function selectQuestionByIndex(question_index) {
        current_question_index = question_index;
        setupPrevNextButtonState();
        $('#question_index').html(current_question_index + 1 + " / " + questions.length);
        selectQuestion(questions[current_question_index]);
    }

    function displayNarrations(narrations) {
        narrations.forEach(function (item, _) {
            $('#question_narrations_datalist')
                .append('<option value="' + item.NARRATION_NAME + '">' + item.NARRATION_NAME + '</option>')
        });
    }

    function displayCategoryNames(categories) {
        categories.forEach(function (item, _) {
            $('#sub_category_name_datalist')
                .append('<option value="' + item.SUB_CATEGORY_NAME + '">' + item.SUB_CATEGORY_NAME + '</option>')
        });
    }

    function createNewVersion(copyFrom) {
        $.ajax({
            type: "POST",
            url: "/rest/sub-category-version",
            data: {
                '_token': "{{ csrf_token() }}",
                'copy_from': copyFrom
            },
            success: function (response) {
                selectVersion(response, true);
            },
            error: function (reason) {
                window.console.log(reason);
            }
        })
    }

    function selectVersion(version, shouldFetchVersionDetail) {
        let $versions = $('#versions');
        if ($versions.val() != null && $versions.val().toString() !== version.VERSION_ID.toString() && $versions.val() !== "New") {
            $versions.val(version.VERSION_ID).change();
        }
        if ($versions.val() === "New") {
            enableQuestionForm();
        }
        $('#version_description').val(version.DESCRIPTION);
        $('#version_work_instruction').val(version.WORK_INSTRUCTION);
        if (version.RANDOM_QUESTION === 1) {
            $('#version_random_question')
                .prop('checked', true)
                .bootstrapToggle('on');
        } else {
            $('#version_random_question')
                .prop('checked', false)
                .bootstrapToggle('off');
        }
        $('#version_date_form').val(version.DATE_FROM);
        $('#version_date_to').val(version.DATE_TO);
        if (shouldFetchVersionDetail) {
            fetchSubCategoryVersionDetail(version.VERSION_ID);
        }
    }

    function displayVersions(versions) {
        let versionsNode = $('#versions')
        versions.forEach(function (version, _) {
            versionsNode
                .append('<option value="' + version.VERSION_ID + '">' + version.VERSION_NUMBER + '</option>');
        });
        versionsNode.append('<option value="New">New</option>');
    }

    function selectQuestion(question) {
        current_question_sequence = question.QUESTION_SEQUENCE;
        $('#question_question_id').val(question.QUESTION_ID);
        $('#question_type_sub_category').val(question.TYPE_SUB_CATEGORY).change();
        $('#question_is_actived').prop('checked', question.IS_ACTIVED === 1 || question.IS_ACTIVED === "1")
        $('#question_duration_per_que').val(parseFloat(question.DURATION_PER_QUE).toFixed());
        $('#question_example').prop('checked', question.EXAMPLE === 1 || question.EXAMPLE === "1");
        $('#question_hint_text_checkbox').prop('checked', question.HINT_TEXT != null);
        $('#question_hint_text').val(question.HINT_TEXT);
        $('#question_hint_image_checkbox').prop('checkbox', question.HINT_IMAGE != null);

        let selected_narrations = narrations.filter(function (item) {
            return item.NARRATION_ID === question.NARRATION_ID;
        })[0];

        if (selected_narrations !== undefined) {
            $('#question_narration_name').val(selected_narrations.NARRATION_NAME);
        }

        $('#question_question_text_checkbox').prop('checked', question.QUESTION_TEXT != null);
        $('#question_question_text').val(question.QUESTION_TEXT);
        $('#question_question_image_checkbox').prop('checked', question.QUESTION_IMAGE != null);

        $('#question_random_character').prop('checked', question.RANDOM_CHARACTER === 1 || question.RANDOM_CHARACTER === "1");
        $('#question_question_character').val(parseFloat(question.QUESTION_CHARACTER).toFixed());
        $('#question_type_answer').val(question.TYPE_ANSWER).change();
        $('#question_random_answer').prop('checked', question.RANDOM_ANSWER === 1 || question.RANDOM_ANSWER === "1");
    }

    function setupPrevNextButtonState() {
        if (current_question_index === 0) {
            disablePrevButton();
        } else {
            enablePrevButton();
        }
        if (current_question_index === questions.length - 1) {
            disableNextButton();
        } else {
            enableNextButton();
        }
    }

    function disablePrevButton() {
        $('#question_button_prev').attr('disabled', 'disabled');
    }

    function disableNextButton() {
        $('#question_button_next').attr('disabled', 'disabled');
    }

    function enablePrevButton() {
        $('#question_button_prev').removeAttr('disabled');
    }

    function enableNextButton() {
        $('#question_button_next').removeAttr('disabled');
    }

    function disableQuestionForm() {
        questionForm().forEach(function (item) {
            item.attr('disabled', 'disabled');
        });
    }

    function enableQuestionForm() {
        questionForm().forEach(function (item) {
            item.removeAttr('disabled');
        });
    }

    function questionForm() {
        return [
            $('#question_question_id'),
            $('#question_type_sub_category'),
            $('#question_is_actived'),
            $('#question_duration_per_que'),
            $('#question_example'),
            $('#question_hint_text_checkbox'),
            $('#question_hint_text'),
            $('#question_hint_image_checkbox'),
            $('#question_narration_name'),
            $('#question_question_text_checkbox'),
            $('#question_question_text'),
            $('#question_question_image_checkbox'),
            $('#question_random_character'),
            $('#question_question_character'),
            $('#question_type_answer'),
            $('#question_random_answer'),
            $('#question_hint_image'),
            $('#question_question_image')
        ]
    }

    function answerTableBody() {
        return $("#answer_body")
    }

    function generateNewRowForAnswerMultipleChoice() {
        let generated_id = "new-" + new Date().getTime();
        return "<tr>" +
        "<td>" +
        "<div class='form-group'>" +
        "<div class='col-md-8'>" +
        "<input hidden placeholder='ID' name='answers[ANS_CHOICE_ID][" + generated_id + "]' type='text'>" +
        "<input class='form-control multChoiceTxt' placeholder='Choice Text' name='answers[CHOICE_TEXT][" + generated_id + "]' type='text'>" +
        "</div>" +
        "</div>" +
        "</td>" +
        "<td>" +
        "<div class='form-group'>" +
        "<div class='col-md-4'>" +
        "<input type='file' id='exampleInputFile1' name='answers[CHOICE_IMG][" + generated_id + "]' style='border: solid 1px #ccc; padding: 5px 10px;'>" +
        "</div>" +
        "</div>" +
        "</td>" +
        "<td align='center'>" +
        "<div class='form-group'>" +
        "<div class='col-md-12' >" +
        "<input type='checkbox' class='btn btn-default' id='' name='answers[CORRECT_ANSWER][" + generated_id + "]' value='1'>" +
        "</div>" +
        "</div>" +
        "</td>" +
        "<td>" +
        "<div class='form-group'>" +
        "<div class='col-md-1'>" +
        "<button class='btnDelete btn btn-warning' type='button'><i class='fa fa-trash-o'></i></button>" +
        "</div>" +
        "</div>" +
        "</td>" +
        "</tr>";
    }

    function setupDeleteAnswerRowButton() {
        $("#answer_table").on('click', '.btnDelete', function () {
            $(this).closest('tr').remove();
        });
    }
</script>
