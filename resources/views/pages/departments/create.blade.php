@extends('front')

@section('page-title', 'Create Department')
@section('root-title', 'Create Department')
@section('large-title', 'Create Department')

@section('content')
    <div class="content">
        <div class="container-sm" style="width: 60%">
            <div class="card card-gray-dark">
                <div class="card-header">
                    <h3 class="card-title"> Add Department </h3>
                </div>
                <div class="container-sm">
                    <form action="{{ route('departments.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name"
                                       placeholder="Name">
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
