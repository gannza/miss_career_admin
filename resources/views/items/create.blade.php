@extends('layouts.app')

@section('content')
<div id="dsh-container" class="dsh-container dsh-default">
			<div class="dsh-row">
				<div class="clearfix"></div>
					<div class="col-xs-12">
						<div class="col-xs-12 col-md-8 col-md-offset-2">
			                <div class="panel panel-default">
		                        <div class="panel-heading">
		                           <i class="fa fa-user-circle-o"></i> Add a New User 
		                        </div>
		                        <div class="panel-body">
                                    @include('adminlte-templates::common.errors')
                                    <div class="box box-primary">

                                        <div class="box-body">
                                            <div class="row">
                                                {!! Form::open(['route' => 'items.store','class' => 'form-horizontal']) !!}

                                                    @include('items.fields')

                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</div>
@endsection
