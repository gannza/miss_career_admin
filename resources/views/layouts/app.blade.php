<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>STOCK MS - Hello Phones</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="icon" type="image/x-icon" href="/client/images/icons/favicon.png">
		<link rel="apple-touch-icon" href="/client/images/icons/apple-touch-icon.png">
       <link rel="stylesheet" type="text/css" href="/client/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="/client/css/fontawesome.css" />
		<link rel="stylesheet" type="text/css" href="/client/css/components.css"  />
        <link rel="stylesheet" type="text/css" href="/client/css/style.css"  />

    @yield('css')
</head>
<body>
<header>
			<div class="dsh-navbar">
				<nav class="navbar navbar-default">
					<div class="navbar-header">
						<button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#dsh-nav">
							<span class="sr-only">Navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
                        </button>
                       
                        <a href="{{ url('/home') }}" class="navbar-brand "> STOCK MS | Admin Panel</a>
                    </div>
                   

					<ul class="nav navbar-nav navbar-top navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle dropdown-avatar" data-toggle="dropdown">
								<figure style="background: url(client/images/img/avatar.png) no-repeat;" class="img img-avatar"></figure>
								<div>Hi! {!! Auth::user()->name !!} <span class="fa fa-angle-down"></span></div>
                            </a>
                            
							<ul class="dropdown-menu right">
								<!-- <li><a href="#"> Settings <i class="fa fa-gear pull-right"></i></a></li> -->
								@if (Auth::user()->activated_user)
                                <li><a href="change-password.html"> Change Password <i class="fa fa-lock pull-right"></i></a></li>
								@endif

                                <li><a href="{!! url('/logout') !!}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                       Sign out  <i class="fa fa-sign-out pull-right"></i>
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
							</ul>
						</li>
					</ul>
					@if (Auth::user()->activated_user)
                                @include('layouts.sidebar')
					@endif
						
				</nav>
			</div>
        </header>
        
    
        @yield('content')
   

    <!-- Main Footer -->
    <footer class="main-footer" style="max-height: 100px;text-align: center">
        <strong>Copyright © 2019 <a href="#" target="_blank">Stock Technologies</a>.</strong> All rights reserved.
    </footer>

</div>


<!-- jQuery 3.1.1 -->
<script type="text/javascript" src="/client/jQ/jquery.min.js"></script>
<script type="text/javascript" src="/client/jQ/jquery.js"></script>	
<script type="text/javascript" src="/client/jQ/bootstrap.min.js"></script>
<!-- App js  -->
<script type="text/javascript" src="/client/jS/metisMenu.js"></script>
<script type="text/javascript" src="/client/jS/asideNav.js"></script>
<script type="text/javascript" src="/client/jS/dataTables.min.js"></script>
<script type="text/javascript" src="/client/jS/dataTables.bootstrap.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('#transaction').DataTable();
		} );
	</script>
        
@yield('scripts')
</body>
</html>