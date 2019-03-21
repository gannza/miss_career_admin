<table id="transaction" class="table table-striped w-100">
    <thead>
        <tr>
            <th>Name</th>
            <th>Cost price</th>
            <th>Sale price</th>
        <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($models as $models)
        <tr>
            <td>{!! $models->name !!}</td>
            <td>{!! $models->cost_price !!}</td>
            <td>{!! $models->sale_price !!}</td>
            <td>{!! $models->description !!}</td>
            <td>
                {!! Form::open(['route' => ['models.destroy', $models->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('models.show', [$models->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('models.edit', [$models->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>