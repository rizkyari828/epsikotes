<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
	<link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap.min-4.3.1.css')}}">
</head>
<body>
	<div class="container-fluid" style="padding: 20px 60px;">
		<div class="row">
			<div class="col col-lg-12">
				<table  border = "1">
					<thead>
						<tr>
							<th>No</th>
							<th>Applicant Name t</th>
							<th>Applicant Id</th>
							<th>KTP</th>
							<th>E-Psikotes Status</th>
							<th>Plan Date (from)</th>
							<th>Plan Date (to)</th>
							<th>Start Actual Date</th>
							<th>Total Reshedule</th>
							
						</tr>
					</thead>
					<tbody>
						@foreach($records2 as $key => $value)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$value->full_name}}</td>
								<td>{{$value->applicant_id}}</td>
								<td>{{$value->ktp}}</td>
								<td>{{$value->test_status}}</td>
								<td>{{$value->plan_start_date}}</td>
								<td>{{$value->plan_end_date}}</td>
								<td>{{$value->actual_start_date}}</td>
								<td>{{$value->reschedule_seq}}</td>
								<!-- <td>{{$value->BIRTH_DATE}}</td>
								<td>{{$value->KTP}}</td> -->
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>