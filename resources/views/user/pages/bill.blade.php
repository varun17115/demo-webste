
<?php 
    function inr()
    {
        return '<span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>';
    }
   
?>
<head>
    {{-- <link href="{{asset('multishop_assets/css/custom.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{asset('multishop_assets/css/style.css')}}" rel="stylesheet"> --}}

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        .container,
        .container-fluid,
        .container-sm,
        .container-md,
        .container-lg,
        .container-xl {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .text-primary {
            color: #ffd333 !important;
        }
        .p-2 {
            padding: 0.5rem !important;
        }
        .mt-3,
        .my-3 {
            margin-top: 1rem !important;
        }
        .position-relative {
            position: relative !important;
        }
        .text-uppercase {
            text-transform: uppercase !important;
        }
        .pr-3,
        .px-3 {
            padding-right: 1rem !important;
        }
        table {
            border-collapse: collapse;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #6C757D;
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
            color: #3D464D;
        }
        h5,
        .h5 {
            font-size: 1.25rem;
        }
        h6,
        .h6 {
            font-size: 1rem;
        }
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-hover tbody tr:hover {
            color: #6C757D;
            background-color: rgba(0, 0, 0, 0.075);
        }
        .font-weight-bold {
            font-weight: 700 !important;
        }
        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }
        .bg-primary {
            background-color: #FFD333 !important;
        }
        html {
            /* font-family: sans-serif; */
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            width: 100%;
        }
        body {
            margin: 0;
            /* font-family: "Roboto", sans-serif; */
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #6C757D;
            text-align: left;
            background-color: #fff;
            width: 100%
        }
        h3,
        .h3 {
            font-size: 1.75rem;
        }
        h1,
        .h1 {
            font-size: 2.5rem;
        }
        h2, .h2 {
            font-size: 2rem;
        }

        @media (max-width: 1200px) {

            h1,
            .h1 {
                font-size: calc(1.375rem + 1.5vw);
            }
        }
    </style>
</head>
<div class="container-fluid" style="width:700px;background:#fff;border:1px solid #ccc">
    <div style="font-size:0px;padding:20px 0;">
        <h5 style="display:inline-block;width:350px" class=" position-relative text-uppercase ">
            <span class=" h1 text-primary ">{{ $shop_detail['shop_name'] }}</span>
        </h5>
        <h5 style="display:inline-block;width:350px;text-align:right;" class=" position-relative text-uppercase ">
            <span class="   font-weight-bold h1">Invoice</span>
        </h5>
    </div>

    <div style="font-size:0px;padding:20px 0;">
        <div style="width:350px;display:inline-block">
            <span class="text-dark " style="font-size:16px">{{ $shop_detail['shop_address'] }}</span><br>
            <span class="text-dark " style="font-size:16px">{{ $shop_detail['shop_phone'] }}</span><br>
            <span class="text-dark " style="font-size:16px">{{ $shop_detail['shop_email'] }}</span><br>
            <span class="text-dark " style="font-size:16px">ABC.com</span>

        </div>
        <div style="width:350px;display:inline-block;text-align:right">
            <span class="text-dark " style="font-size:16px">Date : {{ date('d-m-y') }}</span><br>
            <span class="text-dark " style="font-size:16px">Invoice # {{ $order->order_id }}</span><br>

        </div>

    </div>
    <div style="font-size:0px;padding:20px 0;">
        <h2 class="bg-primary " style="margin-bottom: 20px;width:360px">Bill To</h2>
        <div style="width:150px;display:inline-block">
            <span class="text-dark " style="font-size:16px">Name : </span><br>
            <span class="text-dark " style="font-size:16px">Street Address :</span><br>
            <span class="text-dark " style="font-size:16px">zip code, city, state : </span><br>
            <span class="text-dark " style="font-size:16px">Phone :</span>

        </div>
        <div style="width:200px;display:inline-block;text-align:right">
            <span class="text-dark " style="font-size:16px">{{ $order->user_detail->firstname }} {{ $order->user_detail->lastname }}</span><br>
            <span class="text-dark " style="font-size:16px">{{ $order->address_detail->address }}</span><br>
            <span class="text-dark " style="font-size:16px">{{ $order->address_detail->zip_code }}, {{ $order->address_detail->city }},{{ $order->address_detail->state }}</span><br>
            <span class="text-dark " style="font-size:16px">{{ $order->user_detail->phone }}</span><br>

        </div>

    </div>
    <div style="font-size:0px;padding:20px 0;">
        <h2 class="bg-primary " style="margin-bottom: 10px">Order Details</h2>
        <table class="table table-bordered table-hover" style="font-size: 20px;text-align:center">
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Product Name</th>
                    <th>Product Qty</th>
                    <th>Product Price</th>
                    <th>Final Price</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                    $subtotal = 0;
                @endphp
                @foreach ($order->order_items as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td style="text-align: left">{{ $item->product->prod_name }}</td>
                        <td>{{ $item->product_quantity }}</td>
                        <td>{{ $item->product_price }}</td>

                        <td>{{ $item->product_price * $item->product_quantity }}</td>

                        @php
                            $subtotal += $item->product_quantity * $item->product_price;
                        @endphp
                    </tr>
                @endforeach
                @php
                    $gst = $subtotal * ($shop_detail['product_gst'] / 100);
                    $total = $subtotal + ceil($gst);
                @endphp
            </tbody>
        </table>

    </div>
    <div style="font-size:0px;padding:20px 0;;text-align:right">
        <div style="width:100px;display:inline-block;">
            <span class="text-dark " style="font-size:16px">Sub - Total</span><br>
            <span class="text-dark " style="font-size:16px">GST</span><br>
            <span class="text-dark " style="font-size:16px">Total</span>
            
        </div>
        <div style="width:100px;display:inline-block;text-align:right;">
            <span class="text-dark " style="font-size:16px">{!!inr()!!} {{$subtotal}}</span><br>
            <span class="text-dark " style="font-size:16px">{!!inr()!!} {{ ceil($gst) }}</span><br>
            
            <span class="text-dark " style="font-size:16px">{!!inr()!!} {{$total}}</span><br>


        </div>

    </div>
    <div style="font-size:0px;padding:20px 0;text-align:center">
        <h3>Thank You For Your Purchase, Visit again :)</h3>
    </div>
    
</div>



{{-- <pre>
    {{print_r($order->order_items[0]['product']['prod_name'])}}
</pre> --}}
