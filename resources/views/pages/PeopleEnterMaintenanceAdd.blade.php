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
                    <h2>Personal Informations {{$page}} </h2>

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

                        <form action="{{url('')}}/peopleEnterMaintenanceProcess" method="post" id="personal-info-form" class="smart-form" novalidate="novalidate">
                            <header>
                                Personal Informations
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Sim Number *</label>
                                            <div class="col col-8">
                                                 <label class="input">
                                            <input type="text" name="USER_NUMBER" id="user_number" value="{{$valeInput['USER_NUMBER']}}" placeholder="Sim Number" maxlength="10" {{$isDisableUsername}}>
                                        </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Is Active *</label>
                                            <div class="col col-8">
                                                 <label class="checkbox">
                                                 @if($valeInput['IS_ACTIVE'] == '')
                                                 <input type="checkbox" name="IS_ACTIVE" id="isActive" {{$isReadOnly}} @if($isReadOnly == 'readonly') disabled @endif>
                                                 <input type="hidden" name="IS_BASE_ACTIVE" value="0">
                                                 @else
                                                 <input type="checkbox" name="IS_ACTIVE" id="isActive" checked="" {{$isReadOnly}} {{$isDisableByRoles}} @if($isReadOnly == 'readonly') disabled @endif>
                                                 <input type="hidden" name="IS_BASE_ACTIVE" value="1">
                                                 @endif

                                                 <i></i></label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Full name *</label>
                                            <div class="col col-8">
                                                 <label class="input {{$disableState}}">
                                            <input type="text" name="FULL_NAME" id="fullName" value="{{$valeInput['FULL_NAME']}}" placeholder="Full Name" {{$isReadOnly}}>
                                        </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Password</label>
                                            <div class="col col-8">
                                                 <label class="input {{$disableState}} @if($page == "Add") disabled @endif"> <i toggle="#password" class="icon-append fa fa-eye field-icon toggle-password"></i>
                                            <input type="Password" name="PASSWORD" id="password" value="{{$valeInput['PASSWORD']}}" placeholder="@if($page == "Add") Autogenerated @else Password @endif" {{$isReadOnly}} @if($page == "Add") disabled @endif>
                                        </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Network *</label>
                                            <div class="col col-8">
                                                <label class="input {{$disableState}}"> <i class="icon-append fa fa-search "></i>
                                                    <input type="text" id="network" name="network" value="{{$valeInput['NETWORK']}}" placeholder="Network" {{$isDisableByRoles}} {{$isReadOnly}}>
                                                    <input type="hidden" class="required" name="network_id" value="{{$valeInput['NETWORK_ID']}}" id="network_id" >
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Confirm Password</label>
                                            <div class="col col-8">
                                                <label class="input {{$disableState}} @if($page == "Add") disabled @endif"> <i toggle="#CONFIRM_PASSWORD" class="icon-append fa fa-eye field-icon toggle-password"></i>
                                                    <input type="Password"  name="CONFIRM_PASSWORD" value="{{$valeInput['CONFIRM_PASSWORD']}}" id="CONFIRM_PASSWORD" placeholder="@if($page == "Add") Autogenerated @else Confirm Password @endif" {{$isReadOnly}} @if($page == "Add") disabled @endif>
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Role *</label>
                                            <div class="col col-8">
                                                <label class="input {{$disableState}}"> <i class="icon-append fa fa-search"></i>
                                                    <input type="text" id="role" value="{{$valeInput['ROLE']}}" name="role" placeholder="Role" {{$isDisableByRoles}} {{$isReadOnly}}>
                                                    <input type="hidden" name="role_id" value="{{$valeInput['ROLE_ID']}}" id="role_id">
                                                </label>
                                            </div>
                                    </section>
                                </div>
                            </fieldset>

                            <header>
                                Personal Data
                            </header>

                            <fieldset>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Birth Date *</label>
                                            <div class="col col-8">
                                                <label class="input {{$disableState}}"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" name="BIRTH_DATE" id="birthdate" value="{{$valeInput['BIRTH_DATE']}}" placeholder="Birth Date" {{$isReadOnly}}>
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Age</label>
                                            <div class="col col-8">
                                                <label class="ageyears">
                                                     {{$valeInput['YEAR_BIRTH_DATE']}}
                                                </label>
                                                Years,
                                                 <label class="agemonth">
                                                     {{$valeInput['MONTH_BIRTH_DATE']}}
                                                </label>
                                                Months
                                            </div>
                                    </section>
                                </div>


                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Gender *</label>
                                            <div class="col col-8 inline-group">
                                                <label class="radio {{$disableState}}">
                                                     @if($valeInput['GENDER_MALE'] == '')
                                                     <input type="radio" name="GENDER" value="MALE" {{$isDisable}}>
                                                     @else
                                                     <input type="radio" name="GENDER" value="MALE" checked {{$isDisable}}>
                                                     @endif
                                                     <i></i>Male
                                                </label>
                                                <label class="radio">
                                                    @if($valeInput['GENDER_FEMALE'] == '')
                                                    <input type="radio" name="GENDER" value="FEMALE" {{$isDisable}}>
                                                    @else
                                                    <input type="radio" name="GENDER" value="FEMALE" checked {{$isDisable}}>
                                                    @endif
                                                    <i></i>Female
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Email *</label>
                                            <div class="col col-8">
                                                <label class="input {{$disableState}}"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="email" value="{{$valeInput['EMAIL']}}" id="email" placeholder="Email" {{$isReadOnly}}>
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Phone Number *</label>
                                            <div class="col col-8">
                                                <label class="input {{$disableState}}">
                                            <input type="text" name="PHONE_NUMBER" value="{{$valeInput['PHONE_NUMBER']}}" id="phoneNumber" placeholder="Phone Number" {{$isReadOnly}}>
                                                </label>
                                            </div>
                                    </section>
                                </div>
                            </fieldset>

                            @if($navigationForm !== '')
                            <header>
                                Select Menu
                            </header>
                            <fieldset>
                                {!! $navigationForm !!}
                            </fieldset>
                            @endif
                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="PERSON_ID" value="{{$valeInput['PERSON_ID']}}">
                                <button type="submit" class="btn btn-primary" {{$isDisable}}>
                                    <i class='fa fa-save'></i>&nbsp;
                                    Submit
                                </button>
                                <a class="btn btn-default" id="peopleEnterBack" href="{{$linkBack}}">
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

        var errorClass = 'invalid';
        var errorElement = 'em';

        $("#peopleEnterBack").click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            loadURL(url, $('#content'));
        });

        $(".toggle-password").click(function() {

              $(this).toggleClass("fa-eye fa-eye-slash");
              var input = $($(this).attr("toggle"));
              if (input.attr("type") == "password") {
                input.attr("type", "text");
              } else {
                input.attr("type", "password");
              }
        });

        $("input[type='checkbox']").change(function () {
            $(this).parent().parent().parent()
                .find("input[type='checkbox']")
                .prop('checked', this.checked);
        });

        jQuery.validator.addMethod("networkIdChecked", function() {
            if ($('input[name="network_id"]').val() == "") return false;
            else return true;
        }, "Network must be filled");

        jQuery.validator.addMethod("roleChecked", function() {
            if ($('input[name="role_id"]').val() == "") return false;
            else return true;
        }, "Role must be filled");

        jQuery.validator.addMethod("parentChecked", function() {
            if ($('.parent-menus').val() == "") return false;
            else return true;
        }, "Parent menu must be filled");


        jQuery.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[\w.]+$/i.test(value);
        }, "Letters, numbers, and underscores only please");

        jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
        }, "Letters only please");


        /**
         * Custom validator for contains at least one lower-case letter
         */
        jQuery.validator.addMethod("atLeastOneLowercaseLetter", function (value, element) {
            return this.optional(element) || /[a-z]+/.test(value);
        }, "Must have at least one lowercase letter");

        /**
         * Custom validator for contains at least one upper-case letter.
         */
        jQuery.validator.addMethod("atLeastOneUppercaseLetter", function (value, element) {
            return this.optional(element) || /[A-Z]+/.test(value);
        }, "Must have at least one uppercase letter");

        /**
         * Custom validator for contains at least one number.
         */
        jQuery.validator.addMethod("atLeastOneNumber", function (value, element) {
            return this.optional(element) || /[0-9]+/.test(value);
        }, "Must have at least one number");

        /**
         * Custom validator for contains at least one symbol.
         */
        jQuery.validator.addMethod("atLeastOneSymbol", function (value, element) {
            return this.optional(element) || /[!@#$%^&*()]+/.test(value);
        }, "Must have at least one symbol");


        var $reviewForm = $("#personal-info-form").validate({
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
                USER_NUMBER : {
                    required : true,
                    alphanumeric: true,
                    remote: {
                        url: "getExistsUserId",
                        type: "post",
                        data: {
                          _token : $('input[name="_token"]').val()
                        }
                    }
                },
                FULL_NAME: {
                    required : true,
                    alpha : true
                },
                PASSWORD:{
                    atLeastOneLowercaseLetter: true,
                    atLeastOneUppercaseLetter: true,
                    atLeastOneNumber: true,
                    atLeastOneSymbol: true,
                    minlength: 8,
                    maxlength: 40,
                    required: true
                },
                CONFIRM_PASSWORD : {
                    equalTo : "#password"
                },
                network : {
                    required : true,
                    networkIdChecked : true
                },
                role : {
                    required : true,
                    roleChecked : true
                },
                BIRTH_DATE : {
                    required : true
                },
                email : {
                    required : true,
                    email : true

                },
                GENDER : {
                    required : true
                },
                PHONE_NUMBER : {
                    required : true,
                    number: true
                },
                'menu_id[]' : {
                    required : true,
                }

            },

            // Messages for form validation
            messages : {
                USER_NUMBER : {
                    required : 'SIM Number must be filled',
                    alphanumeric: 'SIM Number only letters or numbers   ',
                    remote: 'User Id already in use'
                },
                FULL_NAME: {
                    required : 'Full Name must be filled'
                },
                PASSWORD : {
                    required : 'Password must be filled'
                },
                CONFIRM_PASSWORD : {
                    required : 'Confirm Password must be filled',
                    equalTo : 'Please enter the same value again'
                },
                network : {
                    required : 'Network must be filled'
                },
                role : {
                    required : 'Role must be filled'
                },
                BIRTH_DATE : {
                    required : 'Birth Date must be filled'
                },
                email : {
                    required : 'Email must be filled',
                    email : 'Please enter a VALID email address'

                },
                GENDER : {
                    required : 'Gender must be filled'
                },
                PHONE_NUMBER : {
                    required : 'Phone Number must be filled',
                    number: 'Please enter a valid number'
                },
                'menu_id[]' : {
                    required : 'Menu Name must be filled'
                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            },
            submitHandler : function(element) {
                var param = {};
                param["message"] = "Are you sure want to save this data ?";
                param["title"] = "Save People Enter and Maintenance";
                drawDialogConfirm(element,param,'submit_form');
                $('#dialog_simple').dialog('open');
                //element.submit();
            }
        });

        function getAge(dateString) {
          var today = new Date();
          var birthDate = new Date(dateString);
          var age = today.getFullYear() - birthDate.getFullYear();
          var m = today.getMonth() - birthDate.getMonth();
          if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
          }
          return age;
        }


        @if($isReadOnly != 'readonly')
        $('#birthdate').datepicker({
                dateFormat : 'dd-M-yy',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                 maxDate: 0,
                onSelect : function(selectedDate) {
                           var today = new Date();
                              var birthDate = new Date(selectedDate);
                              var age = today.getFullYear() - birthDate.getFullYear();
                              var m = today.getMonth() - birthDate.getMonth();
                              if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                                age--;
                              }
                             $('.ageyears').html(age);
                             $('.agemonth').html( Math.abs(m));
                }
            });
        @endif




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
                                valueInput : item.networkId
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                $('#network_id').val(ui.item.valueInput);
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





    </script>

