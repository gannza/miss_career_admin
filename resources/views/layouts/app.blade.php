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
		
		$.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
		const model=[];
		$(document).on('input', '.amount_due', function(){
			var amount_due=$(this).val();
			var total_amount=$('#total_amount').val();
			var balance=$('.balance');
			balance.css({'color':'green'});
			// if((amount_due-total_amount) < 0){
			// 	alert('Insfficient amount paid!');
			// 	balance.css({'color':'red'});
			// }
			balance.html(amount_due-total_amount);
			
		});
		$(document).on('change', '.amount_due', function(){
			var amount_due=$(this).val();
			var total_amount=$('#total_amount').val();
			var balance=$('.balance');
			balance.css({'color':'green'});
			if((amount_due-total_amount) < 0){
				alert('Insfficient amount paid!');
				balance.css({'color':'red'});
			}
			balance.html(amount_due-total_amount);
			
		});
//cart_price
		$(document).on('input', '.cart_price', function(){
			var cart_price=$(this).val();
			var cart_qty=$('.cart_qty').val();
			var cart_total=$('.cart_total');
			var currency=$('.currency').val();
			cart_total.val(currency+' '+cart_price*cart_qty);
			
		});

		$(document).on('input', '.cart_qty', function(){
			var cart_qty=$(this).val();
			var cart_price=$('.cart_price').val();
			var cart_total=$('.cart_total');
			var currency=$('.currency').val();
			cart_total.val(currency+' '+cart_price*cart_qty);
			
		});
		$(document).on('input', '.currency', function(){
			$('.view_currency').html($(this).val());
		});
		


		$(document).on('click', '.delete_cart', function(){
		var cart_id = $(this).attr("id");
            var url = "/destroy_cart/"+cart_id;

            $.ajax({

            type: "GET",
            url: url,
            success: function (data) {
			if(data){
				return window.location.reload();
			}

            },
            error: function (data) {
            console.log('Error:', data);
            }
            });
		});
		$(document).on('change', '.branch_id', function(){
			loadModal();
		});
		$(document).on('change', '.select_model', function(){
			const selected=$(this).val();
			const choosen=model.find(el=>el.id==selected);
			
			var cart_price=$('.cart_price').val(choosen.model.sale_price?choosen.model.sale_price:0.00);
			var cart_qty=$('.cart_qty').val(1);
			var cart_total=$('.cart_total');
			var currency=$('.currency').val();
			var price=$('.cart_price').val();
			var qty=$('.cart_qty').val();
			cart_total.val(currency+' '+price*qty);
		});
		loadModal();
		function loadModal(){
		var branch_id = $('.branch_id').val();;
		// if(branch_id==null){
		// 	alert('Please,choose branch first!');
		// 	return;
		// }
            var url = "/model-branch/"+branch_id;
			var htmls= $('.select_model');
			var option="<option> </option>";
            $.ajax({

            type: "GET",
            url: url,
            success: function (data) {
			if(data){
			data.forEach(element => {
				model.push(element);
				option+=`<option value="${element.id}">${element.model.name}</option>`;
					
				});
				htmls.html(option);
				
			}

            },
            error: function (data) {
            console.log('Error:', data);
            }
            });
		};

		//attr("width")
		$(document).on('click', '.export_warehouse', function(){
			
		});
		//models
		$(document).on('click', '.add_cart', function(){
			var cart_price=$('.cart_price').val();
			var cart_qty=$('.cart_qty').val();
			var cart_total=$('.cart_total').val();
			var cart_model=$('.select_model').val();

			if(cart_model==null || (cart_price==null|| cart_price=="0.00") || (cart_total==null|| cart_total=="0.00") || (cart_qty==null|| cart_qty=="0.00") ){
				alert('Field(s) are required!');
				return;
			}
		var sale_id = $(this).attr("id");
            var url = "/add_cart";

			var token=$('.token').val();
			const data={
				model_id:cart_model,
				sale_id:sale_id,
				price:cart_price,
				qty:cart_qty,
				total:cart_total,
				_token:$('.token').val()
			}
            $.ajax({

            type: "POST",
			url: url,
			data:data,
            success: function (data) {
			if(data){
				return window.location.reload();
			}

            },
            error: function (data) {
            console.log('Error:', data);
            }
            });
        });
	});
	</script>
        
@yield('scripts')
</body>
</html>