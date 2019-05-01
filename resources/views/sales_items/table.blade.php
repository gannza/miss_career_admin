<table class="table table-responsive" id="salesItems-table">
    <thead>
        <tr>
            <th>Model Id</th>
        <th>Sale Id</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($salesItems as $salesItems)
        <tr>
            <td>{!! $salesItems->model_id !!}</td>
            <td>{!! $salesItems->sale_id !!}</td>
            <td>{!! $salesItems->price !!}</td>
            <td>{!! $salesItems->qty !!}</td>
            <td>{!! $salesItems->total !!}</td>
            <td>
                {!! Form::open(['route' => ['salesItems.destroy', $salesItems->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('salesItems.show', [$salesItems->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('salesItems.edit', [$salesItems->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>