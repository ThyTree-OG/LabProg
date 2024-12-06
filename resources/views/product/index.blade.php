@extends('layouts.admin')

@section('content')

<h1> Products </h1>

<table id="product" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Sku</th>
            <th>Description</th>
            <th>Barcode</th>
            <th>Category ID</th>
            <th>Price</th>
            <th>Sale Price</th>
            <th>Sale</th>
            <th>Stock</th>
            <th>Weight</th>
            <th>Color ID</th>
            <th>Size ID</th>
            <th>Width</th>
            <th>Height</th>
            <th>Length</th>
            <th>VAT</th>
            <th>Brand ID</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->barcode }}</td>
            <td>{{ $product->category_id }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->sala_price }}</td>
            <td>{{ $product->sale }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->weight }}</td>
            <td>{{ $product->color_id }}</td>
            <td>{{ $product->size_id }}</td>
            <td>{{ $product->width }}</td>
            <td>{{ $product->height }}</td>
            <td>{{ $product->length }}</td>
            <td>{{ $product->vat }}</td>
            <td>{{ $product->brand_id }}</td>
            <td>{{ $product->created_at }}</td>
            <td>{{ $product->updated_at }}</td>
            <td style="width: 20%;text-align:right;">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Options
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('product.show', $product->id) }}">
                            <i class="far fa-eye"></i> View</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('product.edit', $product->id) }}">
                        <i class="far fa-edit"></i> Edit</a>
                    </li>
                        <li>
                            <form class="dropdown-item" method="POST" action="{{ route('product.destroy', $product->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="bt-destroy" onclick="return confirm('Are you sure?')" type="submit"><i class="far fa-trash-alt"></i> Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a class="btn btn-primary" href="{{ route('product.create') }}">Adicionar</a>
<script>
    $(document).ready(function() {
        $('#product').DataTable();
    });
</script>
@endsection