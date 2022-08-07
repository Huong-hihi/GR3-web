@extends('admin.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light"></span> Singer Create
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form method="POST" action="{{ route('admin.singer.store') }}" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ cxl_asset('images/default-user-image.png') }}" alt="user-avatar"
                                     class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload Avatar</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" name="image" id="upload" class="account-file-input"
                                               hidden="" accept="image/png, image/jpeg">
                                    </label>
                                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>
                                    {{--                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>--}}
                                </div>
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                           value="{{ old('name')}}" autofocus="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input class="form-control" type="text" id="full_name" name="full_name"
                                           value="{{ old('full_name')}}" autofocus="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nickname" class="form-label">Nick Name</label>
                                    <input class="form-control" type="text" id="nickname" name="nickname"
                                           value="{{ old('nickname')}}" autofocus="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="prize" class="form-label">Home Town</label>
                                    <input class="form-control" type="text" id="home_town" name="home_town"
                                           value="{{ old('home_town')}}" autofocus="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nation" class="form-label">Nation</label>
                                    <input class="form-control" type="text" id="nation" name="nation"
                                           value="{{ old('nation')}}" autofocus="">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="prize" class="form-label">Prize</label>
                                    <textarea class="form-control" type="text" id="prize" name="prize"
                                              autofocus="">{{ old('prize')}}</textarea>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="information" class="form-label">Information</label>
                                    <textarea class="form-control" type="text" id="information" name="information"
                                              autofocus="">{{ old('information')}}</textarea>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
                                <a href="{{ route('admin.singer.index') }}">
                                    <button type="button" class="btn btn-danger">Cancel</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
