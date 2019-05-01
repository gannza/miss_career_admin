<table id="transaction" class="table table-striped w-100">
    <thead>
        <tr>
        <th>Model</th>
        <th>Branch</th>
        <th>Currenty Qty</th>
        <th>Added Qty</th>
        <th>Removed Qty</th>
        <th>Transfered Qty</th>
        <th>Operation</th>
        <th>Reason</th>
        <th>Messages</th>
        <th>Created at</th>
            <th>Updated at</th>
      
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stockMovements as $stockMovement)
        <tr>
        <td>{!! $stockMovement->model?$stockMovement->model->name:'' !!}</td>
        <td>{!! $stockMovement->branch?$stockMovement->branch->name:'' !!}</td>
            <td>{!! $stockMovement->currenty_qty !!}</td>
            <td>{!! $stockMovement->added_qty !!}</td>
            <td>{!! $stockMovement->removed_qty !!}</td>
            <td>{!! $stockMovement->transfered_qty !!}</td>
            <td>{!! $stockMovement->action !!}</td>
            <td>{!! $stockMovement->reason !!}</td>
            <td>{!! $stockMovement->messages !!}</td>
            <td>{!! $stockMovement->created_at !!}</td>
            <td>{!! $stockMovement->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['stockMovements.destroy', $stockMovement->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('stockMovements.show', [$stockMovement->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <!-- <a href="{!! route('stockMovements.edit', [$stockMovement->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> -->
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>