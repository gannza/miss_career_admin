@extends('layouts.app')

@section('content')
<section>
			<div id="dsh-container" class="dsh-container dsh-default">
				<div class="dsh-row">
					<div class="clearfix"></div>
					<div class="col-xs-12">
                    <section class="content-header">
                        <h1 class="pull-right">
						<a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('warehouses.create') !!}">Add New</a>
						<a class="btn btn-success export_warehouse" href="javacript::;"><i class="fa fa-print"></i><span> Export into excel</span></a>
                        </h1>
                    </section>
                    <div>
                    <div class="clearfix"></div>
                    @include('flash::message')
                    </div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="panel panel-default">
			                        <div class="panel-heading panel_heading">
			                            <i class="fa fa-user-circle"></i> All Stock Warehouse		                  
                                    </div>
                                 
			                        <div class="panel-body">
			                            <div class="table-responsive">
                                        @include('warehouses.table')
			                               
			                            </div>
			                        </div>
			                    </div>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</section>

        @endsection

