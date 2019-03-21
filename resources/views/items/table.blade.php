<table class="table table-responsive" id="items-table">
    <thead>
        <tr>
        <th>Name</th>
        <th>Cost Price</th>
        <th>Sale Price</th>
        <th>Barcode</th>
        <th>Description</th>
            <!-- <th colspan="3">Action</th> -->
        </tr>
    </thead>
    <!-- <tbody>
    @foreach($items as $items)
        <tr>
            <td>{!! $items->name !!}</td>
            <td>{!! $items->cost_price !!}</td>
            <td>{!! $items->sale_price !!}</td>
            <td>{!! $items->barcode !!}</td>
            <td>{!! $items->description !!}</td>
            <td>
                {!! Form::open(['route' => ['items.destroy', $items->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('items.show', [$items->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('items.edit', [$items->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody> -->
</table>

@push('scripts')
<script>
$(function() {
    $('#items-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('items.items') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'cost_price', name: 'cost_price' },
            { data: 'sale_price', name: 'sale_price' },
            { data: 'barcode', name: 'barcode' },
            { data: 'description', name: 'description' }
        ]
    });
});
</script>
@endpush