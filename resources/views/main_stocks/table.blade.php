<table id="transaction" class="table table-striped w-100">
    <thead>
        <tr>
        <th>Model</th>
            <th>Currenty Quantity</th>
            <!-- <th>Update Qty</th>
            <th>Total Entered Qty</th> -->
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($main_stocks as $mainStock)
        <tr>
           <td>{!! $mainStock->model?$mainStock->model->name:'' !!}</td>
            <td>{!! $mainStock->qty !!}</td>
            <!-- <td>{!! $mainStock->added_qty !!}</td>
            <td>{!! $mainStock->total_entered_qty !!}</td> -->
            <td>{!! $mainStock->created_at !!}</td>
            <td>{!! $mainStock->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['mainStocks.destroy', $mainStock->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('mainStocks.show', [$mainStock->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>&nbsp;&nbsp;
                    <a href="{!! route('mainStocks.edit', [$mainStock->id,'transfer'=>false]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-plus"></i>/<i class="glyphicon glyphicon-minus"></i></a>&nbsp;&nbsp;
                    @if ($mainStock->qty > 0)
                    <a href="{!! route('mainStocks.edit', [$mainStock->id,'transfer'=>true]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i>Transfer</a>&nbsp;&nbsp;
                    @endif
                   
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>