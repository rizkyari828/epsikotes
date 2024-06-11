<main class="main-container">
		<section class="main-highlight">
		</section>
		<section class="main-content">
			<div class="main-content-wrapper">
				<div class="content-body">
					<div class="content-timeline">
           <p> 
		   <form method="GET" action="workspace#testbox"> 
			{{ csrf_field() }}
              {{ method_field('POST') }}
		        <?php
					echo  " " . $applicant->FULL_NAME . " BERHASIL DI HAPUS";
					echo "<br><br>";
                ?>
				<input type="submit" name="draft" class="btn btn-info" value="Kembali">
				</form>
				<br>
				<br>
				
           </p>
</main>