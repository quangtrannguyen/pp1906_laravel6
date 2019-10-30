@extends('adminlte::page')

@section('content')
<h1>PRODUCTS LIST</h1>
<a href="/admin/products/create" class="btn btn-primary">CREATE</a>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Content</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Created by</th>
                <th>Operator</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->content }}</td>
                <td>{{ $product->category ? $product->category->name : '' }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->user ? $product->user->name : ''}}</td>
                <td>
                    <a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-sm btn-primary">EDIT</a>

                    <form action="{{ route('admin.products.destroy', $product->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    {{__('Delete')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Content</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Created by</th>
                <th>Operator</th>
            </tr>
        </tfoot>
    </table>
@endsection	



@section('js')
    <script> $(document).ready(function() {
    $('#example').DataTable();
    } );
    </script>
@stop	

