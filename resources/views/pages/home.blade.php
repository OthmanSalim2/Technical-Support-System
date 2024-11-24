@extends('front')

@section('page-title', 'Main Page')
@section('root-title', ' - ')
@section('large-title', ' Home ')

@section('content')
    <div class="content">
        <div class="container" style="width: 70%;">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Add a new order</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">When created the order will send to target department.</p>
                            <a href="{{ route('orders.create') }}" class="btn btn-primary mr-2">Add a new order</a>
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-info">
                                <i class="fas fa-inbox mr-2"></i>All Orders
                            </a>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title" style="margin-bottom: 5px;">Order Status</h5>
                            <p class="card-text">
                                The status for orders that processed and completed
                            </p>
                            <a href="{{ route('orders.processed') }}" type="button"
                               class="btn btn-outline-danger btn-block">
                                <i class="fa fa-bell mr-2"></i>
                                View Orders in progress
                            </a>
                            <a href="{{ route('orders.completed') }}" type="button"
                               class="btn btn-outline-primary btn-block">
                                <i class="fa fa-book mr-2"></i>
                                Orders are completed
                            </a>
                        </div>
                    </div><!-- /.card -->
                    @php
                        $user = auth()->user();
                        $permission = \Spatie\Permission\Models\Permission::where('guard_name', $user->guard)->get();
                        $selected_permission = $permission->where('name', 'Edit Permission')->first();
                    @endphp
                    @if(!empty($selected_permission->is_checked))
                        <div class="card">

                            <div class="card-header">
                                <h5 class="card-title m-0">Modify the permissions</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Here change the permissions for each user.</p>
                                <a href="{{ route('permissions.user_permissions') }}"
                                   class="btn btn-outline-primary">Modify</a>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    @php
                        $user = auth()->user();
                        $permission = \Spatie\Permission\Models\Permission::where('guard_name', $user->guard)->get();
                        $selected_permission = $permission->where('name', 'Read Permissions')->first();
                    @endphp
                    @if(!empty($selected_permission->is_checked))
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title m-0">Permissions</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Create a new permission of added to any user.</p>
                                <a href="{{ route('permissions.create') }}" class="btn btn-outline-primary mr-2">Add a
                                    new
                                    permission</a>
                                <a href="{{ route('permissions.index') }}" class="btn btn-info">
                                    <i class="fas fa-shield-alt mr-2"></i> Show All Permissions
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="card card-primary card-outline">
                        @php
                            $user = auth()->user();
                            $permission = \Spatie\Permission\Models\Permission::where('guard_name', $user->guard)->get();
                            $selected_permission = $permission->where('name', 'Create Department')->first();
                        @endphp
                        <div class="card-header">
                            <h5 class="card-title m-0">Add a new Department</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">The Departments of Enterprise</h6>

                            <p class="card-text">Add the new department that opened in this enterprise.</p>
                            @if(!empty($selected_permission->is_checked))
                                <a href="{{ route('departments.create') }}" class="btn btn-primary mr-2">Add a new
                                    department</a>
                            @endif
                            <a href="{{ route('departments.index') }}" class="btn btn-outline-info"><i
                                    class="fas fa-building mr-2"></i>All Departments</a>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title" style="margin-bottom: 5px;">Users</h5>
                            <p class="card-text">
                                Show users and add users and delete any user.
                            </p>
                            @php
                                $user = auth()->user();
                                $permission = \Spatie\Permission\Models\Permission::where('guard_name', $user->guard)->get();
                                $selected_permission = $permission->where('name', 'Create User')->first();
                            @endphp
                            <a href="{{ route('users.index') }}" class="card-link">View all users</a>
                            @if(!empty($selected_permission->is_checked))
                                <a href="{{ route('users.create') }}" class="card-link mr-3">Add user</a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
