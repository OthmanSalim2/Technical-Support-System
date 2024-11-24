@extends('front')

@section('page-title', 'All Permissions Page')
@section('root-title', ' Permissions page ')
@section('large-title', 'All Permissions')

@section('content')
    <div class="content">
        <div class="container-sm">
            <div class="card card-gray">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list-alt mr-2"></i>Here the all Permissions in system</h3>
                </div>
                <div class="'content">
                    <div class="container-sm">
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
                                               style="text-align: center;"
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
                                                    aria-label="Platform(s): activate to sort column ascending">
                                                    Guard Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Create At
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending">Actions
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @forelse($permissions as $permission)
                                                <tr class="odd">
                                                    <td class="dtr-control" tabindex="0">{{ $permission->id }}</td>
                                                    <td class="sorting_1">{{ $permission->name }}</td>
                                                    <td>{{ $permission->guard_name }}</td>
                                                    <td class="">{{ $permission->created_at }}</td>
                                                    <td style="width: 14%;">
                                                        <div class="row">
                                                            <form
                                                                action="{{ route('permissions.delete', ['permission' => $permission]) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <div class="col">
                                                                    <button type="submit" class="btn btn-danger"
                                                                            href="#"><i
                                                                            class="fas fa-trash-alt"></i></button>
                                                                </div>
                                                            </form>
                                                            <div class="col"><a class="btn btn-outline-success"
                                                                                href="{{ route('edit-permission', ['permission' => $permission->id]) }}"><i
                                                                        class="fas fa-edit"></i></a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">Not Found Permissions</td>
                                                </tr>
                                            @endforelse

                                            </tbody>
                                        </table>
                                        {{ $permissions->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
