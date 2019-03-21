<table id="transaction" class="table table-striped w-100">
    <thead>
        <tr>
            <th>Names</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($brands as $brands)
        <tr>
            <td>{!! $brands->name !!}</td>
            <td>{!! $brands->description !!}</td>
            <td>
                {!! Form::open(['route' => ['brands.destroy', $brands->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('brands.show', [$brands->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('brands.edit', [$brands->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn
                    btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>

</table>