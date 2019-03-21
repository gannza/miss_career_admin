@extends('layouts.app')

@section('content')
<div id="dsh-container" class="dsh-container dsh-default">
			<div class="dsh-row">
				<div class="clearfix"></div>
					<div class="col-xs-12">
						<div class="col-xs-12 col-md-8 col-md-offset-2">
			                <div class="panel panel-default">
		                        <div class="panel-heading">
		                           <i class="fa fa-edit"></i> Edit a Client type 
		                        </div>
		                        <div class="panel-body">
                                    @include('adminlte-templates::common.errors')
                                  
                                    {!! Form::model($clientTypes, ['route' => ['clientTypes.update', $clientTypes->id], 'method' => 'patch','class' => 'form-horizontal group-border stripped']) !!}

                                    @include('clientTypes.fields')

                                    {!! Form::close() !!}
                                                            
                              </div>  
                        </div>
                    </div>
            </div>
        </div>
</div>
@endsection