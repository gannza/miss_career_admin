<table id="transaction" class="table table-striped w-100">
    <thead>
        <tr>
        <th>Model</th>
            <th>Currenty Quantity</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($warehouses as $warehouse)
        <tr>
           <td>{!! $warehouse->model?$warehouse->model->name:'' !!}</td>
            <td>{!! $warehouse->qty !!}</td>
            <td>{!! $warehouse->created_at !!}</td>
            <td>{!! $warehouse->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['warehouses.destroy', $warehouse->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('warehouses.show', [$warehouse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>&nbsp;&nbsp;
                    <a href="{!! route('warehouses.edit', [$warehouse->id,'transfer'=>false]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-plus"></i>/<i class="glyphicon glyphicon-minus"></i></a>&nbsp;&nbsp;
                    @if ($warehouse->qty > 0)
                    <a href="{!! route('warehouses.edit', [$warehouse->id,'transfer'=>true]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i>Transfer to main stock</a>&nbsp;&nbsp;
                    @endif
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>