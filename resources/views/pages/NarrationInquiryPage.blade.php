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
                                    <input id="name"class="form-control" name="narrationName" placeholder="Narration Name" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Naration Text</label>
                                <div class="col-md-6">
                                    <textarea id="text" class="form-control" name="narrationText"  placeholder="Narration Text" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <a class="btn btn-success" href="#narrationadd" id="narrationadd">
                                            <i class="fa fa-plus"></i> 
                                            New
                                        </a>
                                        <button class="btn btn-primary" id="find-narration">
                                            <i class="fa fa-search"></i>
                                            Search
                                        </button>
                                        
                                    </div>
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
</div>

 <!-- START ROW -->
<div class="row">

    <!-- NEW COL START -->
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
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
                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                <h2>Norma Setup Inquiry </h2>

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

                    <table id="table-narration-inquiry" class="table-narration-inquiry table table-striped table-bordered table-hover table-checkable" width="100%">
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

    </article>        <!-- END COL -->

</div>

<!-- END ROW -->

<script type="text/javascript">

$("#narrationadd").click(function(e) {
    e.preventDefault();
    loadURL("narrationadd", $('#content'));
});

var obj = {};
var param = {};
obj["narrationName"] =  $('input[name="narrationName"]').val();
obj["narrationText"] =  document.getElementById('text').value;

var narrationName = "";
var table_normatest = $('#table-narration-inquiry').DataTable({
    "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f>r>"+
    "t"+
    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
    "oLanguage": {
        "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
    },  
    "autoWidth" : true,
    "ajax": {
        "type": "POST",
        "data": function( d ) {
          d._token= $('input[name="_token"]').val();
          d.paramFilters=obj;
        }, 
        "dataType": "JSON",
        "url": "getNameNarration" // ajax source
    },
    "order": [
        [1, "asc"]
    ]// set first column as a default sort by asc
});

  $('.table-narration-inquiry tbody').on( 'click', 'a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            loadURL(url, $('#content'));
        });


    param["message"] = "Searches might be slow without any parameter. Do you want to continue ?";
    param["title"] = "Find All";

    drawDialogConfirm(table_normatest,param,"find_all");

    $('#find-narration').on('click', function (e) {
        e.preventDefault();
        obj["narrationText"] =  document.getElementById('text').value;
        obj["narrationName"] =  $('input[name="narrationName"]').val();
        if(!obj["narrationText"].length && !obj["narrationName"].length){
            $('#dialog_simple').dialog('open');
        }else{
            console.log(table_normatest.ajax.params());
            table_normatest.ajax.reload();
        }
    });
</script>