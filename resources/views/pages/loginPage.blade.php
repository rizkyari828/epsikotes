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
          <form method="get" action="{{url('')}}/processLogin" id="login-form" class="smart-form client-form">
            <header>
              Sign In
            </header>

            <fieldset>

              <section>
                <label class="label">User Name</label>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="email" name="email" size="11">
                  <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter SIM user id</b></label>
              </section>

              <section>
                <label class="label">Password</label>
                <label class="input"> <i class="icon-append fa fa-lock"></i>
                  <input type="password" name="password" size="11">
                  <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
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
    // Validation
    $("#login-form").validate({
      // Rules for form validation
      rules : {
        email : {
          required : true,
          email : true
        },
        password : {
          required : true,
          minlength : 3,
          maxlength : 20
        }
      },

      // Messages for form validation
      messages : {
        email : {
          required : 'Please enter your email address',
          email : 'Please enter a VALID email address'
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
