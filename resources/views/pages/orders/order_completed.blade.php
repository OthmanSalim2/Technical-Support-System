@extends('front')

@section('page-title', 'Completed Orders Page')
@section('root-title', ' Orders page ')
@section('large-title', 'Completed Orders')

@section('content')
    <div class="content">
        <div class="container-sm">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users mr-2"></i>Here All Completed Orders</h3>
                </div>
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
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
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
                                            aria-label="Platform(s): activate to sort column ascending">Details
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1"
                                            aria-label="Engine version: activate to sort column ascending">Status Order
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1"
                                            aria-label="CSS grade: activate to sort column ascending">Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($completed_orders as $order)
                                        <tr class="odd">
                                            <td class="dtr-control" tabindex="0">{{ $order->id }}</td>
                                            <td class="sorting_1">{{ $order->user->name }}</td>
                                            <td style="width: 50%">{{ $order->description }}</td>
                                            <td class="">{{ $order->status }}</td>
                                            <td style="text-align: center;">
                                                <div class="row">
                                                    <div class="col"><a class="btn btn-danger"
                                                                        href="{{ route('orders.delete-completed-order') }}"><i
                                                                class="fas fa-trash-alt"></i></a></div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="odd">
                                            <td colspan="6">Not Found any completed orders.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $completed_orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
