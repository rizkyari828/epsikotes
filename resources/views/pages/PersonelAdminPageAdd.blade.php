
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
                    <h2>Personal Informations Add </h2>

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

                        <form action="" id="order-form" class="smart-form" novalidate="novalidate">
                            <header>
                                Personal Informations
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Sim Number</label>
                                            <div class="col col-8">
                                                 <label class="input">
                                            <input type="email" name="email" placeholder="E-mail">
                                        </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Is Active</label>
                                            <div class="col col-8">
                                                 <label class="checkbox">
                                                 @if($valeInput['IS_ACTIVE'] == '')
                                                 <input type="checkbox" name="IS_ACTIVE" id="isActive" {{$isReadOnly}}>
                                                 @else
                                                 <input type="checkbox" name="IS_ACTIVE" id="isActive" checked="" {{$isReadOnly}} {{$isDisableByRoles}}>
                                                 @endif

                                        <i></i></label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Full name</label>
                                            <div class="col col-8">
                                                 <label class="input">
                                            <input type="email" name="email" placeholder="E-mail">
                                        </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Password</label>
                                            <div class="col col-8">
                                                 <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="Password" name="email" placeholder="E-mail">
                                        </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Network</label>
                                            <div class="col col-8">
                                                <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="email" name="email" placeholder="Network" readonly>
                                                </label>
                                            </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label col col-2">Confirm Password</label>
                                            <div class="col col-8">
                                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                                    <input type="Password" name="email" placeholder="Network" readonly>
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Role</label>
                                            <div class="col col-8">
                                                <label class="input"> <i class="icon-append fa fa-search"></i>
                                                    <input type="email" name="email" placeholder="Network" readonly>
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
                                        <label class="label col col-2">Birth Date</label>
                                            <div class="col col-8">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="startdate" id="startdate" placeholder="Expected start date">
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Age</label>
                                            <div class="col col-8">
                                                <label class=""> 
                                                    27 Years,
                                                </label>
                                                 <label class=""> 
                                                    10 Months
                                                </label>
                                            </div>
                                    </section>
                                </div>


                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Gender</label>
                                            <div class="col col-8 inline-group">
                                                  <label class="radio">
                                            <input type="radio" name="radio-inline" checked="">
                                            <i></i>Male</label>
                                              <label class="radio">
                                            <input type="radio" name="radio-inline" checked="">
                                            <i></i>Female</label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Email</label>
                                            <div class="col col-8">
                                                <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="email" id="email" placeholder="Email">
                                                </label>
                                            </div>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label col col-2">Phone Numbe</label>
                                            <div class="col col-8">
                                                <label class="input"> 
                                            <input type="text" name="ph" id="ph" placeholder="Phone Number">
                                                </label>
                                            </div>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary">
                                    Validate Form
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

    <script type="text/javascript">
        $('#startdate').datepicker({
                dateFormat : 'dd.mm.yy',
                prevText : '<i class="fa fa-chevron-left"></i>',
                nextText : '<i class="fa fa-chevron-right"></i>',
                onSelect : function(selectedDate) {
                    $('#finishdate').datepicker('option', 'minDate', selectedDate);
                }
            });

        $("#city").autocomplete({
            source : function(request, response) {
                $.ajax({
                    url : "http://ws.geonames.org/citiesJSON",
                    dataType : "jsonp",
                    data : {
                        featureClass : "P",
                        style : "full",
                        maxRows : 12,
                        name_startsWith : request.term
                    },
                    success : function(data) {
                        response($.map(data.geonames, function(item) {
                            return {
                                label : item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                                value : item.name
                            }
                        }));
                    }
                });
            },
            minLength : 2,
            select : function(event, ui) {
                log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
            }
        });
        

    </script>

