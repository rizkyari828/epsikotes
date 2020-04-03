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

        <!-- EASY PIE CHARTS -->
        <script src="js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

        <!-- SPARKLINES -->
        <script src="js/plugin/sparkline/jquery.sparkline.min.js"></script>

        <!-- JQUERY VALIDATE -->
        <script src="{{asset('assets/js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>

        <!-- JQUERY MASKED INPUT -->
        <script src="{{asset('assets/js/plugin/masked-input/jquery.maskedinput.min.js')}}"></script>

        <!-- JQUERY SELECT2 INPUT -->
        <script src="{{asset('assets/js/plugin/select2/select2.min.js')}}"></script>

        <!-- JQUERY UI + Bootstrap Slider -->
        <script src="{{asset('assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js')}}"></script>

        <!-- browser msie issue fix -->
        <script src="{{asset('assets/js/plugin/msie-fix/jquery.mb.browser.min.js')}}"></script>

        <!-- FastClick: For mobile devices: you can disable this in app.js -->
        <script src="{{asset('assets/js/plugin/fastclick/fastclick.min.js')}}"></script>

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
