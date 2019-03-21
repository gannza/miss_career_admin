@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Warehouse Transction
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($warehouseTransction, ['route' => ['warehouseTransctions.update', $warehouseTransction->id], 'method' => 'patch']) !!}

                        @include('warehouse_transctions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection