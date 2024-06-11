<html>
   <head>
      <title>Ajax Example</title>
      
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      
    <script>

        $(document).ready(function(){
			document.getElementById("akhir").style.visibility = "hidden";
	    });
	     
        function getMessage() {
			var nilai  = document.getElementById("id").value ;
			var status = "0";
            $.ajax({
               type:'POST',
               url:'/resetPassword',
               data:{
                        _token : $('input[name="_token"]').val(),nilai,status
                    },
                success:function(data) {
                    $("#msg").html(data.msg)
				    var kembalian = data;
				    console.log(kembalian);
				    var obj = JSON.parse(kembalian);
				    document.getElementById("demo").innerHTML  = obj[0];
				    var id2  = obj[1] ;
				    console.log(id2);
				    document.getElementById('appid').value = id2 ;
				    document.getElementById("awal").style.visibility = "hidden";
				    document.getElementById("akhir").style.visibility = "initial";
					document.getElementById("demo").style.visibility  = "initial";
				   

               }
            });
        }

		function getMessage2() {
			var nilai  = document.getElementById("id").value ;
			var status = "1";
            $.ajax({
               type:'POST',
               url:'/resetPassword',
               data:{
                        _token : $('input[name="_token"]').val(),nilai,status
                    },
                success:function(data) {
                    $("#msg").html(data.msg)
				    
				    document.getElementById("awal").style.visibility  = "initial";
				    document.getElementById("akhir").style.visibility = "hidden";
					document.getElementById("demo").style.visibility  = "hidden";
					alert("Berhasil di hapus");
				   

               }
            });
        }
		
      </script>
   </head>
   
   <body onload="hideDiv()">
        <b><p id="demo"></p></b>
        <div id="awal">
		    <input type = "text" name = "applId" id ="id" >
			&nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="buton" name="draft" class="btn btn-info btn-xs" value="CARI" onClick = "getMessage()" id= "cari" >
		</div>
		    
		<div id="akhir">
		    <input type="text" id="appid"  value =""> 
            &nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="buton"  class="btn btn-info btn-xs" value="HAPUS" onClick = "getMessage2()">
		</div>
        
       
	   
	   
	  <input type="hidden" name="_token" value="{{ csrf_token() }}" > <br><br>
	 
	 
   </body>

</html>

<!-- <main class="main-container">
		<section class="main-highlight">
		</section>
		<section class="main-content">
			<div class="main-content-wrapper">
				<div class="content-body">
					<div class="content-timeline">

           <p> 
		   <form method="PUT" action="testbox"> 
			{{ csrf_field() }}
              {{ method_field('PUT') }}
		        Masukan ApliicantID  &nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; 
                <input type = "text" name = "applId" >&nbsp;&nbsp; &nbsp;&nbsp; 
				<input type="submit" name="draft" class="btn btn-info" value="Hapusss">
				</form>
				<br>
				<br>
				
           </p>
</main> -->
    
