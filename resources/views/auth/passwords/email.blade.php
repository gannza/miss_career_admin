<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Password Recovery - Hello Phones</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

   <!-- FAVICONS -->
   <link rel="icon" type="image/x-icon" href="../client/images/icons/favicon.png">
		<link rel="apple-touch-icon" href="../client/images/icons/apple-touch-icon.png">

		<!-- CSS
		================================= -->
		<link rel="stylesheet" type="text/css" href="../client/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="../client/css/fontawesome.css" />
		<link rel="stylesheet" type="text/css" href="../client/css/components.css"  />
        <link rel="stylesheet" type="text/css" href="../client/css/style.css"  />

</head>
<body>

<div class="container dsh-login">
	        <div class="row">
	            <div class="col-xs-12">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading mb-15 py">
	                    	<h3 class="mb-0"><a href="{{ url('/home') }}"><b>  PASSWORD RECOVERY </b></a></h3>
                        </div>
                        <p class="alert-info text-center">Enter Email to reset password</p>
	                    <div class="panel-body">
                            <div class="clearfix"></div>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form class="form-horizontal" method="post" action="{{ url('/password/email') }}" id="login-form">
                            {!! csrf_field() !!}
	                    		<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
		                            <div class="col-xs-12">
		                                <div class="input-group input-icon">
		                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
	                    		
		                       
		                        <div class="form-group">
		                        	<div class="col-xs-12">
                                    <button type="submit" class="btn btn-success btn-md btn-block"> Confirm</button>
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
<script type="text/javascript" src="../client/jQ/jquery.min.js"></script>
<script type="text/javascript" src="../client/jQ/jquery.js"></script>	
<script type="text/javascript" src="../client/jQ/bootstrap.min.js"></script>
<!-- App js  -->
<script type="text/javascript" src="../client/jS/metisMenu.js"></script>
<script type="text/javascript" src="../client/jS/asideNav.js"></script>

</body>
</html>
