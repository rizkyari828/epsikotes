<!DOCTYPE html>
<html>
<head>
	<title>Psychogram</title>
	<!-- <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap.min-4.3.1.css')}}"> -->
</head>
<style type="text/css">
	.container-fluid {

	    width: 100%;
	    padding-right: 15px;
	    padding-left: 15px;
	    margin-right: auto;
	    margin-left: auto;
	}
	.box-rahasia{
		color: black;
	}
	th{
		font-size: 10pt;
		background-color: #343a40; 
		color: #ffffff;
		width: 21px;
		text-align: center;
	}
	td{
		font-size: 10pt;
		color: #000000;
		width: 21px;
		text-align: center;
	}
</style>
<body>
	<div class="container-fluid">
		<div style="width: 100%;">
			<table>
				<tr>
					<td style="width: 15%; background-color: black; color: white; line-height: 20px; font-size: 15pt;">
						RAHASIA
					</td>
					<td style="width: 85%; text-align: right; ">
		      			<img src="{{ asset('assets/img/logo.png') }}" class="mr-3" alt="head" width="60px" height="30px" style="float: right;">
					</td>
				</tr>
				<tr style=" line-height: 30px;">
					<td style="width: 100%; font-size: 20pt;">
						HASIL EVALUASI PSIKOLOGIS
					</td>
				</tr>
				<tr style=" line-height: 20px;">
					<td style="width: 80px; text-align: left;">NOMOR TES</td>
					<td> : </td>
					<td style="width: 150px; text-align: left; border-bottom: 1px dashed #000;">{{$data[4]}}</td>
					<td></td>
					<td style="width: 80px; text-align: left; ">TANGGAL TES</td>
					<td> : </td>
					<td style="width: 165px; text-align: left; border-bottom: 1px dashed #000">{{$data[3]}}</td>
				</tr>
				<tr style=" line-height: 10px;"><td></td></tr>
				<tr>
					<td style="width: 80px; text-align: left;">NAMA LENGKAP</td>
					<td> : </td>
					<td style="width: 150px; text-align: left; border-bottom: 1px dashed #000;">{{$data[0]}}</td>
					<td></td>
					<td style="width: 80px; text-align: left; ">POSISI</td>
					<td> : </td>
					<td style="width: 165px; text-align: left; border-bottom: 1px dashed #000">{{$data[1]}}</td>
				</tr>
			</table>
		</div>
		<div style="width: 100%; background-color: white;">
			<table border="1">
				<thead>
					<tr>
						<th rowspan="2"><center>#</center></th>
						<th rowspan="2" style="width: 98px;"><center>ASPEK PENILAIAN</center></th>
						<th colspan="4" style="width: 84px;"><center>RENDAH</center></th>
						<th colspan="4" style="width: 84px;"><center>KURANG</center></th>
						<th colspan="4" style="width: 84px;"><center>CUKUP</center></th>
						<th colspan="4" style="width: 84px;"><center>BAIK</center></th>
						<th colspan="4" style="width: 84px;"><center>TINGGI</center></th>
					</tr>
					<tr>
						@for($i = 1; $i <= 20; $i++)
							<th style="background-color: #343a40; color: #ffffff;">{{$i}}</th>
						@endfor
					</tr>
				</thead>
				<tbody>
					<tr>
						<td rowspan="3" >
							<h5>1.</h5>
						</td>
						<td style="width: 98px;">
							<h5><b>PENALARAN INDUKTIF</b></h5>
						</td>
						@for($i = 1; $i <= 20; $i++)
							<td>
								@if($i == $categoriesResult['standard'][0])
						        	<center>X</center>
						        @endif
							</td>
						@endfor
					</tr>
					<tr>
						<td style="width: 98px;">
							<h5>Requirement</h5>
						</td>
							@for($i = 1; $i <= 20; $i++)
								<td>
										@if($i == $categoriesResult['pass'][0])
								        	<center>X</center>
								        @endif
								</td>
							@endfor
					</tr>
					<tr>
						<td style="width: 98px;" >
							<h5>Definisi</h5>
						</td>
						<td colspan="20"  style="width: 420px; text-align: left;">
							<p>kemampuan seseorang untuk menarik kesimpulan umum berdasarkan sejumlah hal-hal yang
