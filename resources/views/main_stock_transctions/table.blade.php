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
    @foreach($mainStockTransctions as $mainStockTransction)
        <tr>
        <td>{!! $mainStockTransction->model?$mainStockTransction->model->name:'' !!}</td>
            <td>{!! $mainStockTransction->currenty_qty !!}</td>
            <td>{!! $mainStockTransction->added_qty !!}</td>
            <td>{!! $mainStockTransction->action !!}</td>
            <td>{!! $mainStockTransction->messages !!}</td>
            <td>{!! $mainStockTransction->created_at !!}</td>
            <td>{!! $mainStockTransction->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['mainStockTransctions.destroy', $mainStockTransction->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('mainStockTransctions.show', [$mainStockTransction->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <!-- <a href="{!! route('mainStockTransctions.edit', [$mainStockTransction->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> -->
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>