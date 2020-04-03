

        <link href="assets/css/togle-btn.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/jquery.steps.css">
        <link rel="stylesheet" href="assets/css/normalize.css">

        <div id="notif_modal" title="Notification">
                <div id="notif_contentholder">
                </div>
            </div>
        <div id="saveCatModal" title="Notification">
        </div>
<style>

    </style>
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
                                Close
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
<div class="row" id="categoryContent">

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
                <h2>Category Setup</h2>

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
                            <legend>Create Category Setup</legend>
                            <div class="col-xs-12 col-md-8">
                                    <div class="form-group">
                                            <label class="col-md-2 control-label">Category Name</label>
                                            <div class="col-md-10">
                                                <input type="hidden" id="categoryId">
                                                <input id="categoryName" class="form-control contentHeader" placeholder="Category Name" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Description *</label>
                                            <div class="col-md-10">
                                                <textarea id="desc" class="form-control contentHeader" rows="4"></textarea>
                                            </div>
                                        </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                    <div class="form-group">
                                            <label class="col-md-4 control-label">Version</label>
                                            <div class="col-md-4">
                                                <select id="version" class="form-control" id="version">
                                                </select>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <label class="col-md-4 control-label">Effective Start Date</label>
                                            <div class="col-md-6">
                                                    <div class="input-group">
                                                            <input id="dtFrom" type="text" name="mydate" placeholder="Select a date" class="form-control datepicker contentInput" data-dateformat="yy-mm-dd">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>

                                                       <!-- <span style="color:red;"class="">dkds</span> -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-md-4 control-label">Effective End Date</label>
                                                <div class="col-md-6">
                                                        <div class="input-group">
                                                                <input id="dtTo" type="text" name="mydate" placeholder="Select a date" class="form-control datepicker contentInput" data-dateformat="yy-mm-dd">
                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                </div>
                                            </div>

                            </div>
                        </fieldset>

                        <fieldset>

                            <legend></legend>
                            <div class="row">
                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                    <label class="col-md-6 control-label">Random Questions *</label>
                                                    <div class="col-md-4">
                                                        <input id="isRandom" class="contentInput" type="checkbox"  data-toggle="toggle" data-style="success">
                                                    </div>
                                            </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                    <div class="col-md-1">
                                                        <input class="contentInput" id="getOneSubCat" type="checkbox">
                                                    </div>
                                                    <div class="col-md-8">
                                                            <label class="">Only Get 1 Sub Category</label>
                                                        </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-10">
                                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                                            <header>
                                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                                <h2>Sub Category List </h2>

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

                                            <table id="subCatTblList" class="table table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="col-lg-1"><input type="checkbox" id="checkAll"></th>
                                                        <th class="col-lg-9">Sub Category Name</th>
                                                        <th class="col-lg-2">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end widget content -->
                                    </div>
                                    <!-- end widget div -->

                                    <div class="form-actions">

                                            <div class="row pull-left">
                                                    <div class="inline-group">

                                                        <div class="col-md-8">
                                                                <button class="btn btn-warning contentInput" id="addRow">
                                                                        <i class="fa fa-plus"></i>
                                                                            Add List
                                                                    </button>
                                                        </div>

                                                        <div class="col-md-3">
                                                                <button class="btn btn-danger contentInput" type="submit" id="deleteRow">
                                                                        Delete
                                                                    </button>
                                                        </div>
                                                    </div>

                                            </div>
                                    </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-8">
                                                        <input type="hidden" id="counterTd">
                                                    <button class="btn btn-primary contentInput" id="btnSave">
                                                        <i class="fa fa-save"></i>
                                                            Save
                                                    </button>
                                                    <a href="#ajax/category/category-inquiry.blade.php" class="btn btn-default" type="submit">
                                                        Cancel
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                </div>


                                <div style="padding-top: 5%" class="col-xs-12 col-md-2">
                                        <div class="form-group">
                                                <button class="contentInput" id="btnUp" style="width: 100px"><i class="glyphicon glyphicon-chevron-up "></i></button>
                                        </div>
                                        <div class="row"></div>
                                        <div class="form-group">
                                                <button class="contentInput" id="btnDown" style="width: 100px"><i class="glyphicon glyphicon-chevron-down"></i></button>
                                        </div>
                            </div>

        </div>

    </fieldset>
	</div>
	</div>
	</div>
    </article>