spesifik</p>
						</td>
					</tr>
					<tr>
						<td rowspan="3" >
							<h5>2.</h5>
						</td>
						<td style="width: 98px;">
							<h5><b>PENALARAN DEDUKTIF</b></h5>
						</td>
						@for($i = 1; $i <= 20; $i++)
							<td>
								<div class="form-check">
							        @if($i == $categoriesResult['standard'][1])
							        	X
							        @endif
							    </div>
							</td>
						@endfor
					</tr>
					<tr>
						<td style="width: 98px;">
							<h5>Requirement</h5>
						</td>
							@for($i = 1; $i <= 20; $i++)
								<td>
									<div class="form-check">
							          @if($i == $categoriesResult['pass'][1])
								        	X
								        @endif
							      	</div>
								</td>
							@endfor
					</tr>
					<tr>
						<td style="width: 98px;">
							<h5>Definisi</h5>
						</td>
						<td colspan="20"  style="width: 420px; text-align: left;">
							<p>kemampuan membuat kesimpulan dari suatu hukum/dalil/prinsip yang umum kepada suatu keadaan yang khusus</p>
						</td>
					</tr>
					<tr>
						<td rowspan="3" >
							<h5>3.</h5>
						</td>
						<td style="width: 98px;">
							<h5><b>PEMAHAMAN BACAAN</b></h5>
						</td>
						@for($i = 1; $i <= 20; $i++)
							<td>
								<div class="form-check">
							        @if($i == $categoriesResult['standard'][2])
							        	X
							        @endif
							    </div>
							</td>
						@endfor
					</tr>
					<tr>
						<td style="width: 98px;">
							<h5>Requirement</h5>
						</td>
							@for($i = 1; $i <= 20; $i++)
								<td>
									<div class="form-check">
							            @if($i == $categoriesResult['pass'][2])
								        	X
								        @endif
							      	</div>
								</td>
							@endfor
					</tr>
					<tr>
						<td  style="width: 98px;">
							<h5>Definisi</h5>
						</td>
						<td colspan="20"  style="width: 420px; text-align: left;">
							<p>kemampuan untuk memahami, melihat hubungan antar kata, dan menggunakan kata-
kata yang meliputi pemahaman makna kata secara tepat, idiom, dan struktur bahasa</p>
						</td>
					</tr>
					<tr>
						<td rowspan="3" >
							<h5>4.</h5>
						</td>
						<td style="width: 98px;">
							<h5><b>ARITMATIKA</b></h5>
						</td>
						@for($i = 1; $i <= 20; $i++)
							<td>
								<div class="form-check">
							        @if($i == $categoriesResult['standard'][3])
							        	X
							        @endif
							    </div>
							</td>
						@endfor
					</tr>
					<tr>
						<td style="width: 98px;">
							<h5>Requirement</h5>
						</td>
							@for($i = 1; $i <= 20; $i++)
								<td>
									<div class="form-check">
							          @if($i == $categoriesResult['pass'][3])
								        	X
								        @endif
							      	</div>
								</td>
							@endfor
					</tr>
					<tr>
						<td  style="width: 98px;">
							<h5>Definisi</h5>
						</td>
						<td colspan="20" style="width: 420px; text-align: left;" >
							<p>kecepatan dan akurasi dalam mengerjakan tugas-tugas berhitung sederhana yang meliputi penjumlahan, pengurangan, pembagian dan perkalian</p>
						</td>
					</tr>
					<tr>
						<td rowspan="3" >
							<h5>5.</h5>
						</td>
						<td style="width: 98px;">
							<h5><b>KERUANGAN</b></h5>
						</td>
						@for($i = 1; $i <= 20; $i++)
							<td>
								<div class="form-check">
							        @if($i == $categoriesResult['standard'][4])
							        	X
							        @endif
							    </div>
							</td>
						@endfor
					</tr>
					<tr>
						<td style="width: 98px;">
							<h5>Requirement</h5>
						</td>
							@for($i = 1; $i <= 20; $i++)
								<td>
									<div class="form-check">
							          @if($i == $categoriesResult['pass'][4])
								        	X
								        @endif
							      	</div>
								</td>
							@endfor
					</tr>
					<tr>
						<td  style="width: 98px;">
							<h5>Definisi</h5>
						</td>
						<td colspan="20"  style="width: 420px; text-align: left;">
							<p>kemampuan menerima, mengolah, memaknai dan mentransformasi informasi keruangan dalam bentuk-bentuk visual</p>
						</td>
					</tr>
					<tr>
						<td rowspan="3" >
							<h5>6.</h5>
						</td>
						<td style="width: 98px;">
							<h5><b>INGATAN JANGKA PENDEK</b></h5>
						</td>
						@for($i = 1; $i <= 20; $i++)
							<td>
								<div class="form-check">
							        @if($i == $categoriesResult['standard'][5])
							        	X
							        @endif
							    </div>
							</td>
						@endfor
					</tr>
					<tr>
						<td style="width: 98px;">
							<h5>Requirement</h5>
						</td>
							@for($i = 1; $i <= 20; $i++)
								<td>
									<div class="form-check">
							            @if($i == $categoriesResult['pass'][5])
								        	X
								        @endif
							      	</div>
								</td>
							@endfor
					</tr>
					<tr>
						<td  style="width: 98px;">
							<h5>Definisi</h5>
						</td>
						<td colspan="20" style="width: 420px; text-align: left;" >
							<p>kemampuan untuk menangkap dan mengingat secara langsung informasi/instruksi sederhana yang disampaikan orang lain</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<b>RECOMENDATION  : {{$data[2]}}</b>
	</div>
</body>
</html>