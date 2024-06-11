
    <!-- start row -->
    <div class="row">

        <!-- new col start -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- widget id (each widget will need unique id)-->
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
                    <h2>view e - psychotest result </h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- this area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <form action="" id="order-form" class="smart-form" novalidate="novalidate">
                            <header>
                                applicant
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-3" style="text-align: right;">APPLICANT NAME</label>
                                            <div class="label col col-8">
                                                {{$applicantData->FULL_NAME}}
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-3" style="text-align: right;">APPLICANT ID</label>
                                            <div class="label col col-8">
                                                {{$applicantData->APPLICANT_ID}}
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-3" style="text-align: right;">BIRTH DATE</label>
                                            <div class="label col col-8">
                                                {{$applicantData->BIRTH_DATE}}
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-3" style="text-align: right;">KTP</label>
                                            <div class="label col col-8">
                                                {{$applicantData->KTP}}
                                            </div>
                                    </section>
                                </div>
                                @if(count($anotherApplicant) > 0)
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label col col-3" style="text-align: right;">ANOTHER APPLICANT ID</label>
                                                <div class="col col-8">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>applicant name</th>
                                                                <th>applicant id</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($anotherApplicant as $key => $val)
                                                                <tr>
                                                                    <td>{{$val->full_name}}</td>
                                                                    <td>{{$val->applicant_id}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                        </section>
                                    </div>
                                @endif
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-3" style="text-align: right;">USE JOB MAPPING</label>
                                            <div class="label col col-8">
                                                {{$scheduleData->name}}
                                            </div>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-10">
                                        <label class="label col col-3" style="text-align: right;">e-psikotest status</label>
                                            <div class="label col col-8">
                                                {{$scheduleData->test_status}}
                                            </div>
                                    </section>
                                </div>
                            </fieldset>

                            <header>
                                result
                            </header>
                            <fieldset>

                                <div class="row">
                                    <section class="col col-12">
                                        <div class="product-content product-wrap clearfix product-deatil padding">
                                            <table class="table table-striped table-bordered table-hover table-checkable" width="100%" id="table-job-profile">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="10%"> last plan date (from) </th>
                                                        <th width="10%"> last plan date (to) </th>
                                                        <th width="15%"> last actual start date </th>
                                                        <th width="15%"> inductive reasoning </th>
                                                        <th width="15%"> decductive reasoning </th>
                                                        <th width="15%"> reading comp </th>
                                                        
                                                        <th width="15%"> arithmatic ability </th>
                                                        <th width="15%"> spatial ability </th>
                                                        <th width="15%"> memory </th>
                                                        <th width="15%"> total score </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{$scheduleData->plan_start_date}}</td>
                                                        <td>{{$scheduleData->plan_end_date}}</td>
                                                        <td>{{$scheduleData->actual_start_date}}</td>
                                                        @foreach($categoriesResult as $result)
                                                            <td>{{$result}}</td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </section>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row" style="padding: 0 20px;">
                                    <section class="col-lg-12">
                                        <div class="product-content product-wrap clearfix product-deatil padding">
                                            <table class="table table-striped table-bordered table-hover table-checkable">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th> action </th>
                                                        <th> job name </th>
                                                        <th> recomendation </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($resultData as $key => $value)
                                                        <tr>
                                                                <td><a href="psychogram/{{$applicantData->APPLICANT_ID}}/{{$applicantData->FULL_NAME}}/{{$value->job_name}}/{{$value->recomendation_by_system}}/{{$scheduleData->actual_start_date}}/{{$scheduleData->schedule_id}}/{{$scheduleData->job_mapping_id}}/{{$value->job_id}}" target="_blank">psychogram</a></td>
                                                                <td>{{$value->job_name}}</td>
                                                                <td>{{$value->recomendation_by_system}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <a href="#psikotestresult" class="btn btn-primary">
                                        cancel
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
        <!-- end col -->

    </div>

    <!-- end row -->
