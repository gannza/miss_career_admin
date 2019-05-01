@extends('layouts.app')

@section('content')
<div id="dsh-container" class="dsh-container dsh-default">
			<div class="dsh-row">
				<div class="clearfix"></div>
					<div class="col-xs-12">
						<div class="col-xs-12 col-md-8 col-md-offset-2">
			                <div class="panel panel-default">
		                        <div class="panel-heading" style="font-weight:bold;font-size:14px">
                                   <i class="fa fa-edit"></i> Edit Invoice #{!! $sales->id !!}, Date:{!! $sales->invoice_date !!}
                                  ,Status: @if ( $sales->payment_status == 'Unpaid')
                                            <span class="label label-danger">{!! $sales->payment_status !!}</span>
                                            @endif
                                            @if ( $sales->payment_status == 'Paid')
                                            <span class="label label-success">{!! $sales->payment_status !!}</span>
                                            @endif
		                        </div>
		                        <div class="panel-body">
                
								@include('adminlte-templates::common.errors')
                                                {!! Form::model($sales, ['route' => ['sales.update', $sales->id], 'method' => 'patch','class' => 'form-horizontal group-border stripped']) !!}

                                                    @include('sales.fields')

                                                    {!! Form::close() !!}
                                                                                                                
                              </div>  
                        </div>
                    </div>
            </div>
        </div>
</div>
@endsection