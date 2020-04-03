
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

                        <form action="#" method="post" class="smart-form">


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

                            </fieldset>

                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="button" id="btn-search-people" class="btn btn-primary">
                                     <i class="fa fa-search"></i>
                                            Search
                                </button>
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



                        <form action="{{url('')}}/resetPassword" method="post" id="reset-password" class="smart-form" novalidate="novalidate">
                            <fieldset>
                                <select multiple="multiple" size="10" name="passwordPeople[]" class="passwordPeople" id="initializeDuallistbox">
                                    @foreach ($valeInput as $index => $item)
                                        <option value="{{$item['PERSON_ID']}}/{{$item['BIRTH_DATE']}}">{{$item['USER_NUMBER']}} - {{$item['FULL_NAME']}} </option>
                                    @endforeach
                                </select>

                            </fieldset>

                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class='fa fa-save'></i>&nbsp;
                                        Save
                                </button>
                                <a class="btn btn-success" id="peopleEnterBack" href="peopleenter">
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

        </article        <!-- END COL -->

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

         var $reviewForm = $("#reset-password").validate({
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
                'passwordPeople[]_helper2' : {
                    required : true
                }

            },

            // Messages for form validation
            messages : {
                'passwordPeople[]_helper2' : {
                    required : 'Please Selected Employee'
                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });

       $('#initializeDuallistbox').bootstrapDualListbox({
          nonSelectedListLabel: 'Non-selected',
          selectedListLabel: 'Selected',
          preserveSelectionOnMove: 'moved',
          moveOnSelect: false,function(){
             nonSelectedList.prop('required', isDualListBoxValidated);
            instance.elements.originalSelect.prop('required', false);
          }

        });




        $('input[name="user_number"]').on("blur",function(){
            if($(this).val() == ''){
                $('input[name="person_id"]').val('');
            }
        });

        $('#btn-search-people').on('click', function (e) {

                // Stop form from submitting normally
                e.preventDefault();

                // Get some values from elements on the page:
                var personId = $( "input[name='person_id']" ).val(),
                url = 'findUserNumber';



                // Send the data using post
                var search = $.post( url, { _token : $('input[name="_token"]').val(),personId: personId } );

                  // Put the results in a div
                search.done(function( data ) {
                    var obj = jQuery.parseJSON( data );
                    
                    $("#initializeDuallistbox").children().remove();

                    $.each(obj.data_rows, function( index, value ) {
                        console.log(index + ": " + value.personId);
                     // alert( index + ": " + value );
                      $('<option>').val(value.personId+"/"+value.birthDate).text(value.userName+"-"+value.fullName).appendTo("#initializeDuallistbox");

                    });

                    $(".passwordPeople").bootstrapDualListbox('refresh', true);


                });

                

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

    </script>
