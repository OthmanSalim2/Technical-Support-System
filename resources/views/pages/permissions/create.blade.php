@extends('front')

@section('page-title', 'Create Permission')
@section('root-title', 'Create Permission')
@section('large-title', 'Create Permission')

@section('content')
    <div class="content">
        <div class="container-sm" style="width: 60%">
            <div class="card card-gray-dark">
                <div class="card-header">
                    <h3 class="card-title"> Add Permission </h3>
                </div>
                <div class="container-sm">
                    <form action="{{ route('permissions.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Guard Name</label>
                                    <select name="guard_name" class="form-control select2 select2-hidden-accessible"
                                            style="width: 100%;"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="normal" data-select2-id="36">Normal User
                                        </option>
                                        <option value="admin" data-select2-id="35">Admin
                                        </option>
                                        <option value="super-admin" data-select2-id="34">Super Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection