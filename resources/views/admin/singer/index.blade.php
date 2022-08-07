@extends('admin.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light"></span>Singer
        </h4>
        <div class="row">
            <div class="mb-3 col-md-4">
                <a href="{{ route('admin.singer.create') }}" class="btn btn-primary mb-3">Create</a>
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
                        <th>Id</th>
                        <th>Name</th>
                        <th>Nickname</th>
{{--                        <th>Email</th>--}}
                        <th>Avatar</th>
                        <th>Nation</th>
                        <th>Prize</th>
                        <th>Information</th>
                        <th>Home Town</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($singers as $singer)
                    <tr>
                        <td class="threedots"><strong>{{ $singer->id }}</strong></td>
                        <td class="threedots"><strong>{{ $singer->name }}</strong></td>
                        <td class="threedots">{{ $singer->nickname }}</td>
                        <td>
                            <ul class="list-unstyled singers-list m-0 avatar-group d-flex align-items-center">
                                <li class="avatar avatar-xs pull-up">
                                    <img src="{{ $singer->image ?? cxl_asset('images/default-user-image.png') }}" alt="Avatar" class="rounded-circle">
                                </li>
                            </ul>
                        </td>
                        <td class="threedots">{{ $singer->nation }}</td>
                        <td class="threedots">{{ $singer->prize }}</td>
                        <td class="threedots">{{ $singer->information }}</td>
                        <td class="threedots">{{ $singer->home_town }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.singer.edit', ['id' => $singer->id]) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ route('admin.singer.delete', ['id' => $singer->id]) }}"><i class="bx bx-trash me-2"></i> Delete</a>
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
            {{ $singers->appends(request()->query())->links('admin.pagination') }}
        </div>
    </div>
@endsection
