
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
                    <h2>People Enter and Maintain Search </h2>

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

                        <form action="" class="smart-form">


                                <fieldset>

                                <div class="row">
                                    <section class="col col-9">
                                        <label class="label col col-2">User Number</label>
                                            <div class="col col-8">
                                                <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="text" id="user_number" name="user_number" placeholder="User Number">
                                                    <input type="hidden" name="person_id" id="person_id">
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-9">
                                        <label class="label col col-2">Role name</label>
                                            <div class="col col-8">
                                                <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="text" id="role" value="{{$valeInput['ROLE']}}" name="role" placeholder="Role">
                                                    <input type="hidden" name="role_id" value="{{$valeInput['ROLE_ID']}}" id="role_id">
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-9">
                                        <label class="label col col-2">Menu</label>
                                            <div class="col col-8">
                                                <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="text" id="prompt" name="prompt" placeholder="Menu">
                                                    <input type="hidden" name="menu_id" id="menu_id">
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-9">
                                        <label class="label col col-2">Network</label>
                                            <div class="col col-8">
                                                <label class="input {{$disableState}}"> <i class="icon-append fa fa-search"></i>
                                                    <input type="text" id="network" value="{{$valeInput['NETWORK']}}" name="network" placeholder="Network" {{$isDisableByRoles}}>
                                                    <input type="hidden" name="network_id" id="network_id" value="{{$valeInput['NETWORK_ID']}}">
                                                    <input type="hidden" name="cabang_id" id="cabang_id" value="{{$valeInput['CABANG_ID']}}">
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                 <div class="row">
                                    <section class="col col-9">
                                        <label class="label col col-2">Is Active</label>
                                            <div class="col col-8">
                                                <label class="checkbox">
                                                 <input type="checkbox" name="IS_ACTIVE" id="isActive" checked="" value="true"><i></i></label>
                                            </div>
                                    </section>
                                </div>


                            </fieldset>
                            </fieldset>

                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" id="find-people-entry" class="btn btn-primary bt-find">
                                     <i class="fa fa-search"></i>
                                            Search
                                </button>
                                <a class="btn btn-success" id="peopleEnterAdd" href="peopleenteradd">
                                    <i class="fa fa-plus"></i>
                                    New
                                </a>
                                <a class="btn btn-success" id="peopleEnterReset" href="peopleenterreset">
                                    <i class="fa fa-gear"></i>
                                    Reset Password
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
                    <h2>Personal Information Inquiry </h2>

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

                        <table class="table table-striped table-bordered table-hover" id="table-people-enter-inquiry">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="2%">
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                            <span></span>
                                        </label>
                                    </th>
                                    <th width="5%"> Action </th>
                                    <th> Sim ID </th>
                                    <th> Full Name </th>
                                    <th> Role</th>
                                    <th> Network </th>
                                    <th> Is Active </th>
                                    <th> Last updated Date </th>
                                    <th> Last updated By </th>
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

        </article>  
        <!-- END COL -->

    </div>

    <!-- END ROW -->

    <script type="text/javascript">

        $("#peopleEnterAdd").click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            loadURL(url, $('#content'));
        });

        $("#peopleEnterReset").click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            loadURL(url, $('#content'));
        });

        $("#user_number").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getPersonId",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        userNumber : request.term
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.userNumber,
                                value : item.userNumber,
                                valueInput : item.personId
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $('#person_id').val(ui.item.valueInput);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        }); 

        $("#prompt").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getEachMenu",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        promptName : request.term
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.prompt,
                                value : item.prompt,
                                valueInput : item.menuId
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $('#menu_id').val(ui.item.valueInput);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        }); 
        
        $("#network").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getNetworks",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        networkName : request.term
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.networkName,
                                value : item.networkName,
                                valueInput : item.networkId,
                                valueCabangId: item.cabangId
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $('#network_id').val(ui.item.valueInput);
                $('#cabang_id').val(ui.item.valueCabangId);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        }); 

         $("#role").autocomplete({
            source : function(request, response) {
                $.ajax({
                    type: "POST",
                    url : "getRoles",
                    dataType : "json",
                    data : {
                        _token : $('input[name="_token"]').val(),
                        roleName : request.term
                    },
                    success : function(data) {
                        response($.map(data.data_rows, function(item) {
                            return {
                                label : item.roleName,
                                value : item.roleName,
                                valueInput : item.roleId
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $('#role_id').val(ui.item.valueInput);
                console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });

        var obj = {};
        var param = {};

        $('input[name="prompt"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="menu_id"]').val('');
            }
        });

        $('input[name="user_number"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="person_id"]').val('');
            }
        });

        $('input[name="role"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="role_id"]').val('');
            }
        });

         $('input[name="network"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="network_id"]').val('');
                $('input[name="cabang_id"]').val('');
            }
        });

         $('input[name="prompt"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="menu_id"]').val('');
            }
        });

        obj["personId"] =  $('input[name="person_id"]').val();
        obj["roleId"] =  $('input[name="role_id"]').val();
        obj["networkId"] =  $('input[name="cabang_id"]').val();
        obj["isActive"] =  $('input[name="IS_ACTIVE"]').is(':checked');
        obj["isFirstPage"] = 0; 

        var table_normatest = $('#table-people-enter-inquiry').DataTable({
                    "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                    "oLanguage": {
                        "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
                    },  
                    "ajax": {
                            "type": "POST",
                            "data": function( d ) {
                                      
                                  d._token= $('input[name="_token"]').val();
                                  d.paramFilters=obj;
                                },  //{ _token : $('input[name="_token"]').val(),paramFilters:obj},
                            "dataType": "JSON",
                            "url": "getPeopleEnterAll" // ajax source
                    },
                    "language": {
                      "emptyTable": "No data available in table"
                    },
                    "autoWidth" : true,
                    "columns" :[
                        {'data':'checkbox'},
                        {'data':'action'},
                        {'data':'userNumber'},
                        {'data':'fullName'},
                        {'data':'roleName'},
                        {'data':'network'},
                        {'data':'isActive'},
                        {'data':'lastUpdateDate'},
                        {'data':'lastUpdateBy'}
                    ],
                    "order": [
                        [1, "asc"]
                    ]// set first column as a default sort by asc
        });

      

         $('#table-people-enter-inquiry tbody').on( 'click', 'a', function (e) {
            e.preventDefault();
          //  console.log($(this).html());

          var url = $(this).attr('href');
          loadURL(url, $('#content'));

       
        });


        param["message"] = "Searches might be slow without any parameter. Do you want to continue ?";
        param["title"] = "Find All";

        drawDialogConfirm(table_normatest,param,"find_all");

        $('#find-people-entry').on('click', function (e) {
            e.preventDefault();

            obj["personId"] =  $('input[name="person_id"]').val();
            obj["roleId"] =  $('input[name="role_id"]').val();
            obj["networkId"] =  $('input[name="cabang_id"]').val();
            obj["menuId"] =  $('input[name="menu_id"]').val();
            obj["isActive"] =  $('input[name="IS_ACTIVE"]').is(':checked');
            obj["isFirstPage"] = 1;
            // Dialog click
            if(!obj["personId"].length && !obj["roleId"].length && !obj["networkId"].length && !obj["menuId"].length){
                $('#dialog_simple').dialog('open');
            }else {
                    console.log(table_normatest.ajax.params());
                    table_normatest.ajax.reload();
            }

        });



        

    </script>
