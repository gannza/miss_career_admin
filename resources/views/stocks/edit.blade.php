@extends('layouts.app')

@section('content')
<div id="dsh-container" class="dsh-container dsh-default">
			<div class="dsh-row">
				<div class="clearfix"></div>
					<div class="col-xs-12">
						<div class="col-xs-12 col-md-8 col-md-offset-2">
			                <div class="panel panel-default">
		                        <div class="panel-heading">
		                           <i class="fa fa-user-circle-o"></i>
								   @if ($stocks->transfer==0)
									   Edit Stock 
									   @endif 
									   @if ($stocks->transfer==1)
									   Transfer Stock 
									   @endif 
									 
		                        </div>
		                        <div class="panel-body">
                                @include('adminlte-templates::common.errors')
								{!! Form::model($stocks, ['route' => ['stocks.update', $stocks->id], 'method' => 'patch','class' => 'form-horizontal group-border stripped']) !!}

                                    @include('stocks.fields')

                                    {!! Form::close() !!}
                                                                                                                
                            </div>  
                        </div>
                    </div>
            </div>
        </div>
</div>
@endsection
