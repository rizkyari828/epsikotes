
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
                    <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                    <h2>Norma Setup Search </h2>

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

                        <form action="" id="order-form" class="smart-form" novalidate="novalidate">
                            <fieldset>
                                <div class="row">

                                    <label class="label col col-3">Category Name</label>

                                    <section class="col col-9">
                                             <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="input" id="category_name" name="category_name" placeholder="Category Name">
                                                    <input type="hidden" id="category_id" class="category_id"  name="category_id">
                                                </label>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary" id="find-norma">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>
                                 <a href="" id="addnorma" type="button" class="btn btn-success">
                                    <i class="fa fa-plus"></i>
                                    New
                                </a>
                            </footer>
                        </form>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
        <!-- END COL -->

    </div>

    <!-- END ROW -->

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

                        <table class="table table-striped table-bordered table-hover table-checkable table-norma-inquiry" id="table-norma-inquiry">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="2%">
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                        <span></span>
                                    </label>
                                </th>
                                <th width="5%"> Action </th>
                                <th width="200"> Category Name </th>
                                <th width="15%"> Last updated Date </th>
                                <th width="15%"> Last updated By </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /><span></span></label>
                                    </td>
                                    <td><a href="#normaadd">detail</a></td>
                                    <td>23303</td>
                                    <td>01 Jun 2017 10:25:12</td>
                                    <td>23303 - Satria Adi</td>
                                </tr>
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

        $("#addnorma").click(function(e) {
            e.preventDefault();
            loadURL("normaadd", $('#content'));
        });

        var obj = {};
        var param = {};

        $('input[name="category_name"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="category_id"]').val('');
            }
        });
        
        var subCategoryName = "";
        obj["categoryId"] =  $('input[name="category_id"]').val();

        var table_normatest = $('#table-norma-inquiry').DataTable({
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
                        "url": "getCategoriesAll" // ajax source
                    },
                    "order": [
                        [1, "asc"]
                    ]// set first column as a default sort by asc
                });

        param["message"] = "Searches might be slow without any parameter. Do you want to continue ?";
        param["title"] = "Find All";

        drawDialogConfirm(table_normatest,param,"find_all");

         $('#find-norma').on('click', function (e) {
            e.preventDefault();

            obj["categoryId"] =  $('input[name="category_id"]').val();

             if(!obj["categoryId"].length){
                $('#dialog_simple').dialog('open');
            }else {
                    console.log(table_normatest.ajax.params());
                    table_normatest.ajax.reload();
            }

        });

         $('.table-norma-inquiry tbody').on( 'click', 'a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            loadURL(url, $('#content'));
        });


        $("#category_name").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getCategories",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        categoryName : request.term
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.catagoryName,
                                value : item.catagoryName,
                                value_cateid : item.categoryId
                                
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $('#category_id').val(ui.item.value_cateid);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

    </script>
