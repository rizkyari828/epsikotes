
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
                    <h2>Category Add </h2>

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

                        <form action="{{url('')}}/gategoryProcess" method="post" id="norma-form" class="smart-form" novalidate="novalidate">
                            <header>
                                Create Category Setup
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Category Name</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <input type="input" value="{{$valeInput['CATEGORY_NAME']}}" id="category_name" name="category_name" placeholder="Category Name" {{$isDisableHeader}}>
                                                    <input type="hidden" value="{{$valeInput['CATEGORY_ID']}}" name="CATEGORY_ID" id="category_id">
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Version</label>
                                            <div class="col col-3">
                                                <label class="select">
                                                    <select name="version_number" class="version_number">
                                                        <option value="" selected="">- Select -</option>
                                                        {!! $valeInput['VERSION_NUMBER'] !!}
                                                    </select><i></i>
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Description</label>
                                            <div class="col col-8">
                                                <label class="textarea">
                                                    <textarea rows="5" name="description" placeholder="Description" {{$isDisableBody}}>{!! $valeInput['DESCRIPTION'] !!}</textarea>
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Effective Date</label>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="date_from" value="{{$valeInput['DATE_FROM']}}" id="startdate" placeholder="From" {{$isDisableBody}}>
                                                </label>
                                            </div>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="date_to" value="{{$valeInput['DATE_TO']}}" id="enddate" placeholder="To" {{$isDisableDateTo}}>
                                                </label>
                                            </div>
                                    </section>
                                </div>
                            </fieldset>

                            <header>
                                Norma Test
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-4">Random Sub Category</label>
                                            <div class="col col-8">

                                                 <label class="checkbox">

                                                 @if($valeInput['RANDOM_SUB_CATEGORY'] == '')
                                                 <input type="checkbox" name="RANDOM_SUB_CATEGORY" class="random_sub_category" id="isActive" {{$isDisableBody}}>
                                                 @else
                                                 <input type="checkbox" name="RANDOM_SUB_CATEGORY" class="random_sub_category" id="isActive" checked="" {{$isDisableBody}}>
                                                 @endif

                                                 <i></i></label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-4">Only get 1 sub category</label>
                                            <div class="col col-8">
                                                 <label class="checkbox">

                                                 @if($valeInput['GET_ONE_SUB_CATEGORY'] == '')
                                                 <input type="checkbox" name="GET_ONE_SUB_CATEGORY" class="get_one_sub_category" id="isActive" {{$isDisableBody}}>
                                                 @else
                                                 <input type="checkbox" name="GET_ONE_SUB_CATEGORY" class="get_one_sub_category" id="isActive" checked="" {{$isDisableBody}}>
                                                 @endif
                                                 <i></i></label>
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-8">
                                        <div class="product-content product-wrap clearfix product-deatil padding">

                                            <div class="alert alert-danger alert-block" style="display: none;">
                                                <button type="button" class="close" data-dismiss="alert">×</button> 
                                                    <strong class="msg-err">Sub Categories must be filled</strong>
                                            </div>
                                                
                                            <table class="table table-striped table-bordered table-hover table-checkable" width="100%" id="table-sub-category-list" class="table-sub-category-list">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="1%">
                                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                                <span></span>
                                                            </label>
                                                        </th>
                                                        <th width="60%"> Sub Category Name </th>
                                                        <th width="15%"> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {!! $valeInput['SUB_CATEGORY'] !!}
                                                </tbody>
                                                <tbody>
                                                </tbody>
                                            </table>

                                            <div class="row">
                                                <section class="col col-11">
                                                    <label class="button bg-color-green"> 
                                                        <button id="add-row-sub-categorylist" class="btn bg-color-green txt-color-white" {{$isDisableBody}}> 
                                                            <i class="fa fa-plus"></i>&nbsp;
                                                            Add Row
                                                        
                                                    </label>
                                                 </section> 

                                                 <section class="col col-11">
                                                    <label class="button bg-color-red"> 
                                                        <button id="delete-row-sub-categorylist" class="btn bg-color-red txt-color-white" {{$isDisableBody}}> 
                                                            <i class="fa fa-minus"></i>&nbsp;
                                                            Delete Row
                                                        
                                                    </label>
                                                 </section> 
                                            </div>
                                        </div>
                                    </section>
                                    <section class="col col-4">

                                        <div style="padding-top: 5%" class="col-xs-12 col-md-2">
                                            <div class="form-group">
                                            <button class="contentInput" id="btnUp" style="width: 100px"><i class="glyphicon glyphicon-chevron-up "></i></button>
                                            </div>
                                            <div class="row"></div>
                                            <div class="form-group">
                                            <button class="contentInput" id="btnDown" style="width: 100px"><i class="glyphicon glyphicon-chevron-down" ></i></button>
                                            </div>
                                        </div>

                                    </section>
                                </div>
                                

                            </fieldset>
                            
                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-primary btn-submit" {{$isDisableButtonSubmit}}>
                                    <i class='fa fa-save'></i>&nbsp;
                                    Submit
                                </button>
                                 <a class="btn btn-default" id="normasetup" href="#categorysetup">
                                      <i class="fa fa-chevron-left"></i>&nbsp;
                                    Cancel
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

    <script type="text/javascript">

        $('#startdate').datepicker({
                defaultDate: "+1d",
                minDate:1,
                dateFormat : 'd-M-y',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                dateFormat: 'yy-mm-dd',
                onSelect : function(selectedDate) {
                    var day = new Date(selectedDate);
                    var nextDay = new Date(day);
                    nextDay.setDate(day.getDate()+1);
                    $('#enddate').datepicker('option', 'minDate', nextDay);
                }
            });
         $('#enddate').datepicker({
                dateFormat : 'dd.mm.yy',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                dateFormat: 'yy-mm-dd',
                onSelect : function(selectedDate) {
                    $('#finishdate').datepicker('option', 'minDate', selectedDate);
                }
            });

        $(".sub_category_name").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getSubCategories",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        categoryName : request.term
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
               // $('#category_id').val(ui.item.value_cateid);
                                    $(this).parent('.input').find('.sub_category_id').val(ui.item.value_cateid);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

        var table_subcategory = $('#table-sub-category-list').DataTable({
                    "sDom": "<'row'<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>>"+
                        "<'row't>"+
                        "<'row'<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>>",
                    "oLanguage": {
                        "sSearch": '<label class="input"><i class="icon-append fa fa-search"></i></label>'
                    },  
                    "autoWidth" : true
                });

        var counter = 1;
     
        $('#add-row-sub-categorylist').on( 'click', function (e) {
             e.preventDefault();

             //remove alert
             $(".msg-err").html("");
             $(".alert").hide();

            table_subcategory.row.add( [
                '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label>',
                '<label class="input"><input type="input" id="sub_category_name" class="sub_category_name" name="sub_category_name[]" placeholder="Sub Category Name"><input type="hidden" name="sub_category_id[]" class="sub_category_id" id="sub_category_id"> <i class="icon-append fa fa-search"></i></label>',
                '<a href="">view</a>'
            ]).draw( false );

            $(".sub_category_name").autocomplete({
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
                    $(this).parent('.input').find('.sub_category_id').val(ui.item.value_cateid);
                    console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                }
            });
     
            counter++;

        });

        $('#delete-row-sub-categorylist').on( 'click', function (e) {
            e.preventDefault();
            table_subcategory
            .row( $('input:checkbox:checked').parents('tr') )
            .remove()
            .draw();
        });
        
        $('#btnUp').click(function(e) {
            e.preventDefault();
            moveUp();
        });

        $('#btnDown').click(function(e) {
            e.preventDefault();
            moveDown();
        });

        // Move the row up
        function moveUp() {
            var tr = $('input:checkbox:checked').parents('tr');
            tr.insertBefore(tr.prev());

           // moveRow(tr, 'up');

        }

        // Move the row down
        function moveDown() {
            var tr = $('input:checkbox:checked').parents('tr');
            tr.insertAfter(tr.next());
        }

       //Start versions
        $('.version_number').on('change', function(e) {
            e.preventDefault();

            var versionNumber = this.value;
            var categoryId = $('input[name="CATEGORY_ID"]').val();

            if( this.value === 'New'){
                 $('.sub_category_name').prop("disabled", false);
                 $('.btn').attr("disabled", false);
                 $('textarea[name="description"]').prop("disabled", false);
                 $('input[name="date_from"]').prop("disabled", false);
                 $('input[name="date_to"]').prop("disabled", false);
                 $('.random_sub_category').attr("disabled", false);
                 $('.get_one_sub_category').attr("disabled", false);

                var currentDate = new Date();
                currentDate.setDate(currentDate.getDate('Y-m-d') + 1);                     
                $('input[name="date_from"]').val(currentDate.getFullYear() + "-" + (("0" + (currentDate.getMonth() + 1)).slice(-2)) + "-" + currentDate.getDate());
                $('input[name="date_to"]').val('')
                    //$('#startdate').datepicker(currentDate);



            }else if(this.value > 0){
                $.post( "getCategoryByVersion", { _token : $('input[name="_token"]').val(), versionNumber : versionNumber, categoryId : categoryId }, function( data ) {

                var normaListObj = JSON.parse(data);
                console.log(normaListObj);

                    $('input[name="date_from"]').val(normaListObj.DATE_FROM);
                    $('input[name="date_to"]').val(normaListObj.DATE_TO);  
                    var subCategoryList = normaListObj.SUB_CATEGORY_LIST;
               

                    table_subcategory
                    .clear();


                    jQuery.each(subCategoryList, function(i, val) {
                        table_subcategory.row.add( [
                            '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label>',
                            '<label class="input"><input type="input" id="sub_category_name" class="sub_category_name" name="sub_category_name[]" value="'+val.SUB_CATEGORY_NAME+'" placeholder="Sub Category Name"><input type="hidden" name="sub_category_id[]" value="'+val.SUB_CATEGORY_ID+'" class="sub_category_id" id="sub_category_id"> <i class="icon-append fa fa-search"></i></label>',
                            '<a href="">view</a>'
                        ] ).draw( false );

                    }); 
                
               

                if(normaListObj.isFuture){
                    $('.sub_category_name').prop("disabled", false);
                    $('.btn').attr("disabled", false);
                    $('.btn-submit').attr("disabled", false);
                    $('input[name="date_from"]').prop("disabled", false);
                    $('input[name="date_to"]').prop("disabled", false);

                 $('.random_sub_category').attr("disabled", false);
                 $('.get_one_sub_category').attr("disabled", false);
                }else if(normaListObj.isPast){
                    $('.sub_category_name').prop("disabled", true);
                    $('.btn').attr("disabled", true);
                    $('.btn-submit').attr("disabled", true);
                    $('input[name="date_from"]').prop("disabled", true);
                    $('input[name="date_to"]').prop("disabled", true);
                }else if(normaListObj.isCurrent){
                    $('.sub_category_name').prop("disabled", true);
                    $('button').attr("disabled", true);
                    $('input[name="date_from"]').prop("disabled", true);
                    $('input[name="date_to"]').prop("disabled", false);
                    $('.btn-submit').attr("disabled", false);
                }
            }); 

            }
            
        });
        
        //End 


        var errorClass = 'invalid';
        var errorElement = 'em';


        $("#normasetup").click(function(e) {
            e.preventDefault();
            loadURL("categorysetup", $('#content'));
        });

        jQuery.validator.addMethod("notEqualTo", function (value, element, param) {
            return this.optional(element) || value != param;
        }, "Please specify a different (non-default) value");

        jQuery.validator.addMethod("notEqual", function (value, element, param) {
            return this.optional(element) || $(param).not(element).get().every(function (item) {
                return $(item).val() != value;
            });
        }, "Please specify a different value");

        jQuery.validator.addClassRules("sub_category_name", {
            notEqual: ".sub_category_name"
        });



        var $reviewForm = $("#norma-form").validate({
            errorClass      : errorClass,
            errorElement    : errorElement,
            highlight: function(element) {
                $(element).parent().removeClass('state-success').addClass("state-error");
                $(element).removeClass('valid');
            },
            unhighlight: function(element) {
                $(element).parent().removeClass("state-error").addClass('state-success');
                $(element).addClass('valid');
            },
            // Rules for form validation
            rules : {
                category_name : {
                    required : true,
                    remote: {
                        url: "getExistsCategoryName",
                        type: "post",
                        data: {
                          _token : $('input[name="_token"]').val()
                        }
                    }
                },
                description : {
                    required : true
                },
                version_number: {
                    required : true
                },
                date_from : {
                    required : true
                },
                raw_score : {
                    required : true
                },
                'sub_category_name[]' : {
                    required : true,                    
                    notEqualTo : ".sub_category_name"

                }
            },

            // Messages for form validation
            messages : {
                category_name : {
                    required : 'Category Name must be filled',
                    remote: 'Category Name already in use'

                },
                description : {
                    required : 'Description must be filled'
                },
                version_number: {
                    required : 'Version number must be filled'
                },
                date_from : {
                    required : 'Date from must be filled'
                },
                raw_score : {
                    required : 'Raw score must be filled'
                },'sub_category_name[]' : {
                    required : 'Sub Category must be filled',
                    notEqualTo: 'Profile and Customer Usernames cant be same'
                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            },

            submitHandler : function(element) {
                /*
                var param = {};
                param["message"] = "Are you sure want to save this data ?";
                param["title"] = "Save People Enter and Maintenance";
                drawDialogConfirm(element,param,'submit_form');
                $('#dialog_simple').dialog('open');*/
                //element.submit();
                
                if(!table_subcategory.data().count()){
                    $(".msg-err").html("Sub Categories must be filled");
                    $(".alert").show();
                }else{
                    element.submit();
                }


            }
        });

    </script>

