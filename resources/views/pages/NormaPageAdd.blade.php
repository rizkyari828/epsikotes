
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
                    <h2>Norma Add </h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->
                    <input type="hidden" name="isDisable" id='isDisable' value="{{$isDisable}}">
                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <form action="{{url('')}}/normasetupProcess" method="post" id="norma-form" class="smart-form" novalidate="novalidate" onsubmit="return validateNormaSetupForm()">
                            <header>
                                Norma Setup
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Category Name</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <i class="icon-append fa fa-search"></i>
                                                    <input type="input" value="{{$valeInput['CATEGORY_NAME']}}" id="sub_category_name" name="sub_category_name" placeholder="Category Name" {{$isDisable}}>
                                                    <input type="hidden" value="{{$valeInput['CATEGORY_ID']}}" name="category_id" id="category_id">
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Version</label>
                                            <div class="col col-3">
                                                <label class="select">
                                                    <select name="version_number" class="version_number"  >
                                                        <option value="0" selected="">- Select -</option>
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
                                                    <textarea rows="5" name="description" placeholder="Description" {{$isDisable}}>{!! $valeInput['DESCRIPTION'] !!}</textarea>
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Effective Date</label>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="date_from" value="{{$valeInput['DATE_FROM']}}" id="startdate" placeholder="From" {{$isDisable}}>
                                                </label>
                                            </div>
                                            <div class="col col-4">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="date_to" value="{{$valeInput['DATE_TO']}}" id="enddate" placeholder="To" {{$isDisable}} >
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
                                    <section class="col col-12">
                                        <div class="product-content product-wrap clearfix product-deatil padding">
                                            <table class="table table-striped table-bordered table-hover table-checkable table-normatest" width="100%" id="table-normatest">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="2%">
                                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                                <span></span>
                                                            </label>
                                                        </th>
                                                        <th width="15%"> Raw Score </th>
                                                        <th width="15%"> Standard Score </th>
                                                        <th width="15%"> Psychogram Aspect </th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    {!! $valeInput['RAW_SCORE'] !!}
                                                </tbody>
                                            </table>

                                            <div class="row">
                                                <section class="col col-11">
                                                    <label class="button bg-color-green">
                                                        <button id="add-row-normatest" class="btn bg-color-green txt-color-white score-add-row"> Add Row
                                                        <i class="fa fa-plus"></i>
                                                    </label>
                                                 </section>

                                                 <section class="col col-11">
                                                    <label class="button bg-color-red">
                                                        <button id="delete-row-normatest" class="btn bg-color-red txt-color-white score-delete-row"> Delete Row
                                                        <i class="fa fa-minus"></i>
                                                    </label>
                                                 </section>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </fieldset>
                            <header>
                                Aspect Definition
                            </header>
                            <fieldset>

                                <div class="row">
                                    <section class="col col-12">
                                        <div class="product-content product-wrap clearfix product-deatil padding">
                                            <table class="table table-striped table-bordered table-hover table-checkable" width="100%" id="table-aspect-definition">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="2%">
                                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                                <span></span>
                                                            </label>
                                                        </th>
                                                        <th width="15%"> Psychogram Aspect </th>
                                                        <th width="200"> Definition </th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    {!! $valeInput['PSYCHOGRAM_ASPECT'] !!}
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <section class="col col-11">
                                                    <label class="button bg-color-green">
                                                        <button id="add-row-aspect-definition" class="btn bg-color-green txt-color-white aspect-add-row"> Add Row
                                                        <i class="fa fa-plus"></i>
                                                    </label>
                                                 </section>

                                                 <section class="col col-11">
                                                    <label class="button bg-color-red">
                                                        <button id="delete-row-aspect-definition" class="btn bg-color-red txt-color-white aspect-delete-row"> Delete Row
                                                        <i class="fa fa-minus"></i>
                                                    </label>
                                                 </section>
                                             </div>
                                        </div>
                                    </section>

                                </div>
                            </fieldset>
                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="NORMA_ID" value="{{$valeInput['NORMA_ID']}}">
                                <button type="submit" class="btn btn-primary">
                                    <i class='fa fa-save'></i>&nbsp;
                                    Submit
                                </button>
                                @if($valeInput['NORMA_ID'] != null)
                                <button type="button" class="btn btn-danger" onclick="removeNorma()">
                                    <i class='fa fa-trash'></i>&nbsp;
                                    Delete
                                </button>
                                @endif
                                 <a class="btn btn-default" id="normasetup" href="#normasetup">
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
        console.log($("#isDisable").val());

        var isDisable = $("#isDisable").val();
        var errorClass = 'invalid';
        var errorElement = 'em';

        if(isDisable.length > 0){
            $(".score-add-row").prop("disabled", true);
            $(".score-delete-row").prop("disabled", true);
            $(".aspect-add-row").prop("disabled", true);
            $(".aspect-delete-row").prop("disabled", true);
        }else{
            $(".score-add-row").prop("disabled", false);
            $(".score-delete-row").prop("disabled", false);
            $(".aspect-add-row").prop("disabled", false);
            $(".aspect-delete-row").prop("disabled", false);
        }
        $("#normasetup").click(function(e) {
            e.preventDefault();
            loadURL("normasetup", $('#content'));
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
                }
            },

            // Messages for form validation
            messages : {
                description : {
                    required : 'Description must be filled'
                },
                version_number: {
                    required : 'Description must be filled'
                },
                date_from : {
                    required : 'Date from must be filled'
                },
                raw_score : {
                    required : 'Raw score must be filled'
                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });

        $('#startdate').datepicker({
                defaultDate: "+1d",
                minDate:1,
                dateFormat : 'd-M-y',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                dateFormat: 'yy-mm-dd',
                beforeShow: function(i) { if ($(i).attr('readonly')) { return false; } },
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
                },
                beforeShow: function(i) { if ($(i).attr('readonly')) { return false; } }
            });

        $("#sub_category_name").autocomplete({
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

        var table_normatest = $('#table-normatest').DataTable({
                    "sDom": "<'row'<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>>"+
                        "<'row't>"+
                        "<'row'<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>>",
                    "oLanguage": {
                        "sSearch": '<label class="input"><i class="icon-append fa fa-search"></i></label>'
                    },
                    "autoWidth" : true
                });

        var counter = 1;

        $('#add-row-normatest').on( 'click', function (e) {
             e.preventDefault();

            table_normatest.row.add( [
                '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label>',
                '<label class="input"><input type="text" name="raw_score[]" placeholder="Raw Score"> </label>',
                '<label class="input"><input type="text" name="standard_score[]" placeholder="Standard Score"> </label>',
                '{!!$aspectNameRawScoreList!!}'
            ] ).draw( false );

            counter++;
        });

        $('#delete-row-normatest').on( 'click', function (e) {
            e.preventDefault();
            table_normatest
            .row( $('input:checkbox:checked').parents('tr') )
            .remove()
            .draw();
        });


        var table_aspect = $('#table-aspect-definition').DataTable({
                    "sDom": "<'row'<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>>"+
                        "<'row't>"+
                        "<'row'<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>>",
                    "oLanguage": {
                        "sSearch": '<label class="input"><i class="icon-append fa fa-search"></i></label>'
                    },
                    "autoWidth" : true
                });

        var counter = 1;

        $('#add-row-aspect-definition').on( 'click', function (e) {
             e.preventDefault();
            table_aspect.row.add( [
                '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label>',
                '{!!$aspectNameSelect!!}',
                '<label class="textarea"><textarea rows="5" name="DEFINITION[]" placeholder="Definition"></textarea></label>'
            ] ).draw( false );

            counter++;
        });

        $('#delete-row-aspect-definition').on( 'click', function (e) {
            e.preventDefault();
            table_aspect
            .row( $('input:checkbox:checked').parents('tr') )
            .remove()
            .draw();
        });

       //Start versions

        $('.version_number').on('change', function(e) {
            e.preventDefault();

            var versionNumber = this.value;
            var normaId = $('input[name="NORMA_ID"]').val();

            if( this.value === 'New'){
                 $('input[name="standard_score[]"]').prop("disabled", false);
                 $('input[name="raw_score[]"]').prop("disabled", false);
                 $('select[name="PSYCHOGRAM_ASPECT_RAW[]"]').prop("disabled", false);
                 $('select[name="PSYCHOGRAM_ASPECT[]"]').prop("disabled", false);
                 $('input[name="date_from"]').prop("disabled", false);
                 $('input[name="date_to"]').prop("disabled", false);
                 $('textarea[name="DEFINITION[]"]').prop("disabled", false);
                 $('textarea[name="description"]').prop("disabled", false);
                 $(".score-add-row").prop("disabled", false);
            $(".score-delete-row").prop("disabled", false);
            $(".aspect-add-row").prop("disabled", false);
            $(".aspect-delete-row").prop("disabled", false);

            }

            $.post( "getNormaVersion", { _token : $('input[name="_token"]').val(), versionNumber : versionNumber, normaId : normaId }, function( data ) {

                var normaListObj = JSON.parse(data);

                console.log(normaListObj);
                $('input[name="category_id"]').val(normaListObj.CATEGORY_ID);
                $('input[name="sub_category_name"]').val(normaListObj.CATEGORY_NAME);
                $('input[name="date_from"]').val(normaListObj.DATE_FROM);
                $('input[name="date_to"]').val(normaListObj.DATE_TO);
                $('input[name="description"]').val(normaListObj.DESCRIPTION);

                var PsychogramAspect = normaListObj.PSYCHOGRAM_ASPECT;
                var RawScore = normaListObj.RAW_SCORE;

                table_normatest
                .clear();

                jQuery.each(RawScore, function(i, val) {
                    table_normatest.row.add( [
                        '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label>',
                        '<label class="input"><input type="text" name="raw_score[]" value="'+val.RAW_SCORES+'" placeholder="Raw Score"> </label>',
                        '<label class="input"><input type="text" name="standard_score[]" value="'+val.STANDARD_SCORE+'" placeholder="Standard Score"> </label>',
                        val.PSYCHOGRAM_ASPECT
                    ] ).draw( false );
                  //  $('select[name="PSYCHOGRAM_ASPECT_RAW[]"]').val(val.PSYCHOGRAM_ASPECT);
                });

                table_aspect
                .clear();


                jQuery.each(PsychogramAspect, function(i, val) {
                    table_aspect.row.add( [
                        '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label>',
                        val.PSYCHOGRAM_ASPECT,
                        '<label class="textarea"><textarea rows="5" name="DEFINITION[]" placeholder="Definition">'+val.DEFINITION+'</textarea></label>'
                    ] ).draw( false );
                });

            });


        });

        function validateNormaSetupForm() {
            $category_id_component = $('#category_id');
            let category_id_value = $category_id_component.val();
            if (category_id_value === "" || category_id_value == null) {
                $component = $('#sub_category_name');
                if (!$component.parent().hasClass("state-error")) {
                    $component.parent().removeClass('state-success').addClass("state-error");
                    $component.parent().parent().append('<em id="sub-category-name-error">Category name must be selected from selections</em>')
                    $component.removeClass('valid');
                }
                return false;
            }
        }

        function removeNorma() {
            $.ajax({
                type: "POST",
                url : "normadelete/" + $('input[name="NORMA_ID"]').val(),
                dataType : "json",
                data : {
                    _token : $('input[name="_token"]').val(),
                },
                success : function(data) {
                    window.console.log(data);
                    window.location.reload();
                },
            });
        }

        //End

    </script>

