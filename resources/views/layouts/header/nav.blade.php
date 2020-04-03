<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
                <span> <!-- User image size is adjusted inside CSS, it should stay as is -->

                    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                        <img src="{{asset('assets/img/avatars/sunny.png')}}" alt="me" class="online" />
                        <span>
                            <?php $name = Session::get('user.username');?>
                            {{$name}}
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>

                </span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive

    To make this navigation dynamic please make sure to link the node
    (the reference to the nav > ul) after page load. Or the navigation
    will not initialize.
    -->
    <nav>
        <!--
        NOTE: Notice the gaps after each icon usage <i></i>..
        Please note that these links work a bit different than
        traditional href="" links. See documentation for details.
        -->
        {{!! $nav_page !!}}
    </nav>



    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>
<!-- END NAVIGATION -->
