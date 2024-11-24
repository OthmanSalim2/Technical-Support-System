@extends('front')

@section('page-title', 'Create User')
@section('root-title', 'Create User')
@section('large-title', 'Create User')

@section('content')
    <div class="content">
        <div class="container-sm" style="width: 60%">
            <div class="card card-gray-dark">
                <div class="card-header">
                    <h3 class="card-title"> Add User To System </h3>
                </div>
                <div class="container-sm">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email...">
                            </div>
                            <div class="form-group">
                                <label for="email">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="Enter password...">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Department</label>
                                    <select name="department" class="form-control select2 select2-hidden-accessible"
                                            style="width: 100%;"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @forelse($departments as $department)
                                            <option value="{{ $department->id }}" data-select2-id="34">
                                                {{ $department->name }}
                                            </option>
                                        @empty
                                            <option value="#" data-select2-id=" 34">
                                                Not Found Any Department
                                            </option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Guard</label>
                                    <select name="guard" class="form-control select2 select2-hidden-accessible"
                                            style="width: 100%;"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="super-admin" data-select2-id="34">Super Admin</option>
                                        <option value="admin" data-select2-id="35">Admin</option>
                                        <option value="normal" data-select2-id="36">Normal User</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card">
                            <button type="submit" class="btn btn-outline-dark">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