</div>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">

		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.steps.js"></script>
		<script src="assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
		<script src="assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
		<script src="assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
        <script src="assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
		<script src="assets/js/lookup.js"></script>
		<script src="assets/js/misc.js"></script>

        <script>
                $('#reportConfigStepsNext').click(function(){
                    var seq = $('#questionSequence').text();
                    alert($("#wizard").steps("getCurrentIndex"));
                    seq = Number(seq) + 1;
                    $('#questionSequence').html("");
                    $('#questionSequence').text(seq);
                    $("#wizard").steps('next');
                });
                $('#reportConfigStepsPrev').click(function(){
                    $("#wizard").steps('previous');
                });
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
                // UP DOWN SEQUENCE
                $('#btnUp').click(function() {
                    $('#subCatTblList').find('input[type="checkbox"]:checked').each(function(i){
                        var row = $(this).parents('tr:first');
                        row.insertBefore(row.prev());

                    });

                    return false;

                });

                $('#btnDown').click(function() {
                    $('#subCatTblList').find('input[type="checkbox"]:checked').each(function(i){
                        var row = $(this).parents('tr:first');
                        row.insertAfter(row.next());

                    });

                    return false;

                });
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


                /* END BASIC */
            })

            </script>


<!-- PAGE RELATED PLUGIN(S) -->
<script src="assets/js/plugin/ckeditor/ckeditor.js"></script>
<script src="assets/js/misc.js"></script>
<script type="text/javascript">
var t = $('#subCatTblList').DataTable({
                        "bDestroy": true,
                            "searching": false,
                            "paging" :false,
                            "scrollY":        "200px",
                            "scrollCollapse": true,
                    });
                    function checkedChk(){
                        $('#subCatTblList').find('input[type="checkbox"]:checked').each(function(i){
                        var row = $(this).parents('tr:first');
                        row.addClass('selected')

                        });
                        $('#subCatTblList').find('input[type="checkbox"]:unchecked').each(function(i){
                        var row = $(this).parents('tr:first');
                        row.removeClass('selected')
                        });


                };
    $(document).ready(function() {
    // $('.contentInput').attr();
    // $('#categoryContent input').attr('disabled','disabled');
    var url      = window.location.href;
    var param = url.split('=');
    $('#version').change(function(){
        var selected = $('#version option:selected').val();
        if($('#version option:selected').text() == 'NEW'){
            $('.contentInput').attr('disabled', false);
            $('.contentHeader').attr('disabled', 'disabled');
            var today = new Date();
            var dd = today.getDate() + 1;
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            if (dd < 10) {
            dd = '0' + dd;
            }

            if (mm < 10) {
            mm = '0' + mm;
            }
            tommorow = yyyy + '-' + mm + '-' + dd;
            $('#dtFrom').val(tommorow);
        }else{
        loadData(news[1], selected);
        }

    });
    if (url.indexOf('=') > -1) {
        var news = url.split('=');
        loadData(news[1], null);
        loadVersion(news[1]);

    }
			$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
				_title : function(title) {
					if (!this.options.title) {
						title.html("&#160;");
					} else {
						title.html(this.options.title);
					}
				}
			}));

                $('#btnSave').click(function(){
                    validate();
                    $('#saveCatModal').dialog('open');
                    return false;

                });
                function validate(){
                    var today = new Date();
                    var dd = today.getDate() +1;
                    var mm = today.getMonth() + 1; //January is 0!
                    var yyyy = today.getFullYear();
                    if (dd < 10) {
                    dd = '0' + dd;
                    }

                    if (mm < 10) {
                    mm = '0' + mm;
                    }
                    dtTo = new Date(dtTo);
                    dtFrom = new Date(dtFrom);
                    tomorrow = yyyy + '-' + mm + '-' + dd;
                    var dtFrom =$('#dtFrom').val();
                    alert(dtFrom);
                    if(tomorrow>dtFrom){
                        alert("LESS ThAn Tomorrow");
                    }
                }
                pageSetUp();
                    var responsiveHelper_q_list = undefined;

                    var breakpointDefinition = {
                        tablet : 1024,
                        phone : 480
                    };
                // $('#addRow').click(function(){

                    var counter = 0;

                    $('#addRow').click(function(){
                        var theR = $('#subCatTblList').dataTable();
                        alert(theR.fnGetData().length);
                        var tblCount = theR.fnGetData().length;
                        console.log('table Count : '+tblCount);
                            counter = tblCount + 1;
                        t.row.add( [
                            '<input type="checkbox" class="sub_chk" onChange="checkedChk()">',
                            '<div class="form-horizontal">'+
                                    '<div class="form-group">'+
                                                        '<div class="col-md-11">'+
                                                            '<input setId="text_'+counter+'" id="text_'+counter+'" style="cursor: pointer;" class="form-control subCatLookup text_'+counter+' " placeholder="Sub Category Name" type="search" readonly="readonly" >'+
                                                        '</div>'+
                                                '</div>'+
                                            '</div>',
                            '<a > View</a>'
                        ] ).draw( false );

                        $('#counterTd').val(counter)
                    } );

                $('#deleteRow').click(function(){
                    var tableRemove = $('#subCatTblList').DataTable();
                    var row = tableRemove
                        .rows('.selected')
                        .remove()
                        .draw(false);
                });

                $('#checkAll').click(function(){
                    if($(this).is(':checked',true))
                    {
                        $(".sub_chk").prop('checked', true);
                    }
                    else
                    {
                        $(".sub_chk").prop('checked',false);
                    }
                });

                $('#saveCatModal').dialog({
                    autoOpen : false,
                    width : 600,
                    resizable : false,
                    modal : true,
                    title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Are you sure want to save this setup?</h4></div>",
                    buttons : [{
                        html : "<i class='fa fa-times'></i>&nbsp; Yes, Save",
                        "class" : "btn btn-primary",
                        click : function() {
                            var method = 'post';
                            var countVal = $('#counterTd').val();
                            var dtTo = $('#dtTo').val();
                            var listSubCat =[];
                            var randomBool = 0;
                            var getOneCatBool = 0;
                            for(x = 1; x <= countVal; x++){
                                var list =
                                {
                                    "sub_sequence": x,
                                    "sub_cat_name" : $('#text_'+x).val()
                                }

                                listSubCat.push(list);
                            }
                            if($('#categoryId').val()){
                                method = 'put';
                            }
                            if($('#dtTo').val() == null || $('#dtTo').val() == ''){
                                dtTo = '4712-12-31';
                            }
                            if($('#isRandom').val() == 'on'){
                                randomBool = 1
                            }

                            if($('#getOneSubCat').val() == 'on'){
                                getOneCatBool = 1
                            }
                            var values =
                            {
                                "categoryId" : $('#categoryId').val(),
                                "categoryName" : $('#categoryName').val(),
                                "desc": $('#desc').val(),
                                "randomSubCat": randomBool,
                                "getOneSubCat" : getOneCatBool,
                                "dtFrom" : $('#dtFrom').val(),
                                "dtTo" : dtTo,
                                "version" : $('#version option:selected').val(),
                                "listSubCat" : listSubCat,
                            };
                            console.log(values);
                            if($('#categoryId').val()){
                                method = 'put';
                            }
                             saveUpdateCategory(values, method);
                            $(this).dialog("close");
                        }
                    },
                    {
                        html : "<i class='fa fa-trash-o'></i>&nbsp; NO",
                        "class" : "btn btn-primary",
                        click : function() {
                            $(this).dialog("close");
                        },
                    }]
                });

                function saveUpdateCategory(values, method){
                    console.log(values);
                    $.ajax({
                        url: '/api/category',
                        dataType: 'JSON',
                        type: method,
                        contentType: 'application/x-www-form-urlencoded',
                        data: values,
                        success: function( data, textStatus, jQxhr ){

                            $("#notif_contentholder").html("");
                            if(jQxhr.status == 200){
                                notifHeader = 'SUCCESS';
                                $("#notif_contentholder").append("<p> Data has been saved.");
                                $('#notif_modal').dialog('open');
                                return false;
                            }else{
                                notifHeader = 'ERROR';
                                console.log(notifHeader);
                                $("#notif_contentholder").append("<p> Data already exist!");
                                $('#notif_modal').dialog('open');
                                return false;
                            }
                        },
                        error: function( jqXhr, textStatus, errorThrown ){
                            console.log( errorThrown );
                        }
                    });

                }

            $('#dtFrom').change(function(){
                var vals = $('#dtFrom').val();
                var d = new Date();

                var month = d.getMonth()+1;
                var day = d.getDate();

                var output = (day<10 ? '0' : '') + day + '/' +
                    (month<10 ? '0' : '') + month + '/' +
                     + d.getFullYear() ;

                    if(output <= toString(vals)){
                        alert(output + " <= "+$('#dtFrom').val());
                    }else if(output == vals){
                        alert("EQUEAL");
                    }else{
                        alert(output+" - >= - "+$('#dtFrom').val());
                    }
            });
