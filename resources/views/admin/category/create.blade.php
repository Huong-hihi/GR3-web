@extends('admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"></span> Create Category </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <hr class="my-0">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.category.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name" value="" autofocus="">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="parent_id" class="form-label">Parent Category:</label>
                                <select id="parent_id" class="form-select" name="parent_id">
                                    <option value="0">----------</option>
                                    @foreach($parentCategories as $parentCategory)
                                        <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                    @endforeach
                                </select>
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
