<!-- ---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC. -->



<!--  ---------------- END PHP Custom Scripts ------------- -->

<!-- include header -->
<!-- you can add your custom css in $page_css array. -->
<!-- Note: all css files are inside css/ folder -->
<!-- $page_css[] = "your_style.css"; -->
@include('layouts.header.header')
<!-- include left panel (navigation) -->
<!-- follow the tree in inc/config.ui.php -->
@include('layouts.header.nav',['nav_page' => $param['nav'] ])

<!-- #MAIN PANEL -->
<div id="main" role="main">

	@include('layouts.header.ribbon')
	{{ csrf_field() }}

	<!-- #MAIN CONTENT -->
	<div id="content">

	</div>

	<!-- END #MAIN CONTENT -->

</div>
<!-- END #MAIN PANEL -->

<!-- FOOTER -->
    @include('layouts.footer.footer')
<!-- END FOOTER -->

<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- include required scripts -->
    @include('layouts.footer.scripts')

<!-- include footer -->
    @include('layouts.footer.google-analytics')
