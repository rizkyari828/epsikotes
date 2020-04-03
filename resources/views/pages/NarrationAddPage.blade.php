<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">

            <header>
                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
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
                     <form action="{{url('')}}/narrationProcess" method="post" id="narration-form" class="smart-form" novalidate="novalidate">
                             <header>
                                Create Narration Setup
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">Narration Name</label>
                                            <div class="col col-8">
                                                <label class="input">
                                                    <input type="input" id="NARRATION_NAME" name="NARRATION_NAME" 
                                                    value="{{$valeInput['NARRATION_NAME']}}" placeholder="Narration Name" {{$isReadOnly}} required>

                                                </label>
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-2">Narration Text</label>
                                            <div class="col col-8">
                                                <textarea style="display: block;" id="NARRATION_TEXT" name="NARRATION_TEXT" required>
                                                    {!!$valeInput['NARRATION_TEXT']!!}
                                                </textarea>
                                            </div>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="NARRATION_ID" id="narr_id" value="{{$valeInput['NARRATION_ID']}}">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">
                                     <i class='fa fa-save'></i>&nbsp;
                                        Save
                                </button>
                                 <a class="btn btn-default" id="narrationback" href="narrationsetup">
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

    </article>
    <?php
        $narr = array();
        foreach ($narrations as $key => $value) {
            array_push($narr, $value->NARRATION_NAME);
        }
    ?>
</div>


<script src="assets/js/plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript">


var url      = window.location.href;
var param = url.split('=');

$("#narrationback").click(function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    loadURL(url, $('#content'));
});


    CKEDITOR.replace( 'NARRATION_TEXT', { height: '380px', startupFocus : true} );
    var narration = <?php echo json_encode($narr); ?>;
    var errorClass = 'invalid';
    var errorElement = 'em';
    var $narrationForm = $("#narration-form").validate({
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
            ignore: [],
            rules : {
                NARRATION_NAME : {
                    required : true,
                    remote: {
                        url: "getExistingNameNarration",
                        type: "post",
                        data: {
                          _token : $('input[name="_token"]').val()
                        }
                    }              
                },
                NARRATION_TEXT : {
                    required: function() {CKEDITOR.instances.NARRATION_TEXT.updateElement();}
                }

            },

            // Messages for form validation
            messages : {
                NARRATION_NAME : {
                    required : 'Narration Name must be filled',
                    remote: 'Narration Name already in use'
                },
                NARRATION_TEXT : {
                    required: 'Narration Text must be filled'
                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            },

            submitHandler : function(element) {
                var param = {};
                param["message"] = "Are you sure want to save this data ?";
                param["title"] = "Narration Setup";
                drawDialogConfirm(element,param,'submit_form');
                $('#dialog_simple').dialog('open');
                //element.submit();
            }
        });
    /*$("#btnSubmit").click(function(e) {
      // Call submit() method on <form id='myform'>
        var text = CKEDITOR.instances.NARRATION_TEXT.getData();
        var name = document.getElementById('NARRATION_NAME').value;
        var id = document.getElementById('narr_id').value;
        var validate = true;
        if(id == ""){
            for (var i = 0; i < narration.length; i++) {
                if(name == narration[i]){
                    validate = false;
                }
            }
        }
        if(validate){
            if(name == ""){
                alert('Narration Name cannot be empty');
            }else if(text == ""){
                alert('Narration Text cannot be empty');
            }else{
                if(name != name.toUpperCase()){
                    alert('Narration Name must be unique');
                }else{
                    if(confirm("Do you really want to submit?"))
                        document.getElementById('narration-form').submit(); 
                }
            }
        }else{
            alert('Narration Name must be unique');
        }
    });*/
</script>
