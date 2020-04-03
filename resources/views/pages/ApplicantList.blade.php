<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><a href="#dashboard"><i class="fa-fw fa fa-home"></i>Dashboard </a><span>> Applicant List > {{ $statusLabel }}</span></h1>
    </div>
</div>

<section id="widget-grid" class="">

    <article class="col-sm-12" style="margin-bottom: 50px">
        <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">

            <header>
                <span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
                <h2>Applicant List : {{ $statusLabel }}</h2>
            </header>

            <div class="row">
                <div class="well no-padding">
                    <div class="widget-body" style="padding: 0">
                        <div class="widget-row">

                            <table class="table table-hover" id="dataTable-applicantList">
                                <thead>
                                <tr>
                                    <th>Applicant Name</th>
                                    <th>Applicant ID</th>
                                    <th>KTP</th>
                                    <th>E-Psikotes Status</th>
                                    <th>Plan Date (from)</th>
                                    <th>Plan Date (to)</th>
                                    <th>Start Actual Date</th>
                                    <th>Gender</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $item)
                                    <tr>
                                        <td>{{ $item->{'FULL_NAME'} }}</td>
                                        <td>{{ $item->{'APPLICANT_ID'} }}</td>
                                        <td>{{ $item->{'KTP'} }}</td>
                                        <td>{{ $item->{'TEST_STATUS'} }}</td>
                                        <td>{{ $item->{'PLAN_START_DATE'} }}</td>
                                        <td>{{ $item->{'PLAN_END_DATE'} }}</td>
                                        <td>{{ $item->{'ACTUAL_START_DATE'} }}</td>
                                        <td>{{ $item->{'GENDER'} }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </article>

</section>

<script>
    $('#dataTable-applicantList').DataTable();
</script>