CKEDITOR.replace( 'ckeditor', { height: '200px', startupFocus : true} );

});

var loadVersion = function(categoryId){
    $("#version option").remove();
    $.ajax({
            url: "api/category/versions",
            dataType : "JSON",
            method : "GET",
            data : {
                "categoryId":categoryId
            },
            cache: false,
            success: function(results){

                $.each(results, function(i, result){
                var x = document.getElementById("version");
                    var status = checkActive(result.date_from, result.date_to)
                    var option = document.createElement("option");
                    option.text = result.version_text;
                    option.value = result.version_number;
                    option.selected = status;
                    x.add(option);
                });
            }
        });
}

var loadData = function(param, version){
        $.ajax({
            url: "api/category/detail",
            dataType : "JSON",
            method : "GET",
            data : {
                "id":param,
                "version":version
            },
            cache: false,
            success: function(results){
                $.each(results, function(i, result){
                    $.each(result, function(i, field){
                        var getOneSubCat = false;
                        var randomSubCat = $('#isRandom').parent('div');
                        if(field.randomSubCat == 1){
                            randomSubCat.removeClass();
                            randomSubCat.addClass('toggle btn success btn-primary');// set ON Toggle
                        }else{
                            randomSubCat.removeClass();
                            randomSubCat.addClass('toggle btn success btn-default off'); // set Off Toggle
                        }
                        if(field.getOneSubCat == 1){
                            getOneSubCat = true;
                        }
                         $('#categoryId').val(field.categoryId);
                         $('#categoryName').val(field.categoryName);
                         $('#desc').val(field.desc);
                         $('#getOneSubCat').attr('checked',getOneSubCat);
                         $('#dtFrom').val(field.dtFrom);
                         $('#dtTo').val(field.dtTo);

                         var counter = 1;
                         t.clear()
                          .draw();
                         $.each(field.listSubCat, function(i, sub){
                            t.row.add( [
                            '<input type="checkbox" class="sub_chk contentInput" onChange="checkedChk()">',
                            '<div class="form-horizontal">'+
                                    '<div class="form-group">'+
                                                        '<div class="col-md-11">'+
                                                            '<input setId="text_'+counter+'" id="text_'+counter+'" value="'+sub.subCategoryName+'" style="cursor: pointer;" class="form-control subCatLookup text_'+counter+' contentInput" placeholder="Sub Category Name" type="search" readonly="readonly" >'+
                                                        '</div>'+
                                                '</div>'+
                                            '</div>',
                            '<a > View</a>'
                        ] ).draw( false );

                        $('#counterTd').val(counter)
                        counter++;
                         });
                         //Disable if active version
                         if(checkActive(field.dtFrom, field.dtTo)){
                            $('.contentInput').attr('disabled', 'disabled');
                        }
                        if(checkFuture(field.dtFrom, field.dtTo)){
                            $('.contentInput').attr('disabled', false);
                            $("#version option:contains('NEW')").remove()
                        }
                    });
                    $('.contentHeader').attr('disabled', 'disabled');

                });
            }
        });
    }

    function checkFuture(dtFrom, dtTo){
        var isFuture = false;
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();

        if (dd < 10) {
        dd = '0' + dd;
        }

        if (mm < 10) {
        mm = '0' + mm;
        }
        dtTo = new Date(dtTo);
        dtFrom = new Date(dtFrom);
        today = new Date(yyyy + '-' + mm + '-' + dd);
        if(today < dtFrom){
            isFuture = true;
        }else if(today > dtTo){
            isFuture = false;// active
        }else{
            isFuture = false;
        }
        return isFuture;
    }

    function checkActive(dtFrom, dtTo){
        var isActive = false;
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();

        if (dd < 10) {
        dd = '0' + dd;
        }

        if (mm < 10) {
        mm = '0' + mm;
        }
        dtTo = new Date(dtTo);
        dtFrom = new Date(dtFrom);
        today = new Date(yyyy + '-' + mm + '-' + dd);
        if(today < dtFrom){
            isActive = false;
        }else if(today <= dtTo && today >= dtFrom){
            isActive = true;// active
        }else{
            isActive = false;
        }
        return isActive;
    }
    $('#notif_modal').dialog({
    autoOpen : false,
    width : 600,
    resizable : false,
    modal : true,
    title : "<div class='widget-header warning'><h4><i class='fa fa-warning'></i> Information</h4></div>",
    buttons : [{
        html : "<a href='?#ajax/category/category-inquiry.blade.php'><i class='fa fa-times'></i>&nbsp; OK </a>",
        "class" : "btn btn-warning",
    }]
});
</script>
