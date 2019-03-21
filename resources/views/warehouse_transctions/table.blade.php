<table id="transaction" class="table table-striped w-100">
    <thead>
        <tr>
        <th>Model</th>
        <th>Currenty Qty</th>
        <th>Added Qty</th>
        <th>Transction</th>
        <th>Messages</th>
        <th>Created at</th>
            <th>Updated at</th>
      
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($warehouseTransctions as $warehouseTransction)
        <tr>
        <td>{!! $warehouseTransction->model?$warehouseTransction->model->name:'' !!}</td>
            <td>{!! $warehouseTransction->currenty_qty !!}</td>
            <td>{!! $warehouseTransction->added_qty !!}</td>
            <td>{!! $warehouseTransction->action !!}</td>
            <td>{!! $warehouseTransction->messages !!}</td>
            <td>{!! $warehouseTransction->created_at !!}</td>
            <td>{!! $warehouseTransction->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['warehouseTransctions.destroy', $warehouseTransction->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('warehouseTransctions.show', [$warehouseTransction->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <!-- <a href="{!! route('warehouseTransctions.edit', [$warehouseTransction->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> -->
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>