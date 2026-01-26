@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between no-print">
                <h1>Invoice No: {{ $order->invoice_no }}</h1>
                <div class="ml-auto">
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="fas fa-print"></i> Print Invoice
                    </button>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        {{-- Added ID for better targeting --}}
                        <div class="card invoice-container shadow-sm p-5 bg-white border" id="printable-invoice">
                            <div class="d-flex justify-content-between align-items-start mb-5">
                                <div class="logo">
                                    <h3 class="text-danger font-weight-bold" style="font-size: 28px;">The<span
                                            class="text-dark">Home</span></h3>
                                </div>
                                <div class="text-right">
                                    <h1 class="font-weight-bold mb-0"
                                        style="letter-spacing: -1px; font-size: 45px; color: #1a1a1a;">INVOICE</h1>
                                    <p class="mb-0 text-muted">Order No: {{ $order->invoice_no }}</p>
                                    <p class="text-muted small">Date: {{ $order->purchase_date }}</p>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-6">
                                    <h5 class="font-weight-bold mb-3">Invoice To:</h5>
                                    <ul class="list-unstyled text-muted" style="line-height: 1.6;">
                                        <li class="text-dark font-weight-bold" style="font-size: 1.1rem;">
                                            {{ $order->agent->name }}</li>
                                        <li>{{ $order->agent->email }}</li>
                                        <li>{{ $order->agent->phone }}</li>
                                        <li>{{ $order->agent->address }}</li>
                                        <li>{{ $order->agent->city }}, {{ $order->agent->state }}, {{ $order->agent->zip }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 text-end">
                                    <h5 class="font-weight-bold mb-3">Invoice From:</h5>
                                    <ul class="list-unstyled text-muted" style="line-height: 1.6;">
                                        <li class="text-dark font-weight-bold" style="font-size: 1.1rem;">Website Name</li>
                                        <li>admin@gmail.com</li>
                                        <li>215-899-5780</li>
                                        <li>3145 Glen Falls Road, PA 19020</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="table-responsive mb-5">
                                <table class="table table-bordered custom-table">
                                    <thead>
                                        <tr style="background-color: #e9ecef;">
                                            <th class="font-weight-bold">SL</th>
                                            <th class="font-weight-bold">Package Name</th>
                                            <th class="font-weight-bold">Price</th>
                                            <th class="font-weight-bold">Purchase Date</th>
                                            <th class="font-weight-bold">Expire Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td class="text-capitalize">{{ $order->package->name }}</td>
                                            <td>${{ number_format($order->package->price, 2) }}</td>
                                            <td>{{ $order->purchase_date }}</td>
                                            <td>{{ $order->expire_date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-weight-bold mb-2">Payment Status</h5>
                                    <p class="text-muted small mb-1">METHOD: {{ strtoupper($order->payment_method) }}</p>
                                    <span class="badge badge-success px-3 py-2"
                                        style="background-color: #28a745; font-size: 12px;">PAID</span>
                                </div>
                                <div class="col-6 text-end">
                                    <h5 class="font-weight-bold mb-0">Total Amount</h5>
                                    <h2 style="color: #6172f3; font-weight: 800; font-size: 32px;">
                                        ${{ number_format($order->paid_amount, 2) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


<style>
    .custom-table th,
    .custom-table td {
        padding: 12px 15px !important;
        vertical-align: middle;
    }

    @media print {

        /* Hide everything by default */
        body * {
            visibility: hidden;
        }

        /* Show only the invoice container and its children */
        #printable-invoice,
        #printable-invoice * {
            visibility: visible;
        }

        /* Position the invoice at the very top-left of the page */
        #printable-invoice {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Fix spacing for the admin panel wrappers */
        .main-content {
            padding-left: 0 !important;
            padding-right: 0 !important;
            padding-top: 0 !important;
            margin: 0 !important;
        }

        .no-print {
            display: none !important;
        }

        /* Ensure color printing works */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
</style>