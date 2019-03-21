<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - Hello Phones</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

 	<!-- FAVICONS -->
     <link rel="icon" type="image/x-icon" href="client/images/icons/favicon.png">
		<link rel="apple-touch-icon" href="client/images/icons/apple-touch-icon.png">

		<!-- CSS
		================================= -->
		<link rel="stylesheet" type="text/css" href="client/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="client/css/fontawesome.css" />
		<link rel="stylesheet" type="text/css" href="client/css/components.css"  />
        <link rel="stylesheet" type="text/css" href="client/css/style.css"  />
        
</head>

<body>
		<div class="container dsh-login">
	        <div class="row">
	            <div class="col-xs-12">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading mb-15 py">
	                    	<h3 class="mb-0"><a href="{{ url('/home') }}"><b> STOCK MS  |  LOGIN </b></a></h3>
	                    </div>
	                    <div class="panel-body">
	                    	<div class="clearfix"></div>
	                    	<form class="form-horizontal" method="post" action="{{ url('/login') }}" id="login-form">
                                {!! csrf_field() !!}
		                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
		                            <div class="col-xs-12">
		                                <div class="input-group input-icon">
		                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="email"  name="email" id="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email">
                                           
                                        </div>
                                        @if ($errors->has('email'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
		                            </div>
		                            <div class="clearfix"></div>
                                </div>
                                

		                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
		                            <div class="col-xs-12">
		                                <div class="input-group input-icon">
		                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <input type="password" name="password" id="password" class="form-control" value="" placeholder="password">
                                            
                                        </div> 
                                        @if ($errors->has('password'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
		                            </div>
		                        </div>
		                        <div class="clearfix"></div>
		                        <div class="form-group">
                                     <div class="col-xs-8">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>
		                        	<div class="col-xs-12">
                                    <button type="submit" class="btn btn-success btn-md btn-block"> Login</button>
		                        	</div>
		                        </div> 
		                       
		                        <div class="col-lg-12">
		                        	<div class="clearfix"></div>
		                        	<div class="dsh-row">
                                        <center><a  href="{{ url('/password/reset') }}"> Forget your password?</a></center>
                                        <!-- <a href="{{ url('/register') }}" class="text-center">Register a new membership</a> -->
		                        	</div>
		                        </div>
		                    </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	
<!-- /.login-box -->
<!-- jQuery 3.1.1 -->
<script type="text/javascript" src="client/jQ/jquery.min.js"></script>
<script type="text/javascript" src="client/jQ/jquery.js"></script>	
<script type="text/javascript" src="client/jQ/bootstrap.min.js"></script>
<!-- App js  -->
<script type="text/javascript" src="client/jS/metisMenu.js"></script>
<script type="text/javascript" src="client/jS/asideNav.js"></script>

</body>
</html>
