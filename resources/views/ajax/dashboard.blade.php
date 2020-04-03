<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> My Dashboard</span></h1>
    </div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">
        <article class="col-sm-12">
            <!-- new widget -->
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
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
                    <span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
                    <h2>Cms Dashboard </h2>

                    <ul class="nav nav-tabs pull-right in" id="myTab">
                        <li class="active">
                            <a data-toggle="tab" href="#s1"><i class="fa fa-clock-o"></i> <span class="hidden-mobile hidden-tablet">My Dashboard</span></a>
                        </li>
                    </ul>

                </header>

                <!-- widget div-->
                <div class="no-padding">
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">

                        test
                    </div>
                    <!-- end widget edit box -->

                    <div class="widget-body">
                        <!-- content -->
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in padding-10 no-padding-bottom" id="s1">
                                <!-- START BOX -->
                                <div class="row widget-row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="widget-body alert alert-success">
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="1349" style="font-size: 25px"><span class="value_box_total_iuran"></span> 24</span>
                                                </div>
                                                <div class="desc">Total Complete</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                       <div class="widget-body alert alert-warning">
                                        <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="1349" style="font-size: 25px"><span class="value_box_total_iuran"></span> 10</span>
                                                </div>
                                                <div class="desc">Total Incomplete</div>
                                            </div>
                                    </div>

                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                       <div class="widget-body alert alert-danger">

                                        <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="1349" style="font-size: 25px"><span class="value_box_total_iuran"></span> 40</span>
                                                </div>
                                                <div class="desc">Total Not Attempt</div>
                                            </div>
                                    </div>

                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                       <div class="widget-body alert alert-info">

                                          <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="1349" style="font-size: 25px"><span class="value_box_total_iuran"></span> 6</span>
                                                </div>
                                                <div class="desc">Total Cancel</div>
                                            </div>

                                    </div>

                                    </div>
                                </div>
                                <!-- END BOX -->

                                <!-- START BOX -->
                                <fieldset>
                                    <div class="row widget-row">

                                    </div>
                                </fieldset>
                                <!-- END BOX -->

                            </div>
                            <!-- end s1 tab pane -->
                        </div>

                        <!-- end content -->
                    </div>

                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->

        </article>
    </div>

    <!-- end row -->

</section>
<!-- end widget grid -->

