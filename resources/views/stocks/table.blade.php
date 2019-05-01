
<table id="transaction" class="table table-striped w-100">
    <thead>
        <tr>
        <th>Model</th>
        <th>Branch</th>
            <th>Currenty Quantity</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stocks as $stock)
        <tr>
           <td>{!! $stock->model?$stock->model->name:'' !!}</td>
           <td>{!! $stock->model?$stock->branch->name:'' !!}</td>
            <td>{!! $stock->qty !!}</td>
            <td>{!! $stock->created_at !!}</td>
            <td>{!! $stock->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['stocks.destroy', $stock->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('stocks.show', [$stock->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>&nbsp;&nbsp;
                    <a href="{!! route('stocks.edit', [$stock->id,'transfer'=>false]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-plus"></i>/<i class="glyphicon glyphicon-minus"></i></a>&nbsp;&nbsp;
                    @if ($stock->qty > 0)
                    <a href="{!! route('stocks.edit', [$stock->id,'transfer'=>true]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i>Transfer</a>&nbsp;&nbsp;
                    @endif
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>