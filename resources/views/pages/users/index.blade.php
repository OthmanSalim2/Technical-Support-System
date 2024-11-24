@extends('front')

@section('page-title', 'All Users In The System')
@section('root-title', ' Users page ')
@section('large-title', 'All Users')

@section('content')
    <div class="content">
        <div class="container-sm">
            <div class="card card-gray">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users mr-2"></i>Here All Users</h3>
                </div>
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-md-6 col-md-6">
                                <div id="example1_filter" class="dataTables_filter"><label>Search:
                                        <input type="search"
                                               class="form-control form-control"
                                               placeholder=""
                                               aria-controls="example1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1"
                                       class="table table-bordered table-striped dataTable dtr-inline"
                                       aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1"
                                            aria-label="Rendering engine: activate to sort column ascending">ID
                                        </th>
                                        <th class="sorting sorting_desc" tabindex="0" aria-controls="example1"
                                            rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending"
                                            aria-sort="descending">Name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1"
                                            aria-label="Platform(s): activate to sort column ascending">Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1"
                                            aria-label="Engine version: activate to sort column ascending">
                                            Department
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1"
                                            aria-label="CSS grade: activate to sort column ascending">Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($users as $user)
                                        <tr class="odd">
                                            <td class="dtr-control" tabindex="0">{{ $user->id }}</td>
                                            <td class="sorting_1">{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="">{{ $user->department->name }}</td>
                                            <td style="width: 14%;">
                                                <div class="row">
                                                    @canany(['delete', 'update'], \App\Models\User::class)
                                                        @can('delete', \App\Models\User::class)
                                                            <form
                                                                action="{{ route('users.delete', ['user' => $user->id]) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <div class="col">
                                                                    <button type="submit" class="btn btn-danger"
                                                                            href="#"><i
                                                                            class="fas fa-trash-alt"></i></button>
                                                                </div>
                                                            </form>
                                                        @endcan
                                                        @can('update', \App\Models\User::class)
                                                            <div class="col"><a class="btn btn-outline-success"
                                                                                href="{{ route('users.edit', ['user' => $user->id]) }}"><i
                                                                        class="fas fa-edit"></i></a></div>
                                                        @endcan
                                                    @endcanany
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="odd">
                                            <td colspan="6">Not Found Any User</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
