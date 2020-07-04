@include('layouts.header.headerLogin')



<div id="main" role="main" style="margin-left: 0;">

  <!-- MAIN CONTENT -->
  <div id="content" class="container">
    <div class="row">
      <div class="col-md-4" style="float: none; margin: 0 auto;">
        @if(\Session::has('alert'))
            <div class="alert alert-danger">
                <div>{{Session::get('alert')}}</div>
            </div>
        @endif
        <div class="well no-padding">
          <form method="post" action="{{url('')}}/processLogin" id="login-form" class="smart-form client-form">
              @csrf
            <header>
              Sign In
            </header>

            <fieldset>

              <section>
                <label class="label">User Name</label>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="input" name="user_number" maxlength="10" >
                  <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter SIM user Id</b></label>
              </section>

              <section>
                <label class="label">Password</label>
                <label class="input"> <i toggle="#password" class="icon-append fa fa-eye-slash field-icon toggle-password"></i>
                  <input type="password" id="password" name="password">
                  <b class="tooltip tooltip-top-right"><i class="fa fa-eye-slash fa-lock txt-color-teal"></i> Enter your password</b> </label>
              </section>
            </fieldset>
            <footer>
              <button type="submit" class="btn btn-primary">
                Sign in
              </button>
            </footer>
          </form>

        </div>

      </div>
    </div>
  </div>

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

@include('layouts.footer.scripts');


<!-- PAGE RELATED PLUGIN(S)
<script src="..."></script>-->

<script type="text/javascript">
  runAllForms();

  $(function() {
	  $(".toggle-password").click(function() {

              $(this).toggleClass("fa-eye fa-eye-slash");
			  $('.txt-color-teal').toggleClass("fa-eye fa-eye-slash");
              var input = $($(this).attr("toggle"));
              if (input.attr("type") == "password") {
                input.attr("type", "text");
              } else {
                input.attr("type", "password");
              }
        });

    // Validation
    $("#login-form").validate({
      // Rules for form validation
      rules : {
        user_number : {
          required : true
        },
        password : {
          required : true,
          minlength : 3,
          maxlength : 20
        }
      },

      // Messages for form validation
      messages : {
        user_number : {
          required : 'Please enter your SIM User Id'
        },
        password : {
          required : 'Please enter your password'
        }
      },

      // Do not change code below
      errorPlacement : function(error, element) {
        error.insertAfter(element.parent());
      }
    });
  });
</script>
