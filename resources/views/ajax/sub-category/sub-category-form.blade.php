
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <link href="assets/css/togle-btn.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/jquery.steps.css">
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>

        <div id="saveModal" title="Notification">
        </div>

        <div id="lookupModal" title="Lookup Modal">

            <fieldset>
                    <div class="form-group">
                            <label class="col-md-4 control-label">Sub Category Name</label>
                            <div class="col-md-8">
                                <input class="form-control" placeholder="Sub Category Name" type="text">
                            </div>
                        </div>
            </fieldset>
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

                            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th class=".col-lg-5">Code</th>
                                        <th class=".col-lg-7">Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Jennifer</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>
        </div>
<div class="row">

    <!-- NEW WIDGET START -->
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
                            <legend>Create Sub Category Setup</legend>
                            <div class="col-xs-12 col-md-8">
                                    <div class="form-group">
                                            <label class="col-md-2 control-label">Sub Category Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" placeholder="Sub Category Name" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Description *</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="4"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Work Instructions *</label>
                                            <div class="col-md-10">
                                                    <textarea name="ckeditor"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-md-2 control-label">Random Questions *</label>
                                                <div class="col-md-8">
                                                    <input type="checkbox" checked data-toggle="toggle" data-style="success">
                                                </div>
                                        </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                    <div class="form-group">
                                            <label class="col-md-4 control-label">Version</label>
                                            <div class="col-md-3">
                                                <select class="form-control" id="listSubCat">
                                                    <option>2</option>
                                                    <option>1</option>
                                                </select>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <label class="col-md-4 control-label">Effective Start Date</label>
                                            <div class="col-md-6">
                                                    <div class="input-group">
                                                            <input type="text" name="mydate" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-md-4 control-label">Effective End Date</label>
                                                <div class="col-md-6">
                                                        <div class="input-group">
                                                                <input type="text" name="mydate" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy">
                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
                                            <button class="btn btn-warning">
                                                <i class="fa fa-chevron-left"></i>
                                                    Prev Question
                                            </button>
                                        </div>
                                        <div class="col-md-1">
                                            <span > 3 </span>
                                        </div>
                                        <div class="col-md-3">
                                                <a href="#next" class="btn btn-warning" role="menuitem">Next</a>
                                        <!-- <button class="btn btn-warning" type="submit">
                                            Next Question
                                            <i class="fa fa-chevron-right"></i>
                                        </button> -->
                                        </div>
                                        <div class="col-md-2">
                                        <button class="btn btn-warning" type="submit">
                                            <i class="fa fa-trash-o"></i>
                                            Delete
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <header>Question List</header>
                                <div id="wizard">
                                        <h2>aaa</h2>
                                        <section>
                                              <p>
                                                    <div class="form-group">
                                                            <label class="col-md-2 control-label">Type Of Sub Category</label>
                                                            <div class="col-md-8">
                                                                <select class="form-control" id="listSubCat">
                                                                    <option>- Select -</option>
                                                                    <option value="ELSE">ELSE</option>
                                                                    <option value="MEMORY">MEMORY</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                    <div class="form-group">
                                            <label class="col-md-2 control-label">Is Actives *</label>
                                            <div class="col-md-8">
                                                    <input type="checkbox" checked data-toggle="toggle" data-style="success">
                                            </div>
                                    </div>
                                        <div class="form-group">
                                        <label class="col-md-2 control-label">Text field</label>
                                        <div class="col-lg-2">
                                            <input class="form-control" placeholder="0" type="number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="col-md-2 control-label">Is Example *</label>
                                            <div class="col-md-8">
                                                    <input type="checkbox" data-toggle="toggle" data-style="success">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                          <div class="inline-group">
                                            <label class="col-md-2 control-label">Hint</label>
                                              <div class="col-md-1">
                                                      <input type="checkbox">
                                              </div>
                                              <label class="col-md-1 control-label">Text</label>
                                              <div class="col-md-6">
                                                      <textarea class="form-control" rows="4"></textarea>
                                              </div>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <div class="inline-group">
                                                <label class="col-md-2 control-label"></label>
                                                <div class="col-md-1">
                                                        <input type="checkbox">
                                                </div>
                                                <label class="col-md-1 control-label">Image</label>
                                                <div class="col-md-6">
                                                      <input type="file" class="btn btn-default" id="exampleInputFile1">
                                                </div>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="col-md-2 control-label">Narration</label>
                                            <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-sm-12">

                                                            <div class="input-icon-left">
                                                                <i class="fa txt-color-green fa-search"></i>
                                                                <input id="lookupNarration" style="cursor: pointer;" class="form-control" placeholder="Narration Name" type="search" readonly="readonly" >
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

                                      <div class="form-group">
                                            <div class="inline-group">
                                              <label class="col-md-2 control-label">Question *</label>
                                                <div class="col-md-1">
                                                        <input type="checkbox">
                                                </div>
                                                <label class="col-md-1 control-label">Text</label>
                                                <div class="col-md-6">
                                                        <textarea class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>
                                      </div>
                                      <div class="form-group">
                                            <div class="inline-group">
                                                  <label class="col-md-2 control-label"></label>
                                                  <div class="col-md-1">
                                                          <input type="checkbox">
                                                  </div>
                                                  <label class="col-md-1 control-label">Image</label>
                                                  <div class="col-md-6">
                                                        <input type="file" class="btn btn-default" id="exampleInputFile1">
                                                  </div>
                                            </div>
                                      </div>
                                      <div class="form-group" id="typeOfAnswer">
                                            <label class="col-md-2 control-label">Type Of Answer *</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="listTypeOfAnswer">
                                                    <option>- Select -</option>
                                                    <option value="1">Multiple Choice </option>
                                                    <option value="2">Text Series</option>
                                                    <option value="3">Multiple Group</option>
                                                    <option value="4">Memory</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-md-2 control-label">Random Answer *</label>
                                                <div class="col-md-8">
                                                        <input type="checkbox" checked data-toggle="toggle" data-style="success">
                                                </div>
                                        </div>
                                              </p>
                                        </section>
                                        <h2>bbb</h2>
                                        <section>
                                              <p> <div class="form-group">
                                                    <label class="col-md-2 control-label">Type Of Sub Category</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" id="listSubCat">
                                                            <option>- Select -</option>
                                                            <option value="ELSE">ELSE</option>
                                                            <option value="MEMORY">MEMORY</option>
                                                        </select>
                                                    </div>
                                                </div>

                            <div class="form-group">
                                    <label class="col-md-2 control-label">Is Actives *</label>
                                    <div class="col-md-8">
                                            <input type="checkbox" checked data-toggle="toggle" data-style="success">
                                    </div>
                            </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Text field</label>
                                <div class="col-lg-2">
                                    <input class="form-control" placeholder="0" type="number">
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-md-2 control-label">Is Example *</label>
                                    <div class="col-md-8">
                                            <input type="checkbox" data-toggle="toggle" data-style="success">
                                    </div>
                            </div>
                            <div class="form-group">
                                  <div class="inline-group">
                                    <label class="col-md-2 control-label">Hint</label>
                                      <div class="col-md-1">
                                              <input type="checkbox">
                                      </div>
                                      <label class="col-md-1 control-label">Text</label>
                                      <div class="col-md-6">
                                              <textarea class="form-control" rows="4"></textarea>
                                      </div>
                                  </div>
                            </div>
                            <div class="form-group">
                                  <div class="inline-group">
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-1">
                                                <input type="checkbox">
                                        </div>
                                        <label class="col-md-1 control-label">Image</label>
                                        <div class="col-md-6">
                                              <input type="file" class="btn btn-default" id="exampleInputFile1">
                                        </div>
                                  </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-md-2 control-label">Narration</label>
                                    <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-sm-12">

                                                    <div class="input-icon-left">
                                                        <i class="fa txt-color-green fa-search"></i>
                                                        <input id="lookupNarration" style="cursor: pointer;" class="form-control" placeholder="Narration Name" type="search" readonly="readonly" >
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                </div>

                              <div class="form-group">
                                    <div class="inline-group">
                                      <label class="col-md-2 control-label">Question *</label>
                                        <div class="col-md-1">
                                                <input type="checkbox">
                                        </div>
                                        <label class="col-md-1 control-label">Text</label>
                                        <div class="col-md-6">
                                                <textarea class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                              </div>
                              <div class="form-group">
                                    <div class="inline-group">
                                          <label class="col-md-2 control-label"></label>
                                          <div class="col-md-1">
                                                  <input type="checkbox">
                                          </div>
                                          <label class="col-md-1 control-label">Image</label>
                                          <div class="col-md-6">
                                                <input type="file" class="btn btn-default" id="exampleInputFile1">
                                          </div>
                                    </div>
                              </div>
                              <div class="form-group" id="typeOfAnswer">
                                    <label class="col-md-2 control-label">Type Of Answer *</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="listTypeOfAnswer">
                                            <option>- Select -</option>
                                            <option value="1">Multiple Choice </option>
                                            <option value="2">Text Series</option>
                                            <option value="3">Multiple Group</option>
                                            <option value="4">Memory</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-md-2 control-label">Random Answer *</label>
                                        <div class="col-md-8">
                                                <input type="checkbox" checked data-toggle="toggle" data-style="success">
                                        </div>
                                </div>
                            </p>
                                        </section>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend></legend>
                            <div class="row"></div>
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-editbutton="false">
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
                                        <span class="widget-icon"></i> </span>
                                        <h2>Question Answer</h2>

                                    </header>

                                    <!-- widget div-->
                                    <div>

                                        <!-- widget edit box -->
                                        <div class="jarviswidget-editbox col-md-8 col-md-offset-2">
                                            <!-- This area used as dropdown edit box -->

                                        </div>
                                        <!-- end widget edit box -->

                                        <!-- widget content -->
                                        <div class="widget-body">


                                            <div class="table-responsive">

                                                <table class="table table-bordered" id="questionAnswerTbl">
                                                    <thead id="questionAnswerHead">
                                                        <tr>
                                                            <th class=".col-lg-9">Correct Answer</th>
                                                            <th class=".col-lg-2">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="questionAnswerBody">
                                                            <tr>
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
                                                            </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                <div class="form-group col-xs-6 col-md-4">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <button id="btnAddAnswer" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>
                                                        Add Answer
                                                </button>
                                                <button id="btnDeleteAnswer" class="btn btn-danger" >
                                                    <i class="fa fa-trash-o"></i>
                                                    Delete All Answers
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- end widget div -->

                                </div>
                        </fieldset>


                    </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-8">
                                    <button class="btn btn-primary" id="btnSave">
                                        <i class="fa fa-save"></i>
                                            Save
                                    </button>
                                    <button class="btn btn-default" type="submit">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>

    </article>

