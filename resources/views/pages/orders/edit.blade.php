@extends('front')

@section('page-title', 'Edit Order')
@section('root-title', 'Edit Order')
@section('large-title', 'Edit Order')

@section('content')
    <div class="content">
        <div class="container-sm" style="width: 60%">
            <form action="{{ route('orders.update', ['order' => $order]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Orders</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group" data-select2-id="29">
                            <label>Username</label>
                            <select name="username"
                                    disabled
                                    class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;"
                                    data-select2-id="1" tabindex="-1" aria-hidden="true">
                                @forelse($users as $user)
                                    <option value="{{ $user->id }}" @selected($user->name == $order->user->name)
                                    data-select2-id="34">{{ $user->name }}</option>
                                @empty
                                    <option selected="selected" data-select2-id="3">Not Found Any User
                                    </option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input name="title" value="{{ old('name', $order->name) }}" type="text" class="form-control"
                                   id="name"
                                   placeholder="Enter the Title ...">
                        </div>
                        <div class="form-group">
                            <label>Write the problem/request in detail.</label>
                            <textarea name="description" class="form-control" rows="3"
                                      placeholder="Enter ...">
                                {{ old('description', $order->description) }}
                            </textarea>
                        </div>
                        <div class="form-group" data-select2-id="29">
                            <label>Department</label>
                            <select name="department" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;"
                                    data-select2-id="1" tabindex="-1" aria-hidden="true">
                                @forelse($departments as $department)
                                    <option value="{{ $department->id }}"
                                            @selected($department->id == $order->user->department_id)
                                            data-select2-id="34">{{ $department->name }}</option>
                                @empty
                                    <option selected="selected" data-select2-id="3">Not Found Any Departments
                                    </option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card" style="margin: 10px 15px">
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection