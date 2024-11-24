@extends('front')

@section('page-title', 'Edit on a Permission')
@section('root-title', 'Update Permission')
@section('large-title', 'Edit The Permission')

@section('content')
    <div class="content">
        <div class="container-sm" style="width: 60%">
            <div class="card card-gray-dark">
                <div class="card-header">
                    <h3 class="card-title"> Edit the Permission for Users </h3>
                </div>
                <div class="container-sm">
                    <form>
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input value="{{ $user->name }}" type="text" name="name"
                                               class="form-control"
                                               id="name"
                                               disabled
                                               placeholder="Name">
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
                                                aria-sort="descending">Name of Permission
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1"
                                                aria-label="Platform(s): activate to sort column ascending">Guard Name
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1"
                                                aria-label="Engine version: activate to sort column ascending">
                                                Is Checked
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($permissions as $permission)
                                            <tr class="odd">
                                                <td class="dtr-control" tabindex="0">{{ $permission->id }}</td>
                                                <td class="sorting_1">{{ $permission->name }}</td>
                                                <td>{{ $permission->guard_name }}</td>
                                                <td>

                                                    <div class="icheck-success d-inline">
                                                        {{--                                                        <input type="checkbox"--}}
                                                        {{--                                                               data-user-id="{{ $user->id }}"--}}
                                                        {{--                                                               data-permission-id="{{ $permission->id }}"--}}
                                                        {{--                                                               {{ $user->hasPermissionTo($permission) ? 'checked' : '' }}--}}
                                                        {{--                                                               onchange="togglePermission(this)">--}}
                                                        <input type="checkbox"
                                                               id="{{$permission->id}}"
                                                               onclick="togglePermission(this, '{{ $user->id }}', '{{ $permission->id }}')"
                                                            @checked($permission->is_checked)
                                                            {{--                                                            {{ $user->hasPermissionTo($permission) ? 'checked' : '' }}--}}
                                                        />
                                                        <label for="{{$permission->id}}">
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="odd">
                                                <td colspan="6" class="dtr-control" tabindex="0">Not Found Permissions
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    {{ $permissions->links() }}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card">
                            <a href="{{ route('permissions.user_permissions') }}" class="btn btn-outline-dark"><i
                                    class="fas fa-backward mr-5"></i>Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function togglePermission(checkbox, user_id, permission_id) {
                axios.post('/technical-support-system/permissions/user/', {
                    userId: user_id,
                    permissionId: permission_id,
                })
                    .then(function (response) {
                        console.log(response);
                        // alert('added');
                        toastr.success(response.data.message);
                    })
                    .catch(function (error) {
                        console.log(error);
                        // alert('error');
                        toastr.error(error.response.data.message);
                    });
            }
        </script>
    @endpush

@endsection
