@extends('front.layouts.master')

@section('content')
    <div class="page-top" style="background-image: url('uploads/banner.jpg')">
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
                    <div class="invoice-container shadow-sm p-5 bg-white border mb-4">
                        <div class="d-flex justify-content-between align-items-start mb-5">
                            <div class="logo">
                                {{-- Use the logo text or image from screenshot --}}
                                <h3 class="text-danger font-weight-bold">The<span class="text-dark">Home</span></h3>
                            </div>
                            <div class="text-right">
                                <h1 class="font-weight-bold mb-0" style="letter-spacing: -1px;">INVOICE</h1>
                                <p class="mb-0 text-muted">Order No: {{ $order->invoice_no }}</p>
                                <p class="text-muted small">Date: {{ $order->purchase_date }}</p>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-6">
                                <h5 class="font-weight-bold mb-3">Invoice To:</h5>
                                <ul class="list-unstyled text-muted" style="line-height: 1.6;">
                                    <li>{{$order->agent->name }}</li>
                                    <li>{{ $order->agent->email }}</li>
                                    <li>{{$order->agent->phone }}</li>
                                    <li>{{$order->agent->address }}</li>
                                    <li>{{$order->agent->city }},{{$order->agent->state }},
                                        {{$order->agent->country }},
                                        {{$order->agent->zip }}
                                    </li>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6 text-right">
                                <h5 class="font-weight-bold mb-3">Invoice From:</h5>
                                <ul class="list-unstyled text-muted" style="line-height: 1.6;">
                                    <li>Website Name</li>
                                    <li>admin@gmail.com</li>
                                    <li>215-899-5780</li>
                                    <li>3145 Glen Falls Road, PA 19020</li>
                                </ul>
                            </div>
                        </div>

                        <div class="table-responsive mb-5">
                            <table class="table table-bordered custom-table">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="font-weight-bold">SL</th>
                                        <th class="font-weight-bold">Package Name</th>
                                        <th class="font-weight-bold">Package Price</th>
                                        <th class="font-weight-bold">Purchase Data</th>
                                        <th class="font-weight-bold">Expire Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $order->package->name }}</td>
                                        <td>${{ number_format($order->package->price, 2) }}</td>
                                        <td>{{ $order->purchase_date }}</td>
                                        <td>{{ $order->expire_date }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row align-items-end">
                            <div class="col-6">
                                <h5 class="font-weight-bold mb-2">Payment Method</h5>
                                <p class="text-muted text-uppercase mb-0">{{ $order->payment_method }}</p>
                            </div>
                            <div class="col-6 text-right">
                                <h5 class="font-weight-bold mb-2">Total</h5>
                                <h3 class="text-primary font-weight-bold">${{ number_format($order->paid_amount, 2) }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="no-print mb-4">
                        <button onclick="window.print()" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                            <i class="fas fa-print mr-2"></i> Print
                        </button>
                    </div>
                </div>

                <style>
                    .custom-table th,
                    .custom-table td {
                        padding: 12px 15px !important;
                        vertical-align: middle;
                    }

                    .text-right {
                        text-align: right;
                    }

                    @media print {

                        /* 1. Hide EVERY layout element except the invoice */
                        header,
                        nav,
                        .navbar,
                        .top-header,
                        .page-top,
                        .col-lg-3,
                        .no-print,
                        .breadcrumb-area,
                        .sidebar-wrapper {
                            display: none !important;
                            height: 0 !important;
                            margin: 0 !important;
                            padding: 0 !important;
                        }

                        /* 2. Reset container spacing for the paper */
                        body,
                        html {
                            background-color: #fff !important;
                            margin: 0 !important;
                            padding: 0 !important;
                        }

                        /* .container {
                            max-width: 100% !important;
                            width: 100% !important;
                            margin: 0 !important;
                            padding: 0 !important;
                        } */

                        /* 3. Force the invoice column to take 100% width */
                        .col-lg-9 {
                            flex: 0 0 100% !important;
                            max-width: 100% !important;
                            width: 100% !important;
                            padding: 0 !important;
                            margin: 0 !important;
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            
                        }

                        .invoice-container {
                            border: none !important;
                            box-shadow: none !important;
                            padding: 0 !important;
                            margin: 0 !important;
                        }

                        /* 4. Ensure colors print (important for the Blue Total and Red Logo) */
                        * {
                            -webkit-print-color-adjust: exact !important;
                            print-color-adjust: exact !important;
                        }
                    }
                </style>
            </div>
        </div>
@endsection