<script>
    /* DO NOT REMOVE : GLOBAL FUNCTIONS!
     *
     * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
     *
     * // activate tooltips
     * $("[rel=tooltip]").tooltip();
     *
     * // activate popovers
     * $("[rel=popover]").popover();
     *
     * // activate popovers with hover states
     * $("[rel=popover-hover]").popover({ trigger: "hover" });
     *
     * // activate inline charts
     * runAllCharts();
     *
     * // setup widgets
     * setup_widgets_desktop();
     *
     * // run form elements
     * runAllForms();
     *
     ********************************
     *
     * pageSetUp() is needed whenever you load a page.
     * It initializes and checks for all basic elements of the page
     * and makes rendering easier.
     *
     */

     var flot_updating_chart, flot_statsChart, flot_multigraph, calendar;

    pageSetUp();

    /*
     * PAGE RELATED SCRIPTS
     */

    // pagefunction

    var pagefunction = function() {

        $(".js-status-update a").click(function () {
            var selText = $(this).text();
            var $this = $(this);
            $this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
            $this.parents('.dropdown-menu').find('li').removeClass('active');
            $this.parent().addClass('active');
        });

        /*
         * TODO: add a way to add more todo's to list
         */

        // initialize sortable

        $("#sortable1, #sortable2").sortable({
            handle: '.handle',
            connectWith: ".todo",
            update: countTasks
        }).disableSelection();


        // check and uncheck
        $('.todo .checkbox > input[type="checkbox"]').click(function () {
            var $this = $(this).parent().parent().parent();

            if ($(this).prop('checked')) {
                $this.addClass("complete");

                // remove this if you want to undo a check list once checked
                //$(this).attr("disabled", true);
                $(this).parent().hide();

                // once clicked - add class, copy to memory then remove and add to sortable3
                $this.slideUp(500, function () {
                    $this.clone().prependTo("#sortable3").effect("highlight", {}, 800);
                    $this.remove();
                    countTasks();
                });
            } else {
                // insert undo code here...
            }

        })
        // count tasks
        function countTasks() {

            $('.todo-group-title').each(function () {
                var $this = $(this);
                $this.find(".num-of-tasks").text($this.next().find("li").size());
            });

        }

        /*
         * RUN PAGE GRAPHS
         */

        // load all flot plugins
        loadScript("js/plugin/flot/jquery.flot.cust.min.js", function(){
            loadScript("js/plugin/flot/jquery.flot.resize.min.js", function(){
                loadScript("js/plugin/flot/jquery.flot.time.min.js", function(){
                    loadScript("js/plugin/flot/jquery.flot.tooltip.min.js", generatePageGraphs());
                });
            });
        });


        function generatePageGraphs() {

            /* TAB 1: UPDATING CHART */
            // For the demo we use generated data, but normally it would be coming from the server

            var data = [],
                totalPoints = 200,
                $UpdatingChartColors = $("#updating-chart").css('color');

            function getRandomData() {
                if (data.length > 0)
                    data = data.slice(1);

                // do a random walk
                while (data.length < totalPoints) {
                    var prev = data.length > 0 ? data[data.length - 1] : 50;
                    var y = prev + Math.random() * 10 - 5;
                    if (y < 0)
                        y = 0;
                    if (y > 100)
                        y = 100;
                    data.push(y);
                }

                // zip the generated y values with the x values
                var res = [];
                for (var i = 0; i < data.length; ++i)
                    res.push([i, data[i]])
                return res;
            }

            // setup control widget
            var updateInterval = 1500;
            $("#updating-chart").val(updateInterval).change(function () {

                var v = $(this).val();
                if (v && !isNaN(+v)) {
                    updateInterval = +v;
                    $(this).val("" + updateInterval);
                }

            });

            // setup plot
            var options = {
                yaxis: {
                    min: 0,
                    max: 100
                },
                xaxis: {
                    min: 0,
                    max: 100
                },
                colors: [$UpdatingChartColors],
                series: {
                    lines: {
                        lineWidth: 1,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.4
                            }, {
                                opacity: 0
                            }]
                        },
                        steps: false

                    }
                }
            };

            flot_updating_chart = $.plot($("#updating-chart"), [getRandomData()], options);

            /* live switch */
            $('input[type="checkbox"]#start_interval').click(function () {
                if ($(this).prop('checked')) {
                    $on = true;
                    updateInterval = 1500;
                    update();
                } else {
                    clearInterval(updateInterval);
                    $on = false;
                }
            });

            function update() {

                try {
                    if ($on == true) {
                        flot_updating_chart.setData([getRandomData()]);
                        flot_updating_chart.draw();
                        setTimeout(update, updateInterval);

                    } else {
                        clearInterval(updateInterval)
                    }
                }
                catch(err) {
                    clearInterval(updateInterval);
                }

            }

            var $on = false;

            /*end updating chart*/

            /* TAB 2: Social Network  */

            $(function () {
                // jQuery Flot Chart
                var twitter = [
                    [1, 27],
                    [2, 34],
                    [3, 51],
                    [4, 48],
                    [5, 55],
                    [6, 65],
                    [7, 61],
                    [8, 70],
                    [9, 65],
                    [10, 75],
                    [11, 57],
                    [12, 59],
                    [13, 62]
                ],
                    facebook = [
                        [1, 25],
                        [2, 31],
                        [3, 45],
                        [4, 37],
                        [5, 38],
                        [6, 40],
                        [7, 47],
                        [8, 55],
                        [9, 43],
                        [10, 50],
                        [11, 47],
                        [12, 39],
                        [13, 47]
                    ],
                    data = [{
                        label: "Twitter",
                        data: twitter,
                        lines: {
                            show: true,
                            lineWidth: 1,
                            fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 0.1
                                }, {
                                    opacity: 0.13
                                }]
                            }
                        },
                        points: {
                            show: true
                        }
                    }, {
                        label: "Facebook",
                        data: facebook,
                        lines: {
                            show: true,
                            lineWidth: 1,
                            fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 0.1
                                }, {
                                    opacity: 0.13
                                }]
                            }
                        },
                        points: {
                            show: true
                        }
                    }];

                var options = {
                    grid: {
                        hoverable: true
                    },
                    colors: ["#568A89", "#3276B1"],
                    tooltip: true,
                    tooltipOpts: {
                        //content : "Value <b>$x</b> Value <span>$y</span>",
                        defaultTheme: false
                    },
                    xaxis: {
                        ticks: [
                            [1, "JAN"],
                            [2, "FEB"],
                            [3, "MAR"],
                            [4, "APR"],
                            [5, "MAY"],
                            [6, "JUN"],
                            [7, "JUL"],
                            [8, "AUG"],
                            [9, "SEP"],
                            [10, "OCT"],
                            [11, "NOV"],
                            [12, "DEC"],
                            [13, "JAN+1"]
                        ]
                    },
                    yaxes: {

                    }
                };

                flot_statsChart = $.plot($("#statsChart"), data, options);
            });

            // END TAB 2

            // TAB THREE GRAPH //
            /* TAB 3: Revenew  */

            $(function () {

                var trgt = [
                    [1354586000000, 153],
                    [1364587000000, 658],
                    [1374588000000, 198],
                    [1384589000000, 663],
                    [1394590000000, 801],
                    [1404591000000, 1080],
                    [1414592000000, 353],
                    [1424593000000, 749],
                    [1434594000000, 523],
                    [1444595000000, 258],
                    [1454596000000, 688],
                    [1464597000000, 364]
                ],
                    prft = [
                        [1354586000000, 53],
                        [1364587000000, 65],
                        [1374588000000, 98],
                        [1384589000000, 83],
                        [1394590000000, 980],
                        [1404591000000, 808],
                        [1414592000000, 720],
                        [1424593000000, 674],
                        [1434594000000, 23],
                        [1444595000000, 79],
                        [1454596000000, 88],
                        [1464597000000, 36]
                    ],
                    sgnups = [
                        [1354586000000, 647],
                        [1364587000000, 435],
                        [1374588000000, 784],
                        [1384589000000, 346],
                        [1394590000000, 487],
                        [1404591000000, 463],
                        [1414592000000, 479],
                        [1424593000000, 236],
                        [1434594000000, 843],
                        [1444595000000, 657],
                        [1454596000000, 241],
                        [1464597000000, 341]
                    ],
                    toggles = $("#rev-toggles"),
                    target = $("#flotcontainer");

                var data = [{
                    label: "Target Profit",
                    data: trgt,
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 30 * 30 * 60 * 1000 * 80
                    }
                }, {
                    label: "Actual Profit",
                    data: prft,
                    color: '#3276B1',
                    lines: {
                        show: true,
                        lineWidth: 3
                    },
                    points: {
                        show: true
                    }
                }, {
                    label: "Actual Signups",
                    data: sgnups,
                    color: '#71843F',
                    lines: {
                        show: true,
                        lineWidth: 1
                    },
                    points: {
                        show: true
                    }
                }]

                var options = {
                    grid: {
                        hoverable: true
                    },
                    tooltip: true,
                    tooltipOpts: {
                        //content: '%x - %y',
                        //dateFormat: '%b %y',
                        defaultTheme: false
                    },
                    xaxis: {
                        mode: "time"
                    },
                    yaxes: {
                        tickFormatter: function (val, axis) {
                            return "$" + val;
                        },
                        max: 1200
                    }

                };

                flot_multigraph = null;

                function plotNow() {
                    var d = [];
                    toggles.find(':checkbox').each(function () {
                        if ($(this).is(':checked')) {
                            d.push(data[$(this).attr("name").substr(4, 1)]);
                        }
                    });
                    if (d.length > 0) {
                        if (flot_multigraph) {
                            flot_multigraph.setData(d);
                            flot_multigraph.draw();
                        } else {
                            flot_multigraph = $.plot(target, d, options);
                        }
                    }

                };

                toggles.find(':checkbox').on('change', function () {
                    plotNow();
                });

                plotNow()

            });

        }

        /*
         * VECTOR MAP
         */

        data_array = {
            "US": 4977,
            "AU": 4873,
            "IN": 3671,
            "BR": 2476,
            "TR": 1476,
            "CN": 146,
            "CA": 134,
            "BD": 100
        };

        // Load Map dependency 1 then call for dependency 2 and then run renderVectorMap function
        loadScript("js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js", function(){
            loadScript("js/plugin/vectormap/jquery-jvectormap-world-mill-en.js", renderVectorMap);
        });


        function renderVectorMap() {
            $('#vector-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: '#fff',
                regionStyle: {
                    initial: {
                        fill: '#c4c4c4'
                    },
                    hover: {
                        "fill-opacity": 1
                    }
                },
                series: {
                    regions: [{
                        values: data_array,
                        scale: ['#85a8b6', '#4d7686'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                onRegionLabelShow: function (e, el, code) {
                    if (typeof data_array[code] == 'undefined') {
                        e.preventDefault();
                    } else {
                        var countrylbl = data_array[code];
                        el.html(el.html() + ': ' + countrylbl + ' visits');
                    }
                }
            });
        }

        /*
         * FULL CALENDAR JS
         */

        // Load Calendar dependency then setup calendar

        loadScript("js/plugin/moment/moment.min.js", function(){
            loadScript("js/plugin/fullcalendar/fullcalendar.min.js", setupCalendar);
        });

        function setupCalendar() {

            if ($("#calendar").length) {
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                calendar = $('#calendar').fullCalendar({

                    editable: true,
                    draggable: true,
                    selectable: false,
                    selectHelper: true,
                    unselectAuto: false,
                    disableResizing: false,
                    height: "auto",

                    header: {
                        left: 'title', //,today
                        center: 'prev, next, today',
                        right: 'month, agendaWeek, agenDay' //month, agendaDay,
                    },

                    select: function (start, end, allDay) {
                        var title = prompt('Event Title:');
                        if (title) {
                            calendar.fullCalendar('renderEvent', {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                }, true // make the event "stick"
                            );
                        }
                        calendar.fullCalendar('unselect');
                    },

                    events: [{
                        title: 'All Day Event',
                        start: new Date(y, m, 1),
                        description: 'long description',
                        className: ["event", "bg-color-greenLight"],
                        icon: 'fa-check'
                    }, {
                        title: 'Long Event',
                        start: new Date(y, m, d - 5),
                        end: new Date(y, m, d - 2),
                        className: ["event", "bg-color-red"],
                        icon: 'fa-lock'
                    }, {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d - 3, 16, 0),
                        allDay: false,
                        className: ["event", "bg-color-blue"],
                        icon: 'fa-clock-o'
                    }, {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d + 4, 16, 0),
                        allDay: false,
                        className: ["event", "bg-color-blue"],
                        icon: 'fa-clock-o'
                    }, {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                        className: ["event", "bg-color-darken"]
                    }, {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        className: ["event", "bg-color-darken"]
                    }, {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false,
                        className: ["event", "bg-color-darken"]
                    }, {
                        title: 'Smartadmin Open Day',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        className: ["event", "bg-color-darken"]
                    }],

                    eventRender: function (event, element, icon) {
                        if (!event.description == "") {
                            element.find('.fc-title').append("<br/><span class='ultra-light'>" + event.description + "</span>");
                        }
                        if (!event.icon == "") {
                            element.find('.fc-title').append("<i class='air air-top-right fa " + event.icon + " '></i>");
                        }
                    }
                });

            };

            /* hide default buttons */
            $('.fc-toolbar .fc-right, .fc-toolbar .fc-center').hide();

        }

        // calendar prev
        $('#calendar-buttons #btn-prev').click(function () {
            $('.fc-prev-button').click();
            return false;
        });

        // calendar next
        $('#calendar-buttons #btn-next').click(function () {
            $('.fc-next-button').click();
            return false;
        });

        // calendar today
        $('#calendar-buttons #btn-today').click(function () {
            $('.fc-button-today').click();
            return false;
        });

        // calendar month
        $('#mt').click(function () {
            $('#calendar').fullCalendar('changeView', 'month');
        });

        // calendar agenda week
        $('#ag').click(function () {
            $('#calendar').fullCalendar('changeView', 'agendaWeek');
        });

        // calendar agenda day
        $('#td').click(function () {
            $('#calendar').fullCalendar('changeView', 'agendaDay');
        });

        /*
         * CHAT
         */

        var filter_input = $('#filter-chat-list'),
            chat_users_container = $('#chat-container > .chat-list-body'),
            chat_users = $('#chat-users'),
            chat_list_btn = $('#chat-container > .chat-list-open-close'),
            chat_body = $('#chat-body');

        /*
         * LIST FILTER (CHAT)
         */

        // custom css expression for a case-insensitive contains()
        jQuery.expr[':'].Contains = function (a, i, m) {
            return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };

        function listFilter(list) {
            // header is any element, list is an unordered list
            // create and add the filter form to the header

            filter_input.change(function () {
                var filter = $(this).val();
                if (filter) {
                    // this finds all links in a list that contain the input,
                    // and hide the ones not containing the input while showing the ones that do
                    chat_users.find("a:not(:Contains(" + filter + "))").parent().slideUp();
                    chat_users.find("a:Contains(" + filter + ")").parent().slideDown();
                } else {
                    chat_users.find("li").slideDown();
                }
                return false;
            }).keyup(function () {
                // fire the above change event after every letter
                $(this).change();

            });

        }

        // on dom ready
        listFilter(chat_users);

        // open chat list
        chat_list_btn.click(function () {
            $(this).parent('#chat-container').toggleClass('open');
        })

        chat_body.animate({
            scrollTop: chat_body[0].scrollHeight
        }, 500);

    };

    // end pagefunction

    // destroy generated instances
    // pagedestroy is called automatically before loading a new page
    // only usable in AJAX version!

    var pagedestroy = function(){

        // destroy calendar
        calendar.fullCalendar('destroy');
        calendar = null;

        //destroy flots
        flot_updating_chart.shutdown();
        flot_updating_chart=null;
        flot_statsChart.shutdown();
        flot_statsChart = null;

        flot_multigraph.shutdown();
        flot_multigraph = null;

        // destroy vector map objects
        $('#vector-map').find('*').addBack().off().remove();

        // destroy todo
        $("#sortable1, #sortable2").sortable("destroy");
        $('.todo .checkbox > input[type="checkbox"]').off();

        // destroy misc events
        $("#rev-toggles").find(':checkbox').off();
        $('#chat-container').find('*').addBack().off().remove();

        // debug msg
        if (debugState){
            root.console.log("✔ Calendar, Flot Charts, Vector map, misc events destroyed");
        }

    }

    // end destroy

    // run pagefunction on load
    pagefunction();


</script>
