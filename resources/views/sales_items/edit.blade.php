@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Sales Items
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($salesItems, ['route' => ['salesItems.update', $salesItems->id], 'method' => 'patch']) !!}

                        @include('sales_items.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection