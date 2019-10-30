@extends('adminlte::page')

@section('content')
<h1>Categoryies LIST</h1>
<a href="/admin/categories/create" class="btn btn-primary">CREATE</a>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Created by</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->parent->name ?? '' }}</td>
                <td>{{ $category->user ? $category->user->name : ''}}</td>
                <td>
                    <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-sm btn-primary">EDIT</a>

                    <form action="{{ route('admin.categories.destroy', $category->id)}}" method="POST">
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
                <th>Parent</th>
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