</div>


		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.steps.js"></script>
		<script src="assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
		<script src="assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
		<script src="assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
		<script src="assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

        <script>
            $(function ()
            {
                $("#wizard").steps({
                    headerTag: "h2",
                    bodyTag: "section",
                    transitionEffect: "slideLeft"
                });
            });
        </script>

		<script type="text/javascript">

            // DO NOT REMOVE : GLOBAL FUNCTIONS!

            $(document).ready(function() {


            $('ul[role="tablist"]').hide();
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
                    var responsiveHelper_dt_basic = undefined;

                    var breakpointDefinition = {
                        tablet : 1024,
                        phone : 480
                    };

                    $('#dt_basic').dataTable({
                        "searching": false,
                        "scrollY":        "200px",
                        "scrollCollapse": true,
                        "paging":         false
                    });
                    $('#jobTable').dataTable({
                        "searching": false,
                        "scrollY":        "200px",
                        "scrollCollapse": true,
                        "paging":         false
                    });

                /* END BASIC */
            })

            </script>


<!-- PAGE RELATED PLUGIN(S) -->
<script src="assets/js/plugin/ckeditor/ckeditor.js"></script>
<script src="assets/js/misc.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var tblBody_1 ="<tr>"+
                                                                "<td>"+
                                                                    "<div class='form-group'>"+
                                                                        "<div class='col-md-8'>"+
                                                                            "<input class='form-control' placeholder='Narration Name' type='text'>"+
                                                                        "</div>"+
                                                                    "</div>"+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "<div class='form-group'>"+
                                                                        "<div class='col-md-4'>"+
                                                                            "<input type='file' class='btn btn-default' id='exampleInputFile1'>"+
                                                                        "</div>"+
                                                                    "</div>"+
                                                                "</td>"+
                                                                "<td align='center'>"+
                                                                    "<div class='form-group'>"+
                                                                        "<div class='col-md-12' >"+
                                                                            "<input type='checkbox' class='btn btn-default' id=''>"+
                                                                        "</div>"+
                                                                    "</div>"+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "<div class='form-group'>"+
                                                                        "<div class='col-md-1'>"+
                                                                            "<button class='btnDelete btn btn-warning'><i class='fa fa-trash-o'></i></button>"+
                                                                        "</div>"+
                                                                    "</div>"+
                                                                "</td>"+
                                                            "</tr>";
                                                            var tblHead_1 = "<thead><tr>"+
            "<th class='col-lg-6'>Choice Text</th>"+
            "<th class='col-lg-2'>Choice Image</th>"+
            "<th class='col-lg-2'>Correct Answer</th> "+
            "<th class='col-lg-1'>Action</th> "+
            "</tr></thead>";

    var tblHead_2 = "<thead>"+
                                                        "<tr>"+
                                                            "<th class='.col-lg-9'>Correct Answer</th>"+
                                                            "<th class='.col-lg-2'>Action</th>"+
                                                        "</tr>"+
                                                    "</thead>";
    var tblBody_2 = "<tr>"+
                                                                "<td>"+
                                                                    "<div class='form-group'>"+
                                                                        "<div class='col-md-12'>"+
                                                                            "<input class='form-control' placeholder='Correct Answer' type='text'>"+
                                                                        "</div>"+
                                                                    "</div>"+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "<div class='form-group'>"+
                                                                        "<div class='col-md-2'>"+
                                                                            "<a class='btn btn-warning'><i class='fa fa-trash-o'></i></a>"+
                                                                        "</div>"+
                                                                    "</div>"+
                                                                "</td>"+
                                                            "</tr>";
    var tblHead_3 = "<thead><tr>"+
                "<th class='.col-lg-7'>Image Question Sequence</th>"+
                "<th class='.col-lg-4'>Group</th>"+
                "<th class='.col-lg-1'>Action</th> "+
                "</tr></thead>";
    var tblBody_3 = "<tr>"+
                            "<td>"+
                                        "<div class='form-group'>"+
                            "<div class='col-md-12'>"+
                                                                            "<input class='form-control' placeholder='Narration Name' type='text'>"+
                                                                        "</div>"+
                                                                    "</div>"+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "<div class='form-group'>"+
                                                                        "<div class='col-md-12'>"+
                                                                            "<input class='form-control' placeholder='Group' type='text'>"+
                                                                        "</div>"+
                                                                    "</div>"+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "<div class='form-group'>"+
                                                                        "<div class='col-md-1'>"+
                                                                            "<a class='btn btn-warning'><i class='fa fa-trash-o'></i></a>"+
                                                                        "</div>"+
                                                                    "</div>"+
                                                                "</td>"+
                                                            "</tr>";
