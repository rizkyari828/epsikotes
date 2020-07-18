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
                                        <?php
                                        $checked = '';
                                        if ($data->RANDOM_QUESTION == 1) {
                                            $checked = 'checked';
                                        }
                                        ?>
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
                                                <option value="New">New</option>
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
{{--                                                        @foreach($narations as $key => $val)--}}
{{--                                                            <option--}}
{{--                                                                value="{{$val->NARRATION_NAME}}">{{$val->NARRATION_NAME}}</option>--}}
{{--                                                        @endforeach--}}
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

<script>
    $(document).ready(function () {
        CKEDITOR.replace('ckeditor', {height: '200px', startupFocus: true});
        let sub_category_id = "{{ $data->SUB_CATEGORY_ID }}";
        $.ajax({
            type: "GET",
            url: "/rest/sub-category",
            success: function (response) {
                window.console.log(response)
                response.forEach(function (item, _) {
                    $('#sub_category_name_datalist')
                        .append('<option value="' + item.SUB_CATEGORY_NAME + '">' + item.SUB_CATEGORY_NAME + '</option>')
                })
            },
            error: function (reason) {
                window.console.log(reason);
            },
        });
        $.ajax({
            type: "GET",
            url: '/rest/sub-category/' + sub_category_id,
            success: function (response) {
                displayVersions(response.versions);
                selectVersion(response.versions[0]);
                window.console.log(response);
            },
            error: function (reason) {
                window.console.log(reason);
            },
        });
    });

    function selectVersion(version) {
        $('#versions').val(version.VERSION_ID).change();
        $('#version_description').val(version.DESCRIPTION);
        $('#version_work_instruction').val(version.WORK_INSTRUCTION);
        if (version.RANDOM_QUESTION) {
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
    }

    function displayVersions(versions) {
        versions.forEach(function (version, _) {
            $('#versions')
                .append('<option value="' + version.VERSION_ID + '">' + version.VERSION_NUMBER + '</option>');
        });
    }
</script>
