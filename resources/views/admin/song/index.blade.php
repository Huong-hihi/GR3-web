@extends('admin.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4" style="text-align: center">
            <span class="text-muted fw-light"></span>Song
        </h4>
        <div class="row">
            <div class="mb-3 col-md-4">
                <a href="{{ route('admin.song.create') }}" class="btn btn-primary mb-3">Create</a>
            </div>
            <div class="mb-3 col-md-4"></div>
            <div class="mb-3 col-md-4">
                <form action="">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                    </div>
                </form>
            </div>
        </div>

        <div class="card">

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th><strong>Id</strong></th>
                        <th><strong>Name</strong></th>
                        <th><strong>Category</strong></th>
                        <th><strong>Singer</strong></th>
                        <th><strong>Musician</strong></th>
                        <th><strong>Lyric</strong></th>
{{--                        <th>File_mp3</th>--}}
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($songs as $song)
                    <tr>
                        <td><strong>{{ $song->id }}</strong></td>
                        <td>{{ $song->name }}</td>
                        <td class="threedots mw-100">{{ $song->category ? $song->category->name : '' }}</td>
                        <td class="threedots mw-150">{{ $song->singer_name }}</td>
                        <td class="threedots mw-150">{{ $song->musician }}</td>
                        <td class="threedots">{{ $song->lyric }}</td>
{{--                        <td class="threedots"><strong>{{ $song->file_mp3 }}</strong></td>--}}
                        <td class="threedots mw-50">
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li class="avatar avatar-xs pull-up">
                                    <img src="{{ $song->image ?? cxl_asset('images/default-user-image.png') }}" alt="image" class="rounded-circle">
                                </li>
                            </ul>
                        </td>
                        {{-- <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                                    <img src="{{ $user->avatar }}" alt="Avatar" class="rounded-circle">
                                </li>
                            </ul>
                        </td>
                        <td>{{ @config('services.role')[$user->role] }}</td> --}}
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.song.edit', ['id' => $song->id]) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ route('admin.song.delete', ['id' => $song->id]) }}"><i class="bx bx-trash me-2"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            {{ $songs->appends(request()->query())->links('admin.pagination') }}
        </div>
    </div>
@endsection
