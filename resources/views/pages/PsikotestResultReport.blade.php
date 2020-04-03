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
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Name Of Participant</th>
							<th>Applicant Id</th>
							<th>Plan Date (from)</th>
							<th>Plan Date (to)</th>
							<th>Actual Start Date</th>
							<th>Status</th>
							<th>Date Of Birth</th>
							<th>Identity Number</th>
							<th>Education</th>
							<th>Sex</th>
							<th>User Name</th>
							<th>No Telp</th>
							<th>Inductive Reasoning</th>
							<th>Deductive Reasoning</th>
							<th>Reading Comprehension</th>
							<th>Arithmetic Ability</th>
							<th>Spatial Ability</th>
							<th>Memory</th>
							<th>Total Score</th>
							<th>Recomendation</th>
							<th>Job Mapping</th>
						</tr>
					</thead>
					<tbody>
						@foreach($records2 as $key => $value)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$value->FULL_NAME}}</td>
								<td>{{$value->APPLICANT_ID}}</td>
								<td>{{$value->PLAN_START_DATE}}</td>
								<td>{{$value->PLAN_END_DATE}}</td>
								<td>{{$value->ACTUAL_START_DATE}}</td>
								<td>{{$value->TEST_STATUS}}</td>
								<td>{{$value->BIRTH_DATE}}</td>
								<td>{{$value->KTP}}</td>
								<td>{{$value->LAST_EDUCATIONS}}</td>
								<td>{{$value->GENDER}}</td>
								<td>{{$value->USER_NAME}}</td>
								<td>{{$value->PHONE_NUMBER}}</td>
								@foreach($categoriesResult[$key] as $val)
									<td>{{$val}}</td>
								@endforeach
								<td>{{$value->RECOMENDATION_BY_SYSTEM}}</td>
								<td>{{$value->NAME}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>