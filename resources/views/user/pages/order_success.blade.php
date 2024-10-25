@extends('user.layout.app')
@section('content')
@php
    $subtotal = 0
@endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center d-flex flex-column justify-content-center">
                <span>
                    <svg width="100" height="100" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#008000" d="M11.1 14.3L8.95 12.15C8.76667 11.9667 8.53333 11.875 8.25 11.875C7.96667 11.875 7.73333 11.9667 7.55 12.15C7.36667 12.3333 7.275 12.5667 7.275 12.85C7.275 13.1333 7.36667 13.3667 7.55 13.55L10.4 16.4C10.6 16.6 10.8333 16.7 11.1 16.7C11.3667 16.7 11.6 16.6 11.8 16.4L17.45 10.75C17.6333 10.5667 17.725 10.3333 17.725 10.05C17.725 9.76667 17.6333 9.53333 17.45 9.35C17.2667 9.16667 17.0333 9.075 16.75 9.075C16.4667 9.075 16.2333 9.16667 16.05 9.35L11.1 14.3ZM12.5 22.5C11.1167 22.5 9.81667 22.2373 8.6 21.712C7.38333 21.1867 6.325 20.4743 5.425 19.575C4.525 18.675 3.81267 17.6167 3.288 16.4C2.76333 15.1833 2.50067 13.8833 2.5 12.5C2.5 11.1167 2.76267 9.81667 3.288 8.6C3.81333 7.38333 4.52567 6.325 5.425 5.425C6.325 4.525 7.38333 3.81267 8.6 3.288C9.81667 2.76333 11.1167 2.50067 12.5 2.5C13.8833 2.5 15.1833 2.76267 16.4 3.288C17.6167 3.81333 18.675 4.52567 19.575 5.425C20.475 6.325 21.1877 7.38333 21.713 8.6C22.2383 9.81667 22.5007 11.1167 22.5 12.5C22.5 13.8833 22.2373 15.1833 21.712 16.4C21.1867 17.6167 20.4743 18.675 19.575 19.575C18.675 20.475 17.6167 21.1877 16.4 21.713C15.1833 22.2383 13.8833 22.5007 12.5 22.5ZM12.5 20.5C14.7333 20.5 16.625 19.725 18.175 18.175C19.725 16.625 20.5 14.7333 20.5 12.5C20.5 10.2667 19.725 8.375 18.175 6.825C16.625 5.275 14.7333 4.5 12.5 4.5C10.2667 4.5 8.375 5.275 6.825 6.825C5.275 8.375 4.5 10.2667 4.5 12.5C4.5 14.7333 5.275 16.625 6.825 18.175C8.375 19.725 10.2667 20.5 12.5 20.5Z" />
                    </svg>

                </span>
                <span class="h2">Thanks For Purchasing Our Products</span>
                {{-- <pre>
                    {{$order}}
                </pre> --}}
                <span class="h4">Your Order Id Is #{{$order->order_id}}</span>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="row px-xl-5">
            <div class="col-md-8 text-center table-responsive mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Your Products</span>
                </h5>
                <table class="table table-light text-start table-borderless table-hover  mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="cart_body">
                        @foreach ($products as $item)
                            <tr>
                                <td><img style="width:100px" src="{{url('products')}}/{{$item->prod_image}}"> </td>
                                <td class="align-middle h5 ">{{$item->prod_name}}</td>
                                <td class="align-middle h5 ">{{$item->product_price}}</td>
                                <td class="align-middle h5 ">{{$item->product_quantity}}</td>
                                @php
                                    $subtotal += $item->product_quantity * $item->product_price;
                                @endphp
                                
                            </tr>
                            
                        @endforeach
                        @php
                            $gst = $subtotal*($gst_value[0]['setting_value']/100);
                            $total = $subtotal + ceil($gst);
                        @endphp
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Order Total</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="total">{{$subtotal}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">GST</h6>
                            <h6 id="gst" class="font-weight-medium">{{ceil($gst)}}</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="final">{{$total}}</h5>
                        </div>
                    </div>
                </div>
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Order Details</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class=" pt-3 pb-2">
                        <div class="d-flex justify-content-between ">
                            <h6>Order Date</h6>
                            <h6>{{$order->order_date}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>Order Id</h6>
                            <h6>#{{$order->order_id}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>Payment Type</h6>
                            <h6>{{$order->Payment_Method}}</h6>
                        </div>
                        
                    </div>
                    <button id="download_bill" class="btn btn-block btn-success font-weight-bold my-3 py-3">
                        <i class="fa fa-download" aria-hidden="true"></i>   
                        <span>
                            Download Invoice
                        </span> 
                    </button>
                </div>
                
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        $('#download_bill').click(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{route('generate_bill')}}",
                data: {id:'{{$order->order_id}}'},
                // dataType: "json",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "{{$order->order_id}}"+".pdf";
                    link.click();
                }
            });
        });
        
    </script>
@endpush