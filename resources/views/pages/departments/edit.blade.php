@extends('front')

@section('page-title', 'Edit Department')
@section('root-title', 'Edit Department')
@section('large-title', 'Edit Department')

@section('content')
    <div class="content">
        <div class="container-sm" style="width: 60%">
            <div class="card card-gray-dark">
                <div class="card-header">
                    <h3 class="card-title"> Update Department </h3>
                </div>
                <div class="container-sm">
                    <form action="{{ route('departments.update', ['department' => $department]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" value="{{ old('name', $department) }}" type="text"
                                       class="form-control" id="name"
                                       placeholder="Name">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card">
                            <button type="submit" class="btn btn-outline-dark">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
