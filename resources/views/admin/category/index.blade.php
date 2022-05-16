@extends('admin.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4" style="text-align: center">
            <span class="text-muted fw-light"></span>Category
        </h4>
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3">Create</a>
        <div class="card">

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Parent Category Name</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($categories as $category)
                    <tr>
                        <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $category->id }}</strong></td>
                        <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $category->name }}</strong></td>
                        @if(isset($category->parent))
                        <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $category->parent->name }}</strong></td>
                        @else
                        <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i></td>
                        @endif
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.category.edit', ['id' => $category->id]) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ route('admin.category.delete', ['id' => $category->id]) }}"><i class="bx bx-trash me-2"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
