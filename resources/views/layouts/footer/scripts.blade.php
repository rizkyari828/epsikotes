<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->


<!-- #PLUGINS -->
<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="assets/js/libs/jquery-3.3.1.min.js"><\/script>');
    }
</script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="assets/js/libs/jquery-ui.min.js"><\/script>');
    }
</script>
<script type="text/javascript">
    function check_session(){
        $.post( "checkLogin",{_token : $('input[name="_token"]').val()})
            .done(function(response) {

                if(response == 1){
                    window.location.href='/';
                }

            }).fail(function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log(msg);
        });
    }

    // setInterval(function(){
    //     check_session();
    // },10000);


</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="{{asset('assets/js/apps/app.config.js')}}"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="{{asset('assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- BOOTSTRAP JS -->
<script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="{{asset('assets/js/notification/SmartNotification.min.js')}}"></script>

<!-- JARVIS WIDGETS -->
<script src="{{asset('assets/js/smartwidgets/jarvis.widget.min.js')}}"></script>

<!-- JQUERY VALIDATE -->
<script src="{{asset('assets/js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>

<!-- JQUERY MASKED INPUT -->
<script src="{{asset('assets/js/plugin/masked-input/jquery.maskedinput.min.js')}}"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="{{asset('assets/js/plugin/select2/select2.min.js')}}"></script>

<!-- JQUERY Data Tables -->
<script src="{{asset('assets/js/plugin/datatables/jquery.dataTables.min.js')}}"></script>

<!-- JQUERY Data Tables colvis -->
<script src="{{asset('assets/js/plugin/datatables/dataTables.colVis.min.js')}}"></script>


<!-- JQUERY Data Tables Tools -->
<script src="{{asset('assets/js/plugin/datatables/dataTables.tableTools.min.js')}}"></script>


<!-- JQUERY Data Tables bootstraps -->
<script src="{{asset('assets/js/plugin/datatables/dataTables.bootstrap.min.js')}}"></script>


<!-- JQUERY Data Tables bootstraps -->
<script src="{{asset('assets/js/plugin/datatable-responsive/datatables.responsive.min.js')}}"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="{{asset('assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js')}}"></script>

<!-- JQUERY Duallistbox -->
<script src="{{asset('assets/js/plugin/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

<!-- browser msie issue fix -->
<script src="{{asset('assets/js/plugin/msie-fix/jquery.mb.browser.min.js')}}"></script>

<!-- FastClick: For mobile devices: you can disable this in app.js -->
<script src="{{asset('assets/js/plugin/fastclick/fastclick.min.js')}}"></script>

<!-- jquery validate -->
<script src="{{asset('assets/js/plugin/jquery-form/jquery-form.min.js')}}"></script>


<script src="{{asset('assets/js/plugin/ckeditor/ckeditor.js')}}"></script>

<script src="{{asset('assets/js/misc.js')}}"></script> 

<!--[if IE 8]>
<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="{{asset('assets/js/apps/app.js')}}"></script>

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<script src="{{asset('assets/js/speech/voicecommand.min.js')}}"></script>

<!-- SmartChat UI : plugin -->
<script src="{{asset('assets/js/smart-chat-ui/smart.chat.ui.min.js')}}"></script>
<script src="{{asset('assets/js/smart-chat-ui/smart.chat.manager.min.js')}}"></script>
