@extends('front.layouts.master')

@section('content')
    <div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg') }})">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Orders</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content user-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    @include('agent.sidebar.index')
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Payment Id</th>
                                    <th>Plan Name</th>
                                    <th>Price</th>
                                    <th>Order Date</th>
                                    <th>Expire Date</th>
                                    <th>Payment Method && Transaction Id</th>
                                    <th>Status</th>
                                    <th>Print Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->invoice_no}} <br />
                                            @if($item->currently_active == 1)
                                                <h5 class="badge bg-success p-2">Currently Active</h5>
                                            @else
                                                <span class="badge bg-secondary">Expired</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->package->name }}</td>
                                        <td>${{ number_format($item->paid_amount, 2) }}</td>
                                        <td>{{ $item->purchase_date }}</td>
                                        <td>{{ $item->expire_date }}</td>
                                        <td style="word-wrap: break-word; word-break: break-all;">
                                            <b class="text-uppercase"> {{ $item->payment_method }}</b> <br />
                                            {{ $item->transaction_id }}

                                        </td>
                                        <td class="text-success">{{ $item->status }}</td>
                                        <td>
                                             <a class="btn btn-primary btn-sm rounded-2"
                                            href="{{ route('agent_invoice', $item->id) }}">
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
@endsection