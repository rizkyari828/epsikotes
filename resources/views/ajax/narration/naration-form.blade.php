<div class="row">
        <div id="saveModal" title="Notification">
                <div id="contentholder">
                </div>
            </div>
            <div id="notif_modal" title="Notification">
                    <div id="notif_contentholder">
                    </div>
                </div>
                                <!-- NEW WIDGET START -->
                                <article class="col-sm-12 col-md-12 col-lg-12">

                                    <!-- Widget ID (each widget will need unique ID)-->
                                    <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">

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

                                                <div class="form-horizontal" id="tests" novalidate="novalidate">

                                                    <fieldset>
                                                        <legend>Create Narration Setup</legend>
                                                        <input style="display:none;" id="narrationId" class="form-control" required placeholder="Narration Name" type="text">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Narration Name *</label>
                                                            <div class="col-md-10">
                                                                <span id="name_error" style="color:red;" class="help-block"></span>
                                                                <input id="narrationName" name="fname" class="form-control" required placeholder="Narration Name" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Narration Text *</label>
                                                            <div class="col-md-10">
                                                                    <span id="text_error" style="color:red;" class="help-block"></span>
                                                                    <textarea style="display: block;" id="narrationText" name="ckeditor"></textarea>
                                                            </div>
                                                        </div>


                                                    </fieldset>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                    <button class="btn btn-primary" id="btnSave">
                                                                        <i class="fa fa-save"></i>
                                                                        Save
                                                                    </button>
                                                                    <a class="btn btn-default" href="?#ajax/narration/narration-inquiry.blade.php"> Cancel</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- end widget content -->

                                        </div>
                                        <!-- end widget div -->

                                    </div>

                                </article>

                            </div>


                        <script type="text/javascript">


                        var url      = window.location.href;
                        var param = url.split('=');

                        if (url.indexOf('=') > -1) {
                            var news = url.split('=');
                            getHeader(news[1]);
                        }
                            $('#btnSave').click(function(){
                                 var myContent = CKEDITOR.instances.narrationText.getData();
                                var vals = [
                                    {"fieldName":"name_error", "fieldVal": $('#narrationName').val()},
                                    {"fieldName":"text_error", "fieldVal": myContent}
                                ];

                                if(inputCheckNull(vals) == "OK"){
                                    $('#saveModal').dialog('open');
                                    return false;
                                }else{
                                    alert("repeat gaim");
                                }
                            });

                                CKEDITOR.replace( 'ckeditor', { height: '380px', startupFocus : true} );

                                pageSetUp();;

                            var getHeader = function(param){
                            $.ajax({
                                url: "api/narration/dtl",
                                dataType : "JSON",
                                method : "GET",
                                data : {
                                    "id":param
                                },
                                cache: false,
                                success: function(results){
                                    $.each(results, function(i, result){
                                        $.each(result, function(i, field){
                                            $('#narrationName').prop("readonly", true);
                                            $('#narrationId').val(field.narrationId);
                                            $('#narrationName').val(field.narrationName);
                                            CKEDITOR.instances.narrationText.setData(field.narrationText);
                                            // $('#narrationText').html(field.narrationText);
                                        });
                                    });
                                }
                            });
                        }
                        </script>
