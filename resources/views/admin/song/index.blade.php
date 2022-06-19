@extends('admin.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4" style="text-align: center">
            <span class="text-muted fw-light"></span>Song
        </h4>
        <a href="{{ route('admin.song.create') }}" class="btn btn-primary mb-3">Create</a>
        <div class="card">

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Musician</th>
                        <th>Url</th>
                        <th>Lyric</th>
                        <th>File_mp3</th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($songs as $song)

                    <tr>
                        <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $song->id }}</strong></td>
                        <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $song->name }}</strong></td>
                        <td>{{ $song->category_id }}</td>
                        <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $song->musician }}</strong></td>
                        <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $song->url }}</strong></td>
                        <td class = "threedots"><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $song->lyric }}</strong></td>
                        <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $song->file_mp3 }}</strong></td>
                        <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $song->image }}</strong></td>
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
    </div>
@endsection
