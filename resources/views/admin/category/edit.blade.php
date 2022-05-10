@extends('admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"></span> Edit Category    </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Category Details</h5>
               
                <hr class="my-0">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.category.update', ['id' => $category->id]) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') ?? $category->name }}" autofocus="">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Parent_is</label>
                                <input class="form-control" type="text" id="parent" name="parent" value="{{ old('parent_id') ?? $category->parent_id }}" placeholder="" >
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
                            <a href="{{ route('admin.category.index') }}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
