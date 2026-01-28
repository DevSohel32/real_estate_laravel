@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <div>
                    <h1>Orders</h1>
                </div>
                <div class="ml-auto">
                    <a href="" class="btn btn-primary"><i class="fas fa-plus"></i> Add
                        orders</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Agent Info</th>
                                                <th>Payment Id</th>
                                                <th>Plan Name</th>
                                                <th>Price</th>
                                                <th>Order Date</th>
                                                <th>Payment Method && Transaction Id</th>
                                                <th>Status</th>
                                                <th>Print Invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td> <b>{{ $item->agent->name}}</b><br/>
                                                        {{ $item->agent->email}} 
                                                    </td>
                                                    <td>{{ $item->invoice_no}} <br />
                                                        @if($item->currently_active == 1)
                                                            <span class="text-success">Currently Active</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->package->name }}</td>
                                                    <td>${{ number_format($item->paid_amount, 2) }}</td>
                                                    <td>{{ $item->purchase_date }}</td>
                                                    <td style="word-wrap: break-word; word-break: break-all;">
                                                        <b class="text-uppercase"> {{ $item->payment_method }}</b> <br />
                                                        {{ $item->transaction_id }}
                                                    </td>
                                                    <td class="text-success">{{ $item->status }}</td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm rounded-2"
                                                            href="{{ route('admin_invoice', $item->id) }}">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection