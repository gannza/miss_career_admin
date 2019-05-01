@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Stock Movements
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($stockMovements, ['route' => ['stockMovements.update', $stockMovements->id], 'method' => 'patch']) !!}

                        @include('stock_movements.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection