@extends('layouts.app')

@section('content')
<div id="dsh-container" class="dsh-container dsh-default">
		<div class="dsh-row">
				<div class="clearfix"></div>
					<div class="col-xs-12">
						<div class="col-xs-12 col-md-8 col-md-offset-2">
			                <div class="panel panel-default">
		                        <div class="panel-heading">
		                           <i class="fa fa-user-circle-o"></i>Warehouse 
		                        </div>
		                        <div class="panel-body">
                                @include('warehouses.show_fields')
									<a href="{!! route('warehouses.index') !!}" class="btn btn-default">Back</a>
                   				 </div>  
                        </div>
                    </div>
            </div>
        </div>
</div>
@endsection
