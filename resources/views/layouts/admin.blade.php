<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>{{ config('app.name', 'Rucodia') }}</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ url('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ url('assets/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ url('assets/css/paper-dashboard.css') }}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ url('assets/css/demo.css') }}" rel="stylesheet" />

    <link href="{{url('css/custom.css')}}" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ url('assets/css/themify-icons.css') }}" rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="success">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.rucodia.or.tz" class="simple-text">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="{{ url('dashboard') }}">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('users') }}">
                        <i class="ti-user"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('categories') }}">
                        <i class="ti-view-list-alt"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('subcategories') }}">
                        <i class="ti-text"></i>
                        <p>Subcategories</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('products') }}">
                        <i class="ti-pencil-alt2"></i>
                        <p>Products</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('regions') }}">
                        <i class="ti-map"></i>
                        <p>Work Areas</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('#') }}">
                        <i class="ti-bell"></i>
                        <p>Settings</p>
                    </a>
                </li>
				<li class="active-pro">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <i class="ti-export"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">{{ $page }}</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
								<p>Stats</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
									<p>User</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="{{ url('user/profile') }}">Profile</a></li>
                                <li><a href="{{ url('user/edit') }}">Edit Details</a></li>
                                <li><a href="{{ url('user/password') }}">Change Password</a></li>
                                <li>&nbsp;</li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                              </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="http://www.rucodia.or.tz">
                                RUCODIA
                            </a>
                        </li>
                        <li>
                            <a href="mailto:admin@rucodia.or.tz">
                               Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="https://opensource.org/licenses/MIT">
                                License
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.softmed.co.tz">Softmed</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="{{ url('assets/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<!-- <script src="{{ url('assets/js/bootstrap-checkbox-radio.js') }}"></script> -->

	<!--  Charts Plugin -->
	<!-- <script src="{{ url('assets/js/chartist.min.js') }}"></script> -->

    <!--  Notifications Plugin    -->
    <!-- <script src="{{ url('assets/js/bootstrap-notify.js') }}"></script> -->

    <!--  Google Maps Plugin    -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<!-- <script src="{{ url('assets/js/paper-dashboard.js') }}"></script> -->

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<!-- <script src="{{ url('assets/js/demo.js') }}"></script> -->

	<!-- <script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	// $.notify({
            // 	icon: 'ti-gift',
            // 	message: "RUCODIA</b> - Farmenrs and Agro Dealers management application."

            // },{
            //     type: 'success',
            //     timer: 4000
            // });

    	});
	</script> -->
</html>