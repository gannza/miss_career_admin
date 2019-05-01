@extends('layouts.app')

@section('content')
<div id="dsh-container" class="dsh-container dsh-default">
			<div class="dsh-row">
				<div class="clearfix"></div>
					<div class="col-xs-12">
						<div class="col-xs-12 col-md-8 col-md-offset-2">
			                <div class="panel panel-default">
		                        <div class="panel-heading">
		                           <i class="fa fa-user-circle-o"></i> Add New Stock
		                        </div>
		                        <div class="panel-body">
                                    @include('adminlte-templates::common.errors')
                                  
                                        {!! Form::open(['route' => 'stocks.store','class' => 'form-horizontal group-border stripped']) !!}

                                            @include('stocks.fields')

                                        {!! Form::close() !!}
                                          
                            </div>  
                        </div>
                    </div>
            </div>
        </div>
</div>
@endsection