// SUB CATEGORY EVENT
$("#listSubCat").change(function(){
    var selected = $('#listTypeOfAnswer').val();
    var divToChange = $("#typeOfAnswer");
    if(selected == "ELSE"){
        $("listTypeOfAnswer").toggle();
    }
});
// TYPE OF ANSWER EVENT
$( "#listTypeOfAnswer" ).change(function() {
    var selected = $('#listTypeOfAnswer').val();
    var table = $("#questionAnswerTbl");
    var returnTHead = "";
    var returnTBody = "";

    var tblHead_4 = "";
    var tblBody_4 = "";
    if(selected == 1){
        returnTHead = tblHead_1;
        returnTBody = tblBody_1;
    }else if(selected == 2){
        returnTHead = tblHead_2;
        returnTBody = tblBody_2;
    }else if(selected == 3){
        returnTHead = tblHead_3;
        returnTBody = tblBody_3;
    }else{
        returnTHead = tblHead_4;
        returnTBody = tblBody_4;
    }

    table.find("thead").remove();
    table.find("tr").remove();
    table.append(returnTHead);
    table.append(returnTBody);
});

// DO NOT REMOVE : GLOBAL FUNCTIONS!
$("#questionAnswerTbl").on('click','.btnDelete',function(){
       $(this).closest('tr').remove();
    });

    $('#btnDeleteAnswer').click(function(){
        var selected = $('#listTypeOfAnswer').val();
        var table = $("#questionAnswerTbl");
        if(selected == 1){
            table.find("tbody").remove();
            table.append(tblBody_1);
        }
    });

    $('#btnAddAnswer').click(function(){
        var selected = $('#listTypeOfAnswer').val();
        var table = $("#questionAnswerTbl tbody");
        if(selected == 1){
            table.append(tblBody_1);
        }else if(selected == 2){

        }else if(selected == 3){

        }else{

        }
    });
CKEDITOR.replace( 'ckeditor', { height: '200px', startupFocus : true} );

})

</script>
