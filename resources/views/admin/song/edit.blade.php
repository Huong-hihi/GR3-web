@extends('admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"></span> Edit Song
    </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <form method="POST" action="{{ route('admin.song.update', ['id' => $song->id]) }}" enctype="multipart/form-data">
                    <h5 class="card-header">Profile Details</h5>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ $song->image }}" alt="song-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="mp3" accept="audio/*" name="mp3" value="">
                                    <label class="input-group-text" for="mp3">Upload</label>
                                </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') ?? $song->name }}" autofocus="">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="parent_id" class="form-label">Singer Name:</label>
                                <select id="parent_id" class="form-select" name="singer_name">
                                    <option value="0">----------</option>
                                    @foreach($listSingerName as $singerName)
                                        <option value="{{ $singerName->name }}" {{ $singerName->name == $song->singer_name ? 'selected': '' }}>{{ $singerName->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Musician</label>
                                <input class="form-control" type="text" id="musician" name="musician" value="{{ old('musician') ?? $song->musician }}" placeholder="">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Category</label>
                                <select id="parent_id" class="form-select" name="category_id">
                                    <option value="0">----------</option>
                                    @foreach($parentCategories as $parentCategory)
                                        <option value="{{ $parentCategory->id }}" {{ $parentCategory->id == $song->category_id ? 'selected': '' }}>{{ $parentCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
{{--                            <div class="mb-3 col-md-6">--}}
{{--                                <label for="email" class="form-label">Url</label>--}}
{{--                                <input class="form-control" type="text" id="url" name="url" value="{{ old('url') ?? $song->url }}" placeholder="">--}}
{{--                            </div>--}}
                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">Lyric</label>
                                <textarea rows="5" class="form-control" type="text" id="lyric" name="lyric" placeholder="" style="min-height: 300px">{{ old('lyric') ?? $song->lyric }}</textarea>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
                            <a href="{{ route('admin.song.index') }}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
