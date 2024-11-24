@extends('front')

@section('page-title', 'All Departments Page')
@section('root-title', ' Departments page ')
@section('large-title', 'All Departments')

@section('content')
    <div class="content">
        <div class="container-sm">
            <div class="card card-gray">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list-alt mr-2"></i>Here the all departments</h3>
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
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Created At
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending">Actions
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @forelse($departments as $department)
                                                <tr class="odd">
                                                    <td class="dtr-control" tabindex="0">{{ $department->id }}</td>
                                                    <td class="sorting_1">{{ $department->name }}</td>
                                                    <td>{{ $department->created_at }}</td>
                                                    <td style="width: 14%; text-align: center;">
                                                        @canany(['update', 'delete'], $department)
                                                            <div class="row">
                                                                @can('delete', $department)
                                                                    <form
                                                                        action="{{ route('departments.destroy', ['department' => $department]) }}"
                                                                        method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <div class="col">
                                                                            <button type="submit"
                                                                                    class="btn btn-danger"
                                                                            ><i
                                                                                    class="fas fa-trash-alt"></i>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                @endcan
                                                                @can('update', $department)
                                                                    <div class="col"><a class="btn btn-outline-success"
                                                                                        href="{{ route('departments.edit', ['department' => $department]) }}"><i
                                                                                class="fas fa-edit"></i></a></div>
                                                                @endcan
                                                                @endcanany
                                                            </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="odd">
                                                    <td colspan="5" class="dtr-control" tabindex="0">Not Found Any
                                                        Department
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                        {{ $departments->links() }}
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
