
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
                    <div class="widget-body no-padding">

                        <form action="" id="order-form" class="smart-form" novalidate="novalidate">
                            <fieldset>
                                <div class="row">

                                    <label class="label col col-3">Category Name</label>

                                    <section class="col col-9">
                                             <label class="input">
                                                    <i class="icon-append fa fa-search"></i>
                                                    <input type="input" id="category_name" name="category_name" placeholder="Category Name">
                                                    <input type="hidden" id="category_id" class="category_id"  name="category_id">
                                                </label>
                                    </section>
                                </div>
                                 <div class="row">

                                    <label class="label col col-3">Sub Category Name</label>

                                    <section class="col col-9">
                                             <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="input" name="sub_category_name" id="sub_category_name" placeholder="Sub Category Name">
                                                    <input type="hidden" id="sub_category_id" class="sub_category_id" name="sub_category_id">

                                                </label>
                                    </section>
                                </div>
                                <div class="row">

                                    <label class="label col col-3">Is Random Category</label>

                                    <section class="col col-9">
                                           <label class="select">
                                                    <select name="randomCategory">
                                                        <option value="0" selected="">- Select -</option>
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                    </select><i></i>
                                                </label>
                                    </section>
                                </div>
                                  <div class="row">

                                    <label class="label col col-3">Only Get 1 Sub Category</label>

                                    <section class="col col-9">
                                           <label class="select">
                                                    <select name="onlySubCategory">
                                                        <option value="0" selected="">- Select -</option>
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                    </select><i></i>
                                                </label>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary" id="find-category">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>
                                 <a href="#categoryadd" id="categoryadd" type="button" class="btn btn-success">
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
                    <h2> Category Inquiry </h2>

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
                                                    <th>Action</th>
                                                    <th>Category Name</th>
                                                    <th>Total Sub Category</th>
                                                    <th>Is Random Question</th>
                                                    <th>Only Get 1 Sub Category</th>
                                                    <th>Last Updated Date</th>
                                                    <th>Last Updated By</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">

       <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td><a href="#jobmappingsetupadd">detail</a></td>
                                                    <td>23303</td>
                                                    <td>Yes</td>
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

        </article>       <!-- END COL -->

    </div>

    <!-- END ROW -->

    <script type="text/javascript">
        $("#categoryadd").click(function(e) {
            e.preventDefault();
            loadURL("categoryadd", $('#content'));
        });

        var obj = {};
        var param = {};


        $('input[name="category_name"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="category_id"]').val('');
            }
        });

        $('input[name="sub_category_name"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="sub_category_id"]').val('');
            }
        });

        console.log($('.table-norma-inquiry tbody tr a').length);

        obj["categoryId"] =  $('input[name="category_id"]').val();
        obj["subCategoryId"] =  $('input[name="sub_category_id"]').val();
        obj["isRandomCategory"] =  $('select[name="randomCategory"]').val();
        obj["onlySubCategory"] =  $('select[name="onlySubCategory"]').val();
        
        var jobMappingName = "";
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
                        "url": "getAllCateogry" // ajax source
                    },
                "order": [
                        [1, "asc"]
                    ]// set first column as a default sort by asc
        });

        param["message"] = "Searches might be slow without any parameter. Do you want to continue ?";
        param["title"] = "Find All";

        drawDialogConfirm(table_normatest,param,"find_all");

        $('#find-category').on('click', function (e) {
            e.preventDefault();

            obj["categoryId"] =  $('input[name="category_id"]').val();
            obj["subCategoryId"] =  $('input[name="sub_category_id"]').val();
            obj["isRandomCategory"] =  $('select[name="randomCategory"]').val();
            obj["onlySubCategory"] =  $('select[name="onlySubCategory"]').val();

            console.log(obj["isRandomCategory"]);

            if(!obj["categoryId"].length && !obj["subCategoryId"].length && (obj["isRandomCategory"] == 0) && (obj["onlySubCategory"] == 0)){
                $('#dialog_simple').dialog('open');
            }else{
                console.log(table_normatest.ajax.params());
                table_normatest.ajax.reload();
            }

        });

        $('.table-norma-inquiry tbody').on( 'click', 'a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            loadURL(url, $('#content'));
        });


         $(".categoryview").click(function(e) {
            e.preventDefault();
            var hrefLink = $(this).attr('href');
            loadURL(hrefLink, $('#content'));
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

      

         $("#sub_category_name").autocomplete({
                source : function(request, response) {
                    $.ajax({
                        type: "POST",
                        url : "getSubCategories",
                        dataType : "json",
                        data : {
                            _token : $('input[name="_token"]').val(),
                            subCategoryName : request.term
                        },
                        success : function(data) {
                            response($.map(data.data_rows, function(item) {
                                return {
                                    label : item.subCatagoryName,
                                    value : item.subCatagoryName,
                                    value_cateid : item.subCategoryId
                                }
                            }));
                        }
                    });
                },
                minLength : 2,
                select : function(event, ui) {
                    $('#sub_category_id').val(ui.item.value_cateid);
                    console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                }
            });

    </script>
