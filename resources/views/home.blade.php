@extends('layouts.app')

@section('content')
<section>
			<div id="dsh-container" class="dsh-container dsh-default">
				<div class="dsh-row">
					<div class="clearfix"></div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-sm-12 col-xs-6">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<i class="fa fa-cubes fa-2x"></i>
											</div>
											<div class="col-xs-9 text-right">
											<div class="h3"><b>WAREHOUSE STOCK</b></div>
												<div class="counter small"><span class="h4 text-small">Current Qty:{!! $warehouse['current'] !!} - {!! $warehouse['percentage'] !!} %</span></div>
												
											</div>
										</div>
									</div>
									<a href="{!! route('warehouses.index') !!}">
										<div class="panel-footer">
											<span class="pull-left">View More</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-6">
								<div class="panel panel-green">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<i class="fa fa-cubes fa-2x"></i>
											</div>
											<div class="col-xs-9 text-right">
											<div class="h3"><b>MAIN STOCK</b></div>
											<div class="counter small"><span class="h4 text-small">Current Qty:{!! $mainstock['current'] !!} - {!! $mainstock['percentage'] !!} %</span></div>
											</div>
										</div>
									</div>
									<a href="{!! route('mainStocks.index') !!}">
										<div class="panel-footer">
											<span class="pull-left">View More</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
							</div>
						</div>
						
						<div class="clearfix"></div>
					</div>
					
					<div class="col-xs-12">
						<div class="row">
                            <div class="col-xs-12">
                            	<i class="fa fa-cubes"></i> All Branches
                           		<a href="{!! route('branches.create') !!}" class="btn btn-default btn-xs pull-right"> 
                           		+ Add a new Branch
                           	</a>
                            </div>	                        
	                    </div>
	                    <hr class="mt-15">
	                    <div class="row">
						@foreach($stocks as $stock)
							<div class="col-lg-4 col-md-6 col-sm-12 col-xs-6">
								<div class="panel panel_default">
									<div class="panel-heading">
										<div class="row {!! $stock['text_color'] !!}">
											<div class="col-xs-3">
												<i class="fa fa-cube fa-2x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="h3 mt-0"><b>Current Qty:{!! $stock['current'] !!} - {!! $stock['percentage'] !!} %</b></div>
												<div class="h5">{!! $stock['name'] !!}</div>
											</div>
										</div>
									</div>
									<a href="{!! route('stocks.index') !!}">
										<div class="panel-footer">
											<span class="pull-left">View More</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							@endforeach
<!-- 
							<div class="col-lg-4 col-md-6 col-sm-12 col-xs-6">
								<div class="panel panel_default">
									<div class="panel-heading">
										<div class="row text-primary">
											<div class="col-xs-3">
												<i class="fa fa-cube fa-2x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="h3 mt-0"><b>STOCK : 75%</b></div>
												<div class="h5">Down Town Branch</div>
											</div>
										</div>
									</div>
									<a href="#">
										<div class="panel-footer">
											<span class="pull-left">View More</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
								<div class="clearfix"></div>
							</div> -->

							<!-- <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6">
								<div class="panel panel_default">
									<div class="panel-heading">
										<div class="row text-warning">
											<div class="col-xs-3">
												<i class="fa fa-cube fa-2x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="h3 mt-0"><b>STOCK : 50%</b></div>
												<div class="h5">Down Town Branch</div>
											</div>
										</div>
									</div>
									<a href="#">
										<div class="panel-footer">
											<span class="pull-left">View More</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
								<div class="clearfix"></div>
							</div> -->

							<!-- <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6">
								<div class="panel panel_default">
									<div class="panel-heading">
										<div class="row text-danger">
											<div class="col-xs-3">
												<i class="fa fa-cube fa-2x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="h3 mt-0"><b>STOCK : 25%</b></div>
												<div class="h5">Kismenti Branch</div>
											</div>
										</div>
									</div>
									<a href="#">
										<div class="panel-footer">
											<span class="pull-left">View More</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
								<div class="clearfix"></div>
							</div> -->

							<!-- <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6">
								<div class="panel panel_default">
									<div class="panel-heading">
										<div class="row text-success">
											<div class="col-xs-3">
												<i class="fa fa-cube fa-2x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="h3 mt-0"><b>STOCK : 100%</b></div>
												<div class="h5">Remera Branch</div>
											</div>
										</div>
									</div>
									<a href="#">
										<div class="panel-footer">
											<span class="pull-left">View More</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
								<div class="clearfix"></div>
							</div> -->

							<!-- <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6">
								<div class="panel panel_default">
									<div class="panel-heading">
										<div class="row text-primary">
											<div class="col-xs-3">
												<i class="fa fa-cube fa-2x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="h3 mt-0"><b>STOCK : 75%</b></div>
												<div class="h5">Down Town Branch</div>
											</div>
										</div>
									</div>
									<a href="#">
										<div class="panel-footer">
											<span class="pull-left">View More</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
								<div class="clearfix"></div>
							</div> -->

							<!-- <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6">
								<div class="panel panel_default">
									<div class="panel-heading">
										<div class="row text-warning">
											<div class="col-xs-3">
												<i class="fa fa-cube fa-2x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="h3 mt-0"><b>STOCK : 50%</b></div>
												<div class="h5">Down Town Branch</div>
											</div>
										</div>
									</div>
									<a href="#">
										<div class="panel-footer">
											<span class="pull-left">View More</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
								<div class="clearfix"></div>
							</div> -->

							<!-- <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6">
								<div class="panel panel_default">
									<div class="panel-heading">
										<div class="row text-danger">
											<div class="col-xs-3">
												<i class="fa fa-cube fa-2x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="h3 mt-0"><strong>STOCK : 25%</strong></div>
												<div class="h5">Kismenti Branch</div>
											</div>
										</div>
									</div>
									<a href="#">
										<div class="panel-footer">
											<span class="pull-left">View More</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
								<div class="clearfix"></div>
							</div> -->
							<div class="clearfix"></div>
						</div>
					</div>

				</div>
			</div>
		</section>
@endsection
