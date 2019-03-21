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
								   @if ($warehouses->transfer==0)
									   Edit Stock Warehouse 
									   @endif 
									   @if ($warehouses->transfer==1)
									   Transfer Stock 
									   @endif 
		                        </div>
		                        <div class="panel-body">
                                @include('adminlte-templates::common.errors')
								{!! Form::model($warehouses, ['route' => ['warehouses.update', $warehouses->id], 'method' => 'patch','class' => 'form-horizontal group-border stripped']) !!}

                                    @include('warehouses.fields')

                                    {!! Form::close() !!}
                                                                                                                
                            </div>  
                        </div>
                    </div>
            </div>
        </div>
</div>
@endsection
