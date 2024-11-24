@extends('front')

@section('page-title', 'All Orders Page')
@section('root-title', ' Orders page ')
@section('large-title', 'All Orders')

@section('content')
    <div class="content">
        <div class="container-sm">
            <div class="card card-gray">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list-alt mr-2"></i>Here the all orders that completed and
                        processing</h3>
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
                                                    aria-sort="descending">User
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending">
                                                    Description
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Status Order
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending">Actions
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @forelse($orders as $order)
                                                <tr class="odd">
                                                    <td class="dtr-control" tabindex="0">{{ $order->id }}</td>
                                                    <td class="sorting_1">{{ $order->user->name }}</td>
                                                    <td style="width: 50%">{{ $order->description }}</td>
                                                    <td class="">{{ $order->status }}</td>
                                                    <td style="width: 14%;">
                                                        <div class="row">
                                                            @php
                                                                $user = auth()->user();
                                                                $permission = \Spatie\Permission\Models\Permission::where('guard_name', $user->guard)->get();
                                                                $selected_permission = $permission->where('name', 'Create User')->first();
                                                            @endphp
                                                            @if(!empty($selected_permission->is_checked))
                                                                <form
                                                                    action="{{ route('orders.destroy', ['order' => $order]) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <div class="col">
                                                                        <button type="submit" class="btn btn-danger"><i
                                                                                class="fas fa-trash-alt"></i></button>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                            <div class="col"><a class="btn btn-outline-success"
                                                                                href="{{ route('orders.edit', ['order' => $order]) }}"><i
                                                                        class="fas fa-edit"></i></a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">Not Found Orders</td>
                                                </tr>
                                            @endforelse

                                            </tbody>
                                        </table>
                                        {{ $orders->links() }}
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
